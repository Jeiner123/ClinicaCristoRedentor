<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title>Permisos | CLÍNICA CRISTO REDENTOR</title>
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
		Inicio
		<small>Bienvenido</small>
	  </h1>
	  <ol class="breadcrumb">
		<li class="active">
            <a href="#"><i class="fa fa-dashboard"></i>Inicio</a>
        </li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid color-palette-box">
                    <div class="box-header bg-blue">
                        <h3 class="box-title">Sistema - Clínica Cristo Redentor</h3>
                        <div class="box-tools pull-right">
                            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" align="center">
                        <p>Seleccione una opción del menú de la izquierda para acceder a cada sección.</p>
                        <p>Si no observa ninguna opción disponible, debe solicitar los permisos al administrador.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid color-palette-box">
                    <div class="box-header bg-blue">
                        <h3 class="box-title">Datos de usuario</h3>
                        <div class="box-tools pull-right">
                            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" align="center">
                        <p>A continuación se muestran sus datos de usuario.</p>
                        <p>Si desea, puede modificar sus datos y presionar el botón correspondiente.</p>

                        <form action="">
                            <div class="form-group">
                                <label for="usuario">Nombre de usuario</label>
                                <input id="usuario" type="text" value="<?= $usuario ?>" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input name="nombres" type="text" value="<?= $nombres ?>" class="form-control">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="ap_paterno">Apellido paterno</label>
                                    <input name="ap_paterno" type="text" value="<?= $ap_paterno ?>" class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="ap_materno">Apellido materno</label>
                                    <input name="ap_materno" type="text" value="<?= $ap_materno ?>" class="form-control">
                                </div>
                            </div>

                            <div class="form-group pull-right">
                                <button type="button" class="btn btn-primary">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

	</section>

  </div>
  <!-- /.content-wrapper -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
  <?php include '../general/pie_pagina.php';?>

</body>
</html>
