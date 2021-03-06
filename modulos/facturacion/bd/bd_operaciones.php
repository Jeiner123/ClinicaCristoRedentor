<?php include '../../general/variables.php';?>
<?php
	require('../../bd/bd_conexion.php');
	$opc = $_POST['opc'];
	
	//ACTUALIZAR CAMPO para el pedido_servicio
	if($opc == 'ACT_P_S'){
		$pedidoID = $_POST['pedidoID'];
		$campo = $_POST['campo'];
		$nuevoValor = $_POST['nuevoValor'];

		$consulta = "UPDATE PEDIDO_SERVICIO SET ".$campo." = '".$nuevoValor."' 
								WHERE pedidoServicioID = '".$pedidoID."' ";
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
		if(!$res){
			echo "No se pudo modificar";
			exit();
		}
		echo 1;
		exit();
	}
	//SELECCIONAR DATOS PARA UN PEDIDO, traer datos generales del pedido
	if($opc == 'MP_01'){
		$DNI = $_POST["DNI"];
		$pedidoID = $_POST["pedidoID"];

		$consulta = "SELECT PE.DNI,PE.nombres,PE.apPaterno,PE.apMaterno,PE.telefono1,
								PS.importeSinIGV,PS.importeIGV,PS.importeTotal,PS.importePagado,
								PS.importeTotal-PS.importePagado,PS.formaPagoID								
								FROM PEDIDO_SERVICIO PS
								INNER JOIN PACIENTE PA ON PS.pacienteID = PA.pacienteID
								INNER JOIN PERSONA PE ON PE.personaID = PA.personaID
								WHERE PE.DNI = '".$DNI."' and PS.pedidoServicioID = '".$pedidoID."'
								";
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
		$datos = "";
		if(mysqli_num_rows($res)>0){
			$datos = mysqli_fetch_array($res);
			$nombres = $datos[1].' '.$datos[2].' '.$datos[3];

			echo $datos[0].",,".$nombres.",,".$datos[4].",,".
					$datos[5].",,".$datos[6].",,".$datos[7].",,".$datos[8].",,".
					$datos[9].",,".$datos[10];
		}else{
			echo 0;
		}
		exit();
	}
	// TRAER LOS PAGOS DE UN PEDIDO, SI ES QUE LO TUVIERA
	if($opc == 'TP_01'){
		$pedidoID = $_POST["pedidoID"];

		$consulta = "SELECT P.pagoID,P.pedidoServicioID,CP.descripcion,P.numeroComprobante,P.importeTotal,P.fechaPago,
									P.estado,P.numeroSerie
									FROM pago P 
									INNER JOIN COMPROBANTE_PAGO CP ON CP.comprobanteID = P.comprobanteID
									WHERE P.pedidoServicioID = '".$pedidoID."';
								";
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){			
			$fechaPago = str_replace("/","-",$row[5]);
	    $fechaPago = date('d-m-Y',strtotime($fechaPago));	    
			$comprobante = $row[2]; //N-B-F : Ninguno - Boleta - Factura
			$nroSerie = $row[7]; 
			$nroDoc = $row[3];	//Numero del comprobante
			if($nroDoc == '')$nroDoc = '---';
			echo "
						<tr>												
							<td>".$fechaPago."</td>
							<td style='text-align:right; padding-right:20px;'>".$row[4]."</td>
							<td>".$comprobante."</td>
							<td>".$nroSerie.' - '.$nroDoc."</td>
						</tr>
				";
		}
		exit();
	}
	// TRAER LOS SERVICIOS DE UN PEDIDO
	if($opc == 'TS_01'){
		$pedidoID = $_POST["pedidoID"];

		$consulta = "SELECT C.citaID,C.pedidoServicioID,C.pacienteID,C.medicoID,C.especialidadID,
									S.servicio,C.tipo,C.fecha,C.hora,C.observaciones,C.estado,C.precio,C.cantidad
									FROM CITA C
									INNER JOIN SERVICIO S  ON S.servicioID = C.servicioID
									WHERE pedidoServicioID='".$pedidoID."'
								";
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){
			$servicio = $row[5];
			$precio = $row[11];
			$cantidad = $row[12];
			$importe = $precio * $cantidad;
			$estadoCita = $row[10];

			if($estadoCita=='R') $estadoCita = "<span class='label label-warning'>Reservado</span>";
			else if($estadoCita=='S') $estadoCita = "<span class='label label-primary'>En Sala</span>";
			else if($estadoCita=='A') $estadoCita = "<span class='label label-success'>Atendido</span>";
			else if($estadoCita=='X') $estadoCita = "<span class='label label-danger'>Anulado</span>";					
			echo "
						<tr>												
							<td>".$servicio."</td>
							<td>".$precio."</td>
							<td>".$cantidad."</td>
							<td style='text-align:right; padding-right:20px;'>".$importe."</td>
							<td style='text-align:center;''>".$estadoCita."</td>
						</tr>
				";
		}
		exit();
	}
	// Facturar un pedido
	if($opc == 'FAC_01'){
		$DNI = $_POST["DNI"];
		$pedidoID = $_POST["pedidoID"];
		$comprobante = $_POST["cboComprobante"];
		$nroSerie = $_POST["txtNroSerie"];
		$nroComprobante = $_POST["txtNroComprobante"];
		$importe = $_POST["txtPagar"];

		//OBTENER DATOS DEL PEDIDO_SERVICIO
				$consulta = "SELECT pedidoServicioID,importeTotal,formaPagoID,importePagado,estadoPago
										FROM PEDIDO_SERVICIO WHERE pedidoServicioID = '".$pedidoID."'
										";
				$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
				$row = mysqli_fetch_array($res);
				$importeTotal = $row[1];
				$formaPagoID = $row[2];
				$importePagado = $row[3];
				$estadoPago = $row[4];

				$saldo = $importeTotal - $importePagado;
				$nuevoSaldo = $saldo - $importe;	

		// echo $row[1].'-'.$row[2].'-'.$row[3].'-'.$row[4];
		if($estadoPago == 'PAG'){
			echo "El servicio ya ha sido pagado.";
			exit();
		}
		if($formaPagoID == 'CON'){
			if($nuevoSaldo != 0){
				echo "Debe pagar la totalidad.";
				exit();
			}
		}
		// OBTENER EL IGV
		$consulta = "SELECT valor FROM PARAMETRO WHERE parametroID = 1 AND parametro = 'IGV'";
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
		$row = mysqli_fetch_row($res);
		$IGV = $row[0];
		// INSERTAMOS EL PAGO
		$consulta = "INSERT INTO PAGO (pedidoServicioID,comprobanteID,numeroSerie,numeroComprobante,
									IGV,importeSinIGV,importeIGV,importeTotal,
									fechaPago,estado,timestamp)VALUES
							('".$pedidoID."','".$comprobante."',
							".(($comprobante == '000')?'NULL':("'".$nroSerie."'")).",
							".(($nroComprobante == '')?'NULL':("'".$nroComprobante."'")).",
							".$IGV.",".$importe/(1+$IGV).",".$importe*($IGV/(1+$IGV)).",
							".$importe.",'".$fechaHoyAMD."',1,'".$timestamp."')
							";
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
		if(!$res){
			echo "No se pudo registrar el pago";
			exit();
		}
		// ACTUALIZAMOS EL ESTADO DE LAS CITAS A CONFIRMADO
		if($nuevoSaldo == 0){
			$consulta = "UPDATE cita SET estado = 'C' WHERE pedidoServicioID = '".$pedidoID."'";
			$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
			if(!$res){
				echo "Hubo errores al confirmar las citas.";
			}
			$estadoPago = 'PAG';
		} 
		else if($nuevoSaldo > 0 && $nuevoSaldo < $importeTotal)	$estadoPago = 'PAR';
		//ACTUALIZAMOS EL ESTADO DEL PEDIDO_SERVICIO
		$consulta = "UPDATE PEDIDO_SERVICIO SET importePagado = importePagado + '".$importe."',
								estadoPago='".$estadoPago."'
								WHERE pedidoServicioID='".$pedidoID."'
								 ";
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
		if(!$res){
			echo "No se pudo modificar la deuda.";
			exit();
		}
		echo 1;
		exit();
	}
	// CARGAR TABLA  PAGOS
	if($opc == 'CTP_01'){
		$fechaPago = $_POST['fechaPago'];
		$fechaPago = str_replace("/","-",$fechaPago);
	  $fechaPago = date('Y-m-d',strtotime($fechaPago));
	  
		$consulta = "SELECT P.pagoID,P.pedidoServicioID,P.comprobanteID,P.numeroSerie,
								P.numeroComprobante,P.importeTotal,P.fechaPago,P.estado,
								PE.nombres,PE.apPaterno,PE.apMaterno,PE.DNI,PE.telefono1,
								CP.descripcion
								FROM PAGO P
								INNER JOIN PEDIDO_SERVICIO PS on PS.pedidoServicioID = P.pedidoServicioID
								INNER JOIN PACIENTE PA ON PA.pacienteID = PS.pacienteID
								INNER JOIN PERSONA PE ON PE.personaID = PA.personaID
								INNER JOIN COMPROBANTE_PAGO CP ON CP.comprobanteID = P.comprobanteID
								WHERE P.fechaPago='".$fechaPago."'
								";
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){
			$pedidoID =  $row[1];
			$fechaPago = str_replace("/","-",$row[6]);
	    $fechaPago = date('d-m-Y',strtotime($fechaPago));
	    $paciente = $row[8].' '.$row[9].' '.$row[10];
	    $telefono = $row[12];
			$comprobante = $row[13]; //N-B-F : Ninguno - Boleta - Factura
			$nroSerie = $row[3]; 
			$nroDoc = $row[4];	//Numero del comprobante
			$importe = $row[5];
			if($nroDoc == '')$nroDoc = '---';
			echo "
						<tr>
							<td style='text-align:center;'>".$pedidoID."</td>
							<td style='text-align:center;'>".$fechaPago."</td>
							<td >".$paciente."</td>
							<td>".$telefono."</td>
							<td style='text-align:center;'>".$comprobante."</td>
							<td>".$nroSerie.' - '.$nroDoc."</td>
							<td style='text-align:right; padding-right:20px;'>".$importe."</td>
							<td>
									<div class='row'>
										<div class='col-md-8'>
											<form method='post' action='../facturacion/facturar.php'>
				                <input type='hidden' id='txtPedidoID' name='txtPedidoID' value='".$pedidoID."'>
				                <input type='hidden' id='txtDNI' name='txtDNI' value='".$row[11]."'>
	                      <button type='submit' class='btn btn-block btn-transparente btn-flat btn-xs'>
	                      	<span class='text-green'>
	                          <i class='ace-icon fa fa-search bigger-120'></i>                          
	                        </span>
												</button>
				              </form>
										</div>
									</div>
							</td>
						</tr>
				";
		}
		exit();
	}
	// CARGAR TABLA  PEDIDOS PENDIENTES
	if($opc == 'CTPP_01'){	  
		$consulta = "SELECT PS.pedidoServicioID,PS.pacienteID,PS.tipo,PS.via,PS.tasaIGV,PS.importeSinIGV,PS.importeIGV,
											PS.importeTotal,PS.importePagado,FP.formaPago,PS.estadoPago,substring_index(PS.timestamp,' ',1) as 'fecha',
											PE.DNI,PE.nombres,PE.apPaterno,PE.apMaterno,PE.telefono1
								FROM PEDIDO_SERVICIO PS
								INNER JOIN PACIENTE PA ON PS.pacienteID = PA.pacienteID
								INNER JOIN PERSONA PE ON PE.personaID = PA.personaID
								left JOIN FORMA_PAGO FP ON FP.formaPagoID = PS.formaPagoID
								WHERE PS.estadoPago<>'PAG'
								";
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){
			$pedidoID = $row[0];
			$fecha = str_replace("/","-",$row[11]);
	    $fecha = date('d-m-Y',strtotime($fecha));
	    $paciente = $row[13].' '.$row[14].' '.$row[15];
	    $telefono = $row[16];
	    $tipo = $row[2];
	    $via = $row[3];
			$importe = $row[7];
			$importePagado = $row[8];
			$formaPago = $row[9];
			$estadoPago = $row[10];
			if($formaPago == '')$formaPago = "No facturado";
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
			echo "
						<tr>
							<td style='text-align:center;'>".$pedidoID."</td>
							<td >".$paciente."</td>
							<td>".$tipo."</td>
							<td style='text-align:center;'>".$via."</td>
							<td style='text-align:right; padding-right:20px;'>".$importe."</td>
							<td style='text-align:right; padding-right:20px;'>".$importePagado."</td>
							<td>".$formaPago."</td>
							<td style='text-align:center;'>".$estadoPago."</td>
							<td>
									<div class='row'>
										<div class='col-md-8'>
											<form method='post' action='../facturacion/facturar.php'>
				                <input type='hidden' id='txtPedidoID' name='txtPedidoID' value='".$pedidoID."'>
				                <input type='hidden' id='txtDNI' name='txtDNI' value='".$row[12]."'>
	                      <button type='submit' class='btn btn-block btn-transparente btn-flat btn-xs'>
	                      	<span class='text-green'>
	                          <i class='ace-icon fa fa-search bigger-120'></i>                          
	                        </span>
												</button>
				              </form>
										</div>
									</div>
							</td>
						</tr>
				";
		}
		exit();
	}
?>
