<?php include '../../general/variables.php';?>
<?php
	require('../../bd/bd_conexion.php');
	$opc = $_POST['opc'];
	// CCARGAR COMBO COMPROBANTE DE PAGO PARA VENTA	
	if($opc == 'CC_CV_01'){
		$consulta = "select comprobanteID,descripcion from comprobante_pago where estado=1 and ventas=1";
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con) );
			echo "<option value='"."0"."'>-- Seleccionar --</option>";
		while($row = mysqli_fetch_row($res)){
			echo "<option value='".$row[0]."'>".$row[1]."</option>";
		}
		exit();
	}
	//Actualizar campo para el pedido_servicio
	if($opc == 'ACT_P_S'){
		$pedidoID = $_POST['pedidoID'];
		$campo = $_POST['campo'];
		$nuevoValor = $_POST['nuevoValor'];		

		$consulta = "update PEDIDO_SERVICIO set ".$campo." = '".$nuevoValor."'
								where pedidoServicioID = '".$pedidoID."'
								";
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

		$consulta = "select PE.DNI,PE.nombres,PE.apPaterno,PE.apMaterno,PE.telefono1,
								PS.importeSinIGV,PS.importeIGV,PS.importeTotal,PS.importePagado,
								PS.importeTotal-PS.importePagado,PS.formaPagoID								
								from PEDIDO_SERVICIO PS
								inner join PACIENTE PA ON PS.pacienteID = PA.pacienteID
								inner join PERSONA PE ON PE.DNI = PA.DNI
								where PE.DNI = '".$DNI."' and PS.pedidoServicioID = '".$pedidoID."'
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

		$consulta = "select P.pagoID,P.pedidoServicioID,CP.descripcion,P.numeroComprobante,P.importe,P.fechaPago,
									P.estado,P.numeroSerie
									from pago P 
									inner join COMPROBANTE_PAGO CP ON CP.comprobanteID = P.comprobanteID
									where P.pedidoServicioID = '".$pedidoID."';
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
							<td>".$row[4]."</td>
							<td>".$comprobante."</td>
							<td>".$nroSerie.' - '.$nroDoc."</td>
						</tr>
				";
		}
	}
	// TRAER LOS SERVICIOS DE UN PEDIDO
	if($opc == 'TS_01'){
		$pedidoID = $_POST["pedidoID"];

		$consulta = "select C.citaID,C.pedidoServicioID,C.pacienteID,C.medicoID,C.especialidadID,
									S.servicio,C.tipo,C.fecha,C.hora,C.observaciones,C.estado,C.precio,C.cantidad
									from CITA C
									inner join SERVICIO S  ON S.servicioID = C.servicioID
									where pedidoServicioID='".$pedidoID."'
								";
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){
			$servicio = $row[5];
			$precio = $row[11];
			$cantidad = $row[12];
			$importe = $precio * $cantidad;
			$estadoCita = $row[10];

			if($estadoCita=='R'){
				$estadoCita = "<span class='label label-warning'>Reservado</span>";
			}else{
				if($estadoCita=='S'){
					$estadoCita = "<span class='label label-primary'>En Sala</span>";
				}else{
					if($estadoCita=='A'){
						$estadoCita = "<span class='label label-success'>Atendido</span>";
					}else{
						if($estadoCita=='X'){
							$estadoCita = "<span class='label label-danger'>Anulado</span>";
						}
					}
				}
			}
			echo "
						<tr>												
							<td>".$servicio."</td>
							<td>".$precio."</td>
							<td>".$cantidad."</td>
							<td>".$importe."</td>
							<td>".$estadoCita."</td>
						</tr>
				";
		}
		exit();
	}
	// Facturar un pedido
	if($opc == 'FAC_01'){
		$DNI = $_POST["DNI"];
		$pedidoID = $_POST["pedidoID"];
		$comprobante = $_POST["comprobante"];
		$nroSerie = $_POST["nroSerie"];
		$nroComprobante = $_POST["nroComprobante"];
		$importe = $_POST["importe"];
		//OBTENER DATOS DEL PEDIDO_SERVICIO
			$consulta = "select pedidoServicioID,importeTotal,formaPagoID,importePagado,estadoPago
									from PEDIDO_SERVICIO where pedidoServicioID = '".$pedidoID."'
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
			echo "El servicio ya ha sido pagado";
			exit();
		}
		if($formaPagoID == 'CON'){
			if($nuevoSaldo != 0){
				echo "Debe pagar la totalidad";
				exit();
			}
		}
		// INSERTAR PAGO
		$consulta = "insert into PAGO(pedidoServicioID,comprobanteID,numeroSerie,numeroComprobante,importe,fechaPago,estado) values
							('".$pedidoID."','".$comprobante."',
							".(($comprobante == '000')?'NULL':("'".$nroSerie."'")).",								
							".(($nroComprobante == '')?'NULL':("'".$nroComprobante."'")).",
								'".$importe."','".$fechaHoyAMD."',1)
							";
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
		if(!$res){
			echo "No se pudo registrar el pago";
			exit();
		}		
		if($nuevoSaldo==0){
			$estadoPago = 'PAG';
		}else{
			if($nuevoSaldo>0 && $nuevoSaldo < $importeTotal){ //importeTotal
				$estadoPago = 'PAR';
			}
		}
		$consulta = "update PEDIDO_SERVICIO set importePagado=importePagado+'".$importe."',
								estadoPago='".$estadoPago."'
								where pedidoServicioID='".$pedidoID."'
								 ";
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));		
		if(!$res){
			echo "No se pudo rmodificar la deuda";
			exit();
		}
		echo 1;
		exit();
	}
	// LISTAR PAGOS 
	if($opc == 'CTP_01'){
		$consulta = "select pagoID,pedidoServicioID,comprobanteID,numeroSerie,
								numeroComprobante,importe,fechaPago,estado
								from PAGO";
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
							<td>".$row[4]."</td>
							<td>".$comprobante."</td>
							<td>".$nroSerie.' - '.$nroDoc."</td>
						</tr>
				";
		}
	}
?>

