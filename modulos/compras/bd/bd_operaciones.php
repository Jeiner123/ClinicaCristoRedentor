<?php include '../../general/variables.php';?>
<?php
	require('../../bd/bd_conexion.php');
	$opc = $_POST['opc'];

	// INSERTAR PROVEEDOR
	if($opc=='CC_01'){
		$tipoDocumento = $_POST['cboDocumento'];
		$documento = $_POST['txtDocumento'];
		$razonSocial=$_POST['txtRazonSocial'];
		$direccion=$_POST['txtDireccion'];
		$emailE=$_POST['txtEmailE'];
		$condPago=$_POST['cboModalidadPago'];
		$banco=$_POST['cboBanco'];
		$cuentaDetraccion=$_POST['txtDetraccion'];
		$cuenta=$_POST['txtCuenta'];
		$nombre = $_POST['txtNombre'];
		$apPat = $_POST['txtApellidoPat'];
		$apMat = $_POST['txtApellidoMat'];
		$telefono = $_POST['txtTelefono'];
		$emailP=$_POST['txtEmail'];
		$observacion=$_POST['txtObservaciones'];
		$operador=$_POST['cboTipoTelefono1'];
		
		$consulta = "insert into PROVEEDOR values('".$documento."','".$tipoDocumento."','".$razonSocial."','".$emailE."','".$direccion."','".$condPago."','".$banco."','".$cuenta."','".$cuentaDetraccion."','".$nombre."','".$apPat."','".$apMat."','".$telefono."','".$operador."','".$emailP."','".$observacion."','A')";
			
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if(!$res){
			echo "No se pudo registrar la persona";
		}else{
			echo "registro correcto";
		}

		exit();
	}

	//LISTAR PROVEEDORES
	if($opc=='CC_02'){

		$consulta = "select proveedorID,IF(razonSocial='',UPPER(concat(nombres,' ',apellidoPat,' ',apellidoMat)),UPPER(razonSocial)),telefono,estado from PROVEEDOR where estado='A'";
	
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
			while($row = mysqli_fetch_row($res)){
				if (utf8_decode($row[3]) == 'A'){
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
						<td style='text-align:center'>".$row[2]."</td>
						<td style='text-align:center;'>
								<label hidden>".$estado."</label>
								<div class='action-buttons'>
									<a href='javascrip:;' class='".$color."'>
			                <i class='".$class."' title='".$title."'></i>
				            </a>
				           </div>
				        </td>
						<td style='text-align:center;'>
							<div class='row'>
								<div class='col-md-2 col-md-offset-1'>
								<form method='post' action='../compras/nuevo_proveedor.php'>
	                <input type='hidden' id='txtProveedorID' name='txtProveedorID' value='".$row[0]."'>
	                <input type='hidden' id='txtOpcion' name='txtOpcion' value='V'>						
	                <button type='submit' class='btn btn-block opcion btn-flat btn-xs'>
                  	<span class='text-blue'>
                      <i class='fa fa-search' title='Ver'></i>
                    </span>
					</button>
	              </form>
	              </div>
	              <div class='col-md-2'>
	              <form method='post' action='../compras/nuevo_proveedor.php'>
	                <input type='hidden' id='txtProveedorID' name='txtProveedorID' value='".$row[0]."'>	
	                <input type='hidden' id='txtOpcion' name='txtOpcion' value='M'>					
	                <button type='submit' class='btn btn-block opcion btn-flat btn-xs'>
                  	<span class='text-yellow'>
                      <i class='fa fa-pencil' title='Modificar'></i>
                    </span>
					</button>
	              </form>
	              </div>
	              <div class='col-md-2'>
	              	<a href='javascrip:;' class='text-red' onclick='eliminarProveedor(\"".$row[0]."\")' style='margin-right:7px;'>
		                <i class='fa fa-trash' title='Eliminar' style='margin-top:7px!important;'></i>
		            </a>	
	              </div>
					    </div>
						</td>
					</tr>";
		}
			
	}


	// VER DATOS DEL PROVEEDOR
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

	//EDITAR PROVEEDOR
	if($opc=='CC_04'){
		$documento = $_POST['txtDocumento'];
		$razonSocial=$_POST['txtRazonSocial'];
		$direccion=$_POST['txtDireccion'];
		$emailE=$_POST['txtEmailE'];
		$condPago=$_POST['cboModalidadPago'];
		$banco=$_POST['cboBanco'];
		$cuentaDetraccion=$_POST['txtDetraccion'];
		$cuenta=$_POST['txtCuenta'];
		$nombre = $_POST['txtNombre'];
		$apPat = $_POST['txtApellidoPat'];
		$apMat = $_POST['txtApellidoMat'];
		$telefono = $_POST['txtTelefono'];
		$emailP=$_POST['txtEmail'];
		$observacion=$_POST['txtObservaciones'];
		$operador=$_POST['cboTipoTelefono1'];

		$consulta = "UPDATE proveedor set razonSocial='$razonSocial',emailEmpresa='$emailE',direccion='$direccion',condPago='$condPago',banco='$banco',cuentaBanco='$cuenta',cuentaDetraccion='$cuentaDetraccion',nombres='$nombre',apellidoPat='$apPat',apellidoMat='$apMat',telefono='$telefono',tipoTelefono='$operador',emailPersonal='$emailP',observaciones='$observacion' where proveedorID=$documento";
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if($res){
			echo "Proveedor actualizado";
		}else{
			echo "Error con la actualización del proveedor";
		}
		exit();
	}

	//ELIMINAR PROVEEDOR
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

	//SELECTOR PROVEEDOR
	if($opc=='CC_06'){
		$consulta = "SELECT proveedorID,IF(razonSocial='',UPPER(concat(nombres,' ',apellidoPat,' ',apellidoMat)),UPPER(razonSocial)),telefono FROM `proveedor` where estado='A'";
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

	//SELECCIONAR LOS TIPOS DE EXISTENCIA
	if($opc=='CC_07'){
		$consulta = "SELECT codigo,descripcion from TIPO_EXISTENCIA where estado='A'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			
			echo "<option value='".$row[0]."'>".$row[0]." - ".$row[1]."</option>";
		}
		exit();
	}

	//SELECCIONAR EL COMPROBANTE DE PAGO
	if($opc=='CC_08'){
		$consulta = "SELECT comprobanteID,descripcion FROM `comprobante_pago` WHERE compras=1";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			echo "<option value='".$row[0]."'>".$row[0]." - ".$row[1]."</option>";
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


	
	
