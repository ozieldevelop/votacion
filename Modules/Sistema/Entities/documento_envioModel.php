<?php

namespace Modules\Sistema\Entities;

use Illuminate\Database\Eloquent\Model;

class documento_envioModel extends Model
{
    protected $connection = 'mysql';
	
	public $timestamps = false;
	
	public $table = 'documento_envio';
	public $fillable = ['iddocsend','id_evento','asunto','texto'];
	
}
