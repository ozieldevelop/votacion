<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InvitacionVotacion;


use Illuminate\Support\Facades\Mail;
use Auth;

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
    public function index(Request $request)
    {   
        if(Auth::user()->id !=3 ){
            return view('home');
        }
      else
      {
          $request->session()->flush();
					$mensaje = "";
					$mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
					$mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Est&aacute; tratando de acceder a un &aacute;rea no habilitada</div> ";
					return view('votacion::advertencia')->with('mensaje', $mensaje)->with('nombre', '')->with('ideven', '');
      }
    }
  
    public function pruebamail(Request $request)
    {
          $cuenta = ["eaguilars@gmail.com"];
          $order ='<html><body>contenido<body></html>';
          Mail::to($cuenta)->send(new InvitacionVotacion($order));
    }  
  

}
