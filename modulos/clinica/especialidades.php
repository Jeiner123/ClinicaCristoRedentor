<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
	<title> Gestión de especialidades médicas | CLÍNICA CRISTO REDENTOR</title>
	<?php include '../general/header.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <input type='hidden' value='gestion' id='menuPrincipal'>
  <input type='hidden' value='m_clinica_especialidades' id='menuIzquierda'>
	<?php include '../general/menu_principal.php';?>

<div class="wrapper">
  <?php include '../general/izquierda_menu.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Especialidades médicas
        <small>Lista - Registro - Actualización</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../gestion"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a></li>
        <li class="active">Gestión de especialidades</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Lista de especialidades médicas</h3>            
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
              <button type="button" class="btn btn-block btn-primary btn-sm btn-flat" onclick="abrirModal('#modalRegEspec');">
                Nuevo
              </button>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <table id="tablaEspecialidades" class="table table-bordered table-hover tablaDatos">
                <thead>
                  <tr>
                    <th style="text-align:center">ID</th>
                    <th>Especialidad</th>
                    <th style="text-align:center">N° Especialistas</th>
                    <th style="text-align:center">Estado</th>
                    <th style="text-align:center"></th>
                  </tr>
                </thead>
                <tbody class="cuerpoTabla" id="cuerpoTablaEspecialidades">
                  <!-- Aqui irán los elementos de la tabla -->                        
                </tbody>
              </table>
            </div>
          </div>
        </div>            
        <!-- /.box-body -->
      </div>
      <!-- Lista de items -->

      <div class="modal fade" id="modalRegEspec" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">             
              <form method="post" class="form-horizontal" id="formEspecialidad" enctype="multipart/form-data">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 id="titulo" class="modal-title subfuente text-center">Registrar nueva especialidad</h4>
                </div>
                <!-- /.modal-header -->
                <div class="modal-body">
                  <input id="txtFlag" name="txtFlag" class="form-control" value="N" type="hidden">
                  <input id="txtEspecialidadID" name="txtEspecialidadID" class="form-control"type="hidden" >
                  <div class="form-group">
                    <label class="col-md-3 control-label">Especialidad</label>
                    <div class="col-md-8">
                      <input id="txtEspecialidad" name="txtEspecialidad" title="Ingrese la especialidad" maxlength="200" type="text" class="form-control" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Estado</label>
                    <div class="col-md-8">
                      <select class="form-control" id="cboEstado" name="cboEstado">
                        <option value="0">-- Seleccionar --</option>
                        <option value="1" selected> Activo </option>
                        <option value="2"> Inactivo </option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- /.modal-body -->
                <div class="modal-footer">
                  <div class="row" align="center">
                    <input type="button" class="btn btn-success btn-flat btnGuardar" onClick="guardarEspecialidad(this.form);" value="Guardar"/>
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
        <!-- /.modalRegEspec -->
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
  cargarTablaEspecialidades();
  $('#tablaEspecialidades tbody').on('click','tr',function(){seleccionSimple(this);});
</script>
