<?php include '../../general/variables.php';?>
<?php
	require('../../bd/bd_conexion.php');
	$opc = $_POST['opc'];
	// CARGAR TABLA  PEDIDOS PENDIENTES
	if($opc == 'CT_PED_01'){
		$anio = $_POST['anio'];
		$mes = $_POST['mes'];
		$estado = $_POST['estado'];
		$tipo = $_POST['tipo'];
		
		$consulta = "SELECT PS.pedidoServicioID,PS.pacienteID,PS.tipo,PS.via,PS.tasaIGV,PS.importeSinIGV,PS.importeIGV,
											PS.importeTotal,PS.importePagado,FP.formaPago,PS.estadoPago,substring_index(PS.timestamp,' ',1) as 'fecha',
											PE.DNI,PE.nombres,PE.apPaterno,PE.apMaterno,PE.telefono1
								from PEDIDO_SERVICIO PS
								inner join PACIENTE PA ON PS.pacienteID = PA.pacienteID
								inner join PERSONA PE ON PE.DNI = PA.DNI
								left join FORMA_PAGO FP ON FP.formaPagoID = PS.formaPagoID
								where MONTH(PS.timestamp) = '".$mes."' and YEAR(PS.timestamp) = '".$anio."'
								";
		if($estado != '0' ) $consulta = $consulta." and PS.estadoPago='".$estado."'";
		if($tipo != '0' ) $consulta = $consulta." and PS.tipo='".$tipo."'";
		
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
		$cont = 1;
		while($row = mysqli_fetch_row($res)){
			$pedidoID = $row[0];
			$fecha = str_replace("/","-",$row[11]);
	    $fecha = date('d-m-Y',strtotime($fecha));
	    $paciente = $row[13].' '.$row[14].' '.$row[15];
	    $telefono = $row[16];
	    $tipo = $row[2];
	    $via = $row[3];
	    $IGV = $row[4];
	    $importeSinIGV = $row[5];
	    $importeIGV = $row[6];
			$importeTotal = $row[7];
			$importePagado = $row[8];
			$formaPago = $row[9];
			$estadoPago = $row[10];
			if($formaPago == '')$formaPago = "NO FACTURADO";
			// Via
			if($via == 'P') $via = 'Personal';
			else if($via == 'T') $via = 'Teléfono';
			else if($via == 'W') $via = 'Web';
			else if($via == 'F') $via = 'Facebook';
			// Tipo
			if($tipo == 'C') $tipo = 'Consultorio';
			else if($tipo == 'L') $tipo = 'Laboraroio';
			// Estado  de pago
			if($estadoPago == 'PEN') $estadoPago = "<span class='label label-danger'>Pendiente</span>";			
			else if($estadoPago == 'PAR')	$estadoPago = "<span class='label label-warning'>Parcial</span>";
			else if($estadoPago == 'PAG')	$estadoPago = "<span class='label label-success'>Pagado</span>";
			echo "
						<tr>
							<td style='text-align:center;'>".$cont++."</td>
							<td style='text-align:center;'>".$pedidoID."</td>
							<td style='text-align:center;'>".$fecha."</td>
							<td>".$paciente."</td>
							<td style='text-align:center;'>".$tipo."</td>
							<td style='text-align:right; padding-right:10px!important;'>".$IGV."</td>
							<td style='text-align:right; padding-right:10px!important;'>".$importeSinIGV."</td>
							<td style='text-align:right; padding-right:10px!important;'>".$importeIGV."</td>
							<td style='text-align:right; padding-right:10px!important;'>".$importeTotal."</td>
							<td style='text-align:right; padding-right:10px!important;'>".$importePagado."</td>
							<td style='text-align:center;'>".$formaPago."</td>
							<td style='text-align:center;'>".$estadoPago."</td>
						</tr>
				";
		}
		exit();
	}
 ?>