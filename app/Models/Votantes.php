<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Votos extends Model
{


    protected $connection = 'mysql';
    protected $table = 'votos';
    protected $fillable = ['idvotante','id_evento', 'aspirante', 'nombre', 'apellido'];
    public $timestamps = false;
	
}
