<?php

namespace App\Http\Controllers\api;

use App\Models\Cart;
use App\Models\Order;
use App\Mail\LaraEmail;
use App\Models\Product;
use App\Models\Category;
use App\Models\EmailConfig;
use Illuminate\Http\Request;
use App\Models\FragranceTone;
use App\Http\Controllers\Controller;
use App\Models\DispatchOrder;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ApiResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id = null)
    {
        $products =[];
        if($category_id){
            $products = Product::where('category_id',$category_id)->where('status', 'Active')->get();
        }else{
            $products = Product::where('status', 'Active')->get();
        }
        return response()->json(['success' => true, 'message' => '', 'data' => $products]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'size' => 'required',
            'finish' => 'required',
            'productname' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->messages()->first()
            ], 200);
        }
        $product = Product::where('product_name',$request->productname)->where('size', $request->size)->where('finish', $request->finish)->get()->first();
        if($product){
            return response()->json(['success' => true, 'message' => '', 'data' => $product]);
        }else{
            return response()->json(['success' => false, 'message' => 'No product found', 'data' => '']);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProducts($product_ids)
    {
        $product_ids = explode(',', $product_ids);
        $products = Product::with(['category'])->whereIn('id', $product_ids)->get();
        return response()->json(['success' => true, 'message' => '', 'data' => $products]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategories()
    {
        $categories = Category::withCount('products')->get();
        return response()->json(['success' => true, 'message' => '', 'data' => $categories]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'qty' => 'required|numeric',
            'cartoon' => 'required|numeric',
            'size' => 'required'
        ],[
            'product_id.required' => 'The product field is required',
            'qty.required' => 'The quantity field is required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                // sept month ma me only 2 days ni j leave lidhi hti every month ma 1 day leave paid hoi so..
                'success' => false,
                'message' => $validator->messages()->first()
            ], 200);
        }

        $cart = Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'cartoon' => $request->cartoon,
            'size' => $request->size,
            'finish' => $request->finish,
            // 'details' => $request->details,
            'status' => 'Active'
        ]);
        return response()->json(['success' => true, 'message' => 'Product Added to cart']);
    }

    /**
     * Update a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editCartItem(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'qty' => 'required',
            'size' => 'required'
        ],[
            'product_id.required' => 'The product field is required',
            'qty.required' => 'The quantity field is required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->messages()->first()
            ], 200);
        }

        $cart = Cart::findOrFail($id);
        $cart->update($request->all());
        return response()->json(['success' => true, 'message' => 'Product Updated in cart successfully']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getcart(Request $request)
    {
        $carts = Cart::with('product.category')
            ->where('user_id', Auth::user()->id)->where('status', 'Active')->get()->all();
        if (!$carts) {
            return response()->json(['success' => false, 'msg' => 'No cart items found']);
        }
        return response()->json(['success' => true, 'data' => $carts]);
    }

    /**
     * Create a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOrder(Request $request)
    {
        $carts = Cart::where('user_id', Auth::user()->id)->where('status','Active')->get()->all();
        if(!$carts){
            return response()->json(['success' => false, 'message' => 'No Products Available']);
        }
        $last_id = Order::where('id','>',0)->orderBy('id', 'DESC')->latest()->first() ? Order::where('id','>',0)->orderBy('id', 'DESC')->latest()->first()->id + 1 : 1;

        $no = str_pad($last_id, 5, "O100", STR_PAD_LEFT);
        $order = Order::create([
            'uid' => $no,
            // 'cart_id' => $request->cart_id,
            'qty' => $request->total_qty,
            'order_by' => Auth::user()->id,
            // 'description' => $request->description,
            'status' => 'Processing'
        ]);

        foreach ($carts as $key => $value) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $value->product_id,
                'qty' => $value->qty,
                'cartoon' => $value->cartoon,
                'qty' => $value->qty,
                'cart_id' => $value->id,
                'status' => 'InProcess',
            ]);
            $value->status = 'Ordered';
            $value->save();
        }
        return response()->json(['success' => true, 'message' => 'Order Created successfully', 'data' => $order]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrder($status)
    {
        if($status == 'Open' || $status == 'open'){
            $search = ['Processing'];
        }elseif($status == 'Close' || $status == 'close'){
            $search = ['Dispatched'];
        }
        $order = Order::with(['products.dispatch_product','products.product','products.product.category'])
            ->where('order_by', Auth::user()->id)->where('status', $search)->get()->all();
        if (!$order) {
            return response()->json(['success' => false,'data' => '', 'msg' => 'No order found']);
        }
        return response()->json(['success' => true, 'data' => $order,'msg' => '']);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRecentOrders(Request $request,$user_id,$status)
    {
        if($status == 'Open' || $status == 'open'){
            $search = ['Processing'];
        }elseif($status == 'Close' || $status == 'close'){
            $search = ['Dispatched'];
        }
        $order = Order::with('products.dispatch_product')
            ->where('order_by', $user_id)
           ->where('status', $search);
        if(isset($request->date)){
            $order = $order->whereDate('created_at',$request->date);
        }
        $order = $order->orderBy('id','desc')->get()->all();
        if (!$order) {
            return response()->json(['success' => false, 'msg' => 'No order found']);
        }
        // dd($order[0]->products[0]->product->category);
        return response()->json(['success' => true, 'data' => $order,'msg' => '']);
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dispatchOrder(Request $request)
    {

        $validation_rules = array();

        $validation_rules = array_merge($validation_rules, [
            'product' => 'required',
            'lr_no' => 'required',
            'receipt_image' => 'required',
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
            return response()->json([
                'success' => false,
                'message' => $validator->messages()->first()
            ], 200);
        }

        $order = OrderProduct::
            where('order_id', $request->order_id)
            ->where('product_id', $request->product_id)
            ->where('status','InProcess')->get()->all();

        if($request->product){
            $reqData = '';
            if ($request->file('receipt_image')) {
                $photo = $request->file('receipt_image');
                $filename = time() . '.' . $photo->getClientOriginalExtension();
                $avatarPath = public_path('/images/product');
                $photo->move($avatarPath, $filename);
                $reqData = '/images/product/' . $filename;
            }
            foreach ($request->product as $key => $value) {

                $order_product = OrderProduct::
                where('order_id', $request->order_id)
                ->where('product_id', $value['product_id'])
                ->where('status','InProcess')->get()->first();
                // dd( $order_product );
                if($order_product && $order_product->cartoon >= $value['cartoon']){

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
                    if($cartoon >=  $order_product->cartoon){
                        $order_product->status = 'Dispatched';
                        $order_product->save();
                    }
                }
            }

            $order_product_open = OrderProduct::
            where('order_id', $request->order_id)
            ->where('status','InProcess')->get()->count();

            if(!$order_product_open){
                $order = Order::where('id',$request->order_id)->get()->first();
                $order->status = 'Dispatched';
                $order->savE();

            }

            return response()->json(['success' => true, 'msg' => 'Order dispatched successfully']);
        }else {
            return response()->json(['success' => false, 'msg' => 'product not found']);
        }
    }

    public function getSize($id){
        $product = Product::find($id);
        if($product){

            $size = Product::where('product_name','Like', $product->product_name)
            ->orderBy('id','desc')->groupBy('size')->pluck('size')->all();
            if (!$size) {
                return response()->json(['success' => false, 'msg' => 'No order found']);
            }
        }
        // dd($order[0]->products[0]->product->category);
        return response()->json(['success' => true, 'data' => $size,'msg' => '']);
    }

    public function getFinish($id){
        $product = Product::find($id);
        if($product){

            $size = Product::where('product_name','Like', $product->product_name)
            ->orderBy('id','desc')->groupBy('finish')->pluck('finish')->all();
            if (!$size) {
                return response()->json(['success' => false, 'msg' => 'No order found']);
            }
        }
        // dd($order[0]->products[0]->product->category);
        return response()->json(['success' => true, 'data' => $size]);
    }

}
