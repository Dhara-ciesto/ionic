<?php

namespace App\Http\Controllers;

use App\Mail\LaraEmail;
use App\Models\EmailConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail()
    {
        $mailInfo = new \stdClass();
        $mailInfo->recieverName = "John Defoe";
        $mailInfo->sender = "TIRA";
        $mailInfo->senderCompany = "TIRA";
        $mailInfo->to = "dhara.ciesto@gmail.com";
        $mailInfo->subject = "Favourite Products";
        $mailInfo->name = "TIRA";
        $mailInfo->cc = "ci@email.com";
        $mailInfo->bcc = "jim@email.com";
        $mailInfo->from = "nonreply@yogiindustries.co.in";
        $mailInfo->title = "Favourite Products";
        try {
            $mail =  Mail::to("dhara.ciesto@gmail.com")
                ->send(new LaraEmail($mailInfo));
        } catch (\Excception $e) {
            dd($e);
        }
    }

    public function emailConfig(Request $request)
    {
        $emailconfig = EmailConfig::firstOrCreate(['id' => '1']);
        if ($request->method() == 'POST') {

            $validated = $request->validate([
                'mail_encryption' => 'required',
                'mail_from_address' => 'required',
                'mail_username' => 'required',
                'mail_password' => 'required',
                'mail_host' => 'required',
                'mail_port' => 'required|numeric',
                'mail_from_name' => 'required'
            ]);
            $emailconfig->update($request->all());
            $path = app()->environmentFilePath();
            $configs =  $emailconfig->toArray();
            unset($configs['id'],$configs['updated_at'],$configs['created_at']);
            $this->changeEnv($configs);
            \Log::info('Email Setting Changed');
            return redirect()->back()->with('success', 'Email Configuration Updated successfully');   

            // return redirect()->back()->with(['success', 'Email Configuration Updated successfully']);
        } else {
            $data['emailconfig'] = $emailconfig;
            return view('email.config', $data);
        }
    }

    public static function changeEnv($data = array())
    {
        if (count($data) > 0) {

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\n+/', $env);

            // dd( $env);
            // Loop through given data
            foreach ((array)$data as $key => $value) {
                $key = strtoupper($key);
                // Loop through .env-data
                foreach ($env as $env_key => $env_value) {

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if ($entry[0] == $key) {
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . '="' . str_replace(" ",' ', $value) .'"' ;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] =  $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);

            return true;
        } else {
            return false;
        }
    }
}
