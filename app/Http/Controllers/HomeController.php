<?php

namespace App\Http\Controllers;

use App\Models\photo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function test()
    {
        $chunks = photo::lazy();

        dd($chunks);
        return view('home', compact('chunks')); 



        /* $row =  photo::all()->reject(function ($id) {
            return ($id->id == 2);
        });
        dd($row); 

        $collection = collect(['taylor', 'abigail', null, 123, 456, 789])
            ->reject(function ($name) {
                return empty($name);
            });

        dd($collection); */
    }
}
