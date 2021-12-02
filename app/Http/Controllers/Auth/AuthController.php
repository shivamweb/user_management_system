<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\records;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\UserVerify;
use Hash;
use Illuminate\Support\Str;
use Mail;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        //
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if (Auth::check()) {
            return view('records');
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        //
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()
    {
        //Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
