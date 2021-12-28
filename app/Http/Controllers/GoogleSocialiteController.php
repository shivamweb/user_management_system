<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\DataTrait;
use App\Models\records;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleSocialiteController extends Controller
{
    use DataTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        //dd(Socialite::driver('google')->redirect());
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            //dd($user, $user['picture']);
            $finduser = records::where('social_id', $user->id)->first();

            if ($finduser) {
                $this->socialLoginUserExist($user,$finduser);
            } else {
                $this->socialLoginNewUser($user);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
