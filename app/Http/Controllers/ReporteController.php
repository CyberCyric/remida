<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use JavaScript;

class ReporteController extends Controller
{
    public function reporteStock(){  	
    	$entregas = DB::table('entrega')->count();
    	$retiros = DB::table('retiros')
    		->where('retiros.aprobado','S')
    		->count();
    	$empresas = DB::table('empresa')->count();
    	$materiales = DB::table('material')->select('nombre', 'stock')->get();
        return view('admin-reporte-stock', compact('entregas', 'retiros', 'empresas', 'materiales'));
	}

    public function reporteEmpresasRegistradas($desde = '', $hasta = ''){
        return view('admin-reporte-empresas-registradas');
    }

    public function getDataEmpresasRegistradas($desde = '', $hasta = ''){
        if ($desde == '') {$desde = date('Y')."-".date('m')."-01";}
        if ($hasta == '') {$hasta = date('Y')."-".date('m')."-31";}

        $empresas = DB::table('empresa')
        ->where('empresa.fecha_ingreso', '>=', $desde)
        ->where('empresa.fecha_ingreso', '<=', $hasta)
        ->selectRaw('empresa.razon_social, DATE_FORMAT(fecha_ingreso, "%d/%m/%Y") AS fecha_ingreso, CONCAT(
                IF(empresa.entrega_madera = "S", "MADERA, ", ""), 
                IF(empresa.entrega_papel = "S", "PAPEL, ", ""), 
                IF(empresa.entrega_carton = "S", "CARTON, ", ""), 
                IF(empresa.entrega_plastico = "S", "PLASTICO, ", ""), 
                IF(empresa.entrega_metal = "S", "METAL, ", ""), 
                IF(empresa.entrega_textil = "S", "TEXTIL, ", ""), 
                IF(empresa.entrega_vidrio = "S", "VIDRIO, ", ""), 
                IF(empresa.entrega_natural = "S", "NATURAL, ", ""), 
                IF(empresa.entrega_otros = "S", "OTROS, ", "") ) AS entrega')
        ->get();

        $json = json_encode($empresas);
        return  $json;    
    }

    public function reporteMapaDistritos($desde = '', $hasta = ''){
        return view('admin-reporte-mapa-distritos');
    }

    public function getDataLugaresEntrega($desde = '', $hasta = ''){

        if ($desde == '') {$desde = date('Y')."-".date('m')."-01";}
        if ($hasta == '') {$hasta = date('Y')."-".date('m')."-31";}

        $lugares = DB::table('retiros')
        ->where('retiros.aprobado_fecha', '>=', $desde)
        ->where('retiros.aprobado_fecha', '<=', $hasta)
        ->selectRaw('retiros.lugar_retiro, SUM(retiros.madera) AS MADERA,
            SUM(retiros.papel) AS PAPEL,
            SUM(retiros.carton) AS CARTON,
            SUM(retiros.plastico) AS PLASTICO,
            SUM(retiros.metal) AS METAL,
            SUM(retiros.textil) AS TEXTIL,
            SUM(retiros.vidrio) AS VIDRIO,
            SUM(retiros.natural) AS NATURAL_TOTAL,
            SUM(retiros.otros) AS OTROS')
        ->groupBy('retiros.lugar_retiro')
        ->get();

        $json = json_encode($lugares);
        return  $json;
    }

    function getDataLugaresEntregaTotales($desde = '', $hasta = ''){

        if ($desde == '') {$desde = date('Y')."-".date('m')."-01";}
        if ($hasta == '') {$hasta = date('Y')."-".date('m')."-31";}

        $lugares = DB::table('retiros')
        ->where('retiros.aprobado_fecha', '>=', $desde)
        ->where('retiros.aprobado_fecha', '<=', $hasta)
        ->selectRaw('retiros.lugar_retiro, COUNT(retiros.retiro_id) AS total')
        ->groupBy('retiros.lugar_retiro')
        ->get();

        $json = json_encode($lugares);
        return  $json;        
    }

    public function reporteLugaresEntrega(){
        return view('admin-reporte-lugar-entrega');
    }    

    public function reporteDistritosTotales($desde = '', $hasta = ''){
        if ($desde == '') {$desde = date('Y')."-".date('m')."-01";}
        if ($hasta == '') {$hasta = date('Y')."-".date('m')."-31";}       
        $retiros = DB::table('retiros')
        ->where('retiros.aprobado_fecha', '>=', $desde)
        ->where('retiros.aprobado_fecha', '<=', $hasta)
        ->groupBy('retiros.distrito_id')
        ->selectRaw('retiros.distrito_id, COUNT(retiros.distrito_id) AS total')
        ->get();

        $json = json_encode($retiros);
        return  $json;
    }

    public function getDataDistritos($desde = '', $hasta = ''){

        if ($desde == '') {$desde = date('Y')."-".date('m')."-01";}
        if ($hasta == '') {$hasta = date('Y')."-".date('m')."-31";}

        // DB::connection()->enableQueryLog();

        $retiros = DB::table('retiros')
        ->join('distrito', 'retiros.distrito_id', '=', 'distrito.distrito_id')
        ->where('retiros.aprobado_fecha', '>=', $desde)
        ->where('retiros.aprobado_fecha', '<=', $hasta)
        ->selectRaw('distrito.distrito_id, 
            SUM(retiros.madera) AS madera,
            SUM(retiros.papel) AS papel,
            SUM(retiros.carton) AS carton,
            SUM(retiros.plastico) AS plastico,
            SUM(retiros.metal) AS metal,
            SUM(retiros.textil) AS textil,
            SUM(retiros.vidrio) AS vidrio,
            SUM(retiros.natural) AS naturalTotal,
            SUM(retiros.otros) AS otros')
        ->groupBy('retiros.distrito_id')
        ->get();

        // dd(DB::getQueryLog());

        $json = json_encode($retiros);
        return  $json;
    }

    public function reporteDistritos(){
        return view('admin-reporte-distritos');
    }    

    public function reporteEntregas(){
        return view('admin-reporte-entregas');
    }

    public function getDataEntregas($desde = '', $hasta = ''){  

        if ($desde == '') {$desde = date('Y')."-".date('m')."-01";}
        if ($hasta == '') {$hasta = date('Y')."-".date('m')."-31";}

        $entregas = DB::table('entrega')
        ->join('entrega_item', 'entrega.entrega_id', '=', 'entrega_item.entrega_id')
        ->join('empresa', 'empresa.empresa_id', '=', 'entrega_item.empresa_id')
        ->join('material', 'entrega_item.material_id', '=', 'material.material_id')
        ->where('entrega.fecha', '>=', $desde)
        ->where('entrega.fecha', '<=', $hasta)
        ->selectRaw('entrega.entrega_id, DATE_FORMAT(entrega.fecha,"%d/%m/%Y") AS fecha, empresa.razon_social, entrega_item.*, material.nombre AS material')
        ->get();

        $json = json_encode($entregas);
        return  $json;
    }

    public function reporteStockHistorico($desde = '', $hasta = ''){

        if ($desde == '') {$desde = date('Y')."-".date('m')."-01";}
        if ($hasta == '') {$hasta = date('Y')."-".date('m')."-31";}

        $historico = DB::table('stock_historico')
        ->selectRaw('DATE_FORMAT(fecha, "%d/%m/%Y") AS fecha, madera, papel, carton, plastico, metal, textil, vidrio, naturales, otros')
        ->orderBy('fecha','DESC')
        ->limit(6)
        ->get();

        $labels = array();
        $dsMadera = array();
        $dsPapel = array();
        $dsCarton = array();
        $dsPlastico = array();
        $dsMetal = array();
        $dsTextil = array();
        $dsVidrio = array();
        $dsNatural = array();
        $dsOtros = array();

        $i = 0;
        foreach ($historico as $row){
            $labels[$i] = $row->fecha;
            $dsMadera[$i] = $row->madera;
            $dsPapel[$i] = $row->papel;
            $dsCarton[$i] = $row->carton;
            $dsPlastico[$i] = $row->plastico;
            $dsMetal[$i] = $row->metal;
            $dsTextil[$i] = $row->textil;
            $dsVidrio[$i] = $row->vidrio;
            $dsNatural[$i] = $row->naturales;
            $dsOtros[$i] = $row->otros;
            $i = $i + 1;
        }

        return view('admin-reporte-stock-historico', compact('labels','dsMadera','dsPapel','dsCarton','dsPlastico','dsMetal','dsTextil','dsVidrio','dsNatural','dsOtros'));
    }
 

}
