<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Client;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('city.index');
    }

    public function logsServerSideOwn(Request $request)
    {
        // dd($request->all());
        $search = $request->filter;
        $filter = (array)json_decode($search);
        $sort = $request->sort;
        $order = $request->order;
        $offset = $request->offset;
        $limit = $request->limit;
        $i = 1;

        // your table name 
        $query = City::when($search, function ($q) use ($filter, $i) {
            foreach ($filter as $key => $item) {
                if ($key == 'status') {
                    if (strtolower($item) == 'active') {
                        $q->where($key, 1);
                    } else {
                        $q->where($key, 0);
                    }
                } else {
                    $q->where($key, $item);
                }
            }
        })->when($sort, function ($q1) use ($sort, $order) {
            if($sort == 'counter') {
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
            if ($item['status'] == 1) {
                $row[$key]['status'] = 'Active';
            } else if ($item['status'] == 0) {
                $row[$key]['status'] = 'Deactive';
            }
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
        return view('city.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required',
        ]);
        City::create($request->all());
        return redirect()->route('city.index')->with('success', 'City created successfully');
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
        $data['user'] = City::findOrFail($id);
        return view('city.edit', $data);
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
            'name' => 'required'
        ]);
        $reqData = $request->all();

        // dd($reqData);
        $user = City::findOrFail($id);
        $user->update($reqData);
        return redirect()->route('city.index')->with('success', 'City updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        City::find($id)->delete();
        return response()->json(['success' => true, 'message' => 'City deleted successfully']);
    }
}
