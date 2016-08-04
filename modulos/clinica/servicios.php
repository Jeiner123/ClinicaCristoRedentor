<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
	<title> Gestión de servicios médicos | CLÍNICA CRISTO REDENTOR</title>
	<?php include '../general/header.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <input type='hidden' value='gestion' id='menuPrincipal'>
  <input type='hidden' value='m_clinica_servicios' id='menuIzquierda'>
	<?php include '../general/menu_principal.php';?>

<div class="wrapper">
  <?php include '../general/izquierda_menu.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Servicios de salud
        <small>Lista - Registro - Actualización</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../administracion"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a></li>
        <li class="active">Gestión de servicios médicos</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Box seleccionar menú y submenu-->
      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue">
          <div>
            <h3 class="box-title">Lista de Servicios de salud</h3>            
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
              <button type="button" class="btn btn-block btn-primary btn-sm btn-flat" onclick="abrirModal('#modalRegServicio');">
                Nuevo
              </button>
            </div>
          </div>
          <br>
          <table id="tablaServicios" width="100%" class="table table-bordered table-hover tablaDatos">
            <thead>
              <tr>
                <th>ID</th>
                <th>Servicio</th>
                <th>Precio (S/.)</th>
                <th>Especialidad</th>
                <th>ESPECIALIDAD ID</th>
                <th>Tipo Serv.</th>
                <th>TIPOSERVICIOID</th>
                <th>Estado</th>
                <th></th>
              </tr>
            </thead>
            <tbody class="cuerpoTabla" id="cuerpoTablaServicios">
              <!-- Aqui irán los elementos de la tabla -->        
            </tbody>
          </table>
        </div>            
        <!-- /.box-body -->
      </div>
      <!-- Lista de items -->

      <div class="modal fade" id="modalRegServicio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">             
              <form method="post" class="form-horizontal" id="formEspecialidad" enctype="multipart/form-data">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 id="titulo" class="modal-title subfuente text-center">Registrar nuevo servicio</h4>
                </div>
                <!-- /.modal-header -->
                <div class="modal-body">
                  <input id="txtFlag" name="txtFlag" class="form-control" value="N" type="hidden" >  
                  <input id="txtServicioID" name="txtServicioID" class="form-control" type="hidden">
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">Servicio</label>
                    <div class="col-md-8">
                      <input id="txtServicio" name="txtServicio" title="Ingrese el servicio" maxlength="150" type="text" class="form-control" >
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Precio unitario (S/.)</label>
                    <div class="col-md-4">
                      <input id="txtPrecio" name="txtPrecio" title="Ingrese el precio unitario" maxlength="200" type="text" class="form-control"  onkeypress="return soloNumeroDecimal(event);">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Estado</label>
                    <div class="col-md-8">
                      <select class="form-control" id="cboEstado" name="cboEstado">
                        <option value="0">-- Seleccionar --</option>
                        <option value="1" selected> ACTIVO </option>
                        <option value="2"> INACTIVO </option>
                      </select>                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Especialidad</label>
                    <div class="col-md-8">
                      <select class="form-control" id="cboEspecialidad" name="cboEspecialidad"> 
                        <!-- Datos -->
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Tipo de servicio</label>
                    <div class="col-md-8">
                      <select class="form-control" id="cboTipoServicio" name="cboTipoServicio">
                        <option value="0" selected>-- Seleccionar --</option>
                        <option value="1">Laboratorio</option>
                      </select>
                    </div>
                  </div>                  
                </div>
                <!-- /.modal-body -->
                <div class="modal-footer">
                  <div class="row" align="center">
                    <input type="button" class="btn btn-success btn-flat" id="btnGuardar" onClick="guardarServicio(this.form);" value="Guardar"/>
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
      <!-- /.modalRegServicio -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
  <?php include '../general/pie_pagina.php';?>
<!-- <div class="cargando">
  <div >
    <label>Cargando...</label>          
  </div>        
</div>   -->  
</body>
</html>
<script src="js/script.js"></script>
<script type="text/javascript">
  cargarTablaServicios();
  cargarCboEspecialidades();
  cargarCboTipoServicio();
  $('#tablaServicios tbody').on('click','tr',function(){seleccionSimple(this);}); 
</script>
