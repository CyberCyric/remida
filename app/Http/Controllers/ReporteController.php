<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use JavaScript;

class ReporteController extends Controller
{
    public function reporteStock(){  	
    	$cantidadEntregas = DB::table('entrega')->count();
        
        $cantidadRetiros = DB::table('retiros')
    		->where('retiros.aprobado','S')
    		->count();
        
        $cantidadEmpresas = DB::table('empresa')->count();  
        $materiales = DB::table('stock')->selectRaw('nombre, stock / 1000 AS stock')->get();
        
        $entregas = DB::table('entrega_item')
        ->join('stock', 'stock.material_id', '=', 'entrega_item.material_id')
        ->selectRaw('SUM(entrega_item.cantidad), stock.codigo')
        ->groupBy('stock.codigo')
        ->get();
        
        return view('admin-reporte-stock', compact('cantidadEntregas', 'cantidadRetiros', 'cantidadEmpresas', 'materiales'));
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
        ->selectRaw('empresa.razon_social, DATE_FORMAT(fecha_ingreso, "%d/%m/%Y") AS fecha_ingreso, empresa.tipo, CONCAT(
                IF(empresa.entrega_madera = "S", "MADERA, ", ""), 
                IF(empresa.entrega_papel = "S", "PAPEL, ", ""), 
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

    public function getDataReporteRetiros($desde = '', $hasta = ''){

        if ($desde == '') {$desde = date('Y')."-".date('m')."-01";}
        if ($hasta == '') {$hasta = date('Y')."-".date('m')."-31";}

        $centro = DB::table('retiros')
        ->where('retiros.aprobado_fecha', '>=', $desde)
        ->where('retiros.aprobado_fecha', '<=', $hasta)
        ->where('retiros.lugar_retiro', '=', 'CENTRO')
        ->selectRaw('SUM(retiros.madera) AS MAD,
            SUM(retiros.papel) AS PYC,
            SUM(retiros.plastico) AS PLA,
            SUM(retiros.metal) AS MET,
            SUM(retiros.textil) AS TEX,
            SUM(retiros.vidrio) AS VID,
            SUM(retiros.natural) AS NAT,
            SUM(retiros.otros) AS OTR')
        ->get();

        $viajero = DB::table('retiros')
        ->where('retiros.aprobado_fecha', '>=', $desde)
        ->where('retiros.aprobado_fecha', '<=', $hasta)
        ->where('retiros.lugar_retiro', '=', 'VIAJERO')
        ->selectRaw('SUM(retiros.madera) AS MAD,
            SUM(retiros.papel) AS PYC,
            SUM(retiros.plastico) AS PLA,
            SUM(retiros.metal) AS MET,
            SUM(retiros.textil) AS TEX,
            SUM(retiros.vidrio) AS VID,
            SUM(retiros.natural) AS NAT,
            SUM(retiros.otros) AS OTR')
        ->get();

        $eventos = DB::table('retiros')
        ->where('retiros.aprobado_fecha', '>=', $desde)
        ->where('retiros.aprobado_fecha', '<=', $hasta)
        ->where('retiros.lugar_retiro', '=', 'EVENTOS')
        ->selectRaw('SUM(retiros.madera) AS MAD,
            SUM(retiros.papel) AS PYC,
            SUM(retiros.plastico) AS PLA,
            SUM(retiros.metal) AS MET,
            SUM(retiros.textil) AS TEX,
            SUM(retiros.vidrio) AS VID,
            SUM(retiros.natural) AS NAT,
            SUM(retiros.otros) AS OTR')
        ->get();

        $retiros["LABELS"] = array("Madera (grms)","Papel y Cartón (grms)","Plástico (grms)","Metal (grms)","Textil (grms)","Vidrio (grms)","Natural (grms)","Otros (grms)");

        $retiros["DATA"]["CENTRO"] = $centro;
        $retiros["DATA"]["VIAJERO"] = $viajero;
        $retiros["DATA"]["EVENTOS"] = $eventos;

        return  $retiros;
    }

    public function reporteRetiros(){
        return view('admin-reporte-retiros');
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
        ->join('stock', 'entrega_item.material_id', '=', 'stock.material_id')
        ->where('entrega.fecha', '>=', $desde)
        ->where('entrega.fecha', '<=', $hasta)
        ->selectRaw('entrega.orden, DATE_FORMAT(entrega.fecha,"%d/%m/%Y") AS fecha, empresa.razon_social, empresa.tipo, entrega_item.*, stock.codigo')
        ->get();

        $json = json_encode($entregas);
        return  $json;
    }
    
    public function reporteStockHistorico($desde = '', $hasta = ''){

        if ($desde == '') {$desde = date('Y')."-".date('m')."-01";}
        if ($hasta == '') {$hasta = date('Y')."-".date('m')."-31";}

        $historico = DB::table('stock_historico')
        ->selectRaw('DATE_FORMAT(fecha, "%d/%m/%Y") AS fecha, madera / 100 AS madera, papel / 100 AS papel, plastico / 100 AS plastico, metal / 100 AS metal, textil / 100 AS textil, vidrio / 100 AS vidrio, naturales / 100 AS naturales, otros / 100 AS otros')
        ->orderBy('stock_historico.fecha','DESC')
        ->limit(6)
        ->get();

        $labels = array();
        $dsMadera = array();
        $dsPapel = array();
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
            $dsPlastico[$i] = $row->plastico;
            $dsMetal[$i] = $row->metal;
            $dsTextil[$i] = $row->textil;
            $dsVidrio[$i] = $row->vidrio;
            $dsNatural[$i] = $row->naturales;
            $dsOtros[$i] = $row->otros;
            $i = $i + 1;
        }

        return view('admin-reporte-stock-historico', compact('labels','dsMadera','dsPapel','dsPlastico','dsMetal','dsTextil','dsVidrio','dsNatural','dsOtros'));
    }
 

}
