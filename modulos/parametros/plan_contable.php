<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title>Plan contable | CLÍNICA CRISTO REDENTOR</title>
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
        Plan contable
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="listado_pacientes.php">Parámetros</a>
        </li>
        <li class="active">
          Plan contable
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Listado de cuentas</h3>
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>        
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          
          <div class="row">
            <div class="col-md-12">
              <table id="tablaPlanContable" class="table table-bordered table-hover tablaDatos">
                <thead>
                  <tr>
                    <th>Cuenta</th>
                    <th>Descripcion</th>
                    <th style="text-align:center">Tipo</th>
                    <th style="text-align:center">Estado</th>
                    <th style="text-align:center">Opciones</th>
                  </tr>
                </thead>
                <tbody class="cuerpoTabla" id="cuerpoTablaPlanContable">
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
  cargarTablaPlanContable();
  $('#tablaPlanContable tbody').on('click','tr',function(){seleccionSimple(this);});  
  
</script>
