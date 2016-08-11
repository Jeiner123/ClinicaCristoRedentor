<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title> Gestión de pagos | CLÍNICA CRISTO REDENTOR</title>
  <?php include '../general/header.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <input type='hidden' value='menu_facturacion' id='menuPrincipal'>
  <input type='hidden' value='m_listado_pagos' id='menuIzquierda'>
  <?php include '../general/menu_principal.php';?>
<div class="wrapper">
  <?php include '../general/izquierda_menu.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pagos
        <!-- <small>Lista - Registro - Actualización</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="../facturacion/pendiente_facturar.php">Facturación</a>
        </li>
        <li class="active">
          Listado de pagos
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Listado de pagos</h3>
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>        
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label class="form-label">Fecha</label>
                <div class="input-group">
                  <input id="txtFechaCita" name="txtFechaCita" class="form-control date-picker input-sm" placeholder="dd-mm-aaaa" type="text" data-date-format="dd-mm-yyyy" value="<?php echo $fechaHoyDMA?>" onchange="cargarTablaPagos();">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <table id="tablaPagos" class="table table-bordered table-hover tablaDatos">
                <thead>
                  <tr>
                    <th>Ped.</th>
                    <th style='text-align:center;'>Fecha</th>
                    <th>Paciente</th>
                    <th>Telefono</th>
                    <th>Comprobante</th>
                    <th>Número Comprob.</th>
                    <th>Importe</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody class="cuerpoTabla" id="cuerpoTablaPagos">
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
  cargarTablaPagos();
  // cargarCboTipoPersonal();
  // cargarCboAreas();
  // cargarCboCargos();
  // // cargarCboEspecialidades();
  // cargarTablaPersonal();
  // abrirModal("#modalRegPersonal");
  $('#tablaPagos tbody').on('click','tr',function(){seleccionSimple(this);});  
  $('.date-picker').datepicker({
    autoclose: true,
    language: 'es',
    todayHighlight: true
  }); 
</script>
