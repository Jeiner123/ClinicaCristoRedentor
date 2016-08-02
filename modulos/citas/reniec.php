<?php 
	header('Content-Type: text/html; charset=UTF-8');
	$nuDni = $_POST['nuDni'];
	$imagen = $_POST['imagen'];
	if($imagen=='')	$imagen = getValorImagen();

	$data = array('accion' => 'buscar', 'nuDni' => $nuDni, 'imagen' => $imagen);
 
	$cookies = 'cookie.txt';
	 
	$curl = curl_init('https://cel.reniec.gob.pe/valreg/valreg.do');
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_COOKIEJAR, $cookies);
	curl_setopt($curl, CURLOPT_COOKIEFILE, $cookies);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.12) Gecko/2009070611 Firefox/3.0.12");
	
	$resultado = curl_exec($curl);
	curl_close($curl);
	//'<', '>', '\n', '\r'
	$vectorSplit = preg_split('/<|>|\n|\r/',$resultado);
	$vectorResultado = array();
	for ($i = 0; $i < count($vectorSplit); $i++)
    {
        if (strlen(trim($vectorSplit[$i]))!=0)
           $vectorResultado[] = trim($vectorSplit[$i]);
    }

    $tipoResultado = count($vectorResultado);
    $RESULTADO_ERROR_IMAGEN = 217;//793;
	$RESULTADO_ERROR_DNI = 222;//805;
	$RESULTADO_CORRECTO = 232;//817;
	$mensaje = '';
	if($tipoResultado == $RESULTADO_CORRECTO)
	{
		setValorImagen($imagen);
		$mensaje .= '{resultado:true,';
		$mensaje .= 'mensaje : "EXITO : Los datos han cargado correctamente",';
		$mensaje .= 'nombre : "'.utf8_encode($vectorResultado[185]).'",';
		$mensaje .= 'apePaterno : "'.utf8_encode($vectorResultado[186]).'",';
		$mensaje .= 'apeMaterno : "'.utf8_encode($vectorResultado[187]).'"}';
	}elseif ($tipoResultado == $RESULTADO_ERROR_DNI) {
		$mensaje .= '{resultado:false,';
		$mensaje .= 'imagen:false,';
		$mensaje .= 'mensaje : "ERROR : El dni no existe"}';
	}elseif ($tipoResultado == $RESULTADO_ERROR_IMAGEN) {
		$mensaje .= '{resultado:false,';
		$mensaje .= 'imagen:true,';
		$mensaje .= 'mensaje : "ERROR : El codigo de la imagen es incorrecto.Si el problema persiste, recargue la pagina."}';
	}else{
		$mensaje .= '{resultado:false,';
		$mensaje .= 'imagen:false,';
		$mensaje .= 'mensaje : "ERROR : No se controlo los datos enviados"}';
	}
	echo $mensaje;
 ?>