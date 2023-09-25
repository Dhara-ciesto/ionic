<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notification.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     *
     */
    public function logsServerSideOwn(Request $request)
    {
        $search = $request->filter;
        $filter = (array)json_decode($search);
        $sort = $request->sort;
        $order = $request->order;
        $offset = $request->offset;
        $limit = $request->limit;
        $i = 1;

        // your table name
        $query = Notification::when($search, function ($q) use ($filter, $i) {
            foreach ($filter as $key => $item) {
                if ($key == 'status') {
                    if (strtolower($item) == 'active') {
                        $q->where($key, 1);
                    } else {
                        $q->where($key, 0);
                    }
                } else {
                    $q->where($key, 'Like', '%'.$item.'%');
                }
            }
        })->when($sort, function ($q1) use ($sort, $order) {
            if ($sort == 'counter') {
                $q1->orderBy('id', $order);
            } else {
                $q1->orderBy($sort, $order);
            }
        });
        if (!$sort) {
            $query->orderBy('created_at', 'desc');
        }
        $count =  $query->count();
        $row = $query->when($offset, function ($q) use ($offset) {
            $q->offset($offset);
        })->when($limit, function ($q) use ($limit) {
            $q->limit($limit);
        })->get()->toArray();
        $index = $offset + 1;
        $data = [];
        foreach ($row as $key => $item) {
            $row[$key]['counter'] = $index++;
            $row[$key]['send_date'] = date('d-m-Y',strtotime($item['send_date']));
            $row[$key]['send_time'] = date('h:i a',strtotime($item['send_time']));

            
        }
        $data['items'] = $row;
        $data['count'] = $count;
        // dd($data);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] =  User::where('role',2)->get()->all();
        return view('notification.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:notification,title',
            'user_ids' => 'required',
            'message' => 'required',
            'send_date' => 'required|date',
            'send_time' => 'required',
        ],[
            'title.required' => 'Please Enter Notification name',
            'user_ids.required' => 'Please Select Users.'
        ]);
        Notification::create($request->all());
        \Log::info('Notification Created');
        return redirect()->route('notification.index')->with('success', 'Notification created successfully');
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
        $data['users'] =  User::where('role',2)->get()->all();
        $data['notification'] = Notification::findOrFail($id);
        return view('notification.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|unique:notification,title',
            'user_ids' => 'required',
            'message' => 'required',
            'send_date' => 'required|date',
            'send_time' => 'required',
        ],[
            'title.required' => 'Please Enter Notification name',
            'user_ids.required' => 'Please Select Users.'
        ]);
        $reqData = $request->all();

        $brand = Notification::findOrFail($id);
        $brand->update($reqData);
        \Log::info('Notification having id '. $id.' Updated');
        return redirect()->route('notification.index')->with('success', 'Notification updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Notification::find($id)->delete();
        \Log::info('Notification having id '. $id.' Deleted');
        return response()->json(['success' => true, 'message' => 'Notification deleted successfully']);
    }

    /**
     * Change status of specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($id, Request $request)
    {
        $brand = Notification::findOrFail($id);
        $brand->update(['status' => $request->status]);
        \Log::info('Notification having id '. $id.' Updated status to '.$request->status);
        return response()->json(['success' => true, 'message' => 'Notification status changed successfully']);
    }

}
