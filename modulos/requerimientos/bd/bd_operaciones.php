<?php include '../../general/variables.php';?>
<?php
	require('../../bd/bd_conexion.php');
	$opc = $_POST['opc'];

	//ISERT REQUERIMIENTO
	if($opc=='RRQ_01'){
		$personalID='1001';
		$fecha =$fechaHoyAMD;
		$detalle=$_POST['detalles']; 
		
		$consulta = "SELECT IFNULL(MAX(requerimientoID)+1,1) FROM requerimiento";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			$requerimientoID=$row[0];
		}
		
		$consulta = "INSERT INTO requerimiento VALUES (".$requerimientoID.",".$personalID.",'".$fecha."',".$detalle.",'P')";
			
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if(!$res){
			echo 0;
		}else{
			echo 1;
		}

		exit();
	}

	//ISERT DETALLE DE REQUERIMIENTO
	if($opc=='RRQ_02'){
		$item = $_POST['item'];
		$consulta = "SELECT IFNULL(MAX(requerimientoID),1) FROM detalle_requerimiento";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			$requerimientoID=$row[0];
		}

		$producto = $_POST['txtProducto'.$item];
		$unidad = $_POST['txtUnidad'.$item];
		$descripcion = $_POST['txtDescripcion'.$item];
		$cantidad = $_POST['txtCantidad'.$item];
		$requerimiento = $_POST['txtRequerimiento'.$item];
		

		$consulta = "INSERT INTO detalle_requerimiento VALUES (".$requerimientoID.",".$item.",'".$producto."','".$unidad."','".$descripcion."',".$cantidad.",'".$requerimiento."','P')";
			
		mysqli_query($con,$consulta)or  die (mysqli_error($con));
		
		exit();
	}

?>


	
	
