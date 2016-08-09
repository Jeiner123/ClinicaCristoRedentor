<?php
include '../general/validar_sesion.php';
include '../general/variables.php';
if (isset($_GET['usuario']))
    $usuario = $_GET['usuario'];
else
    header('Location: ./asignar_permisos.php');
?>
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
		Administración
		<small>Asignar permisos</small>
	  </h1>
	  <ol class="breadcrumb">
		<li>
            <a href="#"><i class="fa fa-dashboard"></i>Inicio</a>
        </li>
		<li class="active">Administración</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">

	  <div class="row">
          <div class="col-md-12">
              <div class="box box-solid color-palette-box">
                  <div class="box-header bg-blue">
                      <h3 class="box-title">Instrucciones</h3>
                      <div class="box-tools pull-right">
                          <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
                              <i class="fa fa-minus"></i>
                          </button>
                      </div>
                  </div>
                  <div class="box-body" align="center">
                      <p>A continuación se muestra un listado de los módulos existentes en el sistema.</p>
                      <p>Cada módulo comprende una serie de ítems a las que un usuario puede acceder.</p>
                      <p>Un check indica que el usuario tiene permisos para visualizar la página correspondiente.</p>
                  </div>
              </div>
          </div>
	  </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid color-palette-box">
                    <div class="box-header bg-blue">
                        <h3 class="box-title">Modificar permisos</h3>
                        <div class="box-tools pull-right">
                            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" align="center">
                        <div class="form-group">
                            <label for="usuario">Modificando permisos del usuario:</label>
                            <input type="text" name="usuario" value="<?= $usuario ?>" readonly>
                        </div>

                        <div class="row">
                        <?php
                        require '../bd/bd_conexion.php';

                        $query = 'SELECT id, nombre FROM modules';
                        $result_set = mysqli_query($con, $query);
                        $modules = $result_set->fetch_all();

                        foreach ($modules as $module):
                            $query = 'SELECT id, nombre FROM items WHERE module_id = ' . $module[0];
                            $result_set_items = mysqli_query($con, $query);
                            $items = $result_set_items->fetch_all();
                            ?>
                            <div class="col-md-4">
                                <h2><?= $module[1] ?></h2>
                                <div class="row">
                                    <ul>
                                        <?php foreach ($items as $item): ?>
                                            <li>
                                                <input type="checkbox" value="<?= $item[0] ?>"> <?= $item[1] ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
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

  <script src="../js/vue.min.js"></script>
  <script>
      var app_data = {
          users: {}
      };
      new Vue({
          el: '#users_table',
          data: app_data
      });
      $.getJSON('json/users.php', function (data) {
          app_data.users = data.users;
      });
  </script>
</body>
</html>
