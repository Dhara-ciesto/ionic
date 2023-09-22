<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Campaign;
use App\Models\ScentType;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use App\Models\FragranceTone;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
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
        $query = Product::with(['product_brand', 'fragrance_tone_1', 'fragrance_tone_2', 'scent_type', 'campaign'])
            ->when($search, function ($q) use ($filter, $i) {
                foreach ($filter as $key => $item) {
                    if ($key == 'product_brand.name') {
                        $q->whereHas('product_brand', function ($c) use ($item) {
                            $c->where('name', 'like', '%' . $item . '%');
                        });
                    // } else if ($key == 'scent_type.name') {
                    //     $q->whereHas('scent_type', function ($c) use ($item) {
                    //         $c->where('name', 'like', '%' . $item . '%');
                    //     });
                    // } else if ($key == 'fragrance_tone_1.name') {
                    //     $q->whereHas('fragrance_tone_1', function ($c) use ($item) {
                    //         $c->where('name', 'like', '%' . $item . '%');
                    //     });
                    // } else if ($key == 'campaign.name') {
                    //     $q->whereHas('campaign', function ($c) use ($item) {
                    //         $c->where('name', 'like', '%' . $item . '%');
                    //     });
                    } else {
                        $q->where($key,'Like', '%'.$item.'%');
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
            $row[$key]['checkbox'] = '<input type="checkbox" class="sub_chk" data-id="' . $row[$key]['id'] . '">';
            // $row[$key]['qty'] =  $row[$key]['size'];
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
        $data['brands'] = ProductBrand::where('status', 'Active')->get()->all();
        $data['fragrence_tones'] = FragranceTone::get()->all();
        $data['units'] = Unit::get()->all();
        $data['scent_types'] = ScentType::get()->all();
        $data['campaigns'] = Campaign::get()->all();
        return view('product.create', $data);
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
            'product_name' => 'required|unique:products,product_name',
            'qty' => 'required|numeric',
            'price' => 'required|numeric'

        ]);

        $reqData = $request->all();

        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $avatarPath = public_path('/images/product');
            $photo->move($avatarPath, $filename);
            $reqData['file'] = '/images/product/' . $filename;
        }
        unset($reqData['_token'], $reqData['photo']);

        Product::create($reqData);
        Log::info('Product Created');
        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['product'] = Product::findOrFail($id);
        return view('product.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['brands'] = ProductBrand::where('status', 'Active')->get()->all();
        $data['fragrence_tones'] = FragranceTone::get()->all();
        $data['units'] = Unit::get()->all();
        $data['scent_types'] = ScentType::get()->all();
        $data['campaigns'] = Campaign::get()->all();
        $data['product'] = Product::findOrFail($id);
        return view('product.edit', $data);
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
            'product_name' => 'required|unique:products,product_name,' . $id,
            'qty' => 'required|numeric'

        ]);
        $reqData = $request->all();
        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $avatarPath = public_path('/images/product');
            $photo->move($avatarPath, $filename);
            $reqData['file'] = '/images/product/' . $filename;
        }
        $product = Product::findOrFail($id);
        unset($reqData['photo']);
        $product->update($reqData);
        \Log::info('Product having id '. $id. ' Updated');
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        \Log::info('Product having id '. $id .' Deleted');
        return response()->json(['success' => true, 'message' => 'Product deleted successfully']);
    }

    /**
     * Change status of specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($id, Request $request)
    {
        $brand = Product::findOrFail($id);
        $brand->update(['status' => $request->status]);
        \Log::info('Product having id '. $id.' Updated status to '.$request->status);
        return response()->json(['success' => true, 'message' => 'Product status changed successfully']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroySelected(Request $request)
    {
        $ids = $request->ids;
        Product::whereIn('id', explode(",", $ids))->delete();
        \Log::info('Product with ids '. $request->ids .' Deleted ');
        return response()->json(['success' => "Products Deleted successfully."]);
    }
}
