<?php

namespace Modules\Sistema\Entities;

use Illuminate\Database\Eloquent\Model;

class asamblea_estructuraModel extends Model
{
    protected $connection = 'mysql';
	
	public $timestamps = false;
	
	public $table = 'asamblea_estructura';
	public $fillable = ['id_ae','etiqueta'];
	
}
