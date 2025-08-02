<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    use HasFactory;
    protected $table='tb_modulos';
    public $timestamps=true;
    protected $fillable=['nivel','id_parent','nombre'];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];
}
