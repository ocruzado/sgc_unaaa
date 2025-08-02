<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisoUsuario extends Model
{
    use HasFactory;
    protected $table='tb_permiso_usuario';
    public $timestamps=true;
    protected $fillable=['id_usuario','id_modulo','estado'];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];
}
