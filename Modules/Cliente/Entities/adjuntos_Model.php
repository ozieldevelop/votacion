<?php

namespace Modules\Cliente\Entities;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Factories\HasFactory;

class adjuntos_Model extends Model
{
    //use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'files_up';
    protected $fillable = ['id','etiqueta', 'name_system', 'extension', 'tipoarchivo', 'sizefile', 'fecha_upload', 'eliminado'];
    public $timestamps = false;
  
    
    /*
    protected static function newFactory()
    {
        return \Modules\Cliente\Database\factories\FilesUpModelFactory::new();
    }
    */
}


