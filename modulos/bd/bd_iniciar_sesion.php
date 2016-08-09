<?php
	// Empezamos a usar sesiones
	$usuario = $_POST['txtUsuario'];
	$clave = md5($_POST['txtClave']);

	include 'bd_conexion.php';

	$consulta = "SELECT U.usuario, U.clave, U.estado, P.nombres, P.apPaterno, P.apMaterno
				FROM usuario U
				INNER JOIN persona P ON P.DNI = U.DNI
				WHERE U.usuario='".$usuario."' AND U.clave='".$clave."'";
	$res = mysqli_query($con, $consulta) or die (mysqli_error($con));
	 
	if (mysqli_num_rows($res)==0) {
		// Los datos no coniciden o la cuenta no existe
		header('Location: ../../index.php?opc='.base64_encode('1'));
		exit();
	} else {
		$datos=mysqli_fetch_row($res);
		if($datos[2]==2){
			// El personal esta inactivo -> La cuenta esta inactiva.
			header('Location: ../../index.php?opc='.base64_encode('2'));
			exit();
		}
		else{
			// Initialize session variables
			session_start();
            $_SESSION['usuario'] = $datos[0];
			$_SESSION['full_name'] = $datos[3] . ' ' . $datos[4];

			$_SESSION['nombres'] = $datos[3];
            $_SESSION['ap_paterno'] = $datos[4];
            $_SESSION['ap_materno'] = $datos[5];

			header('Location: ../general/perfil.php');
		}
	}
 ?>
