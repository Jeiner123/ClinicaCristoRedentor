<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<?php

  if(!isset($_GET['historia'])){
    exit();
  }else{
    $historia = $_GET['historia'];
    $paciente = $_GET['paciente'];
    $opc = $_GET['opc'];
  }
 ?>
<!DOCTYPE html>
<html>
<head>
  <title> Gestión de pacientes| CLÍNICA CRISTO REDENTOR</title>
  <?php include '../general/header.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <input type='hidden' value='menu_pacientes' id='menuPrincipal'>
  <input type='hidden' value='m_nuevo_paciente' id='menuIzquierda'>
  <?php include '../general/menu_principal.php';?>

<div class="wrapper">
  <?php include '../general/izquierda_menu.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 id="tituloPagina">
        <?php echo $paciente; ?>
        <small><?php echo $historia; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="listado_pacientes.php">Pacientes</a>
        </li>
        <li class="active">
          <?php echo $paciente; ?>
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-2">
          <div class="form-group">
            <button type="button" class="btn btn-block btn-primary btn-flat">Datos Personales</button>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <button type="button" class="btn btn-block btn-primary btn-flat">Antecedentes</button>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <button type="button" class="btn btn-block btn-primary btn-flat">Citas</button>
          </div>
        </div>              
        <div class="col-md-2">
          <div class="form-group">
            <button type="button" class="btn btn-block btn-primary btn-flat">Historia clínica</button>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <button type="button" class="btn btn-block btn-primary btn-flat">Resultado laboratorio</button>
          </div>
        </div>
      </div>
      <form method="post" class="" id="formPaciente" enctype="multipart/form-data">
        <div class="box box-primary color-palette-box">          
          <div class="box-body">            
            <input type="hidden" value="N" id="txtFlag">
            <div class="col-md-6">
               <!-- style="margin-left:-10px;margin-bottom:-10px;" -->
              <div class="box-header" style="margin: 0px 0px -15px -10px">
                <h1 class="box-title">Datos personales</h1>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group" autofocus>
                    <label for="ee">DNI</label><label style="color:red">*</label>
                    <input type="text" class="form-control input-sm" id="txtDNI" name="txtDNI" maxlength="8" onkeypress="return soloNumeroEntero(event);" onchange="verificaDNI(this.form);" autofocus="autofocus">
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="txtNombres">Nombres</label><label style="color:red">*</label>
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="txtNombres" name="txtNombres" maxlength="50">
                  </div>
                </div>
              </div>
              <!-- ROW -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtPaterno">Apellido paterno</label><label style="color:red">*</label>
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="txtPaterno"    name="txtPaterno" maxlength="50">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtMaterno">Apellido materno</label><label style="color:red">*</label>
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="txtMaterno"    name="txtMaterno" maxlength="50">
                  </div>
                </div>
              </div>
              <!-- ROW -->            
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtFechaN">Fecha nacimiento</label><label style="color:red">*</label>
                    <input id="txtFechaN" name="txtFechaN" class="form-control date-picker input-sm" placeholder="dd-mm-aaaa" type="text" data-date-format="dd-mm-yyyy">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="cboSexo">Sexo</label>
                    <select class="form-control input-sm" id="cboSexo" name="cboSexo">
                      <option value="M">Masculino</option>
                      <option value="F">Femenino</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- ROW -->
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="txtRUC">RUC</label>
                    <input type="text" class="form-control input-sm" id="txtRUC" name="txtRUC" maxlength="11">
                  </div>
                </div>
              </div>
              <!-- ROW  -->
            </div>
            <!-- COl-md-6   -->
            <div class="col-md-6">
              <div class="box-header" style="margin: 0px 0px -15px -10px">
                <h1 class="box-title">Datos de contacto</h1>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtTelefono1">Teléfono (1)</label><label style="color:red">*</label>
                    <input id="txtTelefono1" name="txtTelefono1"class="form-control input-sm"  maxlength="19" onkeypress="return soloNumeroEntero(event);" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="cboTipoTelefono1">Operador(1)</label><label style="color:red">*</label>
                    <select class="form-control input-sm" id="cboTipoTelefono1" name="cboTipoTelefono1">
                      <option value="0">-- Seleccionar --</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- ROW -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtTelefono2">Teléfono(2)</label>
                    <input id="txtTelefono2" name="txtTelefono2"class="form-control input-sm"  maxlength="19" onkeypress="return soloNumeroEntero(event);" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="cboTipoTelefono2">Operador(2)</label>
                    <select class="form-control input-sm" id="cboTipoTelefono2" name="cboTipoTelefono2">
                      <option value="0">-- Seleccionar --</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- ROW -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtCorreoP">Correo personal</label><label style="color:red">*</label>
                    <input id="txtCorreoP" name="txtCorreoP" class="form-control input-sm" maxlength="145">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="cboProcedencia">Procedencia</label><label style="color:red">*</label>
                    <select class="form-control input-sm" id="cboProcedencia" name="cboProcedencia">
                      <option value="0"> Seleccionar </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="txtDireccion">Dirección</label>
                    <input id="txtDireccion" name="txtDireccion"class="form-control input-sm" maxlength="240">
                  </div>
                </div>              
              </div>
              <!-- ROW -->
            </div>
            <!-- COL-MD-6 -->
            <div class="col-md-6">
              <div class="box-header"  style="margin: 0px 0px -15px -10px">
                <h1 class="box-title">Datos clínicos</h1>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="txtNroHistoria">Nro. Historia</label>
                    <input id="txtNroHistoria" name="txtNroHistoria"class="form-control input-sm" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="txtUltimaCita">Última cita</label>
                    <input id="txtFechaN" name="txtFechaN" class="form-control date-picker input-sm" placeholder="dd-mm-aaaa" type="text" data-date-format="dd-mm-yyyy" disabled>
                  </div>
                </div>
                <div class="col-md-5">
                  <label for="cboEstado">Estado</label>
                  <select class="form-control input-sm" id="cboEstado" name="cboEstado">
                    <option value="1">ACTIVO</option>
                    <option value="2">INACTIVO</option>
                  </select>
                </div>
              </div>
              <!-- ROW -->
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="txtObservaciones">Observaciones</label>
                    <textarea class="form-control input-sm" name="txtObservaciones" id="txtObservaciones" maxlength="240"></textarea>
                  </div>
                </div>
              </div>
              <!-- ROW -->
            </div>
          </div>
          <!-- BOx-body -->
          <div class="box-footer" align="ceter">
            <div class="form-group" align="center">
              <input  onClick="guardarPaciente(this.form);" id="btnGuardar" value="Guardar" style="margin-right:20px;" type="button" class="btn btn-success btn-flat" />
              <a class="btn btn-primary btn-flat" data-dismiss="modal" >Regresar</a>
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
  cargarCboTipoTelefono();
  cargarCboProcedencias();  
  $('.date-picker').datepicker({
    autoclose: true,
    todayHighlight: true
  })
  mostrarPaciente(<?php echo $historia; ?>);  
</script>

