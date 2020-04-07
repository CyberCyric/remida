<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntregaItem extends Model
{
  	protected $table = 'entrega_item';
    protected $primaryKey = 'item_id';
    protected $fillable = ['entrega_id', 'empresa_id', 'material_id', 'cantidad', 'descripcion'];
}
