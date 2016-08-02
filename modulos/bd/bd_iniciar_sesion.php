<?php
	//empezamos a usar sesiones
	$usuario = $_POST['txtUsuario'];
	$clave = md5($_POST['txtClave']);
	// $clave = md5($_POST['txtClave']);
	include 'bd_conexion.php';
	$consulta= "select U.usuario, U.clave , U.estado, P.nombres,P.apPaterno,P.apMaterno
				from usuario U
				inner join persona P on P.DNI = U.DNI
				where U.usuario='".$usuario."' and U.clave='".$clave."'";
	$res = mysqli_query($con, $consulta) or die (mysqli_error($con));
	 
	if (mysqli_num_rows($res)==0){
		// Los datos no coniciden o la cuenta no existe
		header('Location: ../../index.php?opc='.base64_encode('1'));
		exit();
	}
	else{
		$datos=mysqli_fetch_row($res);
		if($datos[2]==2){
			// El personal esta inactivo -> La cuenta esta inactiva.
			header('Location: ../../index.php?opc='.base64_encode('2'));
			exit();
		}
		else{
			// Iniciamos las variables de sesión
			session_start();
			$_SESSION['usuarioClinica']=$datos[3].' '.$datos[4];
			header('Location: ../documentos/control_documentos.php');			
			// $_SESSION['nombres']=$datos[1]." ".$datos[2];
			// $_SESSION['apellidos']=$datos[2]." ".$datos[3];
			// $_SESSION['usuario']=$datos[4];
			// $_SESSION['permisoID']=$datos[6];
			// $_SESSION['establoID']=$datos[8];
			// $_SESSION['establo']=$datos[9];
			// $_SESSION['cargo']=$datos[10];
			// header('Location: ../view/');
		}
	}
 ?>
