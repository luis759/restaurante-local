<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ordenes;
use App\Models\Productos;
use App\Models\Mesas;
use App\Models\User;
use App\Models\Ordenes_productos;


class OrdenesController extends Controller
{
    //
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
        return view('ordenes');
    }
    public function index_admin()
    {
        $DataOrdenes = Ordenes::all();
        return view('ordenes')
        ->with('DataOrdenes', $DataOrdenes);
    }

    public function showmodal($id)
    {
        $DataProductos= Productos::all();
        $DataMesas= Mesas::select('id',"name as nombre")->where('active','0')->get();
        $DataUsuarios= User::select('users.id',"users.name as nombre")->where('users.id_nivel','2')->get();
        if($id==0){
            $DataOrdenes= New Ordenes;
        }else{
            $DataOrdenes= Ordenes::find($id);
        }
        return view('ordenes.modals.view')->with('dataEdit',$DataOrdenes)->with('DataProductos',$DataProductos)->with('DataMesero',$DataUsuarios)->with('DataMesa',$DataMesas);
    }
    public function store(Request $request)
    {
        
        
    }
    
    public function actualizar(Request $request, $id){
       
    }

    public function delete($id){
    }

}
