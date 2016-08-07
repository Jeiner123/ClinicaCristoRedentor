<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title>Asignación de especialidades | CLÍNICA CRISTO REDENTOR</title>
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
      <div class="row">
        <div class="col-md-3  col-xs-6 ">
          <button type="button" class="btn btn-block btn-success btn-sm btn-flat" onclick="asignarEspec();">
            Asignar nueva especialidad
          </button>
        </div>
        <div class="col-md-3  col-xs-6 ">
          <button type="button" class="btn btn-block btn-primary btn-sm btn-flat" onclick="cargarEspecialidadesMedico();">
            Ver especialidades
          </button>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-7">
          <div class="box box-solid color-palette-box">
            <div class="box-header bg-blue" >
              <div>
                <h3 class="box-title">Lista de personal de salud</h3>
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
                <div class="col-md-12">
                  <table id="tablaPersonal" class="table table-bordered table-hover tablaDatos">
                    <thead>
                      <tr>
                        <th style='text-align:center;'>Código</th>
                        <th style='text-align:center;'>DNI</th>
                        <th>Nombres y apellidos</th>
                        <th>Teléfono</th>
                        <th>Tipo personal</th>
                        <th style='text-align:center;'></th>
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
        </div>
        <div class="col-md-5">
          <div class="box box-solid color-palette-box">
            <div class="box-header bg-blue" >
              <div>
                <h3 class="box-title">Especialidades</h3>            
              </div>
              <div class="box-tools pull-right">
                <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body" align="center">          
              <div class="row" id="">
                      <div class="col-md-10 col-md-offset-1">
                        <table id="tablaEspecialidadesAsig" class="table table-bordered table-striped table-hover dataTable"role="grid"aria-describedby="example1_info">
                          <thead style="background-color:#ccc;">
                            <tr>
                              <th>Servicio</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody class="cuerpoTabla" id="cuerpoTablaEspecialidadesAsig">
                            <!-- Aqui irán los elementos de la tabla -->
                          </tbody>
                        </table>
                        <!--tablaEspecialidadesAsig-->  
                      </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- Detalle del pedido -->
        </div>
      </div>

          
          

      <div class="modal fade" id="modalRegAsignacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="center">
          <div class="modal-dialog ">
            <div class="modal-content">
              <form method="post" class="form-horizontal" id="formPersonal" enctype="multipart/form-data">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 id="titulo" class="modal-title subfuente text-center">
                      Nueva asignación
                    </h4>
                </div>
                <!-- /.modal-header -->
                <div class="modal-body">
                  <input id="txtFlag" name="txtFlag" class="form-control" value="N" type="hidden" >
                    <div class="form-group">
                      <label class="col-md-3 control-label">Código</label>
                      <div class="col-md-8">
                        <input id="txtCodigo" name="txtCodigo" class="form-control" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Personal</label>
                      <div class="col-md-8">
                        <input id="txtPersonal" name="txtPersonal"class="form-control" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Especialidad</label>
                      <div class="col-md-8">
                        <select class="form-control input-sm" id="cboEspecialidad" name="cboEspecialidad">
                          
                        </select> 
                      </div>
                    </div>
                </div>
                <!-- /.modal-body -->
                <div class="modal-footer">                  
                  <div class="row" align="center">
                    <input  onClick="guardarAsignacion(this.form);" value="Guardar" style="margin-right:20px;" type="button" class="btn btn-success btn-flat" id="btnGuardar"/>
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
        <!-- /.modalRegAsignacion -->
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
  cargarTablaMedicos();
  cargarEspecialidadesMedico(1);

  $('#tablaPersonal tbody').on('click','tr',function(){
    seleccionSimple(this);
    cargarEspecialidadesMedico($('#tablaPersonal').DataTable().cell('.active',0).data());
  });
  // cargarCboTipoTelefono();
  // cargarCboTipoPersonal();
  // cargarCboAreas();
  // cargarCboCargos();
  cargarCboEspecialidades();
  // cargarTablaPersonal();
  // abrirModal("#modalRegAsignacion");
  
  
</script>
