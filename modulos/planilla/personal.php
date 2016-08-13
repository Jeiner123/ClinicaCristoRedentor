<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title>Gestión de personal | CLÍNICA CRISTO REDENTOR</title>
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
        Personal (general)
        <small>Lista - Registro - Actualización</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../gestion"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a></li>
        <li class="active">Gestión de personal</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Lista de personal</h3>
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="remove">
              <i class="fa fa-times"></i>
            </button>
          </div>
        </div>        
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          <div class="row">
            <div class="col-md-2 col-md-offset-5 col-xs-6 col-xs-offset-3">
              <a href="nuevo_personal.php" class="btn btn-block btn-primary btn-sm btn-flat">
                Nuevo
              </a>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <table id="tablaPersonal" class="table table-bordered table-hover tablaDatos">
                <thead>
                  <tr>
                    <th style='text-align:left;'>Código</th>
                    <th style='text-align:center;'>DNI</th>
                    <th>Nombres y apellidos</th>
                    <th>Teléfono</th>
                    <th>Tipo personal</th>
                    <th style='text-align:center;'>Estado</th>
                    <th style='text-align:center;'></th>
                  </tr>
                </thead>
                <tbody class="cuerpoTabla" id="cuerpoTablaPersonal">
                  <!-- Aqui irán los elementos de la tabla -->
                </tbody>
              </table>
            </div>
          </div>
        </div>            
        <!-- /.box-body -->
      </div>
      <!-- Lista de items -->

      <div class="modal fade" id="modalRegPersonal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="center">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form method="post" class="form-horizontal" id="formPersonal" enctype="multipart/form-data">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 id="titulo" class="modal-title subfuente text-center">
                      Registrar nuevo personal
                    </h4>
                </div>
                <!-- /.modal-header -->
                <div class="modal-body">
                  <input id="txtFlag" name="txtFlag" class="form-control" value="N" type="hidden" >
                  <div class="row">
                    <div class="col-md-12">
                      <h1 style="font-size:17px; margin:0px;" class="header blue">
                        Datos personales
                      </h1>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <label class="control-label">DNI</label>
                      <label class="control-label" style="color:red;"> *</label>
                      <input type="text" id="txtDNI" name="txtDNI"class="form-control input-sm"  maxlength="8" onkeypress="return soloNumeroEntero(event);" onchange="verificaDNI();" >
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Nombres</label>
                      <label class="control-label" style="color:red;"> *</label>
                      <input id="txtNombres" name="txtNombres" class="form-control input-sm" onkeypress="return soloLetras(event);" maxlength="45">
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Apellido paterno</label>
                      <label class="control-label" style="color:red;"> *</label>
                      <input id="txtPaterno" name="txtPaterno" class="form-control input-sm" onkeypress="return soloLetras(event);" maxlength="45">
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Apellido materno</label>
                      <label class="control-label" style="color:red;"> *</label>
                      <input id="txtMaterno" name="txtMaterno" class="form-control input-sm" onkeypress="return soloLetras(event);" maxlength="45">
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Fecha de nacimiento</label>
                      <input type="date" id="txtFechaN" name="txtFechaN" class="form-control input-sm">
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Sexo</label>
                      <select class="form-control input-sm" id="cboSexo" name="cboSexo">
                        <option value="M" selected> Masculino </option>
                        <option value="F"> Femenino </option>
                      </select> 
                    </div>
                    <div class="col-md-6 col-xs-12 col-sm-6">
                      <label class="control-label">Correo personal</label>
                      <label class="control-label" style="color:red;">*</label>
                      <input id="txtCorreoP" name="txtCorreoP" class="form-control input-sm" maxlength="145">
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Teléfono(1)</label>
                      <label class="control-label" style="color:red;"> *</label>
                      <input id="txtTelefono1" name="txtTelefono1"class="form-control input-sm"  maxlength="15" onkeypress="return soloNumeroEntero(event);" >
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Operador(1)</label>
                      <label class="control-label" style="color:red;"> *</label>
                      <select class="form-control input-sm" id="cboTipoTelefono1" name="cboTipoTelefono1">
                        <option value="0">-- Seleccionar --</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Teléfono(2)</label>
                      <input id="txtTelefono2" name="txtTelefono2"class="form-control input-sm"  maxlength="15" onkeypress="return soloNumeroEntero(event);" >
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Operador(2)</label>
                      <select class="form-control input-sm" id="cboTipoTelefono2" name="cboTipoTelefono2">
                        <option value="0">-- Seleccionar --</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="control-label">Dirección</label>
                      <input id="txtDireccion" name="txtDireccion"class="form-control input-sm" maxlength="240">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                      <h1 style="font-size:17px; margin:0px;" class="header blue">
                        Datos laborales
                      </h1>
                    </div>
                  </div>
                  <div class="row">

                    <div class="col-md-3">
                      <label class="control-label">Código</label>
                      <input type="text" id="txtCodigo" name="txtCodigo"class="form-control input-sm"  maxlength="10" onkeypress="return soloNumeroEntero(event);" disabled>
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Fecha de ingreso</label>
                      <input type="date" id="txtFechaI" name="txtFechaI" class="form-control input-sm">
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Sueldo mensual</label>
                      <input id="txtSueldo" name="txtSueldo"class="form-control input-sm"  maxlength="15" onkeypress="return soloNumeroDecimal(event);" >
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Tipo de personal</label>
                      <label class="control-label" style="color:red;">*</label>
                      <select class="form-control input-sm" id="cboTipoPersonal" name="cboTipoPersonal">
                      </select> 
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Área</label>
                      <label class="control-label" style="color:red;">*</label>
                      <select class="form-control input-sm" id="cboArea" name="cboArea" onchange="cargarCboCargos();">
                      </select> 
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Cargo</label>
                      <label class="control-label" style="color:red;">*</label>
                      <select class="form-control input-sm" id="cboCargo" name="cboCargo">
                      </select> 
                    </div>
                    <div class="col-md-3">
                      <label class="control-label">Estado</label>
                      <label class="control-label" style="color:red;"> *</label>
                      <select class="form-control input-sm" id="cboEstado" name="cboEstado">
                        <option value="0">-- Seleccionar --</option>
                        <option value="1">ACTIVO</option>
                        <option value="2">INACTIVO</option>
                      </select>
                    </div>
                    <div class="col-md-6 col-xs-12 col-sm-6">
                      <label class="control-label">Correo coorporativo</label>
                      <input id="txtCorreoC" name="txtCorreoC"class="form-control input-sm" maxlength="145">
                    </div>
                    <div class="col-md-6">
                      <label class="control-label">Observaciones</label>
                      <textarea class="form-control" id="txtObservaciones" name="txtObservaciones"></textarea>
                    </div>
                    <div class="col-md-4" align="left">
                      <small class="" style="color:red;">(*) Campos obligatorios</small>
                    </div>
                  </div>
                </div>
                <!-- /.modal-body -->
                <div class="modal-footer">                  
                  <div class="row" align="center">
                    <input  onClick="guardarPersonal(this.form);" value="Guardar" style="margin-right:20px;" type="button" class="btn btn-success btn-flat" id="btnGuardar"/>
                    <a class="btn btn-primary btn-flat" data-dismiss="modal" onClick="limpiarForm(this.form);">Regresar</a>                      
                  </div>
                </div>
                <!-- /.modal-footer -->
              </form>
              <!-- /.form -->
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-Dialog -->
      </div>
      <!-- /.modalRegPersonal -->
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
  cargarCboTipoPersonal();
  cargarCboAreas();
  cargarCboCargos();
  // cargarCboEspecialidades();
  cargarTablaPersonal();
  // abrirModal("#modalRegPersonal");
  $('#tablaPersonal tbody').on('click','tr',function(){seleccionSimple(this);});  
  
</script>
