<?php include '../../general/variables.php';?>
<?php
	require('../../bd/bd_conexion.php');
	$opc = $_POST['opc'];
// PEROSNAL
	// MOSTRAR DATOS DEL PERSONAL
	if($opc == 'MP_01'){
		$personalID = $_POST['personalID'];
		$consulta = "SELECT PE.DNI,PE.nombres,PE.apPaterno,PE.apMaterno,PE.fechaNacimiento,PE.sexo,
								PE.telefono1,PE.tipoTelefono1,PE.telefono2,PE.tipoTelefono2,
								PE.correoPersonal,PE.direccion,PE.foto,PE.timestamp,
								PL.personalID,PL.tipoPersonalID,PL.cargoID,C.areaID,PL.fechaIngreso,
								PL.correoCorporativo,PL.sueldoMensual,PL.estado,PL.observaciones
								FROM PERSONAL PL
								INNER JOIN PERSONA PE ON PE.personaID = PL.personaID
								LEFT 	JOIN CARGO C ON PL.cargoID = C.cargoID
								WHERE PL.personalID='".$personalID."'
								";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		$row = mysqli_fetch_row($res);
		echo json_encode($row);
		exit();
	}
	// INSERT PERSONAL
	if($opc=='PL_02'){
		// Datos de la persona
		$DNI = $_POST['txtDNI'];
		$nombres = $_POST['txtNombres'];
		$apPaterno = $_POST['txtPaterno'];
		$apMaterno = $_POST['txtMaterno'];
		$fechaNacimiento = $_POST['txtFechaN'];
		$sexo = $_POST['cboSexo'];
		$telefono1 = $_POST['txtTelefono1'];
		$tipoTelefono1 = $_POST['cboTipoTelefono1'];
		$telefono2 = $_POST['txtTelefono2'];
		$tipoTelefono2 = $_POST['cboTipoTelefono2'];
		$correoPersonal = $_POST['txtCorreoP'];
		$direccion = $_POST['txtDireccion'];
		// $foto = $_POST['txtFoto'];
		// $timestamp = $timestamp;

		$consulta = "INSERT INTO persona(DNI,nombres,apPaterno,apMaterno,fechaNacimiento,sexo,
								telefono1,tipoTelefono1,telefono2,tipoTelefono2,
								correoPersonal,direccion,foto,timestamp) values
								('".$DNI."','".$nombres."','".$apPaterno."','".$apMaterno."','".$fechaNacimiento."',
								'".$sexo."','".$telefono1."','".$tipoTelefono1."',".$telefono2.",
								'".$tipoTelefono2."','".$correoPersonal."','".$direccion."',null,'".$timestamp."')";
		if($tipoTelefono2==0){
			$consulta = "INSERT INTO persona(DNI,nombres,apPaterno,apMaterno,fechaNacimiento,sexo,
								telefono1,tipoTelefono1,correoPersonal,direccion,foto,timestamp) values
								('".$DNI."','".$nombres."','".$apPaterno."','".$apMaterno."','".$fechaNacimiento."',
								'".$sexo."','".$telefono1."','".$tipoTelefono1."',
								'".$correoPersonal."','".$direccion."',null,'".$timestamp."')";
		}			
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if(!$res){
			echo "No se pudo registrar la persona";
		}
		// PersonalID
		// $DNI
		$tipoPersonalID = $_POST['cboTipoPersonal'];
		$cargoID = $_POST['cboCargo'];			
		$fechaIngreso = $_POST['txtFechaI'];
		$correoCorporativo = $_POST['txtCorreoC'];
		$sueldoMensual = $_POST['txtSueldo'];
		$estado = $_POST['cboEstado'];
		$observaciones = $_POST['txtObservaciones'];

		$consulta = "INSERT INTO personal(DNI,tipoPersonalID,cargoID,fechaIngreso,correoCorporativo,
								sueldoMensual,estado,observaciones) values
								('".$DNI."','".$tipoPersonalID."','".$cargoID."',
									'".$fechaIngreso."','".$correoCorporativo."','".$sueldoMensual."',
									'".$estado."','".$observaciones."')";

		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if(!$res){
			echo "No se pudo registrar el personal";
		}
		echo 1;
		exit();
	}
	// VERIFICAR SI EXISTE
	
	// CARGAR TABLA DE PERSONAL
	if($opc=='CT_P_01'){
		$tipoPersonal = $_POST["tipoPersonal"];
		$consulta = "SELECT P.DNI,PL.personalID,P.nombres,P.apPaterno,P.apMaterno,P.telefono1,TT.tipoTelefono,
								TP.tipoPersonal,PL.estado
								FROM personal PL
								INNER JOIN persona P on P.DNI = PL.DNI
								LEFT JOIN tipo_telefono TT on TT.tipoTelefonoID = P.tipoTelefono1
								INNER JOIN tipo_personal TP on TP.tipoPersonalID = PL.tipoPersonalID
								LEFT JOIN cargo C on C.cargoID = PL.cargoID
								LEFT JOIN area A on A.areaID = C.areaID
								WHERE PL.estado <=2
								";
		if($tipoPersonal!='T'){  //TODOS
			$consulta = $consulta.'and PL.tipoPersonalID<="'.$tipoPersonal.'"';
		}
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){
			if (utf8_decode($row[8]) == '1'){
					$color= "text-green";
          $class= "fa fa-circle";
          $title = "Activo";
          $estado = $row[8];
      }
      else{
          $color="text-red";
          $class= "fa fa-circle";
          $title = "Inactivo";
          $estado = $row[8];
      }
			echo "<tr>					
					<td style='text-align:center;'>".$row[1]."</td>
					<td style='text-align:center;'>".$row[0]."</td>
					<td>".$row[2].' '.$row[3].' '.$row[4]."</div></td>		
					<td>".$row[5].' - '.$row[6]."</td>
					<td>".$row[7]."</td>
					<td style='text-align:center;'>
						<label hidden>".$estado."</label>
						<div class='action-buttons'>
							<a href='javascrip:;' class='".$color."'>
	                <i class='".$class."' title='".$title."'></i>
	            </a>
	           </div>
	        </td>
					<td style='text-align:center;'>
						<div class='action-buttons'>
							<a href='javascrip:;' class='text-blue' onclick='mostrarPersonal(\"".$row[1]."\");' style='margin-right:7px;'>
		              <i class='fa fa-search' title='Ver'></i>
		          </a>
	            <a href='javascrip:;' class='text-yellow' onclick='modificarPersonal(".$row[1].");' style='margin-right:7px;'>
	                <i class='fa fa-pencil' title='Modificar'></i>
	            </a>	            
	            <a href='javascrip:;' class='text-red' onclick='eliminarPersonal(".$row[0].");' style='margin-right:7px;'>
	                <i class='fa fa-trash' title='Eliminar'></i>
	            </a>
	          </div>
					</td>
				</tr>";
		}
		exit();
	}
	//CARGAR TABLA DE MEDICOS Y PEROSNAL DE SALUD
	if($opc=='CT_P_02'){
		$consulta = "SELECT P.DNI,PL.personalID,P.nombres,P.apPaterno,P.apMaterno,P.telefono1,TT.tipoTelefono,
								TP.tipoPersonal,PL.estado
								FROM personal PL
								INNER JOIN persona P on P.DNI = PL.DNI
								LEFT JOIN tipo_telefono TT on TT.tipoTelefonoID = P.tipoTelefono1
								INNER JOIN tipo_personal TP on TP.tipoPersonalID = PL.tipoPersonalID
								LEFT JOIN cargo C on C.cargoID = PL.cargoID
								LEFT JOIN area A on A.areaID = C.areaID
								WHERE PL.estado <=2 and PL.tipoPersona<=2
								";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){
			if (utf8_decode($row[8]) == '1'){
					$color= "text-green";
          $class= "fa fa-circle";
          $title = "Activo";
          $estado = $row[8];
      }
      else{
          $color="text-red";
          $class= "fa fa-circle";
          $title = "Inactivo";
          $estado = $row[8];
      }
			echo "<tr>					
					<td style='text-align:center;'>".$row[1]."</td>
					<td style='text-align:center;'>".$row[0]."</td>
					<td>".$row[2].' '.$row[3].' '.$row[4]."</div></td>		
					<td>".$row[5].' - '.$row[6]."</td>
					<td>".$row[7]."</td>					
					<td style='text-align:center;'>
						<label hidden>".$estado."</label>
						<div class='action-buttons'>
							<a href='javascrip:;' class='".$color."'>
	                <i class='".$class."' title='".$title."'></i>
	            </a>
	           </div>
	        </td>
					<td style='text-align:center;'>
						<div class='action-buttons'>
							<a href='javascrip:;' class='text-blue' onclick='mostrarPersonal(\"".$row[1]."\");' style='margin-right:7px;'>
		              <i class='fa fa-search' title='Ver'></i>
		          </a>
	            <a href='javascrip:;' class='text-yellow' onclick='modificarPersonal(".$row[1].");' style='margin-right:7px;'>
	                <i class='fa fa-pencil' title='Modificar'></i>
	            </a>	            
	            <a href='javascrip:;' class='text-red' onclick='eliminarPersonal(".$row[0].");' style='margin-right:7px;'>
	                <i class='fa fa-trash' title='Eliminar'></i>
	            </a>
	          </div>
					</td>
				</tr>";
		}
		exit();
	}
	//CARGAR ESPECIALIDADES DE UN MEDICO
	if($opc == 'CEM_01'){
		$personalID = $_POST['personalID'];
		$consulta = "SELECT PS.personalID,E.especialidadID,E.especialidad
								FROM PERSONAL_SALUD PS
								INNER JOIN ESPECIALIDAD E ON E.especialidadID = PS.especialidadID
								WHERE PS.personalID='".$personalID."'
								";
	  $res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){
			echo "<tr>					
					<td>".$row[2]."</td>
					<td>"."<a href='javascript:;' style='font-size:14px;' onclick='eliminarAsignacion(".$row[0].",".$row[1].")' class='text-red' title='Eliminar asignación'><i class='ace-icon fa fa-times bigger-120'></i></a>"."</td>
					</tr>";
		}

		exit();
	}
	//GUARDAR ESPECIALIDAD DE UN MEDICO
	if($opc == 'GAE_02'){
		$personalID = $_POST['personalID'];
		$especialidadID = $_POST['especialidadID'];
		$consulta = "INSERT INTO PERSONAL_SALUD(personalID,especialidadID) values('".$personalID."','".$especialidadID."')";
	  $res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if(!$res){
			echo "No se pudo registrar la asignación";
		}
		echo 1;
		exit();
	}
	//ELIMINAR ESPECIALIDAD DE UN MEDICO (ASIGNACION)
	if($opc == 'EAE_03'){
		$personalID = $_POST['personalID'];
		$especialidadID = $_POST['especialidadID'];
		$consulta = "DELETE FROM PERSONAL_SALUD WHERE personalID='".$personalID."' and especialidadID='".$especialidadID."'";
	  $res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if(!$res){
			echo "No se pudo eliminar la asignación";
		}
		echo 1;
		exit();
	}
	
?>