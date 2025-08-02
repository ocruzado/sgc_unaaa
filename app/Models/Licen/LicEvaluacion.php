<?php

namespace App\Models\Licen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicEvaluacion extends Model
{
    use HasFactory;
    protected $table='lic_evaluacion';
    public $timestamps=true;
    protected $fillable=[
        'anio_grupo',
        'id_indicador',
        'id_mv',
        'sigla_mv',
        'estado',
        'tipo_eval'
    ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];


}