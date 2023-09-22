<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;


class AuthController extends Controller
{
    //this method adds new users
 
    public function register(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6',
        ]);
        // Return errors if validation error occur.
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => $errors
            ], 400);
        }
        // Check if validation pass then create user and auth token. Return the auth token
        if ($validator->passes()) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;
        
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }
    }

    public function sendMessage(Request $request)
    {
        // $message = "Hii";
        // $recipients = '+9173158283';
        // $account_sid = getenv("MAIL_MAILER");
        // $auth_token = getenv("TWILIO_AUTH_TOKEN");
        // $twilio_number = getenv("TWILIO_NUMBER");
        // $client = new Client('AC0cf6b0a40260fea5cff0e51ab5c360f9', '79820c4f180276c8ffb4d7f55bd35c70');
        // $message = $client->messages
        // ->create("whatsapp:9173158283", // to
        //          [
        //              "from" => "whatsapp:+14155238886",
        //              "body" => "Hello, there!"
        //          ]
        // );

        // print($message->sid);

        
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.interakt.ai/v1/public/message/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "countryCode": "+91",
                "phoneNumber": "9999999999",
                "callbackData": "some text here",
                "type": "Template",
                "template": {
                    "name": "template_name_here",
                    "languageCode": "en",
                    "bodyValues": [
                        "body_variable_value_1",
                        "body_variable_value_n"
                    ]
                }
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic e50be13bf68adac9ed30e72b29206669c3c88b89',
                'Content-Type: application/json'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
    }
    //use this method to signin users
    public function loginUser(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        // return auth()->user();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // this method signs out users by removing tokens
    public function signout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
