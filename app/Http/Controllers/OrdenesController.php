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
        $DataOrdenes = Ordenes::select('Ordenes.*', 'users.name as nombremesero', 'mesas.name as nombremesa')->join('mesas', 'mesas.id', '=', 'ordenes.id_mesa')->join('users', 'users.id', '=', 'ordenes.id_usuario')->get();
        return view('ordenes')
        ->with('DataOrdenes', $DataOrdenes);
    }

    public function showmodal($id)
    {
        $DataProductos= Productos::all();
        $DataUsuarios= User::select('users.id',"users.name as nombre","id_nivel")->where('users.id_nivel','2')->orWhere('users.id_nivel','3')->get();
        $dataProductoSelec= ordenes_productos::select('ordenes_productos.total as total','ordenes_productos.cantidad as valorcantidad','ordenes_productos.precio as valor','ordenes_productos.precio as valor','ordenes_productos.id_orden as valor2',"productos.nombre as nombreproducto","ordenes_productos.tipoproducto as tipoproducto")->join('productos','productos.id','=','ordenes_productos.id_productos')->where('ordenes_productos.id_orden', '=', $id)->get();
    

        if($id==0){
            $DataMesas= Mesas::select('id',"name as nombre")->where('active','0')->get();
            $DataOrdenes= New Ordenes;
        }else{
            $DataMesas= Mesas::select('id',"name as nombre")->get();
            $DataOrdenes= Ordenes::find($id);
        }
        return view('ordenes.modals.view')->with('dataEdit',$DataOrdenes)->with('DataProductos',$DataProductos)->with('DataMesero',$DataUsuarios)->with('DataMesa',$DataMesas)->with('ProductoSelec',$dataProductoSelec);
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
            'subtotal.min' => 'Debes al menos seleccionar un producto.',
            '*.valorcantidad.min'=> 'La cantidad de productos debe ser mayor a :min'
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
            $DataOrdenes = Ordenes::select('Ordenes.*', 'users.name as nombremesero', 'mesas.name as nombremesa')->join('mesas', 'mesas.id', '=', 'ordenes.id_mesa')->join('users', 'users.id', '=', 'ordenes.id_usuario')->get();
            return view('ordenes.tableview')->with('DataOrdenes', $DataOrdenes)->with('errores',$errors);
        }else{
            $Valores=$request->all();
            $retornoProductos=json_decode($Valores['productos'], true);
            $validator=Validator::make($retornoProductos, [
                '*.valorcantidad' => ['required', 'min:1','numeric'],
                '*.total' => ['required', 'min:1','numeric'],
                '*.valor2' => ['required', 'exists:App\Models\Productos,id','numeric'],
                '*.valor' => ['required', 'min:0','numeric'],
            ],$customMessages);


            if ($validator->fails()) {
                $errors = $validator->errors();
                $DataOrdenes = Ordenes::select('Ordenes.*', 'users.name as nombremesero', 'mesas.name as nombremesa')->join('mesas', 'mesas.id', '=', 'ordenes.id_mesa')->join('users', 'users.id', '=', 'ordenes.id_usuario')->get();
                return view('ordenes.tableview')->with('DataOrdenes', $DataOrdenes)->with('errores',$errors);
            }else{
                $mytime =date('Y-m-d H:i:s');
                $mytime2 =date('YmdHi');
                
                $Ordenes = new Ordenes;
                $valorOrden=[
                    'fecha' => $mytime,
                    'subtotal' => $Valores['subtotal'],
                    'total' => $Valores['total'],
                    'id_mesa' => $Valores['id_mesa'],
                    'id_usuario'=>$Valores['id_usuario'],
                    'tipodeorden'=>$Valores['tipodeorden'],
                    'propina'=>$Valores['propina']?$Valores['propina']:0,
                    'codigo'=>$mytime2.$Valores['id_mesa'].$Valores['id_usuario'],
                    'pagado'=>$Valores['pagado'],
                ];
                $idOrden =$Ordenes->Create($valorOrden)->id;
                if($Valores['pagado']){
                    $DataMesas= Mesas::find($Valores['id_mesa'])->update(['active' => false,'orden_active' => null]);
                }else{
                    $DataMesas= Mesas::find($Valores['id_mesa'])->update(['active' => true,'orden_active' => $idOrden]);
                }
                $ordenesProductos = new ordenes_productos;
                foreach ($retornoProductos as $items) {
                    $valorregistro=[
                        'id_orden' => $idOrden,
                        'id_productos' => $items['valor2'],
                        'tipoproducto'=>$items['tipoproducto'],
                        'cantidad' => $items['valorcantidad'],
                        'total' => $items['total'],
                        'precio'=>$items['valor'],
                    ];
                    $valor =$ordenesProductos->Create($valorregistro);
                }
                $DataOrdenes = Ordenes::select('Ordenes.*', 'users.name as nombremesero', 'mesas.name as nombremesa')->join('mesas', 'mesas.id', '=', 'ordenes.id_mesa')->join('users', 'users.id', '=', 'ordenes.id_usuario')->get();
                return view('ordenes.tableview')
                ->with('DataOrdenes', $DataOrdenes);
            }
            
        }
        
        
    }
    
    public function actualizar(Request $request, $id){
        $customMessages = [
            'total.required' => 'El total es necesario.',
            'id_mesa.required' => 'La Mesa es necesaria.',
            'subtotal.required' => 'El Sub Total es necesaria.',
            'pagado.required' => ' es necesaria seleccionar pagado.',
            'id_usuario.required' => ' es necesaria seleccionar un Mesero.',
            'productos.required' => ' es necesaria seleccionar un Mesero.',
            'total.min' => ' Debe el total ser mayor a :min.',
            'subtotal.min' => 'Debes al menos seleccionar un producto.',
            '*.valorcantidad.min'=> 'La cantidad de productos debe ser mayor a :min'
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
            $DataOrdenes = Ordenes::select('Ordenes.*', 'users.name as nombremesero', 'mesas.name as nombremesa')->join('mesas', 'mesas.id', '=', 'ordenes.id_mesa')->join('users', 'users.id', '=', 'ordenes.id_usuario')->get();
            return view('ordenes.tableview')->with('DataOrdenes', $DataOrdenes)->with('errores',$errors);
        }else{
            $Valores=$request->all();
            $retornoProductos=json_decode($Valores['productos'], true);
            $validator=Validator::make($retornoProductos, [
                '*.valorcantidad' => ['required', 'min:1','numeric'],
                '*.total' => ['required', 'min:1','numeric'],
                '*.valor2' => ['required', 'exists:App\Models\Productos,id','numeric'],
                '*.valor' => ['required', 'min:0','numeric'],
            ],$customMessages);


            if ($validator->fails()) {
                $errors = $valiator->errors();
                $DataOrdenes = Ordenes::dselect('Ordenes.*', 'users.name as nombremesero', 'mesas.name as nombremesa')->join('mesas', 'mesas.id', '=', 'ordenes.id_mesa')->join('users', 'users.id', '=', 'ordenes.id_usuario')->get();
                return view('ordenes.tableview')->with('DataOrdenes', $DataOrdenes)->with('errores',$errors);
            }else{
                $valorOrden=[
                    'subtotal' => $Valores['subtotal'],
                    'total' => $Valores['total'],
                    'id_mesa' => $Valores['id_mesa'],
                    'id_usuario'=>$Valores['id_usuario'],
                    'tipodeorden'=>$Valores['tipodeorden'],
                    'propina'=>$Valores['propina']?$Valores['propina']:0,
                    'pagado'=>$Valores['pagado'],
                ];
                Ordenes::find($id)->update($valorOrden);
                if($Valores['pagado']){
                    $DataMesas= Mesas::find($Valores['id_mesa'])->update(['active' => false,'orden_active' => null]);
                }else{
                    $DataMesas= Mesas::find($Valores['id_mesa'])->update(['active' => true,'orden_active' => $idOrden]);
                }
                ordenes_productos::where('id_orden', '=', $id)->delete();
                $ordenesProductos = new ordenes_productos;
                foreach ($retornoProductos as $items) {
                    $valorregistro=[
                        'id_orden' => $id,
                        'id_productos' => $items['valor2'],
                        'cantidad' => $items['valorcantidad'],
                        'tipoproducto'=>$items['tipoproducto'],
                        'total' => $items['total'],
                        'precio'=>$items['valor'],
                    ];
                    $valor =$ordenesProductos->Create($valorregistro);
                }
                $DataOrdenes = Ordenes::select('Ordenes.*', 'users.name as nombremesero', 'mesas.name as nombremesa')->join('mesas', 'mesas.id', '=', 'ordenes.id_mesa')->join('users', 'users.id', '=', 'ordenes.id_usuario')->get();
                return view('ordenes.tableview')
                ->with('DataOrdenes', $DataOrdenes);
            }
            
        }
    }

    public function delete($id){
        Ordenes::find($id)->delete();
        ordenes_productos::where('id_orden', '=', $id)->delete();
        $DataOrdenes = Ordenes::select('Ordenes.*', 'users.name as nombremesero', 'mesas.name as nombremesa')->join('mesas', 'mesas.id', '=', 'ordenes.id_mesa')->join('users', 'users.id', '=', 'ordenes.id_usuario')->get();   
        return view('ordenes.tableview')
        ->with('DataOrdenes', $DataOrdenes);
    }

    public function storepedidomesero(Request $request, $id){
        $customMessages = [
            'total.required' => 'El total es necesario.',
            'subtotal.required' => 'El Sub Total es necesaria.',
            'propina.required' => ' La propina es necesaria.',
            'productos.required' => ' es necesaria seleccionar un Producto.',
            'total.min' => ' Debe el total ser mayor a :min.',
            'subtotal.min' => 'Debes al menos seleccionar un producto.',
            '*.cantidad.min'=> 'La cantidad de productos debe ser mayor a :min'
        ];
        $validator=Validator::make($request->all(), [
            'total' => ['required', 'min:1','numeric'],
            'subtotal' => ['required','numeric','min:1'],
            'productos' => ['required', 'json'],
        ],$customMessages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $texto='<div class="alert alert-danger"><ul>';
            foreach($errors->all() as  $errorss){
               $texto=$texto.'<li>'.$errorss .'</li>';
            }
            $texto=$texto."</ul></div>";
            return response()->json([
                'success' => false,
                'data' => $texto,
            ]);
        }else{
            $Valores=$request->all();
            $retornoProductos=json_decode($Valores['productos'], true);
            $validator=Validator::make($retornoProductos, [
                '*.cantidad' => ['required', 'min:1','numeric'],
                '*.precios' => ['required', 'min:1','numeric'],
                '*.id' => ['required', 'exists:App\Models\Productos,id','numeric'],
                '*.subtotal' => ['required', 'min:0','numeric'],
            ],$customMessages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $texto='<div class="alert alert-danger"><ul>';
                foreach($errors->all() as  $errorss){
                   $texto=$texto.'<li>'.$errorss .'</li>';
                }
                $texto=$texto."</ul></div>";
                return response()->json([
                    'success' => false,
                    'data' => $texto,
                ]);
            }else{
                $mytime =date('Y-m-d H:i:s');
                $mytime2 =date('YmdHi');
                $iduser=Auth::guard('mesero')->id();
                $Ordenes = new Ordenes;
                $valorOrden=[
                    'fecha' => $mytime,
                    'subtotal' => $Valores['subtotal'],
                    'total' => $Valores['total'],
                    'id_mesa' => $id,
                    'id_usuario'=>$iduser,
                    'tipodeorden'=>'L',
                    'propina'=>$Valores['propina']?$Valores['propina']:0,
                    'codigo'=>$mytime2.$id.$iduser,
                    'pagado'=>false,
                ];
                $idOrden =$Ordenes->Create($valorOrden)->id;
                $DataMesas= Mesas::find($id)->update(['active' => true,'orden_active' => $idOrden]);
                $ordenesProductos = new ordenes_productos;
                foreach ($retornoProductos as $items) {
                    $valorregistro=[
                        'id_orden' => $idOrden,
                        'id_productos' => $items['id'],
                        'tipoproducto'=>$items['tipoproducto'],
                        'cantidad' => $items['cantidad'],
                        'total' => $items['subtotal'],
                        'precio'=>$items['precios'],
                    ];
                    $valor =$ordenesProductos->Create($valorregistro);
                }
                return response()->json([
                    'success' => true,
                    'data' => 'pedidoReakuzado ',
                ]);
            }
        }
    }
    public function productosorden($id)
    {
        $DataProductos= Productos::select('productos.nombre','productos.foto','productos.cart','ordenes_productos.cantidad')->join('ordenes_productos','ordenes_productos.id_productos','=','productos.id')->where('ordenes_productos.id_orden',$id)->get();
        return view('meseros.sides.productosall')->with('DataProducto',$DataProductos);      
    }
    
    public function agregarpedidos($id)
    { 
        
        $DataProductos= Productos::all();
        
        return view('meseros.agregarpedido')->with('DataProductos',$DataProductos)->with('idmesa',$id);      
    }
    
    public function pagadoCorrecto($id)
    {
        $valorOrden=[
            'pagado'=>true,
        ];
        Ordenes::find($id)->update($valorOrden);
        $mesasUsadas=Mesas::where('orden_active', '=', $id)->get();
        $Mesanje="Las Mesas que vienen a continuacion estan liberadas";
        foreach ($mesasUsadas as $items) {
            $Mesanje=$Mesanje." ".$items['name']." ,";
        }
        $Mesanje=trim($Mesanje, ',');

        $dataMesas=Mesas::where('orden_active', '=', $id)->update(['active' => false,'orden_active' => null]);
        $MesasLibres=Mesas::WHERE('active','0')->get();
        return response()->json([
            'success' => true,
            'message' => $Mesanje,
            'mesaslibre'=>view('meseros.sides.mesasactiva')->with('dataMesasLibres',$MesasLibres)->render()
        ]);
    }

}
