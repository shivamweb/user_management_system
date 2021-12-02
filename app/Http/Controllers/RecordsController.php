<?php

namespace App\Http\Controllers;

use App\Models\records;
use App\Models\UserVerify;
use Exception;
use Image;
use Mail;
use Hash;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Response;


class RecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            //to display the list of records
            $id = Auth::user()->id;
            $record = records::findorfail($id);
            return view('records', compact('record'));
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //to send on new-record front end page
        return view('new-record');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'age' => 'required|string|min:1|max:3',
            'contact' => 'required|string|min:10|max:10',
            'email' => 'required|unique:records',
            'password' => 'required',
        ]);
        try {
            $image = $request->profile;
            $profileImage = Image::make($image);
            Response::make($profileImage->encode('png'));

            $validatedData['email'] = $request->email;
            $validatedData['password'] =  Hash::make($request->password);
            $validatedData['image_path'] = $profileImage;

            $createUser = records::create($validatedData);

            if ($createUser) {
                $token = Str::random(64);
                UserVerify::create([
                    'user_id' => $createUser->id,
                    'token' => $token
                ]);

                Mail::send('email.emailVerificationEmail', ['token' => $token], function ($message) use ($request) {
                    $message->to($request->email);
                    $message->subject('Email Verification Mail');
                });
                return redirect('login')->with('message', 'Verification Link has been Sended to registered email.');
            }
        } catch (Exception $error) {
            echo 'Message: ' . $error->getMessage();
        }
    }

    function fetch_image($record_id)
    {
        $image = records::findOrFail($record_id);
        $image_file = Image::make($image->image_path);
        $response = Response::make($image_file->encode('jpeg'));
        $response->header('Content-Type', 'image/jpeg');
        //dd($response);
        return $response;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if ($verifyUser) {
            $record_details = records::find($verifyUser->user_id);
            //dd($verifyUser->user_id);
            if (!$record_details->is_email_verified) {
                $record_details->is_email_verified = 1;
                $record_details->update();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        return redirect()->route('login')->with('message', $message);
    }

    /**
     * Login the application dashboard.
     */
    public function checklogin(Request $request)
    {
        $validatedData = $request->validate([
            'email'   => 'required|email',
            'password'  => 'required|min:8'
        ]);

        $verifyUser = records::where('email', $request->email)->first();
        if ($verifyUser) {
            if ($verifyUser->is_email_verified == 0) {
                return redirect('login')->with('error', 'Please go to you registered email and verify first.');
            } else {
                $credentials = array(
                    'email'  => $request->get('email'),
                    'password' => $request->get('password')
                );

                if (Auth::attempt($credentials)) { 
                    return redirect('records')->with('success','You have Successfully loggedin');
                }
                return redirect('login')->with('error', 'Oppes! Your entered Password is invalid.');
            }
        } else {
            return redirect('login')->with('error', 'Oppes! Your entered Email is invalid. Does not exist!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // to edit the record based on id
        $record_details = records::findOrFail($id);
        return view('new-record', compact('record_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'age' => 'required|string|min:1|max:3',
            'contact' => 'required|string|min:10|max:10',
            'email' => 'required|unique:records,email,'.$id,
        ]);
        try {
            $image = $request->profile;
            $profileImage = Image::make($image);

            Response::make($profileImage->encode('png'));
            $validatedData['image_path'] = $profileImage;

            $record_details = records::whereId($id)->update($validatedData);
            if ($record_details) {
                return redirect('records')->with('success', 'Records is successfully updated');
            }
        } catch (Exception $error) {
            dd($error);
            echo 'Message: ' . $error->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {

            // delete the record based on id
            $record_details = records::findOrFail($request->id);
            $record_details->delete();
            Auth::logout();
            return redirect('login')->with('success', 'Records is successfully deleted');
        } catch (Exception $error) {
            echo 'Message: ' . $error->getMessage();
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()
    {
        Auth::logout();
        return Redirect('login');
    }
}
