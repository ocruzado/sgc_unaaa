<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

use App\Models\TipoModelos;
use App\Models\Dimensiones;
use App\Models\Carreras;
use App\Models\Factores;
use App\Models\Estandares;
use App\Models\Docus;


use App\Models\Indicadores;
use App\Models\SustentoIndicador;

use App\Models\EstandarDet;
use App\Models\mvEstandar;

use App\Models\mvMrli;
use App\Models\mvLicencias;
use App\Models\Oficinas;
use App\Models\mvCriterios;
use App\Models\mvCriterioSustento;
use App\Models\PermisoUsuario;

use App\Models\Tipo_proceso;
use App\Models\Nivel_cero;
use App\Models\Nivel_uno;
use App\Models\Nivel_dos;
use App\Models\Procedimiento;
use App\Models\Doc_procedimiento;
use App\Models\MedicionIndicador;

use App\Models\IndicadorMrli;
use App\Models\AvanceAutoev;


//use App\Models\Planif_Brechas;

use App\Models\Planif_Cronograma;
use App\Models\Planif_Contextua;

use App\Models\tbMantenimiento;
use App\Models\LineaBase;





use App\Models\User;
use App\Models\Modulos;  

use App\Models\mrliConceptosCrit;  
use App\Models\ApiUNH\Documentos;

use App\Models\PeriodoAcademico; 

use App\Models\Acreditacion\PosgradoUnidad;
use App\Models\Acreditacion\CriteriosDocente;


use App\Models\Acreditacion\Planif_Brechas;
use App\Models\Acreditacion\Planif_Actividad;

use App\Models\Perdocente;
use App\Models\Renovacion\PmConsidsCumplidas;
use App\Models\Renovacion\PmBrechas;
use App\Models\Renovacion\PmAccionesMejora;
use App\Models\Renovacion\PmAccionesMejoraAdj;
use App\Models\Renovacion\PmEntregables;
use App\Models\Renovacion\PmEntregablesAdj;
use App\Models\Renovacion\PmCriterios;

use App\Models\Acreditacion\Ac_Estandar;
use App\Models\Acreditacion\Ac_Criterio;
use App\Models\Acreditacion\Ac_Evidencia;
use App\Models\Acreditacion\Ac_Indicador;

use App\Models\Acreditacion\Acred_Indicadores;


use App\Models\Lic2019\LicIndicadores;
use App\Models\Lic2019\LicEvidencias;

use App\Models\Lic2019\LicMV;
use App\Models\Lic2019\LicEvaluacion;
use App\Models\Lic2019\LicCondiciones;


// semi
use App\Models\Lic2019\Semi_Condiciones;
use App\Models\Lic2019\Semi_Componentes;
use App\Models\Lic2019\Semi_Indicadores;
use App\Models\Lic2019\Semi_MV;
use App\Models\Lic2019\Semi_Evidencias;
use App\Models\Lic2019\Semi_Evaluacion;

use App\Models\Acreditacion\Acred_Planes;


use App\Models\Sgc\DocGenera;
use App\Models\Sgc\ISO_Requisitos;
use App\Models\Sgc\Quiz_Participante;
use App\Models\Sgc\ISO_SGAMiembros;



use App\Models\Pabellones;


class FuncionesController extends Controller
{



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





    public function avance_plan_coneau($id_carre)
    {
        $porcent_cumple = 0;

        $dt_planes = Acred_Planes::where('id_carrera', $id_carre)->where('estado', 1)->get();
        $total = $dt_planes->count();

        if ($total > 0) {
            $cumplen = $dt_planes->where('cumple', 'C')->count();
            $porcent_cumple = round(($cumplen / $total) * 100, 2); // 2 decimales
        }

        return $porcent_cumple;
    }




    public function grupos_docgen($id_proced, $anio)
    {
        $grupo_doc_gen = Doc_procedimiento::where('procedimiento_id', $id_proced)
            ->where('tipoid_tipodoc_id', 14)
            ->where('doc_status', 'AC')
            ->where('grupo_docgen', 'like', "%$anio%") 
            ->select('grupo_docgen')
            ->distinct()
            ->orderBy('grupo_docgen', 'ASC')
            ->get();

        return $grupo_doc_gen;
    }

    public function registrado_docgen($id_proced, $grupo,$id_docgen)
    {
        
        $dt_existe=Doc_procedimiento::where('tipoid_tipodoc_id', 14)
        ->where('procedimiento_id',$id_proced)
        ->where('grupo_docgen', $grupo)
        ->where('id_doc_genera', $id_docgen)
        ->where('doc_status', 'AC')
        ->count('id');

        return $dt_existe;
    }




    public function clausulas_iso($ids_iso)
    {

        $lista='';

        $ids_clausulas = $ids_iso; 
        $ids_clausu_array = explode(',', $ids_clausulas);

        if (count($ids_clausu_array)>0) {
            foreach ($ids_clausu_array as $id_requi) {
                $dt_r=ISO_Requisitos::find($id_requi);
                if ($dt_r) {
                    $lista.='<li>'.$dt_r->codigo.' '.$dt_r->requisito.'</li>';
                }
            }            
        }            


        return '<ul>'.$lista.'</ul>';
    }

    public function cods_clausulas_iso($ids_iso)
    {

        $lista='';

        $ids_clausulas = $ids_iso; 
        $ids_clausu_array = explode(',', $ids_clausulas);

        if (count($ids_clausu_array)>0) {
            foreach ($ids_clausu_array as $id_requi) {
                $dt_r=ISO_Requisitos::find($id_requi);
                if ($dt_r) {
                    $lista.='<li>'.$dt_r->codigo.'</li>';
                }
            }            
        }            


        return '<ul>'.$lista.'</ul>';
    }

    public function miembros_iso($ids_iso)
    {

        $lista='';

        $ids_regs = $ids_iso; 
        $ids_regs_array = explode(',', $ids_regs);

        if (count($ids_regs_array)>0) {
            foreach ($ids_regs_array as $id_requi) {
                $dt_r=ISO_SGAMiembros::find($id_requi);
                if ($dt_r) {
                    $lista.='<li>'.$dt_r->nom_miembro.'</li>';
                }
            }            
        }            

        return '<ul>'.$lista.'</ul>';
    }



    public function llave_usuario($texto)
    {
        $txt_llave='';
        if($texto!=''){ $txt_llave=Crypt::decryptString($texto); } 
        return $txt_llave;
    }


    public function nom_pabellon($id)
    {
        $dt=Pabellones::find($id);
        return $dt->pabellon;
    }


    public function nom_upposgrado($id)
    {
        $dt=PosgradoUnidad::find($id);
        return $dt->nom_unidad;
    }


    public function listar_carreras()
    {
        return Carreras::get();
    }

    public function nom_carrera($id)
    {
        $dt=Carreras::find($id);
        return $dt->nom_carrera;
    }

    public function num_docus($id_estand)
    {
        $dt=Docus::where('id_estandar',$id_estand)->count('id');
        return $dt;
    }
    
    
    public function nom_matenimiento($id)
    {
        $dt=tbMantenimiento::find($id);
        if ($dt) {
            return $dt->nombre;
        }else{ return ''; }
        
    }
    

    public function nom_nivel_uno($id)
    {
        $dt=Nivel_uno::find($id);
        return $dt->codigo.' - '.$dt->nombre;
    }


    public function doc_procedimiento_list($id_procedimiento)
    {
        $dt_estd_det=Doc_procedimiento::where('procedimiento_id',$id_procedimiento)
        ->where('tipoid_tipodoc_id','>',1)->orderby('tipoid_tipodoc_id','ASC')->get();

        return $dt_estd_det;      
        //->where('doc_adjunto','<>','')          
    }



    public function estado_indicador($id,$frecuencia)
    {
        $items_estado='';
        $url_01=asset('img/estado_01.png');
        $url_02=asset('img/estado_02.png');
        $url_03=asset('img/estado_03.png');

        // anual
        if($frecuencia==6){

            $aux_anual=MedicionIndicador::where('id_indicador',$id)->count('id');
            if ($aux_anual==0) {
                $img_medido='<img src="'.$url_03.'" style="width:12px;" >';
            }else{

                $aux_anual=MedicionIndicador::where('id_indicador',$id)->where('valor_actual','>',0)->count('id');
                if ($aux_anual>0) {
                    $img_medido='<img src="'.$url_01.'" style="width:12px;" >';
                }else{
                    $img_medido='<img src="'.$url_02.'" style="width:12px;" >';
                }
            }

            $items_estado='<td colspan="12" class="celdas_tb_der" style="text-align:center;">'.$img_medido.'</td>';
        }

        //semestral
        if($frecuencia==8){
            $aux_semes=MedicionIndicador::where('id_indicador',$id)->where('anio',2023)->count('id');
            if ($aux_semes==2) {
                $img_medido='<img src="'.$url_01.'" style="width:12px;" >';
                $items_estado='<td colspan="6" class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                <td colspan="6" class="celdas_tb_der" style="text-align:center;">'.$img_medido.'</td>';
            }else{
                if ($aux_semes==0) {
                    $img_medido='<img src="'.$url_03.'" style="width:12px;" >';
                    $items_estado='<td colspan="6" class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                    <td colspan="6" class="celdas_tb_der" style="text-align:center;">'.$img_medido.'</td>';
                }else{
                    $img_medido='<img src="'.$url_02.'" style="width:12px;" >';
                    $items_estado='<td colspan="6" class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                    <td colspan="6" class="celdas_tb_der" style="text-align:center;">'.$img_medido.'</td>';
                }
            }
        }


        //trimestral
        if($frecuencia==9){
            $aux_trimes=MedicionIndicador::where('id_indicador',$id)->where('anio',2023)->count('id');
            if ($aux_trimes==4) {
                $img_medido='<img src="'.$url_01.'" style="width:12px;" >';
                $items_estado='<td colspan="3" class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                <td colspan="3" class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                <td colspan="3" class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                <td colspan="3" class="celdas_tb_der" style="text-align:center;">'.$img_medido.'</td>';
            }else{
                if ($aux_trimes==0) {
                    $img_medido='<img src="'.$url_03.'" style="width:12px;" >';
                    $items_estado='<td colspan="3" class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                    <td colspan="3" class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                    <td colspan="3" class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                    <td colspan="3" class="celdas_tb_der" style="text-align:center;">'.$img_medido.'</td>';
                }else{
                    $img_medido='<img src="'.$url_02.'" style="width:12px;" >';
                    $items_estado='<td colspan="3" class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                    <td colspan="3" class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                    <td colspan="3" class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                    <td colspan="3" class="celdas_tb_der" style="text-align:center;">'.$img_medido.'</td>';
                }
            }
        }


        // mensual
        if($frecuencia==7){
            $aux_mensual=MedicionIndicador::where('id_indicador',$id)->where('anio',2023)->count('id');
            if ($aux_mensual==0) {
                $img_medido='<img src="'.$url_03.'" style="width:12px;" >';
                $items_estado='<td class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                <td class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                <td class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                <td class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                <td class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                <td class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                <td class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                <td class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                <td class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                <td class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                <td class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>
                <td class="celdas_tb_der" style="text-align:center;">'.$img_medido.'</td>';
            }else{
                $arr_meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                for ($i=0; $i < 12; $i++) { 
                    $aux_men=MedicionIndicador::where('id_indicador',$id)
                    ->where('anio',2023)->where('medicion',$arr_meses[$i])->count('id');
                    if($aux_men==0){
                        $img_medido='<img src="'.$url_03.'" style="width:12px;" >';
                        if($i==11){
                            $items_estado.='<td class="celdas_tb_der" style="text-align:center;">'.$img_medido.'</td>';
                        }else{
                            $items_estado.='<td class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>';
                        }
                    }else{
                        $img_medido='<img src="'.$url_01.'" style="width:12px;" >';
                        if($i==11){
                            $items_estado.='<td class="celdas_tb_der" style="text-align:center;">'.$img_medido.'</td>';
                        }else{
                            $items_estado.='<td class="celdas_tb" style="text-align:center;">'.$img_medido.'</td>';
                        }
                    }
                }
            }
        }

        return $items_estado; 
    }

    public function mv_carrera_estandar($id_car,$id_estand)
    {
        $dt=[];

        $dt=mvEstandar::where('tb_mv_estandar.id_carrera',$id_car)->where('tb_mv_estandar.id_estandar',$id_estand)
            ->join('tb_periodo_academico','tb_mv_estandar.id_periodo','=','tb_periodo_academico.id')
            ->select('tb_mv_estandar.*','tb_periodo_academico.nombre as nom_periodo')->get();

        return $dt;              
    }

    public function mv_lista_acredit($id_carrera,$id_estandar,$id_semestre)
    {
        $dt=mvEstandar::where('id_carrera',$id_carrera)->where('id_estandar',$id_estandar)->where('id_periodo',$id_semestre)->where('status','AC')->get();
        return $dt;
    }


    public function acredit_carrera($id_car,$id_semestre)
    {
        
        if ($id_car==12) {
            $dt_estands=Estandares::where('id','>',34)->where('id','<=',52)->get();
        }else{
            $dt_estands=Estandares::where('id','<=',34)->get();
        }
        
        $datos='';
        foreach ($dt_estands as $row) {
            $cant_docs=intval(0);

            /*
            $esta_det=EstandarDet::where('carrera_id',$id_car)->where('estandar_id',$row->id)->first();
            if ($esta_det) {
                $cant_docs=mvEstandar::where('estandar_det_id',$esta_det->id)->count('id');
            }*/

            $cant_docs=mvEstandar::where('id_periodo',$id_semestre)->where('id_carrera',$id_car)
            ->where('id_estandar',$row->id)->where('status','AC')->count('id');

            $datos.=intval($cant_docs);

            if ($id_car==12) {
                if ($row->id<52) { $datos.=','; }
            }else{
                if ($row->id<34) { $datos.=','; }
            }
        }

        return '['.$datos.']';
    }


    public function medios_verif($id_indic)
    {
        $dt=mvMrli::where('id_indicador_mrli',$id_indic)->get();
        return $dt;
    }

    public function mv_licencias($id_indic)
    {
        $dt=mvLicencias::where('tb_mv_licencias.id_mv_mrli',$id_indic)
        ->join('tb_responsable','tb_mv_licencias.id_responsable','=','tb_responsable.id')
        ->select('tb_mv_licencias.*','tb_responsable.nombre')->get();
        return $dt;
         
    }


    public function mv_lic_criterios($id_mv_lic)
    {
        $dt=mvCriterios::where('id_mv_licencias',$id_mv_lic)->get();
        return $dt; 
    }

    public function existe_sustentos_mv($id_crit_mv)
    {
        $dt=mvCriterioSustento::where('id_criterios_mv',$id_crit_mv)->count('id');
        return $dt;
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


    public function indicadores_medidos($id_indic)
    {
        $dt=MedicionIndicador::where('id_indicador',$id_indic)->orderby('anio','ASC')->get();
        return $dt;  
    }


    public function graf_indic_datos_linea($id_indic)
    {   
        $dt=LineaBase::where('doc_procedimiento_id',$id_indic)->orderby('id','ASC')->get();
        $datos='';
        $x=0;
        foreach ($dt as $row) {
            $datos.=intval($row->valor_esperado);
            if ($x < $dt->count()) { $datos.=','; }
            $x++;
        }
        return '['.$datos.']';
    }

    public function graf_indic_datos_medic($id_indic)
    {   
        $dt=LineaBase::where('doc_procedimiento_id',$id_indic)->orderby('id','ASC')->get();
        $datos='';
        $x=0;
        foreach ($dt as $row) {
            $val_med=0;
            $dt_med=MedicionIndicador::where('id_indicador',$id_indic)->where('anio',$row->anio)->where('medicion',$row->medicion)->first();
            if ($dt_med) {
                $val_med=$dt_med->valor_actual;
            }
            $datos.=intval($val_med);
            if ($x < $dt->count()) { $datos.=','; }
            $x++;
        }
        return '['.$datos.']';
    }



    public function graf_indic_labels($id_indic)
    {   
        $dt=LineaBase::where('doc_procedimiento_id',$id_indic)->orderby('id','ASC')->get();
        $datos='';
        $x=1;
        foreach ($dt as $row) {

            // como saber si $row->medicion  contiene dato anual como 2024, 2025 o semetral I Semestre ,II Semestre

            if (strlen($row->medicion) == 4 && is_numeric($row->medicion)) {
                $datos.=$row->medicion;
            }else{
                $datos.=$row->anio.'-'.$row->medicion;
            }
            
            if ($x < $dt->count()) { $datos.=','; }
            $x++;
        }
        return '['.$datos.']';
    }


    public function cmb_mantenimiento($grupo)
    {
        $dt=tbMantenimiento::where('grupo',$grupo)->get();
        return $dt;
    }


    public function cmb_responsables()
    {
        $dt=Responsable::get();
        return $dt;
    }






    public function nom_estands_coneau($id)
    {
        $v_respon='';
        if (is_numeric($id)) {
            $dt=Ac_Estandar::find($id);
            if ($dt) {
               $v_respon='<span class="badge bg-info" style="margin:3px;">'.$dt->sigla.'</span>';
            }
        }else{
            if ($id!='') {
                $ids_dato = $id; 
                $ids_datos_array = explode(',', $ids_dato);

                if (count($ids_datos_array)>0) {
                    foreach ($ids_datos_array as $id_dato) {
                        $dt_r=Ac_Estandar::find($id_dato);
                        if ($dt_r) {
                            $v_respon.='<span class="badge bg-info" style="margin:3px;">'.$dt_r->sigla.'</span>';
                        }
                    }            
                }            
            }
        }
        

        return $v_respon;
    }


    public function nom_criterios_coneau($id)
    {
        $v_respon='';
        if (is_numeric($id)) {
            $dt=Ac_Criterio::find($id);
            if ($dt) {
               $v_respon='<span class="badge bg-primary" style="margin:3px;">'.$dt->codigo.'</span>';
            }
        }else{
            if ($id!='') {
                $ids_dato = $id; 
                $ids_datos_array = explode(',', $ids_dato);

                if (count($ids_datos_array)>0) {
                    foreach ($ids_datos_array as $id_dato) {
                        $dt_r=Ac_Criterio::find($id_dato);
                        if ($dt_r) {
                            $v_respon.='<span class="badge bg-primary" style="margin:3px;">'.$dt_r->codigo.'</span>';
                        }
                    }            
                }            
            }
        }
        

        return $v_respon;
    }



    public function nom_evidencias_coneau($id)
    {
        $v_respon='';
        if (is_numeric($id)) {
            $dt=Ac_Evidencia::find($id);
            if ($dt) {
               $v_respon='<span class="badge bg-info" style="margin:3px;">'.$dt->codigo.'</span>';
            }
        }else{
            if ($id!='') {
                $ids_dato = $id; 
                $ids_datos_array = explode(',', $ids_dato);

                if (count($ids_datos_array)>0) {
                    foreach ($ids_datos_array as $id_dato) {
                        $dt_r=Ac_Evidencia::find($id_dato);
                        if ($dt_r) {
                            $v_respon.='<span class="badge bg-info" style="margin:3px;">'.$dt_r->codigo.'</span>';
                        }
                    }            
                }            
            }
        }
        
        return $v_respon;
    }


    public function nom_indics_coneau($id)
    {
        $v_respon='';
        if (is_numeric($id)) {
            $dt=Ac_Indicador::find($id);
            if ($dt) {
               $v_respon='<span class="badge bg-success" style="margin:3px;">'.$dt->codigo.'</span>';
            }
        }else{
            if ($id!='') {
                $ids_dato = $id; 
                $ids_datos_array = explode(',', $ids_dato);

                if (count($ids_datos_array)>0) {
                    foreach ($ids_datos_array as $id_dato) {
                        $dt_r=Ac_Indicador::find($id_dato);
                        if ($dt_r) {
                            $v_respon.='<span class="badge bg-success" style="margin:3px;">'.$dt_r->codigo.'</span>';
                        }
                    }            
                }            
            }
        }
        

        return $v_respon;
    }





    public function mrli_rpt_general()
    {   
        
        $dt=IndicadorMrli::where('id','<=',31)->get();
        $x=0;
        $datos='';
        foreach ($dt as $indic) {
            $datos.=$this->mrli_rpt_x_indicador($indic->id);
            if ($x < 32) { $datos.=','; }
            $x++;
        }

        return '['.$datos.']';
    }


    public function mrli_rpt_x_indicador($id_indicador_mrli)
    {   
        
        $dt=IndicadorMrli::find($id_indicador_mrli);
        $x=0;
        $datos='';

           $dt_mv1=mvMrli::where('id_indicador_mrli',$dt->id)->get();
           $sum_mv=0;
           $cant_mv=0;

           foreach ($dt_mv1 as $mv1) {
              $dt_lic=mvLicencias::where('id_mv_mrli',$mv1->id)->get();
              
              $sum_lic=0;
              $cant_lic=0;
              foreach ($dt_lic as $mv_lic) {
                $aux_prom=($mv_lic->tot_cumplimiento + $mv_lic->tot_criterios)/2;
                $prom=intval($aux_prom);

                $sum_lic=$sum_lic +$prom;
                $cant_lic++;
              }
              if($cant_lic>0){
                  $aux_prom_lic=($sum_lic/$cant_lic);
                  $prom_lic=intval($aux_prom_lic);
              }else{
                $prom_lic=0;
              }


              $sum_mv=$sum_mv + $prom_lic;
              $cant_mv++;
           }

           if ($cant_mv>0) {
              $aux_prom_mv=($sum_mv/$cant_mv);
              $prom_mv=intval($aux_prom_mv);
           }else{
            $prom_mv=0;
           }


            return intval($prom_mv);
    }





    public function planif_listar_brechas($id_estandar,$id_carre)
    {   
        $dt=Planif_Brechas::where('id_estandar',$id_estandar)->where('id_carrera',$id_carre)->get();
        return $dt;
    }

    public function planif_listar_crono($id_brecha)
    {   
        $dt=Planif_Cronograma::where('id_brecha',$id_brecha)->get();
        return $dt;
    }


    public function obj_autoevaluacion($id_car,$id_esta,$id_semestre)
    {
        $dt=AvanceAutoev::where('id_carrera',$id_car)->where('id_estandar',$id_esta)->where('id_semestre',$id_semestre)->first();
        return $dt;
        
    }

    public function responsables_brecha($id_brecha)
    {
        $dt=Planif_Brechas::find($id_brecha);

        $lista='';
        if ($dt->ids_responsable!='') {
            $ids_responsable = $dt->ids_responsable; 
            $ids_responsable_array = explode(',', $ids_responsable);

            if (count($ids_responsable_array)>0) {
                foreach ($ids_responsable_array as $id_respo) {
                    $dt_r=Responsable::find($id_respo);
                    if ($dt_r) {
                        $lista.='<li>'.$dt_r->nombre.'</li>';
                    }
                }            
            }            
        }

        return '<ul>'.$lista.'</ul>';
    }

    public function planif_contextua($id_carrera,$id_estandar)
    {
        $dt=Planif_Contextua::where('id_estandar',$id_estandar)->where('id_carrera',$id_carrera)->first();
        return $dt;
    }

    public function autoev_grafi_datos($id_car,$estado,$semestre)
    {
        
        if ($id_car==12) {
            $dt_estands=Estandares::where('id','>',34)->where('id','<=',52)->get();
        }else{
            $dt_estands=Estandares::where('id','<=',34)->get();
        }
        
        $tot_autoev=AvanceAutoev::where('id_carrera',$id_car)->where('id_semestre',$semestre)->count('id');

        $datos='';
        foreach ($dt_estands as $row) {
            $val_item=0;

            $dt_auto=AvanceAutoev::where('id_carrera',$id_car)->where('id_semestre',$semestre)->where('id_estandar',$row->id)->where('valoracion',$estado)->count('id');

            if($estado=='No logrado'){ 
                if($tot_autoev>0){ $val_item=1; }else{ $val_item=0; }
                $dt_auto2=AvanceAutoev::where('id_carrera',$id_car)->where('id_semestre',$semestre)->where('id_estandar',$row->id)->where('valoracion','Logrado')->count('id');
                $dt_auto3=AvanceAutoev::where('id_carrera',$id_car)->where('id_semestre',$semestre)->where('id_estandar',$row->id)->where('valoracion','Logrado plenamente')->count('id');
                if ($dt_auto2>0 || $dt_auto3>0) { $val_item=0; }
            }


            if($estado=='Logrado'){ 
                $val_item=0;
                if ($dt_auto>0) { $val_item=3; }
            }

            if($estado=='Logrado plenamente'){ 
                $val_item=0;
                if ($dt_auto>0) { $val_item=5; }
            }

            $datos.=intval($val_item);

            if ($id_car==12) {
                if ($row->id<52) { $datos.=','; }
            }else{
                if ($row->id<34) { $datos.=','; }
            }
        }

        return '['.$datos.']';
    }




    public function autoev_grafi_porcent($id_car,$estado,$semestre)
    {
        
        if ($id_car==12) {
            $dt_estands=Estandares::where('id','>',34)->where('id','<=',52)->get();
        }else{
            $dt_estands=Estandares::where('id','<=',34)->get();
        }
        
        $datos='';
        $suma=0;
        foreach ($dt_estands as $row) {
            $val_item=0;

            $dt_auto=AvanceAutoev::where('id_carrera',$id_car)->where('id_semestre',$semestre)->where('id_estandar',$row->id)->where('valoracion',$estado)->count('id');

            if($estado=='No logrado'){ 
                $val_item=1;
                $dt_auto2=AvanceAutoev::where('id_carrera',$id_car)->where('id_semestre',$semestre)->where('id_estandar',$row->id)->where('valoracion','Logrado')->count('id');
                $dt_auto3=AvanceAutoev::where('id_carrera',$id_car)->where('id_semestre',$semestre)->where('id_estandar',$row->id)->where('valoracion','Logrado plenamente')->count('id');
                if ($dt_auto2>0 || $dt_auto3>0) { $val_item=0; }else{  $suma++; }
            }


            if($estado=='Logrado'){ 
                $val_item=0;
                if ($dt_auto>0) { 
                    $val_item=3;
                    $suma++;
                }
            }

            if($estado=='Logrado plenamente'){ 
                $val_item=0;
                if ($dt_auto>0) { 
                    $val_item=5;
                    $suma++;
                }
            }


            $v_porcen=0;
            if ($id_car==12) {
                $v_porcen=($suma/18)*100;
            }else{
                $v_porcen=($suma/34)*100;
            }
        }
        
        $v_porcen = round($v_porcen);

        $tot_autoev=AvanceAutoev::where('id_carrera',$id_car)->where('id_semestre',$semestre)->count('id');

        if ($estado=='No logrado' && $v_porcen==100 && $tot_autoev==0) {
            return 0;
        }else{
            return $v_porcen;
        }
        
    }



    public function autoev_grafi_cantidad($id_car,$estado,$semestre)
    {
        
        if ($id_car==12) {
            $dt_estands=Estandares::where('id','>',34)->where('id','<=',52)->get();
        }else{
            $dt_estands=Estandares::where('id','<=',34)->get();
        }
        
        $suma=0;
        foreach ($dt_estands as $row) {

            $dt_auto=AvanceAutoev::where('id_carrera',$id_car)->where('id_semestre',$semestre)->where('id_estandar',$row->id)->where('valoracion',$estado)->count('id');

            if($estado=='No logrado'){ 
                $dt_auto2=AvanceAutoev::where('id_carrera',$id_car)->where('id_semestre',$semestre)->where('id_estandar',$row->id)->where('valoracion','Logrado')->count('id');
                $dt_auto3=AvanceAutoev::where('id_carrera',$id_car)->where('id_semestre',$semestre)->where('id_estandar',$row->id)->where('valoracion','Logrado plenamente')->count('id');
                if ($dt_auto2>0 || $dt_auto3>0) { $val_item=0; }else{  $suma++; }
            }

            if($estado=='Logrado'){ 
                if ($dt_auto>0) { 
                    $suma++;
                }
            }

            if($estado=='Logrado plenamente'){ 
                if ($dt_auto>0) { 
                    $suma++;
                }
            }
        }
        
        return $suma;
    }












    public function indicadores_lineabase($id_indic)
    {
        $dt=LineaBase::where('doc_procedimiento_id',$id_indic)->orderby('id','ASC')->get();
        return $dt;             
    }

    public function valor_lineabase($id_indic,$anio,$medicion)
    {
        $valor=0;
        $dt=LineaBase::where('doc_procedimiento_id',$id_indic)->where('anio',$anio)->where('medicion',$medicion)->first();
        if($dt){ 

            $v_unidad=$dt->tipo_valor=='porcentaje' ? '%' : '';
            if ($dt->v_denominador!=0) { $v_denom=$dt->v_denominador; }

            $valor=$dt->valor_esperado.''.$v_unidad; 
        }

        return $valor;             
    }

    public function submenus($id_padre)
    {
        $dt= Modulos::where('id_parent',$id_padre)->where('nivel',2)->get();
        return $dt;
    }


    public function concepto_criterio_mrli($id)
    {
        $dt=mrliConceptosCrit::find($id);
        return $dt->concepto;
    }





    public function publico_rpt($estado,$semes,$grupo)
    {
        
        if ($grupo=='pregrado') {
           $dt=Carreras::where('id','<=',20)->orwhere('id',60)->get();
        }

        
        if ($grupo=='maestria') {
           $dt=Carreras::where('nivel_acad',2)->get();
        }
        
        if ($grupo=='doctorado') {
           $dt=Carreras::where('nivel_acad',3)->get();
        }

        $datos='';
        $x=1;
        foreach ($dt as $carre) {
            if ($carre->id!=2) {
                $val_por=$this->autoev_grafi_porcent($carre->id,$estado,$semes);
                $datos.=$val_por;
                if ($x < $dt->count()) { $datos.=','; }
            }

            $x++;
        }
        return '['.$datos.']';
    }


    public function publico_rpt_labels($grupo)
    {   
        
        if ($grupo=='pregrado') {
           $dt=Carreras::where('id','<=',20)->orwhere('id',60)->get(); 
        }

        
        if ($grupo=='maestria') {
           $dt=Carreras::where('nivel_acad',2)->get();
        }

        if ($grupo=='doctorado') {
           $dt=Carreras::where('nivel_acad',3)->get();
        }


        $datos='';
        $x=1;
        foreach ($dt as $row) {
            if ($row->id!=2) {

                if($grupo=='pregrado'){
                    $datos.=$row->id==16 ? 'ESCUELA PROFESIONAL DE INGENIERÍA CIVIL - LIRCAY / HVCA' : $row->nom_carrera;
                }

                if($grupo=='maestria'){
                    $datos.=$row->nom_carrera; // $this->nom_upposgrado($row->id_posgrado_unidad)
                }
                
                if($grupo=='doctorado'){
                    $datos.=$row->nom_carrera; // $this->nom_upposgrado($row->id_posgrado_unidad)
                }

                if ($x < $dt->count()) { $datos.=','; }
            }
            $x++;
        }
        return '['.$datos.']';
    }







    public function pdf_planif_valor_mes($id_brecha,$semestre,$mes)
    {
        $valor_mes='';
        $dt=Planif_Cronograma::where('id_brecha',$id_brecha)
        ->where('semestre',$semestre)->where('mes',$mes)->count('id');

        if ($dt>0) {
            $url_04=asset('img/check_negro.png');
            $valor_mes='<img src="'.$url_04.'" style="width: 15px;">';
        }
        return $valor_mes;
    } 

    public function pdf_planif_porcent_brecha($id_brecha)
    {
        $porcent_brecha=0;
        $cant_total=0;
        $cant_suma=0;
        $dt=Planif_Cronograma::where('id_brecha',$id_brecha)->get();
        foreach ($dt as $dato) {
           if ($dato->se_cumplio=='SI') { $cant_suma=$cant_suma + 1; }
           if ($dato->se_cumplio=='EN PROCESO') { $cant_suma=$cant_suma + 0.5; }
           $cant_total++;
        }

        if ($cant_total>0) {
           $porcent_brecha=round(($cant_suma/$cant_total)*100); 
        }

        return $porcent_brecha;
    } 





    public function pdf_mrli_detallado_indicadores($id_condicion)
    {
        $id_factos=Factores::where('dimension_id',$id_condicion)->select('id')->get();
        $obj_indics=IndicadorMrli::wherein('id_factor',$id_factos)->get();
        return $obj_indics;
    } 

    public function pdf_mrli_detallado_mvmrlis($id_indicador_mrli)
    {
        $dt=mvMrli::where('id_indicador_mrli',$id_indicador_mrli)->get();
        return $dt;
    } 

    public function pdf_mrli_detallado_doc_reportado($id_mvlic)
    {
        $suma_docs=0;
        $dt=mvCriterios::where('id_mv_licencias',$id_mvlic)->get();
        foreach ($dt as $mvcrit) {
            $cant_sus_crit=mvCriterioSustento::where('id_criterios_mv',$mvcrit->id)->count('id');
            $suma_docs = $suma_docs + $cant_sus_crit;
        }
        
        return $suma_docs;
    } 





    // permisos en el modelo, Modulo MRLI

    public function mrli_permisos_oficina($id_oficina,$id_tabla,$opcion)
    {
        $aux_indics=0;
        if ($opcion=='indicador') {
            $dt_mrli=mvMrli::where('id_indicador_mrli',$id_tabla)->get();
            foreach ($dt_mrli as $row) {
                $count_mv=mvLicencias::where('id_mv_mrli',$row->id)->where('id_responsable',$id_oficina)->count('id');
                $aux_indics=$aux_indics+$count_mv;
            }
        }


        if ($opcion=='mv_mrli') {
            $count_mv=mvLicencias::where('id_mv_mrli',$id_tabla)->where('id_responsable',$id_oficina)->count('id');
            $aux_indics=$count_mv;
        }

        if ($opcion=='mv_lic') {
            $count_mv=mvLicencias::where('id',$id_tabla)->where('id_responsable',$id_oficina)->count('id');
            $aux_indics=$count_mv;
        }

      return $aux_indics;
    }




    public function sgc_nivel0($id_tipo)
    {
        $dt=Nivel_cero::where('tipoproceso_id',$id_tipo)->get();
        return $dt;
    }


    public function permiso_sgc_procedimiento($id_proced,$id_oficina)
    {
       
        $dt_doc_proce=Doc_procedimiento::where('procedimiento_id',$id_proced)->where('tipoid_tipodoc_id',4)->get();
        $aux_permiso=0;
        foreach ($dt_doc_proce as $doc_proce) {
            if ($doc_proce->id_responsable!='' && $doc_proce->id_responsable!=0) {
                $ids_responsable_array = explode(',', $doc_proce->id_responsable);

                if (count($ids_responsable_array)>0) {
                    foreach ($ids_responsable_array as $id_respo) {
                        if ($id_respo==$id_oficina) {
                            $aux_permiso=1;
                        }
                    }            
                }            
            }
        }


        $dt_p=Procedimiento::find($id_proced);
        if ($dt_p->responsable_id==$id_oficina) {
            $aux_permiso=1;
        }

        return $aux_permiso;
    }


    public function permiso_sgc_indicador($id_doc_proced,$id_oficina)
    {
        $dt_doc_proce=Doc_procedimiento::find($id_doc_proced);
        $aux_permiso=0;

        if ($dt_doc_proce->id_responsable!='' && $dt_doc_proce->id_responsable!=0) {
            $ids_responsable_array = explode(',', $dt_doc_proce->id_responsable);

            if (count($ids_responsable_array)>0) {
                foreach ($ids_responsable_array as $id_respo) {
                    if ($id_respo==$id_oficina) {
                        $aux_permiso=1;
                    }
                }            
            }            
        }

        return $aux_permiso;
    }





    public function valos_rpt_sgc_proceso($id_proceso)
    {

        $porcent_proceso = 0;


        $dt_n0_ids = Nivel_cero::where('tipoproceso_id', $id_proceso)->pluck('id')->toArray();
        $dt_n1_ids = Nivel_uno::whereIn('nivel0_id', $dt_n0_ids)->pluck('id')->toArray();
        $dt_n2_ids = Nivel_dos::whereIn('nivel1_id', $dt_n1_ids)->pluck('id')->toArray();

        $dt_indics=Doc_procedimiento::where('tipoid_tipodoc_id',4)->whereIn('procedimiento_id',$dt_n2_ids)->get();
        $tot_procedimientos=$dt_indics->count();
        $tot_medidos=0;
        foreach ($dt_indics as $row_indic) {
            $dt_medi=MedicionIndicador::where('id_indicador',$row_indic->id)->where('valor_actual','>',0)->count('id');
            if($dt_medi>0){ $tot_medidos++; }
        }

        if ($tot_procedimientos>0) {
            $porcent_proceso=($tot_medidos/$tot_procedimientos)*100;
        }

        return round($porcent_proceso);
    }



    public function api_proceds_documento($codigo)
    {
        $dt=Documentos::where('codigo',$codigo)->where('vigente',1)->get();

        return $dt;
    }


    public function api_fichas_indic($codigo)
    {
        $arr_docus='';
        $dt=Documentos::where('id_tipo',11)->where('codigo',$codigo)->where('archivos','<>','')->where('vigente',1)->first();
        if ($dt) {
            $arr_docus=json_decode($dt->archivos, true);
        }
        return $arr_docus;
    }


    public function version_proced($codigo)
    {
        $v_version='';
        $dt=Documentos::where('id_tipo',11)->where('codigo',$codigo)->where('estado','PUBLISHED')->where('vigente',1)->first();
        if ($dt) {
            $v_version=$dt->version;
        }
        return $v_version;
    }





    public function docs_institucional_acredit($id_carrera,$id_estandar)
    {
        $dt=mvEstandar::where('tb_mv_estandar.fuente_doc','url')
        ->where('tb_estandar_det.estandar_id',$id_estandar)
        ->where('tb_estandar_det.carrera_id','<>',$id_carrera)
        ->join('tb_estandar_det','tb_mv_estandar.estandar_det_id','=','tb_estandar_det.id')
        ->select('tb_mv_estandar.*')->get();

        return $dt;
    }


    public function cmb_periodos()
    {
       $dt=PeriodoAcademico::get();
       return $dt;
    }




    function num_mvs($id_tbl,$tipo){
        if($tipo=='indic'){
            $dt=mvMrli::where('id_indicador_mrli',$id_tbl)->count('id');
        }
        

        if($tipo=='componente'){
            $dt = IndicadorMrli::where('tb_indicador_mrli.id_factor', $id_tbl)
            ->join('tb_mv_mrli', 'tb_mv_mrli.id_indicador_mrli', '=', 'tb_indicador_mrli.id')
            ->count('tb_mv_mrli.id');
        }

        if($tipo=='condicion'){
            $dt = IndicadorMrli::where('tb_factor.dimension_id', $id_tbl)
            ->join('tb_factor', 'tb_indicador_mrli.id_factor', '=', 'tb_factor.id')
            ->join('tb_mv_mrli', 'tb_mv_mrli.id_indicador_mrli', '=', 'tb_indicador_mrli.id')
            ->count('tb_mv_mrli.id');
        }


        return $dt;
    }



    public function respons_mv($id_mv)
    {
        
        $v_respon='';
        $items_li='';

        $dt_mv=mvMrli::find($id_mv);
        if ($dt_mv) {
            $ids_responsable_array = explode(',', $dt_mv->id_responsable_mv);
            if (count($ids_responsable_array)>0) {
                foreach ($ids_responsable_array as $id_respo) {
                    $dt_r=Responsable::find($id_respo);
                    if ($dt_r) {
                        $items_li.='<li>'.$dt_r->nombre.'</li>';
                    }
                }            
            } 
            if($items_li!=''){ $v_respon='<ul>'.$items_li.'</ul>'; }            
        }

        return $v_respon;
    }



    public function criter_docente($id_semestre,$id_carrera,$id_oferta,$id_criterio)
    {
        $canti=0;
        $dt=Perdocente::where('semestre',$id_semestre)->where('id_carrera',$id_carrera)->where('id_oferta',$id_oferta)->where('id_criterio',$id_criterio)->first();
        if($dt){
            $canti=$dt->cantidad;
        }

        return $canti;
    }


    public function suma_renacyt($id_semestre,$id_carrera,$id_oferta)
    {
        $tot_docen=0;
        $datos=CriteriosDocente::where('id','>',10)->where('id','<',19)->get();
        foreach ($datos as $dato) {
            $cant_doc=Perdocente::where('semestre',$id_semestre)->where('id_carrera',$id_carrera)->where('id_oferta',$id_oferta)->where('id_criterio',$dato->id)->sum('cantidad');
            $tot_docen = $tot_docen + $cant_doc;
        }
        return $tot_docen;
    }








    // REPORTE DE BRECHAS -----------------------------------------------

    public function cantidad_brechas($id_semestre,$id_carrera)
    {
        $dt=Planif_Brechas::where('id_semestre',$id_semestre)->where('id_carrera',$id_carrera)->count('id');
        return $dt;
    }

    public function cantidad_brechas_cumplidas($id_semestre,$id_carrera)
    {
        $dt=Planif_Brechas::where('id_semestre',$id_semestre)->where('id_carrera',$id_carrera)->get();
        $tot_brechas=0;
        foreach ($dt as $brecha) {
            $existentes=Planif_Actividad::where('id_brechas',$brecha->id)->count('id');
            if ($existentes>0) {
                $cumplidas=Planif_Actividad::where('id_brechas',$brecha->id)->where('se_cumplio',1)->count('id');
                if($existentes==$cumplidas){ $tot_brechas++; }
            }
        }
        return $tot_brechas;
    }


    public function lista_activs($id_semestre,$id_carrera,$id_estandar)
    {
        $dt=Planif_Actividad::where('id_semestre',$id_semestre)->where('id_carrera',$id_carrera)->where('id_estandar',$id_estandar)->get();
        return $dt;
    }






    public function rpt_brechas_datos_identificadas($id_semestre,$id_carrera)
    {
        
        $id_modelo=0;
        if ($id_carrera==12) {
            $id_modelo=4;
        }elseif ($id_carrera!=12 && $id_carrera<=20 || $id_carrera==60) {
            $id_modelo=3;
        }elseif($id_carrera>=24 && $id_carrera<=49){
            $id_modelo=5;      
        }elseif($id_carrera>=50 && $id_carrera<=58){
            $id_modelo=6;
        }

        $dt=Estandares::where('id_modelo',$id_modelo)->get();

        $datos='';
        $x=1;
        foreach ($dt as $estan) {

            $dt_tot=Planif_Brechas::where('id_semestre',$id_semestre)->where('id_carrera',$id_carrera)->where('id_estandar',$estan->id)->count('id');
            $datos.=$dt_tot;

            if ($x < $dt->count()) { $datos.=','; }
            $x++;
        }
        return '['.$datos.']';
    }



    public function rpt_brechas_datos_cumplidas($id_semestre,$id_carrera)
    {
        
        $id_modelo=0;
        if ($id_carrera==12) {
            $id_modelo=4;
        }elseif ($id_carrera!=12 && $id_carrera<=20 || $id_carrera==60) {
            $id_modelo=3;
        }elseif($id_carrera>=24 && $id_carrera<=49){
            $id_modelo=5;      
        }elseif($id_carrera>=50 && $id_carrera<=58){
            $id_modelo=6;
        }


        $dt=Estandares::where('id_modelo',$id_modelo)->get();
        $datos='';
        $x=1;
        foreach ($dt as $estan) {
           $tot_brechas=0;



            $dt_brecha=Planif_Brechas::where('id_semestre',$id_semestre)->where('id_carrera',$id_carrera)->where('id_estandar',$estan->id)->get();
            $tot_brechas=0;
            foreach ($dt_brecha as $brecha) {
                $existentes=Planif_Actividad::where('id_brechas',$brecha->id)->count('id');
                if ($existentes>0) {
                    $cumplidas=Planif_Actividad::where('id_brechas',$brecha->id)->where('se_cumplio',1)->count('id');
                    if($existentes==$cumplidas){ $tot_brechas++; }
                }
            }



            $datos.=$tot_brechas;
            if ($x < $dt->count()) { $datos.=','; }
            $x++;
        }
        return '['.$datos.']';
    }




    public function rpt_brechas_labels($id_carrera)
    {   

        $id_modelo=0;
        if ($id_carrera==12) {
            $id_modelo=4;
        }elseif ($id_carrera!=12 && $id_carrera<=20 || $id_carrera==60) {
            $id_modelo=3;
        }elseif($id_carrera>=24 && $id_carrera<=49){
            $id_modelo=5;      
        }elseif($id_carrera>=50 && $id_carrera<=58){
            $id_modelo=6;
        }

        $dt=Estandares::where('id_modelo',$id_modelo)->get();


        $datos='';
        $x=1;
        foreach ($dt as $row) {
            $datos.=$row->sigla;
            if ($x < $dt->count()) { $datos.=','; }
            $x++;
        }
        return '['.$datos.']';
    }




    // 
    public function contar_consignados($id_indic,$id_mv,$grupo)
    {
        if($grupo=='brechas'){
            $dt=PmBrechas::where('indicador',$id_indic)->where('id_mv',$id_mv)->where('estado',1)->count('id');
        }

        if($grupo=='acciones'){
            $dt=PmAccionesMejora::where('indicador',$id_indic)->where('id_mv',$id_mv)->count('id');
        }

        if($grupo=='evidencias'){
            $dt=PmEntregables::where('indicador',$id_indic)->where('id_mv',$id_mv)->count('id');
        }

        return $dt;
    }


    public function datos_consignados($id_indic,$id_mv,$grupo)
    {
        if($grupo=='brechas'){
            $dt=PmBrechas::where('indicador',$id_indic)->where('id_mv',$id_mv)->where('estado',1)->get();
        }

        if($grupo=='acciones'){
            $dt=PmAccionesMejora::where('indicador',$id_indic)->where('id_mv',$id_mv)->get();
        }

        if($grupo=='evidencias'){
            $dt=PmEntregables::where('indicador',$id_indic)->where('id_mv',$id_mv)->get();
        }

        return $dt;
    }


    public function contar_consignados_respon($id_indic,$id_mv,$grupo,$id_respon)
    {
        if($grupo=='brechas'){
            $dt=PmBrechas::where('indicador',$id_indic)->where('id_mv',$id_mv)->where('id_responsable',$id_respon)->where('estado',1)->count('id');
        }

        if($grupo=='acciones'){
            $ids_brecha=PmBrechas::where('indicador',$id_indic)->where('id_mv',$id_mv)->where('id_responsable',$id_respon)->where('estado',1)->pluck('id');
            $dt=PmAccionesMejora::whereIn('id_pm_brechas',$ids_brecha)->count('id');
        }

        if($grupo=='evidencias'){
            $dt=PmEntregables::where('indicador',$id_indic)->where('id_mv',$id_mv)->where('id_responsable',$id_respon)->count('id');
        }

        return $dt;
    }


    public function accion_responsable($id_brecha){
        $dt_brecha=PmBrechas::find($id_brecha);
        $txt_respon='';
        if($dt_brecha){
           $dt_respon=Responsable::find($dt_brecha->id_responsable);
           $txt_respon=$dt_respon->nombre; 
        }

        return $txt_respon;
    }







// rpeorte de indicadores
    public function num_indicadores($id_proced)
    {
        $dt=Doc_procedimiento::where('tipoid_tipodoc_id',4)->where('procedimiento_id',$id_proced)->count('id');
        return $dt;
    }


    public function num_indicadores_medidos($id_proced)
    {
        $tot_medidos=0;
        $dt=Doc_procedimiento::where('tipoid_tipodoc_id',4)->where('procedimiento_id',$id_proced)->get();
        foreach ($dt as $indic) {
            $dt_medicion=MedicionIndicador::where('id_indicador',$indic->id)->count('id');
            if($dt_medicion>0){ $tot_medidos++; }
        }
        return $tot_medidos;
    }


    // muevo modelo de acreditacion
    public function grafi_coneau_datos($id_indic,$id_carre)
    {   
        $dt=Acred_Indicadores::where('id_indicador',$id_indic)->where('id_carrera',$id_carre)->where('estado',1)->orderby('medido','ASC')->get();
        $datos='';
        $x=0;
        foreach ($dt as $row) {
            $val_med=$row->resultado;
            $datos.=intval($val_med);
            if ($x < $dt->count()) { $datos.=','; }
            $x++;
        }
        return '['.$datos.']';
    }



    public function grafi_coneau_labels($id_indic,$id_carre)
    {   
        $dt=Acred_Indicadores::where('id_indicador',$id_indic)->where('id_carrera',$id_carre)->where('estado',1)->orderby('medido','ASC')->get();
        $datos='';
        $x=1;
        foreach ($dt as $row) {
            $datos.=$row->medido;
            if ($x < $dt->count()) { $datos.=','; }
            $x++;
        }
        return '['.$datos.']';
    }





    // lic 2019
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




    public function estands_criticos($id_semestre,$id_estandar,$estado,$grupo)
    {

        $cant_nologs=0;
        $cant_logs=0;
        $cant_plen=0;

        $arr_carres=[];
        $arr_carres_no=[];
        $arr_carres_log=[];
        $arr_carres_ple=[];


        $dt_carres = Carreras::where('nivel_acad', 1)->whereNotIn('id', [8, 2, 60, 12])->get();
        foreach ($dt_carres as $carre) {

            $dt_autoev = AvanceAutoev::where('id_semestre', $id_semestre)->where('id_carrera',$carre->id)
            ->where('id_estandar',$id_estandar)->first();

            if($dt_autoev){
                if($dt_autoev->valoracion=='Logrado plenamente'){ 
                    $cant_plen++;
                    $arr_carres_ple[] = $carre; 
                }

                if($dt_autoev->valoracion=='Logrado'){ 
                    $cant_logs++;
                    $arr_carres_log[] = $carre;
                }

                if($dt_autoev->valoracion=='No logrado'){ 
                    $cant_nologs++;
                    $arr_carres_no[] = $carre;
                }
            }else{
                $cant_nologs++;
                $arr_carres_no[] = $carre;
            }

        }


        $cantidad_pe=0;
        if($estado=='No logrado'){ 
            $cantidad_pe=$cant_nologs;
            $arr_carres=$arr_carres_no;
        }

        if($estado=='Logrado'){ 
            $cantidad_pe=$cant_logs;
            $arr_carres=$arr_carres_log;
        }

        if($estado=='Logrado plenamente'){ 
            $cantidad_pe=$cant_plen;
            $arr_carres=$arr_carres_ple; 
        }



        if($grupo=='carres'){
            return $arr_carres;
        }else{
            return $cantidad_pe;
        }
        
    }







    public function acredit_logro_estado($id_semestre,$estado)
    {   
        
        $datos='';
        for ($estan=1;$estan<35;$estan++) {

            $val_estado=$this->estands_criticos($id_semestre,$estan,$estado,'contador');
            $div_estado=($val_estado/18)*100;

            if (floor($div_estado) == $div_estado) {
                $result_estado = number_format($div_estado, 0);
            } else {
                $result_estado = number_format($div_estado, 2);
            }


            $datos.=$result_estado;
            if ($estan < 34) { $datos.=','; }
        }

        return '['.$datos.']';
    }















    public function pm_rpt_general_datos()
    {   
        
        $dt=IndicadorMrli::where('id','<=',31)->get();
        $x=0;
        $datos='';
        foreach ($dt as $indic) {
            $datos.=$this->pm_cumple_x_indicador($indic->id);
            if ($x < 32) { $datos.=','; }
            $x++;
        }

        return '['.$datos.']';
    }

    public function pm_cumple_x_indicador($id_indic){

        $tot_cumple=0;
        $suma_tots_mv=0;

        $dt_mv=mvMrli::where('id_indicador_mrli',$id_indic)->get();
        foreach ($dt_mv as $mv) {
            $e_marcados = PmEntregables::where('indicador', $id_indic)->where('id_mv',$mv->id)->where('marcado', 1)->sum('valor_mv') ?? 0;
            $cri_marcados=PmCriterios::where('indicador', $id_indic)->where('id_mv',$mv->id)->where('estado',1)->count('id');


            $porcent_criters=round(($cri_marcados/6)*100, 2);
            $tot_cumple_mv=round(($e_marcados + $porcent_criters)/2, 2);

            $suma_tots_mv=$suma_tots_mv+$tot_cumple_mv;
        }


        $tot_cumple=round(($suma_tots_mv/$dt_mv->count()),2);


        return $tot_cumple;
    }


    public function cant_docgens($id_proced){
        $dt=DocGenera::where('id_procedimiento',$id_proced)->where('estado_item',1)->count('id');
        return $dt;
    }

    public function grupo_docgens($id_proced){
        $dt = Doc_procedimiento::where('procedimiento_id', $id_proced)
        ->where('tipoid_tipodoc_id', 14)->where('doc_status','AC')
        ->select('grupo_docgen')->distinct()->orderby('grupo_docgen','DESC')->get();

        return $dt;
    }


    public function cant_docgens_grupo($id_proced,$grupo){
        $dt=Doc_procedimiento::where('procedimiento_id',$id_proced)
        ->where('tipoid_tipodoc_id', 14)->where('doc_status','AC')->where('grupo_docgen',$grupo)->count('id');
        return $dt;
    }



    // reporte de logro de los estándares por programa
    public function acredit_logro_programa($id_semestre,$id_carrera)
    {
        if ($id_carrera==12) {
            $tot_estands=18;
        }else{
            $tot_estands=34;
        }

        $tot_nl=0;
        $tot_log=0;
        $tot_lp=0;

        $dt_autoev=AvanceAutoev::where('id_carrera',$id_carrera)->where('id_semestre',$id_semestre)->get();
        foreach($dt_autoev as $autoev){
            if($autoev->valoracion=='No logrado'){ $tot_nl++; }
            if($autoev->valoracion=='Logrado'){ $tot_log++; }
            if($autoev->valoracion=='Logrado plenamente'){ $tot_lp++; }
        }

        $puntos_nl=$tot_nl*0;
        $puntos_log=$tot_log*0.5;
        $puntos_lp=$tot_lp*1;

        $puntos_tot=($puntos_nl + $puntos_log + $puntos_lp);
        $result_logro=($puntos_tot/$tot_estands)*100;

        if (floor($result_logro) == $result_logro) {
            $result_logro_v = number_format($result_logro, 0);
        } else {
            $result_logro_v = number_format($result_logro, 2);
        }

        return $result_logro_v;
    }



    public function acredit_logro_dato($id_carrera)
    {
        $arr_semestres=[2,3,4];

        $datos='';
        foreach ($arr_semestres as $id_semestre) {
            
            $dato_semes=$this->acredit_logro_programa($id_semestre,$id_carrera);
            $datos.=$dato_semes;

            if ($id_semestre<4) { $datos.=','; }
        }

        return '['.$datos.']';
    }







    public function nom_requisitos_iso($id)
    {
        $v_respon='';
        if (is_numeric($id)) {
            $dt=ISO_Requisitos::find($id);
            if ($dt) {
               $v_respon=$dt->codigo;
            }
        }else{
            if ($id!='') {
                $ids_responsable = $id; 
                $ids_responsable_array = explode(',', $ids_responsable);

                if (count($ids_responsable_array)>0) {
                    foreach ($ids_responsable_array as $id_respo) {
                        $dt_r=ISO_Requisitos::find($id_respo);
                        if ($dt_r) {
                            $v_respon.=$dt_r->codigo.', ';
                        }
                    }            
                }            
            }
        }
        

        return $v_respon;
    }



    public function quiz_participantes($id_encues,$area_niv)
    {
        $dt=Quiz_Participante::where('id_encuesta',$id_encues)->where('area',$area_niv)->count('id');
        return $dt;
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





    // MODELO semipresencial y/o a distancia

    public function rpt_semi_etiquetas(){
        $dt=Semi_Indicadores::get();

        $datos='';
        $x=1;
        foreach ($dt as $row) {
            $datos.=$row->id;
            if ($x < $dt->count()) { $datos.=','; }
            $x++;
        }
        return '['.$datos.']';

    }


    public function rpt_semi_datos_estado($estado,$anio,$tipo_eval)
    {
        $datos='';
        $dt_indics=Semi_Indicadores::get();
        

        foreach ($dt_indics as $row) {
            $val_item=0;

            $dt_eval=Semi_Evaluacion::where('anio_grupo',$anio)->where('estado',$estado)->where('tipo_eval',$tipo_eval)->where('id_indicador',$row->id)->count('id');
            $dt_mvs=Semi_MV::where('id_indicador',$row->id)->count('id');

            $dt_no_ap=Semi_MV::where('id_indicador',$row->id)->where('aplica',0)->count('id');

            if($estado=='NO'){
                if($dt_eval == $dt_mvs){ $val_item=1; }else{ $val_item=0; } // No mantiene
            }


            if($estado=='PARCIAL'){
                if(($dt_eval == $dt_mvs || $dt_eval>0) && $dt_no_ap==0){ $val_item=3; }else{ $val_item=0; }
                $dt_sm=Semi_Evaluacion::where('anio_grupo',$anio)->where('id_indicador',$row->id)->where('estado','SI')->where('tipo_eval',$tipo_eval)->count('id');

                if($dt_sm > 0 && $dt_sm <  ($dt_mvs - $dt_no_ap)){ $val_item=3; }
            }
            

            if($estado=='SI'){
                if($dt_eval == ($dt_mvs - $dt_no_ap) && $dt_eval>0){ $val_item=5; }else{ $val_item=0; } // Se mantiene
            }

            if($estado=='NP'){
                if($dt_eval == $dt_mvs){ $val_item=1; }else{ $val_item=0; } // No Aplica
            }


            $datos.=intval($val_item);
            if($row->id<20){ $datos.=','; }
            
        }

        return '['.$datos.']';
    }




    public function semi_por_cbc($estado,$anio,$tipo_eval)
    {
        $datos='';
        $dt_cbc=Semi_Condiciones::get();
        foreach($dt_cbc as $row){
            $v_cbc=0;

            $dt_indics=Semi_Indicadores::where('id_condicion',$row->id)->get();
            foreach ($dt_indics as $indic) {
                if($estado=='SI'){
                    $dt_sm=Semi_Evaluacion::where('id_indicador',$indic->id)->where('estado','SI')->where('anio_grupo',$anio)->where('tipo_eval',$tipo_eval)->count('id');
                    $v_cbc=$v_cbc + $dt_sm;
                }

                if($estado=='PARCIAL'){
                    $dt_pm=Semi_Evaluacion::where('id_indicador',$indic->id)->where('estado','PARCIAL')->where('anio_grupo',$anio)->where('tipo_eval',$tipo_eval)->count('id');
                    $v_cbc=$v_cbc + $dt_pm;
                }

                if($estado=='NO'){
                    $dt_nm=Semi_Evaluacion::where('id_indicador',$indic->id)->where('estado','NO')->where('anio_grupo',$anio)->where('tipo_eval',$tipo_eval)->count('id');
                    $v_cbc=$v_cbc + $dt_nm;
                }

                if($estado=='NP'){
                    $dt_no_ap=Semi_Evaluacion::where('id_indicador',$indic->id)->where('estado','NP')->where('anio_grupo',$anio)->where('tipo_eval',$tipo_eval)->count('id');
                    $v_cbc=$v_cbc + $dt_no_ap;
                }

            }



            $datos.=$v_cbc;
            if ($row->id<5) { $datos.=','; }
        }

        return '['.$datos.']';
    }



    public function rpt_semi_porcent_indic($estado,$anio,$tipo_eval)
    {
        $indic_estado=0;
        $grupo_indics='';

        $dt_indics=Semi_Indicadores::get();
        

        foreach ($dt_indics as $row) {
            $mvs_aplica=Semi_MV::where('aplica',1)->where('id_indicador',$row->id)->count('id');

            $mvs_no_aplica=Semi_MV::where('aplica',0)->where('id_indicador',$row->id)->count('id');
            $mvs_indic=Semi_MV::where('id_indicador',$row->id)->count('id');

            $dt_estado=Semi_Evaluacion::where('anio_grupo',$anio)->where('estado',$estado)->where('tipo_eval',$tipo_eval)->where('id_indicador',$row->id)->count('id');

            if($estado=='SI'){
                if($dt_estado==$mvs_aplica && $mvs_aplica>0){ 
                    $indic_estado++; 
                }
            }
           

            if($estado=='PARCIAL'){
                $dt_estado_si=Semi_Evaluacion::where('anio_grupo',$anio)->where('estado','SI')->where('tipo_eval',$tipo_eval)->where('id_indicador',$row->id)->count('id');
                if(($dt_estado>0 || ($dt_estado_si<$mvs_aplica && $dt_estado_si>0)) && $mvs_aplica>0){ 
                    $indic_estado++; 
                }
            }

            if($estado=='NO'){
                if($dt_estado==$mvs_aplica && $mvs_aplica>0){ 
                    $indic_estado++; 
                }
            }

            if($estado=='NP'){
                if($mvs_no_aplica==$mvs_indic){ 
                    $indic_estado++; 
                }
            }


        }

        return $indic_estado;
    }


    public function rpt_semi_porcent_mv($estado,$anio,$tipo_eval)
    {
        $mvs_estado=0;
        $mvs_aplica=Semi_MV::where('aplica',1)->count('id');


        if($estado=='SI' || $estado=='PARCIAL' || $estado=='NO'){
            $mvs_estado=Semi_Evaluacion::where('anio_grupo',$anio)->where('estado',$estado)->where('tipo_eval',$tipo_eval)->count('id');
        }else{
            

            if($estado=='NP'){
                //$mvs_estado=LicMV::where('aplica',0)->count('id');
                $mvs_estado=Semi_Evaluacion::where('anio_grupo',$anio)->where('tipo_eval',$tipo_eval)->where('estado','NP')->count('id');
            }
        }

        return $mvs_estado;
    }





}


