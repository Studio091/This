<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Album;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cms.index');
    }
	public function cms()
	{
		return view('cms.index');
	}
	
}