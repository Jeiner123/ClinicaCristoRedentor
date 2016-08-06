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
                  <div class="col-md-5">
                    <label for="cboTipoOperacion">Tipo de compra</label>
                      <select class="form-control input-sm" name="cboTipoOperacion" id="cboTipoOperacion">
                      <option value="1">COMPRAS NACIONALES</option>
                      <option value="2">COMPRAS INTERNACIONALES</option>
                      </select>
                  </div>
                </div><br>

                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box-header"  style="margin: -30px 0px -15px -10px">
                          <br><h1 class="box-title">DOCUMENTO</h1>
                      </div>
                      <hr>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5">
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
                    <div class="col-md-2">
                      <label class="control-label">Serie</label>
                      <input type="text" id="txtSerie" name="txtSerie"class="form-control input-sm">
                    </div>
                    <div class="col-md-2">
                      <label class="control-label">Número</label>
                      <input type="text" id="txtNumero" name="txtNumero"class="form-control input-sm">
                    </div>
                    <div class="col-md-3">
                    <label class="control-label">Fecha</label>
                    <div class="input-group">
                      <input id="txtFechaCita" name="txtFechaCita"class="form-control date-picker" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);" value="" >
                      <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                      </span>
                    </div>
                  </div>
                    <div class="col-md-3">
                    <label for="cboTipoOperacion">Tipo de documento</label>
                    <select class="chosen-select form-control" name="cboComprobante" id="cboComprobante">
                      </select>
                  </div>
                  <div class="col-md-3">
                    <label class="control-label">Vencimiento</label>
                    <div class="input-group">
                      <input id="txtFechaCita" name="txtFechaCita"class="form-control input-sm date-picker" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);" value="">
                      <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-md-3">
                      <label for="cboTipoCompra">Moneda</label>
                      <select class="form-control input-sm">
                        <option value="1">SOLES</option>
                        <option value="2">DOLARES AMERICANOS</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Cond. de Pago</label>
                      <select class="form-control input-sm" id="cboModalidadPago" name="cboModalidadPago">
                      </select> 
                    </div>
                    

                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="cboTipoExistencia">Tipo de bien o servicio</label>
                      <select class="form-control input-sm" name="cboTipoExistencia" id="cboTipoExistencia">
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Tipo de adquisición</label>
                      <select class="form-control input-sm" id="cboAdquisicion" name="cboAdquisicion">
                      </select> 
                    </div>
                  </div>
                </div>

                 <div class="col-md-6">
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box-header"  style="margin: -30px 0px -15px -10px">
                          <br><h1 class="box-title">TRIBUTOS</h1>
                      </div>
                      <hr>
                    </div>
                    <div class="col-md-4">
                      <label for="cboIGV">I.G.V</label>
                      <select class="form-control input-sm" name="cboIGV" id="cboIGV">
                        <option value="1">No aplica</option>
                        <option value="2">I.G.V 18%</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="cboPercepcion">Percepción</label>
                      <select class="form-control input-sm" name="cboPercepcion" id="cboPercepcion">
                        <option value="1">No aplica</option>
                        <option value="2">Percep.2%</option>
                        <option value="3">Serv.6.5%</option>
                      </select>
                    </div>
                     <div class="col-md-4">
                      <label for="cboRenta">Renta</label>
                      <select class="form-control input-sm" name="cboRenta" id="cboRenta">
                        <option value="1">No aplica</option>
                        <option value="2">Renta 8%</option>
                      </select>
                    </div>
                  </div></div>

                  <div class="col-md-3">
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box-header"  style="margin: -30px 0px -15px -10px">
                          <br><h1 class="box-title">RETENCIÓN</h1>
                      </div>
                      <hr>
                    </div>
                    <div class="col-md-6">
                      <label for="chkTasaRetencion">¿Retención?</label>
                      <input type="checkbox" name="chkTasaRetencion" id="chkTasaRetencion">
                    </div>
                    <div class="col-md-6">
                      <label for="txtImporte">Importe</label>
                      <input class="form-control input-sm" name="txtImporte" id="txtImporte" onkeypress="return soloNumeroDecimal(event);" readonly="" placeholder="S/."></input>
                    </div>
                     
                  </div></div>

                  <div class="col-md-3">
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box-header"  style="margin: -30px 0px -15px -10px">
                          <br><h1 class="box-title">DETRACCIÓN</h1>
                      </div>
                      <hr>
                    </div>
                    <div class="col-md-6">
                      <label for="cboTasa">¿Detracción?</label>
                      <input type="checkbox" name="chkDetraccion" id="chkDetraccion">
                    </div>
                    <div class="col-md-6">
                      <label for="txtImporte">Total</label>
                      <input class="form-control input-sm" name="txtDetraccion" id="txtDetraccion" onkeypress="return soloNumeroDecimal(event);" readonly="" placeholder="S/."></input>
                    </div>
                     
                  </div></div>
                
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box-header"  style="margin: -10px 0px -15px -10px">
                          <br><h1 class="box-title">DETALLE DEL DOCUMENTO</h1>
                      </div>
                      <hr>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-2">
                        <label for="txtBaseAfecta">Base Afecta</label>
                        <input class="form-control input-sm" name="txtBaseAfecta" id="txtBaseAfecta" onkeypress="return soloNumeroDecimal(event);"></input>
                      </div>
                      <div class="col-md-2">
                        <label for="txtInafecto">Inafecto</label>
                        <input class="form-control input-sm" name="txtInafecto" id="txtInafecto" onkeypress="return soloNumeroDecimal(event);" ></input>
                      </div>
                      <div class="col-md-2">
                         <label for="txtIGV">I.G.V</label>
                        <input class="form-control input-sm" name="txtIGV" id="txtIGV" onkeypress="return soloNumeroDecimal(event);" readonly=""></input>
                      </div>
                      <div class="col-md-2">
                        <label for="txtPercepcion">Percepción</label>
                        <input class="form-control input-sm" name="txtPercepcion" id="txtPercepcion" onkeypress="return soloNumeroDecimal(event);" readonly=""></input>
                      </div>
                      <div class="col-md-2">
                        <label for="txtRenta">Renta</label>
                        <input class="form-control input-sm" name="txtRenta" id="txtRenta" onkeypress="return soloNumeroDecimal(event);" readonly=""></input>
                      </div>
                      <div class="col-md-2">
                        <label for="txtTotal">Total</label>
                        <input class="form-control input-sm" name="txtTotal" id="txtTotal" onkeypress="return soloNumeroDecimal(event);" readonly=""></input>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="input-group"><br><hr>
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
                        <?php for ($i=1;$i<=3;++$i): ?>
                          <tr>
                            <td><input class="form-control input-sm" id="txtItem<?php echo $i;?>" name="txtItem<?php echo $i;?>" style='text-align:right;' readonly value="<?php echo $i;?>"></input></td>
                            <td><input class="form-control input-sm" id="txtReferencia<?php echo $i;?>" name="txtReferencia<?php echo $i;?>"></input></td>
                            <td><input class="form-control input-sm" id="txtCuenta<?php echo $i;?>" name="txtCuenta<?php echo $i;?>"  onkeypress="return soloNumeroEntero(event);"></input></td>
                            <td><input class="form-control input-sm" id="txtDescripcion<?php echo $i;?>" name="txtDescripcion<?php echo $i;?>"></input></td>
                            <td><input class="form-control input-sm" id="txtCantidad<?php echo $i;?>" name="txtCantidad<?php echo $i;?>"  onkeypress="return soloNumeroEntero(event);"></input></td>
                            <td><input class="form-control input-sm" id="txtCosto<?php echo $i;?>" name="txtCosto<?php echo $i;?>" onkeypress="return soloNumeroDecimal(event);"></input></td>
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
                          <button type="submit" class="btn btn-primary btn-block">Registrar nuevo documento</button>
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
