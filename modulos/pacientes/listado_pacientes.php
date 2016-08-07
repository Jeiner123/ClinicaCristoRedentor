<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title>Gestión de personal | CLÍNICA CRISTO REDENTOR</title>
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
        Pacientes
        <!-- <small>Lista - Registro - Actualización</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="listado_pacientes.php">Pacientes</a>
        </li>
        <li class="active">
          Listado de pacientes
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Listado de pacientes</h3>
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>        
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          <div class="row">
            <div class="col-md-2 col-md-offset-5 col-xs-6 col-xs-offset-3">
              <a href="nuevo_paciente.php" class="btn btn-block btn-primary btn-sm btn-flat" >
                Nuevo
              </a>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <table id="tablaPacientes" class="table table-bordered table-hover tablaDatos">
                <thead>
                  <tr>
                    <th style='text-align:center;'>Historia</th>
                    <th style='text-align:center;'>DNI</th>
                    <th>Nombres y apellidos</th>
                    <th style='text-align:center;'>Edad</th>
                    <th>Teléfono</th>
                    <th>Última visita</th>
                    <th style='text-align:center;'>Estado</th>
                    <th style='text-align:center;'></th>
                  </tr>
                </thead>
                <tbody class="cuerpoTabla" id="cuerpoTablaPacientes">
                  <!-- Aqui irán los elementos de la tabla -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- Lista de items -->
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
  cargarTablaPacientes();
  // cargarCboTipoPersonal();
  // cargarCboAreas();
  // cargarCboCargos();
  // // cargarCboEspecialidades();
  // cargarTablaPersonal();
  // abrirModal("#modalRegPersonal");
  $('#tablaPacientes tbody').on('click','tr',function(){seleccionSimple(this);});  
  
</script>
