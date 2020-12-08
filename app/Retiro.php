<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retiro extends Model
{    
    protected  $primaryKey = 'retiro_id';
    protected $fillable = [
    	'fecha',
    	'nombre',
        'email',
    	'institucion',
    	'distrito_id',
    	'proyecto_institucional',
        'evento',
        'lugar_retiro',
    	'aprobado',
    	'madera',
    	'madera_obs',
    	'papel',
    	'papel_obs',
    	'carton',
    	'carton_obs',
    	'plastico',
    	'plastico_obs',
    	'metal',
    	'metal_obs',
    	'textil',
    	'textil_obs',
    	'vidrio',
    	'vidrio_obs',
        'natural',
        'natural_obs',
    	'otros',
    	'otros_obs'
    ];
}
