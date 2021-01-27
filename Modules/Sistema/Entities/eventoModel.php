<?php

namespace Modules\Sistema\Entities;

use Illuminate\Database\Eloquent\Model;

class eventoModel extends Model
{
    protected $connection = 'mysql';
	
	public $timestamps = false;
	
	public $table = 'evento';
	public $fillable = ['id','nombre','rangofecha1','rangofecha2','maxvotos','capitulos','estadosasoc','status','tipo'];
	
}
	