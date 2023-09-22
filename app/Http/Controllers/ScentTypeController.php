<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScentType;


class ScentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('scent_types.index');
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
        $query = ScentType::when($search, function ($q) use ($filter, $i) {
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
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('scent_types.create');
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
            'name' =>  'required|unique:scent_types,name',
        ],[ 
            'name.required' => 'Please Enter Scent Type name',
            'name.unique' => 'Product ScentType has already been taken.'
        ]);
        ScentType::create($request->all());
        \Log::info('Scent Type Created');
        return redirect()->route('scent_types.index')->with('success', 'Scent Type created successfully');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['scent_type'] = ScentType::findOrFail($id);
        return view('scent_types.edit', $data);
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
            'name' => 'required|unique:scent_types,name,'.$id,
        ],[ 
            'name.required' => 'Please Enter Scent Type name',
            'name.unique' => 'Product ScentType has already been taken.'
        ]);
        $reqData = $request->all();

        $brand = ScentType::findOrFail($id);
        $brand->update($reqData);
        \Log::info('Scent Type having id '. $id.' Updated');
        return redirect()->route('scent_types.index')->with('success', 'Scent Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ScentType::find($id)->delete();
        \Log::info('Scent Type having id '. $id.' Deleted');
        return response()->json(['success' => true, 'message' => 'Scent Type deleted successfully']);
    }
}
