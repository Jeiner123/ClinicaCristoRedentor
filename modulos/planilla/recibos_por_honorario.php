<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title>Recibos por honorario | CLÍNICA CRISTO REDENTOR</title>
  <?php include '../general/header.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <?php include '../general/menu_principal.php';?>

<div class="wrapper">
  <?php include '../general/izquierda_menu.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Content Header -->
	<section class="content-header">
	  <h1>
		Personal
		<small>Recibos por honorario</small>
	  </h1>
	  <ol class="breadcrumb">
		<li>
            <a href="#"><i class="fa fa-dashboard"></i>Inicio</a>
        </li>
		<li class="active">Recibos por honorario</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">

	  <div class="row">
          <div class="col-md-12">
              <div class="box box-solid color-palette-box">
                  <div class="box-header bg-blue">
                      <h3 class="box-title">Consultar recibos por honorario</h3>
                      <div class="box-tools pull-right">
                          <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
                              <i class="fa fa-minus"></i>
                          </button>
                      </div>
                  </div>
                  <div class="box-body" align="center">
                      <form class="form-inline" role="form">
                          <div class="form-group">
                              <label for="">Seleccione año</label>
                              <select name="" id="" class="form-control">
                                  <option value="0">-- Seleccione --</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="">Seleccione mes</label>
                              <select name="" id="" class="form-control">
                                  <option value="0">-- Seleccione --</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <button type="submit" class="btn btn-primary">Consultar</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
	  </div>

	  <div class="row">
		<div class="col-md-12">
		  <div class="box box-solid color-palette-box">
			<div class="box-header bg-blue" >
			  <div>
				<h3 class="box-title">Nuevo recibo por honorario</h3>
			  </div>
			  <div class="box-tools pull-right">
				<button style="color:#fff;" type="button" class="btn btn-box-tool" data-widget="collapse">
				  <i class="fa fa-minus"></i>
				</button>
			  </div>
			</div>
			<div class="box-body" align="center">
                <form action="" class="form">
					<div class="col-md-6">
						<div class="form-group">
                            <label for="personal">Personal</label>
                            <input type="text" class="form-control" placeholder="Seleccione trabajador">
                        </div>
                        <div class="form-group">
                            <label for="personal">Tipo de honorario</label>
                            <input type="text" class="form-control" placeholder="Seleccione tipo">
                        </div>
					</div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_emision">Fecha de emisión</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="serie">Serie</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="numero">Número</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descripcion">Breve descripción</label>
                            <input type="text" placeholder="(Opcional)" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="total">Total por honorarios</label>
                                <input type="number" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="total">Aportes</label>
                                <input type="number" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="total">Comisiones</label>
                                <input type="number" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="total">Neto recibido</label>
                                <input type="number" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="btn btn-danger btn-block">Cancelar registro</a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-block">Registrar recibo por honorario</button>
                    </div>
                </form>
			</div>
		  </div>
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
