<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title> Gestión de órdenes de compra | CLÍNICA CRISTO REDENTOR</title>
  <?php include '../general/header.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <input type='hidden' value='m_para_proveedores' id='menuPrincipal'>
  <input type='hidden' value='orden_compra' id='menuIzquierda'>
  <?php include '../general/menu_principal.php';?>

<div class="wrapper">
  <?php include '../general/izquierda_menu.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Orden de compra
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
          Orden de compra
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title" id="subtitulo">Listado de órdenes de compra</h3>
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>        
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          <!--registro de orden de compra-->
          <form>
          <div id="RegOCompra" hidden>
          <!-- COL-MD-6 -->
              <div class="col-md-12">
                <div class="box-header"  style="margin: -30px 0px -15px -10px">
                    <br><h1 class="box-title">DATOS GENERALES</h1>
                </div>
                <hr>
              </div>
            <div class="col-md-3">
              <div class="row">
                <div class="col-md-3">
                    <label for="txtNumero">Número</label>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <input id="txtNumero" name="txtNumero"class="form-control input-sm" readonly="">
                  </div>
                </div>
                <div class="col-md-3">
                    <label for="txtFecha">Fecha</label>
                </div>
                <div class="col-md-9">
                  <div class="input-group">
                    <input id="txtFechaCita" name="txtFechaCita"class="form-control date-picker input-sm" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);" value="<?php echo $fechaHoyDMA;?>" readonly>
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>

              </div>
              
            </div>
            <div class="col-md-9">
              <div class="col-md-2">
                  <label for="txtProveedor">Proveedor</label>
              </div>
              <div class="input-group">
                  <div class="input-group-btn">
                    <button onclick="abrirModal('#modalListaProveedor');" type="button"class="btn btn-secundary" title="Buscar paciente">
                      <strong>...</strong>
                    </button>
                  </div>
                  <input onclick="abrirModal('#modalListaProveedor');" id="txtDocumento" name="txtDocumento"class="form-control" readonly="true" type="hidden">
                  <input onclick="abrirModal('#modalListaProveedor');" id="txtProveedor" name="txtProveedor"class="form-control" placeholder="RAZÓN SOCIAL/CONTACTO - PROVEEDOR" readonly="true">
              </div>
              <br>
              <div class="col-md-2">
                  <label for="txtProveedor">Moneda</label>
              </div>
              <div class="col-md-3">
                <select class="form-control input-sm">
                  <option value="1">SOLES</option>
                  <option value="1">DOLARES AMERICANOS</option>
                </select>
              </div>
              <div class="col-md-2">
                <input id="chkContado" type="checkbox" checked>Contado
              </div>
              <div class="col-md-5">
                  <input id="txtPlazo" type="text" class="form-control input-sm" placeholder="CONDICIÓN DE PAGO" readonly>
                </div>
            </div>

            <div class="col-md-3">
              <div class="row">
                <div class="col-md-3">
                    <label for="txtFecha">Fecha de entrega</label>
                </div>
                <div class="col-md-9">
                  <div class="input-group">
                    <input id="txtFechaCita" name="txtFechaCita"class="form-control date-picker input-sm" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);" value="<?php echo $fechaHoyDMA;?>" readonly>
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
              </div>
            
            </div>
          
            <div class="col-md-12">
              <div class="box-header"  style="margin: 0px 0px -15px -10px">
                  <br><h1 class="box-title">PRODUCTOS</h1>
              </div>
            <hr>
            </div>

              <div class="row">
                <div class="col-md-10">
                  <table id="tablaProducto" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Códigoo</th>
                        <th>Descripción</th>
                        <th>Cant.</th>
                        <th style="text-align:right;">Precio</th>
                        <th style="text-align:right;">Descuento</th>
                        <th style="text-align:right;">Total</th>
                      </tr>
                    </thead>
                    <tbody class="cuerpoTabla" id="cuerpoTablapRODUCTO">
                       <tr><td colspan="6" style="text-align: center">No hay productos agregados</td></tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-1 col-md-offset-1">
                  <a href="#" class="btn btn-block btn-success btn-sm btn-flat" onclick="abrirModal('#modalListaProducto');">
                    <i class='fa fa-plus' title='Agregar'></i>
                  </a>
                   <a href="#" class="btn btn-block btn-danger btn-sm btn-flat" onclick=";">
                    <i class='fa fa-remove' title='Agregar'></i>
                  </a>
                </div>
              </div>
              <div class="row">
                <div class="col-md-1">
                  <label for="txtSTotal">Subtotal</label>
                </div>
                <div class="col-md-2">
                  <input class="form-control" readonly="" placeholder="0.0" style="text-align: right;"  onkeypress="return soloNumeroDecimal(event);"></input>
                </div>
                <div class="col-md-1">
                  <label for="txtSTotal">Descuento</label>
                </div>
                <div class="col-md-2">
                  <input class="form-control" style="text-align: right;" placeholder="%" onkeypress="return soloNumeroDecimal(event);"></input>
                </div>
                <div class="col-md-1">
                  <label for="txtSTotal" >Base gravable</label>
                </div>
                <div class="col-md-2">
                  <input class="form-control" style="text-align: right;"  onkeypress="return soloNumeroDecimal(event);"></input>
                </div>
                <div class="col-md-1">
                  <label for="txtSTotal">Impuesto</label>
                </div>
                <div class="col-md-2">
                  <input class="form-control" style="text-align: right;"  onkeypress="return soloNumeroDecimal(event);"></input>
                </div>
                <div class="col-md-1 col-md-offset-9">
                  <label for="txtSTotal">Total</label>
                </div>
                <div class="col-md-2">
                  <input class="form-control" style="text-align: right;"  onkeypress="return soloNumeroDecimal(event);" readonly=""></input>
                </div>
              </div>

               <div class="box-footer" align="ceter">
                <div class="form-group" align="center">
                  <input  onClick="guardarPaciente(this.form);" id="btnGuardar" value="Guardar" style="margin-right:20px;" type="button" class="btn btn-success btn-flat" />
                  <a class="btn btn-primary btn-flat" data-dismiss="modal" onClick="mostrarListaOrden();">Salir</a>
                </div>
              </div>


            </div>
          </form>
          <br><br>
          <!--registro de orden de compra-->
          <div id="listaOrden">
          <div class="row">
            <div class="col-md-2 col-xs-6 col-md-offset-5">
              <a href="#" class="btn btn-block btn-primary btn-sm btn-flat" id="btnNCompra" onclick="crearOrden();">
                Nueva orden
              </a>
            </div>
          </div>
          <br>
        
          <div class="row">
            <div class="col-md-12">
              <table id="tablaOCompra" class="table table-bordered table-hover tablaDatos">
                <thead>
                  <tr>
                    <th>Número</th>
                    <th>Fecha de creación</th>
                    <th>Proveedor</th>
                    <th>Fecha de entrega</th>
                    <th style="text-align:center">Total</th>
                    <th style="text-align:center">Estado</th>
                    <th style="text-align:center">Opciones</th>
                  </tr>
                </thead>
                <tbody class="cuerpoTabla" id="cuerpoTablaOCompra">
                 
                </tbody>
              </table>
            </div>
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

<!-- /.modalListaProducto -->
      <div class="modal fade" id="modalListaProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="center">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 id="titulo" class="modal-title subfuente text-center">
                    GESTIÓN DE PRODUCTOS
                  </h4>
              </div>
              <!-- /.modal-header -->
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-1">
                    <label for="txtCodigo">Código</label>
                  </div>
                  <div class="col-md-2">
                    <input class="form-control input-sm" disabled=""></input>
                  </div>
                  <div class="col-md-7">
                    <input id="txtProducto" class="form-control input-sm" placeholder="Ingrese la descripción del producto"></input>
                  </div>
                   <div class="col-md-2">
                    <a href="#" class="btn btn-block btn-primary btn-sm btn-flat" onclick="RegistrarProducto();">
                      <i class='fa fa-plus' title='Agregar'></i>
                    </a>
    
                  </div>
                </div>
                <hr>
                <table id="tablaMProducto" class="table table-bordered table-hover tablaMProducto">
                  <thead>
                    <tr>
                      <th>Código</th>
                      <th>Descripción del producto</th>
                      <th style='text-align:center;'>Opciones</th>
                    </tr>
                  </thead>
                  <tbody class="cuerpoTabla" id="cuerpoTablaMProducto">
                    <!-- Aqui irán los elementos de la tabla -->
                  </tbody>
                </table>
              </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-Dialog -->
      </div>
      <!-- /.modalListaProducto -->

<!-- ./wrapper -->
  <?php include '../general/pie_pagina.php';?>  
</body>
</html>
<script src="js/script.js"></script>
<script type="text/javascript">
  cargarListaProveedor();
  cargarListaProductos();
  cargarTablaOCompra();
  $('#tablaOCompra tbody').on('click','tr',function(){seleccionSimple(this);});  
   $('.date-picker').datepicker({
    autoclose: true,
    todayHighlight: true
  })    
</script>
