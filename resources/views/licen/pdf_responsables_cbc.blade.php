@inject('cls_funciones','App\Http\Controllers\FuncionesController')
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reporte - Responsables de las CBC </title>

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
				<p style="margin-bottom:5px;">UNIVERSIDAD NACIONAL AUTÓNOMA DE ALTO AMAZONAS</p>
				<p style="">
					<b> Listado de responsables por Indicador y Medios de Verificación  </b>
				</p>
			</td>
			<td style="width:15%;">
				<div style="">
					<p style="margin: 0px;font-size: 16pt;color: #78b8e5;font-weight: bold;"></p>
				</div>
			</td>
		</tr>
	</table>


	<?php 
		$contador=1;
		$tot_brechas=0;
		$tot_acciones=0;
		$tot_evidencias=0;
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
				<td style="text-align: center;border-bottom: 1px solid #78b8e5;padding: 5px;"><b>Responsable</b></td>
			</tr>

			@foreach($dt_indicadores->where('id_componente',$compo->id) as $indic)
				@foreach($dt_mv->where('id_indicador',$indic->id) as $mv)
		        <tr>
		        	<td style="border-bottom: 1px solid #78b8e5;border-right: 1px solid #78b8e5;padding: 5px;width: 30px;">{{ $contador }}</td>
		        	<td style="border-bottom: 1px solid #78b8e5;border-right: 1px solid #78b8e5;padding: 5px;width: 70px;">{{ $indic->nom_indicador }}</td>
		        	<td style="border-bottom: 1px solid #78b8e5;border-right: 1px solid #78b8e5;padding: 5px;width: 70px;">{{ $mv->sigla_mv }}</td>
		        	<td style="border-bottom: 1px solid #78b8e5;padding: 5px;">
		        		{{ $cls_funciones->nom_responsable($mv->id_responsable) }}
		        	</td>
		        </tr>
		        <?php $contador++; ?>
		        @endforeach
			@endforeach
		</table>
		<br>

	</div>

	@endforeach





	<br><br>
	@endforeach


    <br>



	<br>
	<p style="font-size: 11pt;color: #818181;">	
		<i>Documento generado el {{ date('d/m/Y H:i:s') }} </i>
	</p>



</body>
</html>
