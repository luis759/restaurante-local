<?php

namespace App\Http\Controllers;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class ProductosController extends Controller
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
        return view('productos');
    }
    public function index_admin()
    {
        $DataProductos= Productos::all();
        return view('productos')->with('Dataproductos', $DataProductos);
    }
    public function showmodal($id)
    {

     
        if($id==0){
            $DataProductos= New Productos;
            $tipodeopcion=true;
        }else{
            $DataProductos= Productos::find($id);
            $tipodeopcion=false;
        }
      
        return view('productos.modals.view')->with('dataEdit',$DataProductos)->with('opcion',$tipodeopcion);
    }
    public function store(Request $request)
    {
        $customMessages = [
            'nombre.required' => 'El nombre es necesario.',
            'descripcion.required' => 'La descripcion es necesaria.',
            'stock.required' => 'El stock es necesaria.',
            'precio.required' => 'El precio es necesaria.'
        ];
    
        $validator=Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'stock' => ['required', 'number'],
            'precio' => ['required', 'number'],
        ],$customMessages);

        if($validator->fails()){

            $errors = $validator->errors();
            $DataProductos= Productos::all();
            return view('productos.tableview')->with('Dataproductos', $DataProductos)->with('errores',$errors);

        }else{

            $ruta="blank.png";
            $input = $request->all();
            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $id=0;
                    $data = Productos::latest('id')->first();
                    if(isset($data)){
                        $id=$data['id'];
                    }
                    $validated = $request->validate([
                        'image' => 'mimes:jpeg,png,jpg|max:1014',
                    ]);
                    $extension = $request->image->extension();
                    $guardar='productos/'.($id+1);
                    
                    $ruta = request()->file('image')->storeAs($guardar,'producto'.($id+1).'.'.$extension,'public_uploads');
                }
            }
    
            $valorRegistro=[
                'nombre' => $input['nombre'],
                'stock' => $input['stock'],
                'foto' => $ruta,
                'descripcion' => $input['descripcion'],
                'precio'=>$input['precio'],
            ];
            $Productos = new Productos;
            $valor =$Productos->Create($valorRegistro);
            
            $DataProductos= Productos::all();
            return view('productos.tableview')->with('Dataproductos', $DataProductos);

        }
        
    }
    
    public function actualizar(Request $request, $id){
      
    }
    public function delete($id){
        $producto=Productos::find($id);
        
        if($producto->foto=='blank.png'){

        }else{
            $guardar='/productos'.'/'.$producto->id;
            File::deleteDirectory(public_path().'/storage'.$guardar);
        }
        Productos::find($id)->delete();
        $DataProductos= Productos::all();
        return view('productos.tableview')->with('Dataproductos', $DataProductos);
    }
}
