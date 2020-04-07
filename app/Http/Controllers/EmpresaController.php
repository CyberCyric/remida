<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Empresa;

class EmpresaController extends Controller
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

    public function list(){

        $empresas = DB::table('empresa')
        ->selectRaw('empresa.*')
        ->orderBy('empresa.razon_social', 'asc')
        ->paginate(100);        

        return view('admin-empresas', compact('id', 'empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-empresa-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
     {
        $data = request();
        if ($data['razon_social'] != ''){
            $empresa = Empresa::create([
                'razon_social' => $data['razon_social'],
                'tipo' => $data['tipo'],
                'direccion' => $data['direccion'],
                'contacto' => $data['contacto'],
                'telefono' => $data['telefono'],
                'email' => $data['email'],
                'entrega_madera'=> $data['entrega_madera'],
                'entrega_papel'=> $data['entrega_papel'],
                'entrega_carton'=> $data['entrega_carton'],
                'entrega_plastico'=> $data['entrega_plastico'],
                'entrega_metal'=> $data['entrega_metal'],
                'entrega_textil'=> $data['entrega_textil'],
                'entrega_vidrio'=> $data['entrega_vidrio'],
                'entrega_natural'=> $data['entrega_natural'],
                'entrega_otros'=> $data['entrega_otros'],
                'observaciones' => $data['observaciones']
            ]);
        }
        return redirect()->route('empresas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = Empresa::find($id);
        return view('admin-empresa-edit', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function edit(Request $request, $id = 0)
    {
        $empresa = Empresa::findOrNew($id);
        $empresa->fill($request->all());
        $empresa->save();
        return redirect()->route('empresas');
    }
    */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $data = request();
        $empresa = Empresa::find($id);
        $empresa->razon_social = $data['razon_social'];
        $empresa->tipo = $data['tipo'];
        $empresa->direccion = $data['direccion'];
        $empresa->contacto = $data['contacto'];
        $empresa->telefono = $data['telefono'];
        $empresa->email = $data['email'];
        $empresa->entrega_madera = $data['entrega_madera'];
        $empresa->entrega_papel = $data['entrega_papel'];
        $empresa->entrega_papel = $data['entrega_papel'];
        $empresa->entrega_carton = $data['entrega_carton'];
        $empresa->entrega_plastico = $data['entrega_plastico'];
        $empresa->entrega_metal = $data['entrega_metal'];
        $empresa->entrega_textil = $data['entrega_textil'];
        $empresa->entrega_vidrio = $data['entrega_vidrio'];
        $empresa->entrega_natural = $data['entrega_natural'];
        $empresa->entrega_otros = $data['entrega_otros'];
        $empresa->observaciones = $data['observaciones'];
        $empresa->save();
        return redirect()->route('empresas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
