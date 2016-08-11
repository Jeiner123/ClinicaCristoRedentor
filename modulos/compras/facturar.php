<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<?php 
  $opcion='N';
  $mesID = '';
  $anioID = '';
  $codigo = '';
  $monto = '';
  $igv = '';

  if(isset($_POST['txtIgvP'])){
    $opcion = $_POST['txtOpcion'];
    $mesID = $_POST['txtmesID'];
    $anioID = $_POST['txtAnioID'];
    $codigo = $_POST['txtNum'];
    $igv = $_POST['txtIgvP'];
  }else{
    exit();
  }

  if(isset($_POST['txtMontoP'])){
    $monto = $_POST['txtMontoP'];
  }
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Movimientos de caja | CLÍNICA CRISTO REDENTOR</title>
  <?php include '../general/header.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <?php include '../general/menu_principal.php';?>

<div class="wrapper">
  <?php include '../general/izquierda_menu.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="tituloPagina">
        Registrar movimiento de caja
        <!-- <small>Consultorio - Laboratorio</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="listado_pacientes.php">Compras</a>
        </li>
        <li class="active">
          movimiento de caja
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <form class="form-horizontal" role="form" method="post" id="formPagoCompra" name="formPagoCompra" enctype="multipart/form-data">
        <div class="box box-primary color-palette-box">          
          <div class="box-body">
            <input id="txtFlag" name="txtFlag" class="form-control" type="hidden" value="<?php echo $opcion; ?>">
            <input id="txtMes" name="txtMes"class="form-control input-sm" type="hidden">
            <input id="txtAnio" name="txtAnio"class="form-control input-sm" type="hidden">
             <input id="txtMesRef" name="txtMesRef"class="form-control input-sm"  value="<?php echo $mesID; ?>" type="hidden">
            <input id="txtAnioRef" name="txtAnioRef"class="form-control input-sm"  value="<?php echo $anioID; ?>" type="hidden">
             <input id="txtCodigoRef" name="txtCodigoRef" class="form-control input-sm" value="<?php echo $codigo; ?>" type="hidden">
            <div class="row">
              <div class="col-md-2">
                <label class="control-label">Periodo</label>
                <input type="text" id="txtPeriodo"  name="txtPeriodo" class="form-control input-sm" readonly="">
              </div>
              <div class="col-md-4">
                <label class="control-label">Proveedor</label>
                <input type="hidden" id="txtProveedorID"  name="txtProveedorID" class="form-control input-sm">
                <input type="text" id="txtProveedor" name="txtProveedor"class="form-control input-sm" readonly="">
              </div>
              <div class="col-md-3">
                <label class="control-label">Emitido</label>
                <div class="input-group">
                  <input id="txtFechaEmision" name="txtFechaEmision"class="form-control date-picker" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);" value="<?php echo $fechaHoyDMA;?>">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
               <div class="col-md-3">
                <label class="control-label">Fecha de vcto.</label>
                <div class="input-group">
                  <input id="txtFechaVcto" name="txtFechaVcto"class="form-control input-sm date-picker" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);" readonly="">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
             
            </div>
            <div class="row">
              <input type="hidden" id="txtBoolIGV" name="txtBoolIGV"class="form-control input-sm" readonly="">
              <div class="col-md-2">
                <label class="control-label">Serie-Número</label>
                <input type="text" id="txtSerie" name="txtSerie"class="form-control input-sm" readonly="">
              </div>
              <div class="col-md-2" hidden id="divPrecioVenta">
                <label class="control-label">Precio de venta</label>
                <input type="text" readonly id="txtPrecioVenta" name="txtPrecioVenta"class="form-control input-sm">
              </div>
              <div class="col-md-2" hidden id="divRenta">
                <label class="control-label">Renta</label>
                <input type="text" readonly id="txtRenta" name="txtRenta"class="form-control input-sm">
              </div>
              <div class="col-md-2" hidden id="divDetraccion">
                <label class="control-label">Detraccion</label>
                <input type="text" readonly id="txtDetraccion" name="txtDetraccion"class="form-control input-sm">
              </div>
              <div class="col-md-2" hidden id="divPercepcion">
                <label class="control-label">Percepcion</label>
                <input type="text" readonly id="txtPercepcion" name="txtPercepcion"class="form-control input-sm">
              </div>
              <div class="col-md-2" hidden id="divRetencion">
                <label class="control-label">Retencion</label>
                <input type="text" readonly id="txtRetencion" name="txtRetencion"class="form-control input-sm">
              </div>
               <div class="col-md-2">
                <label class="control-label">Total</label>
                <input type="text" id="txtTotal" name="txtTotal"class="form-control input-sm" placeholder="S/." readonly="">
              </div>
              <div class="col-md-2">
                <label class="control-label">Debe</label>
                <input type="text" id="txtSaldo" name="txtSaldo" class="form-control input-sm" readonly="">
              </div>
              <div class="col-md-2">
                <label class="control-label">Monto</label>
                <input type="text" id="txtMonto" name="txtMonto"class="form-control input-sm" placeholder="S/." value="<?php echo $monto;?>" onchange="descomponerPago('<?php echo $igv;?>');">
              </div>
               <div class="col-md-6">
                <label class="control-label">Forma de pago</label>
                <select class="chosen-select input-sm" name="cboMedioPago" id="cboMedioPago" onchange="ValidarMedioPago()">
                  
                </select>
              </div>
               <div class="col-md-2">
                <label class="control-label">Valor venta</label>
                <input type="text" id="txtValorVenta" name="txtValorVenta" class="form-control input-sm" readonly="">
              </div>
              <div class="col-md-2">
                <label class="control-label">I.G.V</label>
                <input type="text" id="txtIGV" name="txtIGV" class="form-control input-sm" readonly="" placeholder="<?php echo ($igv*100)."%";?>">
              </div>
              
            </div>
            <div class="row" id="divExtra" hidden>
              <div class="col-md-12"><hr>
                <h4 class="subfuente text-left" id="subtitulo"></h4>
              </div>
              <div class="col-md-4">
                <label class="control-label">Entidad bancaria</label>
                <select class="chosen-select input-sm" id="cboBanco" name="cboBanco">
                </select> 
              </div>
              <div class="col-md-3 cuenta">
                <label class="control-label">Cuenta</label>
                <input type="text" id="txtCuenta" name="txtCuenta"class="form-control input-sm">
              </div>
              <div class="col-md-2 cuenta">
                <label class="control-label">Voucher</label>
                <input type="text" id="txtVoucher" name="txtVoucher"class="form-control input-sm">
              </div>
              <div class="col-md-2 ck" hidden>
                <label class="control-label">Número</label>
                <input type="text" id="txtNumeroCheque" name="txtNumeroCheque"class="form-control input-sm">
              </div>
              <div class="col-md-3 ck" hidden>
                <label class="control-label">Fecha de vcto.</label>
                <div class="input-group">
                  <input id="txtFechaVctoCk" name="txtFechaVctoCk"class="form-control date-picker" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
            </div>
          
            <div class="row">
              <div class="col-md-12">
                <h4 class="subfuente text-left">Detalle del pago</h4>
              </div>
              <div class="col-md-10 col-md-offset-1">
                <table id="tablaDetallePago" class="table table-bordered table-hover tablaDetallePago">
                  <thead>
                    <tr class="success">
                      <th width="5%" style="text-align:center;">Item</th>
                      <th width="25%">Descripcion</th>
                      <th width="10%" style="text-align:center;">Cantidad</th>
                      <th width="5%">Costo Unit.</th>
                      <th width="5%" style="text-align:center">Importe</th>
                    </tr>
                  </thead>
                  <tbody class="cuerpoTabla" id="cuerpoTablaDetallePago">
                    <!-- Aqui irán los elementos de la tabla -->
                  </tbody>
                </table>
                <hr>
              </div>
            </div>
          </div>
          <!-- BOx-body -->
          <div class="box-footer" align="ceter">
            <div class="row" align="center">
             <div class="col-md-4" style="top:20px!important;">
                  <button type="button" class="btn btn-primary btn-block" onclick="RegistrarPagoCompra()" id="btnGuardar">Registrar pago</button>
              </div>
              <div class="col-md-4" style="top:20px!important;">
                <a href="movimientos_caja.php" onclick="" class="btn btn-default btn-block">Ver movimientos de caja</a>
              </div>
              <div class="col-md-4" style="top:20px!important;">
                <a href="cuenta_pagar.php" onclick="" class="btn btn-default btn-block">Ver cuentas por pagar</a>
              </div>                  
            </div><br><br>
          </div>
        </div>
      </form>
      <!-- Formulario registrar nuevo paciente -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- /.modalPeriodo -->
      <div class="modal fade" id="modalPeriodo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="center">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 id="titulo" class="modal-title subfuente text-center">
                    Seleccionar periódo
                  </h4>
              </div>
              <!-- /.modal-header -->
              <div class="modal-body">
                <div class="row">
                   <div class="col-md-7">
                    <select class="form-control input-sm" name="cboMes" id="cboMes">
                      <?php
                        foreach ($meses as $mes => $value) {
                          echo '<option value="'.$mes.'">'.$meses[$mes].'</option>';
                        }
                      ?>
                    </select>
                    <label class="control-label" style="color:red;font-size: 10px;" id="lbError"></label>
                  </div>
                  <div class="col-md-5">
                    <select class="form-control input-sm" name="cboAnio" id="cboAnio">
                    <?php 
                      $anio=date('Y');
                      for ($i=2;$i>=1;--$i): 
                        echo '<option value="'.$anio.'">'.$anio.'</option>';
                        $anio=intval($anio)-1;
                      endfor; ?>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.modal-footer -->
              <div class="modal-footer">                  
                <div class="row" align="center">
                  <input  onClick="generarPeriodoPago('<?php echo date('m');?>','<?php echo date('Y');?>');" value="Aceptar" style="margin-right:20px;" type="button" class="btn btn-secundary btn-flat" id="btnGuardar"/>                  
                </div>
              </div>
              <!-- /.modal-footer -->
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-Dialog -->
      </div>
      <!-- /.modalPeriodo -->
  <?php include '../general/pie_pagina.php';?>
  
</body>
</html>
<script src="js/script.js"></script>
<script type="text/javascript">
  datosParaPago();
</script>
