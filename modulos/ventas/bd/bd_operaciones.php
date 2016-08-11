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
			$nombresP = explode(" ", $row[13]);
	    $paciente = $nombresP[0].' '.$row[14].' '.$row[15];
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
	// CARGAR TABLA CITAS
	if($opc == 'CT_CIT_01'){
		$anio = $_POST['anio'];
		$mes = $_POST['mes'];
		$estadoCita = $_POST['estadoCita'];
		$estadoPago = $_POST['estadoPago'];
		$medicoID = $_POST['medicoID'];

		$consulta = "SELECT C.citaID,P.nombres,P.apPaterno,P.apMaterno,PA.pacienteID,
												E.especialidad,S.servicio,C.fecha,C.hora,PP.nombres,
												PP.apPaterno,PP.apMaterno,C.estado,PS.estadoPago,PS.pedidoServicioID,PA.DNI,
												PS.tipo,C.precio*C.cantidad
									FROM CITA C
									INNER JOIN PEDIDO_SERVICIO PS ON C.pedidoServicioID = PS.pedidoServicioID
									INNER JOIN PACIENTE PA ON PA.pacienteID = C.pacienteID
									INNER JOIN PERSONA P ON P.DNI = PA.DNI
									LEFT 	JOIN ESPECIALIDAD E ON E.especialidadID = C.especialidadID
									INNER JOIN SERVICIO S ON S.servicioID = C.servicioID
									LEFT 	JOIN PERSONAL PE ON PE.personalID = C.medicoID
									LEFT 	JOIN PERSONA PP ON PP.DNI = PE.DNI
									where MONTH(PS.timestamp) = '".$mes."' and YEAR(PS.timestamp) = '".$anio."'
									";

		if($estadoCita != '0' ) $consulta = $consulta." and C.estado='".$estadoCita."'";
		if($medicoID != '0' ) $consulta = $consulta." and C.medicoID='".$medicoID."'";


		$res = mysqli_query($con,$consulta) or die(mysqli_error($con));
		$cont = 1;
		while($row = mysqli_fetch_row($res)){
			$nombresP = explode(" ", $row[1]); $nombresM = explode(" ", $row[9]);
			$nombrePaciente = $nombresP[0].' '.$row[2].' '.$row[3];
			$especialidad = $row[5];
			$nombreMedico = $nombresM[0].' '.$row[10];
			$DNI = $row[15];
			$fecha = $row[7];
			$tipoCita = $row[16];
			if($tipoCita == "C") $tipoCita = "Consulta";
			if($tipoCita == "L"){ 
				$tipoCita = "Laboratorio";
				$nombreMedico = $nombresM[0].' '.$row[10];
			}
			
			$fecha = str_replace("/","-",$fecha);
	    $fecha = date('d-m-Y',strtotime($fecha));
	    $pedidoID = $row[14];
	    
			$citaID = $row[0];			
			$estadoCita = $row[12];
			$estadoPago = $row[13];
			$servicio = $row[6];
			$importe = number_format($row[17],2);


			if($estadoCita == 'R') $lineaCita = "<span class='label label-warning'>Reservado</span>";
				else if($estadoCita == 'C') $lineaCita = "<span class='label label-info'>Confirmado</span>";
				else if($estadoCita == 'S') $lineaCita = "<span class='label label-primary'>En Sala</span>";
				else if($estadoCita == 'A') $lineaCita = "<span class='label label-success'>Atendido</span>";
				else if($estadoCita == 'X') $lineaCita = "<span class='label label-danger'>Anulado</span>";
			if($estadoPago == 'PEN') $lineaPago = "<span class='label label-danger'>Pendiente</span>";
				else if($estadoPago == 'PAG') $lineaPago = "<span class='label label-success'>Pagado</span>";
				else if($estadoPago == 'PAR') $lineaPago = "<span class='label label-warning'>Parcial</span>";

			echo "<tr>
							<td style='text-align:center;'>".$cont++."</td>
							<td style='text-align:center;'>".$pedidoID."</td>
							<td style='text-align:center;'>".$fecha."</td>
							<td>".$nombrePaciente."</td>
							<td style='text-align:center;'>".$tipoCita."</td>
							<td style='text-align:center;'>".$especialidad."</td>
							<td>".$servicio."</td>
							<td>".$nombreMedico."</td>
							<td style='text-align:right;'>".$importe."</td>
							<td style='text-align:center;'>".$lineaCita."</td>							
						</tr>";
		}
		exit();
	}
	//CARGAR TABLA DE REFERENCIAS
	if($opc == 'CTR_01'){
		$mes = $_POST['mes'];
		$personalID = $_POST['personalID'];
	  $especialidadID = $_POST['especialidadID'];
	  
		$consulta = "select PS.pedidoServicioID,P.nombres,P.apPaterno,P.apMaterno,E.especialidad,S.servicio,
									substring_index(PS.timestamp,' ',1) as 'fecha',PS.estadoPago,C.estado
								from PEDIDO_SERVICIO PS
								inner join PERSONAL PL ON PS.personalReferenciaID = PL.personalID
								inner join PERSONA P ON P.DNI = PL.DNI
								inner join CITA C ON C.pedidoServicioID = PS.pedidoServicioID
								left join ESPECIALIDAD E on E.especialidadID = C.especialidadID
								inner join SERVICIO S on S.servicioID = C.servicioID
								where MONTH(PS.timestamp) = '".$mes."'";
		if($personalID != 0)$consulta = $consulta." and PL.personalID = '".$personalID."'";
		if($especialidadID != -1 )$consulta = $consulta." and C.especialidadID = '".$especialidadID."'";
				
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con));
		$numReferencias = mysqli_num_rows($res);
		while($row = mysqli_fetch_row($res)){
			$pedidoID = $row[0];
			$nombresM = explode(" ", $row[1]);
			$medico = $nombresM[0].' '.$row[2].' '.$row[3];
			$especialidad = $row[4];
			$servicio = $row[5];			
			$fecha = str_replace("/","-",$row[6]);
	    $fecha = date('d-m-Y',strtotime($fecha));			
			$estadoPago = $row[7];
			$estadoCita = $row[8];
			

			if($estadoCita=='R') $estadoCita = "<span class='label label-warning'>Reservado</span>";
			else if($estadoCita=='C')	$estadoCita = "<span class='label label-info'>Confirmado</span>";
			else if($estadoCita=='S')	$estadoCita = "<span class='label label-primary'>En Sala</span>";
			else if($estadoCita=='A')	$estadoCita = "<span class='label label-success'>Atendido</span>";
			else if($estadoCita=='X') $estadoCita = "<span class='label label-danger'>Anulado</span>";

			if($estadoPago=='PEN') $estadoPago = "<span class='label label-danger'>Pendiente</span>";
			else if($estadoPago=='PAG')	$estadoPago = "<span class='label label-success'>Pagado</span>";
			else if($estadoPago == 'PAR')	$estadoPago = "<span class='label label-warning'>Parcial</span>";

			echo "<tr>
							<td style='text-align:center;'>".$pedidoID."</td>
							<td>".$medico."</td>
							<td>".$servicio."</td>
							<td>".$especialidad."</td>
							<td>".$fecha."</td>
							<td style='text-align:center;'>".$estadoCita."</td>
							<td style='text-align:center;'>".$estadoPago."</td>
						</tr>";
		}
		exit();
	}
 ?>
