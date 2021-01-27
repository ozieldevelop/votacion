<?php

namespace Modules\Sistema\Entities;

use Illuminate\Database\Eloquent\Model;

class vt_enviosModel extends Model
{
    protected $connection = 'mysql';
	
	public $timestamps = false;
	
	public $table = 'vt_envios';
	public $fillable = ['id_evento','IDAGEN','CLDOC','NOMBRE','CORREO','agregado','pendiente','enviados','fallido' ];
	
}



	