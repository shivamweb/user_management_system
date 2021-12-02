<?php

namespace App\Http\Controllers;

use App\Models\Password_resets;
use Illuminate\Http\Request;
use App\Models\records;
use App\Models\UserVerify;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Forget and Reset Controller
    |--------------------------------------------------------------------------
    | This controller is responsible for handling password reset emails 
    |
    */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function forgotPasswordMail(Request $request)
    {
        //dd('dsssd');
        $request->validate([
            'email' => 'required',
        ]);
        try {

            $verifyUser = records::where('email', $request->email)->first();
            if ($verifyUser) {
                $token = Str::random(64);
                UserVerify::create([
                    'user_id' => $verifyUser->id,
                    'token' => $token
                ]);

                Mail::send('email.forgetPasswordEmail', ['token' => $token], function ($message) use ($request) {
                    $message->to($request->email);
                    $message->subject('Email Verification Mail');
                });
                return redirect()->route('login')->with('message', 'Link has been Send to email to reset password.');
            } else {
                return back()->with('error', 'Oppes! Your entered Email is not registered.');
            }
        } catch (Exception $error) {
            echo 'Message: ' . $error->getMessage();
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm($token)
    {
        return view('resetPassword', compact('token'));
    }

    public function submitResetPasswordForm(Request $request)
    {
        $verifyUser = UserVerify::where('token', $request->token)->first();
        if (!$verifyUser) {
            return back()->withInput()->with('error', 'Invalid token!');
        } else {
            $user_details = records::findorfail($verifyUser->user_id);
            $user_details->password = Hash::make($request->password);
            $user_details->update();
            return redirect()->route('login')->with('message', 'Your Password is updated. You can now login.');
        }
    }

    public function changePassword(Request $request){
        $validatedData = $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
        ]);
        $user_password = Auth::user()->password;
        if (Hash::check($request->oldPassword, $user_password)){
            $id = Auth::user()->id;
            $user_details = records::findorfail($id);
            $user_details->password = Hash::make($request->password);
            $user_details->update();
            return redirect('records')->with('success', 'Password Change Sucessfully');
        }
        else{
            return back()->with('error', 'Oppes! Your entered Current Password not matched.');
        }
    }
}
