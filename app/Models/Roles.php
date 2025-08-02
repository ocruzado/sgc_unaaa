<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $table='tb_roles';
    public $timestamps=true;
    protected $fillable=['nom_rol'];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];
}