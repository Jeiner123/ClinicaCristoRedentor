<?php include '../../general/variables.php';?>
<?php
	require('../../bd/bd_conexion.php');
	$opc = $_POST['opc'];

	//CARGAR COMBO NIVEL
	if($opc=='CC_NIVEL'){
		$consulta = "SELECT estructuraID,nombre FROM estructura_plan_contable WHERE estado='A'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			echo "<option value='".$row[0]."'>".$row[0]." - ".$row[1]."</option>";
		}
		exit();
	}

	if($opc=='CC_TC'){
		$estructuraID = $_POST['estructuraID'];
		$consulta = "SELECT tipoCuentaID,tipoCuenta FROM tipo_cuenta WHERE estructuraID=".$estructuraID." and estado='A'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='0'>--Seleccionar--</option>";
		while($row = mysqli_fetch_row($res)){	
			echo "<option value='".$row[0]."'>".$row[0]." - ".$row[1]."</option>";
		}
		exit();
	}
?>