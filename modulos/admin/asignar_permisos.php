<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html xmlns:v-on="http://www.w3.org/1999/xhtml">
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
                      <h3 class="box-title">Permisos de usuarios</h3>
                      <div class="box-tools pull-right">
                          <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
                              <i class="fa fa-minus"></i>
                          </button>
                      </div>
                  </div>
                  <div class="box-body" align="center">
                      <p>A continuación se muestra un listado de los usuarios registrados en el sistema.</p>
                      <p>Usted puede seleccionar uno de ellos y ver los permisos que presenta actualmente.</p>
                      <p>Así mismo podrá asignar nuevos permisos o removerlos.</p>

                      <table class="table" id="users_table">
                          <thead>
                          <tr>
                              <th>Nombre de usuario</th>
                              <th>DNI</th>
                              <th>Estado</th>
                              <th>Opciones</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr v-for="user in users">
                              <td>{{ user.usuario }}</td>
                              <td>{{ user.DNI }}</td>
                              <td>{{ user.estado?'Activo':'Inactivo' }}</td>
                              <td>
                                  <a href="./editar_permisos.php?usuario={{ user.usuario }}" class="btn btn-primary">Editar permisos</a>
                                  <button v-if="user.estado == 1" v-on:click="postEstado(0, $index)" type="button" class="btn btn-danger">Desactivar usuario</button>
                                  <button v-else v-on:click="postEstado(1, $index)" type="button" class="btn btn-success">Activar usuario</button>
                              </td>
                          </tr>
                          </tbody>
                      </table>
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
          data: app_data,
          methods: {
              postEstado: function (estado, i) {
                  var user = this.users[i];
                  var params = '?estado='+estado+'&usuario='+user.usuario;
                  $.getJSON('json/cambiar_estado.php'+params, function (data) {
                      if (data.success)
                          user.estado = estado;
                  });
              }
          }
      });
      $.getJSON('json/users.php', function (data) {
          app_data.users = data.users;
      });
  </script>
</body>
</html>
