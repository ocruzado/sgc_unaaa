@inject('cls_funciones','App\Http\Controllers\FuncionesController')
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reporte datallado de las CBC</title>

	<style type="text/css">
	    body {
	      font-family: 'Arial Narrow', sans-serif;
	    }

	    .tabla_cabe{
	    	text-align: center;border-bottom: 1px solid #78b8e5;padding: 5px;
	    }
	    .tabla_conte{
	    	border-bottom: 1px solid #78b8e5;border-right: 1px solid #78b8e5;padding: 5px;
	    }
	</style>

</head>
<body>
	
	<table style="width: 100%;margin-bottom: 5px;">
		<tr>
			<td style="width: 15%;">
				<img src="{{ asset('img/logo_unaaa.png') }}" alt="" style="width: 80px;">
			</td>
			<td style="width: 70%;text-align: left;color: #3c3d3d;">
				<p style="margin-bottom:5px;">UNIVERSIDAD NACIONAL AUTÓNOMA DE ALTO AMAZONAS </p>
				<p style="">
					<b> Reporte datallado del cumplimiento de las CBC </b>
				</p>
			</td>
			<td style="width:15%;">
				<div style="">
					<p style="margin: 0px;font-size: 16pt;color: #78b8e5;font-weight: bold;">2025</p>
				</div>
			</td>
		</tr>
	</table>

<br>

	<?php 
		$contador=1;


		$count_sm=0;
		$count_pm=0;
		$count_nm=0;
		$count_sin=0;

	?>

<table style="width: 100%;border-top: 1px solid #78b8e5;border-right: 1px solid #78b8e5;border-left: 1px solid #78b8e5;border-radius: 0px 0px 7px 7px;font-size: 9pt;">
	<tr style="background-color: #a8cf45;padding: 10px;">
		<td class="tabla_cabe" rowspan="2"><b>INDICADOR</b></td>
		<td class="tabla_cabe" rowspan="2"><b>DENOMINACIÓN</b></td>
		<td class="tabla_cabe" rowspan="2" colspan="2"><b>MEDIOS DE VERIFICACIÓN</b></td>
		<td class="tabla_cabe" rowspan="2"><b>RESPONSABLES</b></td>
		<td class="tabla_cabe" colspan="3"><b>ESCALA DE MEDICIÓN</b></td>
	</tr>
	<tr style="background-color: #a8cf45;padding: 10px;">

		<td class="tabla_cabe"><b>NO CUMPLIDO</b></td>
		<td class="tabla_cabe"><b>EN PROCESO</b></td>
		<td class="tabla_cabe"><b>CUMPLIDO</b></td>
	</tr>
	@foreach($dt_indicadores as $indic)
		<?php $incre_mv=0; ?>
		@foreach($dt_mv->where('id_indicador',$indic->id) as $mv)

				<?php 
					$estado_mv=$cls_funciones->lic19_estado_mv(2025,$mv->id,'DOCUMENTAL');

					$color_mv='#1087D3';
					if($estado_mv=='SIN'){ 
						$txt_estado_mv='F';
						$count_sin++; 
					}

					if($estado_mv=='NM'){ 
						$txt_estado_mv='NO CUMPLIDO';
						$color_mv='#FC2E13';
						$count_nm++;
					}

					if($estado_mv=='PM'){ 
						$txt_estado_mv='EN PROCESO';
						$color_mv='#FBAD15';
						$count_pm++;
					}

					if($estado_mv=='SM'){ 
						$txt_estado_mv='CUMPLIDO';
						$color_mv='#09B77C';
						$count_sm++;
					}

					$fondo_1='';
					if($txt_estado_mv=='NO CUMPLIDO'){ $fondo_1='background-color:#F69393;';}

					$fondo_2='';
					if($txt_estado_mv=='EN PROCESO'){ $fondo_2='background-color:#E8D180;';}

					$fondo_3='';
					if($txt_estado_mv=='CUMPLIDO'){ $fondo_3='background-color:#78D387;';}

					$tot_mvs=$dt_mv->where('id_indicador',$indic->id)->count();
				?>

	        <tr>
	        	@if($incre_mv==0)
	        	<td class="tabla_conte" rowspan="{{ $tot_mvs }}">{{ $indic->nom_indicador }} </td>
	        	<td class="tabla_conte" rowspan="{{ $tot_mvs }}">{{ $indic->descrip }}</td>
	        	@endif

	        	<td class="tabla_conte">{{ $mv->sigla_mv }}</td>
	        	<td class="tabla_conte">{{ $mv->nom_mv }}</td>
	        	<td class="tabla_conte">{{ $cls_funciones->nom_responsable($mv->id_responsable) }}</td>
	        	<td class="tabla_conte" style="{{ $fondo_1 }}"></td>
	        	<td class="tabla_conte" style="{{ $fondo_2 }}"></td>
	        	<td style="border-bottom: 1px solid #78b8e5;padding: 5px;{{ $fondo_3 }}"></td>
	        </tr>
	        <?php $incre_mv++; ?>
		@endforeach
	@endforeach
</table>
 
 

</body>
</html>
