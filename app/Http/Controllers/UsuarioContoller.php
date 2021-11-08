<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Log;


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
        $DataUsuarios= User::all();
        return view('usuarios')
        ->with('DataUsuarios', $DataUsuarios);
    }
    public function showmodal($id)
    {
        if($id==0){
            $DataUsuarios= New User;
        }else{
            $DataUsuarios= User::find($id);
        }
        return view('mesas.modals.view')->with('dataEdit',$DataUsuarios);
    }
    public function store(Request $request)
    {
    }
    
    public function actualizar(Request $request, $id){
    }
    public function delete($id){
    }
}
