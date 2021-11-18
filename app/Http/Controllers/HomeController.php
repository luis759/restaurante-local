<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ordenes;
use App\Models\Mesas;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin,mesero');
        //$this->middleware('');
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
    public function meserohome()
    {
        $idUsuario=Auth::guard('mesero')->user()->id;
        $MesasLibres=Mesas::WHERE('active','0')->get();
        $OrdenesSeleccionada=Ordenes::SELECT('ordenes.*','mesas.name')->join('mesas','ordenes.id_mesa','=','mesas.id')->where('ordenes.id_usuario',$idUsuario)->where('pagado', 0)->get();
        return view('home')->with('dataMesasLibres',$MesasLibres)->with('dataOrdenesSelect',$OrdenesSeleccionada);
    }
}
