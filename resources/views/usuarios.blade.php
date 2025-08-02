@inject('funciones','App\Http\Controllers\FuncionesController')


@extends('layouts.header')

@section('contenido')



<div id="mdl_usuario" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mt-0" id="myLargeModalLabel">Usuarios</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('guardar_usuario') }}" method="POST" enctype="multipart/form-data" id="frm_user">
                @csrf
                <input type="hidden" id="id_registro" name="id_registro">


                <div class="row justify-content-center mb-3">
                    <div class="col-md-2">
                        <label for="" class="form-label">Tipo usuario:</label>
                    </div>
                    <div class="col-md-5">
                        <select class="form-control" name="tipo" id="tipo" required>
                            <option value="">- - Seleccione - -</option>
                            <option value="3">OFICINAS</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>

                

                <div class="row justify-content-center mb-3">
                    <div class="col-md-2">
                        <label for="" class="form-label">Oficina:</label>
                    </div>
                    <div class="col-md-9">
                        <select class="form-control select2" name="oficina" id="oficina" required>
                            <option value="">- - Seleccione </option>
                            @foreach($dt_oficina as $ofi)
                                <option value="{{ $ofi->id }}">{{ $ofi->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="row justify-content-center mb-3">
                    <div class="col-md-2">
                        <label for="" class="form-label">Nombres y apellidos:</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" required id="nombre" name="nombre" placeholder="Nombres y Apellidos" onkeyup="mayus(this);">
                    </div>
                </div>

                <div class="row justify-content-center mb-3">
                    <div class="col-md-2">
                        <label for="" class="form-label">Correo:</label>
                    </div>
                    <div class="col-md-7">
                        <input type="email" class="form-control" required id="correo" name="correo" placeholder="Correo institucional" onkeyup="minus(this);">
                    </div>
                    <div class="col-md-2"></div>
                </div>


                <div class="row justify-content-center mb-3">
                    <div class="col-md-2">
                        <label for="" class="form-label">Contraseña:</label>
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="clave" name="clave" placeholder="Contraseña" autocomplete="off">
                    </div>
                    <div class="col-md-4"></div>
                </div>


                <div class="row justify-content-center mb-3" >
                    <div class="col-md-2">
                        <label for="" class="form-label">Estado:</label>
                    </div>
                    <div class="col-md-5">
                        <select class="form-control" name="estado" id="estado" required>
                            <option value="">- - Seleccione</option>
                            <option value=1>ACTIVO</option>
                            <option value="0">DESACTIVO</option>
                        </select>
                    </div>
                    <div class="col-md-4"></div>
                </div>


                <div class="row justify-content-center mb-3">
                    <div class="col-md-2">
                        <label for="" class="form-label">Etiqueta / Tag:</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" id="etiqueta" name="etiqueta" autocomplete="off">
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row justify-content-center mb-3">
                    <div class="col-lg-11">
                        <div class="d-flex" style="justify-content: right;">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal" style="margin-right: 10px;">
                                <i class="bx bx-x"></i> Cerrar
                            </button>

                            <button class="btn btn-primary" type="submit" id="btn_guardar">
                                <i class="bx bx-check"></i> Guardar
                            </button>
                        </div>                        
                    </div>
                </div>

            </form>                                                            
        </div>
    </div>
</div>
</div>




<div class="modal fade" id="mdl_permisos" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Permisos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                    
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-8">
                        <div style="width: 100%;" id="div_permisos">
                            
                        </div>
                    </div>
                </div>

                <br>

                <div class="row justify-content-center mb-3">
                    <div class="col-lg-11">
                        <div class="d-flex" style="justify-content: right;">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal" style="margin-right: 10px;">
                                <i class="bx bx-x"></i> Cerrar
                            </button>
                        </div>                        
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>




    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> 
                    <div class="d-flex" style="align-items: center;">
                        <div style="width: 50%;"> <h5><i class="bx bx-user text-info"></i> Usuarios</h5> </div>
                        <div style="width: 50%;text-align: right;">
                            <button type="button" class="btn btn-success btn-sm btn-rounded" data-toggle="modal" data-target="#mdl_usuario" onclick="nuevo()">
                                <i class="fas fa-plus"></i> Nuevo usuario
                            </button>
                        </div>
                    </div>


                </div>
                <div class="card-body">
                	<div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead style="background-color: #059adb;color: #fff;">
                                <th>Opciones</th>
                                
                            	<th>Nombre</th>
                                <th>Correo</th>
                                <th>Órgano / Unidad orgánica</th>
                                <th>Clave</th>
                                <th>Estado</th>
                            </thead>
                            <tbody>
                                @foreach($datos as $row)

                                @if($row->id_oficina>0)
                                    <?php $nom_car=$funciones->nom_responsable($row->id_oficina);; ?>
                                @else
                                    <?php $nom_car=''; ?>
                                @endif

                                <tr>
                                    <td>
                                        <button class="btn btn-warning btn-sm" type="button" title="Editar" data-toggle="modal" data-target="#mdl_usuario" onclick="editar({{ $row->id }},'{{ $row->name }}','{{ $row->email }}',{{ $row->rol }},{{ $row->id_oficina }},{{ $row->estado }})">
                                            <i class=" ri-pencil-line"></i>
                                        </button>

                                        <button class="btn btn-info btn-sm" type="button" title="Permisos" data-toggle="modal" data-target="#mdl_permisos" onclick="permisos({{ $row->id }})">
                                            <i class=" ri-user-settings-line"></i>
                                        </button>
                                        <input type="hidden" id="etiqueta_{{ $row->id }}" value="{{ $row->etiqueta }}">
                                    </td> 
                                  
                                    <td>
                                        {{ $row->name }} 
                                    </td>
                                    <td>{{ $row->email }}</td>
                                    <td>
                                        {{ $nom_car }}
                                        @if($row->etiqueta!='')
                                        <br> <span style="background-color: #D2EBFB;color: #1075CB;padding-left: 7px;padding-right: 7px;border-radius: 5px;">{{ $row->etiqueta }}</span> 
                                        @endif
                                    </td>
                                    <td>
                                        <?php 
                                            $txt_clave=$funciones->llave_usuario($row->key_usu);
                                        ?>

                                        @if($txt_clave!='')
                                        <div class="d-flex">
                                            <div>
                                                <button type="button" class="btn btn-light btn-sm text-primary radius-30 px-2" id="btn_ver_{{ $row->id }}" onclick="ver_clave({{ $row->id }})">
                                                    <i class="ri-eye-off-line"></i>
                                                </button>
                                            </div>
                                            <div>
                                                <input type="password" class="form-control form-control-sm" readonly value="{{ $txt_clave }}" id="txt_clave_{{ $row->id }}" style="width: 100px;">
                                            </div>
                                        </div>
                                        @endif
                                        
                                    </td>
                                    <td>
                                        @if($row->estado==0) 
                                            <span class="badge badge-pill badge-danger">Desactivo</span> 
                                        @else
                                            <span class="badge badge-pill badge-success">Activo</span>
                                        @endif
                                    </td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                	</div>

                </div>
            </div>
        </div>
    </div>



<script>
	
function nuevo() {
    $('#id_registro').val('')
    $('#nombre').val('')
    $('#correo').val('')
    $('#tipo').val('')
    $('#oficina').val('').trigger('change');
    $('#tipo').prop('required',true)
    $('#estado').val('')
}


function editar(id,nom,correo,tipo,id_ofi,estado) {
    $('#id_registro').val(id)
    $('#nombre').val(nom)
    $('#correo').val(correo)
    if (id!=1) {
        $('#tipo').val(tipo);
        $('#tipo').prop('required',true)
    }else{
        $('#tipo').val('');
        $('#tipo').prop('required',false)
    }

    var v_ofi=id_ofi!=0 ? id_ofi : '';
    $('#oficina').val(v_ofi).trigger('change');
    $('#estado').val(estado);

    $('#etiqueta').val($('#etiqueta_'+id).val());
}


$('#tipo').change(function() {
    var tipo_v=$('#tipo').val();
});




$(document).ready(function() {
    $('#example').DataTable();


  } );


function permisos(id_user) {
    $.ajax({
        url:"{{ route('ajax.lst_permisos') }}",
        data:{id_usuario:id_user},
        method:'GET',
        dataType:'json',
        success:function(data){
            $('#div_permisos').html(data.datos)
        }
    });
}


function cambiar(id_modulo,id_user) {
    var cbx_mod=$('#modu_'+id_modulo).prop('checked');
    var val_per=cbx_mod==true ? 1 : 0;
    $.ajax({
        url:"{{ route('ajax.asig_permiso') }}",
        data:{id_modulo:id_modulo,id_usuario:id_user,val_per:val_per},
        method:'GET',
        dataType:'json',
        success:function(data){
            //console.log(data)
        }
    });
}

function mayus(e) {
    e.value = e.value.toUpperCase();
}

function minus(e) {
    e.value = e.value.toLowerCase();
}
        
        
$('#frm_user').submit(function () {
    $('#btn_guardar').attr('disabled',true)
    $('#btn_guardar').text('Guardando...')
})






function ver_clave(id_user) {
    const input = $('#txt_clave_' + id_user);
    const btn = $('#btn_ver_' + id_user);
    
    if (input.attr('type') === 'password') {
        input.attr('type', 'text');
        btn.html('<i class="ri-eye-line"></i>');
    } else {
        input.attr('type', 'password');
        btn.html('<i class="ri-eye-off-line"></i>');
    }
}








</script>

@endsection


