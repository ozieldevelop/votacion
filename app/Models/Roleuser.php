<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Roleuser extends Model
{

    protected $connection = 'mysql';
    protected $table = 'role_user';
    protected $fillable = ['role_id', 'user_id', 'user_type'];
    public $timestamps = false;
	
	
}
