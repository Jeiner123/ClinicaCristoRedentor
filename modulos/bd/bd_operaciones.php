<?php
	$opc = $_POST['opc'];
	$hoy = date('Y').'-'.date('m').'-'.date('d');
	$ImgPermitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
	$pdfPermitido = array("application/pdf");

	require('bd_conexion.php');

// CARGAR LISTAS
	// Cargar lista personalSalud
	if($opc=='CL_PS_01'){
		$especialidadID = $_POST["especialidadID"];
		$consulta = "SELECT PL.personalID,P.nombres,P.apPaterno,P.apMaterno,E.especialidad,E.especialidadID
								from personal_salud PS 
								INNER join PERSONAL PL on PL.personalID = PS.personalID
								INNER join PERSONA P on P.DNI = PL.DNI
								INNER join ESPECIALIDAD E on E.especialidadID = PS.especialidadID
								where PL.estado =1 and PL.tipoPersonalID<=2								
								";
		if($especialidadID!=0 && $especialidadID!=1){
			$consulta = $consulta." and PS.especialidadID='".$especialidadID."'";
		}
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){				
	    $nombreComp = $row[1].' '.$row[2].' '.$row[3];
			echo "<tr>
					<td style='text-align:center;'>".$row[0]."</td>
					<td>".$nombreComp."</div></td>
					<td>".$row[4]."</td>
					<td style='text-align:center;'>
						<div class='action-buttons'>
							<a href='javascrip:;' class='text-blue' onclick='seleccionarPersonalSalud(\"".$row[0]."\",\"".$row[5]."\",\"".$nombreComp."\");' style='margin-right:7px;'>
		             <u>Seleccionar</u>
		          </a>
	          </div>
					</td>
				</tr>";
		}
		exit();
	}
	//Cargar lista de personal de salud para referencia
	if($opc=='CL_PSR_01'){
		$especialidadID = $_POST["especialidadID"];
		$consulta = "SELECT PL.personalID,P.nombres,P.apPaterno,P.apMaterno,E.especialidad,E.especialidadID
								from personal_salud PS 
								INNER join PERSONAL PL on PL.personalID = PS.personalID
								INNER join PERSONA P on P.DNI = PL.DNI
								INNER join ESPECIALIDAD E on E.especialidadID = PS.especialidadID
								where PL.estado =1 and PL.tipoPersonalID<=2
								";
		if($especialidadID!=0 && $especialidadID!=1){
			$consulta = $consulta." and PS.especialidadID='".$especialidadID."'";
		}
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){				
	    $nombreComp = $row[1].' '.$row[2].' '.$row[3];
			echo "<tr>
					<td style='text-align:center;'>".$row[0]."</td>
					<td>".$nombreComp."</div></td>
					<td>".$row[4]."</td>
					<td style='text-align:center;'>
						<div class='action-buttons'>
							<a href='javascrip:;' class='text-blue' onclick='seleccionarPersonalSaludRef(\"".$row[0]."\",\"".$row[5]."\",\"".$nombreComp."\");' style='margin-right:7px;'>
		             <u>Seleccionar</u>
		          </a>
	          </div>
					</td>
				</tr>";
		}
		exit();
	}
	// Cargar lista pacientes
	if($opc=='CL_PAC_01'){
		$consulta = "SELECT P.DNI,PA.pacienteID,P.nombres,P.apPaterno,P.apMaterno,P.fechaNacimiento,
								P.telefono1,TT.tipoTelefono,PRO.procedencia
								from paciente PA
								INNER join persona P on PA.DNI = P.DNI
								left join tipo_Telefono TT on TT.tipoTelefono = P.tipoTelefono1
								left join procedencia PRO on PRO.procedenciaID = PA.procedenciaID
								where PA.estado <=2
								";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			$fecha = $row[5];		
			$fecha = str_replace("/","-",$fecha);
	    $fecha = date('Y/m/d',strtotime($fecha));
	    $hoy = date('Y/m/d');
	    $edad = $hoy - $fecha;
	    $nombreComp = $row[2].' '.$row[3].' '.$row[4];
			echo "<tr>
					<td style='text-align:center;'>".$row[1]."</td>
					<td style='text-align:center;'>".$row[0]."</td>
					<td>".$nombreComp."</div></td>
					<td style='text-align:center;'>".$edad."</td>
					<td>".$row[6].' - '.$row[7]."</td>
					<td>".$row[8]."</td>
					<td style='text-align:center;'>
						<div class='action-buttons'>
							<a href='javascrip:;' class='text-blue' onclick='seleccionarPaciente(\"".$row[0]."\",\"".$row[1]."\",\"".$nombreComp."\");' style='margin-right:7px;'>
		              <u>Seleccionar</u>
		          </a>	            
	          </div>
					</td>
				</tr>";
		}
		exit();
	}
	//Cargar Lista servicios sólo activos
	if($opc=='CL_S_01'){
		$consulta = "SELECT S.servicioID,S.servicio,S.precioUnitario,S.estado,E.especialidad,
											E.especialidadID,T.tipoServicio,T.tipoServicioID
									from servicio S
									left join tipo_servicio T on S.tipoServicioID = T.tipoServicioID
									INNER join especialidad E on E.especialidadID = S.especialidadID
									where S.estado=1";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){			
			echo "<tr>					
					<td style='text-align:center;'>".$row[0]."</td>
					<td>".$row[1]."</td>
					<td style='text-align: right;'><div style='padding-right:25px;'>".$row[2]."</div></td>		
					<td>".$row[4]."</td>
					<td>".$row[5]."</td>
					<td>".substr($row[6],0,12)."</td>
					<td>".$row[7]."</td>
					<td style='text-align:center;'>
						<div class='action-buttons'>
							<a href='javascrip:;' class='text-blue' onclick='seleccionarServicio(\"".$row[0]."\",\"".$row[1]."\",".$row[2].",".$row[7].",".$row[5].");' style='margin-right:7px;'>
		              <u>Seleccionar</u>
		          </a>	            
	          </div>
					</td>					
				</tr>";
		}
		exit();
	}
// CARGAR COMBOS

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
									from PERSONAL_SALUD PS
									INNER join PERSONAL PL on PL.personalID = PS.personalID
									INNER join PERSONA P on P.DNI = PL.DNI
									INNER join ESPECIALIDAD E on E.especialidadID = PS.especialidadID
									where PL.estado =1 and PL.tipoPersonalID<=2
									group by (PL.personalID)
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
								  from PACIENTE PA
								  INNER join PERSONA P ON PA.DNI = P.DNI
								  where PA.estado = 1 order by P.nombres
								  ";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='0'>-- Seleccionar paciente --</option>";
		while($row = mysqli_fetch_row($res)){
			$pacienteID = $row[1];
			$DNI = $row[0];
			$nombresP = explode(" ", $row[2]);
			$paciente = $nombresP[0].' '.$row[3].' '.$row[4];
			echo "<option value='".$pacienteID."'>".$DNI.' - '.$pacienteID.' - '.$paciente."</option>";
		}
		exit();
	}
	//CARGAR COMBO TIPO DE DOCUMENTO
	if($opc=='CC_TD'){
		$consulta = "SELECT tipoDocumentoID,tipoDocumento FROM tipo_documento where estado='A'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value=''>--Seleccionar--</option>";
		while($row = mysqli_fetch_row($res)){
			echo "<option value='".$row[0]."'>".$row[0]." - ".$row[1]."</option>";
		}
		exit();
	}

	//CARGAR COMBO ENTIDADES FINANCIERAS
	if($opc=='CC_EF'){
		$consulta = "SELECT entidadFinancieraID,entidadFinanciera FROM entidad_financiera where estado='A'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='00'>--Seleccionar--</option>";
		while($row = mysqli_fetch_row($res)){	
			echo "<option value='".$row[0]."'>".$row[0]." - ".$row[1]."</option>";
		}
		exit();
	}

	//CARGAR COMBO TIPO DE ADQUISICION
	if($opc=='CC_TA'){
		$consulta = "SELECT tipoAdquisicionID,tipoAdquisicion FROM tipo_adquisicion where estado='A'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='0'>--Seleccionar--</option>";
		while($row = mysqli_fetch_row($res)){	
			echo "<option value='".$row[0]."'>".$row[0]." - ".$row[1]."</option>";
		}
		exit();
	}
	// CCARGAR COMBO COMPROBANTE DE PAGO PARA VENTA	
	if($opc == 'CC_CV_01'){
		$consulta = "SELECT comprobanteID,descripcion from comprobante_pago where estado=1 and ventas=1";
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con) );
			echo "<option value='"."0"."'>-- Seleccionar --</option>";
		while($row = mysqli_fetch_row($res)){ 
			echo "<option value='".$row[0]."'>".$row[1]."</option>";
		}
		exit();
	}
	// AREAS
	if($opc=='CC_AR_01'){
		$consulta = "SELECT areaID,area from area where estado=1 order by area asc";
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
		$consulta = "SELECT cargoID,cargo from cargo where estado=1 and areaID='".$areaID."' order by cargo asc";
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con));
			echo "<option value='"."0"."'>-- Seleccionar --</option>";
		while($row = mysqli_fetch_row($res)){
			echo "<option value='".$row[0]."'>".$row[1]."</option>";
		}
		exit();
	}
	// Especialidades
	if($opc=='CC_E_05'){
		$consulta = "SELECT especialidadID,especialidad from especialidad where estado=1 order by especialidad asc";
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con));
			echo "<option value='"."0"."'>-- Especialidad --</option>";
		while($row = mysqli_fetch_row($res)){
			echo "<option value='".$row[0]."'>".$row[1]."</option>";
		}
		exit();
	}
	// Tipo de servicio
	if($opc=='TS_01'){
		$consulta = "SELECT tipoServicioID,tipoServicio from tipo_servicio where estado=1 order by tipoServicio asc";
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con));
			echo "<option value='"."0"."'>-- Tipo de servicio --</option>";
		while($row = mysqli_fetch_row($res)){
			echo "<option value='".$row[0]."'>".$row[1]."</option>";
		}
		exit();
	}
	//Tipo telefono
	if($opc=='CC_TT_01'){
		$consulta = "SELECT tipoTelefonoID,tipoTelefono from tipo_telefono where estado=1 order by tipoTelefono asc";
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con));
			echo "<option value='"."0"."'>-- Seleccionar --</option>";
		while($row = mysqli_fetch_row($res)){
			echo "<option value='".$row[0]."'>".$row[1]."</option>";
		}
		exit();
	}
	//Tipo PERSONAL 
	if($opc=='CC_TP_01'){
		$consulta = "SELECT tipoPersonalID,tipoPersonal from tipo_personal where estado=1 order by tipoPersonal asc";
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con));
			echo "<option value='"."0"."'>-- Seleccionar --</option>";
		while($row = mysqli_fetch_row($res)){
			echo "<option value='".$row[0]."'>".$row[1]."</option>";
		}
		exit();
	}
	//Procedencias 
	if($opc=='CC_P_01'){
		$consulta = "SELECT procedenciaID,procedencia from PROCEDENCIA where estado=1 order by procedencia asc";
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
							 from persona where DNI ='".$DNI."'";
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
	              from banner where estado=1 or estado=2 order by prioridad desc ";
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
			$consulta = "update banner set estado='".$estado."'where bannerID='".$bannerID."'";
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
									prioridad=".$prioridad.",estado=".$estado." where bannerID='".$bannerID."'";
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
	              from banner where estado<3 order by prioridad desc ";
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