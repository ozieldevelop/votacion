<?php

namespace Modules\Sistema\Entities;

use Illuminate\Database\Eloquent\Model;

class votosModel extends Model
{
    protected $connection = 'mysql';
	
	public $timestamps = false;
	
	public $table = 'votos';
	public $fillable = ['id','idvotante','id_evento','aspirante','nombre','apellido'];
	
}
	