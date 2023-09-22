<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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
        $query = Order::where('id', '>', 0);
        if (Auth::user()->id != 1) {
            $query->where('status', 'Active');
        }
        $query->when($search, function ($q) use ($filter, $i) {
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
                    $q->where($key, 'Like', '%' . $item . '%');
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
        $data['product'] = Order::findOrFail($id);
        return view('product.show', $data);
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
    public function destroy($id)
    {
        Order::find($id)->delete();
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
}
