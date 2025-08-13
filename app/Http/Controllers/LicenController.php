<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use PDF;

use App\Models\Licen\LicCondiciones;
use App\Models\Licen\LicComponentes;
use App\Models\Licen\LicIndicadores;
use App\Models\Licen\LicMV;


use App\Models\Licen\LicEvidencias;
use App\Models\Licen\LicEvaluacion;




use App\Models\Oficinas;



class LicenController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    function anio_uso(){
        return 2025;
    }

    public function index(Request $request)
    {
        $grupo_anio=$this->anio_uso();

        $dt_condiciones=LicCondiciones::get();
        $dt_componentes=LicComponentes::get();
        $dt_indicadores= LicIndicadores::get();
        $dt_mvs=LicMV::get();


        $dt_evidencias = LicEvidencias::where('estado', 1)->where('anio_grupo', $grupo_anio)->get();
        $dt_oficinas=Oficinas::get();    
        $dt_eval=LicEvaluacion::where('anio_grupo',$grupo_anio)->get();

        return view('licen.index',[
            'dt_condiciones'=>$dt_condiciones,
            'dt_componentes'=>$dt_componentes,
            'dt_indicadores'=>$dt_indicadores,
            'dt_mvs'=>$dt_mvs,
            'dt_evidencias'=>$dt_evidencias,
            'dt_oficinas'=>$dt_oficinas,
            'dt_eval'=>$dt_eval,
            'anio_lic'=>$grupo_anio
        ]);
    }




    public function guardar_evidencias24(Request $request)
    {
        if ($request->ajax()) {

            $id_indicador=$request->id_indic_24;
            $id_mv=$request->id_mv_24;
            $anio_mv=$this->anio_uso();

            $txt_doc='';
            $txt_fuente = 'archivo';
            $id_sisa=0;
            $id_sgc=0;

            $nivel_0=0;
            $nivel_1=0;

            if ($request->tipo_docu=='url') {
                $txt_fuente = 'url';
                $txt_doc = $request->txt_url;
            }elseif($request->tipo_docu=='insti'){
                $id_sisa=$request->id_sisades;
                $txt_fuente = 'url';
                $txt_doc = $request->txt_url;
            }elseif($request->tipo_docu=='sgc'){
                $id_sgc=$request->id_doc_sgc;
                $nivel_0=$request->id_proce0;
                $nivel_1=$request->id_proce1;

                $txt_fuente = 'url';
                $txt_doc = $request->txt_url;
            }else{
                if($request->file('adjunto'))
                {
                    $archivo_doc=$request->file('adjunto');
                    $txt_doc='_'.time().Str::random(15).'.'.$archivo_doc->getClientOriginalExtension();
                    $path = public_path() . '/files/licen/'.$anio_mv.'/indic_' . $id_indicador . '/';
                    $archivo_doc->move($path, $txt_doc);
                }
            }


            if($request->id_registro!=''){
                $dt=LicEvidencias::find($request->id_registro);
                $dt->tipo_docu=$txt_fuente;
                $dt->nom_evidencia=$request->nom_evid;

                if($txt_doc!=''){
                    if($txt_fuente == 'archivo'){
                        $filePath = public_path() . '/files/licen/'.$dt->anio_grupo.'/indic_' . $id_indicador . '/'.$dt->adjunto;
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                    }
                    $dt->adjunto=$txt_doc;
                }
                $dt->id_sisades=$id_sisa;
                $dt->id_sgc=$id_sgc;
                $dt->sgc_niv0=$nivel_0;
                $dt->sgc_niv1=$nivel_1;
                $dt->save();

            }else{
                $dt=new LicEvidencias();
                $dt->anio_grupo=$anio_mv;
                $dt->id_indicador=$id_indicador;
                $dt->id_mv=$id_mv;
                $dt->nom_evidencia=$request->nom_evid;
                $dt->tipo_docu=$txt_fuente;
                $dt->id_sisades=$id_sisa;
                $dt->id_sgc=$id_sgc;
                $dt->sgc_niv0=$nivel_0;
                $dt->sgc_niv1=$nivel_1;
                $dt->adjunto=$txt_doc;
                $dt->al_2019='';
                $dt->al_2024='OK';
                $dt->id_usuario=Auth::user()->id;
                $dt->nom_usuario=Auth::user()->name;
                $dt->estado=1;
                $dt->save();
            }


            $dt_evidencias=LicEvidencias::where('estado',1)->get();

            $data=array('datos' =>'ok','dt_evidencias'=>$dt_evidencias);
            echo json_encode($data);
        }
    }



    public function borrar_evidencia(Request $request)
    {
        if ($request->ajax()) {

            $id_borrar=$request->get('id_borrar');


            $dt=LicEvidencias::find($id_borrar);
            $dt->estado=0;
            $dt->save();


            $data=array('datos' =>'ok');
            echo json_encode($data);
        }
    }


    public function cambiar_oficina(Request $request)
    {
        if ($request->ajax()) {

            $id_indicador=$request->get('id_indicador');
            $id_oficina=$request->get('id_oficina');

            $dt=LicMV::find($id_indicador);
            $dt->id_responsable=$id_oficina!='' ? $id_oficina : 0 ;
            $dt->save();

            $txt_ofi='';
            if($id_oficina!=''){
                $dt_ofi=Oficinas::find($id_oficina);
                $txt_ofi=$dt_ofi->nombre;
            }
            
            $dt_mvs=LicMV::get();

            $data=array('datos' =>'ok','nom_ofi'=>$txt_ofi,'dt_mvs'=>$dt_mvs);
            echo json_encode($data);
        }
    }


    function guardar_mv(Request $request){
        if ($request->ajax()) {

            $id_indicador=$request->id_indic_mv;

            $dt=LicMV::find($id_indicador);
            $dt->consids=$request->text_mvs;
            $dt->save();

            $dt_mvs=LicMV::get();

            $data=array('datos' =>'ok','dt_mvs'=>$dt_mvs);
            echo json_encode($data);
        }
    }


    public function reporte_responsables(Request $request)
    {
        $dt_condiciones=LicCondiciones::get();

        $dt_componente=LicComponentes::get();
        $dt_mv=LicMV::get();

        $dt_indicadores=LicIndicadores::where('lic_indicador.id','>',0)
        ->join('lic_componente','lic_indicador.id_componente','=','lic_componente.id')
        ->select('lic_indicador.*','lic_componente.cod_componente','lic_componente.nom_componente')
        ->get();

        $pdf = PDF::loadView('licen.pdf_responsables_cbc',['dt_condiciones'=>$dt_condiciones,'dt_componente'=>$dt_componente,'dt_indicadores'=>$dt_indicadores,'dt_mv'=>$dt_mv])->setPaper('A4', 'portrait'); 
        //portrait, landscape

        return response($pdf->output())->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename=Reporte_responsables_CBC.pdf'); 
    }


    public function evaluar_mv(Request $request)
    {
        if ($request->ajax()) {

            $id_mv=$request->get('id_mv');
            $estado=$request->get('estado');
            $anio_eval=$this->anio_uso();
            $tipo_eval=$request->get('tipo');


            $dt_eval=LicEvaluacion::where('anio_grupo',$anio_eval)->where('id_mv',$id_mv)->where('tipo_eval',$tipo_eval)->first();
            if($dt_eval){
                $dt=LicEvaluacion::find($dt_eval->id);
                $dt->estado=$estado;
                $dt->save();
            }else{

                $dt_mv=LicMV::find($id_mv);

                $dt=new LicEvaluacion();
                $dt->anio_grupo=$anio_eval;
                $dt->id_indicador=$dt_mv->id_indicador;
                $dt->id_mv=$id_mv;
                $dt->sigla_mv=$dt_mv->sigla_mv;
                $dt->estado=$estado;
                $dt->tipo_eval=$tipo_eval;
                $dt->save();
            }


            $dt_eval=LicEvaluacion::where('anio_grupo',$anio_eval)->get();

            $data=array('datos' =>'ok','dt_eval'=>$dt_eval);
            echo json_encode($data);
        }
    }

    public function agregar_comentario(Request $request)
    {
        if ($request->ajax()) {

            $id_registro=$request->get('id_registro');
            $comentario=$request->get('comentario');


            $dt=LicEvidencias::find($id_registro);
            $dt->comentario=$comentario!='' ? $comentario : '';
            $dt->save();


            $dt_evidencias=LicEvidencias::where('anio_grupo',$this->anio_uso())->where('estado',1)->get();

            $data=array('datos' =>'ok','dt_evidencias'=>$dt_evidencias);
            echo json_encode($data);
        }
    }





    public function reporte_avance(Request $request)
    {
        $anio_eval=$this->anio_uso();

        return view('licen.reporte_evaluacion');
    }



    public function reporte_evidencias(Request $request)
    {
        $dt_condiciones=LicCondiciones::get();

        $dt_componente=LicComponentes::get();
        $dt_mv=LicMV::get();

        $dt_indicadores=LicIndicadores::where('lic19_indicador.id','>',0)
        ->join('lic19_componente','lic19_indicador.id_componente','=','lic19_componente.id')
        ->select('lic19_indicador.*','lic19_componente.cod_componente','lic19_componente.nom_componente')
        ->get();


        $dt_evidencias=LicEvidencias::where('anio_grupo',$this->anio_uso())->where('estado',1)->get();


        $pdf = PDF::loadView('lic2019.pdf_evidencias',['dt_condiciones'=>$dt_condiciones,'dt_componente'=>$dt_componente,'dt_indicadores'=>$dt_indicadores,'dt_mv'=>$dt_mv,'dt_evidencias'=>$dt_evidencias])->setPaper('A4', 'portrait');
        //portrait, landscape


        return response($pdf->output())->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename=Reporte_evidencias_CBC.pdf'); 
    }


    public function reporte_estado_cbc(Request $request)
    {
        $dt_condiciones=LicCondiciones::get();

        $dt_componente=LicComponentes::get();
        $dt_mv=LicMV::where('aplica',1)->get();

        $dt_indicadores=LicIndicadores::where('lic_indicador.id','>',0)
        ->join('lic_componente','lic_indicador.id_componente','=','lic_componente.id')
        ->select('lic_indicador.*','lic_componente.cod_componente','lic_componente.nom_componente')
        ->get();



        $pdf = PDF::loadView('licen.pdf_estado_cbc',['dt_condiciones'=>$dt_condiciones,'dt_componente'=>$dt_componente,'dt_indicadores'=>$dt_indicadores,'dt_mv'=>$dt_mv])->setPaper('A4', 'portrait');
        //portrait, landscape


        return response($pdf->output())->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename=Reporte_cumplimiento_MV.pdf'); 
    }


    public function reporte_detallado(Request $request)
    {
        $dt_condiciones=LicCondiciones::get();

        $dt_componente=LicComponentes::get();
        $dt_mv=LicMV::where('aplica',1)->get();

        $dt_indicadores=LicIndicadores::where('lic_indicador.id','>',0)
        ->join('lic_componente','lic_indicador.id_componente','=','lic_componente.id')
        ->select('lic_indicador.*','lic_componente.cod_componente','lic_componente.nom_componente')
        ->get();



        $pdf = PDF::loadView('licen.pdf_reporte_detallado',['dt_condiciones'=>$dt_condiciones,'dt_componente'=>$dt_componente,'dt_indicadores'=>$dt_indicadores,'dt_mv'=>$dt_mv])->setPaper('A3', 'landscape');
        //portrait, landscape


        return response($pdf->output())->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename=Reporte_detallado_CBC.pdf'); 
    }





}

