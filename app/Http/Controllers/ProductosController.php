<?php

namespace App\Http\Controllers;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
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
            'stock' => ['required', 'integer'],
            'precio' => ['required', 'integer'],
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
                    $validated = $request->validate([
                        'image' => 'mimes:jpeg,png,jpg|max:1014',
                    ]);
                    $extension = $request->image->extension();
                    $guardar='/productos';
                    
                    $ruta = request()->file('image')->store($guardar,'public_uploads');
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
        $customMessages = [
            'nombre.required' => 'El nombre es necesario.',
            'descripcion.required' => 'La descripcion es necesaria.',
            'stock.required' => 'El stock es necesaria.',
            'precio.required' => 'El precio es necesaria.'
        ];
    
        $validator=Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'stock' => ['required', 'integer'],
            'precio' => ['required', 'integer'],
        ],$customMessages);

        if($validator->fails()){

            $errors = $validator->errors();
            $DataProductos= Productos::all();
            return view('productos.tableview')->with('Dataproductos', $DataProductos)->with('errores',$errors);

        }else{

            $productos=Productos::find($id);
            $input = $request->all();
            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $validated = $request->validate([
                        'image' => 'mimes:jpeg,png,jpg|max:1014',
                    ]);
                    $extension = $request->image->extension();

                    if($productos->foto=='blank.png'){

                    }else{
                        Storage::disk('public_uploads')->delete('/'.$producto->foto);
                    }

                    $ruta = request()->file('image')->store($guardar,'public_uploads');
                    $valorRegistro=[
                        'nombre' => $input['nombre'],
                        'stock' => $input['stock'],
                        'foto' => $ruta,
                        'descripcion' => $input['descripcion'],
                        'precio'=>$input['precio'],
                    ];
                }
            }else{
                $valorRegistro=[
                    'nombre' => $input['nombre'],
                    'stock' => $input['stock'],
                    'foto' => $ruta,
                    'descripcion' => $input['descripcion'],
                    'precio'=>$input['precio'],
                ];
            }
            Productos::find($id)->update($valorRegistro);
            $DataProductos= Productos::all();
            return view('productos.tableview')->with('Dataproductos', $DataProductos);


        }


    }
    public function delete($id){
        $producto=Productos::find($id);
        
        if($producto->foto=='blank.png'){

        }else{
            Storage::disk('public_uploads')->delete('/'.$producto->foto);
        }
        Productos::find($id)->delete();
        $DataProductos= Productos::all();
        return view('productos.tableview')->with('Dataproductos', $DataProductos);
    }
}
