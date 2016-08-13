<?php include '../general/variables.php';?>
<?php
	$opc = $_POST['opc'];
	$hoy = date('Y').'-'.date('m').'-'.date('d');
	$ImgPermitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
	$pdfPermitido = array("application/pdf");

	require 'bd_conexion.php';

// CARGAR COMBOS
	//CARGAR COMBO PARAMETRO
	if($opc=='CC_CP'){
		$parametroID=$_POST['parametroID'];
		$consulta = "SELECT parametro,valor from parametro where parametroID='".$parametroID."' and estado=1";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='0'> No aplica</option>";
		while($row = mysqli_fetch_row($res)){	
			echo "<option value='".$row[1]."'>".$row[0]." ".($row[1]*100)."%</option>";
		}
		exit();
	}
	//CARGAR COMBO MEDIO DE PAGO
	if($opc=='CC_MP'){
		$consulta = "SELECT medioPagoID,medioPago FROM medio_pago where estado='A'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			echo "<option value='".$row[0]."'>".$row[0]." - ".$row[1]."</option>";
		}
		exit();
	}
	//CARGAR COMBO CONDICIÓN DE PAGO
	if($opc=='CC_FP'){
		$consulta = "SELECT formaPagoID,formaPago FROM forma_pago where estado='1'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='0'>--Seleccionar--</option>";
		while($row = mysqli_fetch_row($res)){	
			echo "<option value='".$row[0]."'>".$row[0]." - ".$row[1]."</option>";
		}
		exit();
	}

	//CARGAR COMBO  TIPO DETRACCIONES
	if($opc=='CC_TDE'){
		$consulta = "SELECT tipoDetraccionID,tipoDetraccion,porcentaje FROM tipo_detraccion where estado='A' order by tipoDetraccion";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='0'>No aplica</option>";
		while($row = mysqli_fetch_row($res)){	
			echo "<option value='".$row[2]."'>".$row[1]." ".($row[2]*100)."%</option>";
		}
		exit();
	}

	//CARGAR COMBO TIPO PERCEPCION
	if($opc=='CC_TP'){
		$consulta = "SELECT tipoPercepcion,porcentaje FROM tipo_percepcion where estado='A'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='0'>No aplica</option>";
		while($row = mysqli_fetch_row($res)){	
			echo "<option value='".$row[1]."'>".$row[0]." ".($row[1]*100)."%</option>";
		}
		exit();
	}

	// CARGAR COMBO SERVICIOS
	if($opc == 'CC_SERV_01'){
		$especialidadID = $_POST['especialidadID'];
		$tipoServicioID = $_POST['tipoServicioID'];

		$consulta = "SELECT S.servicioID,S.servicio,S.precioUnitario,S.estado,E.especialidad,
											E.especialidadID,T.tipoServicio,T.tipoServicioID
									from servicio S
									LEFT JOIN tipo_servicio T ON S.tipoServicioID = T.tipoServicioID
									INNER JOIN especialidad E ON E.especialidadID = S.especialidadID
									WHERE S.estado=1";

		if($especialidadID > 0) $consulta = $consulta." and PS.especialidadID = '".$especialidadID."'";
		if($tipoServicioID > 0) $consulta = $consulta." and PS.tipoServicioID = '".$tipoServicioID."'";

		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='0'>-- Seleccionar servicio --</option>";
		while($row = mysqli_fetch_row($res)){
			$servicioID = $row[0];
			$servicio = $row[1];
			$especialidad = $row[4];
			$tipoServicio = $row[4];
			echo "<option value='".$servicioID."'>".$especialidad.' - '.$servicio."</option>";
		}
		exit();
	}

	// CARGAR COMBO MEDICOS
	if($opc == 'CC_MED_01'){
		$especialidadID = $_POST['especialidadID'];
		$consulta = "SELECT PL.personalID,P.nombres,P.apPaterno,P.apMaterno,E.especialidad
									FROM PERSONAL_SALUD PS
									INNER JOIN PERSONAL PL on PL.personalID = PS.personalID
									INNER JOIN PERSONA P on P.personaID = PL.personaID
									INNER JOIN ESPECIALIDAD E on E.especialidadID = PS.especialidadID
									WHERE PL.estado =1 and PL.tipoPersonalID<=2
									GROUP BY (PL.personalID)
								";
		if($especialidadID > 0)
			$consulta = $consulta." and PS.especialidadID = '".$especialidadID."'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='0'>-- Seleccionar médico --</option>";
		while($row = mysqli_fetch_row($res)){
			$medicoID = $row[0];			
			$nombresM = explode(" ", $row[1]);
			$medico = $nombresM[0].' '.$row[2].' '.$row[3];
			$especialidad = $row[4];
			echo "<option value='".$medicoID."'>".$medico.' - '.$especialidad."</option>";
		}
		exit();
	}
	//CAGAR COMBO PACIENTES
	if($opc == 'CC_PAC_01'){
		$consulta = "SELECT P.DNI, PA.pacienteID, P.nombres,P.apPaterno,P.apMaterno
								  FROM PACIENTE PA
								  INNER JOIN PERSONA P ON PA.personaID = P.personaID
								  WHERE PA.estado = 1 ORDER BY P.nombres
								  ";							
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='0'>-- Seleccionar paciente --</option>";
		while($row = mysqli_fetch_row($res)){
			$pacienteID = $row[1];			
			$DNI = completarCerosAdelante($row[0],8);
			$nombresP = explode(" ", $row[2]);
			$paciente = $nombresP[0].' '.$row[3].' '.$row[4];
			$historiaClinica = "";
			if(strlen($pacienteID ) == 1) $historiaClinica = "0000".$pacienteID;
			else if(strlen($pacienteID ) == 2) $historiaClinica = "000".$pacienteID;
			else if(strlen($pacienteID ) == 3) $historiaClinica = "00".$pacienteID;
			else if(strlen($pacienteID ) == 4) $historiaClinica = "0".$pacienteID;
			echo "<option value='".$pacienteID."'>".$DNI.' - '.$historiaClinica.' - '.$paciente."</option>";
		}
		exit();
	}
	//CARGAR COMBO TIPO DE DOCUMENTO
	if($opc=='CC_TD'){
		$consulta = "SELECT tipoDocumentoID,tipoDocumento FROM tipo_documento WHERE estado='A'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value=''>--Seleccionar--</option>";
		while($row = mysqli_fetch_row($res)){
			echo "<option value='".$row[0]."'>".$row[0]." - ".$row[1]."</option>";
		}
		exit();
	}

	//CARGAR COMBO ENTIDADES FINANCIERAS
	if($opc=='CC_EF'){
		$consulta = "SELECT entidadFinancieraID,entidadFinanciera FROM entidad_financiera WHERE estado='A'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='00'>--Seleccionar--</option>";
		while($row = mysqli_fetch_row($res)){	
			echo "<option value='".$row[0]."'>".$row[0]." - ".$row[1]."</option>";
		}
		exit();
	}

	//CARGAR COMBO TIPO DE ADQUISICION
	if($opc=='CC_TA'){
		$consulta = "SELECT tipoAdquisicionID,tipoAdquisicion FROM tipo_adquisicion WHERE estado='A'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='0'>--Seleccionar--</option>";
		while($row = mysqli_fetch_row($res)){	
			echo "<option value='".$row[0]."'>".$row[0]." - ".$row[1]."</option>";
		}
		exit();
	}
	// CCARGAR COMBO COMPROBANTE DE PAGO PARA VENTA	
	if($opc == 'CC_CV_01'){
		$consulta = "SELECT comprobanteID,descripcion FROM comprobante_pago WHERE estado=1 and ventas=1";
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con) );
			echo "<option value='"."0"."'>-- Seleccionar --</option>";
		while($row = mysqli_fetch_row($res)){ 
			echo "<option value='".$row[0]."'>".$row[0]." - ".$row[1]."</option>";
		}
		exit();
	}
	// CCARGAR COMBO COMPROBANTE DE PAGO PARA COMPRAS
	if($opc == 'CC_CV_02'){
		$consulta = "select comprobanteID,descripcion FROM comprobante_pago WHERE estado=1 and compras=1";
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con) );
			echo "<option value='"."0"."'>-- Seleccionar --</option>";
		while($row = mysqli_fetch_row($res)){ 
			echo "<option value='".$row[0]."'>".$row[0]." - ".$row[1]."</option>";
		}
		exit();
	}
	// AREAS
	if($opc=='CC_AR_01'){
		$consulta = "SELECT areaID,area FROM area WHERE estado=1 order by area asc";
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con));
			echo "<option value='"."0"."'>-- Seleccionar --</option>";
		while($row = mysqli_fetch_row($res)){
			echo "<option value='".$row[0]."'>".$row[1]."</option>";
		}
		exit();
	}
	// Cargo
	if($opc=='CC_CARG_01'){
		$areaID = $_POST['areaID'];
		$consulta = "SELECT cargoID,cargo FROM cargo WHERE estado=1 and areaID='".$areaID."' order by cargo asc";
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con));
			echo "<option value='"."0"."'>-- Seleccionar --</option>";
		while($row = mysqli_fetch_row($res)){
			echo "<option value='".$row[0]."'>".$row[1]."</option>";
		}
		exit();
	}
	// Especialidades
	if($opc=='CC_E_05'){
		$consulta = "SELECT especialidadID,especialidad FROM especialidad WHERE estado=1 order by especialidad asc";
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con));
			echo "<option value='"."-1"."'>-- Especialidad --</option>";
		while($row = mysqli_fetch_row($res)){
			echo "<option value='".$row[0]."'>".$row[1]."</option>";
		}
		exit();
	}
	// Tipo de servicio
	if($opc=='TS_01'){
		$consulta = "SELECT tipoServicioID,tipoServicio FROM tipo_servicio WHERE estado=1 order by tipoServicio asc";
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con));
			echo "<option value='"."0"."'>-- Tipo de servicio --</option>";
		while($row = mysqli_fetch_row($res)){
			echo "<option value='".$row[0]."'>".$row[1]."</option>";
		}
		exit();
	}
	//Tipo telefono
	if($opc=='CC_TT_01'){
		$consulta = "SELECT tipoTelefonoID,tipoTelefono FROM tipo_telefono WHERE estado=1 order by tipoTelefono asc";
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con));
			echo "<option value='"."0"."'>-- Seleccionar --</option>";
		while($row = mysqli_fetch_row($res)){
			echo "<option value='".$row[0]."'>".$row[1]."</option>";
		}
		exit();
	}
	//Tipo PERSONAL 
	if($opc=='CC_TP_01'){
		$consulta = "SELECT tipoPersonalID,tipoPersonal FROM tipo_personal WHERE estado=1 order by tipoPersonal asc";
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con));
			echo "<option value='"."0"."'>-- Seleccionar --</option>";
		while($row = mysqli_fetch_row($res)){
			echo "<option value='".$row[0]."'>".$row[1]."</option>";
		}
		exit();
	}
	//Procedencias 
	if($opc=='CC_P_01'){
		$consulta = "SELECT procedenciaID,procedencia FROM PROCEDENCIA WHERE estado=1 order by procedencia asc";
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con));
			echo "<option value='"."0"."'>-- Seleccionar --</option>";
		while($row = mysqli_fetch_row($res)){
			echo "<option value='".$row[0]."'>".$row[1]."</option>";
		}
		exit();
	}

//VERIFICA DNI, SI EXISTE
if($opc=="PL_10"){
	$DNI = $_POST["DNI"];
	$consulta = "SELECT DNI,nombres,apPaterno,apMaterno,fechaNacimiento,sexo,telefono1,tipoTelefono1,
							telefono2,tipoTelefono2,correoPersonal,RUC,direccion
							 FROM persona WHERE DNI ='".$DNI."'";
	$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
	$datos = "";
	if(mysqli_num_rows($res)>0){
		$datos = mysqli_fetch_array($res);
		$fechaN = $datos[4];
		$fechaN = str_replace("/","-",$fechaN);
		$fechaN = date('d-m-Y',strtotime($fechaN));
		echo $datos[1].",,".$datos[2].",,".$datos[3].",,".$fechaN.",,".$datos[5].",,".$datos[6].",,".
				$datos[7].",,".$datos[8].",,".$datos[9].",,".$datos[10].",,".$datos[11].",,".$datos[12];
	}else{
		echo 0;
	}
}
?>





<?php 

// Operaciones de banner
	//Guardar banner
		if($opc=='B_01'){
				$banner = $_FILES['txtBanner']['name'];
				if($banner==''){
					echo "Debe seleccionar una imagen y un banner";
					exit();
				}
				$banner = $_FILES['txtBanner'];
				$nombre = $banner['name'];
				$tipo = $banner['type'];
				$ruta_provisional = $banner['tmp_name'];
				$size = $banner['size'];
				$ruta = '../img/banner/';			
				$limite = 1024;

				if (!in_array($tipo, $ImgPermitidos)){
					echo "Verifique el tipo de la imágen, debe ingresar jpg, png o gif";
					exit();
				}
				if($size>$limite*1024 or $size>$limite*1024){
					echo "El tamaño de las imagenes es muy grande.";
					exit();
				}
				$ruta = $ruta.$nombre;
				move_uploaded_file($ruta_provisional, $ruta);

				$desc = $_POST['txtDescripcion'];
				$link = $_POST['txtLink'];
				$prioridad = $_POST['txtPrioridad'];
				$estado = $_POST['cboEstado'];

				$consulta = "insert into banner(banner,descripcion,link,prioridad,estado) values
											('".$ruta."','".$desc."','".$link."','".$prioridad."','".$estado."')";
				$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
				if($res){
					echo 1;
				}else{
					echo "No se pudo registrar el item";
				}
				exit();
		}
	//Cargar tabla banner
		if($opc=='B_02'){
			$consulta = "SELECT bannerID,banner,descripcion,link,prioridad,estado
	              FROM banner WHERE estado=1 or estado=2 order by prioridad desc ";
			$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
			while($row = mysqli_fetch_row($res)){
				echo "<tr>					
						<td>".$row[0]."</td>
						<td>".$row[1]."</td>
						<td>".$row[2]."</td>
						<td>".$row[3]."</td>
						<td>".$row[4]."</td>
						<td>"; if($row[5]=='1'){echo "Activo";}if($row[5]=='2'){echo "Inactivo";}echo "</td>
					</tr>";
			}
			exit();
		}
	//Editar estado de banner	
		if($opc=='B_03'){
			$estado = $_POST['estado'];
			$bannerID = $_POST['bannerID'];
			$consulta = "update banner set estado='".$estado."'WHERE bannerID='".$bannerID."'";
			$res = mysqli_query($con,$consulta)or die(mysqli_error($con));
			if($res){
				echo 1;
			}else{
				echo "No se pudo modificar el estado";
			}
			exit();
		}
	//Modificar banner
		if($opc=='B_04'){
			$bannerID = $_POST['txtBannerID'];
			$desc = $_POST['txtDescripcion'];
			$link = $_POST['txtLink'];
			$prioridad = $_POST['txtPrioridad'];
			$estado = $_POST['cboEstado'];

			$consulta = "update banner set descripcion='".$desc."',link='".$link."',
									prioridad=".$prioridad.",estado=".$estado." WHERE bannerID='".$bannerID."'";
			$res = mysqli_query($con,$consulta)or die(mysqli_error($con));
			if($res){
				echo 1;
			}else{
				echo "No se pudo modificar el banner";
			}
			exit();
		}
	//Mostrar banner
		if($opc=='B_05'){
			$consulta = "SELECT bannerID,banner,descripcion,link,prioridad,estado
	              from banner WHERE estado<3 order by prioridad desc ";
			$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
			while($row = mysqli_fetch_row($res)){
				echo "
						<div class='col-md-4'>
	            <img class='img-responsive'  src='".$row[1]."'>
	            <div id='opciones' style='padding:3px 0px 15px 0px;'>
	              <button class='btn btn-default btn-sm active' onclick='editarEstadoBanner('1','".$row[0]."');' title='Activar'><i class='fa fa-square text-green'></i></button>
	              <button style='margin-left:-5px;' class='btn btn-default btn-sm' onclick='editarEstadoBanner('2','".$row[0]."');' title='Inactivar'><i class='fa fa-square text-red'></i></button>
	              <button class='btn btn-danger btn-sm pull-right' onclick='editarEstadoBanner('".$row[0]."');' title='Eliminar'><i class='fa fa-times'></i></button>
	            </div>            
	          </div>
	          <!-- Imagen -->
					";		
			}
			exit();
		}


	//CARGAR COMBO CONDICIÓN DE PAGO
	if($opc=='CC_FP'){
		$consulta = "SELECT formaPagoID,formaPago FROM forma_pago where estado='1'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='0'>--Seleccionar--</option>";
		while($row = mysqli_fetch_row($res)){	
			echo "<option value='".$row[0]."'>".$row[0]."-".$row[1]."</option>";
		}
		exit();
	}

 ?>