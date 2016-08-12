<?php 
  $mes = $_GET['mes'];
  $anio = $_GET['anio'];
  $fileName =  "reporte_".$mes."_".$anio.".xls";
  $link = "Content-Disposition: attachment; filename=".$fileName;  
  // header("Content-type: application/vnd.ms-excel");
  // header($link);
 ?>
<html>
<head>
  <meta charset="utf-8">
    <title></title>
</head>
<body>
        <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
        .tg .tg-s6z2{text-align:center}
        .tg .tg-d3l3{font-weight:bold;font-size:10px;text-align:center}
        .tg .tg-9hbo{font-weight:bold;vertical-align:top}
        .tg .tg-yw4l{vertical-align:top}
        .tg .tg-hgcj{font-weight:bold;text-align:center}
        </style>
          <table class="tg">
            <tr>
              <th class="tg-9hbo">PERIODO: </th>
              <th class="tg-9hbo">AGOSTO - 2016</th>
              <th class="tg-yw4l" colspan="9"></th>
            </tr>
            <tr>
              <td class="tg-hgcj" rowspan="3">N°<br>CORRELATIVO</td>
              <td class="tg-hgcj" rowspan="3">FECHA DE <br>EMISIÓN DEL<br>COMPROBANTE <br>DE PAGO</td>
              <td class="tg-hgcj" colspan="3">COMPROBANTE DE PAGO</td>
              <td class="tg-hgcj" colspan="3">INFORMACIÓN DEL CLIENTE</td>
              <td class="tg-hgcj" rowspan="3">BASE<br>IMPONIBLE</td>
              <td class="tg-hgcj" rowspan="3">IGV</td>
              <td class="tg-hgcj" rowspan="3">IMPORTE <br>TOTAL</td>
            </tr>
            <tr>
              <td class="tg-hgcj" rowspan="2">TIPO <br>(TABLA 10)</td>
              <td class="tg-hgcj" rowspan="2">N° <br>SERIE</td>
              <td class="tg-hgcj" rowspan="2">NÚMERO</td>
              <td class="tg-hgcj" colspan="2">DOCUMENTO DE INDENTIDAD</td>
              <td class="tg-hgcj" rowspan="2">APELLIDOS Y NOMBRES,<br>DENOMINACIÓN O<br>RAZÓN SOCIAL</td>
            </tr>
            <tr>
              <td class="tg-hgcj">TIPO<br>(TABLA 2)</td>
              <td class="tg-hgcj">NÚMERO</td>
            </tr>
            <?php 
              require('../bd/bd_conexion.php');
              $consulta = "SELECT P.pagoID,P.pedidoServicioID,P.comprobanteID,P.numeroSerie,
                          P.numeroComprobante,P.IGV,P.importeSinIGV,P.importeIGV,P.importeTotal,
                          P.fechaPago,P.estado,
                          PE.nombres,PE.apPaterno,PE.apMaterno,PE.DNI,PE.telefono1,
                          CP.descripcion
                          FROM PAGO P
                          INNER JOIN PEDIDO_SERVICIO PS ON PS.pedidoServicioID = P.pedidoServicioID
                          INNER JOIN PACIENTE PA ON PA.pacienteID = PS.pacienteID
                          INNER JOIN PERSONA PE ON PE.DNI = PA.DNI
                          INNER JOIN COMPROBANTE_PAGO CP ON CP.comprobanteID = P.comprobanteID
                          WHERE MONTH(P.fechaPago) = '".$mes."' and YEAR(P.fechaPago) = '".$anio."'
                          ";
              $res = mysqli_query($con,$consulta)or die (mysqli_error($con));
              $cont = 1;
              while($row = mysqli_fetch_row($res)){
                $fechaPago = str_replace("/","-",$row[9]);
                $fechaPago = date('d-m-Y',strtotime($fechaPago));                
                $comprobanteID = $row[2];
                $serie = $row[3];
                if($serie == '') $serie = '-';
                $numeroC = $row[4];
                if($numeroC == '') $numeroC = '-';
                $DNI = $row[14];
                $apPaterno = $row[12];
                $apMaterno = $row[13];
                $nombres = $row[11];
                $VV = $row[6];
                $importeIGV = $row[7];
                $total = $row[8];
                ?>
                  <tr>
                    <td class="tg-s6z2"><?php echo $cont++; ?></td>
                    <td class="tg-s6z2"><?php echo $fechaPago; ?></td>
                    <td class="tg-s6z2"><?php echo $comprobanteID; ?></td>
                    <td class="tg-s6z2"><?php echo $serie; ?></td>
                    <td class="tg-s6z2"><?php echo $numeroC; ?></td>
                    <td class="tg-s6z2"><?php echo "01";  ?></td>
                    <td class="tg-s6z2"><?php echo $DNI;  ?></td>
                    <td class="tg-s6z2"><?php echo $apPaterno." ".$apMaterno." ".$nombres ?></td>
                    <td class="tg-s6z2"><?php echo $VV; ?></td>
                    <td class="tg-s6z2"><?php echo $importeIGV; ?></td>
                    <td class="tg-s6z2"><?php echo $total; ?></td>
                  </tr>
                <?php 
              }
             ?>
             <?php 
                $consulta = "SELECT sum(importeSinIGV),sum(importeIGV),sum(importeTotal)
                          FROM PAGO 
                          WHERE MONTH(fechaPago) = '".$mes."' and YEAR(fechaPago) = '".$anio."'
                          ";
                $res = mysqli_query($con,$consulta)or die (mysqli_error($con));
                $cont = 1;
                while($row = mysqli_fetch_row($res)){
                  ?>
                    <tr>
                      <td class="tg-s6z2"></td>
                      <td class="tg-s6z2"></td>
                      <td class="tg-s6z2"></td>
                      <td class="tg-s6z2"></td>
                      <td class="tg-s6z2"></td>
                      <td class="tg-s6z2"></td>
                      <td class="tg-s6z2"></td>
                      <td class="tg-hgcj">TOTAL</td>
                      <td class="tg-hgcj"><?php echo $row[0]; ?></td>
                      <td class="tg-hgcj"><?php echo $row[1]; ?></td>
                      <td class="tg-hgcj"><?php echo $row[2]; ?></td>
                    </tr>
                  <?php 
                }
              ?>
          </table>
</table>
</body>
</html>