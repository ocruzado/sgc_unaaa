<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sgc\GestionCambios;


class Oficinas extends Model
{
    use HasFactory;
    protected $table='tb_oficinas';
    public $timestamps=true;
    protected $fillable=['nombre','id_parent'];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

    public function gestionCambios()
    {
        return $this->hasMany(GestionCambios::class, 'id_oficina', 'id');
    }

}
