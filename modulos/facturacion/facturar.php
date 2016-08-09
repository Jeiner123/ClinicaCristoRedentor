<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<?php 
  if(!isset($_POST['txtDNI'])){
    exit();
  }else{
    $pedidoID = $_POST['txtPedidoID'];
    $DNI = $_POST['txtDNI'];
  }

 ?>
<!DOCTYPE html>
<html>
<head>
  <title> Gestión de citas | CLÍNICA CRISTO REDENTOR</title>
  <?php include '../general/header.php';?>
<style type="text/css">

</style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
  <input type='hidden' value='menu_facturacion' id='menuPrincipal'>
  <input type='hidden' value='m_deuda_citas' id='menuIzquierda'>
  <?php include '../general/menu_principal.php';?>

<div class="wrapper">
  <?php include '../general/izquierda_menu.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Facturación
        <small>Pedido: <?php echo $pedidoID; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="../facturacion/pendiente_facturar.php">Pendientes de facturar</a>
        </li>
        <li class="active">
          Facturación
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">      
      <div class="box box-primary color-palette-box">
        <div class="box-body" id="formPedido">
          <div class="col-md-6">
            <div class="box-header" style="margin: -10px 0px -20px -10px">
              <h1 class="box-title">Datos personales</h1>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group" autofocus>
                  <label for="txtDNI">DNI</label>
                  <input type="text" class="form-control input-sm" id="txtDNI" name="txtDNI" maxlength="8">
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="txtPaciente">Paciente</label>
                  <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="txtPaciente" name="txtPaciente" maxlength="50">
                </div>
              </div>
            </div>
            <!-- ROW -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="txtTelefono1">Teléfono (1)</label>
                  <input id="txtTelefono1" name="txtTelefono1"class="form-control input-sm"  maxlength="19" onkeypress="return soloNumeroEntero(event);" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cboTipoTelefono1">Operador(1)</label>
                  <select class="form-control input-sm" id="cboTipoTelefono1" name="cboTipoTelefono1">
                    <option value="0">-- Seleccionar --</option>
                  </select>
                </div>
              </div>
            </div>
            <!-- ROW -->
          </div>
          <div class="col-md-6">
            <div class="box-header" style="margin: -10px 0px -20px -10px">
              <h1 class="box-title">Importe</h1>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group" autofocus>
                  <label for="txtSubTotal">Sub total</label>
                  <input type="text" class="form-control input-sm" id="txtSubTotal" name="txtSubTotal">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="txtImporteIGV">IGV</label>
                  <input class="form-control input-sm" id="txtImporteIGV" name="txtImporteIGV" >
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="txtTotal" class="text-red"><strong>TOTAL</strong></label>
                  <input class="form-control input-sm" id="txtTotal" name="txtTotal" >
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="txtPagado" class="text-green"><strong>Pagado</strong></label>
                  <input class="form-control input-sm" id="txtPagado" name="txtPagado" >
                </div>
              </div>
            </div>
            <!-- ROW -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label  for="cboModalidadPago"><strong>Forma de pago</strong></label>
                  <select class="form-control input-sm" id="cboModalidadPago" name="cboModalidadPago" onchange="actualizarCampoPedidoServicio(<?php echo $pedidoID; ?>,'formaPagoID')">
                    <option value="0">-- Seleccionar --</option>                    
                  </select>
                </div>
              </div>
              <div class="col-md-3 col-md-offset-3">
                <div class="form-group">
                  <label for="txtSaldo" class="text-red"><strong>Saldo</strong></label>
                  <input class="form-control input-sm" id="txtSaldo" name="txtSaldo" >
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- Formulario Datos Generales -->
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid color-palette-box" id="formularioPago" hidden>
            <div class="box-header bg-blue" >
              <div>
                <h3 class="box-title">Realizar pago</h3>
              </div>
              <div class="box-tools pull-right">
                <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-minus"></i>
                </button>                
              </div>
            </div>
            <!-- div-header -->
            <div class="box-body" align="center" id="formFacturar" >
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label class="form-label">Fecha pago</label>
                    <input id="txtFechaCita" name="txtFechaCita" value="<?php echo $fechaHoyDMA ?>"class="form-control date-picker" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" disabled>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="cboComprobante"><strong>Comprobante</strong></label>
                    <select class="form-control input-sm" id="cboComprobante" name="cboComprobante">
                    </select>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="txtNroSerie">Nro. Serie</label>
                    <input type="text" id="txtNroSerie" name="txtNroSerie" class="form-control input-sm"  value="0001" onchange="validarNumeroSerie(this);" maxlength="5" onkeypress="return soloNumeroEntero(event);">
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="txtNroComprobante">Nro. Comprobante</label>
                    <input type="text" id="txtNroComprobante" name="txtNroComprobante" class="form-control input-sm" onchange="validarNumeroComprobante(this);" maxlength="8" onkeypress="return soloNumeroEntero(event);">
                  </div>
                </div>
              </div>
              <!-- ROW -->
              <div class="row">
                                
              </div>
              <!-- ROW -->
              <div class="row">
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="txtPagar">Pagar</label>
                    <input type="text" id="txtPagar" name="txtPagar" class="form-control input-sm" onkeypress="return soloNumeroDecimal(event);" onKeyUp ="return calcularNuevoSaldo();" maxlength="7">
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="txtNuevoSaldo">Nuevo Saldo</label>
                    <input type="text" id="txtNuevoSaldo" name="txtNuevoSaldo" class="form-control input-sm" disabled>
                  </div>
                </div>
              </div>          
              <!-- ROW -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer" align="center">
                <input  onClick="facturar('#formFacturar',<?php echo $DNI; ?>,<?php echo $pedidoID; ?>);" id="btnFacturar" value="Facturar" style="margin-right:20px;" type="button" class="btn btn-success" />
                <!-- <a class="btn btn-secundary" data-dismiss="modal" onClick="limpiarForm(this.form);">Cancelar</a> -->
            </div>
            <!-- box-footer -->
          </div>
        </div>
        <div class="col-md-12">
          <div class="box box-solid color-palette-box ">
            <div class="box-header bg-blue" >
              <div>
                <h3 class="box-title">Pagos a la fecha</h3>            
              </div>
              <div class="box-tools pull-right">
                <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- div.header -->
            <div class="box-body" align="center">
              <div class="row" id="pagos">
                <div class="col-md-12">
                  <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                      <div class="col-md-10 col-md-offset-1">
                        <table id="tablaPagos" class="table table-bordered table-striped table-hover dataTable"role="grid"aria-describedby="example1_info">
                          <thead style="background-color:#ccc;">
                            <tr>
                              <th>Fecha Pago</th>
                              <th>Importe</th>
                              <th>Comprobante pago</th>
                              <th>Nro comprob.</th>
                            </tr>
                          </thead>
                          <tbody class="cuerpoTabla" id="cuerpoTablaPagos">
                            <!-- Aqui irán los elementos de la tabla -->
                          </tbody>
                        </table>
                        <!--tablaPagos-->  
                      </div>
                    </div>
                  </div>         
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        
      </div>
      <!-- Facturación y pagos -->
      <div class="box box-solid color-palette-box ">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Servicios - detalle</h3>            
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>            
          </div>
        </div>
        <!-- box-header -->
        <div class="box-body" align="center">
          <div class="row" id="servicioDetalle">
            <div class="col-md-12">
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <table id="tablaServiciosLab" class="table table-bordered table-striped table-hover dataTable"role="grid"aria-describedby="example1_info">
                      <thead style="background-color:#ccc;">
                        <tr>
                          <th>Servicio</th>
                          <th>Prec. Unitario</th>
                          <th>Cantidad</th>
                          <th>Importe</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody class="cuerpoTabla" id="cuerpoTablaServiciosLab">
                        <!-- Aqui irán los elementos de la tabla -->
                      </tbody>
                    </table>
                    <!--tablaServiciosLab-->  
                  </div>
                </div>
              </div>         
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- Detalle del pedido -->
      <div class="modal fade" id="modalListaPacientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 id="titulo" class="modal-title subfuente text-center">
                    Seleccionar paciente
                  </h4>
              </div>
              <!-- /.modal-header -->
              <div class="modal-body">
                <table id="tablaPacientes" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style='text-align:center;'>N°</th>
                      <th style='text-align:center;'>DNI</th>
                      <th>Nombres y apellidos</th>
                      <th style='text-align:center;'>Edad</th>
                      <th>Tel. / Cel.</th>
                      <th>Procedencia</th>
                      <th style='text-align:center;'>Seleccionar</th>
                    </tr>
                  </thead>
                  <tbody class="cuerpoTabla" id="cuerpoTablaPacientes">
                    <!-- Aqui irán los elementos de la tabla -->
                  </tbody>
                </table>
              </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-Dialog -->
      </div>
      <!-- /.modalListaPacientes -->
      <div class="modal fade" id="modalListaPersonalSaludRef" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 id="titulo" class="modal-title subfuente text-center">
                    Seleccionar médico
                  </h4>
              </div>
              <!-- /.modal-header -->
              <div class="modal-body">
                <table id="tablaPersonalSaludRef" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style='text-align:center;'>Código</th>
                      <th>Nombres y apellidos</th>
                      <th style='text-align:center;'>Especialidad</th>
                      <th style='text-align:center;'>Seleccionar</th>
                    </tr>
                  </thead>
                  <tbody class="cuerpoTabla" id="cuerpoTablaPersonalSaludRef">
                    <!-- Aqui irán los elementos de la tabla -->
                  </tbody>
                </table>
              </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-Dialog -->
      </div>
      <!-- /.modalListaPersonalSaludRef -->
      <div class="modal fade" id="modalListaServicios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="center">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 id="titulo" class="modal-title subfuente text-center">
                    Seleccionar servicio
                  </h4>
              </div>
              <!-- /.modal-header -->
              <div class="modal-body">
                <table id="tablaServicios" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style='text-align:center;'>ID</th>
                      <th>Servicio</th>
                      <th style='text-align:center;'>Precio</th>
                      <th>Especialidad</th>
                      <th>EspecialidadID</th>
                      <th>Tipo de servicio</th>
                      <th>Tipo de servicio ID</th>
                      <th style='text-align:center;'>Seleccionar</th>
                    </tr>
                  </thead>
                  <tbody class="cuerpoTabla" id="cuerpoTablaServicios">
                    <!-- Aqui irán los elementos de la tabla -->
                  </tbody>
                  <tfoot>
                    <tr>
                      <th style='text-align:center;'>ID</th>
                      <th>Servicio</th>
                      <th style='text-align:center;'>Precio</th>
                      <th>Especialidad</th>
                      <th>EspecialidadID</th>
                      <th>Tipo de servicio</th>
                      <th>Tipo de servicio ID</th>
                      <th style='text-align:center;'>Seleccionar</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-Dialog -->
      </div>
      <!-- /.modalListaServicios -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
  <?php include '../general/pie_pagina.php';?>
  
</body>
</html>
<script src="js/script.js"></script>
<script type="text/javascript">
  // abrirModal("#modalListaServicios");  
  
  cargarCboComprobante('03');
  cargarPedido(<?php echo $DNI ?>,<?php echo $pedidoID ?>);
  traerPagos(<?php echo $pedidoID; ?>);
  traerServicios(<?php echo $pedidoID; ?>);
  // cargarCboFormaPago('0');
  // cargarCboTipoServicio();
  // cargarCboEspecialidades();
  // cargarListaPacientes();
  // cargarListaServicios();
  // cargarListaPersonalSaludRef();

  

  // $('#tablaPacientes tbody').on('click','tr',function(){seleccionSimple(this);});  
  

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
    $('.date-picker').datepicker({
      autoclose: true,
      todayHighlight: true
    })
    //show datepicker when clicking on the icon
    .next().on(ace.click_event, function(){
      $(this).prev().focus();
    });
</script>