<?php

namespace App\Models\Licen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicComponentes extends Model
{
    use HasFactory;
    protected $table='lic_componente';
    public $timestamps=true;
    protected $fillable=[
        'id_condicion',
        'cod_componente',
        'nom_componente',
        'priorizado'
    ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];


}