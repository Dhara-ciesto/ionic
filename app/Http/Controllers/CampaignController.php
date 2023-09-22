<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('campaign.index');
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
        $query = Campaign::when($search, function ($q) use ($filter, $i) {
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
        return view('campaign.create');
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
            'name' => 'required|unique:campaigns,name',
            'start_date' => 'date',
            'end_date' => 'date',
        ],[ 
            'name.required' => 'Please Enter Campaign name',
            'name.unique' => 'Campaign name has already been taken.'
        ]);
        Campaign::create($request->all());
        \Log::info('Campaign Created');
        return redirect()->route('campaign.index')->with('success', 'Campaign created successfully');
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
        $data['campaign'] = Campaign::findOrFail($id);
        return view('campaign.edit', $data);
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
            'name' => 'required|unique:campaigns,name,'.$id
        ],[ 
            'name.required' => 'Please Enter Campaign name',
            'name.unique' => 'Campaign name has already been taken'
        ]);
        $reqData = $request->all();

        $brand = Campaign::findOrFail($id);
        $brand->update($reqData);
        \Log::info('Campaign having id '. $id.' Updated');
        return redirect()->route('campaign.index')->with('success', 'Campaign updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Campaign::find($id)->delete();
        \Log::info('Campaign having id '. $id.' Deleted');
        return response()->json(['success' => true, 'message' => 'Campaign deleted successfully']);
    }

    /**
     * Change status of specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($id, Request $request)
    {
        $brand = Campaign::findOrFail($id);
        $brand->update(['status' => $request->status]);
        \Log::info('Campaign having id '. $id.' Updated status to '.$request->status);
        return response()->json(['success' => true, 'message' => 'Campaign status changed successfully']);
    }
}
