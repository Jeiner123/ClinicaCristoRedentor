<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<?php 
  $opcion='N';
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Nueva cuenta | CLÍNICA CRISTO REDENTOR</title>
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
      <h1 id="tituloPagina">
        Registrar nueva cuenta
        <!-- <small>Consultorio - Laboratorio</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="listado_pacientes.php">Parámetros</a>
        </li>
        <li class="active">
          Nuevo cuenta
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <form class="form-horizontal" role="form" method="post" id="formProveedor" name="formProveedor" enctype="multipart/form-data">
        <div class="box box-primary color-palette-box">          
          <div class="box-body">
            <input id="txtFlag" name="txtFlag" class="form-control" type="hidden" value="<?php echo $opcion; ?>">
            <div class="row">
              <div class="col-md-2">
                <label class="control-label" style="font-weight: bold;">Cuenta</label>
                <input type="text" class="form-control input-sm" id="txtCuenta" name="txtCuenta"></input>
              </div>
              <div class="col-md-5">
                <label class="control-label" style="font-weight: bold;">Descripcion</label>
                <input type="text" class="form-control input-sm" id="txtDescripcion" name="txtDescripcion"></input>
              </div>
              <div class="col-md-2">
                <label class="control-label" style="font-weight: bold;">Nivel</label>
                <select class="form-control input-sm" id="cboNivel" name="cboNivel" onchange="cargarCuentas();">
                </select>
              </div>
              <div class="col-md-3">
                <label class="control-label" style="font-weight: bold;">Tipo de cuenta</label>
                <select class="form-control input-sm" id="cboTipoCuenta" name="cboTipoCuenta">
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="control-label" style="font-weight: bold;">Destino debe</label>
                <select class="form-control input-sm" id="cboDestinoDebe" name="cboDestinoDebe">
                </select>
              </div>
              <div class="col-md-6">
                <label class="control-label" style="font-weight: bold;">Destino haber</label>
                <select class="form-control input-sm" id="cboDestinoHaber" name="cboDestinoHaber">
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <label class="control-label" style="font-weight: bold;">Situación financiera</label>
                <select class="form-control input-sm" id="cboSituacionFinanciera" name="cboSituacionFinanciera">
                </select>
              </div>
              <div class="col-md-4">
                <label class="control-label" style="font-weight: bold;">Estado de Resultado por Función</label>
                <select class="form-control input-sm" id="cboEstadoFuncion" name="cboEstadoFuncion">
                </select>
              </div>
              <div class="col-md-4">
                <label class="control-label" style="font-weight: bold;">Estado de Resultado por Naturaleza</label>
                <select class="form-control input-sm" id="cboEstadoNaturaleza" name="cboEstadoNaturaleza">
                </select>
              </div>
            </div>
          </div>
          <!-- BOx-body -->
          <div class="box-footer" align="ceter">
            <div class="row">
              <div class="col-md-6">
                <input  onClick="mantenerProveedor(this.form);" value="Guardar" style="margin-right:20px;" type="button" class="btn btn-success btn-block btn-flat" id="btnGuardar"/>
              </div>
              <div class="col-md-6">
                <a class="btn btn-primary btn-block btn-flat" data-dismiss="modal" href="plan_contable.php">Ver plan contable</a> 
              </div>                     
            </div>
          </div>
        </div>
      </form>
      <!-- Formulario registrar nuevo paciente -->
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
  cargarCboNivel(1);
  cargarCboTipoCuenta(1,0);
</script>
