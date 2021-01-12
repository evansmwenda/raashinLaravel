<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
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

    public function account(){
        return view('home');
    }

    public function wishlist(){
        return view('home');
    }

    public function checkout(){
        return view('home');
    }

    public function cart(){
        return view('home');
    }
    public function contactus(){
        return view('home');
    }

}
