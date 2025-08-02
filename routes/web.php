<?php

use Illuminate\Support\Facades\Route;


    
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\MantenimController;
use App\Http\Controllers\LicenController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// USUARIOS
Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios');
Route::post('/guardar_user', [UsuariosController::class, 'guardar_usuario'])->name('guardar_usuario');
Route::get('/perfil', [UsuariosController::class, 'perfil'])->name('perfil');
Route::post('/guardar_perfil', [UsuariosController::class, 'editar_perfil'])->name('guardar_perfil');
Route::get('jx/lst_permisos', [UsuariosController::class, 'listar_permisos'])->name('ajax.lst_permisos');
Route::get('jx/asig_permiso', [UsuariosController::class, 'asignar_permiso'])->name('ajax.asig_permiso');


// MANTENIMIENTO
Route::get('oficinas', [MantenimController::class, 'oficinas'])->name('mante_oficinas');
Route::post('/save_ofi', [MantenimController::class, 'guardar_oficina'])->name('guardar_oficina');
Route::get('modulos', [MantenimController::class, 'modulos'])->name('mante_modulos');
Route::post('/save_modulo', [MantenimController::class, 'guardar_modulo'])->name('guardar_modulo');


// LICENCIAMIENTO 
Route::get('/mantenimiento_cbc', [LicenController::class, 'index'])->name('lic_inicio');


Route::post('/lic19_save_evid24', [LicenController::class, 'guardar_evidencias24'])->name('lic_2019_evids24');
Route::get('/lic19_oficina', [LicenController::class, 'cambiar_oficina'])->name('lic_2019_cambiar');
Route::get('/responsables_cbc', [LicenController::class, 'reporte_responsables'])->name('lic_2019_pdf_ofis');
Route::post('/lic19_borrar_evid', [LicenController::class, 'borrar_evidencia'])->name('lic19_borrar_evid');
Route::post('/lic19_save_mv', [LicenController::class, 'guardar_mv'])->name('lic19_guardar_mv');
Route::get('/lic19_eval_mv', [LicenController::class, 'evaluar_mv'])->name('lic19_evalua_mv');
Route::get('/reporte_cbc', [LicenController::class, 'reporte_avance'])->name('lic19_rpt_eval');
Route::get('/evidencias_cbc', [LicenController::class, 'reporte_evidencias'])->name('lic19_pdf_evids');
Route::get('/priorizados_cbc', [LicenController::class, 'reporte_priorizados'])->name('lic19_pdf_prios');
Route::get('/priorizados_cbc_mod', [LicenController::class, 'reporte_priorizados_modelo'])->name('lic19_pdf_prios_mod');
Route::get('/priorizados_evids', [LicenController::class, 'reporte_priorizados_evids'])->name('lic19_pdf_prios_evid');
Route::get('/estado_cbc', [LicenController::class, 'reporte_estado_cbc'])->name('lic19_pdf_estado');
