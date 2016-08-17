<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<?php 
  require('../bd/bd_conexion.php');
 ?>
<!DOCTYPE html>
<html>
<head>
  <title> Caja - Facturación | CLÍNICA CRISTO REDENTOR</title>
  <?php include '../general/header.php';?>
<style type="text/css">
</style>
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
        Caja
        <small>Apertura / Cierre</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Gestión de documentos</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">        
        <div class="row" align="center">
          <div class="col-xs-4 col-xs-offset-4">
            <?php 
                if ($_SESSION['estadoCaja'] == "C"){
                  ?>
                    <div class="row" id="btnAbrirCaja">
                      <div class="col-sm-4 col-sm-offset-4">
                          <a onclick="$('#formularioApertura').show('slow');"  id="mostrarDatosCaja" data-toggle="modal" class="btn btn-block btn-success">
                              <i class="ace-icon fa fa-unlock bigger-110" style="font-size:30px;"></i>
                              <br>
                              ABRIR
                          </a>
                      </div>
                    </div>
                  <?php 
                }else{
                  ?>
                    <div class="col-sm-4 col-sm-offset-4" >
                        <a onclick="$('#formularioCierre').show('slow');" href="javascrit:;" id="mostrarDatosCaja" data-toggle="modal" class="btn btn-block btn-danger">
                            <i class="ace-icon fa fa-lock  bigger-110" style="font-size:30px;"></i>
                            <br>
                            CERRAR
                        </a>
                    </div>
                  <?php 
                }
             ?>
            <div class="row" id="btnCerrarCaja">
              
            </div>
          </div>
        </div>
        <br>
        <?php 
          if ($_SESSION['estadoCaja'] == "C"){
            ?>
                <div class="row" id="formularioApertura" style="display:none">
                  <div class="col-sm-12">
                    <form id="formApertura">
                      <div class="box box-primary color-palette-box">          
                        <div class="box-body">
                            <div class="box-header" style="margin: -7px 0px -22px -10px">
                              <h1 class="box-title">Apertura de caja</h1>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-12" align="center">
                                <div class="form-group">
                                  <label for="txtFechaCierre">Seleccionar caja</label><label style="color:red">&nbsp;*</label>
                                  <div class="row">
                                    <div class="col-sm-2 col-sm-offset-5">
                                      <select class="form-control input-sm" id="cboCajas" name="cboCajas">
                                        <option value="1">Caja 1</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-2 col-sm-offset-3">
                                <div class="form-group">
                                  <label for="txtFechaApertura">Fecha</label>
                                  <input  style="font-weight: bold;" type="text" class="form-control input-sm" id="txtFechaApertura" name="txtFechaApertura" value="<?php echo date("d").'-'.date("m").'-'.date("Y"); ?>" disabled>
                                </div>
                              </div>
                              <div class="col-sm-2">
                                <div class="form-group">
                                  <label for="txtHoraApertura">Hora</label>
                                  <input   style="font-weight: bold;" type="text" class="form-control input-sm" id="txtHoraApertura" name="txtHoraApertura" value="<?php echo date("G").':'.date("i").':'.date("s"); ?>" disabled>
                                </div>
                              </div>
                              <div class="col-sm-2">
                                <div class="form-group">
                                  <label for="txtSaldoInicial">Saldo inicial (S/.)</label><label style="color:red">*</label>
                                  <input  style="font-weight: bold;" type="text" class="form-control input-sm text-center" id="txtSaldoInicial" name="txtSaldoInicial" maxlength="50" placeholder="0.00" onkeypress="return soloNumeroDecimal(event);">
                                </div>
                              </div>
                            </div>
                            <!-- ROW -->
                            <div class="row">
                              <div class="col-sm-4 col-sm-offset-3">
                                <div class="form-group">
                                  <label for="txtObservacionesI">Observaciones</label>
                                  <textarea class="form-control input-sm" id="txtObservacionesI" name="txtObservacionesI"></textarea>
                                </div>
                              </div>
                            </div>
                        </div>
                        <!-- BOx-body -->
                        <div class="box-footer" align="ceter">
                          <div class="row">
                            <div class="col-sm-3 col-sm-offset-3">
                              <div class="form-group" align="center">
                                <input  onClick="abrirCaja(this.form);" id="btnGuardar" value="Abrir caja" style="margin-right:20px;" type="button" class="btn btn-success btn-flat btn-block" />
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-group">
                                  <a class="btn btn-primary btn-flat btn-block" onclick="$('#formularioApertura').hide('slow');" >Cancelar</a>  
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- Apertura de caja -->
            <?php
          }else{
            ?>
              <div class="row" id="formularioCierre" style="display:none">
                <div class="col-sm-12">
                  <form id="formCierre">
                    <div class="box box-primary color-palette-box">          
                      <div class="box-body">
                          <div class="box-header" style="margin: -7px 0px -22px -10px">
                            <h1 class="box-title">Cierre de caja</h1>
                          </div>
                          <hr>
                          <div class="row">  
                            <div class="col-sm-6">
                              <div class="row">
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label for="txtFechaApertura"><strong>Caja</strong></label>
                                    <input type="text" class="form-control input-sm" id="txtFechaApertura" name="txtFechaApertura" value="Caja 1" disabled>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label for="txtFechaApertura">Fecha</label>
                                    <input type="text" class="form-control input-sm" id="txtFechaApertura" name="txtFechaApertura" value="<?php echo date("d").'-'.date("m").'-'.date("Y"); ?>" disabled>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label for="txtHoraApertura">Hora</label>
                                    <input type="text" class="form-control input-sm" id="txtHoraApertura" name="txtHoraApertura" value="<?php echo date("G").':'.date("i").':'.date("s"); ?>" disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="txtTotalBoletas">Total boletas S/.</label>
                                    <input type="text" class="form-control input-sm" id="txtTotalBoletas" name="txtTotalBoletas" disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="txtCantidadBoletas">N° boletas</label>
                                    <input type="text" class="form-control input-sm" id="txtCantidadBoletas" name="txtCantidadBoletas" disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="txtBoletaInicial">Boleta inicial</label>
                                    <input type="text" class="form-control input-sm" id="txtBoletaInicial" name="txtBoletaInicial" disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="txtBoletaFinal">Boleta final</label>
                                    <input type="text" class="form-control input-sm" id="txtBoletaFinal" name="txtBoletaFinal" disabled>
                                  </div>
                                </div>                          
                              </div>
                              <!-- row -->
                            </div>
                            <div class="col-sm-6">
                              <div class="row">
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label for="txtTotalVentas"><strong>Total ventas</strong></label>
                                    <input type="text" class="form-control input-sm" id="txtTotalVentas" name="txtTotalVentas" disabled>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label for="txtTotalTarjeta">Total tarjeta</label>
                                    <input type="text" class="form-control input-sm" id="txtTotalTarjeta" name="txtTotalTarjeta" disabled>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label for="txtTotalEfectivo">Total efectivo</label>
                                    <input type="text" class="form-control input-sm" id="txtTotalEfectivo" name="txtTotalEfectivo" disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="txtTotalIngreso">Total ingresos</label>
                                    <input type="text" class="form-control input-sm" id="txtTotalIngreso" name="txtTotalIngreso" disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="txtTotalEgresos">Total ingresos</label>
                                    <input type="text" class="form-control input-sm" id="txtTotalEgresos" name="txtTotalEgresos" disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="txtSaldoInicio">Saldo inicio caja</label>
                                    <input type="text" class="form-control input-sm" id="txtSaldoInicio" name="txtSaldoInicio" disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="txtSaldoActual">Saldo actual caja</label>
                                    <input type="text" class="form-control input-sm" id="txtSaldoActual" name="txtSaldoActual" disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="txtSaldoReal"><strong>Saldo real caja</strong></label>
                                    <input type="text" class="form-control input-sm" id="txtSaldoReal" name="txtSaldoReal">
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="txtDescuadre"><strong>Descuadre</strong></label>
                                    <input type="text" class="form-control input-sm" id="txtDescuadre" name="txtDescuadre" disabled>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="txtRetira"><strong>Retira</strong></label>
                                    <input type="text" class="form-control input-sm" id="txtRetira" name="txtRetira">
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="txtQueda"><strong>Queda</strong></label>
                                    <input type="text" class="form-control input-sm" id="txtQueda" name="txtQueda" disabled>
                                  </div>
                                </div>
                              </div>
                              <!-- row -->
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="txtObservaciones">Observaciones</label>
                                <textarea class="form-control input-sm" id="txtObservaciones" name="txtObservaciones" ></textarea>
                              </div>
                            </div>
                          </div>
                          <!-- ROW -->
                      </div>
                      <!-- BOx-body -->
                      <div class="box-footer" align="ceter">
                        <div class="row">
                          <div class="col-sm-3 col-sm-offset-3">
                            <div class="form-group" align="center">
                              <input  onClick="cerrarCaja(this.form);" id="btnGuardar" value="Cerrar caja" style="margin-right:20px;" type="button" class="btn btn-success btn-flat btn-block" />
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                                <a class="btn btn-primary btn-flat btn-block" onclick="$('#formularioCierre').hide('slow');" >Cancelar</a>  
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- Apertura de cierre -->
            <?php
          }
         ?>
                
             
      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Historial de registros</h3>
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          <table id="tablaRegistros" class="table table-bordered table-hover tablaDatos">
            <thead>
              <tr>
                <th>Item</th>
                <th>Apertura</th>
                <th>Saldo inicial</th>
                <th>Cierre</th>
                <th>Saldo actual</th>
                <th>Saldo real</th>
                <th>Descruadre</th>
                <th>Retira</th>
                <th>Remanente</th>
              </tr>
            </thead>
            <tbody class="cuerpoTabla" id="cuerpoTablaRegistros">               
            </tbody>            
          </table>
          <!-- tablaRegistros -->
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
<!-- ./wrapper -->
  <?php include '../general/pie_pagina.php';?>      
</body>
</html>
<script src="js/script.js"></script>
<script src="js/caja.js"></script>
<script type="text/javascript">
  // cargarTablaDocumentos();
  // cargarCboAreas();
  // $('#tablaDocumentos tbody').on('click','tr',function(){seleccionSimple(this);});
</script>
