<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title>Facturas | CLÍNICA CRISTO REDENTOR</title>
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
        Requerimientos de área
        <!-- <small>Lista - Registro - Actualización</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="listado_pacientes.php">Requerimientos</a>
        </li>
        <li class="active">
          Listar requerimientos
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Listado de requerimientos</h3>
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>        
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          <div class="row">
            <div class="col-md-1"><label class="control-label">Estado</label></div>
            <div class="col-md-2">
              <select class="form-control input-sm" id="cboEstado" name="cboEstado" onchange="cargarFacturasFiltro();">
                <option value="0">Todas</option>
                <option value="D">Pendientes</option>
                <option value="P">Aprobadas</option>
                <option value="V">Rechazadas</option>
              </select>
            </div>
            
            <div class="col-md-1"><label class="control-label">Área</label></div>
          <div class="col-md-4">
              <select class="form-control input-sm" name="cboArea" id="cboArea" onchange="cargarFacturasFiltro();">
              </select>
            </div>
          </div><br>
          <div class="row">
            <div class="col-md-12">
              <table id="tablaRequerimiento" class="table table-bordered table-hover tablaDatos">
                <thead>
                  <tr>
                    <th>Nº</th>
                    <th style="text-align:center">Fecha</th>
                    <th>Área</th>
                    <th style="text-align:center">Solicita</th>
                    <th>Requerimiento</th>
                    <th style="text-align:center">Stock</th>
                    <th style="text-align:center">Estado</th>
                    <th style="text-align:center">Opciones</th>
                  </tr>
                </thead>
                <tbody class="cuerpoTabla" id="cuerpoTablaRequerimiento">
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
<style type="text/css">
  .datepicker{z-index:1151 !important;}
</style>
<script type="text/javascript">
  cargarCboAreas();
  cargarTablaRequerimiento(); 
  $('#tablaRequerimiento tbody').on('click','tr',function(){seleccionSimple(this);});  
  
</script>
