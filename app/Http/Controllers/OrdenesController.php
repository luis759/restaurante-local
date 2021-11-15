<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ordenes;
use App\Models\Productos;
use App\Models\Mesas;
use App\Models\User;
use App\Models\Ordenes_productos;

use Illuminate\Support\Facades\Validator;

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
        $DataUsuarios= User::select('users.id',"users.name as nombre")->where('users.id_nivel','2')->get();
        if($id==0){
            $DataMesas= Mesas::select('id',"name as nombre")->where('active','0')->get();
            $DataOrdenes= New Ordenes;
        }else{
            $DataMesas= Mesas::select('id',"name as nombre")->get();
            $DataOrdenes= Ordenes::find($id);
        }
        return view('ordenes.modals.view')->with('dataEdit',$DataOrdenes)->with('DataProductos',$DataProductos)->with('DataMesero',$DataUsuarios)->with('DataMesa',$DataMesas);
    }
    public function store(Request $request)
    {
        $customMessages = [
            'total.required' => 'El total es necesario.',
            'id_mesa.required' => 'La Mesa es necesaria.',
            'subtotal.required' => 'El Sub Total es necesaria.',
            'pagado.required' => ' es necesaria seleccionar pagado.',
            'id_usuario.required' => ' es necesaria seleccionar un Mesero.',
            'productos.required' => ' es necesaria seleccionar un Mesero.',
            'total.min' => ' Debe el total ser mayor a :min.',
            'subtotal.min' => 'Debes al menos seleccionar un producto.'
        ];
        $validator=Validator::make($request->all(), [
            'total' => ['required', 'min:1','numeric'],
            'id_mesa' => ['required', 'string',],
            'subtotal' => ['required','numeric','min:1'],
            'pagado' => ['required', 'boolean'],
            'id_usuario' => ['required', 'string'],
            'productos' => ['required', 'json'],
        ],$customMessages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $DataOrdenes = Ordenes::all();
        return view('ordenes.tableview')->with('DataOrdenes', $DataOrdenes)->with('errores',$errors);
        }else{
            return response()->json([
                'name' => $request->all(),
                'state' => 'CA',
            ]);
        }
        
        
    }
    
    public function actualizar(Request $request, $id){
       
    }

    public function delete($id){
    }

}
