<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<?php 
  $opcion='N';
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Gestión de facturas | CLÍNICA CRISTO REDENTOR</title>
  <?php include '../general/header.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <input type='hidden' value='menu_compras' id='menuPrincipal'>
  <input type='hidden' value='facturas' id='menuIzquierda'>
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
                <div class="col-md-12">
                  <div class="box-header"  style="margin: -30px 0px -15px -10px">
                      <br><h1 class="box-title">DATOS GENERALES</h1>
                  </div>
                  <hr>
                </div>
                <input id="txtFlag" name="txtFlag" class="form-control" type="hidden" value="<?php echo $opcion; ?>">
                <div class="row" style="margin-left:5px;">
                  <div class="col-md-2">
                    <label class="control-label">Periódo</label>
                    <input type="text" id="txtPeriodo" name="txtPeriodo"class="form-control input-sm" readonly="" value="">
                  </div>
                  <div class="col-md-2">
                    <label class="control-label">Número</label>
                    <input type="text" id="txtNumero" name="txtNumero"class="form-control input-sm" readonly="">
                  </div>
                  <div class="col-md-3">
                    <label class="control-label">Fecha</label>
                    <div class="input-group">
                      <input id="txtFechaCita" name="txtFechaCita"class="form-control date-picker" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);" value="<?php echo $fechaHoyDMA;?>" readonly>
                      <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="cboArea">Pto. Emisión</label>
                      <select class="form-control input-sm" name="cboArea" id="cboArea">
                        <option value="0">--Seleccionar--</option>
                      </select>
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
                      <label for="cboTipoExistencia">Tipo</label>
                      <select class="form-control input-sm" name="cboTipoExistencia" id="cboTipoExistencia">
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
                      <textarea class="form-control" id="txtObservaciones" name="txtObservaciones" rows="3"></textarea>
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
                        <option value="1">No aplica</option>
                        <option value="2">I.G.V 18%</option>
                      </select>
                    </div>
                    <div class="col-md-12">
                      <label for="cboPercepcion">Percepción</label>
                      <select class="form-control input-sm" name="cboPercepcion" id="cboPercepcion">
                        <option value="1">No aplica</option>
                        <option value="2">Percep.2%</option>
                        <option value="3">Serv.6.5%</option>
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
                      <div class="col-md-2">
                        <input type="checkbox" name="vehicle" value="Bike">Incluye impuestos<br>
                      </div>
                      <div class="col-md-2">
                        <label for="txtSubTotal">SubTotal</label>
                        <input class="form-control input-sm" name="txtSubTotal" id="txtSubTotal" onkeypress="return soloNumeroDecimal(event);" readonly=""></input>
                      </div>
                      <div class="col-md-2">
                         <label for="txtDescuento">Descuento</label>
                        <input class="form-control input-sm" name="txtDescuento" id="txtDescuento" onkeypress="return soloNumeroDecimal(event);"></input>
                      </div>
                      <div class="col-md-2">
                        <label for="txtBaseGravable">Base gravable</label>
                        <input class="form-control input-sm" name="txtBaseGravable" id="txtBaseGravable" onkeypress="return soloNumeroDecimal(event);"></input>
                      </div>
                      <div class="col-md-2">
                        <label for="txtImpuesto">Impuesto</label>
                        <input class="form-control input-sm" name="txtImpuesto" id="txtImpuesto" onkeypress="return soloNumeroDecimal(event);"></input>
                      </div>
                      <div class="col-md-2">
                        <label for="txtTotal">Total</label>
                        <input class="form-control input-sm" name="txtTotal" id="txtTotal" onkeypress="return soloNumeroDecimal(event);" readonly=""></input>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="input-group"><br><hr>
                        <div class="input-group-btn">
                          <button onclick="crearfila();" type="button"class="btn btn-success" title="Agregar fila">
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
                        <?php for ($i=1;$i<=3;++$i): ?>
                          <tr>
                            <td><input class="form-control input-sm" id="txtItem<?php echo $i;?>" name="txtItem<?php echo $i;?>" style='text-align:right;' readonly value="<?php echo $i;?>"></input></td>
                            <td><input class="form-control input-sm" id="txtCodigo<?php echo $i;?>" name="txtCodigo<?php echo $i;?>"></input></td>
                            <td><input class="form-control input-sm" id="txtDescripcion<?php echo $i;?>" name="txtDescripcion<?php echo $i;?>"></input></td>
                            <td><input class="form-control input-sm" id="txtUnidad<?php echo $i;?>" name="txtUnidad<?php echo $i;?>"></input></td>
                            <td><input class="form-control input-sm" id="txtCantidad<?php echo $i;?>" name="txtCantidad<?php echo $i;?>"  onkeypress="return soloNumeroEntero(event);"></input></td>
                            <td><input class="form-control input-sm" id="txtCosto<?php echo $i;?>" name="txtCosto<?php echo $i;?>" onkeypress="return soloNumeroDecimal(event);"></input></td>
                            <td><input class="form-control input-sm" id="txtDescuento<?php echo $i;?>" name="txtDescuento<?php echo $i;?>" onkeypress="return soloNumeroDecimal(event);"></input></td>
                            <td><input class="form-control input-sm" id="txtImporte<?php echo $i;?>" name="txtImporte<?php echo $i;?>" onkeypress="return soloNumeroDecimal(event);" readonly></input></td>
                          </tr>
                        <?php endfor; ?>
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
                          <button type="submit" class="btn btn-primary btn-block">Registrar nueva orden</button>
                      </div>
                  </div>
                  <br><br>
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
                  <div class="col-md-3">
                    <label for="cboMes">Periódo</label>
                  </div>
                   <div class="col-md-9">
                    <select class="form-control input-sm" name="cboMes" id="cboMes">
                      <?php
                        foreach ($meses as $mes => $value) {
                          echo '<option value="'.$mes.'">'.$meses[$mes].'</option>';
                        }
                      ?>
                    </select>
                    <label class="control-label" style="color:red;font-size: 10px;" id="lbError"></label>
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
