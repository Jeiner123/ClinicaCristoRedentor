<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<?php
$opcion='N'
?>
<!DOCTYPE html>
<html>
<head>
  <title>Gestión de órdenes de compra | CLÍNICA CRISTO REDENTOR</title>
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
        Orden de compra
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
          <form id="formOrdenCompra" name="formOrdenCompra">
            <div id="RegOCompra">
            <!-- COL-MD-6 -->
                <div class="col-md-12">
                  <div class="box-header"  style="margin: -30px 0px -15px -10px">
                      <br><h1 class="box-title">DATOS GENERALES</h1>
                  </div>
                  <hr>
                </div>
                <input id="txtFlag" name="txtFlag" class="form-control" type="hidden" value="<?php echo $opcion; ?>">
                <div class="row" style="margin-left:5px;">
                  <div class="col-md-1">
                    <label class="control-label" style="font-weight: bold;">Número:</label>
                  </div>
                  <div class="col-md-2">
                    <label class="control-label" id="lbNumero"></label>
                  </div>
                  <div class="col-md-1">
                    <label class="control-label" style="font-weight: bold;">Fecha:</label>
                  </div>
                  <div class="col-md-3">
                    <label class="control-label" id="lbFecha"><?php echo $fechaHoyDMA;?></label>
                  </div>
                  <div class="col-md-2">
                    <label class="control-label" style="font-weight: bold;">Pto. Emisión:</label>
                  </div>
                  <div class="col-md-3">
                    <label class="control-label" id="lbArea"></label>
                  </div>
                </div>
                <br>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box-header"  style="margin: -30px 0px -15px -10px">
                          <br><h1 class="box-title">DATOS DEL PROVEEDOR</h1>
                      </div>
                      <hr>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="cboProveedor">Proveedor</label>
                      <select class="chosen-select form-control" name="cboProveedor" id="cboProveedor">
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Cond. de Pago</label>
                      <select class="form-control input-sm" id="cboModalidadPago" name="cboModalidadPago">
                      </select> 
                    </div>
                    <div class="col-md-3">
                      <label for="cboTipoCompra">Moneda</label>
                      <select class="form-control input-sm">
                        <option value="1">SOLES</option>
                        <option value="2">DOLARES AMERICANOS</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box-header"  style="margin: -10px 0px -15px -10px">
                          <br><h1 class="box-title">TRIBUTOS</h1>
                      </div>
                      <hr>
                    </div>
                    <div class="col-md-4">
                      <label for="cboIGV">I.G.V</label>
                      <select class="form-control input-sm" name="cboIGV" id="cboIGV" onchange="CalcularTotalOrden()">
                        
                      </select>
                    </div>
                    <div class="col-md-8">
                      <label for="cboPercepcion">Percepción</label>
                      <select class="form-control input-sm" name="cboPercepcion" id="cboPercepcion" onchange="validaPercepcion()">
                      </select>
                    </div>
                  </div>
                </div>
                 <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box-header"  style="margin: -10px 0px -15px -10px">
                          <br><h1 class="box-title">REQUERIMIENTOS</h1>
                      </div>
                      <hr>
                    </div>
                    <div class="col-md-10">
                      <label for="cboRequerimientos">Requerimientos aprobados</label>
                      <select class="form-control input-sm" name="cboRequerimientos" id="cboRequerimientos">
                        
                      </select>
                    </div>
                    <div class="col-md-2">
                      <br>
                      <button onclick="crearfilaRequerida();" type="button"class="btn btn-primary btn-sm" style="margin: 0px 0px -15px -10px">
                        Agregar
                      </button>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box-header"  style="margin: -10px 0px -15px -10px">
                          <br><h1 class="box-title">PRODUCTOS</h1>
                      </div>
                      <hr>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-2" hidden>
                        <input type="checkbox" name="vehicle" value="Bike">Incluye impuestos<br>
                      </div>
                      <div class="col-md-2">
                        <label for="txtTotalBruto">Total bruto</label>
                        <input class="form-control input-sm" name="txtTotalBruto" id="txtTotalBruto" onkeypress="return soloNumeroDecimal(event);" value="0.0" style="text-align:right;" readonly=""></input>
                      </div>
                      <div class="col-md-2">
                        <label for="txtDescuento">Descuento</label>
                        <input class="form-control input-sm" name="txtDescuento" id="txtDescuento" onkeypress="return soloNumeroDecimal(event);"  value="0.0" style="text-align:right;" onblur="CalcularTotalOrden()"></input>
                      </div>
                      <div class="col-md-2">
                         <label for="txtValorVenta">Valor venta</label>
                        <input class="form-control input-sm" name="txtValorVenta" id="txtValorVenta" onkeypress="return soloNumeroDecimal(event);" readonly="" value="0.0" style="text-align:right;"></input>
                      </div>
                      <div class="col-md-2">
                        <label for="txtIGV">I.G.V</label>
                        <input class="form-control input-sm" name="txtIGV" id="txtIGV" onkeypress="return soloNumeroDecimal(event);" readonly="" value="0.0" style="text-align:right;"></input>
                      </div>
                      <div class="col-md-2">
                        <label for="txtPrecioVenta">Precio de venta</label>
                        <input class="form-control input-sm" name="txtPrecioVenta" id="txtPrecioVenta" onkeypress="return soloNumeroDecimal(event);" readonly="" value="0.0" style="text-align:right;"></input>
                      </div>
                      <div class="col-md-2" hidden id="divValorPercepcion">
                        <label for="txtPercepcion">Valor percepcion</label>
                        <input class="form-control input-sm" name="txtPercepcion" id="txtPercepcion" onkeypress="return soloNumeroDecimal(event);" value="0.0" style="text-align:right;" readonly=""></input>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="input-group"><br><hr>
                        <div class="input-group-btn">
                          <button onclick="crearfila();" type="button"class="btn btn-active" title="Agregar fila">
                            <strong><i class='fa fa-plus'></i></strong>
                          </button>
                        </div>
                      </div>
                    </div>
                      <table id="tablaProducto" class="tablaProducto table table-border">
                        <thead>
                          <tr>
                            <th width="5%" style='text-align:center;'>&nbsp;Item
                            </th>
                            <th width="10%" style='text-align:center;'>&nbsp;Codigo</th>
                            <th>&nbsp;Descripción</th>
                            <th width="15%" style='text-align:center;'>Unidad</th>
                            <th width="10%" style='text-align:center;'>Cantidad</th>
                            <th width="10%" style='text-align:center;'>Costo Unit.</th>
                            <th width="10%" style='text-align:center;'>Descuento</th>
                            <th width="10%" style='text-align:center;'>Importe</th>
                          </tr>
                        </thead>
                        <tbody class="cuerpoTabla" id="cuerpoTablaProducto">
                          <tr class="filaNoValida"><td colspan="8" style="text-align: center;">No hay productos agregados</td></tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
            </div>

            <div class="row">
              <div class="col-md-6" style="top:20px!important;">
                    <a href="#" class="btn btn-default btn-block">Cancelar registro</a>
                </div>
                <div class="col-md-6" style="top:20px!important;">
                    <button type="button" class="btn btn-primary btn-block" onclick="registrarOrdenCompra()">Registrar nueva orden</button>
                </div>
            </div>
            <br><br>

          </form>
        </div>
        <!-- /.box-body -->
      </div>
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
  cargarCboProveedor(0);
  cargarCboCondPago(0);
  cargarCboRequerimiento(0);
  cargarCboPercepcion(0);
  cargarCboParametro(1,"#cboIGV",0);
  $('#tablaProducto tbody').on('click','tr',function(){seleccionSimple(this);});  
</script>
