<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Distrito;

class DistritoController extends Controller
{
    public function list(){
        $myArray = array();
        $distritos = DB::select('SELECT * FROM distrito');
        foreach ($distritos as $distrito){
                    $myArray[] = array("distrito_id" => $distrito->distrito_id, "nombre" => $distrito->nombre);
        }
        //convert to json
        $json = json_encode($myArray);
        return  $json;
    }
}
