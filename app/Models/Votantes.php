<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Votos extends Model
{


    protected $connection = 'mysql';
    protected $table = 'votos';
    protected $fillable = ['id_evento','id_area','idvotante','aspirante', 'nombre', 'apellido'];
    public $timestamps = false;
	
}
