<?php

namespace App\Http\Controllers;

use App\Http\Traits\DataTrait;
use App\Models\Post;
use App\Models\records;
use App\Models\User_login_History;
use App\Models\UserVerify;
use Exception;
use Image;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;


class RecordsController extends Controller
{
    use DataTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->guard('web')->user()->id;
        $record = records::findorfail($id);

        return view('records', compact('record'));
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

                //dd(auth()->guard('web')->attempt($credentials));
                if (auth()->guard('web')->attempt($credentials)) {

                    $credentials = array(
                        'user_id'  => $verifyUser->id,
                        'ip_address' => $_SERVER['REMOTE_ADDR'],
                        'status' => 0,
                    );
                    $userlogin = User_login_History::create($credentials);
                    $request->session()->put('user_login_id', $userlogin->id);

                    return redirect('records')->with('success', 'You have Successfully loggedin');
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
            'email' => 'required|unique:records,email,' . $id,
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
     * Write code on Method
     *
     * @return response()
     */
    public function logout(Request $request)
    {
        $user_login_id = $request->session()->get('user_login_id');

        $record_details = User_login_History::find($user_login_id);
        $record_details->status = 1;
        $record_details->update();
        Auth::guard('web')->logout();
        return Redirect('login');
    }

    public function newPost()
    {
        $id = auth()->guard('web')->user()->id;
        $post = Post::create([
            'records_id' => $id,
            'title' => 'new logo',
        ]);

        $post->post_photo()->create([
            'image' => 'images (1).jfif',
        ]);
        return redirect('post');
    }

    public function showPost()
    {
        /* $post = records::has('user_post')->get();
        $post = records::withCount('user_post')->get(); */

        //$post = records::whereBetween('created_at',['2001-12-01', '2021-12-10']) ->get();

        //$post = records::select('age')->where('is_email_verified',1)->where('age','!=',8)->get(); 

        /* $post = records::where('is_email_verified',1)->where('age','<',5)->get(); 
        $post = records::where('is_email_verified','=',1)->where('age','<',5)->get(); 


        $post = records::where(['is_email_verified','!=',0],['age','<',5])->get(); 
        $post = records::where(['is_email_verified != 0'],['age < 5'])->get();  */

        //$post = records::where(['is_email_verified' => 0,'age' => 8 ])->get();
        
        $search = 'baby';
      /*   $data = records::where(function (Builder $query) use($search) {
                    return $query->
                            where('name','LIKE',$search)->
                            orwhere('email','LIKE',$search);
                })->get();
        
        dd($data); */

        /* $post = records::whereHas('user_post', function ( Builder $query) use ($search){
            $query->orWhere('title', 'like', '%'.$search.'%');
           })->get(); */
        

        /* $post = records::where(function (Builder $query) use ($search) {
            return $query->where('name','LIKE','%'.$search.'%')
                         ->orWhere('email','LIKE','%'.$search.'%')
                         ->orWhereHas('user_post', function (Builder $query) use ($search) {
                            $query->Where('title', 'like', '%'.$search.'%');
                        });
            })->get();

        dd($post); */

        /*
        if( auth()->guard('web')->check()){
            $post = $post->where('records_id',$id);
        }  
         $post = $post->get();*/

        $id = auth()->guard('web')->user()->id;
        $posts = Post::select("*")->when(auth()->guard('web')->check(), function ($query) use ($id) {
            $query->where('records_id', $id);
        })->get();


        //$posts = Post::orderByDesc('id')->get();
        return view('post', compact('posts'));
    }

    public function deletedPost()
    {
        $id = auth()->guard('web')->user()->id;
        $posts = Post::onlyTrashed()->where('records_id', '=', $id)->orderByDesc('id')->get();
        //dd($data);
        return view('deletedpost', compact('posts'));
    }

    public function restorePost(Request $request)
    {
        $posts = Post::where('id', $request->id)->restore();
        return redirect('deleted-post')->with('success', 'You have Successfully restored the post');
    }

    public function showComments($id)
    {
        $post = Post::findorfail($id);
        return view('comment', compact('post'));
    }

    public function deletepost(Request $request)
    {
        Post::where('id', $request->id)->delete();
        return redirect('post');
    }
}
