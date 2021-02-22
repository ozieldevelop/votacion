<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{


    protected $connection = 'mysql';
    protected $table = 'asistencia';
    protected $fillable = ['id_evento','tipoevent','num_cliente','trato','nombre','agencia','fecha_nacimiento','tipo','foto','asistire','f_asistire_regis','soy_aspirante','cantidato_delegado','junta_directores','junta_vigilancia','comite_credito','veri_zoom_email','veri_url','veri_id_zoom'];
    public $timestamps = false;
	
}


