<?php

namespace Modules\Cliente\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemasSuscriptores extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'parent_id',
        'children_id',
        'cldoc',
    ];
    protected $table = 'ordp_suscriptores';
    public $timestamps = false;
    
    protected static function newFactory()
    {
        return \Modules\Cliente\Database\factories\TemasSuscriptoresFactory::new();
    }
}
