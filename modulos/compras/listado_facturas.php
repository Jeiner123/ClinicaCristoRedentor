<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title>Facturas | CLÍNICA CRISTO REDENTOR</title>
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
      <h1>
        Cuenta corriente por pagar
        <!-- <small>Lista - Registro - Actualización</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="listado_pacientes.php">Compras</a>
        </li>
        <li class="active">
          Cuenta corriente por pagar
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Listado de documentos de pago</h3>
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>        
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          <div class="row">
            <div class="col-md-12">
              <table id="tablaFactura" class="table table-bordered table-hover tablaDatos">
                <thead>
                  <tr>
                    <th>Periódo</th>
                    <th>Serie</th>
                    <th>Número</th>
                    <th style="text-align:center">Fecha de factura</th>
                    <th style="text-align:center">Fecha de vcto.</th>
                    <th style="text-align:center">Total</th>
                    <th style="text-align:center">Estado</th>
                    <th style="text-align:center">Opciones</th>
                  </tr>
                </thead>
                <tbody class="cuerpoTabla" id="cuerpoTablaFactura">
                  <!-- Aqui irán los elementos de la tabla -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- Lista de items -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="control-sidebar-bg"></div>
</div>

<!-- /.modalPagos -->
      <div class="modal fade" id="modalPagos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="center">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          <form>
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 id="titulo" class="modal-title subfuente text-center">
                    Registro de pago
                  </h4>
              </div>
              <!-- /.modal-header -->
              <div class="modal-body">
                <div class="row">
                  
                  <div class="col-md-4">
                    <label class="control-label">Proveedor</label>
                    <input type="text" id="txtProveedor" name="txtProveedor"class="form-control input-sm">
                  </div>
                  <div class="col-md-3">
                    <label class="control-label">Emitido</label>
                    <div class="input-group">
                      <input id="txtFechaEmision" name="txtFechaEmision"class="form-control date-picker" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);">
                      <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="cboTipoOperacion">Tipo de comprobante</label>
                    <select class="chosen-select input-sm" name="cboComprobante" id="cboComprobante">
                      </select>
                  </div>
                  <div class="col-md-2">
                    <label class="control-label">Correlativo</label>
                    <input type="text" id="txtCorrelativo" name="txtCorrelativo"class="form-control input-sm">
                  </div>
                
                </div>
                <div class="row">
                  <div class="col-md-2">
                    <label class="control-label">Serie</label>
                    <input type="text" id="txtSerie" name="txtSerie"class="form-control input-sm">
                  </div>
                  <div class="col-md-2">
                    <label class="control-label">Número</label>
                    <input type="text" id="txtNumero" name="txtNumero"class="form-control input-sm">
                  </div>
                  <div class="col-md-2">
                    <label class="control-label">Subtotal</label>
                    <input type="text" id="txtSubTotal" name="txtSubTotal"class="form-control input-sm" placeholder="S/.">
                  </div>
                  <div class="col-md-2">
                    <label class="control-label">Impuesto</label>
                    <input type="text" id="txtImpuesto" name="txtImpuesto"class="form-control input-sm" placeholder="S/.">
                  </div>
                   <div class="col-md-2">
                    <label class="control-label">Total</label>
                    <input type="text" id="txtTotal" name="txtTotal"class="form-control input-sm" placeholder="S/.">
                  </div>
                   <div class="col-md-2">
                    <label class="control-label">Forma de pago</label>
                    <select class="form-control input-sm" name="cboFormaPago" id="cboFormaPago">
                      <option value="1">Efectivo</option>
                      <option value="2">Cheque</option>
                      <option value="3">Depósito bancario</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12"><hr>
                    <h4 class="subfuente text-left">Detalle pago con cheque</h4>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label">Entidad bancaria</label>
                    <select class="chosen-select input-sm" id="cboBanco" name="cboBanco">
                    </select> 
                  </div>
                  <div class="col-md-2">
                    <label class="control-label">Número</label>
                    <input type="text" id="txtNumeroCheque" name="txtNumeroCheque"class="form-control input-sm">
                  </div>
                  <div class="col-md-3 col-md-offset-1">
                    <label class="control-label">Fecha de vcto.</label>
                    <div class="input-group">
                      <input id="txtFechaVcto" name="txtFechaVcto"class="form-control date-picker" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);">
                      <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label class="control-label">Monto</label>
                    <input type="text" id="txtMontoCheque" name="txtMontoCheque"class="form-control input-sm" placeholder="S/.">
                  </div>
                  <div class="col-md-12"><hr></div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="subfuente text-left">Detalle del pago</h4>
                  </div>
                  <div class="col-md-12">
                    <table id="tablaDetallePago" class="table table-bordered table-hover tablaDetallePago">
                      <thead>
                        <tr>
                          <th>Item</th>
                          <th>Descripcion</th>
                          <th>Cantidad</th>
                          <th>Costo Unit.</th>
                          <th style="text-align:center">Importe</th>
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
              <!-- /.modal-footer -->
              <div class="modal-footer">                  
                <div class="row" align="center">
                  <input  onClick="generarPeriodo('<?php echo date('m');?>','<?php echo date('Y');?>');" value="Registrar pago" style="margin-right:20px;" type="button" class="btn btn-secundary btn-flat" id="btnGuardar"/>                  
                </div>
              </div>
              <!-- /.modal-footer -->
              </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-Dialog -->
      </div>
      <!-- /.modalPagos -->
<!-- ./wrapper -->
  <?php include '../general/pie_pagina.php';?>  
</body>
</html>
<script src="js/script.js"></script>
<style type="text/css">
  .datepicker{z-index:1151 !important;}
</style>
<script type="text/javascript">
  cargarCboComprobante('00');
  cargarCboEntidadFinanciera('01')
  cargarTablaFactura();
   $('.date-picker').datepicker({
    autoclose: true,
    todayHighlight: true
  })    
  $('#tablaFactura tbody').on('click','tr',function(){seleccionSimple(this);});  
  
</script>
