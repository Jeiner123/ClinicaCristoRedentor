<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title>Gestión de órdenes de compra | CLÍNICA CRISTO REDENTOR</title>
  <?php include '../general/header.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <input type='hidden' value='menu_compras' id='menuPrincipal'>
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
            <h3 class="box-title" id="subtitulo">Registro de orden de compra</h3>
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
            <div id="RegOCompra">
            <!-- COL-MD-6 -->
                <div class="col-md-12">
                  <div class="box-header"  style="margin: -30px 0px -15px -10px">
                      <br><h1 class="box-title">DATOS GENERALES</h1>
                  </div>
                  <hr>
                </div>
              
                <div class="row" style="margin-left:5px;">
                  <div class="col-md-2">
                    <label class="control-label">Periódo</label>
                    <input type="text" id="txtPeriodo" name="txtPeriodo"class="form-control input-sm" readonly="" value="">
                  </div>
                  <div class="col-md-2">
                    <label class="control-label">Serie</label>
                    <input type="text" id="txtSerie" name="txtSerie"class="form-control input-sm">
                  </div>
                  <div class="col-md-2">
                    <label class="control-label">Número</label>
                    <input type="text" id="txtNumero" name="txtNumero"class="form-control input-sm" readonly="">
                  </div>
                  <div class="col-md-3">
                    <label class="control-label">Fecha</label>
                    <div class="input-group">
                      <input id="txtFechaCita" name="txtFechaCita"class="form-control date-picker" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);" value="<?php echo $fechaHoyDMA;?>">
                      <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="txtPuntoEmision">Pto. Emisión</label>
                    <div class="input-group">
                      <div class="input-group-btn">
                        <button onclick="abrirModal('#modalListaProveedor');" type="button"class="btn btn-secundary" title="Buscar área">
                          <strong>...</strong>
                        </button>
                      </div>
                      <input onclick="abrirModal('#modalListaProveedor');" id="txtCodPEmision" name="txtCodPEmision"class="form-control" readonly="true" type="hidden">
                      <input onclick="abrirModal('#modalListaProveedor');" id="txtPtoEmision" name="txtPtoEmision"class="form-control" placeholder="ÁREA" readonly="true">
                    </div>
                  </div>
                </div><br>

                <div class="col-md-9">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box-header"  style="margin: -30px 0px -15px -10px">
                          <br><h1 class="box-title">DATOS DEL PROVEEDOR</h1>
                      </div>
                      <hr>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <label for="txtProveedor">Proveedor</label>
                      <div class="input-group">
                        <div class="input-group-btn">
                          <button onclick="abrirModal('#modalListaProveedor');" type="button"class="btn btn-secundary" title="Buscar paciente">
                            <strong>...</strong>
                          </button>
                        </div>
                        <input onclick="abrirModal('#modalListaProveedor');" id="txtDocumento" name="txtDocumento"class="form-control" readonly="true" type="hidden">
                        <input onclick="abrirModal('#modalListaProveedor');" id="txtProveedor" name="txtProveedor"class="form-control" placeholder="PROVEEDOR" readonly="true">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <label for="cboTipoCompra">Tipo</label>
                      <select class="form-control input-sm" name="cboTipoCompra" id="cboTipoCompra">
                        <option value="0">--Seleccionar--</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <label for="txtProveedor">Condición de pago</label>
                      <div class="input-group">
                        <div class="input-group-btn">
                          <button onclick="abrirModal('#modalListaProveedor');" type="button"class="btn btn-secundary" title="Buscar paciente">
                            <strong>...</strong>
                          </button>
                        </div>
                        <input onclick="abrirModal('#modalListaProveedor');" id="txtDocumento" name="txtDocumento"class="form-control" readonly="true" type="hidden">
                        <input onclick="abrirModal('#modalListaProveedor');" id="txtCondPago" name="txtCondPago"class="form-control" placeholder="Cod-Modalidad de pago" readonly="true">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <label for="cboTipoCompra">Moneda</label>
                      <select class="form-control input-sm">
                        <option value="1">SOLES</option>
                        <option value="2">DOLARES AMERICANOS</option>
                      </select>
                    </div>
                    <div class="col-md-12">
                      <label class="control-label">Observaciones</label>
                      <textarea class="form-control" id="txtObservaciones" name="txtObservaciones"></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box-header"  style="margin: -30px 0px -15px -10px">
                          <br><h1 class="box-title">TRIBUTOS</h1>
                      </div>
                      <hr>
                    </div>
                    <div class="col-md-12">
                      <label for="cboIGV">I.G.V</label>
                      <select class="form-control input-sm" name="cboIGV" id="cboIGV">
                        <option value="0">--Seleccionar--</option>
                      </select>
                    </div>
                    <div class="col-md-12">
                      <label for="cboPercepcion">Percepción</label>
                      <select class="form-control input-sm" name="cboPercepcion" id="cboPercepcion">
                        <option value="0">--Seleccionar--</option>
                      </select>
                    </div>
                  </div>
                </div><br>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box-header"  style="margin: -10px 0px -15px -10px">
                          <br><h1 class="box-title">PRODUCTOS</h1>
                      </div>
                      <hr>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-2 col-md-offset-2">
                        <label for="txtAfecto">Afecto</label>
                        <input class="form-control input-sm" name="txtAfecto" id="txtAfecto"></input>
                      </div>
                      <div class="col-md-2">
                         <label for="txtInafecto">Inafecto</label>
                        <input class="form-control input-sm" name="txtInafecto" id="txtInafecto"></input>
                      </div>
                      <div class="col-md-2">
                        <label for="txtIGV">I.G.V</label>
                        <input class="form-control input-sm" name="txtIGV" id="txtIGV"></input>
                      </div>
                      <div class="col-md-2">
                        <label for="txtPercepcion">Percepción</label>
                        <input class="form-control input-sm" name="txtPercepcion" id="txtPercepcion"></input>
                      </div>
                      <div class="col-md-2">
                        <label for="txtTotal">Total</label>
                        <input class="form-control input-sm" name="txtTotal" id="txtTotal"></input>
                      </div>
                    </div>
                    <div class="col-md-12"><br>
                      <table id="tablaProducto" class="tablaProducto">
                        <thead>
                          <tr>
                            <th width="10%" style='text-align:center;'>&nbsp;Item</th>
                            <th width="15%" style='text-align:center;'>&nbsp;Codigo</th>
                            <th>&nbsp;Descripción</th>
                            <th width="10%" style='text-align:center;'>U.M</th>
                            <th width="15%" style='text-align:center;'>Cantidad</th>
                            <th width="15%" style='text-align:center;'>Costo Unit.</th>
                            <th width="15%" style='text-align:center;'>Descuento</th>
                            <th width="15%" style='text-align:center;'>Importe</th>
                          </tr>
                        </thead>
                        <tbody class="cuerpoTabla" id="cuerpoTablaProducto">
                          <tr>
                            <td><input class="form-control input-sm" style='text-align:right;'></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                          </tr>
                          <tr>
                            <td><input class="form-control input-sm" style='text-align:right;'></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                          </tr>
                          <tr>
                            <td><input class="form-control input-sm" style='text-align:right;'></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                          </tr>
                          <tr>
                            <td><input class="form-control input-sm" style='text-align:right;'></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                          </tr>
                          <tr>
                            <td><input class="form-control input-sm" style='text-align:right;'></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                            <td><input class="form-control input-sm"></input></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  </div>
                </div>
            </div>
          </form>
          
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
