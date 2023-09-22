<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Country;
use App\Models\Manager;
use App\Models\Profile;
use App\Models\Recruiter;
use App\Models\Submission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $university_file = File::get(public_path('assets/js/universities.json'));
        $city_file = File::get(public_path('assets/js/city.json'));
        $industry_file = File::get(public_path('assets/js/industry.json'));
        $university_courses_file = File::get(public_path('assets/js/university_courses.json'));
        $data['universities'] = json_decode($university_file);
        $data['cities'] = json_decode($city_file);
        $data['industries'] = json_decode($industry_file);
        $data['university_courses'] = json_decode($university_courses_file);

        $data['clients'] = Client::latest()->get();
        $data['managers'] = Manager::latest()->get();
        $data['recruiters'] = Recruiter::latest()->get();
        $data['countries'] = Country::latest()->get();

        // dd($data['countries']);
        return view('frontend.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    public function profile_listing(Request $request)
    {
        return view('submission_listing');
    }

    public function submissionAjax(Request $request)
    {
        // dd($request->all());
        $search = $request->filter;
        $filter = (array)json_decode($search);
        $sort = $request->sort;
        $order = $request->order;
        $offset = $request->offset;
        $limit = $request->limit;
        $i = 1;
        // dd($request->all());

        $query = Submission::with('country_obj', 'state_obj', 'city_obj', 'client', 'manager', 'recruiter')->when($search, function ($q) use ($filter, $i) {
            DB::enableQueryLog();
            foreach ($filter as $key => $item) {
                // dd($filter);
                if ($key == 'created_at') {
                    $temp = explode(' - ', $item);
                    
                    $sd = Carbon::createFromFormat('d-m-Y', $temp[0],)->toDateString();
                    $ed = Carbon::createFromFormat('d-m-Y', $temp[1])->toDateString();
                    $q->whereDate('created_at', '>=', $sd);
                    $q->whereDate('created_at', '<=', $ed);
                } else if($key == 'city_obj.name') {
                    $q->whereHas('city_obj', function ($c) use ($item) {
                        $c->where('name', '=', $item);
                    });
                } else if($key == 'state_obj.name') {
                    $q->whereHas('state_obj', function ($c) use ($item) {
                        $c->where('name', '=', $item);
                    });
                } else if ($key == 'country_obj.name') {
                    $q->whereHas('country_obj', function ($c) use ($item) {
                        $c->where('name', '=', $item);
                    });
                } else if ($key == 'client.name') {
                    $q->whereHas('client', function ($c) use ($item) {
                        $c->where('name', 'like', '%' . $item . '%');
                    });
                } else if ($key == 'manager.name') {
                    $q->whereHas('manager', function ($c) use ($item) {
                        $c->where('name', 'like', '%' . $item . '%');
                    });
                } else if ($key == 'recruiter.name') {
                    $q->whereHas('recruiter', function ($c) use ($item) {
                        $c->where('name', 'like', '%' . $item . '%');
                    });
                } else {
                    $q->where($key, 'like', '%' . $item . '%');
                }
            }
        })->when($sort, function ($q1) use ($sort, $order) {
            $q1->orderBy($sort, $order);
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
        foreach ($row as $key => $item) {
            $row[$key]['created_at'] = date("d-m-Y  h:i:s a", strtotime($item['created_at']));
            $row[$key]['counter'] = $index++;
        }
        $data = [];
        // dd(DB::getQueryLog());

        $data['items'] = $row;
        $data['count'] = $count;
        // dd($data);
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['submission'] = Submission::with('country_obj', 'state_obj', 'city_obj', 'client', 'manager', 'recruiter')->findOrFail($id);
       
        return view('view_submission', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->delete();
        return response()->json(['success' => true, 'message' => 'Data deleted successfully']);
    }

}
