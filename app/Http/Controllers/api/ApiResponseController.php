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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ApiResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('status', 'Active')->get();
        return response()->json(['success' => true, 'message' => '', 'data' => $products]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProduct($id)
    {
        $product = Product::with(['scent_type', 'product_brand', 'fragrance_tone_1', 'campaign'])->findOrFail($id);
        return response()->json(['success' => true, 'message' => '', 'data' => $product]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProducts($product_ids)
    {
        $product_ids =  explode(',', $product_ids);
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
        $categories = Category::get();
        return response()->json(['success' => true, 'message' => '', 'data' => $categories]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required',
            'size' => 'required'
        ]);
        $cart = Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'cartoon' => $request->cartoon,
            'size' => $request->size,
            'length' => $request->length,
            'details' => $request->details,
            'status' => 'Active'
        ]);
        return response()->json(['success' => true, 'message' => 'Product Added to cart']);
    }

    /**
     * Update a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editCartItem(Request $request,$id)
    {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required',
            'size' => 'required'
        ]);
        $brand = Cart::findOrFail($id);
        $brand->update($request->all());
        return response()->json(['success' => true, 'message' => 'Product Updated in cart successfully']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getcart(Request $request)
    {
        $carts = Cart::with('product')->where('user_id',Auth::user()->id)->get()->all();
        if(!$carts){
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

        $order = Order::create([
            'order_id'=> rand(111111111,999999999),
            'cart_id' => $request->cart_id,
            'qty' => $request->total_qty,
            'order_by' => Auth::user()->id,
            'status' => 'Pending'
        ]);
        return response()->json(['success' => true, 'message' => 'Order Created successfully', 'data' => $order]);
    }

 
}
