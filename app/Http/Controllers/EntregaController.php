<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Entrega;
use App\Empresa;

class EntregaController extends Controller
{
    //
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(){
        return view('admin-entrega-create');        
    }

    public function store(Request $request){
        
        $data = request();
        $entrega = Entrega::create([
            'fecha' =>  $data['agno']."-".$data['mes']."-".$data['dia']
        ]);

        return redirect()->route('entregas');
    }

    public function show($id)
    {
        $entrega = DB::table('entrega')
            ->where('entrega.entrega_id',$id)
            ->first();
        $json = json_encode($entrega);
        return  $json;  
    }

    public function list(){
        $entregas = DB::table('entrega')
        ->orderBy('fecha', 'DESC')
        ->orderBy('entrega_id', 'DESC')
        ->paginate(100);        
        return view('admin-entregas', compact('id', 'entregas'));
    }
}
