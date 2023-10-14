<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\UserPostRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role == 0 || auth()->user()->role == 1) {
                // abort(404);
                return $next($request);
            }else{
                abort(404);
            }
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uindex()
    {
        return view('users.uindex');
    }

    public function logsServerSideOwn(Request $request)
    {
        $search = $request->filter;
        $filter = (array)json_decode($search);
        $sort = $request->sort;
        $order = $request->order;
        $offset = $request->offset;
        $limit = $request->limit;
        $getadmin = $request->getadmin;
        $i = 1;

        // your table name
        $query = User::when($search, function ($q) use ($filter, $i) {
            foreach ($filter as $key => $item) {
                if ($key == 'username') {
                    $q->where($key,'Like', '%'.$item.'%');
                }else{
                    $q->where($key, $item);
                }
            }
        })->when($sort, function ($q1) use ($sort, $order) {
            $q1->orderBy($sort, $order);
        });
        // dd($getadmin);
        if($getadmin == 'true'){
            $query->where('role', 1);
        }else{
            $query->where('role', 2);
        }
        if (!$sort) {
            $query->orderBy('created_at', 'desc');
        }
        $count =  $query->count();
        $row = $query->when($offset, function ($q) use ($offset) {
            $q->offset($offset);
        })->when($limit, function ($q) use ($limit) {
            $q->limit($limit);
        })->get()->toArray();
        foreach ($row as $key => $item) {
            // dump($item);
            if($item['role'] == 1) {
                // Manger
                $row[$key]['role'] = 'Admin';
            } else if($item['role'] == 2) {
                // Recruiter
                $row[$key]['role'] = 'Recruiter';
            }
        }

        $index = $offset + 1;
        $data = [];

        $data['items'] = $row;
        $data['count'] = $count;
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPostRequest $request)
    {
        $reqData = $request->all();
        if($request->password){

            $reqData['password'] = Hash::make($request->password);
        }
        $reqData['name'] = $request->username;
        $reqData['role'] = 1;
        User::create($reqData);
        return redirect()->route('user.index')->with('success', 'Admin created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user'] = User::findOrFail($id);
        return view('users/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserPostRequest $request, $id)
    {
        $reqData = $request->all();
        if($reqData['password']) {
            $reqData['password'] = Hash::make($request->password);
        } else {
            unset($reqData['password']);
        }
        // dd($reqData);
        $user = User::findOrFail($id);
        $user->update($reqData);
        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == 1 || $id == Auth::user()->id) {
            return response()->json(['success' => false, 'message' => 'User can not deleted']);
        } else {
            $user =  User::find($id);
            $user->tokens()->delete();
            $user->delete();
            return response()->json(['success' => true, 'message' => 'User deleted successfully']);
        }
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
        // return (new UsersExport)->download('users.csv', \Maatwebsite\Excel\Excel::CSV, [
        //     'Content-Type' => 'text/csv',
        // ]);
    }

    public function changePassword(Request $request)
    {
        return view('users/changePassword');
    }


    /**
     * Change status of specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($id, Request $request)
    {
        $user = User::findOrFail($id);
        // $user->update(['status' => $request->status]);
        $user->tokens()->delete();
        $user->currentAccessToken()->delete();
        \Log::info('User having id ' . $id . ' Updated status to ' . $request->status);
        return response()->json(['success' => true, 'message' => 'User status changed successfully']);
    }

    public function changePasswordStore(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->route('user.change_password')->withErrors($validator);
        }

        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        if (!Hash::check($request->old_password, $user->password)) {
            $validator->errors()->add('old_password','Old Password is incorrect');
            return redirect()->route('user.change_password')->withErrors($validator);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('user.change_password')->with('success', 'Password changed successfully');
    }
}
