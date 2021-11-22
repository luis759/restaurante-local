<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\niveldeusuario;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UsuarioContoller extends Controller
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
        return view('usuarios');
    }
    public function index_admin()
    {
        $DataUsuarios= User::select('users.*', 'nivel_usuario.name as nombre_nivel')->join('nivel_usuario', 'users.id_nivel', '=', 'nivel_usuario.id')->get();
        return view('usuarios')
        ->with('DataUsuarios', $DataUsuarios);
    }
    public function showmodal($id)
    {
        $DataNiveles= niveldeusuario::all();
     
        if($id==0){
            $DataUsuarios= New User;
            $tipodeopcion=true;
        }else{
            $DataUsuarios= User::find($id);
            $tipodeopcion=false;
        }
        return view('usuarios.modals.view')->with('dataEdit',$DataUsuarios)->with('DataNiveles',$DataNiveles)->with('opcion',$tipodeopcion);
    }
    public function store(Request $request)
    {
        $customMessages = [
            'name.required' => 'El nombre es necesario.',
            
            'email.required' => 'El correo es necesario.',
            
            'password.required' => 'La contraseña es necesaria.',
            
            'email.email' => 'Debe ser un formato de correo',
            
            'password.confirmed' => 'Debe ser igual las 2 password',
            
            'password.min' => 'Debe ser mayor a :min'
        ];
    
        $validator=Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ],$customMessages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $DataUsuarios= User::select('users.*', 'nivel_usuario.name as nombre_nivel')->join('nivel_usuario', 'users.id_nivel', '=', 'nivel_usuario.id')->get();
            return view('usuarios.tableview')->with('DataUsuarios', $DataUsuarios)->with('errores',$errors);
        }else{
            $User = new User;
            $input = $request->all();
            $valor =$User->Create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'id_nivel' => $input['id_nivel'],
            ]);
            $DataUsuarios= User::select('users.*', 'nivel_usuario.name as nombre_nivel')->join('nivel_usuario', 'users.id_nivel', '=', 'nivel_usuario.id')->get();
            return view('usuarios.tableview')->with('DataUsuarios', $DataUsuarios);
        }
        
    }
    
    public function actualizar(Request $request, $id){
        $customMessages = [
            'name.required' => 'El nombre es necesario.',
            
            'email.required' => 'El correo es necesario.',
            
            'password.required' => 'La contraseña es necesaria.',
            
            'email.email' => 'Debe ser un formato de correo',
            
            'password.confirmed' => 'Debe ser igual las 2 password',
            
            'password.min' => 'Debe ser mayor a :min'
        ];
        
        $input = $request->all();
        if(empty($input['password'])){
            $valorValidacion=[
                'name' => ['required', 'string', 'max:255'],
            ];
            $dataRegistro=[
                'name' => $input['name'],
                'id_nivel' => $input['id_nivel'],
            ];
        }else{
        $valorValidacion=[
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:4', 'confirmed'],
        ];
        $dataRegistro=[
            'name' => $input['name'],
            'password' => Hash::make($input['password']),
            'id_nivel' => $input['id_nivel'],
        ];
        }
        $validator=Validator::make($request->all(), $valorValidacion,$customMessages);

        $errors = $validator->errors();
        $DataUsuarios= User::select('users.*', 'nivel_usuario.name as nombre_nivel')->join('nivel_usuario', 'users.id_nivel', '=', 'nivel_usuario.id')->get();
        if ($validator->fails()) {
            $errors = $validator->errors();
            return view('usuarios.tableview')->with('DataUsuarios', $DataUsuarios)->with('errores',$errors);
        }else{
            User::find($id)->update($dataRegistro);
            $DataUsuarios= User::select('users.*', 'nivel_usuario.name as nombre_nivel')->join('nivel_usuario', 'users.id_nivel', '=', 'nivel_usuario.id')->get();
            return view('usuarios.tableview')->with('DataUsuarios', $DataUsuarios);
        }
    }
    public function delete($id){
        User::find($id)->delete();
        $DataUsuarios= User::select('users.*', 'nivel_usuario.name as nombre_nivel')->join('nivel_usuario', 'users.id_nivel', '=', 'nivel_usuario.id')->get();
        return view('usuarios.tableview')->with('DataUsuarios', $DataUsuarios);
    }
}
