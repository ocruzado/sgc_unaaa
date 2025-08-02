<?php

namespace App\Models\Licen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicIndicadores extends Model
{
    use HasFactory;
    protected $table='lic_indicador';
    public $timestamps=true;
    
    protected $fillable=[
        'id_condicion',
        'id_componente',
        'nom_indicador',
        'descrip',
        'priorizado'
    ];

    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];
}