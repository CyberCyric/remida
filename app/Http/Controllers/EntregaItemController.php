<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\EntregaItem;
use App\Empresa;
use App\Entrega;

class EntregaItemController extends Controller
{
     public function showItems($entrega_id)
    {
       $items = DB::table('entrega_item')
        ->join('empresa', 'empresa.empresa_id', '=', 'entrega_item.empresa_id')
        ->join('stock', 'stock.material_id', '=', 'entrega_item.material_id')
        ->where('entrega_item.entrega_id', '=', $entrega_id)
        ->selectRaw('entrega_item.item_id, entrega_item.entrega_id, entrega_item.empresa_id, entrega_item.material_id, (entrega_item.cantidad / 1000) AS cantidad, entrega_item.descripcion, empresa.razon_social, stock.nombre AS material')
        ->paginate(100);

        $materiales = DB::table('stock')->get();

        $empresas = DB::table('empresa')->orderBy('razon_social')->get();

        $entrega = Entrega::find($entrega_id);

        return view('admin-entrega-items', compact('entrega_id', 'items', 'empresas', 'entrega', 'materiales'));
    }

    public function removeItem($entrega_id, $item_id){

        $item = DB::table('entrega_item')->where('item_id' , '=', $item_id)->first();

        DB::table('stock')
            ->where('material_id', $item->material_id)
            ->decrement('stock', $item->cantidad);

        DB::table('entrega_item')
            ->where('entrega_id', '=', $entrega_id)
            ->where('item_id', '=', $item_id)
            ->delete();

            return($entrega_id);

    }

    public function storeItem(Request $request)
     {
        $data = request();
        $item = EntregaItem::create([
            'entrega_id' => $data['entrega_id'],
            'empresa_id' => $data['empresa_id'],
            'material_id' => $data['material_id'],
            'cantidad' => $data['cantidad'] * 1000,
            'descripcion' => $data['descripcion']
        ]);
        
        $empresa = Empresa::find($data['empresa_id']);
        if (!($empresa->fecha_ingreso >0)){
            DB::table('empresa')
            ->where('empresa_id', $data['empresa_id'])
            ->update(['fecha_ingreso' => date('Y-m-d') ]);
        }

        DB::table('stock')
            ->where('material_id', $data['material_id'])
            ->increment('stock', $data['cantidad'] * 1000);

        return redirect('admin/entrega_items/'.$data['entrega_id']);
    }


}
