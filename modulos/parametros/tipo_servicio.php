<?php include '../general/validar_sesion.php';?>
<!DOCTYPE html>
<html>
<head>
	<title> Tipos de servicio | CLÍNICA CRISTO REDENTOR</title>
	<?php include '../general/header.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <input type='hidden' value='gestion' id='menuPrincipal'>
  <input type='hidden' value='m_para_tipo_servicio' id='menuIzquierda'>
	<?php include '../general/menu_principal.php';?>

<div class="wrapper">
  <?php include '../general/izquierda_menu.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>        
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../gestion"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a></li>
        <li class="active">Tipos de servicio</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-solid color-palette-box" align="center">
        <div class="box-body">
          <div class="col-md-8">
            <button type="button" class="btn btn-secundary" onclick="document.getElementById('txtFlag').value='A';abrirModal('#modalRegEspec');">
              Agregar
            </button>
            <button type="button" class="btn btn-secundary" title="Modificar" onclick="modificarEspecialidad();">
              Modificar
            </button>
            <button type="button" class="btn btn-danger" title="Eliminar"  onclick="eliminar...();">
              Eliminar
            </button>
          </div>
          <div class="col-md-4" align="right">
            <button type="button" class="btn btn-secundary" title="Activar" onclick="activar...();">
              Activar
            </button>
            <button type="button" class="btn btn-danger" title="IInactivar" onclick="inactivar...();">
              Inactivar
            </button>
          </div>
        </div>
        <!-- BOX BODY -->
      </div>
      <!-- Box seleccionar menú y submenu-->
      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue">
          <h3 class="box-title">Tipos de servicio</h3>
        </div>
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          <table id="tablaEspecialidades" class="table table-bordered table-hover tablaDatos">
            <thead>
              <tr>
                <th>Código</th>
                <th>Tipo de servicio</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody class="cuerpoTabla" id="cuerpoTablaEspecialidades">
              <!-- Aqui irán los elementos de la tabla -->                        
            </tbody>
            <tfoot>
              <tr>
                <th>Código</th>
                <th>Tipo de servicio</th>
                <th>Estado</th>
              </tr>
            </tfoot>
          </table>
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
                  <input id="txtFlag" name="txtFlag" class="form-control" value="A">
                  <input id="txtEspecialidadID" name="txtEspecialidadID" class="form-control">
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
                    <input type="button" class="btn btn-successInverse" onClick="guardarEspecialidad(this.form);" value="Guardar"/>
                    <a class="btn btn-secundary" data-dismiss="modal" onClick="limpiarForm(this.form);">Cancelar</a>
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
<script type="text/javascript">
  // cargarTablaEspecialidades();
  // $('#tablaEspecialidades tbody').on('click','tr',function(){seleccionSimple(this);});
  

</script>
