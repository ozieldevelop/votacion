<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Permissionuser extends Model
{

    protected $connection = 'mysql';
    protected $table = 'permission_user';
    protected $fillable = ['permission_id', 'user_id', 'user_type'];
	
    public $timestamps = false;
	
	
}
