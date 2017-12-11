<?php
use Dompdf\Dompdf;

$html.='
<html lang="es">
<head>
	<title>Envasado | Reporte</title>
	<link rel="stylesheet" href="'.URL.'Vistas/template/css/bootstrap.min.css">
</head>
<body>
	<center>
		<h4 class="titulo">Reporte de Producción de '.$datos["nombre_linea"].'</h4>
	  <h5>Producción desde '.$datos["fecha_hora_inicio"].' hasta ';
	   if (!$datos['fecha_hora_fin']){
	     $html.=date('Y-m-d H:m:i').' (No Culminada)';
	   } else {
	     $html.=$datos['fecha_hora_fin'].' (Culminada)';
	   }
$html.='
		</h5>
	</center>
	<h4><u>Contadores:</u></h4>
	<table class="table table-bordered">
	 <thead>
	   <tr>
	     <th>Botellas llenas</th>
	     <th>Botellas Vacias</th>
	     <th>Cajas llenas</th>
	     <th>Cajas Vacias</th>
	   </tr>
	 </thead>
	 <tbody>
	 <tr>
	   <td>'.$datos[4]["botellas_llenas"].'</td>
	   <td>'.$datos[4]["botellas_vacias"].'</td>
	   <td>'.$datos[4]["cajas_llenas"].'</td>
	   <td>'.$datos[4]["cajas_vacias"].'</td>
	 </tr>
	 </tbody>
	 <thead>
	   <tr>
	     <th>Camadas Usadas</th>
	     <th>Paradas de Emergencia</th>
	     <th colspan="2">Estimación Total</th>
	   </tr>
	 </thead>
	 <tbody>
	   <tr>
	     <td>'.$datos[4]["bulks_usados"].'</td>
	     <td>'.$datos[4]["parada_emergencia"].'</td>
	     <td colspan="2">'.$datos[5]["estimacion"].'</td>
	   </tr>
	 </tbody>
	</table>

	<h4><u>Supervisor:</u></h4>
	<table class="table table-bordered">
	 <thead>
	   <tr>
	     <th>C.I</th>
	     <th>Nombres</th>
	     <th>Apellidos</th>
	     <th>Jornada</th>
	   </tr>
	 </thead>
	 <tbody>
	 <tr>
	   <td>'.$datos["cedula"].'</td>
	   <td>'.$datos["nombres"].'</td>
	   <td>'.$datos["apellidos"].'</td>
	   <td>'.$datos["jornada"].'</td>
	 </tr>
	 </tbody>
	</table>

	<h4><u>Paleta:</u></h4>
	<table class="table table-bordered">
	 <thead>
	   <tr>
	     <th>Nombres</th>
	     <th>Botellas por Camada</th>
	     <th>Número de Camadas</th>
	   </tr>
	 </thead>
	 <tbody>
	 <tr>
	   <td>'.$datos["nombre_paleta"].'</td>
	   <td>'.$datos["bulk"].'</td>
	   <td>'.$datos["cantidad_bulks"].'</td>
	 </tr>
	 </tbody>
	</table>

	<h4><u>Botella:</u></h4>
	<table class="table table-bordered">
	 <thead>
	   <tr>
	     <th>Nombre</th>
	     <th>Distribución</th>
	     <th>Medida (ml)</th>
	     <th>Proveedor</th>
	   </tr>
	 </thead>
	 <tbody>
	 <tr>
	   <td>'.$datos[0]["nombre_botella"].'</td>
	   <td>'.$datos[0]["distribucion"].'</td>
	   <td>'.$datos[0]["tipo"].'</td>
	   <td>'.$datos[0]["nombre_proveedor"].'</td>
	 </tr>
	 </tbody>
	</table>

	<h4><u>Caja:</u></h4>
	<table class="table table-bordered">
	 <thead>
	   <tr>
	     <th>Nombre</th>
	     <th>Cantidad de Botellas</th>
	     <th>Medida (cm)</th>
	     <th>Proveedor</th>
	   </tr>
	 </thead>
	 <tbody>
	 <tr>
	   <td>'.$datos[1]["nombre_caja"].'</td>
	   <td>'.$datos[1]["cantidad_botellas"].'</td>
	   <td>'.$datos[1]["medida_caja"].'</td>
	   <td>'.$datos[1]["nombre_proveedor_caja"].'</td>
	 </tr>
	 </tbody>
	</table>

	<h4><u>Etiqueta:</u></h4>
	<table class="table table-bordered">
	 <thead>
	   <tr>
	     <th>Nombre</th>
	     <th>Medida (cm)</th>
	     <th>Proveedor</th>
	   </tr>
	 </thead>
	 <tbody>
	 <tr>
	   <td>'.$datos[2]["nombre_etiqueta"].'</td>
	   <td>'.$datos[2]["medida_etiqueta"].'</td>
	   <td>'.$datos[2]["nombre_proveedor_etiqueta"].'</td>
	 </tr>
	 </tbody>
	</table>
	<br><br><br><br>
	<h4><u>Tapa:</u></h4>
	<table class="table table-bordered">
	 <thead>
	   <tr>
	     <th>Nombre</th>
	     <th>Medida (cm)</th>
	     <th>Proveedor</th>
	   </tr>
	 </thead>
	 <tbody>
	 <tr>
	   <td>'.$datos[3]["nombre_tapa"].'</td>
	   <td>'.$datos[3]["medida_tapa"].'</td>
	   <td>'.$datos[3]["nombre_proveedor_tapa"].'</td>
	 </tr>
	 </tbody>
	</table>

	<h4><u>Personal:</u></h4>
	<table class="table table-bordered">
	 <thead>
		 <tr>
			 <th>C.I</th>
			 <th>Nombres</th>
			 <th>Apellidos</th>
			 <th>Estación</th>
		 </tr>
	 </thead>
	 <tbody>';
	 	while ($array=$datos[6]->fetch(\PDO::FETCH_ASSOC))
		{
			$html.='
			 <tr>
				 <td>'.$array["cedula"].'</td>
				 <td>'.$array["nombres"].'</td>
				 <td>'.$array["apellidos"].'</td>
				 <td>'.$array["nombre"].'</td>
			 </tr>';
		}
		$html.='
	 </tbody>
	</table>
</body>
</html>
';
$fecha=explode(' ', $datos["fecha_hora_inicio"]);
$time=str_replace(':', '-', $fecha[1]);
$fecha=$fecha[0].'_'.$time;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('produccion_'.$fecha.'.pdf',array('Attachment'=>0));
?>
