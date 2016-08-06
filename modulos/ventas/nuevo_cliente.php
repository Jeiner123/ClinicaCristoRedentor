<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title>Nuevo cliente | CLÍNICA CRISTO REDENTOR</title>
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
        Nuevo cliente
        <!-- <small>Consultorio - Laboratorio</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="listado_clientes.php">Clientes</a>
        </li>
        <li class="active">
          Nuevo cliente
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <form method="post" class="" id="formPaciente" enctype="multipart/form-data">
        <div class="box box-primary color-palette-box">          
          <div class="box-body">
            <input type="hidden" value="N" id="txtFlag">
            <div class="col-md-6">
               <!-- style="margin-left:-10px;margin-bottom:-10px;" -->
              <div class="box-header" style="margin: 0px 0px -15px -10px">
                <h1 class="box-title">Datos del cliente</h1>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12" align="center">
                  <div class="form-group">
                    <label for="cboTipoEntidad">Tipo de entidad</label>
                    <select class="form-control input-sm" id="cboTipoEntidad" name="cboTipoEntidad">
                      <option value="0">Elegir tipo</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="cboTipoDocumento">Tipo de documento</label>
                    <select class="form-control input-sm" id="cboTipoDocumento" name="cboTipoDocumento">
                      <option value="0">Elegir tipo</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtNumeroDocumento">Número (RUC,DNI,Etc)</label>
                    <input type="text" class="form-control input-sm" id="txtNumeroDocumento" name="txtNumeroDocumento" maxlength="15" onkeypress="return soloNumeroEntero(event);" onchange="verificaDNI(this.form);" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtRazonSocial">Razón social</label>
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="txtRazonSocial" name="txtRazonSocial" maxlength="50" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtNombres">Nombres</label>
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="txtNombres" name="txtNombres" maxlength="50" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtPaterno">Apellido paterno</label>
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="txtPaterno"    name="txtPaterno" maxlength="50" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtMaterno">Apellido materno</label>
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="txtMaterno"    name="txtMaterno" maxlength="50" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="txtDireccion">Dirección fiscal</label>
                    <input id="txtDireccion" name="txtDireccion"class="form-control input-sm" maxlength="240">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="txtDireccion">Observaciones</label>
                    <textarea class="form-control input-sm" id="txtObservaciones" name="txtObservaciones"></textarea>
                  </div>
                </div>
              </div>
              <!-- ROW -->
            </div>
            <!-- COl-md-6   -->
            <div class="col-md-6">
              <div class="box-header" style="margin: 0px 0px -15px -10px">
                <h1 class="box-title">Datos de contacto</h1>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="txtRepresentante">Nombres y apellidos del representante</label>
                    <input id="txtRepresentante" name="txtRepresentante"class="form-control input-sm"  maxlength="19" onkeypress="return soloTelefono(event);" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtTelefono1">Teléfono</label>
                    <input id="txtTelefono1" name="txtTelefono1"class="form-control input-sm"  maxlength="19" onkeypress="return soloTelefono(event);" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="cboTipoTelefono1">Operador</label>
                    <select class="form-control input-sm" id="cboTipoTelefono1" name="cboTipoTelefono1">
                      <option value="0">-- Seleccionar --</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="txtCorreoP">Correo electrónico</label>
                    <input id="txtCorreoP" name="txtCorreoP" class="form-control input-sm" maxlength="145">
                  </div>
                </div>
              </div>
              <!-- ROW -->
            </div>
            <!-- COL-MD-6 -->
            <div class="col-md-6">
              <div class="box-header" style="margin: 0px 0px -15px -10px">
                <h1 class="box-title">Cuentas bancarias</h1>
              </div>
              <hr>
              <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                    <label for="cboEntidadBancaria">Entidad bancaria</label>
                    <select class="form-control input-sm" id="cboEntidadBancaria" name="cboEntidadBancaria">
                      <option value="0">-- Seleccionar --</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtNumeroCuenta">Número de cuenta</label>
                    <input id="txtNumeroCuenta" name="txtNumeroCuenta"class="form-control input-sm"  maxlength="19" onkeypress="return soloTelefono(event);" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtNroCuentaD">N° Cuenta de detracción</label>
                    <input id="txtNroCuentaD" name="txtNroCuentaD"class="form-control input-sm"  maxlength="19" onkeypress="return soloTelefono(event);" >
                  </div>
                </div>
              </div>
              <!-- ROW -->
            </div>
            <!-- COL-MD-6 -->
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
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
  <?php include '../general/pie_pagina.php';?>
  
</body>
</html>
<script src="js/script.js"></script>
<script type="text/javascript">
  cargarCboTipoTelefono();
  
  $('.date-picker').datepicker({
    autoclose: true,
    todayHighlight: true
  })    
  
</script>

