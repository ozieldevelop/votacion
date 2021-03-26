<?php

namespace Modules\Cliente\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ViewSuscriptores extends Model
{
    use HasFactory;

    protected $fillable = ['id_suscriptor', 'id_tema', 'tema_parent_id', 'titulo', 'cldoc', 'nombre', 'order' ];
    protected $table = 'v_suscriptor_tema';
}
