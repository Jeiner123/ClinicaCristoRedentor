<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<?php 
  $opcion='N';
  $mesID = '';
  $anioID = '';
  $codigo = '';
  $detalles=3;
  if(isset($_POST['txtmesID'])){
    $opcion = $_POST['txtOpcion'];
    $mesID = $_POST['txtmesID'];
    $anioID = $_POST['txtAnioID'];
    $codigo = $_POST['txtNum'];
    $detalles = $_POST['txtDetalles'];
  }
 ?>
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
        Provisiones por pagar
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
          Provisiones por pagar
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title" id="subtitulo">Registro de provisión</h3>
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>        
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          <!--registro de orden de compra-->
          <form id="formFactura" name="formFactura">
            <div id="RegOCompra">
            <!-- COL-MD-6 -->
                <input id="txtFlag" name="txtFlag" class="form-control" type="hidden" value="<?php echo $opcion; ?>">
                <div class="row" style="margin-left:5px;">
                  <div class="col-md-1">
                    <label class="control-label">Cod.</label>
                    <input type="text" id="txtCodigo" name="txtCodigo"class="form-control input-sm" readonly="">
                  </div>
                  <div class="col-md-2">
                    <input id="txtMes" name="txtMes"class="form-control input-sm" type="hidden" value="<?php echo $mesID; ?>">
                    <input id="txtAnio" name="txtAnio"class="form-control input-sm" type="hidden" value="<?php echo $anioID; ?>">
                     <input id="txtCorrelativo" name="txtCorrelativo"class="form-control input-sm" type="hidden" value="<?php echo $codigo; ?>">
                    <label class="control-label">Periódo</label>
                    <input type="text" id="txtPeriodo" name="txtPeriodo"class="form-control input-sm" readonly="" value="">
                  </div>
                  <div class="col-md-3">
                    <label class="control-label">Fecha</label>
                    <div class="input-group">
                      <input id="txtFecha" name="txtFecha"class="form-control date-picker input-sm" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);" value="<?php echo $fechaHoyDMA;?>" >
                      <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="cboComprobante">Tipo de documento</label>
                    <select class="chosen-select form-control" name="cboComprobante" id="cboComprobante" onchange="validarTributos()">
                      </select>
                  </div>
                  <div class="col-md-2">
                      <label for="cboMoneda">Moneda</label>
                      <select class="form-control input-sm" id="cboMoneda" name="cboMoneda">
                        <option value="1">SOLES</option>
                        <option value="2">DOLARES</option>
                      </select>
                    </div>
                </div><br>

                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box-header"  style="margin: -35px 0px -15px -10px">
                          <hr>
                      </div>
                      
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5">
                      <label for="txtProveedor">Proveedor</label>
                      <select class="chosen-select form-control" name="cboProveedor" id="cboProveedor">
                      </select>
                    </div>
                    <div class="col-md-2">
                      <label class="control-label">Serie</label>
                      <input type="text" id="txtSerie" name="txtSerie"class="form-control input-sm" onchange="validarNumeroSerie(this)">
                    </div>
                    <div class="col-md-2">
                      <label class="control-label">Número</label>
                      <input type="text" id="txtNumero" name="txtNumero"class="form-control input-sm" onchange="validarNumeroComprobante(this)">
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Cond. de Pago</label>
                      <select class="form-control input-sm" id="cboModalidadPago" name="cboModalidadPago">
                      </select> 
                    </div>
                    <div class="col-md-5">
                        <label for="cboTipoExistencia">Tipo de bien o servicio</label>
                        <select class="form-control input-sm" name="cboTipoExistencia" id="cboTipoExistencia">
                        </select>
                    </div>
                     <div class="col-md-3">
                      <label class="control-label">Fecha de emisión</label>
                      <div class="input-group">
                        <input id="txtFechaEmision" name="txtFechaEmision"class="form-control date-picker input-sm" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" value="" >
                        <span class="input-group-addon">
                          <i class="fa fa-calendar bigger-110"></i>
                        </span>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Fecha de vencimiento</label>
                      <div class="input-group">
                        <input id="txtFechaVcto" name="txtFechaVcto"class="form-control input-sm date-picker" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" value="">
                        <span class="input-group-addon">
                          <i class="fa fa-calendar bigger-110"></i>
                        </span>
                    </div>
                    </div>
                  </div>
                 
                </div>

                 <div class="col-md-12">
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box-header"  style="margin: -35px 0px -15px -10px">
                          <br><h1 class="box-title">TRIBUTOS</h1><hr>
                      </div>
                      
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Tipo de adquisición</label>
                        <select class="form-control input-sm" id="cboAdquisicion" name="cboAdquisicion">
                        </select> 
                    </div>
                    <div class="col-md-2 tributo-comun">
                      <label for="cboIGV">I.G.V</label>
                      <select class="form-control input-sm" name="cboIGV" id="cboIGV" onchange="CalcularTotal()">
                      </select>
                    </div>
                    <div class="col-md-4 tributo-comun">
                      <label for="cboDetraccion">Detracción</label>
                      <select class="form-control input-sm" name="cboDetraccion" id="cboDetraccion" onchange="validaDetraccion()">
                      </select>
                    </div>
                    <div class="col-md-3 tributo-comun">
                      <label for="cboPercepcion">Percepción</label>
                      <select class="form-control input-sm" name="cboPercepcion" id="cboPercepcion">
                        
                      </select>
                    </div>
                     <div class="col-md-2 tributo-comun" id="divRetencion">
                      <label for="cboRetencion">Retencion</label>
                      <select class="form-control input-sm" name="cboRetencion" id="cboRetencion" onchange="validaRetencion()">
                        
                      </select>
                    </div>
                     <div class="col-md-2" hidden id="divRenta">
                      <label for="cboRenta">Renta</label>
                      <select class="form-control input-sm" name="cboRenta" id="cboRenta">
                        <option value="1">No aplica</option>
                        <option value="2">Renta 8%</option>
                      </select>
                    </div>
                  </div></div>

                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box-header" style="margin: -10px 0px -15px -10px">
                          <br><h1 class="box-title">DETALLE DEL DOCUMENTO</h1>
                      </div>
                      <hr>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-2">
                        <label for="txtTotalBruto">Total bruto</label>
                        <input class="form-control input-sm" name="txtTotalBruto" id="txtTotalBruto" onkeypress="return soloNumeroDecimal(event);" value="0.0" style="text-align:right;" readonly=""></input>
                      </div>
                      <div class="col-md-2">
                        <label for="txtDescuento">Descuento</label>
                        <input class="form-control input-sm" name="txtDescuento" id="txtDescuento" onkeypress="return soloNumeroDecimal(event);"  value="0.0" style="text-align:right;" onblur="CalcularTotal()"></input>
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
                      <div class="col-md-2" hidden id="divDetraccion">
                        <label for="txtDetraccion">Valor detracción</label>
                        <input class="form-control input-sm" name="txtDetraccion" id="txtDetraccion" onkeypress="return soloNumeroDecimal(event);" value="0.0" style="text-align:right;" readonly=""></input>
                      </div>
                      <div class="col-md-2" hidden id="divValorPercepcion">
                        <label for="txtPercepcion">Valor percepcion</label>
                        <input class="form-control input-sm" name="txtPercepcion" id="txtPercepcion" onkeypress="return soloNumeroDecimal(event);" value="0.0" style="text-align:right;" readonly=""></input>
                      </div>
                      <div class="col-md-2" hidden id="divValorRenta">
                        <label for="txtRenta">Valor renta</label>
                        <input class="form-control input-sm" name="txtRenta" id="txtRenta" onkeypress="return soloNumeroDecimal(event);" value="0.0" style="text-align:right;" readonly=""></input>
                      </div>
                       <div class="col-md-2" hidden id="divValorRetencion">
                        <label for="txtRetencion">Valor retención</label>
                        <input class="form-control input-sm" name="txtRetencion" id="txtRetencion" onkeypress="return soloNumeroDecimal(event);" value="0.0" style="text-align:right;" readonly=""></input>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="input-group"><hr>
                        <div class="input-group-btn">
                          <button onclick="crearDetalleFactura();" type="button"class="btn btn-success" title="Agregar fila">
                            <strong><i class='fa fa-plus'></i></strong>
                          </button>
                        </div>
                      </div>
                    </div>
                      <table id="tablaProducto" class="tablaProducto">
                        <thead>
                          <tr>
                            <th width="5%" style='text-align:center;'>&nbsp;Item
                            </th>
                            <th width="10%" style='text-align:center;'>&nbsp;Referencia</th>
                            <th width="10%" style='text-align:center;'>&nbsp;Cuenta</th>
                            <th>&nbsp;Descripción</th>
                            <th width="10%" style='text-align:center;'>Cantidad</th>
                            <th width="10%" style='text-align:center;'>Costo Unit.</th>
                            <th width="10%" style='text-align:center;'>Importe</th>
                          </tr>
                        </thead>
                        <tbody class="cuerpoTabla" id="cuerpoTablaProducto">
                        <?php for ($i=1;$i<=$detalles;++$i): ?>
                          <tr>
                            <td><input class="form-control input-sm" id="txtItem<?php echo $i;?>" name="txtItem<?php echo $i;?>" style='text-align:right;' readonly value="<?php echo $i;?>"></input></td>
                            <td><input class="form-control input-sm" id="txtReferencia<?php echo $i;?>" name="txtReferencia<?php echo $i;?>"></input></td>
                            <td><input class="form-control input-sm" id="txtCuenta<?php echo $i;?>" name="txtCuenta<?php echo $i;?>"  onkeypress="return soloNumeroEntero(event);"></input></td>
                            <td><input class="form-control input-sm" id="txtDescripcion<?php echo $i;?>" name="txtDescripcion<?php echo $i;?>" onblur="validarDescripcion(event)"></input></td>
                            <td><input class="form-control input-sm" id="txtCantidad<?php echo $i;?>" name="txtCantidad<?php echo $i;?>"  onkeypress="return soloNumeroEntero(event);" onblur="calcularImporte(event)"></input></td>
                            <td><input class="form-control input-sm" id="txtCosto<?php echo $i;?>" name="txtCosto<?php echo $i;?>" onkeypress="return soloNumeroDecimal(event);" onblur="calcularImporte(event)"></input></td>
                            <td><input class="form-control input-sm importe" id="txtImporte<?php echo $i;?>" name="txtImporte<?php echo $i;?>" onkeypress="return soloNumeroDecimal(event);" readonly value="0.0"></input></td>
                          </tr>
                        <?php endfor; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  </div>

                <div class="row">
                      <div class="col-md-6" style="top:20px!important;">
                          <button type="button" class="btn btn-primary btn-block" onclick="RegistrarCompra()" id="btnGuardar">Registrar nuevo documento</button>
                      </div>
                      <div class="col-md-6" style="top:20px!important;">
                        <a href="cuenta_pagar.php" onclick="" class="btn btn-default btn-block">Ver cuentas por pagar</a>
                    </div>
                  </div>
                  <br>
                </div>
                <br><br>

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
                  <input  onClick="generarPeriodo('<?php echo date('m');?>','<?php echo date('Y');?>');" value="Aceptar" style="margin-right:20px;" type="button" class="btn btn-secundary btn-flat" id="btnGuardar"/>                  
                </div>
              </div>
              <!-- /.modal-footer -->
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-Dialog -->
      </div>
      <!-- /.modalPeriodo -->


<!-- ./wrapper -->
  <?php include '../general/pie_pagina.php';?>  
</body>
</html>
<script src="js/script.js"></script>
<script type="text/javascript">  
  SeleccionarPeriodo('<?php echo date('m');?>');
  $('#tablaOCompra tbody').on('click','tr',function(){seleccionSimple(this);});  
   $('.date-picker').datepicker({
    autoclose: true,
    todayHighlight: true
  })    
</script>
