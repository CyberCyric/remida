<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Retiro;

class RetiroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function listPendientes(){
        $retiros = DB::table('retiros')
        ->leftJoin('distrito', 'retiros.distrito_id', '=', 'distrito.distrito_id')
        ->where('aprobado','N')
        ->orderBy('fecha', 'desc')
        ->orderBy('retiro_id', 'desc')
        ->selectRaw('distrito.nombre AS distrito, retiros.*')
        ->paginate(100);        
        return view('admin-retiros', compact('id', 'retiros'));
    }

    public function listAprobados(){
        $retiros = DB::table('retiros')
        ->leftJoin('distrito', 'retiros.distrito_id', '=', 'distrito.distrito_id')
        ->where('aprobado','S')
        ->orderBy('fecha', 'desc')
        ->orderBy('retiro_id', 'desc')
        ->selectRaw('distrito.nombre AS distrito, retiros.*')
        ->paginate(100);        
        return view('admin-retiros', compact('id', 'retiros'));
    }

    public function reject($id){
        $retiros = Retiro::find($id);
        $retiros->delete();

        $retiros = DB::table('retiros')
        ->join('distrito', 'retiros.distrito_id', '=', 'distrito.distrito_id')
        ->where('aprobado','N')
        ->orderBy('fecha', 'desc')
        ->orderBy('retiro_id', 'desc')
        ->selectRaw('distrito.nombre AS distrito, retiros.*')
        ->paginate(100);        
        return view('admin-retiros', compact('id', 'retiros'));
    }

    public function approve($id){
        $retiro = Retiro::find($id);

        if ($retiro->madera > 0)    {
            DB::table('stock')
            ->where('material_id', 1)
            ->update(['stock' => DB::raw('stock - '.$retiro->madera) ]);
        }
        if ($retiro->papel > 0)     { 
            DB::table('stock')
            ->where('material_id', 2)
            ->update(['stock' => DB::raw('stock - '.$retiro->papel) ]);
        }
        if ($retiro->plastico > 0)  { 
            DB::table('stock')
            ->where('material_id', 4)
            ->update(['stock' => DB::raw('stock - '.$retiro->plastico) ]);
        }
        if ($retiro->metal > 0)     { 
            DB::table('stock')
            ->where('material_id', 5)
            ->update(['stock' => DB::raw('stock - '.$retiro->metal) ]);
        }
        if ($retiro->textil > 0)    { 
            DB::table('stock')
            ->where('material_id', 6)
            ->update(['stock' => DB::raw('stock - '.$retiro->textil) ]);
        }
        if ($retiro->vidrio > 0)    { 
            DB::table('stock')
            ->where('material_id', 7)
            ->update(['stock' => DB::raw('stock - '.$retiro->vidrio) ]);
        }
        if ($retiro->natural > 0)     { 
            DB::table('stock')
            ->where('material_id', 8)
            ->update(['stock' => DB::raw('stock - '.$retiro->natural) ]);
        }
        if ($retiro->otros > 0)     { 
            DB::table('stock')
            ->where('material_id', 8)
            ->update(['stock' => DB::raw('stock - '.$retiro->otros) ]);
        }

        $retiro->aprobado = 'S';
        $retiro->aprobado_por = session('user')->id;
        $retiro->aprobado_fecha = date('Y-m-d');
        $retiro->save();
        return redirect()->route('retiros');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //DB::connection()->enableQueryLog();

        $data = request();
        $retiro = Retiro::create([
            'fecha' => $data["agno"]."-".$data["mes"]."-".$data["dia"],
            'nombre' => $data['nombre'],
            'institucion' => $data['institucion'],
            'distrito_id' => $data['distrito_id'],
            'evento' => $data['evento'],
            'lugar_retiro' => $data['lugar_retiro'],
            'proyecto_institucional' => $data['proyecto_institucional'],
            'aprobado' => 'N',
            'madera' => $data['madera'],
            'madera_obs' => $data['madera_obs'],
            'papel' => $data['papel'],
            'papel_obs' => $data['papel_obs'],
            'plastico' => $data['plastico'],
            'plastico_obs' => $data['plastico_obs'],
            'metal' => $data['metal'],
            'metal_obs' => $data['metal_obs'],
            'textil' => $data['textil'],
            'textil_obs' => $data['textil_obs'],
            'vidrio' => $data['vidrio'],
            'vidrio_obs' => $data['vidrio_obs'],
            'natural' => $data['natural'],
            'natural_obs' => $data['natural_obs'],
            'otros' => $data['otros'],
            'otros_obs' => $data['otros_obs']
        ]);

        //dd(DB::getQueryLog());
        $retiro_id = $retiro->retiro_id;
        return view('retiro_post', compact('retiro_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $retiro_id)
    {
        // DB::connection()->enableQueryLog();
        if ($request->session()->get('isAdmin')) $isAdmin = true; else $isAdmin = false;
        $retiro =DB::table('retiros')
        ->join('distrito', 'retiros.distrito_id', '=', 'distrito.distrito_id')
        ->leftJoin('users', 'retiros.aprobado_por', '=', 'users.id')
        ->where('retiros.retiro_id','=',$retiro_id)
        ->selectRaw('retiros.retiro_id, retiros.aprobado, retiros.fecha, DATE_FORMAT(retiros.aprobado_fecha, "%d/%m/%Y") AS aprobado_fecha, retiros.nombre, retiros.institucion, retiros.distrito_id, retiros.proyecto_institucional, retiros.aprobado_por, retiros.madera, retiros.madera_obs, retiros.papel, retiros.papel_obs,  retiros.plastico, retiros.plastico_obs, retiros.metal, retiros.metal_obs, retiros.textil, retiros.textil_obs, retiros.vidrio, retiros.vidrio_obs, retiros.natural, retiros.natural_obs, retiros.otros, retiros.otros_obs, retiros.evento, retiros.lugar_retiro, distrito.nombre AS nombreDistrito, users.name AS aprobador')
        ->first();   

        // dd(DB::getQueryLog());

        $materiales = DB::table('stock')->select('stock.*')->get();
        $stock = [];
        foreach ($materiales as $material){
            $stock[$material->codigo] = $material->stock;
        }

        return view('admin-retiro', compact('retiro', 'stock', 'retiro_id','isAdmin'));
    }

    public function displayForm(){
        $distritos = DB::table('distrito')
        ->orderBy('nombre')
        ->get();        
        return view('retiro', compact('distritos'));
    }

}
