<?php include '../../general/variables.php';?>
<?php
	require('../../bd/bd_conexion.php');
	$opc = $_POST['opc'];

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

	if($opc=='RRQ_03'){
		$i=0;
		$consulta = "SELECT DATE_FORMAT(R.fecha, '%d-%m-%Y'),A.area,concat(PS.nombres,' ',PS.apPaterno,' ',PS.apMaterno),DR.producto,DR.unidadMedida,DR.descripcion,DR.stock,DR.requerimiento,DR.estado,DR.requerimientoID,DR.item FROM requerimiento R inner join personal P on R.personalID=P.personalID inner join cargo C on P.cargoID=C.cargoID inner join area A on C.areaID=A.areaID inner join persona PS ON PS.personaID=P.personaID inner join detalle_requerimiento DR on DR.requerimientoID=R.requerimientoID";
	
		$res = mysqli_query($con,$consulta) or die (mysqli_error($con));
			while($row = mysqli_fetch_row($res)){
				$i++;
				
				if($row[8]=='P'){
					$estado = "<span class='label label-warning'>Pendiente</span>";
				}else{
					if($row[8]=='A'){
						$estado = "<span class='label label-success'>Aprobado</span>";
					}else{
						if($row[8]=='R'){
							$estado = "<span class='label label-danger'>Rechazado</span>";
						}
					}
				}

				$aprobar='A';
				$rechazar='R';
				$requerimientoID=$row[9];
				$item=$row[10];

				echo "<tr>					
						<td style='text-align:center;'>".$i."</td>		
						<td style='text-align:center;'>".$row[0]."</td>		
						<td style='text-align:center;'>".$row[1]."</td>		
						<td>".$row[2]."</td>
						<td>".$row[3]." ".$row[5]." (".$row[4].")</td>
						<td style='text-align:center;'>".$row[6]."</td>
						<td style='text-align:center;'>".$estado."</td>
						<td style='text-align:center;'>
						<div>
			              <div class='inline pos-rel dropup'>
			                <button  class='btn btn-secundary btn-flat btn-lista-flotante dropdown-toggle btn-xs'  data-toggle='dropdown' data-position='auto' aria-expanded='true'>
			                    <i class='ace-icon fa fa-caret-down icon-only bigger-120'></i>
			                </button>

			                <ul class='lista-flotante dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close '>
				                <li>
			                      <button type='button' class='btn btn-block btn-transparente btn-flat btn-xs' onclick='UpdateEstadoRequerimiento(\"".$aprobar."\",\"".$requerimientoID."\",\"".$item."\");'>
			                      	<span class='text-blue'>
			                          <i class='ace-icon fa fa-remove bigger-120'></i>
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
					        </ul>
	              			</div>
						</td>
					</tr>";
		}	
	}

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


?>


	
	
