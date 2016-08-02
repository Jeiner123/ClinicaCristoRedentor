<?php include '../../general/variables.php';?>
<?php
	require('../../bd/bd_conexion.php');
	$opc = $_POST['opc'];
// ESPECIALIDADES
	// cargar tabla especialidades
	if($opc=='E_01'){
		$consulta = "select especialidadID,especialidad,estado from especialidad where estado<3";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){
			if (utf8_decode($row[2]) == '1'){
					$color= "text-green";
	        $class= "fa fa-circle";
	        $title = "Activo";
	        $estado = $row[2];
	    }
	    else{
	        $color="text-red";
	        $class= "fa fa-circle";
	        $title = "Inactivo";
	        $estado = $row[2];
	    }
			echo "<tr>
							<td style='text-align:center;'>".$row[0]."</td>
							<td>".$row[1]."</td>
							<td style='text-align:center;'>".$row[2]."</td>
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
									<a href='javascrip:;' class='text-blue' onclick='mostrarEspecialidad(".$row[0].",\"".$row[1]."\",".$row[2].");' style='margin-right:7px;'>
				              <i class='fa fa-search' title='Ver'></i>
				          </a>
			            <a href='javascrip:;' class='text-yellow' onclick='modificarEspecialidad(".$row[0].",\"".$row[1]."\",".$row[2].");' style='margin-right:7px;'>
			                <i class='fa fa-pencil' title='Modificar'></i>
			            </a>			            
			            <a href='javascrip:;' class='text-red' onclick='eliminarEspecialidad(".$row[0].");' style='margin-right:7px;'>
			                <i class='fa fa-trash' title='Eliminar'></i>
			            </a>
			          </div>
							</td>
						</tr>";
		}
		exit();
	}
	//Insertar especialidad
	if($opc=='E_02'){
		$espec = $_POST['txtEspecialidad'];
		$estado = $_POST['cboEstado'];
		$consulta = "insert into especialidad(especialidad,estado) values
									('".$espec."','".$estado."')";
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if($res){
			echo 1;
		}else{
			echo "No se pudo registrar la especialidad";
		}
		exit();
	}
	// Modificar  especialidad
	if($opc=='E_03'){
		$especID = $_POST['txtEspecialidadID'];
		$espec = $_POST['txtEspecialidad'];
		$estado = $_POST['cboEstado'];
		$consulta = "update especialidad set especialidad='".$espec."', estado='".$estado."'
								 where especialidadID = '".$especID."'";

		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if($res){
			echo 1;
		}else{
			echo "No se pudo modificar la especialidad";
		}
		exit();
	}
	// Editar estado especialidad
	if($opc=='E_04'){
		$estado = $_POST['estado'];
		$especID = $_POST['especialidadID'];
		$consulta = "update especialidad set estado='".$estado."'where especialidadID='".$especID."'";

		$res = mysqli_query($con,$consulta)or die(mysqli_error($con));

		if($res){
			echo 1;
		}else{
			echo "No se pudo realizar la operación.";
		}
		exit();
	}
// SERVICIOS
	// Cargar tabla
	if($opc=='S_01'){
		$consulta = "select S.servicioID,S.servicio,S.precioUnitario,S.estado,E.especialidad,
											E.especialidadID,T.tipoServicio,T.tipoServicioID
									from servicio S
									left join tipo_servicio T on S.tipoServicioID = T.tipoServicioID
									inner join especialidad E on E.especialidadID = S.especialidadID
									where S.estado<3";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){
			if (utf8_decode($row[3]) == '1'){
					$color= "text-green";
          $class= "fa fa-circle";
          $title = "Activo";
          $estado = $row[3];
      }
      else{
          $color="text-red";
          $class= "fa fa-circle";
          $title = "Inactivo";
          $estado = $row[3];
      }
			echo "<tr>					
					<td>".$row[0]."</td>
					<td>".$row[1]."</td>
					<td style='text-align: right;'><div style='padding-right:25px;'>".$row[2]."</div></td>		
					<td>".$row[4]."</td>
					<td>".$row[5]."</td>
					<td>".substr($row[6],0,12)."</td>
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
							<a href='javascrip:;' class='text-blue' onclick='mostrarServicio(".$row[0].");' style='margin-right:7px;'>
		              <i class='fa fa-search' title='Ver servicio'></i>
		          </a>
	            <a href='javascrip:;' class='text-yellow' onclick='modificarServicio(".$row[0].");' style='margin-right:7px;'>
	                <i class='fa fa-pencil' title='Modificar servicio'></i>
	            </a>
	            
	            <a href='javascrip:;' class='text-red' onclick='eliminarServicio(".$row[0].");' style='margin-right:7px;'>
	                <i class='fa fa-trash' title='Eliminar'></i>
	            </a>
	          </div>
					</td>
				</tr>";
		}
		exit();
	}
	// insertar 
	if($opc=='S_02'){
		$servicio = $_POST['txtServicio'];
		$precio = $_POST['txtPrecio'];
		$estado = $_POST['cboEstado'];
		$tsID = $_POST['cboTipoServicio'];
		$especID = $_POST['cboEspecialidad'];

		$consulta = "insert into servicio(servicio,preciounitario,estado,tipoServicioID,especialidadID) 
								values('".$servicio."','".$precio."','".$estado."','".$tsID."','".$especID."')";

		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if($res){
			echo 1;
		}else{
			echo "No se pudo registrar el servicio";
		}
		exit();
	}
	// Modificar 
	if($opc=='S_03'){
		$servicioID = $_POST['txtServicioID'];
		$servicio = $_POST['txtServicio'];
		$precio = $_POST['txtPrecio'];
		$estado = $_POST['cboEstado'];
		$tsID = $_POST['cboTipoServicio'];
		$especID = $_POST['cboEspecialidad'];

		$consulta = "update servicio set servicio='".$servicio."', precioUnitario='".$precio."',
								estado = '".$estado."',tipoServicioID='".$tsID."', especialidadID='".$especID."'
								 where servicioID = '".$servicioID."'";

		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if($res){
			echo 1;
		}else{
			echo "No se pudo modificar el servicio";
		}
		exit();
	}
	// Editar estado 
	if($opc=='S_04'){
		$estado = $_POST['estado'];
		$servicioID = $_POST['servicioID'];
		$consulta = "update servicio set estado='".$estado."'where servicioID='".$servicioID."'";

		$res = mysqli_query($con,$consulta)or die(mysqli_error($con));

		if($res){
			echo 1;
		}else{
			echo "No se pudo realizar la operación.";
		}
		exit();
	}
	//Mostrar Datos
	if($opc=='S_05'){
		$servicioID = $_POST['servicioID'];
		$consulta = "select servicioID,servicio,precioUnitario,estado,tipoServicioID,especialidadID
									from servicio where estado<3 and servicioID='".$servicioID."'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		$row = mysqli_fetch_row($res);
		echo json_encode($row);
		exit();
	}

?>