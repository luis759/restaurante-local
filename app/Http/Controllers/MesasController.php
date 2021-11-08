<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesas;

use Illuminate\Support\Facades\Log;

class MesasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        //$this->middleware('');
    }
      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('mesas');
    }
    public function index_admin()
    {
        $DataMesas= Mesas::all();
        return view('mesas')
        ->with('DataMesas', $DataMesas);
    }
    public function showmodal($id)
    {
        if($id==0){
            $DataMesas= New Mesas;
        }else{
            $DataMesas= Mesas::find($id);
        }
        return view('mesas.modals.view')->with('dataEdit',$DataMesas);
    }
    public function store(Request $request)
    {
        $Mesas = new Mesas;
        $input = $request->all();
        $valor =$Mesas->Create($input);
        $todas=Mesas::All();
        return view('mesas.tableview')->with('DataMesas', $todas);
    }
    
    public function actualizar(Request $request, $id){

        Mesas::find($id)->update($request->all());
        $todas=Mesas::All();
        return view('mesas.tableview')->with('DataMesas', $todas);
    }
    public function delete($id){
        Mesas::find($id)->delete();
        $todas=Mesas::All();
        return view('mesas.tableview')->with('DataMesas', $todas);
    }
}
