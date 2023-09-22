<?php

namespace App\Http\Controllers\api;

use App\Mail\LaraEmail;
use App\Models\Product;
use App\Models\EmailConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FragranceTone;
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
        $product = Product::with(['scent_type','product_brand','fragrance_tone_1','campaign'])->findOrFail($id);
        return response()->json(['success' => true, 'message' => '', 'data' => $product]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProducts($product_ids)
    {
        $product_ids =  explode(',',$product_ids);
        $products = Product::with(['scent_type','product_brand','fragrance_tone_1','campaign'])->whereIn('id',$product_ids)->get();
        return response()->json(['success' => true, 'message' => '', 'data' => $products]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGenderwiseProduct($gender,$code = null)
    {
        $product = Product::with(['scent_type','product_brand','fragrance_tone_1','campaign']);
        if($gender == 'Unisex'){
        }else{
            $product->where('gender', $gender);
        }

        if($code){
            $code = utf8_decode(urldecode($code));
            $product->whereHas('fragrance_tone_1', function ($query) use ($code) {
                return $query->where('tone_binary_digit', '=', $code);
            });
        }
        $product = $product->get();
        return response()->json(['success' => true, 'message' => '', 'data' => $product]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFragRenceTone($code){
        
        if($code){
            $code = utf8_decode(urldecode($code));
            $fragrence_tone = FragranceTone::where('tone_binary_digit',$code)->first();
            return response()->json(['success' => true, 'message' => '', 'data' => $fragrence_tone]);
        }
        return response()->json(['success' => true, 'message' => '', 'data' => '']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shareFavProduct(Request $request)
    {
        if($request->sendvia == 'email'){
            $emailconfig = EmailConfig::get()->first();
            $mailInfo = new \stdClass();
            $mailInfo->recieverName = $request->name;
            $mailInfo->sender = "TIRA";
            $mailInfo->senderCompany = "TIRA";
            $mailInfo->to = $request->receiver;
            $mailInfo->subject = "TIRA : You have made an inquiry for your Favorite Products";
            $mailInfo->name = $emailconfig->mail_from_name;
            // $mailInfo->cc = "ci@email.com";
            // $mailInfo->bcc = "jim@email.com";
            $mailInfo->from = $emailconfig->mail_from_address;
            $mailInfo->title = "Favourite Products";
            $mailInfo->product_ids = $request->product_ids;
            try{
                $mail =  Mail::to($mailInfo->to)
                   ->send(new LaraEmail($mailInfo));
                return response()->json(['success' => true, 'message' => 'Mail Send', 'data' => 'Mail Send']);
            }catch(\Excception $e){
                return 'Something went wrong Check Crdentials.';
            }
        }
     
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function popupDismissAfter()
    {
        return '10';
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
