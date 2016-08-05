<?php include '../../general/variables.php';?>
<?php
	require('../../bd/bd_conexion.php');
	$opc = $_POST['opc'];

	// CARTAR TABLA CITAS DE CONSULTORIO - LABORATORIO
	if($opc == 'LCC_01'){
		$fechaCita = $_POST['fecha'];
		$tipo = $_POST['tipo'];						//C - L
		$fechaCita = str_replace("/","-",$fechaCita);
	  $fechaCita = date('Y-m-d',strtotime($fechaCita));
	  $estado = $_POST['estado'];
	  
		$consulta = "select C.citaID,P.nombres,P.apPaterno,P.apMaterno,PA.pacienteID,
												E.especialidad,S.servicio,C.fecha,C.hora,PP.nombres,
												PP.apPaterno,PP.apMaterno,C.estado,PS.estadoPago,PS.pedidoServicioID,PA.DNI
									from CITA C
									inner join PEDIDO_SERVICIO PS ON C.pedidoServicioID = PS.pedidoServicioID
									inner join PACIENTE PA ON PA.pacienteID = C.pacienteID
									inner join PERSONA P ON P.DNI = PA.DNI
									left join ESPECIALIDAD E ON E.especialidadID = C.especialidadID
									inner join SERVICIO S ON S.servicioID = C.servicioID
									left join PERSONAL PE ON PE.personalID = C.medicoID
									left join PERSONA PP ON PP.DNI = PE.DNI
									where C.fecha='".$fechaCita."' and C.tipo = '".$tipo."'";
		if($estado != "T"){
			$consulta = $consulta."and C.estado='".$estado."'";
		}
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con));
		while($row = mysqli_fetch_row($res)){
			$nombresP = explode(" ", $row[1]); $nombresM = explode(" ", $row[9]);
			$nombrePaciente = $nombresP[0].' '.$row[2].' '.$row[3];
			$especialidad = $row[5];
			if($tipo == "C"){
				$nombreMedico = $nombresM[0].' '.$row[10];
			}else{
				$nombreMedico = "Laboratorio";
				$especialidad = "Laboratorio";
			}
			$fecha = $row[7];
			$fecha = str_replace("/","-",$fecha);
	    $fecha = date('d-m-Y',strtotime($fecha));
			$estadoCita = "";
			$estadoPago = "";
			$pedidoID = $row[14];
			$DNI = $row[15];

			// "<select class='form-control' id='cboEstadoCita' name='cboEstadoCita' >	      
	  //     <option value='R' class='label-warning'>Reservado</option>
	  //     <option value='C' class='label-info'>Confirmada</option>
	  //     <option value='S' class='label-primary'>En Sala</option>
	  //     <option value='A' class='label-success'>Atendido</option>
	  //     <option value='X' class='label-danger'>Anulado</option>
	  //   </select>"

			if($row[12]=='R'){
				$estadoCita = "<span class='label label-warning'>Reservado</span>";
			}else{
				if($row[12]=='S'){
					$estadoCita = "<span class='label label-primary'>En Sala</span>";
				}else{
					if($row[12]=='A'){
						$estadoCita = "<span class='label label-success'>Atendido</span>";
					}else{
						if($row[12]=='X'){
							$estadoCita = "<span class='label label-danger'>Anulado</span>";
						}
					}
				}
			}

			if($row[13]=='PEN'){
				$estadoPago = "<span class='label label-danger'>Pendiente</span>";
			}else{
				if($row[13]=='PAG'){
					$estadoPago = "<span class='label label-success'>Pagado</span>";
				}else{
					if($row[13] == 'PAR'){
						$estadoPago = "<span class='label label-warning'>Parcial</span>";
					}
				}
			}
			echo "<tr>												
							<td>".$nombrePaciente."</td>
							<td>".$especialidad."</td>
							<td>".$row[6]."</td>
							<td>".$fecha."</td>
							<td>".$row[8]."</td>
							<td>".$nombreMedico."</td>
							<td>".$estadoCita."</td>
							<td>".$estadoPago."</td>
							<td>
							<div>
                  <div class='inline pos-rel dropup'>
                    <button  class='btn btn-secundary btn-flat btn-lista-flotante dropdown-toggle btn-xs'  data-toggle='dropdown' data-position='auto' aria-expanded='true'>
                        <i class='ace-icon fa fa-caret-down icon-only bigger-120'></i>
                    </button>

                    <ul class='lista-flotante dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close '>
                      <li>
                      	<form method='post' action='../facturacion/facturar.php'>
					                <input type='hidden' id='txtPedidoID' name='txtPedidoID' value='".$pedidoID."'>
					                <input type='hidden' id='txtDNI' name='txtDNI' value='".$DNI."'>												  	
                          <button type='submit' class='btn btn-block btn-transparente btn-flat btn-xs'>
                          	<span class='text-blue'>
	                            <i class='ace-icon fa fa-usd bigger-120'></i>
	                            Facturación
	                          </span>
													</button>
					              </form>
                      </li>
                      <li>
                      	<form method='post' action='../facturacion/facturar.php'>
					                <input type='hidden' id='txtPedidoID' name='txtPedidoID' value='".$pedidoID."'>
					                <input type='hidden' id='txtDNI' name='txtDNI' value='".$DNI."'>												  	
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
		exit();
	}	
	// REGISTRAR CITA CONSULTORIO -  Guardar cita medica
	if($opc == 'RC_01'){
		// $citaID = $_POST[''];
		$pacienteID = $_POST['txtPacienteID'];
		$medicoRef = $_POST['txtCodigoMedicoRef'];
		$medicoID = $_POST['txtMedicoCodigo'];
		$especialidadID = $_POST['cboEspecialidad'];
		$servicioID = $_POST['txtServicioID'];
		$motivo = $_POST['txtMotivo'];
		$via = $_POST['cboVia'];
		$fecha = $_POST['txtFechaCita'];
		$fecha = str_replace("/","-",$fecha);
    $fecha = date('Y/m/d',strtotime($fecha));
    $hora = $_POST['txtHoraCita'];
		$estado = "R";	//Reservado
		$tipo = "C";  	//C: Consultorio
		$estadoPago = "PEN";   //PE: Pendiente
		$importePagado = 0;		//Total Pagado = 0
		// OBTENEMOS EL PRECIO DEL SERVICIO
					// $tasaIGV = 0.18; Variable global
					$csPrecio = "select precioUnitario from servicio where servicioID = '".$servicioID."'";
					$res = mysqli_query($con,$csPrecio)or  die (mysqli_error($con));
					$row = mysqli_fetch_row($res);
					$precio = (double)$row[0];
					$importeSinIGV = $precio/(1+$tasaIGV);
					$importeIGV = $precio - $importeSinIGV;
					$importeTotal = $precio;
		//---------------------------------
		$consulta = "insert into PEDIDO_SERVICIO(pacienteID,tipo,via,tasaIGV,importeSinIGV,importeIGV,
									importeTotal,importePagado,estadoPago,timestamp)values
									('".$pacienteID."','".$tipo."','".$via."','".$tasaIGV."','".$importeSinIGV."','".$importeIGV."',
										'".$importeTotal."','".$importePagado."','".$estadoPago."','".$timestamp."');";
		if($medicoRef!=''){
			$consulta = "insert into PEDIDO_SERVICIO(pacienteID,tipo,via,tasaIGV,importeSinIGV,importeIGV,
									importeTotal,importePagado,estadoPago,timestamp,personalReferenciaID)values
									('".$pacienteID."','".$tipo."','".$via."','".$tasaIGV."','".$importeSinIGV."','".$importeIGV."',
										'".$importeTotal."','".$importePagado."','".$estadoPago."','".$timestamp."','".$medicoRef."');";
		}		
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		$pedidoServicioID = mysqli_insert_id($con);
		// mysqli_rollback($con);		
		if($pedidoServicioID>0){
			$consulta = "insert into cita(pedidoServicioID,pacienteID,medicoID,especialidadID,servicioID,
										tipo,fecha,hora,observaciones,estado,precio,cantidad) values
										('".$pedidoServicioID."','".$pacienteID."','".$medicoID."','".$especialidadID."',
											'".$servicioID."','".$tipo."','".$fecha."','".$hora."','".$motivo."','".$estado."',
											'".$precio."',1);";
			$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
			if($res){
				echo 1;
			}else{
				echo "No se pudo registrar la cita";
			}
		}else{
			echo "No se pudo registrar el pedido";
		}
		exit();
	}
	// REGISTRAR CITA LABORATORIO - 
	if($opc == 'RCL_01'){
		$pacienteID = $_POST['txtPacienteID'];
		$medicoRef = $_POST['txtCodigoMedicoRef'];
		$listaServicios = $_POST['listaServicios'];
		$especialidadID = '25';
		$via = $_POST['cboVia'];
		$estado = "R";	//Reservado
		$tipo = "L";  	//L: Laboratorio
		$estadoPago = "PEN";   //PE: Pendiente
		$importePagado = 0;
		$listaServicios = explode("&&", $listaServicios);
		$importeSinIGV = 0;
		$importeIGV = 0;
		$importeTotal = 0;
		// OBTENEMOS EL TOTAL DE LOS PRECIOS DE LOS SERVICIOS
					// $tasaIGV = 0.18; Variable global
					for($i=0;$i<count($listaServicios)-1;$i++){
						$fila = explode(",,", $listaServicios[$i]);
						$servicioID = $fila[0];
						$csPrecio = "select precioUnitario from servicio where servicioID = '".$servicioID."'";
						$res = mysqli_query($con,$csPrecio)or  die (mysqli_error($con));
						$row = mysqli_fetch_row($res);
						$precio = (double)$row[0];
						$importeSinIGV = $importeSinIGV + $precio/(1+$tasaIGV);
						$importeIGV = $importeIGV + $precio-$precio/(1+$tasaIGV);
						$importeTotal = $importeTotal + $precio;
					}
		$importeSinIGV = round($importeSinIGV, 2);
		$importeIGV = round($importeIGV, 2);
		$importeTotal = round($importeTotal, 2);
		//---------------------------------		
		// echo $importeSinIGV.'-';
		// echo $importeIGV.'-';
		// echo $importeTotal;

		$consulta = "insert into PEDIDO_SERVICIO(pacienteID,tipo,via,tasaIGV,importeSinIGV,importeIGV,
									importeTotal,importePagado,estadoPago,timestamp)values
									('".$pacienteID."','".$tipo."','".$via."','".$tasaIGV."','".$importeSinIGV."','".$importeIGV."',
										'".$importeTotal."','".$importePagado."','".$estadoPago."','".$timestamp."');";
		if($medicoRef!=''){
			$consulta = "insert into PEDIDO_SERVICIO(pacienteID,tipo,via,tasaIGV,importeSinIGV,importeIGV,
									importeTotal,importePagado,estadoPago,timestamp,personalReferenciaID)values
									('".$pacienteID."','".$tipo."','".$via."','".$tasaIGV."','".$importeSinIGV."','".$importeIGV."',
										'".$importeTotal."','".$importePagado."','".$estadoPago."','".$timestamp."','".$medicoRef."');";
		}
		$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));
		$pedidoServicioID = mysqli_insert_id($con);
		// mysqli_rollback($con);	
		if($pedidoServicioID>0){
			for($i=0;$i<count($listaServicios)-1;$i++){
				$fila = explode(",,", $listaServicios[$i]);
				$servicioID = $fila[0];
				$cantidad = $fila[1];
				$fecha = $fila[2];
				$fecha = str_replace("/","-",$fecha);
    		$fecha = date('Y/m/d',strtotime($fecha));
				$hora = $fila[3];
				$obs = $fila[4];
				$precio = $fila[5];
				$consulta = "insert into cita(pedidoServicioID,pacienteID,especialidadID,servicioID,
										tipo,fecha,hora,observaciones,estado,precio,cantidad) values
										('".$pedidoServicioID."','".$pacienteID."','".$especialidadID."',
											'".$servicioID."','".$tipo."','".$fecha."','".$hora."','".$obs."','".$estado."',
											'".$precio."','".$cantidad."');";
				$res = mysqli_query($con,$consulta)or  die (mysqli_error($con));				
			}
		}
		echo 1;
		exit();	
	}
	//CARGAR TABLA DE REFERENCIAS
	if($opc == 'CTR_01'){
		$mes = $_POST['mes'];
		$personalID = $_POST['personalID'];
	  // $estadoPago = $_POST['estadoPago'];
	  
		$consulta = "select PS.pedidoServicioID,P.nombres,P.apPaterno,P.apMaterno,E.especialidad,S.servicio,
									substring_index(PS.timestamp,' ',1) as 'fecha',PS.estadoPago,C.estado
								from PEDIDO_SERVICIO PS
								inner join PERSONAL PL ON PS.personalReferenciaID = PL.personalID
								inner join PERSONA P ON P.DNI = PL.DNI
								inner join CITA C ON C.pedidoServicioID = PS.pedidoServicioID
								left join ESPECIALIDAD E on E.especialidadID = C.especialidadID
								inner join SERVICIO S on S.servicioID = C.servicioID
								where MONTH(PS.timestamp) = '".$mes."'";
		if($personalID != 0){$consulta = $consulta." and PL.personalID = '".$personalID."'";}
		
		$res = mysqli_query($con,$consulta) or die(mysqli_error($con));
		$numReferencias = mysqli_num_rows($res);
		while($row = mysqli_fetch_row($res)){
			$nombresM = explode(" ", $row[1]);
			$medico = $nombresM[0].' '.$row[2].' '.$row[3];
			$especialidad = $row[4];
			$servicio = $row[5];			
			$fecha = str_replace("/","-",$row[6]);
	    $fecha = date('d-m-Y',strtotime($fecha));			
			$estadoPago = $row[7];
			$estadoCita = $row[8];
			

			if($estadoCita=='R') $estadoCita = "<span class='label label-warning'>Reservado</span>";
			else if($estadoCita=='S')	$estadoCita = "<span class='label label-primary'>En Sala</span>";
			else if($estadoCita=='A')	$estadoCita = "<span class='label label-success'>Atendido</span>";
			else if($estadoCita=='X') $estadoCita = "<span class='label label-danger'>Anulado</span>";

			if($estadoPago=='PEN') $estadoPago = "<span class='label label-danger'>Pendiente</span>";
			else if($estadoPago=='PAG')	$estadoPago = "<span class='label label-success'>Pagado</span>";
			else if($estadoPago == 'PAR')	$estadoPago = "<span class='label label-warning'>Parcial</span>";

			echo "<tr>												
							<td>".$medico."</td>
							<td>".$servicio."</td>
							<td>".$especialidad."</td>
							<td>".$fecha."</td>
							<td>".$estadoCita."</td>
							<td>".$estadoPago."</td>
						</tr>";
		}
		exit();
	}
 ?>