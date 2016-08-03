<?php include '../../general/variables.php';?>
<?php
	require('../../bd/bd_conexion.php');
	$opc = $_POST['opc'];

	// INSERTAR PERSONA-PACIENTE
	if($opc=='CC_01'){
		$entidad = $_POST['cboEntidad'];
		$tipoDocumento = $_POST['cboDocumento'];
		$documento = $_POST['txtDocumento'];
		$razonSocial=$_POST['txtRazonSocial'];
		$direccion=$_POST['txtDireccion'];
		$nombre = $_POST['txtNombre'];
		$apPat = $_POST['txtApellidoPat'];
		$apMat = $_POST['txtApellidoMat'];
		$telefono = $_POST['txtTelefono'];
		$direccion=$_POST['txtDireccion'];
		$emailE=$_POST['txtEmailE'];
		$banco=$_POST['cboBanco'];
		$cuenta=$_POST['txtDetraccion'];
		$emailP=$_POST['txtEmail'];
		$observacion=$_POST['txtObservaciones'];
		
		$consulta = "insert into PROVEEDOR values('".$documento."','".$entidad."','".$tipoDocumento."','".$razonSocial."','".$emailE."','".$direccion."','".$banco."','".$cuenta."','".$nombre."','".$apPat."','".$apMat."','".$telefono."','".$emailP."','".$observacion."','A')";
			
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if(!$res){
			echo "No se pudo registrar la persona";
		}else{
			echo "registro correcto";
		}

		exit();
	}

	if($opc=='CC_02'){
		$consulta = "select * from PROVEEDOR where estado='A'";
	
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
			while($row = mysqli_fetch_row($res)){
			 if($row[1]==1){
			 	$entidad='PERSONA NATURAL';
			 }
			 if($row[1]==2){
			 	$entidad='PERSONA JURÍDICA';
			 }
				echo "<tr>					
						<td>".$entidad."</td>
						<td>".$row[0]."</td>
						<td>".$row[3]."</td>		
						<td>".$row[8]." ".$row[9]." ".$row[10]."</td>
						<td>".$row[11]."</td>
						<td>".$row[5]."</td>
					</tr>";
		}
			
	}

	if($opc=='CC_03'){
		$documento = $_POST['documento'];
		$sql = "SELECT * from proveedor where proveedorID=$documento";
		$resulset = mysqli_query($con,$sql);
 		$datos=array();
	    while($row = mysqli_fetch_assoc($resulset))
	    {
	        $datos[] = $row;
	        
	    }
		
		echo json_encode($datos);
		exit();	
	}

	if($opc=='CC_04'){
		$documento = $_POST['txtDocumento'];
		$razonSocial=$_POST['txtRazonSocial'];
		$direccion=$_POST['txtDireccion'];
		$nombre = $_POST['txtNombre'];
		$apPat = $_POST['txtApellidoPat'];
		$apMat = $_POST['txtApellidoMat'];
		$telefono = $_POST['txtTelefono'];
		$direccion=$_POST['txtDireccion'];
		$emailE=$_POST['txtEmailE'];
		$banco=$_POST['cboBanco'];
		$cuenta=$_POST['txtDetraccion'];
		$emailP=$_POST['txtEmail'];
		$observacion=$_POST['txtObservaciones'];

		$consulta = "UPDATE proveedor set razonSocial='$razonSocial',emailEmpresa='$emailE',direccion='$direccion',banco='$banco',cuentaBanco='$cuenta',nombres='$nombre',apellidoPat='$apPat',apellidoMat='$apMat',telefono='$telefono',emailPersonal='$emailP',observaciones='$observacion' where proveedorID=$documento";
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if($res){
			echo "Proveedor actualizado";
		}else{
			echo "Error con la actualización del proveedor";
		}
		exit();
	}
	

?>


	
	
