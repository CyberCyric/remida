<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
  	protected $table = 'entrega';
    protected  $primaryKey = 'entrega_id';
    protected $fillable = [
        'fecha',
        'orden',
    	'empresa_id',
    	'madera',
        'papel',
        'carton',
        'plastico',
        'metal',
        'textil',
        'vidrio',
        'natural',
        'otros',

        'madera_obs',
        'papel_obs',
        'carton_obs',
        'plastico_obs',
        'metal_obs',
        'textil_obs',
        'vidrio_obs',
        'natural_obs',
        'otros_obs'
    ];
}
