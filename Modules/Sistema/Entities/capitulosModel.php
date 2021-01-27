<?php

namespace Modules\Sistema\Entities;

use Illuminate\Database\Eloquent\Model;

class capitulosModel extends Model
{
    protected $connection = 'mysql';
	
	public $timestamps = false;
	
	public $table = 'capitulos';
	public $fillable = ['IDAGEN','AGENCIA'];
	
}
