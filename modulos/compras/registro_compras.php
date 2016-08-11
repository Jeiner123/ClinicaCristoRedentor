<?php
  header("Content-type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=reporte.xls");
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
  .tg .tg-nrw1{font-size:10px;text-align:center;vertical-align:top}
  .tg .tg-62xo{font-weight:bold;font-size:14px;text-align:center;vertical-align:top}
  .tg .tg-r8vz{font-weight:bold;font-size:11px;vertical-align:top}
  .tg .tg-3j8g{font-weight:bold;font-size:10px;text-align:center;vertical-align:top}
  </style>
  <table class="tg">
    <tr>
      <th class="tg-62xo" colspan="28">FORMATO 8.1: REGISTRO DE COMPRAS</th>
    </tr>
    <tr>
      <td class="tg-r8vz" colspan="28">PERIODO:</td>
    </tr>
    <tr>
      <td class="tg-r8vz" colspan="28">RUC:</td>
    </tr>
    <tr>
      <td class="tg-r8vz" colspan="28">APELLIDOS Y NOMBRES, DENOMINACIÓN O RAZÓN SOCIAL:</td>
    </tr>
    <tr>
      <td class="tg-nrw1" rowspan="3"><br><br><br><br><br>NÚMERO <br>CORRELATIVO <br>DEL REGISTRO O <br>CÓDIGO UNICO <br>DE LA OPERACIÓN</td>
      <td class="tg-nrw1" rowspan="3"><br><br><br><br><br>FECHA DE <br>EMISIÓN DEL<br>COMPROBANTE <br>DE PAGO <br>O DOCUMENTO</td>
      <td class="tg-nrw1" rowspan="3"><br><br><br><br><br>FECHA<br>DE<br>VENCIMIENTO<br>O FECHA<br>DE PAGO (1)</td>
      <td class="tg-nrw1" colspan="3"><br><br>COMPROBANTE DE PAGO<br>O DOCUMENTO</td>
      <td class="tg-nrw1" rowspan="3">N° DE<br>COMPROBANTE DE PAGO,DOCUMENTO, N° DE ORDEN DEL FORMULARIO FÍSICO O VIRTUAL,<br>N° DE DUA, DSI O LIQUIDACIÓN DE COBRANZA U OTROS DOCUMENTOS EMITIDOS POR SUNAT PARA ACREDITAR EL CRÉDITO FISCAL EN LA IMPORTACIÓN</td>
      <td class="tg-nrw1" colspan="3"><br><br><br><br>INFORMACIÓN DEL<br>PROVEEDOR</td>
      <td class="tg-nrw1" colspan="2">ADQUISICIONES GRAVADAS DESTINADAS A OPERACIONESGRAVADAS Y/O DE EXPORTACIÓN</td>
      <td class="tg-nrw1" colspan="2">ADQUISICIONES GRAVADAS DESTINADAS A OPERACIONESGRAVADAS Y/O DE EXPORTACIÓN Y A OPERACIONES NO GRAVADAS</td>
      <td class="tg-nrw1" colspan="2">ADQUISICIONES GRAVADAS DESTINADAS A OPERACIONES<br>NO GRAVADAS</td>
      <td class="tg-nrw1" rowspan="3"><br><br><br><br><br><br>VALOR<br>DE LAS<br>ADQUISIONES NO GRAVADAS</td>
      <td class="tg-nrw1" rowspan="3"><br><br><br><br><br><br><br><br>ISC</td>
      <td class="tg-nrw1" rowspan="3"><br><br><br><br><br><br><br>OTROS TRIBUTOS Y CARGOS</td>
      <td class="tg-nrw1" rowspan="3"><br><br><br><br><br><br><br><br>IMPORTE TOTAL</td>
      <td class="tg-nrw1" rowspan="3"><br><br><br><br>Nº DE COMPROBANTE DE PAGO EMITIDO POR SUJETO NO DOMICILIADO (2)<br></td>
      <td class="tg-nrw1" colspan="2"><br>CONSTANCIA DE DEPÓSITO DE DETRACCIÓN</td>
      <td class="tg-nrw1" rowspan="3"><br><br><br><br>TIPO DE CAMBIO</td>
      <td class="tg-3j8g" colspan="4"><br>REFERENCIA DEL COMPROBANTE DE PAGO<br>O DOCUMENTO ORIGINAL QUE SE MODIFICA</td>
    </tr>
    <tr>
      <td class="tg-nrw1" rowspan="2"><br><br><br>TIPO<br>(TABLA 10)</td>
      <td class="tg-nrw1" rowspan="2"><br>SERIE O<br>CÓDIGO DE LA<br>DEPENDENCIA<br>ADUANERA<br>(TABLA 11)</td>
      <td class="tg-nrw1" rowspan="2"><br>AÑO DE<br>EMISIÓN DE<br>LA DUA<br>O DSI</td>
      <td class="tg-nrw1" colspan="2">DOCUMENTO DE IDENTIDAD</td>
      <td class="tg-nrw1" rowspan="2"><br>APELLIDOS<br>YNOMBRES,<br>DENOMINACIÓN<br>O RAZÓN<br>SOCIAL</td>
      <td class="tg-nrw1" rowspan="2"><br><br>BASE IMPONIBLE</td>
      <td class="tg-nrw1" rowspan="2"><br><br>IGV<br></td>
      <td class="tg-nrw1" rowspan="2"><br><br>BASE IMPONIBLE</td>
      <td class="tg-nrw1" rowspan="2"><br>IGV</td>
      <td class="tg-nrw1" rowspan="2"><br>BASE IMPONIBLE</td>
      <td class="tg-nrw1" rowspan="2"><br>IGV</td>
      <td class="tg-nrw1" rowspan="2"><br><br><br>NÚMERO<br></td>
      <td class="tg-nrw1" rowspan="2"><br>FECHA DE EMISIÓN<br></td>
      <td class="tg-nrw1" rowspan="2"><br><br><br><br>FECHA</td>
      <td class="tg-nrw1" rowspan="2"><br>TIPO<br>(TABLA 10)</td>
      <td class="tg-3j8g" rowspan="2"><br><br>SERIE</td>
      <td class="tg-3j8g" rowspan="2"><br>Nº DEL COMPROBANTE DE PAGO O DOCUMENTO</td>
    </tr>
    <tr>
      <td class="tg-3j8g">TIPO<br>(TABLA 2)</td>
      <td class="tg-3j8g">NÚMERO</td>
    </tr>
  </table>
</body>
</html>