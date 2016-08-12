<?php 	
	// Consultas
	function obtenerIGV(){
		require('../bd/bd_conexion.php');
		$consulta = "SELECT valor FROM PARAMETRO WHERE parametroID = 1 AND parametro = 'IGV'";
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
		$row = mysqli_fetch_row($res);
		$IGV = $row[0];
		return $IGV;
	}
	// Consultas
	function completarCerosAdelante($num,$numDigitos){	// 6 -- 5 -> Resp. = 00005
		if(strlen($num) == $numDigitos) return $num;
		else return completarCerosAdelante("0".$num,$numDigitos);
	}	

 ?>