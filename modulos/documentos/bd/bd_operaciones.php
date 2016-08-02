<?php 
	$opc = $_POST['opc'];
	require('../../bd/bd_conexion.php');
	$hoyAMD = date('Y').'-'.date('m').'-'.date('d'); 	//2016-07-20
	$hoyDMA = date('d').'-'.date('m').'-'.date('Y');	//20-07-2016
	$pdfPermitido = array("application/pdf");
	

	// CARGA COMBO DE CONTROL DE DOCUMENTOS (ID - TItulo)
	if($opc=='LCD_01'){
		$areaID = "";
		$consulta = "select controlDocumentoID,nroRevision,titulo
								from control_documento								
								where estado='APROBADO' 
								order by titulo asc ";
		$datos="";
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con));			
		while($row = mysqli_fetch_row($res)){
			$controID = $row[0].'_'.$row[1];
			$datos[] = array('controlDocumentoID'=> $controID,'titulo'=> $row[2]);
		}
		echo json_encode($datos);
		exit();
	}
	// LTABLA DE REGISTROS REQUERIDOS
	if($opc=='LRR_01'){
		$control_documento = $_POST['control_documento'];

		$consulta = "select RR.registroRequeridoID,RR.nroRevision,RR.controlDocumentoID,RR.titulo,
									RR.frecuencia,RR.formato,RR.estado,RR.fechaAprobacion,RR.areaResponsable,RR.soporte,RR.acceso,
									RR.retencionArea,RR.retencionAlmacen,RR.observaciones
									from registro_requerido RR
									inner join area A on A.areaID = RR.areaOrigenID
									inner join control_documento CD on CD.controlDocumentoID = RR.controlDocumentoID and CD.nroRevision = RR.nroRevisionCD
									";
		if($control_documento!=''){
			$control_documento = explode("_", $control_documento);
			$controlDocumentoID = $control_documento[0];
			$revisionNroCD = $control_documento[1];
			$consulta = $consulta."where CD.controlDocumentoID='".$controlDocumentoID."' and CD.nroRevision='".$revisionNroCD."'";
		}
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));		
		while($row = mysqli_fetch_row($res)){						
			$estado = $row[6];
			if($estado == 'APROBADO'){
				$estado = "<span class='label label-sm label-success'>APROBADO</span>";
			}
			if($estado == 'ELABORADO'){
				$estado = "<span class='label label-sm label-warning'>ELABORADO</span>";
			}
			if($estado == 'OBSOLETO'){
				$estado = "<span class='label label-sm label-default'>OBSOLETO</span>";
			}
			$fechaAprobacion = $row[7];
			if($fechaAprobacion!="0000-00-00"){
				$fechaAprobacion = str_replace("/","-",$fechaAprobacion);
		  	$fechaAprobacion = date('d-m-Y',strtotime($fechaAprobacion));
			}else{
				$fechaAprobacion = "00-00-0000";
			}
			echo "<tr>
							<td>".$row[0]."</td>
							<td style='text-align:center;'>".$row[1]."</td>
							<td>".$row[3]."</td>
							<td>".$row[4]."</td>
							<td style='text-align:center;'>".$estado."</td>
							<td>".$fechaAprobacion."</td>							
							<td>".$row[8]."</td>
							<td style='text-align:center;'>
								<div>
                  <div class='inline pos-rel dropup'>
                    <button  class='btn btn-secundary dropdown-toggle' data-toggle='dropdown' data-position='auto' aria-expanded='true'>
                        <i class='ace-icon fa fa-caret-down icon-only bigger-120'></i>
                    </button>

                    <ul class='lista-flotante dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close '>
                      <li>
                        <a href='".$row[5]."' data-rel='tooltip' title='Ver' target='_blanck'>
                          <span class='text-blue'>
                              <i class='fa fa-file-o'></i>
                          </span>
                          Ver documento
                        </a>
                        <a href='javascrip:;' onclick='mostrarDocumento(\"".$row[0]."\",\"".$row[1]."\");'>
                          <span class='text-green'>
                              <i class='ace-icon fa fa-search bigger-120'></i>
                          </span>
                          Ver descripción
                        </a>
                        <a href='javascrip:;'  onclick='alert(\"No disponible\");' title='Modificar'>
                          <span class='text-yellow'>
                              <i class='fa fa-pencil'></i>
                          </span>
                          Modificar
                        </a>
                        <a href='javascrip:;'  onclick='alert(\"No disponible\");' title='Eliminar'>
                          <span class='text-red'>
                              <i class='fa fa-trash'></i>
                          </span>
                          Eliminar
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>

							</td>
						</tr>";
		}
		exit();
	}
	// REGISTRAR UN NUEVO REGISTRO REQUERIDO
	if($opc=='RR_02'){
		$controlDocumento = $_POST['cboControlDocumento'];
		$controlDocumento = explode("_", $controlDocumento);
		$controlDocumentoID = $controlDocumento[0];
		$revisionNroCD = $controlDocumento[1];

		$registroRequerido = $_POST['txtCodigo'];
		$titulo = $_POST['txtTitulo'];
		$revisionNro = $_POST['txtRevisionN'];
		$frecuencia  = $_POST['cboFrecuencia'];
		$areaID = $_POST['cboArea'];
		$areaResp = $_POST['txtAreaResponsable'];
		$estado  = $_POST['cboEstado'];
		$fechaAprobacion = $_POST['txtFechaAp'];
		if($fechaAprobacion!=""){
			$fechaAprobacion = str_replace("/","-",$fechaAprobacion);
	  	$fechaAprobacion = date('Y/m/d',strtotime($fechaAprobacion));
		}
		$soporte = $_POST['txtSoporte'];
		$acceso = $_POST['txtAcceso'];
		$retencionArea = $_POST['txtRetencionArea'];
		$retencionAlmacen = $_POST['txtRetencionAlmacen'];
		$observaciones = $_POST['txtObservaciones'];

		// Mover el archivo
			$archivo = $_FILES['txtFormato']['name'];
			if($archivo==''){
				echo "Debe seleccionar un archivo";
				exit();
			}
			$archivo = $_FILES['txtFormato'];
			$nombre = $archivo['name'];
			$tipo = $archivo['type'];
			$ruta_provisional = $archivo['tmp_name'];
			$size = $archivo['size'];			
			$nombre = explode(".", $nombre);
			$extension = $nombre[count($nombre)-1];  //pdf, docx,xlsx			
			
			// if (!in_array($tipo, $pdfPermitido)){
			// 	echo "Verifique el tipo del archivo, debe ser PDF";
			// 	exit();
			// }
			$nombreDoc = 'RR_'.$registroRequerido.'_'.$revisionNro.'.'.$extension;
			$rutaBD = '../../docs/'.$nombreDoc;
			$ruta = '../../../docs/'.$nombreDoc;

				// CONECTAR A SERVIDOR
								$rutaServidor = "/intranet.clinicacristoredentor.com/docs/".$nombreDoc;
								$ftpCon = ftp_connect($ftpServer);
								ftp_pasv($ftpCon, true);
								$result = ftp_login($ftpCon, $ftpUsuario, $fftpClave);
								if ((!$ftpCon) || (!$result)) {
									echo "La conexion al servidor falló";
									exit();
								}else {
									$documentos = ftp_nlist($ftpCon, "/intranet.clinicacristoredentor.com/docs/");
									for ($i=0; $i < count($documentos); $i++){
										if($documentos[$i]==$rutaServidor){
											echo "Ya existe un archivo con el mismo nombre.";
											exit();
										}
									}
									$upload = ftp_put($ftpCon, $rutaServidor, $ruta_provisional, FTP_BINARY);
								}
				// -----------------
				
				// move_uploaded_file($ruta_provisional, $ruta);
		//----------------------------------------------------


			$consulta = "insert into registro_requerido(registroRequeridoID,nroRevision,controlDocumentoID,
										nroRevisionCD,titulo,frecuencia,formato,estado,fechaAprobacion,areaOrigenID,areaResponsable,soporte,acceso,
										retencionArea,retencionAlmacen,observaciones) values
										('".$registroRequerido."','".$revisionNro."','".$controlDocumentoID."',
											'".$revisionNroCD."','".$titulo."','".$frecuencia."','".$rutaBD."',
											'".$estado."','".$fechaAprobacion."','".$areaID."','".$areaResp."','".$soporte."',
											'".$acceso."','".$retencionArea."','".$retencionAlmacen."','".$observaciones."')";

			$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
			if($res){
				echo 1;
			}else{
				echo "No se pudo registrar el registro requerido";
			}
			exit();
	}
	// CARGA TABLA DOCUMENTOS
	if($opc=='CT_DOC_01'){
		$consulta = "select CD.controlDocumentoID,CD.nroRevision,CD.titulo,CD.ruta,CD.estado,CD.tipoDocumento,CD.areaID,A.area
												from control_documento CD
												inner join area A on A.areaID = CD.areaID";
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
		$cont = 0;
		while($row = mysqli_fetch_row($res)){
			$cont = $cont+1;
			$estado = $row[4];
			if($estado=='IMPLEMENTADO'){
				$estado = "<span class='label label-sm label-success'>IMPLEMENTADO</span>";
			}else{
				if($estado == 'APROBADO'){
					$estado = "<span class='label label-sm label-warning'>APROBADO</span>";
				}else{
					$estado = "<span class='label label-sm label-danger'>".$row[4]."</span>";
				}
			}
			echo "<tr>
							<td>".$row[0]."</td>
							<td style='text-align:center;'>".$row[1]."</td>
							<td>".$row[2]."</td>
							<td style='text-align:center;'>".$estado."</td>
							<td>".$row[5]."</td>
							<td>".$row[7]."</td>
							<td style='text-align:center;'>

								<div>
                  <div class='inline pos-rel dropup'>
                    <button  class='btn btn-secundary dropdown-toggle' data-toggle='dropdown' data-position='auto' aria-expanded='true'>
                        <i class='ace-icon fa fa-caret-down icon-only bigger-120'></i>
                    </button>

                    <ul class='lista-flotante dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close '>
                      <li>
                        <a href='".$row[3]."' data-rel='tooltip' title='Ver' target='_blanck'>
                          <span class='text-blue'>
                              <i class='fa fa-file-o'></i>
                          </span>
                          Ver documento
                        </a>
                        <a href='javascrip:;' onclick='mostrarDocumento(\"".$row[0]."\",\"".$row[1]."\");'>
                          <span class='text-green'>
                              <i class='ace-icon fa fa-search bigger-120'></i>
                          </span>
                          Ver descripción
                        </a>
                        <a href='registro_requerido.php?control_documento=".$row[0]."_".$row[1]."'>
                          <span class='text-blue'>
                              <i class='ace-icon fa fa-list bigger-120'></i>
                          </span>
                          Formatos requeridos
                        </a>
                        <a href='javascrip:;'  onclick='alert(\"No disponible\");' title='Modificar'>
                          <span class='text-yellow'>
                              <i class='fa fa-pencil'></i>
                          </span>
                          Modificar
                        </a>
                        <a href='javascrip:;'  onclick='alert(\"No disponible\");' title='Eliminar'>
                          <span class='text-red'>
                              <i class='fa fa-trash'></i>
                          </span>
                          Eliminar
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>

							</td>
						</tr>";
		}
		exit();
	}


	// REGISTRAR UN DOCUMENTO CONTROL
	if($opc=='D_02'){
		$controlDocumentoID = $_POST['txtCodigo'];
		$titulo = $_POST['txtTitulo'];
		$revisionNro = $_POST['txtRevisionN'];
		$estado  = $_POST['cboEstado'];
		// $fechaCreacion = $_POST['txtFechaC'];
		$fechaVencimiento = $_POST['txtFechaV'];
		// $fechaActualizacion = $_POST['txtFechaAc'];
		$fechaAprobacion = $_POST['txtFechaAp'];
		$tipoDocumento = $_POST['cboTipoDocumento'];
		$areaID = $_POST['cboArea'];
		$acceso = $_POST['txtAcceso'];
		$distribucion = $_POST['txtDistribucion'];
		$observaciones = $_POST['txtObservaciones'];

		// Mover el archivo
				$archivo = $_FILES['txtRuta']['name'];
				if($archivo==''){
					echo "Debe seleccionar un archivo";
					exit();
				}
				$archivo = $_FILES['txtRuta'];					
				$nombre = $archivo['name'];
				$tipo = $archivo['type'];
				$ruta_provisional = $archivo['tmp_name'];
				$size = $archivo['size'];		
	
				if (!in_array($tipo, $pdfPermitido)){
					echo "Verifique el tipo del archivo, debe ser PDF";
					exit();
				}

				
				$nombreDoc = 'CD_'.$controlDocumentoID.'_'.$revisionNro.'.pdf';

				$rutaBD = '../../docs/'.$nombreDoc;
				$ruta = '../../../docs/'.$nombreDoc;

				// CONECTAR A SERVIDOR
						$rutaServidor = "/intranet.clinicacristoredentor.com/docs/".$nombreDoc;
						$ftpCon = ftp_connect($ftpServer);
						ftp_pasv($ftpCon, true);
						$result = ftp_login($ftpCon, $ftpUsuario, $fftpClave);
						if ((!$ftpCon) || (!$result)) {
							echo "La conexion al servidor falló";
							exit();
						}else {
							$documentos = ftp_nlist($ftpCon, "/intranet.clinicacristoredentor.com/docs/");
							for ($i=0; $i < count($documentos); $i++){
								if($documentos[$i]==$rutaServidor){
									echo "El archivo ya existe en el servidor con el mismo nombre.";
									exit();
								}
							}
							$upload = ftp_put($ftpCon, $rutaServidor, $ruta_provisional, FTP_BINARY);
						}
				// -----------------
				
				// move_uploaded_file($ruta_provisional, $ruta);
		//----------------------------------------------------


		$consulta = "insert into control_documento(controlDocumentoID,titulo,ruta,nroRevision,estado,
								fechaVencimiento,tipoDocumento,areaID,acceso,distribucion,observaciones) values
									('".$controlDocumentoID."','".$titulo."','".$rutaBD."','".$revisionNro."','".$estado."',
										'".$fechaVencimiento."','".$tipoDocumento."','".$areaID."',
										'".$acceso."','".$distribucion."','".$observaciones."')";
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		if($res){
			echo 1;
		}else{
			echo "No se pudo registrar el documento";
		}
		exit();
	}
		// Mostrar
		if($opc=='D_03'){
			$documentoID = $_POST['documentoID'];
			$nroRevision = $_POST['nroRevision'];

			$consulta = "select controlDocumentoID, titulo, ruta, nroRevision, estado, 
									fechaCreacion, fechaVencimiento, fechaActualizacion, fechaAprobacion, 
									tipoDocumento, areaID, acceso, distribucion, observaciones
									from control_documento where controlDocumentoID='".$documentoID."' and nroRevision='".$nroRevision."'";
			$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
			$row = mysqli_fetch_row($res);
			echo json_encode($row);
			exit();
		}
?>