<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAsistenciaVotacion extends Model
{


    protected $connection = 'mysql';
    protected $table = 'votantes';
    protected $fillable = ['idterminal','id_evento', 'asociado', 'json_data'];
    public $timestamps = false;
	
}
