<?php include '../../general/variables.php';?>
<?php
	require('../../bd/bd_conexion.php');
	$opc = $_POST['opc'];

	// INSERTAR PERSONA-PACIENTE
	if($opc=='CC_01'){
		$entidad = $_POST['cboEntidad'];
		$tipoDocumento = $_POST['cboDocumento'];
		$documento = $_POST['txtDocumento'];
		$razonSocial=$_POST['txtRazonSocial'];
		$direccion=$_POST['txtDireccion'];
		$nombre = $_POST['txtNombre'];
		$apPat = $_POST['txtApellidoPat'];
		$apMat = $_POST['txtApellidoMat'];
		$telefono = $_POST['txtTelefono'];
		$direccion=$_POST['txtDireccion'];
		$emailE=$_POST['txtEmailE'];
		$banco=$_POST['cboBanco'];
		$cuenta=$_POST['txtDetraccion'];
		$emailP=$_POST['txtEmail'];
		$observacion=$_POST['txtObservaciones'];
		
		$consulta = "insert into PROVEEDOR values('".$documento."','".$entidad."','".$tipoDocumento."','".$razonSocial."','".$emailE."','".$direccion."','".$banco."','".$cuenta."','".$nombre."','".$apPat."','".$apMat."','".$telefono."','".$emailP."','".$observacion."','A')";
			
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if(!$res){
			echo "No se pudo registrar la persona";
		}else{
			echo "registro correcto";
		}

		exit();
	}

	if($opc=='CC_02'){
		$consulta = "select * from PROVEEDOR where estado='A'";
	
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
			while($row = mysqli_fetch_row($res)){
				if (utf8_decode($row[14]) == 'A'){
					$color= "text-green";
			        $class= "fa fa-circle";
			        $title = "Activo";
			        $estado = $row[14];
			    }
			    else{
			        $color="text-red";
			        $class= "fa fa-circle";
			        $title = "Inactivo";
			        $estado = $row[14];
			    }
				echo "<tr>					
						<td>".$row[0]."</td>
						<td>".$row[3]."</td>		
						<td>".$row[8]." ".$row[9]." ".$row[10]."</td>
						<td style='text-align:center'>".$row[11]."</td>
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
								<a href='javascrip:;' class='text-blue' onclick='verProveedor(".$row[0].");' style='margin-right:7px;'>
			              		<i class='fa fa-search' title='Ver'></i>
			          		</a>
				            <a href='javascrip:;' class='text-yellow' onclick='modificarProveedor(".$row[0].");' style='margin-right:7px;'>
				                <i class='fa fa-pencil' title='Modificar'></i>
				            </a>			            
				            <a href='javascrip:;' class='text-red' onclick='eliminarProveedor(".$row[0].");' style='margin-right:7px;'>
				                <i class='fa fa-trash' title='Eliminar'></i>
				            </a>
				          </div>
							</td>
					</tr>";
		}
			
	}

	if($opc=='CC_03'){
		$documento = $_POST['documento'];
		$sql = "SELECT * from proveedor where proveedorID=$documento";
		$resulset = mysqli_query($con,$sql);
 		$datos=array();
	    while($row = mysqli_fetch_assoc($resulset))
	    {
	        $datos[] = $row;
	        
	    }
		
		echo json_encode($datos);
		exit();	
	}

	if($opc=='CC_04'){
		$documento = $_POST['txtDocumento'];
		$razonSocial=$_POST['txtRazonSocial'];
		$direccion=$_POST['txtDireccion'];
		$nombre = $_POST['txtNombre'];
		$apPat = $_POST['txtApellidoPat'];
		$apMat = $_POST['txtApellidoMat'];
		$telefono = $_POST['txtTelefono'];
		$direccion=$_POST['txtDireccion'];
		$emailE=$_POST['txtEmailE'];
		$banco=$_POST['cboBanco'];
		$cuenta=$_POST['txtDetraccion'];
		$emailP=$_POST['txtEmail'];
		$observacion=$_POST['txtObservaciones'];

		$consulta = "UPDATE proveedor set razonSocial='$razonSocial',emailEmpresa='$emailE',direccion='$direccion',banco='$banco',cuentaBanco='$cuenta',nombres='$nombre',apellidoPat='$apPat',apellidoMat='$apMat',telefono='$telefono',emailPersonal='$emailP',observaciones='$observacion' where proveedorID=$documento";
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if($res){
			echo "Proveedor actualizado";
		}else{
			echo "Error con la actualización del proveedor";
		}
		exit();
	}

	if($opc=='CC_05'){
		$documento = $_POST['documento'];
		$consulta = "UPDATE proveedor set estado='I' where proveedorID=$documento";
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if($res){
			echo "Proveedor actualizado";
		}else{
			echo "Error con la actualización del proveedor";
		}
		exit();
	}

	if($opc=='CC_06'){
		$consulta = "SELECT proveedorID,IF(tipoEntidad=1,concat(nombres,' ',apellidoPat,' ',apellidoMat),razonSocial),telefono FROM `proveedor` where estado='A'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			
			echo "<tr>
					<td >".$row[0]."</td>
					<td>".$row[1]."</td>
					<td style='text-align:center;'>".$row[2]."</td>
					<td style='text-align:center;'>
						<div class='action-buttons'>
							<a href='javascrip:;' class='text-blue' onclick='seleccionarProveedor(\"".$row[0]."\",\"".$row[0]." - ".$row[1]."\");' style='margin-right:7px;'>
				              <u>Seleccionar</u>
				          </a>	            
			          </div>
					</td>
				</tr>";
		}
		exit();
	}

	if($opc=='CC_07'){
		$consulta = "SELECT codigo,descripcion from TIPO_TRANSACCION where tipo='C'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			
			echo "<tr>
					<td >".$row[0]."</td>
					<td>".$row[1]."</td>
					<td style='text-align:center;'>
						<div class='action-buttons'>
							<a href='javascrip:;' class='text-blue' onclick='seleccionarTCompra(\"".$row[0]."\",\"".$row[0]." - ".$row[1]."\");' style='margin-right:7px;'>
				              <u>Seleccionar</u>
				          </a>	            
			          </div>
					</td>
				</tr>";
		}
		exit();
	}
	
	if($opc=='CC_08'){
		$consulta = "SELECT comprobanteID,descripcion FROM `comprobante_pago` WHERE compras=1";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			
			echo "<tr>
					<td >".$row[0]."</td>
					<td>".$row[1]."</td>
					<td style='text-align:center;'>
						<div class='action-buttons'>
							<a href='javascrip:;' class='text-blue' onclick='seleccionarTComprobante(\"".$row[0]."\",\"".$row[0]." - ".$row[1]."\");' style='margin-right:7px;'>
				              <u>Seleccionar</u>
				          </a>	            
			          </div>
					</td>
				</tr>";
		}
		exit();
	}

	if($opc=='CC_09'){
		$consulta = "SELECT * FROM `PRODUCTO` WHERE estado='A'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			
			echo "<tr>
					<td >".$row[0]."</td>
					<td>".$row[1]."</td>
					<td style='text-align:center;'>
						<div class='action-buttons'>
							<a href='javascrip:;' class='text-blue' onclick='seleccionarProducto(\"".$row[0]."\",\"".$row[1]."\");' style='margin-right:7px;'>
				              <u>Seleccionar</u>
				          </a>	
				          <a href='javascrip:;' class='text-blue' onclick='eliminarProducto(\"".$row[0]."\",\"".$row[1]."\");' style='margin-right:7px;'>
				              <u>Eliminar</u>
				          </a>	            
			          </div>
					</td>
				</tr>";
		}
		exit();
	}
?>


	
	
