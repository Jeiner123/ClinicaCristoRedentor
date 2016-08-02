<?php 
$archivo = $_FILES['imagen']['name'];
		if($archivo==''){
			echo "Debe seleccionar un archivo";
			exit();
		}
		$archivo = $_FILES['imagen'];
		$nombre = $archivo['name'];
		$tipo = $archivo['type'];
		$ruta_provisional = $archivo['tmp_name'];
		$size = $archivo['size'];
		echo $ruta_provisional;
 ?>