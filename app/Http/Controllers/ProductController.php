<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\ScentType;
use Illuminate\Http\Request;
use App\Models\FragranceTone;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
        $query = Product::with(['category'])
            ->when($search, function ($q) use ($filter, $i) {
                foreach ($filter as $key => $item) {
                    if ($key == 'category.name') {
                        $q->whereHas('category', function ($c) use ($item) {
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
                        $q->where($key, 'Like', '%' . $item . '%');
                    }
                }
            })->when($sort, function ($q1) use ($sort, $order) {
                if ($sort == 'category.name') {
                    $q1->orderBy('category_id', $order);
                } elseif ($sort == 'counter') {
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
            $row[$key]['file'] = "<img src='" . $item['file'] . "' height='50' width='50' onerror=this.src='".asset("/images/placeholder.png")."'>";
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
        $data['categories'] = Category::where('status', 'Active')->get()->all();
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
            'product_name' => 'required',
            'photo' => 'required|image|max:5120',
            'category_id' => 'required|numeric',
            'size' => 'required',
            Rule::unique('products')->where(function ($query) use($request) {
                return $query->where('size', $request->size)->where('finish',$request->finish);
            }),

        ],['product_name.unique' => 'The product name has already been taken with same size and finish.']);

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
        $data['categories'] = Category::where('status', 'Active')->get()->all();

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
            // 'product_name' => 'required|unique:products,product_name,' . $id,
            'category_id' => 'required|numeric',
            'photo' => 'image|max:5120',
            'product_name' => [
                'required', 'max:255',
                Rule::unique('products')->ignore($id)->where(function ($query) use($request) {
                    return $query->where('size', $request->size)->where('finish',$request->finish);
                }),
            ],

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
        \Log::info('Product having id ' . $id . ' Updated');
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
        $product = Product::find($id);
        $category_id = $product->category_id;
        $product->delete();
        \Log::info('Product having id ' . $id . ' Deleted');
        $prod_count = Product::where('category_id',$category_id)->get()->count();
        if(!$prod_count){
            Category::find($category_id)->delete();
            \Log::info('Category having id ' . $category_id . ' Deleted due to no product on that category');
        }
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
        \Log::info('Product having id ' . $id . ' Updated status to ' . $request->status);
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
        \Log::info('Product with ids ' . $request->ids . ' Deleted ');
        return response()->json(['success' => "Products Deleted successfully."]);
    }


    public function import(Request $request)
    {
        // dd(request()->file('products'));
        $file = request()->file('products');
        $file = fopen($file, "r");
        $all_products = [];
        $i = 0;
        while (($data = fgetcsv($file, 2000, ",")) !== FALSE) {

            if ($i > 0) {

                $exist_product = Product::where('product_name', 'Like', $data[1])
                ->where('size', 'Like', $data[3])->where('finish',$data[4])->pluck('id')->first();
                // dump($data[1]);
                // dd( $exist_product);
                $category_id = Category::where('name', 'Like', $data[0])->pluck('id')->first();
                $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];
                if($data[2]){

                    $explodeImage = explode('.',  $data[2]);
                    $extension = end($explodeImage);
                }
                if (!($data[0] && $data[1] && $data[3])) {
                    $all_products[$i]['product'] = $data[1];
                    $all_products[$i]['error'] = 'Incomplete Data';
                } else if($data[2] && !in_array($extension, $imageExtensions)){
                    $all_products[$i]['product'] = $data[1];
                    $all_products[$i]['error'] = 'Product image file must be a image';
                } else if (!$category_id) {
                    $all_products[$i]['product'] = $data[1];
                    $all_products[$i]['error'] = 'Category Does not match';
                } elseif ($exist_product) {

                    $all_products[$i]['product'] = $data[1];
                    $all_products[$i]['error'] = 'Product name already exist';
                } else {

                    Product::create([
                        'category_id' => $category_id,
                        'product_name' => $data[1],
                        'file' => $data[2],
                        'cartoon' => 1,
                        'qty' => 1,
                        'size' => $data[3],
                        'finish' => $data[4],
                        'pcs' => $data[5] ? $data[5] : 1,
                        'box' => $data[6] ? $data[6] : 1,
                    ]);
                }
            }
            $i++;
        }
        // dd($all_products);
        if ($all_products) {
            Session::put('all_products', $all_products);
            return redirect()->route('import.product.success')->with(["all_products" => $all_products, 'msg' => __("Products Imported successfully")]);
        } else {
            Session::forget('all_products');
            return redirect()->route('product.index')->with("success", __("Products Imported successfully"));
        }

        // try {
        //     //code...
        //     Excel::import(new ProductImport, request()->file('products')->store('temp'));
        // } catch (\Exception $e){
        //     Log::error($e->getMessage());
        //     return redirect()->route('product.index')->with("error",$e->getMessage());
        // }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function demoexport(Request $request)
    {
        return Excel::download(new ProductExport, 'product.csv');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function importSuccess(Request $request)
    {
        $data['all_products'] = Session::get('all_products');
        return view('product.importsuccess', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showimport()
    {
        return view('product.import');
    }
}
