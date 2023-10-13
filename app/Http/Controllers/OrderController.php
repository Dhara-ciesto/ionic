<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\DispatchOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prod = Order::latest()->first();
        // dd($prod->products);
        return view('order.index');
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
        $query = Order::with('orderBy')->groupBy('order_by')->WhereHas('orderBy', function ($q) use ($request) {
            $q->where('deleted_at','=',NULL);
        });
      
        $query->when($search, function ($q) use ($filter, $i) {
            foreach ($filter as $key => $item) {
                if ($key == 'order_by.name') {
                    $q->whereHas('orderBy', function ($c) use ($item) {
                        $c->where('name', 'like', '%' . $item . '%');
                    });
                } else {
                    $q->where($key, 'Like', '%' . $item . '%');
                }
            }
        });

        $count =  $query->count();
        $row = $query->when($offset, function ($q) use ($offset) {
            $q->offset($offset);
        })->when($limit, function ($q) use ($limit) {
            $q->limit($limit);
        })->orderBy('created_at','DESC')->get()->toArray();
        $index = $offset + 1;
        $data = [];
        foreach ($row as $key => $item) {
            $row[$key]['counter'] = $index++;
            $row[$key]['checkbox'] = '<input type="checkbox" class="sub_chk" data-id="' . $row[$key]['id'] . '">';
            $row[$key]['created_at'] =  date('d-m-Y h:i a', strtotime($row[$key]['created_at']));
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
        $data['products'] = Product::where('status', 'Active')->get()->all();
        return view('order.create', $data);
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
            // 'product' => 'required',
            'buyer_name' => 'required',
            'village_name' => 'required',
            'car_no' => 'required',
            'transport_name' => 'required',
            'date' => 'required',
            // 'qty' => 'required|numeric'
        ]);

        $reqData = $request->all();
        // dd($reqData);
        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $avatarPath = public_path('/images/product');
            $photo->move($avatarPath, $filename);
            $reqData['file'] = '/images/product/' . $filename;
        }

        // $reqData['product'] =  implode(",",$reqData['group-a']['product']);
        unset($reqData['_token'], $reqData['photo'], $reqData['group-a']);
        $reqData['order_by'] =  Auth::user()->id;

        $order = Order::create($reqData);
        $qty = 0;
        if ($request->get('group-a')) {
            foreach ($request->get('group-a') as $key => $value) {
                $prod_ids[] = $value['product'];
                $qty += $value['qty'];
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $value['product'],
                    'rate' => $value['rate'],
                    'mrp' => $value['mrp'],
                    'qty' => $value['qty'],
                ]);
            }
            $order->product = implode(",", $prod_ids);
            $order->qty = $qty;
            $order->save();
        }

        Log::info('Estimate Created');
        return redirect()->route('order.index')->with('success', 'Estimate created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['order'] = Order::findOrFail($id);
        $user_id = $data['order']->order_by;
        $data['orders'] =  Order::with([
            'products' => fn ($query) => $query->orderBy('status','DESC')
        ])->where('order_by', $user_id)->orderBy('id','DESC')->get();
        return view('order.show', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        App::setLocale('gu');
        $data['order'] = Order::findOrFail($id);
        // dd(__('message.welcome'));
        // dd( $data['order']->products);
        // $pdf = Pdf::loadView('product.print', $data);
        // return $pdf->download('estimate.pdf');
        // App::setLocale('en');
        return view('product.print', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['brands'] = OrderBrand::where('status', 'Active')->get()->all();
        $data['fragrence_tones'] = FragranceTone::get()->all();
        $data['units'] = Unit::get()->all();
        $data['scent_types'] = ScentType::get()->all();
        $data['campaigns'] = Campaign::get()->all();
        $data['product'] = Order::findOrFail($id);
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
        $product = Order::findOrFail($id);
        unset($reqData['photo']);
        $product->update($reqData);
        \Log::info('Order having id ' . $id . ' Updated');
        return redirect()->route('product.index')->with('success', 'Order updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addDetails(Request $request)
    {
        $request->validate([
            'lr_no' => 'required',
            'receipt_image' => 'image|max:5120'

        ], [
            'lr_no.required' => 'The LR number field is required',
            'receipt_image.max' => 'The receipt image may not be greater than 5 MB'
        ]);
        $order = Order::find($request->order_id);
        $order->lr_no = $request->lr_no;
        $reqData = '';
        if ($request->file('receipt_image')) {
            $photo = $request->file('receipt_image');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $avatarPath = public_path('/images/product');
            $photo->move($avatarPath, $filename);
            $reqData = '/images/product/' . $filename;
        }
        $order->receipt_image = $reqData;
        $order->save();
        \Log::info('Order having id ' . $order->id . ' Added Details');
        return response()->json(['success' => true, 'message' => 'Order details addedd successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::find($id)->delete();
        // Order::withTrashed()->find(4)->restore();
        \Log::info('Order having id ' . $id . ' Deleted');
        return response()->json(['success' => true, 'message' => 'Order deleted successfully']);
    }

    /**
     * Change status of specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($id, Request $request)
    {
        $brand = Order::findOrFail($id);
        $brand->update(['status' => $request->status]);
        \Log::info('Order having id ' . $id . ' Updated status to ' . $request->status);
        return response()->json(['success' => true, 'message' => 'Order status changed successfully']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroySelected(Request $request)
    {
        $ids = $request->ids;
        Order::whereIn('id', explode(",", $ids))->delete();
        \Log::info('Order with ids ' . $request->ids . ' Deleted ');
        return response()->json(['success' => "Orders Deleted successfully."]);
    }

    public function dispatchOrder(Request $request)
    {
        // dd($request->all());
        $validation_rules = array();

        $validation_rules = array_merge($validation_rules, [
            'product' => 'required',
            'lr_no' => 'required',
            'receipt_image' => 'image|max:5120',
        ]);

        $product_id_exist = 0;
        if ($request->product) {
            foreach ($request->product as $key => $value) {
                if (isset($value['product_id']) && $value['product_id']  > 0) {
                    $product_id_exist = 1;
                    $validation_rules = array_merge($validation_rules, ['product.' . $key . '.cartoon' => 'required']);
                }
            }
        }
        $validator = Validator::make(
            $request->all(),
            $validation_rules,
            [
                    'lr_no.required' => 'The LR number field is required',
                    'product.*.cartoon.required' => 'The cartoon field is required',]
        );
        if (!$product_id_exist) {
            $validator->after(function ($validator) {
                $validator->errors()->add('product', 'Please Select atleast one product');
            });
        }

        $validator->validate();

        if ($validator->fails()) {
            return response()->json()
                ->withErrors($validator)
                ->withInput();
        }
        $order = OrderProduct::where('order_id', $request->order_id)
            ->where('product_id', $request->product_id)
            ->where('status', 'InProcess')->get()->all();

        if ($request->product) {
            $reqData = '';
            if ($request->file('receipt_image')) {
                $photo = $request->file('receipt_image');
                $filename = time() . '.' . $photo->getClientOriginalExtension();
                $avatarPath = public_path('/images/product');
                $photo->move($avatarPath, $filename);
                $reqData = '/images/product/' . $filename;
            }
            foreach ($request->product as $key => $value) {
                // dd($value);
                if (isset($value['product_id']) && isset($value['cartoon'])) {

                    $order_product = OrderProduct::where('order_id', $request->order_id)
                        ->where('product_id', $value['product_id'])
                        ->where('status', 'InProcess')->get()->first();
                    // dd( $order_product );
                    if ($order_product && $order_product->cartoon >= $value['cartoon']) {

                        $dispatch = DispatchOrder::create([
                            'lr_no' => $request->lr_no,
                            'order_id' => $request->order_id,
                            'product_id' => $value['product_id'],
                            'order_product_id' => $order_product->id,
                            'cartoon' => $value['cartoon'],
                            'status' => 'Dispatched',
                        ]);


                        $dispatch->receipt_image = $reqData;
                        $dispatch->save();

                        $cartoon = DispatchOrder::where('order_id', $request->order_id)->where('product_id', $value['product_id'])->sum('cartoon');
                        if ($cartoon >=  $order_product->cartoon) {
                            $order_product->status = 'Dispatched';
                            $order_product->save();
                        }
                    }
                }
            }

            $order_product_open = OrderProduct::where('order_id', $request->order_id)
                ->where('status', 'InProcess')->get()->count();

            if (!$order_product_open) {
                $order = Order::where('id', $request->order_id)->get()->first();
                $order->status = 'Dispatched';
                $order->save();
            }

            return response()->json(['success' => true, 'message' => 'Order dispatched successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Product not found']);
        }
    }

    public function getOrder(Request $request)
    {
        $order = OrderProduct::with('dispatch_product', 'product')
            ->where('order_id', $request->order_id)
            ->where('status', 'InProcess')->get()->all();
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'No order found']);
        }
        // dd($order[0]->products[0]->product->category);
        return response()->json(['success' => true, 'data' => $order]);
    }
}
