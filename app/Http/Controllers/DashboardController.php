<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ordenes;
use App\Models\Productos;
use App\Models\Mesas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Ordenes_productos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,mesero');
    }
    public function index_admin(){
        $fecha=strtotime("2022-01-07");  
        $mytime =date('Y-m-d',$fecha);
        $OrdenesTotalDelivery = Ordenes::select(DB::raw('SUM(subtotal) as total'))->where("tipodeorden","=","D")->where(DB::raw("CAST(fecha as DATE)"),"=",$mytime)->where("pagado","=","1")->first();
        $OrdenesTotalSinDelivery = Ordenes::select(DB::raw('SUM(subtotal) as total'))->where("tipodeorden","<>","D")->where(DB::raw("CAST(fecha as DATE)"),"=",$mytime)->where("pagado","=","1")->first();
        $OrdenesTotalPropina = Ordenes::select(DB::raw('SUM(propina) as total'))->where(DB::raw("CAST(fecha as DATE)"),"=",$mytime)->where("pagado","=","1")->first();
        $OrdenesTotalSinpagar=Ordenes::select(DB::raw('SUM(subtotal) as total'))->where("pagado","=","0")->where(DB::raw("CAST(fecha as DATE)"),"=",$mytime)->first();
        $VentasTotalPorMesero=Ordenes::select(DB::raw('SUM(ordenes.propina) as totalpropina'),DB::raw('SUM(ordenes.subtotal) as total'),'users.email','users.name')->join("users","users.id","=","ordenes.id_usuario")->where("users.id_nivel","=","2")->where(DB::raw("CAST(fecha as DATE)"),"=",$mytime)->where("pagado","=","1")
        ->groupByRaw('email,name')->get();
        return view('dashboard')
        ->with('OrdenesTotalDelivery', $OrdenesTotalDelivery)
        ->with('OrdenesTotalSinDelivery', $OrdenesTotalSinDelivery)
        ->with('OrdenesTotalPropina', $OrdenesTotalPropina)
        ->with('VentasTotalPorMesero', $VentasTotalPorMesero)
        ->with('OrdenesTotalSinpagar', $OrdenesTotalSinpagar);
    }
    public function fechadashboard(Request $request){
        
        $Valores=$request->all();
        $fecha=strtotime($Valores['fecha']);  
        $mytime =date('Y-m-d',$fecha);
        $OrdenesTotalDelivery = Ordenes::select(DB::raw('SUM(subtotal) as total'))->where("tipodeorden","=","D")->where(DB::raw("CAST(fecha as DATE)"),"=",$mytime)->where("pagado","=","1")->first();
        $OrdenesTotalSinDelivery = Ordenes::select(DB::raw('SUM(subtotal) as total'))->where("tipodeorden","<>","D")->where(DB::raw("CAST(fecha as DATE)"),"=",$mytime)->where("pagado","=","1")->first();
        $OrdenesTotalPropina = Ordenes::select(DB::raw('SUM(propina) as total'))->where(DB::raw("CAST(fecha as DATE)"),"=",$mytime)->where("pagado","=","1")->first();
        $OrdenesTotalSinpagar=Ordenes::select(DB::raw('SUM(subtotal) as total'))->where("pagado","=","0")->where(DB::raw("CAST(fecha as DATE)"),"=",$mytime)->first();
        $VentasTotalPorMesero=Ordenes::select(DB::raw('SUM(ordenes.propina) as totalpropina'),DB::raw('SUM(ordenes.subtotal) as total'),'users.email','users.name')->join("users","users.id","=","ordenes.id_usuario")->where("users.id_nivel","=","2")->where(DB::raw("CAST(fecha as DATE)"),"=",$mytime)->where("pagado","=","1")
        ->groupByRaw('email,name')->get();
        return response()->json([
            'success' => true,
            'dashboard'=>view('admin.dashboard.ventas')
            ->with('OrdenesTotalDelivery', $OrdenesTotalDelivery)
            ->with('OrdenesTotalSinDelivery', $OrdenesTotalSinDelivery)
            ->with('OrdenesTotalPropina', $OrdenesTotalPropina)
            ->with('VentasTotalPorMesero', $VentasTotalPorMesero)
            ->with('OrdenesTotalSinpagar', $OrdenesTotalSinpagar)->render()
        ]);
    }
}
