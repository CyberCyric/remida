<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
	protected $table = 'empresa';
    protected  $primaryKey = 'empresa_id';
    protected $fillable = [
    	'razon_social',
    	'fecha_ingreso',
    	'tipo',
        'direccion',
    	'contacto',
    	'telefono',
    	'email',
    	'observaciones',
        'entrega_madera',
        'entrega_papel',
        'entrega_carton',
        'entrega_plastico',
        'entrega_metal',
        'entrega_textil',
        'entrega_vidrio',
        'entrega_natural',
        'entrega_otros'
    ];
}
