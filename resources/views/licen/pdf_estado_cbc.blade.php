@inject('cls_funciones','App\Http\Controllers\FuncionesController')
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reporte - Estado de los MV de las CBC </title>

	<style type="text/css">
	    body {
	      font-family: 'Arial Narrow', sans-serif;
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
				<p style="margin-bottom:5px;">UNIVERSIDAD NACIONAL AUTÓNOMA DE ALTO AMAZONAS
</p>
				<p style="">
					<b> Reporte del estado de los MV de las CBC </b>
				</p>
			</td>
			<td style="width:15%;">
				<div style="">
					<p style="margin: 0px;font-size: 16pt;color: #78b8e5;font-weight: bold;">2025</p>
				</div>
			</td>
		</tr>
	</table>

	<?php 
		$contador=1;


		$count_sm=0;
		$count_pm=0;
		$count_nm=0;
		$count_sin=0;

	?>

	@foreach($dt_condiciones as $condic)
	<table style="width: 100%;font-size: 9pt;margin-bottom: 0px;">
		<tr style="background-color: #059adb;padding: 10px;">
			<td style="border-bottom: 0px solid #78b8e5;padding: 10px;border-radius: 7px 7px 0px 0px;"><b>{{ $condic->nom_condicion }}</b>. <small style="text-transform: uppercase;">{{ $condic->descrip }}</small> </td>
		</tr>
	</table>

	@foreach($dt_componente->where('id_condicion',$condic->id) as $compo)
	<div style="margin-left: 10px;margin-top: 0px;">
		<table style="width: 100%;font-size: 9pt;">
			<tr style="background-color: #57bb6b;padding: 10px;">
				<td style="border-bottom: 0px solid #78b8e5;padding: 10px;"><b>Componente: {{ $compo->cod_componente }}</b>. {{ $compo->nom_componente }}</td>
			</tr>
		</table>


		<table style="width: 100%;border-top: 1px solid #78b8e5;border-right: 1px solid #78b8e5;border-left: 1px solid #78b8e5;border-radius: 0px 0px 7px 7px;font-size: 9pt;">
			<tr style="background-color: #a8cf45;padding: 10px;">
				<td style="text-align: center;border-bottom: 1px solid #78b8e5;padding: 5px;border-right: 1px solid #78b8e5;"><b>#</b></td>
				<td style="text-align: center;border-bottom: 1px solid #78b8e5;padding: 5px;border-right: 1px solid #78b8e5;"><b>Indicador</b></td>
				<td style="text-align: center;border-bottom: 1px solid #78b8e5;padding: 5px;border-right: 1px solid #78b8e5;"><b>MV</b></td>
				<td style="border-bottom: 1px solid #78b8e5;padding: 5px;border-right: 1px solid #78b8e5;"><b>Responsable</b></td>
				<td style="text-align: center;border-bottom: 1px solid #78b8e5;padding: 5px;"><b>Estado</b></td>
			</tr>

			@foreach($dt_indicadores->where('id_componente',$compo->id) as $indic)
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
				?>
		        <tr>
		        	<td style="border-bottom: 1px solid #78b8e5;border-right: 1px solid #78b8e5;padding: 5px;width: 30px;">{{ $contador }}</td>
		        	<td style="border-bottom: 1px solid #78b8e5;border-right: 1px solid #78b8e5;padding: 5px;width: 70px;">{{ $indic->nom_indicador }}</td>
		        	<td style="border-bottom: 1px solid #78b8e5;border-right: 1px solid #78b8e5;padding: 5px;width: 60px;text-align: center;">{{ $mv->sigla_mv }}</td>
		        	<td style="border-bottom: 1px solid #78b8e5;border-right: 1px solid #78b8e5;padding: 5px;">
		        		{{ $cls_funciones->nom_responsable($mv->id_responsable) }}
		        	</td>
		        	<td style="border-bottom: 1px solid #78b8e5;padding: 5px;width: 50px;text-align: center;">
		        		<span style="color: {{ $color_mv }};"> <b>{{ $txt_estado_mv }}</b> </span>
		        	</td>
		        </tr>
		        <?php $contador++; ?>
		        @endforeach
			@endforeach
		</table>
		<br>

	</div>

	@endforeach



	<br>
	@endforeach


	<br><br><br><br>
	<table style="width: 50%;font-size: 11pt;border: 1px solid #57bb6b;border-radius: 7px;">
		<tr style="background-color: #57bb6b;padding: 10px;">
			<td colspan="2" style="border-radius: 7px 7px 0px 0px;text-align: center;padding: 5px;">
				<span><b>RESUMEN:</b></span>
			</td>
		</tr>

		<tr>
			<td style="border-bottom: 1px solid #DEE1E2;border-right: 1px solid #DEE1E2;padding: 5px;">
				<span style="color: #1087D3;">F: SIN REGISTROS</span> 
			</td>
			<td style="border-bottom: 1px solid #DEE1E2;border-right: 1px solid #DEE1E2;padding: 5px;text-align: center;">
				{{ $count_sin }}
			</td>
		</tr>

		<tr>
			<td style="border-bottom: 1px solid #DEE1E2;border-right: 1px solid #DEE1E2;padding: 5px;">
				<span style="color: #FC2E13;">NO CUMPLIDO</span> 
			</td>
			<td style="border-bottom: 1px solid #DEE1E2;border-right: 1px solid #DEE1E2;padding: 5px;text-align: center;">
				{{ $count_nm }}
			</td>
		</tr>
		<tr>
			<td style="border-bottom: 1px solid #DEE1E2;border-right: 1px solid #DEE1E2;padding: 5px;">
				<span style="color: #FBAD15;"> EN PROCESO </span> 
			</td>
			<td style="border-bottom: 1px solid #DEE1E2;border-right: 1px solid #DEE1E2;padding: 5px;text-align: center;">
				{{ $count_pm }}
			</td>
		</tr>
		<tr>
			<td style="border-bottom: 1px solid #DEE1E2;border-right: 1px solid #DEE1E2;padding: 5px;">
				<span style="color: #09B77C;">CUMPLIDO</span>  
			</td>
			<td style="border-bottom: 1px solid #DEE1E2;border-right: 1px solid #DEE1E2;padding: 5px;text-align: center;">
				{{ $count_sm }}
			</td>
		</tr>
		<tr>
			<td style="border-bottom: 1px solid #DEE1E2;border-right: 1px solid #DEE1E2;padding: 5px;text-align: right;">
				<b>TOTAL</b>
			</td>
			<td style="border-bottom: 1px solid #DEE1E2;border-right: 1px solid #DEE1E2;padding: 5px;text-align: center;">
				<b>{{  $count_sin + $count_nm + $count_pm + $count_sm }}</b>
			</td>
		</tr>
	</table>


 
	<br>
	<p style="font-size: 11pt;color: #818181;">	
		<i>Documento generado el {{ date('d/m/Y H:i:s') }}. </i>
	</p>





</body>
</html>
