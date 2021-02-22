<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InvitacionVotacion;


use Illuminate\Support\Facades\Mail;

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
  
    public function pruebamail(Request $request)
    {
          $cuenta = ["eaguilars@gmail.com"];
          $order ='<html><body>contenido<body></html>';
          Mail::to($cuenta)->send(new InvitacionVotacion($order));
    }  
  

}
