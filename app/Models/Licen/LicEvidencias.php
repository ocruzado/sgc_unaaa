<?php

namespace App\Models\Licen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicEvidencias extends Model
{
    use HasFactory;
    protected $table='lic_evidencia';
    public $timestamps=true;
    
    protected $fillable=[
        'anio_grupo',
        'id_indicador',
        'id_mv',
        'nom_evidencia',
        'tipo_docu',
        'id_sisades',
        'id_sgc',
        'sgc_niv0',
        'sgc_niv1',
        'adjunto',
        'adjuntos',
        'al_2019',
        'al_2024',
        'id_usuario',
        'nom_usuario',
        'estado'
    ];

    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];
}