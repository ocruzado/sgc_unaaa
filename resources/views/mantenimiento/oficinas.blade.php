
@extends('layouts.header')

@section('contenido')
<div class="container">



<div class="modal fade" id="mdl_datos"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Oficinas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('guardar_oficina') }}" method="POST" enctype="multipart/form-data" id="frm_user">
                @csrf

            <div class="modal-body">
                <input type="hidden" id="id_registro" name="id_registro">


                <div class="row justify-content-center mb-3">
                    <div class="col-md-2">
                        <label for="" class="form-label">Nombre:</label>
                    </div>
                    <div class="col-md-9">
                        <textarea class="form-control" required id="nombre" name="nombre" placeholder="Nombre dependencia" onkeyup="mayus(this);" rows="2"></textarea>
                    </div>
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

            </div>
            </form>
        </div>
    </div>
</div>




    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body"> 
                    <div class="d-flex" style="align-items: center;">
                        <div style="width: 50%;">
                            <h5><i class="bx bx-buildings text-primary"></i> ÓGANOS / UNIDADES ORGÁNICAS </h5>
                        </div>
                        <div style="width: 50%;text-align: right;">
                            <button type="button" class="btn btn-success btn-rounded" data-toggle="modal" data-target="#mdl_datos" onclick="nuevo()">
                                <i class="fas fa-plus"></i> Agregar
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead style="background-color: #059adb;color: #fff;">
                                <th>Nombre</th>
                                <th>Opciones</th>
                            </thead>
                            <tbody>
                                @foreach($dt_datos as $row)
                                <tr> 
                                    <td>
                                        {{ $row->nombre }}
                                    </td>
                                    <td>
                                        <input type="hidden" id="nom_depen_{{ $row->id }}" value="{{ $row->nombre }}">
                                        <button class="btn btn-warning btn-sm" type="button" title="Editar" data-toggle="modal" data-target="#mdl_datos" onclick="editar({{ $row->id }})">
                                            <i class=" ri-pencil-fill"></i>
                                        </button>
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



</div>

<script>
    




$(document).ready(function() {
    $('#example').DataTable();
  } );


function nuevo(){
    $('#id_registro').val('');
    $('#nombre').val('');
}


function mayus(e) {
    e.value = e.value.toUpperCase();
}


function editar(id_depen){
    var nom_ofi=$('#nom_depen_'+id_depen).val();
    $('#nombre').val(nom_ofi);
    $('#id_registro').val(id_depen);
}


</script>

@endsection


