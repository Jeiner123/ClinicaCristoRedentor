<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
	<title> Lista de referencias médicas| CLÍNICA CRISTO REDENTOR</title>
	<?php include '../general/header.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <input type='hidden' value='menu_citas' id='menuPrincipal'>
  <input type='hidden' value='m_cita_referencias' id='menuIzquierda'>
	<?php include '../general/menu_principal.php';?>

<div class="wrapper">
  <?php include '../general/izquierda_menu.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Listado de referencias 
        <small>Consultorio - Laboratorio</small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../gestion"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="../../gestion">Gestión de citas</a>
        </li>
        <li class="active">
          Listado de referencias
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Box seleccionar menú y submenu-->     


      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue">
          <div>
            <h3 class="box-title">Listado de citas</h3>
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
              <label for="txtFechaCita">Fecha</label>
              <div class="input-group">
                <input id="txtFechaCita" name="txtFechaCita" class="form-control date-picker input-sm" placeholder="dd-mm-aaaa" type="text" data-date-format="dd-mm-yyyy" value="<?php echo $fechaHoyDMA?>" onchange="cargarTablaCitas();">
                <span class="input-group-addon">
                  <i class="fa fa-calendar bigger-110"></i>
                </span>
              </div>
            </div>
            <div class="col-md-2">
              <label for="cboEstadoPago">Estado pago</label>
              <select class="form-control input-sm" id="cboEstadoPago" name="cboEstadoPago" onchange="cargarTablaCitas();">
                <option value="T" selected>Todos</option>
                <option value="R" >Pendiente</option>
                <option value="C" >Parcial</option>
                <option value="S" >Pagada</option>
              </select>
            </div>
          </div>
          <!-- ROW -->
          <hr>
          <table id="tablaReferencias" width="100%" class="table table-bordered table-hover tablaDatos">
            <thead>
              <tr>                
                <th>Médico</th>
                <th>Servicio</th>
                <th>Especialidad</th>
                <th>Fecha</th>
                <th>Estado cita</th>
                <th>Estado pago</th>
                <th></th>
              </tr>
            </thead>
            <tbody class="cuerpoTabla" id="cuerpoTablaReferencias">
              <!-- Aqui irán los elementos de la tabla -->        
            </tbody>
          </table>
        </div>            
        <!-- /.box-body -->
      </div>
      <!-- Lista de referencias -->

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
<script src="../../plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">  
  cargarTablaReferencias();
  $('#tablaReferencias tbody').on('click','tr',function(){seleccionSimple(this);}); 
  //iCheck for checkbox and radio inputs
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({    
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
  });
  $('.date-picker').datepicker({
    autoclose: true,
    language: 'es',
    todayHighlight: true
  }); 
</script>
