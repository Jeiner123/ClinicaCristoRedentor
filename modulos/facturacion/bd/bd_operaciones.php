<?php include '../../general/variables.php';?>
<?php
	require('../../bd/bd_conexion.php');
	$opc = $_POST['opc'];
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
	//Seleccionar datos para el pedido
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
	// Facturar un pedido
	if($opc == 'FAC_01'){
		$DNI = $_POST["DNI"];
		$pedidoID = $_POST["pedidoID"];
		$documento = $_POST["documento"];
		$nroDocumento = $_POST["nroDocumento"];
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
		$consulta = "insert into PAGO(pedidoServicioID,tipoDocumento,numeroDocumento,importe,fechaPago,estado) values
							('".$pedidoID."','".$documento."',
							".(($documento == 'N')?'NULL':("'".$nroDocumento."'")).",
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
?>
