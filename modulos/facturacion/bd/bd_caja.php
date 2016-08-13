<?php include '../../general/variables.php';?>
<?php
	require('../../bd/bd_conexion.php');
	$opc = $_POST['opc'];
	// APERTURAR LA CAJA
	if($opc == 'AP_CA_01'){
		$cajaID = 1;
		$personalID = 1001;
		$saldoI = $_POST['saldoInicial'];
		$obs = $_POST['observaciones'];

		$consulta = "INSERT INTO detalle_caja(cajaID,personalID,fechaApertura,saldoInicial,observaciones)VALUES(
									'".$cajaID."','".$personalID."','".$timestamp."','".$saldoI."','".$obs."')";
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
		if(!$res) echo "No se puede realizar la operación.";			
		else {
			$consulta = "UPDATE caja SET estado ='A' WHERE cajaID = '".$cajaID."'";
			$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
			if(!$res) echo "No se pudo actualizar el estado de la caja";
			else{
				session_start();
			 	$_SESSION['cajaID'] = 1;
			 	$_SESSION['estadoCaja'] = "A";
				echo 1;
			}
		}
		exit();
	}
	if($opc == 'CE_CA_01'){
		$cajaID = 1;
		$personalID = 1001;	
		$consulta = "UPDATE caja SET estado ='C' WHERE cajaID = '".$cajaID."'";
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
		if(!$res) echo "No se puede realizar la operación.";			
		else {
				session_start();
				$_SESSION['cajaID'] = 1;
				$_SESSION['estadoCaja'] = "C";
				echo 1;			
		}
		exit();
	}
	// CARGAR TABLA REGISTROS (CIERRES DE CAJA)
	// if($opc == 'CT_REG_01'){
	// 	$pedidoID = $_POST["pedidoID"];

	// 	$consulta = "SELECT 

	// 							FROM
	// 							";
	// 	$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
	// 	while($row = mysqli_fetch_row($res)){
	// 		echo "
	// 					<tr>
	// 						<td>".$fechaPago."</td>
	// 						<td style='text-align:right; padding-right:20px;'>".$row[4]."</td>
	// 						<td>".$comprobante."</td>
	// 						<td>".$nroSerie.' - '.$nroDoc."</td>
	// 					</tr>
	// 			";
	// 	}
	// 	exit();
	// }