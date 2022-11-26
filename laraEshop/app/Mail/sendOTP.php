<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendOTP extends Mailable
{
    use Queueable, SerializesModels;
    public $sub;
    public $user_type;
    public $username;
    public $email;
    public $otp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sub,$user_type,$username,$email,$otp)
    {
        $this->sub = $sub;
        $this->user_type = $user_type;   
        $this->username = $username;    
        $this->email = $email; 
        $this->otp = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.sendOTP')
        ->with('user_type',$this->user_type)
        ->with('username',$this->username)
        ->with('email',$this->email)
        ->with('otp',$this->otp)
        ->subject($this->sub);
    }
}
