<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailUtil extends Controller
{
    public function adminWelcomeEmail($name, $email, $password){

        $data = array(
            'email'=>$email,
            'password'=>$password,
            'name'=>$name,
        );

        Mail::send('emails.admin-welcome-note', $data, function($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject('Administrator Welcome Note - WAFRI EXCHANGE');
            $message->from('wafri.dev@gmail.com','Administrator Welcome Note - WAFRI EXCHANGE');
        });
    }

    public function userWelcomeEmail($name, $email, $verification_code){

        $data = array(
            'email'=>$email,
            'verification_code'=>$verification_code,
            'name'=>$name,
        );

        Mail::send('emails.user-welcome-note', $data, function($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject('User Welcome Note - WAFRI EXCHANGE');
            $message->from('wafri.dev@gmail.com','User Welcome Note - WAFRI EXCHANGE');
        });
    }

    public function verificationCodeEmail($name, $email, $verification_code){

        $data = array(
            'email'=>$email,
            'verification_code'=>$verification_code,
            'name'=>$name,
        );

        Mail::send('emails.verification-code-email', $data, function($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject('Verification Code - WAFRI EXCHANGE');
            $message->from('wafri.dev@gmail.com','Verification Code - WAFRI EXCHANGE');
        });
    }

    public function passwordResetCode($name, $email, $reset_code){

        $data = array(
            'email'=>$email,
            'reset_code'=>$reset_code,
            'name'=>$name,
        );

        Mail::send('emails.reset-code-email', $data, function($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject('Password Reset Code - WAFRI EXCHANGE');
            $message->from('wafri.dev@gmail.com','Password Reset - WAFRI EXCHANGE');
        });
    }

    public function passwordResetEmail($name, $email, $password){

        $data = array(
            'email'=>$email,
            'password'=>$password,
            'name'=>$name,
        );

        Mail::send('emails.password-reset', $data, function($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject('Account Password Reset - WAFRI EXCHANGE');
            $message->from('wafri.dev@gmail.com','Account Password Reset - WAFRI EXCHANGE');
        });
    }


}
