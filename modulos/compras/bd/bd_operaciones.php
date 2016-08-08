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
		$consulta = "SELECT proveedorID,IF(razonSocial='',UPPER(concat(nombres,' ',apellidoPat,' ',apellidoMat)),UPPER(razonSocial)) FROM `proveedor` where estado='A'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='0'>-- Seleccionar --</option>";
		while($row = mysqli_fetch_row($res)){	
			echo "<option value='".$row[0]."'>".$row[0]." - ".$row[1]."</option>";
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

	//INSERTAR COMPRA
	if($opc=='CC_08'){
		$mes = $_POST['txtMes'];
		$anio = $_POST['txtAnio'];
		$consulta = "SELECT IFNULL(MAX(codigo)+1,1) FROM `compra` WHERE mesID=$mes and anio=$anio";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			$codigo=$row[0];
		}

		$fecha=$fechaHoyAMD;
		$comprobanteID=$_POST['cboComprobante'];
		$proveedorID=$_POST['cboProveedor'];
		$serie=$_POST['txtSerie'];
		$numero=$_POST['txtNumero'];
		$fechaEmision = $_POST['txtFechaEmision'];
		$fechaVencimiento = $_POST['txtFechaVcto'];

		$fechaEmision = str_replace("/","-",$fechaEmision);
	  	$fechaEmision = date('Y-m-d',strtotime($fechaEmision));

		$fechaVencimiento = str_replace("/","-",$fechaVencimiento);
	  	$fechaVencimiento = date('Y-m-d',strtotime($fechaVencimiento));

		
		$moneda = $_POST['cboMoneda'];
		$formaPagoID = $_POST['cboModalidadPago'];
		$tipoAdquisicionID = $_POST['cboAdquisicion'];
		$tipoExistencia = $_POST['cboTipoExistencia'];
		$IGV = $_POST['cboIGV'];
		$detraccion = $_POST['cboDetraccion'];
		$percepcion = $_POST['cboPercepcion'];
		$renta = $_POST['cboRenta'];
		$totalBruto = $_POST['txtTotalBruto'];
		$descuento = $_POST['txtDescuento'];
		$valorVenta = $_POST['txtValorVenta'];
		$impuesto = $_POST['txtIGV'];
		$precioVenta = $_POST['txtPrecioVenta'];

		$consulta = "INSERT INTO compra VALUES(".$mes.",".$anio.",".$codigo.",'".$fecha."','".$comprobanteID."','".$proveedorID."','".$serie."','".$numero."','".$fechaEmision."','".$fechaVencimiento."','".$moneda."','".$formaPagoID."','".$tipoAdquisicionID."','".$tipoExistencia."','".$IGV."','".$detraccion."','".$percepcion."','".$renta."','".$totalBruto."','".$descuento."','".$valorVenta."','".$impuesto."','".$precioVenta."','D')";
			
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if(!$res){
			echo 0;
		}else{
			echo 1;
		}

		exit();
	}

	//INSERTAR DETALLE DE LA COMPRA
	if($opc=='CC_09'){
		$item = $_POST['item'];
		$mes = $_POST['txtMes'];
		$anio = $_POST['txtAnio'];
		$consulta = "SELECT IFNULL(MAX(codigo),1) FROM `compra` WHERE mesID=$mes and anio=$anio";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			$codigo=$row[0];
		}

		$descripcion = $_POST['txtDescripcion'.$item];
		$cantidad = $_POST['txtCantidad'.$item];
		$costo = $_POST['txtCosto'.$item];
		$importe = $_POST['txtImporte'.$item];

		$consulta = "INSERT INTO detalle_compra VALUES(".$mes.",".$anio.",".$codigo.",".$item.",'','','".$descripcion."',".$cantidad.",'".$costo."','".$importe."')";
			
		mysqli_query($con,$consulta)or  die (mysqli_error($con));
		
		exit();
	}

	//LISTAR DOCUMENTOS DE COMPRA
	if($opc=='CC_10'){
		$consulta = "select mesID,anio,codigo,serie,numero,fechaEmision,fechaVencimiento,precioVenta,estado from compra";
	
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
			while($row = mysqli_fetch_row($res)){
				$mes=$row[0];
				$anio=$row[1];
				$codigo=$row[2];

				if($row[8]=='V'){
					$estado = "<span class='label label-warning'>Vencido</span>";
				}else{
					if($row[8]=='D'){
						$estado = "<span class='label label-primary'>Pendiente</span>";
					}else{
						if($row[8]=='P'){
							$estado = "<span class='label label-success'>Pagado</span>";
						}else{
							if($row[8]=='A'){
								$estado = "<span class='label label-danger'>Anulado</span>";
							}
						}
					}
				}

				echo "<tr>					
						<td>".$meses[$mes]."-".$anio."</td>		
						<td style='text-align:center;'>".$row[3]."</td>		
						<td style='text-align:center;'>".$row[4]."</td>		
						<td style='text-align:center;'>".$row[5]."</td>
						<td style='text-align:center;'>".$row[6]."</td>
						<td style='text-align:right;'>".$row[7]."</td>
						<td style='text-align:center;'>".$estado."</td>
						<td style='text-align:center;'>
							<div>
	              <div class='inline pos-rel dropup'>
	                <button  class='btn btn-secundary btn-flat btn-lista-flotante dropdown-toggle btn-xs'  data-toggle='dropdown' data-position='auto' aria-expanded='true'>
	                    <i class='ace-icon fa fa-caret-down icon-only bigger-120'></i>
	                </button>

	                <ul class='lista-flotante dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close '>
	                  <li>
	                      <button type='button' class='btn btn-block btn-transparente btn-flat btn-xs' onclick='RegistrarPagoCompra(\"".$mes."\",\"".$anio."\",\"".$codigo."\")'>
	                      	<span class='text-blue'>
	                          <i class='ace-icon fa fa-usd bigger-120'></i>
	                          Facturación
	                        </span>
												</button>
	                  </li>
	                  <li>
	                  	<form method='post' action='../compras/facturas.php'>
				                <input type='hidden' id='txtmesID' name='txtmesID' value='".$mes."'>
				                <input type='hidden' id='txtAnioID' name='txtAnioID' value='".$anio."'>
				                <input type='hidden' id='txtNum' name='txtNum' value='".$codigo."'>
				                <input type='hidden' id='txtOpcion' name='txtOpcion' value='V'>												  	
	                      <button type='submit' class='btn btn-block btn-transparente btn-flat btn-xs'>
	                      	<span class='text-blue'>
	                          <i class='ace-icon fa fa-search bigger-120'></i>
	                          Ver detalle
	                        </span>
						  </button>
				        </form>
	                  </li>
	                </ul>
	              </div>
						</td>
					</tr>";
		}	
	}

	if($opc=='CC_11'){
		$mes = $_POST['mes'];
		$anio = $_POST['anio'];
		$codigo = $_POST['codigo'];
		$sql = "SELECT comprobanteID,formaPagoID,proveedorID,tipoExistencia,tipoAdquisicionID,detraccion,DATE_FORMAT(fecha, '%d-%m-%Y') as fecha,serie,numero,DATE_FORMAT(fechaEmision, '%d-%m-%Y') as fechaEmision,DATE_FORMAT(fechaVencimiento, '%d-%m-%Y') as fechaVencimiento,moneda,IGV,percepcion,renta,totalBruto,descuento,valorVenta,impuesto,precioVenta from compra where mesID=$mes and anio=$anio and codigo=$codigo";
		$resulset = mysqli_query($con,$sql);
 		$datos=array();
	    while($row = mysqli_fetch_assoc($resulset))
	    {
	        $datos[] = $row;
	        
	    }
		
		echo json_encode($datos);
		exit();	
	}

?>


	
	
