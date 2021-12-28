<?php

namespace App\Http\Controllers;

use App\Models\records;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class TwitterSocialiteController extends Controller
{
    public function redirectToProvider()
    {
        //dd(Socialite::driver('twitter')->redirect());
        return Socialite::driver('twitter')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            
            $user = Socialite::driver('twitter')->user();
            dd($user, );
            $finduser = records::where('social_id', $user->getId())->first();

            if ($finduser) {
                Auth::guard('web')->login($finduser);
                records::where('social_id', $user->id)->update([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'image_path' =>  $user->avatar,
                ]);
                Request()->session()->put('user_login_id', $finduser->id);
                return redirect('records');
            } else {
                records::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'image_path' =>  $user->avatar,
                    'social_id' => $user->id,
                    'social_type' => 'facebook',
                    'password' => Hash::make('my-facebook')
                ]);

                $user = records::where('social_id', $user->id)->first();
                if (Auth::guard('web')->login($user)) {
                    Request()->session()->put('user_login_id', $user->id);
                    return redirect('records');
                } else {
                    return redirect('login')->with('error', 'Oppes! Something went wrong!');
                }
            } 
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
