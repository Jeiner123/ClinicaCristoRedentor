<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title> Listado de ventas | CLÍNICA CRISTO REDENTOR</title>
  <?php include '../general/header.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <input type='hidden' value='menu_ventas' id='menuPrincipal'>
  <input type='hidden' value='m_listado_ventas' id='menuIzquierda'>
  <?php include '../general/menu_principal.php';?>
<div class="wrapper">
  <?php include '../general/izquierda_menu.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ventas
        <!-- <small>Lista - Registro - Actualización</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="listado_ventas.php">Ventas</a>
        </li>
        <li class="active">
          Listado de ventas
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Listado de ventas</h3>
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>        
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          <div class="row">
            <div class="col-md-6 col-md-offset-3 col-xs-8 col-xs-offset-2">
              <a href="javascript:;" class="btn btn-block btn-primary btn-sm btn-flat" >
                Exportar a excel
              </a>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <table id="tablaClientes" class="table table-bordered table-hover tablaDatos">
                <thead>
                  <tr>
                    <th style='text-align:center;'>Documento</th>
                    <th style='text-align:center;'>N° documento</th>
                    <th>Cliente</th>
                    <th style='text-align:center;'>Contacto</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th style='text-align:center;'>Estado</th>
                    <th style='text-align:center;'></th>
                  </tr>
                </thead>
                <tbody class="cuerpoTabla" id="cuerpoTablaClientes">
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
