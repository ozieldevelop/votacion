<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataClientes extends Model
{
    protected $connection = 'mysql';
    protected $table = 'data_clientes';
    protected $fillable = ['CLDOC','CLASOC','IDAGEN','AGENCIA','APARTADO','NOMBRE','TELEFONO','CORREO','VALF1','VALF2','id_tipo','tipo','celular','fecha_nac','fecha_ingreso','fecha_retiro','fecha_exp','fecha_reingreso1','fecha_reingreso2','id_sexo','id_estado','estado','id_ocupacion','ocupacion','id_profesion','profesion','id_pais','send_mail','send_mail_coop','send_ec','send_tarj','send_ec_mail','firma','trato'];
    public $timestamps = false;
}
