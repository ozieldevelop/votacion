<?php

namespace Modules\Sistema\Entities;

use Illuminate\Database\Eloquent\Model;

class evento_directivosModel extends Model
{
    protected $connection = 'mysql';
	
	public $timestamps = false;
	
	public $table = 'evento_directivos';
	public $fillable = ['id_dire_even','id_evento','id_delegado','id_area'];
	
}
	