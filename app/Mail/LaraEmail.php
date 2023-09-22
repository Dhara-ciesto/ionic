<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LaraEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $mailData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     //
    // }

    // /**
    //  * Build the message.
    //  *
    //  * @return $this
    //  */
    // public function build()
    // {
    //     return $this->view('view.name');
    // }


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
        //
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = $this->mailData->to;
        $subject = $this->mailData->subject;
        $name = $this->mailData->name;
        // $cc = $this->mailData->cc;
        // $bcc = $this->mailData->bcc;
        $from = $this->mailData->from;
        // dd($this->mailData->product_ids);
        $product_ids =  explode(',',$this->mailData->product_ids);
        $products = Product::whereIn('id',$product_ids)->take(5)->get();
        return $this->view('email.email1')
            // ->text('email.laraemail_plain')
            ->from($from, $name)
            // ->cc($address, $name)
            // ->bcc($cc, $name)
            ->replyTo($from, $name)
            ->subject($subject)
            ->with(['mailMessage' => $this->mailData, 'products' => $products]);
    }
}
