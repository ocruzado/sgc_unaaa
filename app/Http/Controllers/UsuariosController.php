<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Crypt;

use App\Http\Controllers\FuncionesController;

use Illuminate\Http\Request;
use App\Models\Oficinas;

use App\Models\Roles;

use App\Models\User;
use App\Models\Modulos;
use App\Models\PermisoUsuario;


use App\Models\UserMonitoreo;
use App\Models\Procedimiento;

class UsuariosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
    	$dt=User::orderby('id','DESC')->get();

        $dt_oficina=Oficinas::get();

        $dt_modulos=Modulos::where('nivel','<=',1)->get();

        if (Auth::user()->id==1 || Auth::user()->id==26) {
            return view('usuarios',['datos'=>$dt,'dt_modulos'=>$dt_modulos,'dt_oficina'=>$dt_oficina]);
        }else{
            return redirect()->route('home');
        }
    	
    }

    public function guardar_usuario(Request $request)
    {       
        
        $id_rol= 3;




        if ($request->id_registro!='') {

            $dt=User::find($request->id_registro);
            $dt->name=$request->nombre;
            $dt->email=$request->correo;
            if ($request->clave!='') {
                $dt->password=Hash::make($request->clave);
                $dt->key_usu=Crypt::encryptString($request->clave);
            }
            
            if($request->id_registro!=1){ $dt->rol=$id_rol; }
            $dt->id_oficina=$request->oficina;
            $dt->estado=$request->estado;
            $dt->etiqueta=$request->etiqueta!='' ? $request->etiqueta : '';
            $dt->save();

        }else{

            $dt=new User();
            $dt->name=$request->nombre;
            $dt->email=$request->correo;
            $dt->password=Hash::make($request->clave);
            $dt->rol=$id_rol;
            $dt->id_oficina=$request->oficina;
            $dt->etiqueta=$request->etiqueta!='' ? $request->etiqueta : '';
            $dt->key_usu=Crypt::encryptString($request->clave);
            $dt->save();
        }

        return redirect()->back();
        
        
    }




    public function perfil(Request $request)
    {
        return view('perfil');
    }

    public function editar_perfil(Request $request)
    {
        $dt=User::find(Auth::user()->id);
        $dt->name=$request->nombre;
        //$dt->email=$request->correo;
        if ($request->clave!='') {
            $dt->password=Hash::make($request->clave);
            $dt->key_usu=Crypt::encryptString($request->clave);
        }
        $dt->save();

        return redirect()->route('perfil');
    }

    public function listar_permisos(Request $request)
    {
        if ($request->ajax()) {

            $id_usuario=$request->get('id_usuario');

            $dt=Modulos::where('nivel','<=',1)->get();
            $lista='';

            $cls_funciones=new FuncionesController();

            foreach($dt as $modu){
                if($modu->nivel==1){

                    $items_2='';
                    $dt_n2=Modulos::where('id_parent',$modu->id)->get();
                    foreach ($dt_n2 as $niv2) {
                        $check_per2=$cls_funciones->acceso_modulo($id_usuario,$niv2->id)>0 ? 'checked' : '';
                        $items_2.='<div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="modu_'.$niv2->id.'" onchange="cambiar('.$niv2->id.','.$id_usuario.')" '.$check_per2.'>
                                    <label class="form-check-label" for="modu_'.$niv2->id.'" style="cursor: pointer;">
                                        '.$niv2->nombre.'
                                    </label>
                                </div>';
                    }
                    $check_per=$cls_funciones->acceso_modulo($id_usuario,$modu->id)>0 ? 'checked' : '';
                    $lista.='<div class="form-check">
                                <input class="form-check-input" type="checkbox" id="modu_'.$modu->id.'" onchange="cambiar('.$modu->id.','.$id_usuario.')" '.$check_per.'>
                                <label class="form-check-label" for="modu_'.$modu->id.'" style="cursor: pointer;">
                                    '.$modu->nombre.'
                                </label>
                            </div>
                            <div style="width: 100%;padding-left: 23px;">
                                '.$items_2.'
                            </div>';
                }else{
                    $check_per=$cls_funciones->acceso_modulo($id_usuario,$modu->id)>0 ? 'checked' : '';

                    $lista.='<div class="form-check">
                                <input class="form-check-input" type="checkbox" id="modu_'.$modu->id.'" onchange="cambiar('.$modu->id.','.$id_usuario.')" '.$check_per.'>
                                <label class="form-check-label" for="modu_'.$modu->id.'" style="cursor: pointer;">
                                    '.$modu->nombre.'
                                </label>
                            </div>';
                }
            }

            $data=array('datos' =>$lista);
            echo json_encode($data);
        }
    }

    public function asignar_permiso(Request $request)
    {
        if ($request->ajax()) {

            $id_usuario=$request->get('id_usuario');
            $id_modulo=$request->get('id_modulo');
            $estado=$request->get('val_per');

            $dt=PermisoUsuario::where('id_usuario',$id_usuario)->where('id_modulo',$id_modulo)->first();
            if($dt){
                $dt_per=PermisoUsuario::find($dt->id);
                $dt_per->estado=$estado;
                $dt_per->save();
            }else{
                $dt_per=new PermisoUsuario();
                $dt_per->id_usuario=$id_usuario;
                $dt_per->id_modulo=$id_modulo;
                $dt_per->estado=$estado;
                $dt_per->save();
            }

            $data=array('datos' =>'');
            echo json_encode($data);
        }   
    }




}

