<?php
// Validate id
if (isset($_GET['id']))
    $id = $_GET['id'];
else header('Location: gestion_modulos.php');
?>

<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html xmlns:v-on="http://www.w3.org/1999/xhtml">
<head>
  <title>Items | CLÍNICA CRISTO REDENTOR</title>
  <?php include '../general/header.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <?php include '../general/menu_principal.php';?>

<div class="wrapper">
  <?php include '../general/izquierda_menu.php';?>

    <?php
        $sql = "SELECT * FROM modules WHERE id=$id";
        $result_set = mysqli_query($con, $sql);
        $modules = mysqli_fetch_all($result_set, MYSQLI_ASSOC);
        if (count($modules) > 0)
            $module = $modules[0];
        else exit('No module selected.');
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<!-- Content Header -->
	<section class="content-header">
	  <h1>
		Administración
		<small>Gestionar items</small>
	  </h1>
	  <ol class="breadcrumb">
		<li>
            <a href="#"><i class="fa fa-dashboard"></i>Inicio</a>
        </li>
		<li class="active">Administración</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content" id="ItemController">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid color-palette-box">
                    <div class="box-header bg-blue">
                        <h3 class="box-title">Registro de items</h3>
                        <div class="box-tools pull-right">
                            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" align="center">
                        <p>Registre nuevos items para el módulo seleccionado: <strong><?= $module['nombre'] ?></strong>.</p>

                        <div class="alert alert-danger" v-if="!isValid">
                            <ul>
                                <li v-show="!validation.nombre">Ingrese un nombre para el item.</li>
                                <li v-show="!validation.folder">Nombre de archivo inválido.</li>
                            </ul>
                        </div>

                        <form action="#" v-on:submit.prevent="AddNewItem" method="POST">
                            <div class="form-group">
                                <label for="nombre">Nombre del item:</label>
                                <input v-model="newItem.nombre" type="text" id="nombre" name="nombre" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="folder">Archivo asociado <em>(dentro de /<?= $module['folder'] ?>/)</em>:</label>
                                <input v-model="newItem.file" type="text" id="file" name="file" class="form-control">
                            </div>

                            <div class="form-group">
                                <button :disabled="!isValid" class="btn btn-default" v-if="edit" v-on:click="EditItem(newItem.id)">Editar item</button>
                                <button :disabled="!isValid" class="btn btn-default" v-else>Añadir item</button>
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
                        <h3 class="box-title">Items</h3>
                        <div class="box-tools pull-right">
                            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" align="center">
                        <p>Modifique o desactive los items existentes.</p>
                        <table class="table hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Archivo</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in items">
                                <td>{{ item.id }}</td>
                                <td>{{ item.nombre }}</td>
                                <td>{{ item.file }}</td>
                                <td>
                                    <button v-show="item.active == 1" v-on:click="ShowItem(item)" class="btn btn-sm btn-primary">Editar</button>

                                    <button v-if="item.active == 1" v-on:click="UpdateStatus(0, $index)" class="btn btn-sm btn-danger">Desactivar item</button>

                                    <button v-else v-on:click="UpdateStatus(1, $index)" type="button" class="btn btn-sm btn-success">Activar item</button>
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

  <script src="../js/vue.js"></script>
  <script>
      var app_data = {
          newItem: {
              id: '',
              nombre: '',
              file: ''
          },
          items: {},
          success: false,
          edit: false
      };
      new Vue({
          el: '#ItemController',
          data: app_data,
          methods: {
              UpdateStatus: function (status, i) {
                  var item = this.items[i];
                  var params = {
                      status: status,
                      id: item.id
                  };
                  $.post('json/update_item_status.php', params, function (data) {
                      if (data.success)
                          item.active = status;
                  }, 'json');
              },
              ShowItem: function (item) {
                  this.edit = true;

                  this.newItem.id = item.id;
                  this.newItem.nombre = item.nombre;
                  this.newItem.file = item.file;
              },
              AddNewItem: function () {
                  // Item data in form
                  var item = this.newItem;

                  // Clear form input
                  this.newItem = { id: '', nombre: '', file: '' };
                  var self = this;

                  // Send post request
                  var params = {
                      nombre: item.nombre,
                      file: item.file
                  };
                  $.post('json/store_item.php?module_id=<?= $module['id'] ?>', params, function (data) {
                      if (data.success) {
                          // Show success message
                          self.success = true;
                          setTimeout(function () {
                              self.success = false;
                          }, 5000);

                          self.fetchItems();
                      }
                  }, 'json');
              },
              EditItem: function (id) {
                  // Item data in form
                  var item = this.newItem;

                  // Clear form input
                  this.newItem = { id: '', nombre: '', file: ''};
                  var self = this;

                  // Send post request
                  var params = {
                      id: item.id,
                      nombre: item.nombre,
                      file: item.file
                  };
                  $.post('json/update_item.php', params, function (data) {
                      if (data.success) {
                          // Show success message
                          self.success = true;
                          setTimeout(function () {
                              self.success = false;
                          }, 5000);

                          self.fetchItems();
                          self.edit = false;
                      }
                  }, 'json');
              },
              fetchItems: function () {
                  var self = this;
                  $.getJSON('json/items.php?id='+<?= $module['id'] ?>, function (data) {
                      self.items = data.items;
                  });
              }
          },
          computed: {
              validation: function () {
                  return {
                      nombre: !!this.newItem.nombre.trim(),
                      folder: !!this.newItem.file.trim()
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
              this.fetchItems()
          }
      });
      activarMenuLateral('asignar_permisos.php');
  </script>
</body>
</html>
