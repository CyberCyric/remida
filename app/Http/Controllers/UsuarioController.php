<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;


class UsuarioController extends Controller
{
      public function list(){
        $usuarios = DB::table('users')
        ->paginate(50);        
        return view('admin-usuarios', compact('id', 'usuarios'));
    }

    public function show(Request $request, $id){
        if ($request->session()->get('isAdmin')) $isAdmin = true; else $isAdmin = false;
        $usuario = User::find($id); 
        return view('admin-usuario', compact('id', 'usuario', 'isAdmin'));
    }

    public function delete(Request $request, $id){
        $data = request();
        $usuario = User::find($id);        
        $usuario->deleted = 1;        
        $usuario->save();
        return view('admin-usuarios', compact('id', 'usuarios'));   
    }

    public function update(Request $request, $id)
    {
        $data = request();
        $usuario = User::find($id);        
        $usuario->role = $data['role'];        
        $usuario->active = $data['active'];
        $usuario->password = bcrypt($data['clave']);
        $usuario->save();
        return redirect()->route('usuarios');
	}
}
