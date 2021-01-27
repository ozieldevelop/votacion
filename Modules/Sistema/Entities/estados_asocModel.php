<?php

namespace Modules\Sistema\Entities;

use Illuminate\Database\Eloquent\Model;

class estados_asocModel extends Model
{
    protected $connection = 'mysql';
	
	public $timestamps = false;
	
	public $table = 'estados_asoc';
	public $fillable = ['id_estado','estado'];
	
}
