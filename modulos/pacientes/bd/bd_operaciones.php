<?php include '../../general/variables.php';?>
<?php
	require('../../bd/bd_conexion.php');
	$opc = $_POST['opc'];

	// INSERTAR PERSONA-PACIENTE
	if($opc=='PA_02'){
		$registrarPersona = true;
		$registrarPaciente = true;
		$DNI = $_POST['txtDNI'];
		//Verificamos el DNI de la persona
		$consulta = "select * from persona where DNI ='".$DNI."'";
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
		if(mysqli_num_rows($res)>0){
			$registrarPersona = false;
			$consulta = "select pacienteID from paciente where DNI ='".$DNI."'";
			$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
			if(mysqli_num_rows($res)>0){
				$registrarPaciente = false;
				$row = mysqli_fetch_row($res);
				echo "El Paciente ya esta registrado. Su Historia Clínica es: ".$row[0];
				exit();
			}
		}
		if($registrarPersona){
			// Datos de la persona
			$nombres = strtoupper($_POST['txtNombres']);
			$apPaterno = strtoupper($_POST['txtPaterno']);
			$apMaterno = strtoupper($_POST['txtMaterno']);
			$fechaN = $_POST['txtFechaN'];
			$fechaN = str_replace("/","-",$fechaN);
		  $fechaN = date('Y/m/d',strtotime($fechaN));
			$sexo = $_POST['cboSexo'];
			$RUC = $_POST['txtRUC'];
			$telefono1 = $_POST['txtTelefono1'];
			$tipoTelefono1 = $_POST['cboTipoTelefono1'];
			$telefono2 = $_POST['txtTelefono2'];
			$tipoTelefono2 = $_POST['cboTipoTelefono2'];
			$correoP = $_POST['txtCorreoP'];		
			$direccion = $_POST['txtDireccion'];
			// $foto = $_POST['txtFoto'];
			$consulta = "insert into persona(DNI,nombres,apPaterno,apMaterno,fechaNacimiento,sexo,RUC,
									telefono1,tipoTelefono1,telefono2,tipoTelefono2,
									correoPersonal,direccion,foto,timestamp) values
									('".$DNI."','".$nombres."','".$apPaterno."','".$apMaterno."','".$fechaN."',
			 						'".$sexo."',
			 						".(($RUC=='')?'NULL':("'".$RUC."'")).",
			 						'".$telefono1."',
			 						".(($tipoTelefono1==0)?'NULL':("'".$tipoTelefono1."'")).",
			 						".(($telefono2=='')?'NULL':("'".$telefono2."'")).",
			 						".(($tipoTelefono2==0)?'NULL':("'".$tipoTelefono2."'")).",
			 						".(($correoP=='')?'NULL':("'".$correoP."'")).",
			 						".(($direccion=='')?'NULL':("'".$direccion."'")).",
			 						null,'".$timestamp."')";
			$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
			if(!$res){
				echo "No se pudo registrar la persona";
				exit();
			}
		}
		if($registrarPaciente){
			// pacienteID
			// $DNI
			// $familiarDNI = $_POST['cboTipoPersonal'];
			// $parentesco = $_POST['cboCargo'];
			$procedencia = $_POST['cboProcedencia'];
			$estado = $_POST['cboEstado'];		
			$observaciones = $_POST['txtObservaciones'];
			$consulta = "insert into paciente(DNI,familiarDNI,parentesco,procedenciaID,
									estado,observaciones) values
									('".$DNI."',null,null,
									".(($procedencia==0)?'NULL':("'".$procedencia."'")).",
									'".$estado."',
									".(($observaciones=='')?'NULL':("'".$observaciones."'")).")";
			$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
			if(!$res){
				echo "No se pudo registrar el paciente";
			}
			echo mysqli_insert_id($con);
			exit();
		}
		exit();
	}
	// CARGAR TABLA DE PACIENTES
	if($opc=='CTP_01'){
		$consulta = "select P.DNI,P.nombres,P.apPaterno,P.apMaterno,P.telefono1,TT.tipoTelefono,PA.pacienteID,
									PA.estado,P.fechaNacimiento
									from PACIENTE PA 
									inner join PERSONA P ON P.DNI = PA.DNI
									inner join TIPO_TELEFONO TT on TT.tipoTelefonoID = P.tipoTelefono1
								";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));		
		while($row = mysqli_fetch_row($res)){
			$historia = $row[6];
			$DNI = $row[0];
			$nombres = $row[1].' '.$row[2].' '.$row[3];
			$edad = $row[8];
			$fecha = str_replace("/","-",$row[8]);
	    $fecha = date('Y/m/d',strtotime($fecha));		    
	    $edad = $fechaHoyAMD - $fecha;		    
			$telefono = $row[4].' - '.$row[5];
			$ultimaVisita = "";
			$estado = "";
			if (utf8_decode($row[7]) == '1'){
					$color= "text-green";
          $class= "fa fa-circle";
          $title = "Activo";
          $estado = $row[7];
      }
      else{
          $color="text-red";
          $class= "fa fa-circle";
          $title = "Inactivo";
          $estado = $row[7];
      }
			echo "<tr>					
					<td style='text-align:center;'>".$historia."</td>
					<td style='text-align:center;'>".$DNI."</td>
					<td>".$nombres."</div></td>
					<td align='center'>".$edad."</div></td>
					<td>".$telefono."</td>
					<td>".$ultimaVisita."</div></td>
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
							<a href='paciente.php?historia=".$historia."&paciente=".$nombres."&opc=1' type='submit'  class='text-blue' style='margin-right:7px;'>
	                <i class='fa fa-search' title='Ver'></i>	                
	            </a>
	            <a href='javascrip:;' class='text-yellow' onclick='alert(\"No disponible\")' style='margin-right:7px;'>
	                <i class='fa fa-pencil' title='Modificar'></i>
	            </a>
	            <a href='javascrip:;' class='text-red' onclick='alert(\"No disponible\")' style='margin-right:7px;'>
	                <i class='fa fa-trash' title='Eliminar'></i>
	            </a>
	          </div>
					</td>
				</tr>";
		}
		exit();
	}
	//MOSTRAR DATOS DE UN PACIENTE
	if($opc == 'MPAC_02'){
		$historia = $_POST["historia"];
		$consulta = "select P.DNI,P.nombres,P.apPaterno,P.apMaterno,P.fechaNacimiento,P.sexo,
								P.telefono1,P.tipoTelefono1,P.telefono2,P.tipoTelefono2,P.correoPersonal,
								P.RUC,P.direccion,PA.pacienteID,PA.procedenciaID,PA.estado,
								PA.observaciones
								from PACIENTE PA
								inner join PERSONA P on PA.DNI = P.DNI
								where PA.pacienteID ='".$historia."'";
		$res = mysqli_query($con,$consulta)or die (mysqli_error($con));
		$datos = "";
		if(mysqli_num_rows($res)>0){

			$datos = mysqli_fetch_array($res);
			$fechaN = $datos[4];
			$fechaN = str_replace("/","-",$fechaN);
			$fechaN = date('d-m-Y',strtotime($fechaN));

			echo $datos[0].",,".$datos[1].",,".$datos[2].",,".$datos[3].",,".$fechaN.",,".$datos[5].",,".
					$datos[6].",,".	$datos[7].",,".$datos[8].",,".$datos[9].",,".$datos[10].",,".
					$datos[11].",,".$datos[12].",,".$datos[13].",,".$datos[14].",,".$datos[15].",,".
					$datos[16];

		}else{
			echo 0;
		}
		exit();
	}


?>