<?php

namespace Modules\Sistema\Entities;

use Illuminate\Database\Eloquent\Model;

class aspiranteModel extends Model
{
    protected $connection = 'mysql';
	
	public $timestamps = false;
	
	public $table = 'directivos';
	public $fillable = ['id_delegado','num_cliente','nombre','apellido','img_delegado','estado','user_audit','fecha_aud','foto','tipo'];
	
}
