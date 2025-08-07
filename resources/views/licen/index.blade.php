@inject('funciones','App\Http\Controllers\FuncionesController')
@extends('layouts.header')
@section('contenido')


<!-- Librería toastr -->
@include('libreria_toastr')


<link rel="stylesheet" href="{{ asset('summernote/summernote/summernote-lite.css') }}">
<link rel="stylesheet" href="{{ asset('summernote/summernote/summernote-bs5.min.css') }}">
<link rel="stylesheet" href="{{ asset('summernote/css/styles.css') }}">


<style type="text/css">
    
html, body {
    margin: 0 !important;
    padding: 0 !important;
    overflow-x: hidden !important;
    overflow-y: auto;
}

</style>


<script src="{{ asset('summernote/summernote/summernote-lite.js') }}"></script>
<script src="{{ asset('summernote/summernote/lang/summernote-es-ES.js') }}"></script>


<!-- include mv -->
@include('licen.includes_mvs')


<style>

    .btn_condicion{
        border: 1px solid #D5D8D9;
        margin: 5px;
        border-radius: 10px;
        -webkit-box-shadow: 5px 5px 3px 0px rgba(184, 182, 184, 0.46);
        -moz-box-shadow: 5px 5px 3px 0px rgba(184, 182, 184, 0.46);
        box-shadow: 5px 5px 3px 0px rgba(184, 182, 184, 0.46);
        color: #2E75B6;
        cursor: pointer;
    }

    .btn_condicion:hover{
        color: #fff;
        background-color: #57bb6b;
    }

    .btn_condicion_active:hover{
        color: #fff;
        background-color: #57bb6b;
    }

    .btn_condicion_active{
        border: 1px solid #D5D8D9;
        margin: 5px;
        border-radius: 10px;
        -webkit-box-shadow: 5px 5px 3px 0px rgba(184, 182, 184, 0.46);
        -moz-box-shadow: 5px 5px 3px 0px rgba(184, 182, 184, 0.46);
        box-shadow: 5px 5px 3px 0px rgba(184, 182, 184, 0.46);
        color: #fff;
        cursor: pointer;
        background-color: #57bb6b;
    }

</style>


<?php 

    $lst_condiciones = json_encode($dt_condiciones);
    $lst_componentes= json_encode($dt_componentes);
    $lst_indicadores = json_encode($dt_indicadores);
    $lst_evidencias = json_encode($dt_evidencias);
    $lst_oficinas = json_encode($dt_oficinas);
    $lst_mvs = json_encode($dt_mvs);
    $lst_evals=json_encode($dt_eval);






?>

<script>

    var arr_condiciones = <?= $lst_condiciones ?>;
    var arr_componentes = <?= $lst_componentes ?>;
    var arr_indicadores = <?= $lst_indicadores ?>;
    var arr_evidencias = <?= $lst_evidencias ?>;
    var arr_oficinas = <?= $lst_oficinas ?>;

    var arr_mvs = <?= $lst_mvs ?>;
    var arr_evals = <?= $lst_evals ?>;


</script>






<!-- eliminar datos -->
<div class="modal fade" id="mdl_borrar" tabindex="-1" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">  ELIMINAR REGISTRO   </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="id_borrar">

                <div class="row justify-content-center mb-3">
                    <div class="col-lg-11 text-center">
                        <span style="font-size: 32px;">
                            <i class="lni lni-question-circle text-warning"></i>
                        </span>
                        <h5>Está seguro(a) de eliminar los datos.?</h5>
                        <p>Una vez eliminada, no se podrá recuperar. Esta acción es irreversible.</p>
                    </div>
                </div>

                <div class="row justify-content-center mb-3">
                    <div class="col-lg-11">
                        <div class="d-flex" style="justify-content: right;">

                            <button class="btn btn-secondary" type="button" data-dismiss="modal" style="margin-right: 10px;" id="btn_close_borrar">
                                <i class="bx bx-x"></i> Cancelar
                            </button>

                            <button class="btn btn-warning" id="btn_borrar_datos" type="button" onclick="borrar_datos()">
                                <i class="bx bx-trash"></i> Confirmar
                            </button>
                        </div>                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>





<!-- Cambiar oficina -->
<div class="modal fade" id="mdl_oficinas" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Asignar responsable </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <input type="hidden" id="id_indic_ofi" name="id_indic_ofi">
                <div class="form-group row mb-3">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <label class="form-label">Responsable:</label> 
                        <select id="id_oficina" class="form-control select2">
                            <option value="">- - Seleccione ...</option>
                            @foreach($dt_oficinas as $ofi)
                                <option value="{{ $ofi->id }}">{{ $ofi->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
            
                <div class="row justify-content-center mb-3">
                    <div class="col-lg-11">
                        <div class="d-flex" style="justify-content: right;">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal" style="margin-right: 10px;" id="btn_close_ofi">
                                <i class="bx bx-x"></i> Cerrar
                            </button>

                            <button class="btn btn-primary" type="button" id="btn_cambiar" onclick="guardar_cambio()">
                                <i class="bx bx-check"></i> Guardar
                            </button>
                        </div>                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>




<!-- Evidencias 2024 -->

<div class="modal fade" id="mdl_datos_24"  aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Subir evidencias </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  method="POST" enctype="multipart/form-data" id="frm_datos">
                @csrf

            <div class="modal-body">

                <input type="hidden" id="id_registro" name="id_registro"> 
                <input type="hidden" id="id_indic_24" name="id_indic_24">
                <input type="hidden" id="id_mv_24" name="id_mv_24">

               
                <div class="form-group row mb-3">
                    <label class="col-md-3 form-label">Tipo documento:</label>
                    <div class="col-md-4">
                        <select id="tipo_docu" name="tipo_docu" class="form-control">
                            <option value="">Seleccione...</option>
                            <option value="archivo">ARCHIVO</option>
                            <option value="url">LINK</option>
                        </select>
                    </div>
                </div>


                <div class="form-group row mb-3">
                    <label class="col-md-3 form-label">Nombre documento:</label>
                    <div class="col-md-8">
                        <textarea type="text" name="nom_evid" id="nom_evid" class="form-control" required rows="2"></textarea>
                    </div>
                </div>

                <div class="form-group row mb-3" id="div_archivo">
                    <label class="col-md-3 form-label">Documento adjunto:</label>
                    <div class="col-md-8">
                        <input type="file" name="adjunto" id="adjunto" class="form-control" multiple>
                    </div>
                </div>

                <div class="form-group row mb-3" id="div_url">
                    <label class="col-md-3 form-label">LINK:</label>
                    <div class="col-md-8">
                        <textarea type="text" name="txt_url" id="txt_url" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <br>
            
                <div class="row justify-content-center mb-3">
                    <div class="col-lg-11">
                        <div class="d-flex" style="justify-content: right;">

                            <button class="btn btn-secondary" type="button" data-dismiss="modal" id="btn_close_24" style="margin-right: 10px;">
                                <i class="bx bx-x"></i> Cerrar
                            </button>

                            <button class="btn btn-primary" type="button" id="btn_guardar_24" onclick="subir_evidencia()">
                                <i class="bx bx-check"></i> Guardar
                            </button>

                        </div>                        
                    </div>
                </div>

            </div>
            </form>
        </div>
    </div>
</div>









<!-- <div class="container"> -->
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> 

                    <div class="row">
                        <div class="col-lg-8">
                            <h5 class="m-0"> 
                                
                                LICENCIAMIENTO 
                                <i class="ri-arrow-right-s-line text-primary"></i>  
                                Mantenimiento de las CBC

<!-- 
                                <a href="{{ route('lic_2019_pdf_ofis') }}" class="btn btn-info px-3 radius-30 btn-sm" target="_blank" style="margin-left: 10px;">
                                    <i class="bx bx-file"></i> Responsables
                                </a>
 -->

                            </h5> 
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 p-2" >
                            @foreach($dt_condiciones as $condic)
                                <button class="btn btn-sm btn_condicion" type="button" onclick="ver_indicadores({{ $condic->id }})" id="btn_condic_{{ $condic->id }}">
                                    <i class="bx bx-chevron-right"></i> {{ $condic->sigla_condic }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="row mb-0" >
                        <div class="col-md-8">
                            <p>
                                <small style="background-color: #F7F3E7;padding: 3px 7px 3px 7px;border-radius: 10px;text-transform: uppercase;" id="lbl_condicion"></small>
                            </p>
                        </div>
                        <div class="col-md-4" style="text-align: right;">
                            <p>
                                <small style="background-color: #DCEBFA;padding: 3px 7px 3px 7px;border-radius: 10px;" id="lbl_componente"></small>
                            </p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div style="background-color: #F3FAFC;max-width: 160px;width:160px;margin-right: 5px;padding: 5px;">
                            <div style="background-color: #7DA0B1;color: #fff;text-align: center;padding: 3px;border-radius: 5px 5px 0px 0px;" class="mb-2">INDICADORES</div>
                            <div id="div_indicadores"></div>
                        </div>
                        <div style="background-color: #F3FAFC;max-width: 100px;width:100px;margin-right: 15px;padding: 5px;">
                            <div id="div_mvs"></div>
                        </div>

                        <div style="width:95%;max-width: 95%;">

                             <div class="row">
                                <div class="col-lg-6 col-md-6" style="border: 1px solid #E6F4C2;border-radius: 10px 10px 0px 0px;padding: 10px;">
                                    <span id="lbl_descrip"></span>
                                </div>
                                <div class="col-lg-6 col-md-6" style="border-radius: 10px 10px 0px 0px;padding: 10px;background-color: #DEE9EE;">
                                    <p class="m-0" id="div_responsable"></p>
                                </div>
                                <div class="col-lg-12 col-md-12" style="border-radius: 0px 0px 10px 10px;padding: 10px;border: 1px solid #E6F4C2;">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <p class="m-0" id="lbl_mv"></p>
                                        </div>
                                        <div class="col-lg-3">
                                            <select id="estado_doc" class="form-control">
                                                <option value="">-- Estado --</option>
                                                <option value="SM">CUMPLIDO</option>
                                                <option value="PM">EN PROCESO</option>
                                                <option value="NM">NO CUMPLIDO</option>
                                                <option value="NP">No Aplica</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div style="text-align: right;" class="mb-2">
                                        <button class="btn btn-secondary px-3 btn-rounded btn-sm" type="button" onclick="ver_mv()" data-toggle="modal" data-target="#mdl_mvs" style="margin-right: 5px;">
                                            <i class="fas fa-info-circle"></i> consideraciones
                                        </button>
                                        <button class="btn btn-success px-3 btn-rounded btn-sm" type="button" onclick="subir_evid_actual()" data-toggle="modal" data-target="#mdl_datos_24"> 
                                            <i class="fas fa-plus"></i> Registrar evidencia
                                        </button>
                                    </div>

                                    <table class="table table-bordered table-striped" style="width:100%;" id="tbl_actual">
                                        <thead style="background-color: #7ab5e3;color: #fff;">
                                            <th>#</th>
                                            <th>Evidencias</th>
                                            <th>Fuente</th>
                                            <th>Opciones</th>
                                        </thead>
                                        <tbody id="tbl_datos_24">
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                        </div>
                    </div>


                    <br><br>

                </div>
            </div>
        </div>
    </div>



<script>
    
$(document).ready(function() {
    $('#tbl_actual').DataTable();
});


var indic_elegido='';
var mv_elegido='';

function ver_indicadores(id_condic) {
    var lista_indicads='';
   var obj_indics = arr_indicadores.filter(indic => indic.id_condicion === id_condic);
   var incre_btn=0;
   var id_click=0;
    obj_indics.forEach(function(indicad) {
        lista_indicads+=`<button class="btn btn-secondary btn-sm px-3 btn-rounded m-1" onclick="elegir_indic(${indicad.id},${id_condic})" id="btn_indic_${indicad.id}">${indicad.nom_indicador}</button>`;
        if(incre_btn==0){ id_click=indicad.id; }
        incre_btn++;
    });


    $('#div_indicadores').html(lista_indicads);
    
    var nom_condic='';

    arr_condiciones.forEach(function(condic) {
        if (id_condic == condic.id) {
            $('#btn_condic_' + condic.id).addClass('btn_condicion_active').removeClass('btn_condicion');
            nom_condic=condic.descrip;
        } else {
            $('#btn_condic_' + condic.id).addClass('btn_condicion').removeClass('btn_condicion_active');
        }
    });

    $('#btn_indic_'+id_click).click();

    $('#lbl_condicion').text(nom_condic);
}



function elegir_indic(id_indic,id_condic) {
    $('#id_indicador').val(id_indic);
    


    indic_elegido = id_indic;

    var id_compo='';
   var obj_indicador = arr_indicadores.find(indic => indic.id === id_indic);
   $('#lbl_descrip').html('<b>' +obj_indicador.nom_indicador +'.</b> '+ obj_indicador.descrip);


   var btns_indics = arr_indicadores.filter(indic => indic.id_condicion === id_condic);
    btns_indics.forEach(function(indicad) {
        if(id_indic==indicad.id){
            $('#btn_indic_' + indicad.id).addClass('btn-success').removeClass('btn-secondary');
            id_compo=indicad.id_componente;
        }else{
            $('#btn_indic_' + indicad.id).addClass('btn-secondary').removeClass('btn-success');
        }
    });
   


    // listar MVS
    var objs_mvs= arr_mvs.filter(mv => mv.id_indicador === id_indic);
    var botones_mvs='';
   var incre_btn_mv=0;
   var id_click_mv=0;

    objs_mvs.forEach(function(mvi) {
        botones_mvs+=`<button class="btn btn-secondary btn-sm px-3 radius-30 m-1" onclick="elegir_mv(${id_indic},${mvi.id})" id="btn_mv_${mvi.id}">${mvi.sigla_mv}</button>`;
        if(incre_btn_mv==0){ id_click_mv=mvi.id; }
        incre_btn_mv++;
    });
    $('#div_mvs').html(botones_mvs);
    $('#btn_mv_'+id_click_mv).click();


    var obj_compo=arr_componentes.find(compo => compo.id === id_compo);
    $('#lbl_componente').text(obj_compo.cod_componente+' . '+obj_compo.nom_componente);
}




function elegir_mv(id_indic,id_mv){

   var btns_mvs= arr_mvs.filter(mv => mv.id_indicador === id_indic);


    btns_mvs.forEach(function(mvi) {
        if(id_mv==mvi.id){
            $('#btn_mv_' + mvi.id).addClass('btn-warning').removeClass('btn-secondary');
            $('#lbl_mv').html(`<span style="color: #21b26e;"><b>${mvi.sigla_mv}</b>.</span> ${mvi.nom_mv}`);

            $('#lbl_indic').html('Indicador '+ id_indic + ' - '+mvi.sigla_mv);
            $('#text_mvs').summernote('code', mvi.consids);


            var nom_ofi='<span><b>Responsable:</b></span> <span class="text-danger"> Sin asignar </span>';
            if(mvi.id_responsable!=0){
                var obj_oficina=arr_oficinas.find(ofii => ofii.id === mvi.id_responsable);
                nom_ofi='<b>Responsable:</b> ' + obj_oficina.nombre;
            }

            var btn_ofi=nom_ofi+'<button class="btn btn-link btn-sm" title="Cambiar responsable" onclick="cambiar_oficina('+mvi.id+','+mvi.id_responsable+')" data-toggle="modal" data-target="#mdl_oficinas"> <i class="fas fa-pen"></i> </button>';
            
            $('#div_responsable').html(btn_ofi);


        }else{
            $('#btn_mv_' + mvi.id).addClass('btn-secondary').removeClass('btn-warning');
        }
    });

    mv_elegido=id_mv;
    ver_evidencias_actuales(id_indic,mv_elegido);


    var obj_eva_doc=arr_evals.find(evalua => evalua.id_mv === id_mv && evalua.tipo_eval === 'DOCUMENTAL');
    if(obj_eva_doc){
       $('#estado_doc').val(obj_eva_doc.estado);
    }else{
        $('#estado_doc').val('');
    }

    
}



$('#tipo_docu').change(function(){
    var tipo_d=$('#tipo_docu').val();
    if(tipo_d!='' && tipo_d=='url'){
        $('#div_archivo').hide();
        $('#div_url').show();
    }else{
        $('#div_archivo').show();
        $('#div_url').hide();
    }
});




function subir_evid_actual(){
    $('#id_indic_24').val(indic_elegido);
    $('#id_mv_24').val(mv_elegido);
    $('#id_registro').val('');


    $('#tipo_docu').val('archivo');
    $('#div_archivo').show();
    $('#div_url').hide();

    $('#nom_evid').val('');
    $('#txt_url').val('');
    $('#adjunto').val('');

    $('#btn_guardar_24').prop('disabled',false);
    $('#btn_guardar_24').html('<i class="bx bx-check"></i> Guardar');
}



function editar_evid24(id_indic,id_mv,id_evid,tipo,id_sisa,id_sgc,sgc_niv0,sgc_niv1){
    $('#id_indic_24').val(id_indic);
    $('#id_mv_24').val(id_mv);
    $('#id_registro').val(id_evid);



    $('#tipo_docu').val(tipo);

    if(tipo=='url'){
        $('#div_archivo').hide();
        $('#div_url').show();

        $('#txt_url').val($('#txt_url_'+id_evid).val());

    }else{
        $('#div_archivo').show();
        $('#div_url').hide();
        $('#txt_url').val('');
    }


    $('#nom_evid').val($('#txt_nom_'+id_evid).val());
    $('#adjunto').val('');


    $('#btn_guardar_24').prop('disabled',false);
    $('#btn_guardar_24').html('<i class="bx bx-check"></i> Guardar');
}







function ver_evidencias_actuales(id_indic,id_mv) {

    var anio_elegido="{{ $anio_lic }}";

    // ACTUALES
    var items_2024=1;
    var fila_evidencias2='';
    var obj_evids_actual = arr_evidencias.filter(evid => evid.id_mv === id_mv && evid.anio_grupo === anio_elegido*1);
    obj_evids_actual.forEach(function(eviden) {
        
            var url_evid='';
            var txt_fuente='';

            if(eviden.tipo_docu=='archivo'){
                url_evid="{{ asset('files/licen') }}/"+anio_elegido+'/indic_'+id_indic+'/'+eviden.adjunto;
                txt_fuente='Archivo';
            }else{
                url_evid=eviden.adjunto;
                txt_fuente='Link';
            }


            
           fila_evidencias2+=`<tr id="fila_${eviden.id}">
                <td>${items_2024}</td>
                <td style="font-size:10pt;"><a href="${url_evid}" target="_blank"> ${eviden.nom_evidencia} </a></td>
                <td style="font-size:10pt;"><small style="background-color: #63779C;color: #fff;padding: 3px;border-radius: 5px;"> ${txt_fuente} </small></td>
                <td>
                    <input type="hidden" id="txt_nom_${eviden.id}" value="${eviden.nom_evidencia}">
                    <input type="hidden" id="txt_url_${eviden.id}" value="${eviden.adjunto}">

                    <div class="d-flex">
                    <button class="btn btn-link btn-sm" type="button" title="Editar" onclick="editar_evid24(${id_indic},${eviden.id_mv},${eviden.id},'${eviden.tipo_docu}',${eviden.id_sisades},${eviden.id_sgc},${eviden.sgc_niv0},${eviden.sgc_niv1})" data-toggle="modal" data-target="#mdl_datos_24"> 
                        <i class="fas fa-pen"></i> 
                    </button>

                    <button class="btn btn-link btn-sm" type="button" title="Eliminar" data-toggle="modal" data-target="#mdl_borrar" onclick="eliminar(${eviden.id})"> 
                        <i class="fas fa-trash-alt"></i> 
                    </button>
                    </div>

                </td>
            </tr>`;
            items_2024++;
    });

    //$('#tbl_datos_24').html(fila_evidencias2);

    $('#tbl_actual').DataTable().clear().destroy();
    $('#tbl_actual tbody').html(fila_evidencias2);
    $('#tbl_actual').DataTable({ paging: true,searching: true,ordering: true});


}








$('#frm_laboratorio').submit(function() {
    $('#btn_guardar').prop('disabled',true);
    $('#btn_guardar').html('<i class="bx bx-loader"></i> Guardando...');
});




function subir_evidencia(){
    var formData = new FormData($('#frm_datos')[0]);

    var tipo_docu=$('#tipo_docu').val();
    var nom_evid=$('#nom_evid').val();

    var adjunto=$('#adjunto').val();
    var txt_url=$('#txt_url').val();


    var reg_valido=0;
    if(tipo_docu=='archivo' && adjunto!=''){ reg_valido=1; }
    if(tipo_docu=='url' && txt_url!=''){ reg_valido=1; }
    
    if(tipo_docu=='archivo' && id_registro!=''){ reg_valido=1; }

    if (tipo_docu!='' && nom_evid!='' && reg_valido==1) {

        $('#btn_guardar_24').prop('disabled',true);
        $('#btn_guardar_24').html('<i class="bx bx-loader"></i> Guardando...');

        $.ajax({
            url: '{{ route("lic_2019_evids24") }}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {

                var obj_data=JSON.parse(data);
                arr_evidencias=obj_data.dt_evidencias;
                $('#btn_close_24').click();
                //elegir_indic($('#id_indic_24').val()*1);

                elegir_mv(indic_elegido,mv_elegido);


            }
        });

    }else{ toastr.warning("Complete los datos");  }

}


function cambiar_oficina(id_indic,id_ofi){
    $('#id_indic_ofi').val(id_indic);

    var ofi_id=id_ofi!=0 ? id_ofi : '';
    $('#id_oficina').val(ofi_id).trigger('change');

    $('#btn_cambiar').prop('disabled',false);
    $('#btn_cambiar').html('<i class="bx bx-check"></i> Guardar');

}

function guardar_cambio(){
    var id_indica=$('#id_indic_ofi').val();
    var id_ofic=$('#id_oficina').val();

    $('#btn_cambiar').prop('disabled',true);
    $('#btn_cambiar').html('<i class="bx bx-loader"></i> Guardando...');

    $.ajax({
        url: "{{ route('lic_2019_cambiar') }}",
        data: {id_indicador:id_indica,id_oficina:id_ofic},
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#btn_close_ofi').click();
            var nombre_ofi='<span><b>Responsable:</b></span> <span class="text-danger"> Sin asignar </span>';
            if(data.nom_ofi!=''){ nombre_ofi='<b>Responsable:</b> ' + data.nom_ofi; }

            var boton_ofi=nombre_ofi+'<button class="btn btn-link btn-sm" title="Cambiar responsable" onclick="cambiar_oficina('+id_indica+','+id_ofic+')" data-toggle="modal" data-target="#mdl_oficinas"> <i class="fas fa-pen"></i> </button>';

            $('#div_responsable').html(boton_ofi);

            arr_mvs=data.dt_mvs;

        }
    }); 

}



setTimeout(() => {
  $('#btn_condic_1').click();
}, "1000");



//
function eliminar(id_dato) {
   $('#id_borrar').val(id_dato);
    $('#btn_borrar_datos').prop('disabled',false);
    $('#btn_borrar_datos').html('<i class="bx bx-trash"></i> Confirmar');
}


function borrar_datos(){
   var id_borrar=$('#id_borrar').val();

    $('#btn_borrar_datos').prop('disabled',true);
    $('#btn_borrar_datos').html('<i class="bx bx-loader"></i> Eliminando...');
    
    $.ajax({
        url: "{{ route('lic19_borrar_evid') }}",
        data: {id_borrar:id_borrar},
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        dataType: 'json',
        success: function(data) {
            $('#btn_close_borrar').click();
            $('#fila_'+id_borrar).remove();
        }
    });

}


function ver_mv() {
    $('#id_indic_mv').val(mv_elegido);

    $('#btn_guardar_mv').prop('disabled', false);
    $('#btn_guardar_mv').html('<i class="bx bx-check"></i> Guardar');
}




$('#estado_doc').change(function(){
    evaluar_mv('DOCUMENTAL');
});
 

function evaluar_mv(tipo){
    //if(tipo=='BASE'){ var eval_estado=$('#estado_mv').val(); }
    if(tipo=='DOCUMENTAL'){ var eval_estado=$('#estado_doc').val(); }
    
    $.ajax({
        url: "{{ route('lic19_evalua_mv') }}",
        data: {id_mv:mv_elegido,estado:eval_estado,tipo:tipo},
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            arr_evals=data.dt_eval;
            toastr.success('Actualizado.');
        }
    }); 

}







</script>



@endsection


