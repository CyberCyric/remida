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

        return redirect()->route('entregas', ['agno' => $data['agno']]);
    }

    public function show($id)
    {
        $entrega = DB::table('entrega')
            ->where('entrega.entrega_id',$id)
            ->first();
        $json = json_encode($entrega);
        return  $json;  
    }

    public function list($agno_seleccionado = ''){
        
        if ($agno_seleccionado == '') { 
            $agno_seleccionado = date('Y');
        }
        $from = date($agno_seleccionado.'-01-01');
        $to = date($agno_seleccionado.'-12-31');
        
        $entregas = DB::table('entrega')
        ->whereBetween('fecha',[$from, $to])
        ->orderBy('fecha', 'DESC')
        ->orderBy('entrega_id', 'DESC')
        ->paginate(500);        

        $agnos = DB::table('entrega')->distinct('YEAR(fecha)')->selectRaw('YEAR(fecha) AS agno')->get();

        return view('admin-entregas', compact('id', 'entregas', 'agnos', 'agno_seleccionado'));
    }
}
