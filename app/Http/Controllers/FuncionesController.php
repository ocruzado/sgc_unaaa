<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;


use App\Models\Indicadores;


use App\Models\mvLicencias;
use App\Models\Oficinas;

use App\Models\PermisoUsuario;

use App\Models\Roles;
use App\Models\User;
use App\Models\Modulos;  



use App\Models\Licen\LicIndicadores;
use App\Models\Licen\LicEvidencias;

use App\Models\Licen\LicMV;
use App\Models\Licen\LicEvaluacion;
use App\Models\Licen\LicCondiciones;



class FuncionesController extends Controller
{


    public function nom_rol($id)
    {
        $dt=Roles::find($id);
        return $dt->nom_rol;
    }

    public function nom_responsable($id)
    {
        $v_respon='';
        if (is_numeric($id)) {
            $dt=Oficinas::find($id);
            if ($dt) {
               $v_respon=$dt->nombre;
            }
        }else{
            if ($id!='') {
                $ids_responsable = $id; 
                $ids_responsable_array = explode(',', $ids_responsable);

                if (count($ids_responsable_array)>0) {
                    foreach ($ids_responsable_array as $id_respo) {
                        $dt_r=Oficinas::find($id_respo);
                        if ($dt_r) {
                            $v_respon.=$dt_r->nombre.',';
                        }
                    }            
                }            
            }
        }
        

        return $v_respon;
    }







    public function llave_usuario($texto)
    {
        $txt_llave='';
        if($texto!=''){ $txt_llave=Crypt::decryptString($texto); } 
        return $txt_llave;
    }



    public function usu_carrera($id_car)
    {
        $dt=User::where('id_carrera',$id_car)->first();
        $usuario='';
        if ($dt) {
            $usuario=$dt->email;
        }
        return $usuario;
    }

    public function acceso_modulo($id_user,$id_modulo)
    {
        $dt=PermisoUsuario::where('id_usuario',$id_user)->where('id_modulo',$id_modulo)->where('estado',1)->count('id');
        return $dt;
    }










    public function cmb_responsables()
    {
        $dt=Responsable::get();
        return $dt;
    }






  

    public function submenus($id_padre)
    {
        $dt= Modulos::where('id_parent',$id_padre)->where('nivel',2)->get();
        return $dt;
    }





    // licen
    public function rpt_lic19_datos($anio){
        $dt=LicIndicadores::get();

        $datos='';
        $x=1;
        foreach ($dt as $indic) {

            $dt_tot=LicEvidencias::where('id_indicador',$indic->id)->where('anio_grupo',$anio)->where('estado',1)->count('id');
            $datos.=$dt_tot;

            if ($x < $dt->count()) { $datos.=','; }
            $x++;
        }
        return '['.$datos.']';
    }


    public function rpt_lic19_etiquetas(){
        $dt=LicIndicadores::get();

        $datos='';
        $x=1;
        foreach ($dt as $row) {
            $datos.=$row->id;
            if ($x < $dt->count()) { $datos.=','; }
            $x++;
        }
        return '['.$datos.']';
    }


    public function rpt_lic19_datos_estado($estado,$anio,$tipo_eval)
    {
        $datos='';
        $dt_indics=LicIndicadores::get();
        

        foreach ($dt_indics as $row) {
            $val_item=0;

            $dt_eval=LicEvaluacion::where('anio_grupo',$anio)->where('estado',$estado)->where('tipo_eval',$tipo_eval)->where('id_indicador',$row->id)->count('id');
            $dt_mvs=LicMV::where('id_indicador',$row->id)->count('id');

            $dt_no_ap=LicMV::where('id_indicador',$row->id)->where('aplica',0)->count('id');

            if($estado=='NM'){
                if($dt_eval == $dt_mvs){ $val_item=1; }else{ $val_item=0; } // No mantiene
            }


            if($estado=='PM'){
                if(($dt_eval == $dt_mvs || $dt_eval>0) && $dt_no_ap==0){ $val_item=3; }else{ $val_item=0; }
                $dt_sm=LicEvaluacion::where('anio_grupo',$anio)->where('id_indicador',$row->id)->where('estado','SM')->where('tipo_eval',$tipo_eval)->count('id');

                if($dt_sm > 0 && $dt_sm <  ($dt_mvs - $dt_no_ap)){ $val_item=3; }
            }
            

            if($estado=='SM'){
                if($dt_eval == ($dt_mvs - $dt_no_ap) && $dt_eval>0){ $val_item=5; }else{ $val_item=0; } // Se mantiene
            }

            if($estado=='NP'){
                if($dt_eval == $dt_mvs){ $val_item=1; }else{ $val_item=0; } // No Aplica
            }


            $datos.=intval($val_item);
            if($row->id<55){ $datos.=','; }
            
        }

        return '['.$datos.']';
    }




    public function rpt_lic19_porcent_indic($estado,$anio,$tipo_eval)
    {
        $indic_estado=0;
        $grupo_indics='';

        $dt_indics=LicIndicadores::get();
        

        foreach ($dt_indics as $row) {
            $mvs_aplica=LicMV::where('aplica',1)->where('id_indicador',$row->id)->count('id');

            $mvs_no_aplica=LicMV::where('aplica',0)->where('id_indicador',$row->id)->count('id');
            $mvs_indic=LicMV::where('id_indicador',$row->id)->count('id');

            $dt_estado=LicEvaluacion::where('anio_grupo',$anio)->where('estado',$estado)->where('tipo_eval',$tipo_eval)->where('id_indicador',$row->id)->count('id');

            if($estado=='SM'){
                if($dt_estado==$mvs_aplica && $mvs_aplica>0){ 
                    $indic_estado++; 
                }
            }
           

            if($estado=='PM'){
                $dt_estado_si=LicEvaluacion::where('anio_grupo',$anio)->where('estado','SM')->where('tipo_eval',$tipo_eval)->where('id_indicador',$row->id)->count('id');
                if(($dt_estado>0 || ($dt_estado_si<$mvs_aplica && $dt_estado_si>0)) && $mvs_aplica>0){ 
                    $indic_estado++; 
                }
            }


            if($estado=='NM'){
                if($dt_estado==$mvs_aplica && $mvs_aplica>0){ 
                    $indic_estado++; 
                }
            }

            if($estado=='NOP'){
                if($mvs_no_aplica==$mvs_indic){ 
                    $indic_estado++; 
                }
            }
        }

        return $indic_estado;
    }



    public function rpt_lic19_porcent_mv($estado,$anio,$tipo_eval)
    {
        $mvs_estado=0;
        $mvs_aplica=LicMV::where('aplica',1)->count('id');


        if($estado=='SM' || $estado=='PM' || $estado=='NM'){
            $mvs_estado=LicEvaluacion::where('anio_grupo',$anio)->where('estado',$estado)->where('tipo_eval',$tipo_eval)->count('id');
        }else{
            
            if($estado=='SIN'){
                $dt_aplica=LicMV::where('aplica',1)->get();
                foreach ($dt_aplica as $mv) {
                    $existe_estado=LicEvaluacion::where('anio_grupo',$anio)->where('tipo_eval',$tipo_eval)->where('id_mv',$mv->id)->count('id');
                    if($existe_estado==0){ $mvs_estado++; }
                }
            }

            if($estado=='NOP'){
                //$mvs_estado=LicMV::where('aplica',0)->count('id');
                $mvs_estado=LicEvaluacion::where('anio_grupo',$anio)->where('tipo_eval',$tipo_eval)->where('estado','NP')->count('id');
            }
        }

        return $mvs_estado;
    }




    public function rpt_lic19_prios_label()
    {
        $datos='';
        $indics_prios=LicIndicadores::where('priorizado',1)->get();

        foreach ($indics_prios as $indic) {
            $datos.=$indic->id;
            if($indic->id < 50){ $datos.=','; }
        }
        

        return '['.$datos.']';
    }



    public function rpt_lic19_prios($estado,$anio,$tipo_eval)
    {
        $datos='';
        $dt_indics=LicIndicadores::where('priorizado',1)->get();
        

        foreach ($dt_indics as $row) {
            $val_item=0;

            $dt_eval=LicEvaluacion::where('anio_grupo',$anio)->where('estado',$estado)->where('tipo_eval',$tipo_eval)->where('id_indicador',$row->id)->count('id');
            $dt_mvs=LicMV::where('id_indicador',$row->id)->count('id');

            $dt_no_ap=LicMV::where('id_indicador',$row->id)->where('aplica',0)->count('id');

            if($estado=='NM'){
                if($dt_eval == $dt_mvs){ $val_item=1; }else{ $val_item=0; } // No mantiene
            }


            if($estado=='PM'){
                if(($dt_eval == $dt_mvs || $dt_eval>0) && $dt_no_ap==0){ $val_item=3; }else{ $val_item=0; }
                $dt_sm=LicEvaluacion::where('anio_grupo',$anio)->where('id_indicador',$row->id)->where('estado','SM')->where('tipo_eval',$tipo_eval)->count('id');

                if($dt_sm > 0 && $dt_sm <  ($dt_mvs - $dt_no_ap)){ $val_item=3; }
            }
            

            if($estado=='SM'){
                if($dt_eval == ($dt_mvs - $dt_no_ap) && $dt_eval>0){ $val_item=5; }else{ $val_item=0; } // Se mantiene
            }


            $datos.=intval($val_item);
            if($row->id<50){ $datos.=','; }
            
        }

        return '['.$datos.']';
    }



    public function rpt_lic19_prios_mv($estado,$anio,$tipo_eval)
    {
        $mvs_estado=0;
        $mvs_count=0;
        $dt_indics=LicIndicadores::where('priorizado',1)->get();

        foreach ($dt_indics as $indic) {

            $mvs_aplica=LicMV::where('aplica',1)->where('id_indicador',$indic->id)->count('id');
            if($estado=='SM' || $estado=='PM' || $estado=='NM'){
                $mvs_estado=LicEvaluacion::where('anio_grupo',$anio)->where('id_indicador',$indic->id)->where('estado',$estado)->where('tipo_eval',$tipo_eval)->count('id');
                $mvs_count= $mvs_count + $mvs_estado; 
            }else{

                if($estado=='SIN'){
                    $dt_aplica=LicMV::where('aplica',1)->where('id_indicador',$indic->id)->get();
                    foreach ($dt_aplica as $mv) {
                        $existe_estado=LicEvaluacion::where('anio_grupo',$anio)->where('id_indicador',$indic->id)->where('tipo_eval',$tipo_eval)->where('id_mv',$mv->id)->count('id');
                        if($existe_estado==0){ 
                            $mvs_estado++;
                            $mvs_count++;
                        }
                    }
                }

                if($estado=='NOP'){
                    $mvs_estado=LicMV::where('aplica',0)->where('id_indicador',$indic->id)->count('id');
                    $mvs_count= $mvs_count + $mvs_estado; 
                }

            }

        }


        return $mvs_count;
    }




    public function lic19_estado_mv($anio,$id_mv,$tipo_eval)
    {
        $mv_estado='SIN';
        $dt_eval=LicEvaluacion::where('anio_grupo',$anio)->where('id_mv',$id_mv)->where('tipo_eval',$tipo_eval)->first();

        if($dt_eval){
            $mv_estado=$dt_eval->estado;
        }
        
        return $mv_estado;
    }



    public function lic19_por_cbc($estado,$anio)
    {
        $datos='';
        $dt_cbc=LicCondiciones::get();
        foreach($dt_cbc as $row){
            $v_cbc=0;

            $dt_indics=LicIndicadores::where('id_condicion',$row->id)->get();
            foreach ($dt_indics as $indic) {
                if($estado=='SM'){
                    $dt_sm=LicEvaluacion::where('id_indicador',$indic->id)->where('estado','SM')->where('anio_grupo',$anio)->where('tipo_eval','DOCUMENTAL')->count('id');
                    $v_cbc=$v_cbc + $dt_sm;
                }

                if($estado=='PM'){
                    $dt_pm=LicEvaluacion::where('id_indicador',$indic->id)->where('estado','PM')->where('anio_grupo',$anio)->where('tipo_eval','DOCUMENTAL')->count('id');
                    $v_cbc=$v_cbc + $dt_pm;
                }

                if($estado=='NM'){
                    $dt_nm=LicEvaluacion::where('id_indicador',$indic->id)->where('estado','NM')->where('anio_grupo',$anio)->where('tipo_eval','DOCUMENTAL')->count('id');
                    $v_cbc=$v_cbc + $dt_nm;
                }

                if($estado=='NP'){
                    $dt_no_ap=LicEvaluacion::where('id_indicador',$indic->id)->where('estado','NP')->where('anio_grupo',$anio)->where('tipo_eval','DOCUMENTAL')->count('id');
                    $v_cbc=$v_cbc + $dt_no_ap;
                }

                if($estado=='SIN'){
                    $dt_mv=LicMV::where('aplica',1)->where('id_indicador',$indic->id)->get();
                    foreach ($dt_mv as $mv) {
                        $dt_eval=LicEvaluacion::where('anio_grupo',$anio)->where('id_mv',$mv->id)->where('tipo_eval','DOCUMENTAL')->count('id');
                        if($dt_eval==0){ $v_cbc++; }
                    }
                }
            }


            $datos.=$v_cbc;
            if ($row->id<8) { $datos.=','; }
        }

        return '['.$datos.']';
    }








}


