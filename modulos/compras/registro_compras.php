<?php include '../general/variables.php';?>
<?php
  require('../bd/bd_conexion.php');
  $mes=$_POST['txtMesID'];
  $anio=$_POST['txtAnio'];
  $periodo= $meses[$mes]." - ".$anio;

  header("Content-type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=Compras ".$periodo.".xls");
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
   
</head>
<body>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-huh1{font-weight:bold;font-size:10px;background-color:#000080;color:#ffffff;vertical-align:top}
.tg .tg-3cwu{font-weight:bold;font-size:10px;vertical-align:top;border:0px;}
.tg .tg-4cwu{font-size:10px;vertical-align:top;text-align: center;}
.tg .tg-5dbx{font-weight:bold;font-size:10px;background-color:#000080;color:#ffffff;text-align:center;vertical-align:top}
</style>
<table class="tg">
  <tr>
    <th class="tg-3cwu" colspan="22">FORMATO 8.1: REGISTRO DE COMPRAS</th>
  </tr>
  <tr>
    <td class="tg-3cwu" colspan="22">PERIODO: <?php echo $periodo;?></td>
  </tr>
  <tr>
    <td class="tg-3cwu" colspan="22">RUC: 20559596257</td>
  </tr>
  <tr>
    <td class="tg-3cwu" colspan="22">APELLIDOS Y NOMBRES, DENOMINACIÓN O RAZÓN SOCIAL:  EMPRESA DE SERVICIOS MEDICOS CRISTO REDENTOR S.A.C.</td>
  </tr>
  <tr>
    <td class="tg-5dbx" rowspan="2"><br><br><br>N° Correlativo<br></td>
    <td class="tg-5dbx" rowspan="2"><br><br><br>Fecha.Em<br></td>
    <td class="tg-5dbx" rowspan="2"><br><br><br>Fecha Venc<br></td>
    <td class="tg-5dbx" rowspan="2"><br><br><br>Tipo.Comp.<br></td>
    <td class="tg-5dbx" rowspan="2"><br><br><br>Serie<br></td>
    <td class="tg-5dbx" rowspan="2"><br><br><br>Número<br></td>
    <td class="tg-5dbx" rowspan="2"><br><br><br>Tip.Doc.Id.<br></td>
    <td class="tg-5dbx" rowspan="2"><br><br><br>Num.Doc.Id.<br></td>
    <td class="tg-5dbx" rowspan="2"><br><br><br>Razon.Social<br></td>
    <td class="tg-5dbx" rowspan="2"><br><br><br>Op.Gravada<br></td>
    <td class="tg-5dbx" rowspan="2"><br><br><br>Op.No.Gravada<br></td>
    <td class="tg-5dbx" rowspan="2"><br><br><br>Descuento<br></td>
    <td class="tg-5dbx" rowspan="2"><br><br><br>Percepcion<br></td>
    <td class="tg-5dbx" rowspan="2"><br><br><br>IGV<br></td>
    <td class="tg-5dbx" rowspan="2"><br><br><br>Honorarios<br></td>
    <td class="tg-5dbx" rowspan="2"><br><br><br>Retencion<br></td>
    <td class="tg-5dbx" rowspan="2"><br><br><br>Total<br></td>
    <td class="tg-5dbx" rowspan="2"><br><br>Constancia<br>detracción<br>fecha</td>
    <td class="tg-5dbx" rowspan="2"><br><br><br>T/C<br></td>
    <td class="tg-5dbx" colspan="3">Referencia del documento<br>que se modifica<br></td>
  </tr>
  <tr>
    <td class="tg-huh1">Fecha</td>
    <td class="tg-huh1">Tipo</td>
    <td class="tg-huh1">Serie/Número</td>
  </tr>
  <?php
    $opGravada='0.000';
    $opNoGravada='0.000';
    $honorarios='0.000';
    $consulta = "select C.codigo,C.fechaEmision,C.fechaVencimiento,C.comprobanteID,C.serie,C.numero,P.tipoDocumento,C.proveedorID,IF(P.razonSocial='',UPPER(concat(P.nombres,' ',P.apellidoPat,' ',P.apellidoMat)),UPPER(P.razonSocial)),C.descuento,C.percepcion,C.impuesto,C.tipoAdquisicionID,C.precioVenta,C.valorRenta,C.totalBruto from compra C inner join PROVEEDOR P on C.proveedorID=P.proveedorID where mesID='".$mes."' and anio='".$anio."' order by C.codigo";
  
    $res = mysqli_query($con,$consulta) or die (mysqli_error($con));
      while($row = mysqli_fetch_row($res)){
        $tipoAdquisicionID=$row[12];
        $comprobanteID=$row[3];

        if( $tipoAdquisicionID==1){
          $opGravada=$row[15];
        }
        if( $tipoAdquisicionID==3){
          $opNoGravada=$row[15];
        }
        if($comprobanteID=='02'){
          $opGravada='0.000';
          $opNoGravada='0.000';
          $honorarios=$row[15];
        }else{
          $honorarios='0.000';
        }

        if($comprobanteID=='07' || $comprobanteID=='14'){
          $fechaVencimiento=$row[2];
        }else{
          $fechaVencimiento='';
        }

        if($comprobanteID=='07'){
          $fecha=$row[2];
          $tipo=$comprobanteID;
          $SerieNum=$row[4]."/".$row[5];
        }else{
          $fecha='';
          $tipo='';
          $SerieNum='';
        }

        echo "<tr>
                <td class='tg-4cwu'>".$row[0]."</td>
                <td class='tg-4cwu'>".$row[1]."</td>
                <td class='tg-4cwu'>".$fechaVencimiento."</td>
                <td class='tg-4cwu'>&nbsp;".$row[3]."</td>
                <td class='tg-4cwu'>&nbsp;".$row[4]."</td>
                <td class='tg-4cwu'>&nbsp;".$row[5]."</td>
                <td class='tg-4cwu'>".$row[6]."</td>
                <td class='tg-4cwu'>".$row[7]."</td>
                <td class='tg-4cwu'>".$row[8]."</td>
                <td class='tg-4cwu' style='mso-number-format:"."\"0.00\"".";'>".number_format($opGravada, 2, ',', '')."</td>
                <td class='tg-4cwu' style='mso-number-format:"."\"0.00\"".";'>".number_format($opNoGravada, 2, ',', '')."</td>
                <td class='tg-4cwu' style='mso-number-format:"."\"0.00\"".";'>".number_format($row[9], 2, ',', '')."</td>
                <td class='tg-4cwu' style='mso-number-format:"."\"0.00\"".";'>".number_format($row[10], 2, ',', '')."</td>
                <td class='tg-4cwu' style='mso-number-format:"."\"0.00\"".";'>".number_format($row[11], 2, ',', '')."</td>
                <td class='tg-4cwu' style='mso-number-format:"."\"0.00\"".";'>".number_format($honorarios, 2, ',', '')."</td>
                <td class='tg-4cwu' style='mso-number-format:"."\"0.00\"".";'>".number_format($row[14], 2, ',', '')."</td>
                <td class='tg-4cwu' style='mso-number-format:"."\"0.00\"".";'>".number_format($row[13], 2, ',', '')."</td>
                <td class='tg-4cwu'></td>
                <td class='tg-4cwu' style='mso-number-format:"."\"0.00\"".";'>0,00</td>
                <td class='tg-4cwu'>".$fecha."</td>
                <td class='tg-4cwu'>".$tipo."</td>
                <td class='tg-4cwu'>".$SerieNum."</td>
              </tr>";
      }
  ?>
</table>
</body>
</html>