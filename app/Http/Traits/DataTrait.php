<?php

namespace App\Http\Traits;

use App\Models\Admin;
use Image;
use App\Models\Post;
use App\Models\records;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

trait DataTrait
{
    public function getAllPost()
    {
        $posts = Post::orderByDesc('id')->get();
        return $posts;
    }

    public function getProfile($userType, $id)
    {
        $profile = null;

        if ($userType == 'user') {
            $profile = records::findOrFail($id);
        }
        if ($userType == 'admin') {
            $profile = Admin::findOrFail($id);
        }
        return $profile;
    }

    public function socialLoginUserExist($user, $finduser)
    {
        Auth::guard('web')->login($finduser);
        records::where('social_id', $user->id)->update([
            'name' => $user->name,
            'email' => $user->email,
            "image_path" =>  $user['picture'],
        ]);
        Request()->session()->put('user_login_id', $finduser->id);
        return redirect('records');
    }

    public function socialLoginNewUser($user){
        records::create([
            'name' => $user->name,
            'email' => $user->email,
            "image_path" =>  $user['picture'],
            'social_id' => $user->id,
            'social_type' => 'google',
            'password' => Hash::make('my-google')
        ]);

        $user = records::where('social_id', $user->id)->first();
        if (Auth::guard('web')->login($user)) {
            Request()->session()->put('user_login_id', $user->id);
            return redirect('records');
        } else {
            return redirect('login')->with('error', 'Oppes! Something went wrong!');
        }
    }
}
