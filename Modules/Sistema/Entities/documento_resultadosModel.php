<?php

namespace Modules\Sistema\Entities;

use Illuminate\Database\Eloquent\Model;

class documento_resultadosModel extends Model
{
    protected $connection = 'mysql';
	
	public $timestamps = false;
	
	public $table = 'documento_resultados';
	public $fillable = ['idrestdoc','id_evento','superior','inferior'];
	
}
