<?php

namespace Modules\Sistema\Entities;

use Illuminate\Database\Eloquent\Model;

class vtaspiranteModel extends Model
{
    protected $connection = 'mysql';
	
	public $timestamps = false;
	
	public $table = 'vt_aspirantes';
	public $fillable = ['id_evento','tipo_evento','nombreevento','id_area','area_etiqueta','id_delegado','trato','num_cliente','nombre','apellido','img_delegado','estado','user_audit','fecha_aud','foto','tipo'];
	
}
