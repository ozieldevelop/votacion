<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{


    protected $connection = 'mysql';
    protected $table = 'users';
    protected $fillable = ['id','name', 'email', 'password'];
    public $timestamps = false;
	
}
