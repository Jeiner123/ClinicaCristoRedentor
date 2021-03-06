<?php include '../../general/variables.php';?>
<?php
	require('../../bd/bd_conexion.php');
	$opc = $_POST['opc'];

	//CARGAR COMBO PERIODOS DE COMPRA
	if($opc=='CC_PC'){
		$consulta = "SELECT DISTINCT(concat(mesID,'-',anio)),mesID,anio FROM compra WHERE estado<>'A'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='0'>--Seleccionar--</option>";
		while($row = mysqli_fetch_row($res)){	
			echo "<option value='".$row[0]."'>".$meses[$row[1]]." - ".$row[2]."</option>";
		}
		exit();
	}

	//CARGAR COMBO PERIODOS DE PAGO
	if($opc=='CC_PP'){
		$consulta = "SELECT DISTINCT(concat(mesID,'-',anio)),mesID,anio FROM pago_compra";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='0'>--Seleccionar--</option>";
		while($row = mysqli_fetch_row($res)){	
			echo "<option value='".$row[0]."'>".$meses[$row[1]]." - ".$row[2]."</option>";
		}
		exit();
	}

	//GENERAR CORRELATIVO PARA COMPRAS
	if($opc=='CC_GC'){
		$mes = $_POST['mes'];
		$anio = $_POST['anio'];
		$consulta = "SELECT IFNULL(MAX(codigo)+1,1) FROM compra where mesID=$mes and anio=$anio";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			$correlativo=$row[0];
		}
		echo $correlativo;
		exit();
	}

	// INSERTAR PROVEEDOR
	if($opc=='CC_01'){
		$tipoDocumento = $_POST['cboDocumento'];
		$documento = $_POST['txtDocumento'];
		$razonSocial=$_POST['txtRazonSocial'];
		$direccion=$_POST['txtDireccion'];
		$emailE='';
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
		$detalles = $_POST['detalles'];
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
		$valorDetraccion = $_POST['txtDetraccion'];
		$percepcion = $_POST['cboPercepcion'];
		$valorPercepcion = $_POST['txtPercepcion'];
		$renta = $_POST['cboRenta'];
		$valorRenta = $_POST['txtRenta'];
		$retencion = $_POST['cboRetencion'];
		$valorRetencion = $_POST['txtRetencion'];
		$totalBruto = $_POST['txtTotalBruto'];
		$descuento = $_POST['txtDescuento'];
		$valorVenta = $_POST['txtValorVenta'];
		$impuesto = $_POST['txtIGV'];
		$precioVenta = $_POST['txtPrecioVenta'];

		if($detraccion!=0){
			$saldoPagar=floatVal($precioVenta)-floatVal($valorDetraccion);
		}else{
			if($percepcion!=0){
				$saldoPagar=floatVal($precioVenta)+floatVal($valorPercepcion);
			}else{
				if($retencion!=0){
					$saldoPagar=floatVal($precioVenta)+floatVal($valorRetencion);
				}else{
					if($renta!=0){
						$saldoPagar=floatVal($precioVenta)-floatVal($valorRenta);
					}else{
						$saldoPagar=$precioVenta;
					}
				}
			}
		}

		$consulta = "INSERT INTO compra VALUES(".$mes.",".$anio.",".$codigo.",'".$fecha."','".$comprobanteID."','".$proveedorID."','".$serie."','".$numero."','".$fechaEmision."','".$fechaVencimiento."','".$moneda."','".$formaPagoID."','".$tipoAdquisicionID."','".$tipoExistencia."','".$IGV."','".$detraccion."','".$valorDetraccion."','".$percepcion."','".$valorPercepcion."','".$renta."','".$valorRenta."','".$retencion."','".$valorRetencion."','".$totalBruto."','".$descuento."','".$valorVenta."','".$impuesto."','".$precioVenta."','".$saldoPagar."','".$saldoPagar."','".$detalles."','D')";
			
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
		$query = "SELECT parametro,valor from parametro where parametroID=1 and estado=1";
		$res = mysqli_query($con,$query) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			$igv=$row[1];
		}

		$consulta = "select mesID,anio,codigo,serie,numero,DATE_FORMAT(fechaEmision, '%d-%m-%Y') as fechaEmision,DATE_FORMAT(fechaVencimiento, '%d-%m-%Y') as fechaVencimiento,saldoPagar, if(fechaVencimiento < DATE_FORMAT(NOW(),'%Y-%m-%d 00:00:00') and estado='D','V',estado),detalles from compra";
	
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
			while($row = mysqli_fetch_row($res)){
				$mes=$row[0];
				$anio=$row[1];
				$codigo=$row[2];
				$detalles=$row[9];

				if($row[8]=='V'){
					$estado = "<span class='label label-warning'>Vencido</span>";
				}else{
					if($row[8]=='D'){
						$estado = "<span class='label label-primary'>Pendiente</span>";
					}else{
						if($row[8]=='P'){
							$estado = "<span class='label label-success'>Pagado</span>";
						}else{
							$estado = "<span class='label label-danger'>Anulada</span>";
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
	                  	<form method='post' action='../compras/provision_pagar.php'>
				                <input type='hidden' id='txtmesID' name='txtmesID' value='".$mes."'>
				                <input type='hidden' id='txtAnioID' name='txtAnioID' value='".$anio."'>
				                <input type='hidden' id='txtNum' name='txtNum' value='".$codigo."'>
				                <input type='hidden' id='txtDetalles' name='txtDetalles' value='".$detalles."'>
				                <input type='hidden' id='txtOpcion' name='txtOpcion' value='V'>												  	
	                      <button type='submit' class='btn btn-block btn-transparente btn-flat btn-xs'>
	                      	<span class='text-blue'>
	                          <i class='ace-icon fa fa-search bigger-120'></i>
	                          Ver detalle
	                        </span>
										  	</button>
								       </form>
	                  </li>";
	                if($row[8]=='D' || $row[8]=='V'){
	                  echo "<li>
	                      <form method='post' action='../compras/facturar.php'>
				                <input type='hidden' id='txtmesID' name='txtmesID' value='".$mes."'>
				                <input type='hidden' id='txtAnioID' name='txtAnioID' value='".$anio."'>
				                <input type='hidden' id='txtNum' name='txtNum' value='".$codigo."'>
				                <input type='hidden' id='txtOpcion' name='txtOpcion' value='N'>
				                <input type='hidden' id='txtIgvP' name='txtIgvP' value='".$igv."'>								  	
	                      <button type='submit' class='btn btn-block btn-transparente btn-flat btn-xs'>
	                      	<span class='text-blue'>
	                          <i class='ace-icon fa fa-usd bigger-120'></i>
	                          Facturar
	                        </span>
										  </button>
								        </form>
					                  </li>
					             <li>
		                      <button type='button' class='btn btn-block btn-transparente btn-flat btn-xs' onclick='AnularFactura(\"".$mes."\",\"".$anio."\",\"".$codigo."\");'>
		                      	<span class='text-blue'>
		                          <i class='ace-icon fa fa-remove bigger-120'></i>
		                          Anular
		                        </span>
											  	</button>
					             </li>";}

	                  echo "</ul>
	              </div>
						</td>
					</tr>";
		}	
	}

	//DATOS DE LA COMPRA
	if($opc=='CC_11'){
		$mes = $_POST['mes'];
		$anio = $_POST['anio'];
		$codigo = $_POST['codigo'];
		$sql = "SELECT C.comprobanteID,C.formaPagoID,C.proveedorID,IF(P.razonSocial='',UPPER(concat(P.nombres,' ',P.apellidoPat,' ',P.apellidoMat)),UPPER(P.razonSocial)) as proveedor,P.cuentaDetraccion,C.tipoExistencia,C.tipoAdquisicionID,C.detraccion,DATE_FORMAT(C.fecha, '%d-%m-%Y') as fecha,C.serie,C.numero,DATE_FORMAT(C.fechaEmision, '%d-%m-%Y') as fechaEmision,DATE_FORMAT(C.fechaVencimiento, '%d-%m-%Y') as fechaVencimiento,C.moneda,C.IGV,C.detraccion,C.valorDetraccion,C.percepcion,C.valorPercepcion,C.renta,C.valorRenta,C.retencion,C.valorRetencion,C.totalBruto,C.descuento,C.valorVenta,C.impuesto,C.precioVenta,C.saldo,C.saldoPagar from compra C inner join proveedor P ON C.proveedorID=P.proveedorID  where C.mesID=$mes and C.anio=$anio and C.codigo=$codigo";
		$resulset = mysqli_query($con,$sql);
 		$datos=array();
	    while($row = mysqli_fetch_assoc($resulset))
	    {
	        $datos[] = $row;
	        
	    }
		
		echo json_encode($datos);
		exit();	
	}

	//DETALLE DE LA COMPRA
	if($opc=='CC_12'){
		$mes = $_POST['mes'];
		$anio = $_POST['anio'];
		$codigo = $_POST['codigo'];
		$sql = "SELECT * from detalle_compra where mesID=$mes and anio=$anio and codigo=$codigo";
		$resulset = mysqli_query($con,$sql);
 		$datos=array();
	    while($row = mysqli_fetch_assoc($resulset))
	    {
	        $datos[] = $row;
	    }
		
		echo json_encode($datos);
		exit();	
	}

	//INSERTAR PAGO DE COMPRA
	if($opc=='CC_13'){

		$mes = $_POST['txtMes'];
		$anio = $_POST['txtAnio'];
	
		$consulta = "SELECT IFNULL(MAX(correlativo)+1,1) FROM `PAGO_COMPRA` WHERE mesID=$mes and anio=$anio";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			$correlativo=$row[0];
		}
		$mesRef = $_POST['txtMesRef'];
		$anioRef = $_POST['txtAnioRef'];
		$codigoRef = $_POST['txtCodigoRef'];

		$fechaEmision = $_POST['txtFechaEmision'];
		$fechaEmision = str_replace("/","-",$fechaEmision);
	  	$fechaEmision = date('Y-m-d',strtotime($fechaEmision));

		$medioPagoID = $_POST['cboMedioPago'];
		$total = $_POST['total'];
		$valorVenta=$_POST['txtValorVenta'];
		$igv=$_POST['txtIGV'];
		$monto = $_POST['txtMonto'];
		$saldo = $_POST['saldo'];
		$saldo=floatval($saldo)-floatval($monto);
		
		if(isset($_POST['cboBanco'])){
			$entidadFinancieraID = $_POST['cboBanco'];
		}else{
			$entidadFinancieraID = '00';
		}

		$cuenta = $_POST['txtCuenta'];
		$voucher = $_POST['txtVoucher'];
		$numeroCk = $_POST['txtNumeroCheque'];

		$fechaVctoCk = $_POST['txtFechaVctoCk'];
		$fechaVctoCk = str_replace("/","-",$fechaVctoCk);
	  	$fechaVctoCk = date('Y-m-d',strtotime($fechaVctoCk));

	  	$concepto=$_POST['concepto'];
		$consulta = "INSERT INTO pago_compra values(".$mes.",".$anio.",".$correlativo.",".$mesRef.",".$anioRef.",".$codigoRef.",'".$fechaEmision."','".$medioPagoID."','".$valorVenta."','".$igv."','".$monto."','".$saldo."','".$entidadFinancieraID."','".$cuenta."','".$voucher."','".$numeroCk."','".$fechaVctoCk."','".$concepto."')";

		$res=mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if(!$res){
			echo 0;
		}else{
				$query = "UPDATE compra set saldo='$saldo' where mesID=$mesRef and anio=$anioRef and codigo=$codigoRef";
				$res = mysqli_query($con,$query)or  die (mysqli_error($con));
				if($res){
					if($saldo<=0){
						$execute = "UPDATE compra set estado='P' where mesID=$mesRef and anio=$anioRef and codigo=$codigoRef";
						$respuesta = mysqli_query($con,$execute)or  die (mysqli_error($con));
						if($respuesta){
							echo 1;
						}else{
							echo 0;
						}
					}else{
						echo 1;
					}

				}else{
					echo 0;
				}
		}
		
		exit();
	}

	//LISTAR MOVIMIENTOS DE SALIDA DE CAJA
	if($opc=='CC_14'){
		$query = "SELECT parametro,valor from parametro where parametroID=1 and estado=1";
		$res = mysqli_query($con,$query) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			$igv=$row[1];
		}

		$consulta = "select PC.mesID,PC.anio,PC.correlativo,C.serie,C.numero,DATE_FORMAT(PC.fechaEmision, '%d-%m-%Y'),MP.medioPago,PC.monto,PC.valorVenta,PC.igv,PC.mesReferencia,PC.anioReferencia,PC.codigoReferencia from pago_compra PC inner join medio_pago MP on PC.medioPagoID=MP.medioPagoID inner join  compra C on PC.mesReferencia=C.mesID AND PC.anioReferencia=C.anio and PC.codigoReferencia=C.codigo";
	
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
			while($row = mysqli_fetch_row($res)){
				$mes=$row[0];
				$anio=$row[1];
				$codigo=$row[2];
				$monto=$row[7];
				$valorVenta=$row[8];
				$igvValor=$row[9];

				$mesRef=$row[10];
				$anioRef=$row[11];
				$codigoRef=$row[12];

				echo "<tr>					
						<td>".$meses[$mes]."-".$anio."</td>
						<td>".$row[3]." - ".$row[4]."</td>
						<td style='text-align:center;'>".$row[5]."</td>		
						<td>".$row[6]."</td>
						<td style='text-align:right'>".$row[7]."</td>
						<td style='text-align:center;'>
							<div class='row'>
								<div class='col-md-4 col-md-offset-2'>
									<form method='post' action='../compras/facturar.php'>
		                <input type='hidden' id='txtmesID' name='txtmesID' value='".$mesRef."'>
		                <input type='hidden' id='txtAnioID' name='txtAnioID' value='".$anioRef."'>
		                <input type='hidden' id='txtNum' name='txtNum' value='".$codigoRef."'>
		                <input type='hidden' id='txtMontoP' name='txtMontoP' value='".$monto."'>
		                <input type='hidden' id='txtValorVentaP' name='txtValorVentaP' value='".$valorVenta."'>
		                <input type='hidden' id='txtValorIgvP' name='txtValorIgvP' value='".$igvValor."'>
		                <input type='hidden' id='txtOpcion' name='txtOpcion' value='V'>
		                <input type='hidden' id='txtIgvP' name='txtIgvP' value='".$igv."'>
		                <button type='submit' class='btn btn-block opcion btn-flat btn-xs'>
		                	<span class='text-blue'>
		                    <i class='fa fa-search' title='Ver'></i>
		                  </span>
										</button>
		              </form>
		            </div>
		          </div>
						</td>
					</tr>";
		}			
	}


	//ANULAR FACTURA
	if($opc=='CC_15'){
		$mes = $_POST['mes'];
		$anio=$_POST['anio'];
		$codigo=$_POST['codigo'];
		
		$consulta = "UPDATE compra set estado='A' where mesID=$mes and anio=$anio and codigo=$codigo";
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if($res){
			echo 1;
		}else{
			echo 0;
		}
		exit();
	}

	//LISTAR DOCUMENTOS DE COMPRA POR ESTADO
	if($opc=='CC_16'){
		$query = "SELECT parametro,valor from parametro where parametroID=1 and estado=1";
		$res = mysqli_query($con,$query) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			$igv=$row[1];
		}

		$estado = $_POST['estado'];
		$mes = $_POST['mes'];
		$anio = $_POST['anio'];
		$proveedor = $_POST['proveedor'];
		$periodo="mesID <> ''";
		$qproveedor="proveedorID <> ''";
		$query_estado="estado <> ''";

		if($mes!='0' and $anio!='0'){
				$periodo="mesID='".$mes."' and anio='".$anio."'";
		}
		if($proveedor!='0'){
				$qproveedor="proveedorID='".$proveedor."'";
		} 
		if($estado=='V'){
			$query_estado="fechaVencimiento < DATE_FORMAT(NOW(),'%Y-%m-%d 00:00:00') and estado='D'";
		}else{
			if($estado!='0'){
				$query_estado="estado='".$estado."'";
			}
		}
		$consulta = "select mesID,anio,codigo,serie,numero,DATE_FORMAT(fechaEmision, '%d-%m-%Y') as fechaEmision,DATE_FORMAT(fechaVencimiento, '%d-%m-%Y') as fechaVencimiento,saldoPagar, if(fechaVencimiento < DATE_FORMAT(NOW(),'%Y-%m-%d 00:00:00') and estado='D','V',estado),detalles from compra where ".$query_estado." and ".$periodo." and ".$qproveedor;
	
	
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
			while($row = mysqli_fetch_row($res)){
				$mes=$row[0];
				$anio=$row[1];
				$codigo=$row[2];
				$detalles=$row[9];

				if($row[8]=='V'){
					$estado = "<span class='label label-warning'>Vencido</span>";
				}else{
					if($row[8]=='D'){
						$estado = "<span class='label label-primary'>Pendiente</span>";
					}else{
						if($row[8]=='P'){
							$estado = "<span class='label label-success'>Pagado</span>";
						}else{
							$estado = "<span class='label label-danger'>Anulada</span>";
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
	                  	<form method='post' action='../compras/provision_pagar.php'>
				                <input type='hidden' id='txtmesID' name='txtmesID' value='".$mes."'>
				                <input type='hidden' id='txtAnioID' name='txtAnioID' value='".$anio."'>
				                <input type='hidden' id='txtNum' name='txtNum' value='".$codigo."'>
				                <input type='hidden' id='txtDetalles' name='txtDetalles' value='".$detalles."'>
				                <input type='hidden' id='txtOpcion' name='txtOpcion' value='V'>												  	
	                      <button type='submit' class='btn btn-block btn-transparente btn-flat btn-xs'>
	                      	<span class='text-blue'>
	                          <i class='ace-icon fa fa-search bigger-120'></i>
	                          Ver detalle
	                        </span>
										  	</button>
								       </form>
	                  </li>";
	                if($row[8]=='D' || $row[8]=='V'){
	                  echo "<li>
	                      <form method='post' action='../compras/facturar.php'>
				                <input type='hidden' id='txtmesID' name='txtmesID' value='".$mes."'>
				                <input type='hidden' id='txtAnioID' name='txtAnioID' value='".$anio."'>
				                <input type='hidden' id='txtNum' name='txtNum' value='".$codigo."'>
				                <input type='hidden' id='txtOpcion' name='txtOpcion' value='N'>		<input type='hidden' id='txtIgvP' name='txtIgvP' value='".$igv."'>								  	
	                      <button type='submit' class='btn btn-block btn-transparente btn-flat btn-xs'>
	                      	<span class='text-blue'>
	                          <i class='ace-icon fa fa-usd bigger-120'></i>
	                          Facturar
	                        </span>
										  </button>
								        </form>
					                  </li>
					             <li>
		                      <button type='button' class='btn btn-block btn-transparente btn-flat btn-xs' onclick='AnularFactura(\"".$mes."\",\"".$anio."\",\"".$codigo."\");'>
		                      	<span class='text-blue'>
		                          <i class='ace-icon fa fa-remove bigger-120'></i>
		                          Anular
		                        </span>
											  	</button>
					             </li>";}

	                  echo "</ul>
	              </div>
						</td>
					</tr>";
		}	
	}

	//LISTAR MOVIMIENTOS DE SALIDA DE CAJA POR FILTRO
	if($opc=='CC_17'){
		$query = "SELECT parametro,valor from parametro where parametroID=1 and estado=1";
		$res = mysqli_query($con,$query) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			$igv=$row[1];
		}

		$proveedor = $_POST['proveedor'];
		$mes = $_POST['mes'];
		$anio = $_POST['anio'];
	
		$qproveedor="C.proveedorID <> '00000000'";
		$qperiodo="PC.mesID <> '13'";

		if($mes!='0' and $anio!='0'){
				$qperiodo="PC.mesID='".$mes."' and PC.anio='".$anio."'";
		}
		if($proveedor!='0'){
				$qproveedor="C.proveedorID='".$proveedor."'";
		} 
		
		$consulta = "select PC.mesID,PC.anio,PC.correlativo,C.serie,C.numero,DATE_FORMAT(PC.fechaEmision, '%d-%m-%Y'),MP.medioPago,PC.monto,PC.valorVenta,PC.igv,PC.mesReferencia,PC.anioReferencia,PC.codigoReferencia from pago_compra PC inner join medio_pago MP on PC.medioPagoID=MP.medioPagoID inner join  compra C on PC.mesReferencia=C.mesID AND PC.anioReferencia=C.anio and PC.codigoReferencia=C.codigo where ".$qproveedor." and ".$qperiodo."";
	
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
			while($row = mysqli_fetch_row($res)){
				$mes=$row[0];
				$anio=$row[1];
				$codigo=$row[2];
				$monto=$row[7];
				$valorVenta=$row[8];
				$igvValor=$row[9];

				$mesRef=$row[10];
				$anioRef=$row[11];
				$codigoRef=$row[12];

				echo "<tr>					
						<td>".$meses[$mes]."-".$anio."</td>
						<td>".$row[3]." - ".$row[4]."</td>
						<td style='text-align:center;'>".$row[5]."</td>		
						<td>".$row[6]."</td>
						<td style='text-align:right'>".$row[7]."</td>
						<td style='text-align:center;'>
							<div class='row'>
								<div class='col-md-4 col-md-offset-2'>
									<form method='post' action='../compras/facturar.php'>
		                <input type='hidden' id='txtmesID' name='txtmesID' value='".$mesRef."'>
		                <input type='hidden' id='txtAnioID' name='txtAnioID' value='".$anioRef."'>
		                <input type='hidden' id='txtNum' name='txtNum' value='".$codigoRef."'>
		                <input type='hidden' id='txtMontoP' name='txtMontoP' value='".$monto."'>
		                <input type='hidden' id='txtValorVentaP' name='txtValorVentaP' value='".$valorVenta."'>
		                <input type='hidden' id='txtValorIgvP' name='txtValorIgvP' value='".$igvValor."'>
		                <input type='hidden' id='txtOpcion' name='txtOpcion' value='V'>			
		                <input type='hidden' id='txtIgvP' name='txtIgvP' value='".$igv."'>			
		                <button type='submit' class='btn btn-block opcion btn-flat btn-xs'>
		                	<span class='text-blue'>
		                    <i class='fa fa-search' title='Ver'></i>
		                  </span>
										</button>
		              </form>
		            </div>
		          </div>
						</td>
					</tr>";
		}
	}

	//HISTORIAL DE PAGOS
	if($opc=='CC_18'){
		$mes = $_POST['mes'];
		$anio = $_POST['anio'];
		$codigo = $_POST['codigo'];
		$sql = "SELECT PC.correlativo,PC.fechaEmision,PC.monto,if(PC.concepto='N','Valor venta','detraccion') as concepto,MP.medioPago from pago_compra PC inner join medio_pago MP on PC.medioPagoID=MP.medioPagoID where PC.mesReferencia=$mes and PC.anioReferencia=$anio and PC.codigoReferencia=$codigo";
		$resulset = mysqli_query($con,$sql);
 		$datos=array();
	    while($row = mysqli_fetch_assoc($resulset))
	    {
	        $datos[] = $row;
	    }
		
		echo json_encode($datos);
		exit();	
	}


	//ISERT REQUERIMIENTO
	if($opc=='RRQ_01'){
		$personalID='1001';
		$fecha =$fechaHoyAMD;
		$detalle=$_POST['detalles']; 
		
		$consulta = "SELECT IFNULL(MAX(requerimientoID)+1,1) FROM requerimiento";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		while($row = mysqli_fetch_row($res)){	
			$requerimientoID=$row[0];
		}
		
		$consulta = "INSERT INTO requerimiento VALUES (".$requerimientoID.",".$personalID.",'".$fecha."',".$detalle.",'P')";
			
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if(!$res){
			echo 0;
		}else{
			echo $requerimientoID;
		}

		exit();
	}

	//ISERT DETALLE DE REQUERIMIENTO
	if($opc=='RRQ_02'){
		$item = $_POST['item'];
		$requerimientoID = $_POST['requerimientoID'];
		
		$producto = $_POST['txtProducto'.$item];
		$unidad = $_POST['txtUnidad'.$item];
		$descripcion = $_POST['txtDescripcion'.$item];
		$cantidad = $_POST['txtCantidad'.$item];
		$requerimiento = $_POST['txtRequerimiento'.$item];
		

		$consulta = "INSERT INTO detalle_requerimiento VALUES (".$requerimientoID.",".$item.",'".$producto."','".$unidad."','".$descripcion."',".$cantidad.",'".$requerimiento."','P')";
			
		mysqli_query($con,$consulta)or  die (mysqli_error($con));
		
		exit();
	}

	//LISTAR REQUERIMIENTOS
	if($opc=='RRQ_03'){
		$i=0;
		$consulta = "SELECT DATE_FORMAT(R.fecha, '%d-%m-%Y'),A.area,concat(PS.nombres,' ',PS.apPaterno,' ',PS.apMaterno),DR.producto,DR.unidadMedida,DR.descripcion,DR.stock,DR.requerimiento,DR.estado,DR.requerimientoID,DR.item,DR.requerimiento FROM requerimiento R inner join personal P on R.personalID=P.personalID inner join cargo C on P.cargoID=C.cargoID inner join area A on C.areaID=A.areaID inner join persona PS ON PS.personaID=P.personaID inner join detalle_requerimiento DR on DR.requerimientoID=R.requerimientoID";
	
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
			while($row = mysqli_fetch_row($res)){
				$i++;
				
				if($row[8]=='P'){
					$estado = "<span class='label label-warning'>Pendiente</span>";
				}else{
					if($row[8]=='A'){
						$estado = "<span class='label label-primary'>Aprobado</span>";
					}else{
						if($row[8]=='R'){
							$estado = "<span class='label label-danger'>Rechazado</span>";
						}else{
							if($row[8]=='E'){
								$estado = "<span class='label label-success'>Proveído</span>";
							}
						}
					}
				}

				$aprobar='A';
				$rechazar='R';
				$proveer='E';
				$requerimientoID=$row[9];
				$item=$row[10];

				echo "<tr>					
						<td style='text-align:center;'>".$i."</td>		
						<td style='text-align:center;'>".$row[0]."</td>		
						<td style='text-align:center;'>".$row[1]."</td>		
						<td>".$row[2]."</td>
						<td>".$row[11]." ".$row[3]." ".$row[5]." (".$row[4].")</td>
						<td style='text-align:center;'>".$row[6]."</td>
						<td style='text-align:center;'>".$estado."</td>
						<td style='text-align:center;'>";
				if($row[8]!='E'){
				echo	"<div>
			              <div class='inline pos-rel dropup'>
			                <button  class='btn btn-secundary btn-flat btn-lista-flotante dropdown-toggle btn-xs'  data-toggle='dropdown' data-position='auto' aria-expanded='true'>
			                    <i class='ace-icon fa fa-caret-down icon-only bigger-120'></i>
			                </button>

			                <ul class='lista-flotante dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close '>
				                <li>
			                      <button type='button' class='btn btn-block btn-transparente btn-flat btn-xs' onclick='UpdateEstadoRequerimiento(\"".$aprobar."\",\"".$requerimientoID."\",\"".$item."\");'>
			                      	<span class='text-blue'>
			                          <i class='ace-icon fa  fa-check bigger-120'></i>
			                          Aprobar
			                        </span>
									</button>
					             </li>
		                  		<li>
			                      <button type='button' class='btn btn-block btn-transparente btn-flat btn-xs' onclick='UpdateEstadoRequerimiento(\"".$rechazar."\",\"".$requerimientoID."\",\"".$item."\");'>
			                      	<span class='text-blue'>
			                          <i class='ace-icon fa fa-remove bigger-120'></i>
			                          Rechazar
			                        </span>
									</button>
					             </li>
					             <li>
			                      <button type='button' class='btn btn-block btn-transparente btn-flat btn-xs' onclick='UpdateEstadoRequerimiento(\"".$proveer."\",\"".$requerimientoID."\",\"".$item."\");'>
			                      	<span class='text-blue'>
			                          <i class='ace-icon fa fa-plus bigger-120'></i>
			                          Proveer
			                        </span>
									</button>
					             </li>
					        </ul>
	              			</div>";
	              		}
				echo	"</td>
					</tr>";
		}	
	}

	//ACTUALIZAR REQUERIMIENTO
	if($opc=='RRQ_04'){
		$estado = $_POST['estado'];
		$requerimientoID = $_POST['requerimientoID'];
		$item = $_POST['item'];
		$consulta = "UPDATE detalle_requerimiento set estado='".$estado."' where requerimientoID=$requerimientoID and item=$item";
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if($res){
			echo 1;
		}else{
			echo 0;
		}
		exit();
	}

	//CARGAR COMBO REQUERIMIENTOS
	if($opc=='RRQ_05'){
		$consulta = "SELECT requerimientoID,item,requerimiento,producto,descripcion,unidadMedida FROM detalle_requerimiento WHERE estado='A'";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		echo "<option value='0'>--Seleccionar--</option>";
		while($row = mysqli_fetch_row($res)){	
			echo "<option value='".$row[0]."-".$row[1]."'>".$row[2]." ".$row[3]." ".$row[4]." (".$row[5].")</option>";
		}
		exit();
	}

	//DATOS DE UN DETALLE DE REQUERIMIENTO
	if($opc=='RRQ_06'){
		$requerimientoID = $_POST['requerimientoID'];
		$item = $_POST['item'];
		$sql = "SELECT * from detalle_requerimiento where requerimientoID=$requerimientoID and item=$item";
		$resulset = mysqli_query($con,$sql);
 		$datos=array();
	    while($row = mysqli_fetch_assoc($resulset))
	    {
	        $datos[] = $row;
	        
	    }
		
		echo json_encode($datos);
		exit();	
	}

	//INSERTAR ORDEN DE COMPRA
	if($opc=='OC_01'){
		$detalles = $_POST['detalles'];
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
		$valorDetraccion = $_POST['txtDetraccion'];
		$percepcion = $_POST['cboPercepcion'];
		$valorPercepcion = $_POST['txtPercepcion'];
		$renta = $_POST['cboRenta'];
		$valorRenta = $_POST['txtRenta'];
		$retencion = $_POST['cboRetencion'];
		$valorRetencion = $_POST['txtRetencion'];
		$totalBruto = $_POST['txtTotalBruto'];
		$descuento = $_POST['txtDescuento'];
		$valorVenta = $_POST['txtValorVenta'];
		$impuesto = $_POST['txtIGV'];
		$precioVenta = $_POST['txtPrecioVenta'];

		if($detraccion!=0){
			$saldoPagar=floatVal($precioVenta)-floatVal($valorDetraccion);
		}else{
			if($percepcion!=0){
				$saldoPagar=floatVal($precioVenta)+floatVal($valorPercepcion);
			}else{
				if($retencion!=0){
					$saldoPagar=floatVal($precioVenta)+floatVal($valorRetencion);
				}else{
					if($renta!=0){
						$saldoPagar=floatVal($precioVenta)-floatVal($valorRenta);
					}else{
						$saldoPagar=$precioVenta;
					}
				}
			}
		}

		$consulta = "INSERT INTO compra VALUES(".$mes.",".$anio.",".$codigo.",'".$fecha."','".$comprobanteID."','".$proveedorID."','".$serie."','".$numero."','".$fechaEmision."','".$fechaVencimiento."','".$moneda."','".$formaPagoID."','".$tipoAdquisicionID."','".$tipoExistencia."','".$IGV."','".$detraccion."','".$valorDetraccion."','".$percepcion."','".$valorPercepcion."','".$renta."','".$valorRenta."','".$retencion."','".$valorRetencion."','".$totalBruto."','".$descuento."','".$valorVenta."','".$impuesto."','".$precioVenta."','".$saldoPagar."','".$saldoPagar."','".$detalles."','D')";
			
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if(!$res){
			echo 0;
		}else{
			echo 1;
		}

		exit();
	}

	//INSERTAR DETALLE DE LA ORDEN DE COMPRA
	if($opc=='CC_02'){
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

?>


	
	
