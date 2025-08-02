<?php

namespace App\Models\Licen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicCondiciones extends Model
{
    use HasFactory;
    protected $table='lic_condicion';
    public $timestamps=true;
    protected $fillable=[
        'sigla_condic',
        'nom_condicion',
        'descrip',
        'priorizado'
    ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];


}