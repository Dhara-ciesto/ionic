<?php

namespace App\Http\Controllers\api;

use App\Models\OTP;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;

class AuthController extends Controller
{
    //this method adds new users

    public function register(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'business_name' => 'required|unique:users,username|max:255',
            'whatsapp_no' => 'required|unique:users,whatsapp_no|digits:10'
        ],[
            'business_name.required' => 'The Business name is required',
            'business_name.max' => 'The Business name can not more than25 character',
            'business_name.unique' => 'The Business name is already been taken'
        ]);
        // Return errors if validation error occur.
        if ($validator->fails()) {
            $errors = $validator->errors();
            // return response()->json(['status' => '0', 'message' => $validator->messages()->first()]);
            return response()->json([
                'success' => false,
                'message' => $validator->messages()->first()
            ], 200);
        }
        // Check if validation pass then create user and auth token. Return the auth token
        if ($validator->passes()) {
            $user = User::create([
                'name' => $request->full_name,
                'username' => $request->business_name,
                'email' => $request->whatsapp_no . '@mailinator.com',
                'whatsapp_no' => $request->whatsapp_no,
                'password' => Hash::make('123456789')
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }
    }



    public function sendotp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'whatsapp_no' => 'required|unique:users,whatsapp_no|digits:10'
        ],[
            'whatsapp_no.required' => 'The Whatsapp No is required',
            'whatsapp_no.digits' => 'The Whatsapp No must be digit',
            'whatsapp_no.unique' => 'The Whatsapp No is already been taken'
        ]);
        // Return errors if validation error occur.
        if ($validator->fails()) {
            $errors = $validator->errors();
            // return response()->json(['status' => '0', 'message' => $validator->messages()->first()]);
            return response()->json([
                'message' => $validator->messages()->first()
            ], 200);
        }


        $otp = OTP::create([
            'otp' => rand(111111, 999999),
            'whatsapp_no' => $request->whatsapp_no,
        ]);
        $msg = urlencode("Dear, Your OTP for registration is $otp->otp");
        $number = $request->whatsapp_no;
        $client = new Client();
        $d = new Psr7Request('GET', "http://waw.vr4creativity.com/wapp/api/send?apikey=d82c7bbb589046c9aed04518f78ae45a&mobile=$number&msg=$msg");
        $res = $client->sendAsync($d)->wait();
        return response()->json([
            // 'otp' => $otp->otp,
            'message' => 'OTP Sent'
        ]);

    }

    public function otpverify(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'whatsapp_no' => 'required',
            'otp' => 'required'

        ],[
            'whatsapp_no.required' => 'The Whatsapp No is required',
            'otp.required' => 'The OTP is required',
        ]);
        // Return errors if validation error occur.
        if ($validator->fails()) {
            $errors = $validator->errors();
            // return response()->json(['status' => '0', 'message' => $validator->messages()->first()]);
            return response()->json([
                'message' => $validator->messages()->first()
            ], 200);
        }


        $otp = OTP::where('whatsapp_no', $request->whatsapp_no)->where('otp', $request->otp)->where('status', 'Active')->first();
        if ($otp) {

            $user = User::where('whatsapp_no', $request->whatsapp_no)->get()->first();
            if (!Auth::loginUsingId($user->id)) {
                return response()->json([
                    'message' => 'Invalid login details'
                ], 401);
            }
            $token = $user->createToken('auth_token')->plainTextToken;
            $otp->status = 'Deactive';
            $otp->save();
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'OTP Invalid'
            ]);
        }
    }
    //use this method to signin users
    // public function loginUser(Request $request)
    // {
    //     if (!Auth::attempt($request->only('email', 'password'))) {
    //         return response()->json([
    //             'message' => 'Invalid login details'
    //         ], 401);
    //     }
    //     $user = User::where('email', $request['email'])->firstOrFail();
    //     $token = $user->createToken('auth_token')->plainTextToken;
    //     // return auth()->user();
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'Bearer',
    //     ]);
    // }


    public function updateProfile(Request $request, $id)
    {

        $request->validate([
            'full_name' => 'required|string|max:255',
            'business_name' => 'required|max:255|unique:users,username,' . $id,
            'whatsapp_no' => 'required|digits:10|unique:users,whatsapp_no,' . $id,
        ], [
            'business_name.required' => 'The Business name is required',
            'business_name.max' => 'The Business name can not more than25 character',
            'business_name.unique' => 'The Business name is already been taken'
        ]);


        $user = User::findOrFail($id);
        $user->name = $request->full_name;
        $user->username = $request->business_name;
        if ($request->whatsapp_no) {
            $user->email = $request->whatsapp_no . '@mailinator.com';
        }
        $user->whatsapp_no = $request->whatsapp_no;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile Updated Successfully'
        ]);
    }


    // this method signs out users by removing tokens
    public function signout()
    {
        auth()->user()->tokens()->delete();

        return [
            'success' => true,
            'message' => 'Tokens Revoked'
        ];
    }
}
