<?php

namespace Modules\Cliente\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeTrack extends Model
{
    use HasFactory;

    protected $fillable = [ 'id', 'id_subs', 'id_tema', 'parent_id', 'children_id', 'cldoc', 'date', 'h', 'm', 's'];
    protected $table = 'ordp_times';

    public $timestamps = false;
    
    protected static function newFactory()
    {
        return \Modules\Cliente\Database\factories\TimeTrackFactory::new();
    }
}
