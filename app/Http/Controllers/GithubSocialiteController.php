<?php

namespace App\Http\Controllers;

use App\Models\records;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;


class GithubSocialiteController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
            //dd($user, );
            $finduser = records::where('social_id', $user->id)->first();

            if ($finduser) {
                Auth::guard('web')->login($finduser);
                records::where('social_id', $user->id)->update([
                    'name' => $user->name,
                    'email' => $user->email,
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
                    'social_type' => 'github',
                    'password' => Hash::make('my-github')
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
