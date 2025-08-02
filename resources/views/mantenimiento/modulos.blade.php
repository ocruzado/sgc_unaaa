@inject('funciones','App\Http\Controllers\FuncionesController')

@extends('layouts.header')
@section('contenido')



<div class="container">


<div class="modal fade" id="mdl_datos"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Módulos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('guardar_modulo') }}" method="POST" enctype="multipart/form-data">
                @csrf

            <div class="modal-body">
                <input type="hidden" id="id_registro" name="id_registro">
                <input type="hidden" id="aux_vivel" name="aux_vivel">
                <input type="hidden" id="id_padre" name="id_padre">



                <div class="row justify-content-center mb-3">
                    <div class="col-md-2">
                        <label for="" class="form-label">Nombre</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" required id="nombre" name="nombre" placeholder="Nombre" >
                    </div>
                </div>


                <div class="row justify-content-center mb-3" id="div_submenu" style="display: none;">
                    <div class="col-md-2">
                        <label for="" class="form-label">Con submenús?</label>
                    </div>
                    <div class="col-md-5">
                        <select class="form-control" name="submenu" id="submenu" >
                            <option value="">- - Seleccione - -</option>
                            <option value=1>SI</option>
                            <option value="0">NO</option>
                        </select>
                    </div>
                    <div class="col-md-4"></div>
                </div>


                <div class="row justify-content-center mb-3">
                    <div class="col-lg-11">
                        <div class="d-flex" style="justify-content: right;">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal" style="margin-right: 10px;">
                                <i class="bx bx-x"></i> Cerrar
                            </button>

                            <button class="btn btn-primary" type="submit">
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
        <div class="col-lg-12">
            
            <div class="card">
                <div class="card-body">
                   <h5> Listado de módulos del sistema  </h5>		
                </div>
            </div>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                	<div class="d-flex mb-3" style="justify-content: right;width: 100%;">
                		<button class="btn btn-success btn-rounded btn-sm" type="button" data-toggle="modal" data-target="#mdl_datos" onclick="nuevo('01',0)">
                			<i class="fas fa-plus"></i> Agregar
                		</button>
                	</div>

                	<div id="accordion" class="custom-accordion">
                	<table class="table">
                	@foreach($datos as $dato)
                	<tr>
                		<td>
                		<div class="d-flex" style="width: 100%;">
                			<div style="width: 80%;">
                				@if($dato->nivel==0)
                					<span>{{ $dato->nombre }}</span>
                				@endif

                				@if($dato->nivel==1)
                                    <div class="card mb-1 shadow-none">
                                        <a href="#collapse_{{ $dato->id }}" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapse_{{ $dato->id }}">
                                            <div class="card-header" id="headingTwo">
                                                <h6 class="m-0">
                                                    {{ $dato->nombre }}
                                                    <i class="mdi mdi-minus float-right accor-plus-icon"></i>
                                                </h6>
                                            </div>
                                        </a>
                                        <div id="collapse_{{ $dato->id }}" class="collapse" aria-labelledby="headingTwo"
                                                data-parent="#accordion">
                                            <div class="card-body">
                                                <table class="table">
                                                    @foreach($funciones->submenus($dato->id) as $sub)
                                                        <tr>
                                                            <td>{{ $sub->nombre }}</td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                				@endif
                			</div>
                			<div style="width: 20%;margin-left: 10px;">
                				@if($dato->nivel==1)
		                		<button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#mdl_datos" onclick="nuevo('02',{{ $dato->id }})">
		                			<i class="fas fa-plus"></i> 
		                		</button>
		                		@endif
                			</div>
                		</div>
                		</td>
                	</tr>
                	@endforeach
                	</table>

       

                </div>



                </div>
            </div>
        </div>
    </div>
</div>


<script>

	function nuevo(nivel,padre) {
		$('#id_registro').val('')
		if (nivel=='01') {
			$('#div_submenu').show();
			$('#submenu').prop('required',true)
		}else{
			$('#div_submenu').hide();
			$('#submenu').prop('required',false)
		}
		$('#aux_vivel').val(nivel)
		$('#id_padre').val(padre)
	}

</script>

@endsection
