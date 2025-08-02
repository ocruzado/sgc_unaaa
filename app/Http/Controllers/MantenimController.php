<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Oficinas;
use App\Models\Modulos;

class MantenimController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function oficinas(Request $request)
    {
        
        $dt_datos=Oficinas::orderby('nombre','ASC')->get();

        return view('mantenimiento.oficinas',['dt_datos'=>$dt_datos]);
    }

    public function guardar_oficina(Request $request)
    {      
         if ($request->id_registro!='') {
            $dt=Oficinas::find($request->id_registro);
            $dt->nombre=mb_strtoupper($request->nombre);
            $dt->save();
        }else{
            $dt=new Oficinas();
            $dt->nombre=mb_strtoupper($request->nombre);
            $dt->save();                   
        } 

        return redirect()->back(); 
    } 




    public function modulos(Request $request)
    {
        $dt=Modulos::where('nivel','<=',1)->get();
        return view('mantenimiento.modulos',['datos'=>$dt]);
    }
            
    public function guardar_modulo(Request $request)
    {
        if ($request->id_registro!='') {
            $dt=Modulos::find($request->id_registro);
        }else{
            $nivel=0;
            if ($request->aux_vivel=='01') {
                if ($request->submenu!='') { $nivel=$request->submenu; }
            }else{
                $nivel=2;
            }
            

            $dt=new Modulos();
            $dt->nivel=$nivel;
            $dt->id_parent=$request->id_padre;
            $dt->nombre=$request->nombre;
            $dt->save();
        }

        return redirect()->back();
    }



}
