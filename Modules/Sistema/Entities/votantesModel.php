<?php

namespace Modules\Sistema\Entities;

use Illuminate\Database\Eloquent\Model;

class votantesModel extends Model
{
    protected $connection = 'mysql';
	
	public $timestamps = false;
	
	public $table = 'votantes';
	public $fillable = ['id','idterminal','id_evento','asociado','fecha'];
	
}
	
	
	
	
	
	