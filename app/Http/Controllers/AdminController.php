<?php

namespace App\Http\Controllers;

use App\Http\Traits\DataTrait;
use App\Models\Admin;
use App\Models\records;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\SessionGuard;

class AdminController  extends Controller
{
    use DataTrait;
    /** 
     * Display a listing of the resource. 
     * 
     */
    public function index()
    {
        if (auth()->guard('admin')->check()) {
            $records = records::paginate( $perPage = 3, $columns = ['*'], $pageName = 'records');
            return view('admin-dashboard', ['records'=>$records]);
        } else {
            return redirect('admin-login')->with('error', 'Oppes! something went wrong. Please login again.');
        }
    }

    public function loginCheck(Request $request)
    {
        $credentials = $request->validate([
            'email'   => 'required|email',
            'password'  => 'required|min:8'
        ]);

        $verifyUser = Admin::where('email', $request->email)->first();
        if ($verifyUser) {
            if (Auth::guard('admin')->attempt($credentials)) {

                return redirect('admin-dashboard')->with('success', 'You have Successfully loggedin');
            }
            return redirect('admin-login')->with('error', 'Oppes! Your entered Password is invalid.');
        }
        return redirect('admin-login')->with('error', 'Oppes! Your entered Email is invalid. Does not exist!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // delete the record based on id
        records::where('id', $request->id)->delete();
        UserVerify::where('user_id', $request->id)->delete();

        return redirect('admin-dashboard')->with('success', 'Records is successfully deleted');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return Redirect('admin-login');
    }
}
