<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html xmlns:v-on="http://www.w3.org/1999/xhtml">
<head>
  <title>Módulos | CLÍNICA CRISTO REDENTOR</title>
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
		<small>Gestionar módulos</small>
	  </h1>
	  <ol class="breadcrumb">
		<li>
            <a href="#"><i class="fa fa-dashboard"></i>Inicio</a>
        </li>
		<li class="active">Administración</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content" id="ModuleController">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid color-palette-box">
                    <div class="box-header bg-blue">
                        <h3 class="box-title">Registro de módulos</h3>
                        <div class="box-tools pull-right">
                            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" align="center">
                        <p>Registre nuevos módulos.</p>

                        <div class="alert alert-danger" v-if="!isValid">
                            <ul>
                                <li v-show="!validation.nombre">Ingrese un nombre para el módulo.</li>
                                <li v-show="!validation.folder">Nombre de carpeta inválido.</li>
                            </ul>
                        </div>

                        <form action="#" v-on:submit.prevent="AddNewModule" method="POST">
                            <div class="form-group">
                                <label for="nombre">Nombre del módulo:</label>
                                <input v-model="newModule.nombre" type="text" id="nombre" name="nombre" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="folder">Carpeta asociada <em>(dentro de /modulos/)</em>:</label>
                                <input v-model="newModule.folder" type="text" id="folder" name="folder" class="form-control">
                            </div>

                            <div class="form-group">
                                <button :disabled="!isValid" class="btn btn-default" v-if="edit" v-on:click="EditModule(newModule.id)">Editar módulo</button>
                                <button :disabled="!isValid" class="btn btn-default" v-else>Añadir módulo</button>
                            </div>
                        </form>

                        <div class="alert alert-success" transition="success" v-if="success">Operación realizada con éxito.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid color-palette-box">
                    <div class="box-header bg-blue">
                        <h3 class="box-title">Módulos</h3>
                        <div class="box-tools pull-right">
                            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" align="center">
                        <p>Modifique o desactive los módulos existentes.</p>
                        <table class="table hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Folder</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="module in modules">
                                <td>{{ module.id }}</td>
                                <td>{{ module.nombre }}</td>
                                <td>{{ module.folder }}</td>
                                <td>
                                    <button v-show="module.active == 1" v-on:click="ShowModule(module)" class="btn btn-sm btn-primary">Editar</button>

                                    <button v-if="module.active == 1" v-on:click="UpdateStatus(0, $index)" class="btn btn-sm btn-danger">Desactivar módulo</button>

                                    <button v-else v-on:click="UpdateStatus(1, $index)" type="button" class="btn btn-sm btn-success">Activar módulo</button>

                                    <a href="./gestion_items.php?id={{ module.id }}" class="btn btn-sm btn-info">Gestionar items</a>
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
          newModule: {
              id: '',
              nombre: '',
              folder: ''
          },
          modules: {},
          success: false,
          edit: false
      };
      new Vue({
          el: '#ModuleController',
          data: app_data,
          methods: {
              UpdateStatus: function (status, i) {
                  var module = this.modules[i];
                  var params = {
                      status: status,
                      id: module.id
                  };
                  $.post('json/update_module_status.php', params, function (data) {
                      if (data.success)
                          module.active = status;
                  }, 'json');
              },
              ShowModule: function (module) {
                  this.edit = true;

                  this.newModule.id = module.id;
                  this.newModule.nombre = module.nombre;
                  this.newModule.folder = module.folder;
              },
              AddNewModule: function () {
                  // Module data in form
                  var module = this.newModule;

                  // Clear form input
                  this.newModule = { id: '', nombre: '', folder: '' };
                  var self = this;

                  // Send post request
                  var params = {
                      nombre: module.nombre,
                      folder: module.folder
                  };
                  $.post('json/store_module.php', params, function (data) {
                      if (data.success) {
                          // Show success message
                          self.success = true;
                          setTimeout(function () {
                              self.success = false;
                          }, 5000);

                          self.fetchModules();
                      }
                  }, 'json');
              },
              EditModule: function (id) {
                  // Module data in form
                  var module = this.newModule;

                  // Clear form input
                  this.newModule = { id: '', nombre: '', folder: ''};
                  var self = this;

                  // Send post request
                  var params = {
                      id: module.id,
                      nombre: module.nombre,
                      folder: module.folder
                  };
                  $.post('json/update_module.php', params, function (data) {
                      if (data.success) {
                          // Show success message
                          self.success = true;
                          setTimeout(function () {
                              self.success = false;
                          }, 5000);

                          self.fetchModules();
                          self.edit = false;
                      }
                  }, 'json');
              },
              fetchModules: function () {
                  var self = this;
                  $.getJSON('json/modules.php', function (data) {
                      self.modules = data.modules;
                  });
              }
          },
          computed: {
              validation: function () {
                  return {
                      nombre: !!this.newModule.nombre.trim(),
                      folder: !!this.newModule.folder.trim()
                  }
              },

              isValid: function () {
                  var validation = this.validation;
                  return Object.keys(validation).every(function (key) {
                      return validation[key];
                  });
              }
          },
          ready: function () {
              this.fetchModules()
          }
      });
      activarMenuLateral('asignar_permisos.php');
  </script>
</body>
</html>
