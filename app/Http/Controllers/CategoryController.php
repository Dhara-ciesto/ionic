<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index');
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
        $query = Category::when($search, function ($q) use ($filter, $i) {
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
            if ($item['status'] == 1) {
                $row[$key]['status'] = 'Active';
            } else if ($item['status'] == 0) {
                $row[$key]['status'] = 'Deactive';
            }
            $row[$key]['image'] = '<img src="'.$item['image'].'" height="50" width="50">';
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
        return view('category.create');
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
            'name' => 'required|unique:categories,name',
            'image' => 'required',
        ],[
            'name.required' => 'Please Enter Category name',
            'name.unique' => 'Product Brand name has already been taken.'
        ]);
        $requestall = $request->all();

        if ($request->file('image')) {
            $photo = $request->file('image');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $avatarPath = public_path('/images/category');
            $photo->move($avatarPath, $filename);
            $requestall['image'] = '/images/category/' . $filename;
        }
        unset($requestall['_token']);
        Category::create($requestall);
        \Log::info('Category Created');
        return redirect()->route('product.category.index')->with('success', 'Category created successfully');
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
        $data['brand'] = Category::findOrFail($id);
        return view('category.edit', $data);
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
            'name' => 'required|unique:categories,name,' . $id,
            'image' => 'required',
        ],[
            'name.required' => 'Please Enter Product Category name',
            'name.unique' => 'Product Category name has already been taken.'
        ]);
        $reqData = $request->all();

        $brand = Category::findOrFail($id);
        if ($request->file('image')) {
            $photo = $request->file('image');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $avatarPath = public_path('/images/category');
            $photo->move($avatarPath, $filename);
            $reqData['image'] = '/images/category/' . $filename;
        }
        $brand->update($reqData);
        \Log::info('Product Category having id ' . $id . ' Updated');
        return redirect()->route('product.category.index')->with('success', 'Product category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        \Log::info('Product Category having id '. $id.' Deleted');
        return response()->json(['success' => true, 'message' => 'Product Category deleted successfully']);
    }

    /**
     * Change status of specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($id, Request $request)
    {
        $brand = Category::findOrFail($id);
        $brand->update(['status' => $request->status]);
        \Log::info('Product Category having id ' . $id . ' Staus Changed to ' . $request->status);
        return response()->json(['success' => true, 'message' => 'Category status changed successfully']);
    }

}
