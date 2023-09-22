<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Bakery;
use App\Models\Franchise;
use App\Models\Kitchen;
use App\Models\OrderChild;
use App\Models\OrderMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FranchiseController extends Controller
{
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'mobile_no' => 'required',
            'password'  => 'required',
        ]);
        // return $validation->fails();
        if($validation->fails()) {
            return response()->json(['success' => false, 'message' => $validation->errors()]);
        } else {
            $franchise = Franchise::where([['mobile_no', $request->mobile_no]])->first();
            if(!$franchise || !Hash::check($request->password, $franchise->password)) {
                return response()
                    ->json(['success' => false, 'message' => 'Unauthorized'], 200);
            }
            $token = $franchise->createToken('auth_token')->plainTextToken;
            return response()->json(['success' => true, 'message' => 'Login successfully', 'access_token' => $token, 'token_type' => 'Bearer',]);
        }
    }

    public function changePassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'old_password' => 'required',
            'password'     => 'required|confirmed',
        ]);
        if($validation->fails()) {
            return response()->json(['success' => false, 'message' => $validation->errors()], 200);
        } else {
            $user = Franchise::find(Auth::user()->id);
            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json(['success' => false, 'message' => ['old_password' => 'Old password not match'] ], 200);
            }
            $data['password'] = Hash::make($request->password);
            $user->update($data);
            return response()->json(['success' => true, 'message' => 'Password successfully changed'], 200);
        }
    }

    public function updateProfile(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'mobile_no'      => 'required|digits:10|unique:franchises,mobile_no,' .Auth::user()->id,
            'franchise_name' => 'required',
            'city_id'        => 'required',
            'area_id'        => 'required',
            'address'        => 'required',
            'pincode'        => 'required|numeric',
            'phone_no'       => 'required|digits:10',
            'password'       => 'nullable|min:6|confirmed',
        ]);
        if ($validation->fails()) {
            return response()->json(['success' => false, 'message' => $validation->errors()], 200);
        }
        $allData = $request->all();
        $franchise = Franchise::find(Auth::user()->id);
        if(isset($allData['franchise_code'])) {
            unset($allData['franchise_code']);
        }
        $franchise->update($allData);
        return response()->json(['success' => true, 'message' => 'Profile updated successfully'], 200);
    }

    public function orderHistory(Request $request)
    {
        $orderMasters = OrderMaster::with('orderChild')->where('franchise_id', Auth::user()->id)->latest()->get();
        $mainDataArray = [];
        foreach ($orderMasters as $master_key => $orderMaster) {
            $mainDataArray[$master_key]['id']          = $orderMaster->id;
            $mainDataArray[$master_key]['order_no']    = $orderMaster->order_no;
            $mainDataArray[$master_key]['order_type']  = $orderMaster->orderChild ? $orderMaster->orderChild[0]->item_type : '';
            $mainDataArray[$master_key]['order_date']  = Carbon::parse($orderMaster->created_at)->format('jS M Y h:ia');
            $mainDataArray[$master_key]['total_price'] = $orderMaster->total_price;

            if($orderMaster->orderChild) {
                foreach ($orderMaster->orderChild as $child_key => $orderChild) {
                    $mainDataArray[$master_key]['details'][$child_key]['quantity']  = $orderChild->quantity;
                    $mainDataArray[$master_key]['details'][$child_key]['type'] = $orderChild->item_type;
                    if($orderChild->item_type == 'kitchen') {
                        $mainDataArray[$master_key]['details'][$child_key]['item_name'] = $orderChild->kitchen ? $orderChild->kitchen->name : '';
                    } else {
                        $mainDataArray[$master_key]['details'][$child_key]['item_name'] = $orderChild->bakery ? $orderChild->bakery->name : '';
                    }
                    $mainDataArray[$master_key]['details'][$child_key]['price']     = $orderChild->price;
                    $mainDataArray[$master_key]['details'][$child_key]['id']        = $orderChild->id;
                }
            }
        }
        return response()->json(['success' => true, 'message' => '', 'data' => $mainDataArray]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $unique_code =  rand(11111, 999999);
        $d = json_decode($request->items, true);
        $total_price = 0;
        foreach ($d as $item) {
            if($item['item_type'] == 'bakery') {
                $bakery = Bakery::where('status', 1)->find($item['item_id']);
                if($bakery) {
                    $total_price += $bakery->price * $item['quantity'];
                }
            } else if($item['item_type'] == 'kitchen') {
                $kitchen = Kitchen::where('status', 1)->find($item['item_id']);
                if($kitchen) {
                    $total_price += $kitchen->price * $item['quantity'];
                }
            }
        }
        $orderMasterData = [
            'franchise_id' => auth()->user()->id,
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
            'order_no' => $unique_code,
            'total_price' => $total_price
        ];
        // return $orderMasterData;
        $orderMaster = OrderMaster::create($orderMasterData);

        foreach ($d as $item) {
            $orderChildData = [
                'order_master_id' => $orderMaster->id,
                'item_id' => $item['item_id'],
                'item_type' => $item['item_type'],
                'quantity' => $item['quantity'],
            ];
            if ($item['item_type'] == 'bakery') {
                $bakery = Bakery::where('status', 1)->find($item['item_id']);
                if ($bakery) {
                    // $orderChildData['price'] = $bakery->price * $item['quantity'];
                    $orderChildData['price'] = $bakery->price;
                }
            } else if ($item['item_type'] == 'kitchen') {
                $kitchen = Kitchen::where('status', 1)->find($item['item_id']);
                if ($kitchen) {
                    // $orderChildData['price'] = $kitchen->price * $item['quantity'];
                    $orderChildData['price'] = $kitchen->price;
                }
            }
            OrderChild::create($orderChildData);
        }
        // return json_decode(stripslashes($request->items));
        return response()->json(['success' => true, 'message' => 'Order placed successfully', 'data' => []]);
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
