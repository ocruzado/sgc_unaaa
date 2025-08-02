<?php

namespace App\Models\Licen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicMV extends Model
{
    use HasFactory;
    protected $table='lic_mv';
    public $timestamps=true;
    protected $fillable=[
        'id_indicador',
        'sigla_mv',
        'nom_mv',
        'consids',
        'id_responsable'
    ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];


}