<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>

<!DOCTYPE html>
<html>
<head>
  <title> Gestión de COMPRAS| CLÍNICA CRISTO REDENTOR</title>
  <?php include '../general/header.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <input type='hidden' value='menu_compras' id='menuPrincipal'>
  <input type='hidden' value='compras' id='menuIzquierda'>
  <?php include '../general/menu_principal.php';?>

<div class="wrapper">
  <?php include '../general/izquierda_menu.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="tituloPagina">
        Registrar nueva compra
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
          Nota de ingreso
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <form method="post" class="" id="formPaciente" enctype="multipart/form-data">
        <div class="box box-primary color-palette-box">          
          <div class="box-body">
            <input type="hidden" value="N" id="txtFlag">
            <div class="col-md-12">
               <!-- style="margin-left:-10px;margin-bottom:-10px;" -->
              <div class="box-header" style="margin: 0px 0px -15px -10px">
                <h1 class="box-title">Datos de la compra</h1>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-2 col-md-offset-8">
                  <div class="form-group" autofocus>
                    <label for="txtCorrelativo">Correlativo</label>
                    <input type="text" class="form-control input-sm" id="txtCorrelativo" name="txtCorrelativo" readonly autofocus="autofocus">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group" autofocus>
                    <label for="txtOrden">Ord. de compra</label>
                    <input type="text" class="form-control input-sm" id="txtOrden" name="txtOrden" readonly autofocus="autofocus">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="txtProveedor">Proveedor</label>
                  <div class="input-group">
                    <div class="input-group-btn">
                      <button onclick="abrirModal('#modalListaProveedor');" type="button"class="btn btn-secundary" title="Buscar paciente">
                        <strong>...</strong>
                      </button>
                    </div>
                    <input onclick="abrirModal('#modalListaProveedor');" id="txtDocumento" name="txtDocumento"class="form-control" readonly="true" type="hidden">
                    <input onclick="abrirModal('#modalListaProveedor');" id="txtProveedor" name="txtProveedor"class="form-control" placeholder="RAZÓN SOCIAL/CONTACTO - PROVEEDOR" readonly="true">
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="txtProveedor">Tipo de compra</label>
                  <div class="input-group">
                    <div class="input-group-btn">
                      <button onclick="abrirModal('#modalListaTipCompra');" type="button"class="btn btn-secundary" title="Buscar paciente">
                        <strong>...</strong>
                      </button>
                    </div>
                    <input onclick="abrirModal('#modalListaTipCompra');" id="txtcodTCompra" name="txtcodTCompra"class="form-control" readonly="true" type="hidden">
                    <input onclick="abrirModal('#modalListaTipCompra');" id="txtTCompra" name="txtTCompra"class="form-control" placeholder="TIPO DE COMPRA" readonly="true">
                  </div>
                </div>
                 <div class="col-md-6">
                  <label for="txtProveedor">Tipo de comprobante</label>
                  <div class="input-group">
                    <div class="input-group-btn">
                      <button onclick="abrirModal('#modalListaTipComprobante');" type="button"class="btn btn-secundary" title="Buscar paciente">
                        <strong>...</strong>
                      </button>
                    </div>
                    <input onclick="abrirModal('#modalListaTipComprobante');" id="txtCodTComprobante" name="txtCodTComprobante"class="form-control" readonly="true" type="hidden">
                    <input onclick="abrirModal('#modalListaTipComprobante');" id="txtCPago" name="txtCPago"class="form-control" placeholder="TIPO DE COMPROBANTE" readonly="true">
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="txtProveedor">Fecha de emisión</label>
                  <div class="input-group">
                    <input id="txtFechaCita" name="txtFechaCita"class="form-control date-picker" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="txtMoneda">Moneda</label>
                  <select class="form-control">
                    <option value="1">SOLES</option>
                    <option value="1">DOLARES AMERICANOS</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label for="txtSerie">Serie</label>
                  <input class="form-control" type="text" onkeypress="return soloNumeroEntero(event);"></input>
                </div>
                <div class="col-md-3">
                  <label for="txtNumero">Número</label>
                  <input class="form-control" type="text" onkeypress="return soloNumeroEntero(event);"></input>
                </div>
                <div class="col-md-3 col-md-offset-3">
                  <label for="txtFechaVcto">Fecha de vencimiento</label>
                  <div class="input-group">
                    <input id="txtFechaVcto" name="txtFechaVcto"class="form-control date-picker" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
              </div>
              
            </div>
        
              
            <!-- COL-MD-6 -->
            <div class="col-md-6">
            <hr>
              <div class="box-header"  style="margin: 0px 0px -15px -10px">
                <h1 class="box-title">???</h1>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="txtBGravada">Base gravada</label>
                    <input id="txtBGravada" name="txtBGravada"class="form-control input-sm" onkeypress="return soloNumeroDecimal(event);">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="txtIGV">IGV</label>
                    <input id="txtIGV" name="txtIGV"class="form-control input-sm" readonly="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="txtImporte">Imp. Total</label>
                    <input id="txtImporte" name="txtImporte"class="form-control input-sm" readonly="">
                  </div>
                </div>
                <div class="col-md-5">
                  <input id="chkDetraccion" type="checkbox">¿Se bancarizó?
                </div>
              </div>
              
            </div>

            <div class="col-md-6">
            <hr>
              <div class="box-header"  style="margin: 0px 0px -15px -10px">
                <h1 class="box-title">DETRACCIÓN</h1>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-4">
                  <input id="chkDetraccion" type="checkbox">¿Detracción?
                </div>
                <div class="col-md-3">
                  <label for="txtDetraccion">Total detracción</label>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    
                    <input id="txtDetraccion" name="txtDetraccion"class="form-control input-sm" onkeypress="return soloNumeroDecimal(event);">
                  </div>
                </div>
              </div>
              
            </div>
            

          </div>
          <!-- BOx-body -->
          <div class="box-footer" align="ceter">
            <div class="form-group" align="center">
              <input  onClick="guardarPaciente(this.form);" id="btnGuardar" value="Guardar" style="margin-right:20px;" type="button" class="btn btn-success btn-flat" />
              <a class="btn btn-primary btn-flat" data-dismiss="modal" onClick="limpiarForm(this.form);">Regresar</a>
            </div>
          </div>
        </div>
      </form>
      <!-- Formulario registrar nuevo paciente -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- /.modalListapROVEEDOR -->
      <div class="modal fade" id="modalListaProveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="center">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 id="titulo" class="modal-title subfuente text-center">
                    Seleccionar proveedor
                  </h4>
              </div>
              <!-- /.modal-header -->
              <div class="modal-body">
                <table id="tablaProveedor" class="table table-bordered table-hover tablaProveedor">
                  <thead>
                    <tr>
                      <th>RUC/DNI</th>
                      <th>Razón social/ Contacto</th>
                      <th style='text-align:center;'>Teléfono</th>
                      <th style='text-align:center;'>Seleccionar</th>
                    </tr>
                  </thead>
                  <tbody class="cuerpoTabla" id="cuerpoTablaProveedor">
                    <!-- Aqui irán los elementos de la tabla -->
                  </tbody>
                </table>
              </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-Dialog -->
      </div>
      <!-- /.modalListapROVEEDOR -->

<!-- /.modalListapROVEEDOR -->
      <div class="modal fade" id="modalListaTipCompra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="center">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 id="titulo" class="modal-title subfuente text-center">
                    Seleccionar tipo de compra
                  </h4>
              </div>
              <!-- /.modal-header -->
              <div class="modal-body">
                <table id="tablaTipoCompra" class="table table-bordered table-hover tablaTCompra">
                  <thead>
                    <tr>
                      <th>Código</th>
                      <th>Tipo de compra</th>
                      <th style='text-align:center;'>Seleccionar</th>
                    </tr>
                  </thead>
                  <tbody class="cuerpoTabla" id="cuerpoTablaTCompra">
                    <!-- Aqui irán los elementos de la tabla -->
                  </tbody>
                </table>
              </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-Dialog -->
      </div>
      <!-- /.modalListapROVEEDOR -->

      <!-- /.modalListapROVEEDOR -->
      <div class="modal fade" id="modalListaTipComprobante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="center">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 id="titulo" class="modal-title subfuente text-center">
                    Seleccionar tipo de comprobante
                  </h4>
              </div>
              <!-- /.modal-header -->
              <div class="modal-body">
                <table id="tablaTipoComprobante" class="table table-bordered table-hover tablaTComprobante">
                  <thead>
                    <tr>
                      <th>Código</th>
                      <th>Tipo de comprobante</th>
                      <th style='text-align:center;'>Seleccionar</th>
                    </tr>
                  </thead>
                  <tbody class="cuerpoTabla" id="cuerpoTablaTComprobante">
                    <!-- Aqui irán los elementos de la tabla -->
                  </tbody>
                </table>
              </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-Dialog -->
      </div>
      <!-- /.modalListapROVEEDOR -->

      

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
  <?php include '../general/pie_pagina.php';?>
  
</body>
</html>
<script src="js/script.js"></script>
<script type="text/javascript">
  cargarListaProveedor();
  cargarListaTCompra();
  cargarListaTComprobante();
  $('.date-picker').datepicker({
    autoclose: true,
    todayHighlight: true
  })    
  
</script>

