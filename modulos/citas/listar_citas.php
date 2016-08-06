<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<?php 
  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lista de citas| CLÍNICA CRISTO REDENTOR</title>
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
        Lista de citas
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
          Lista de citas
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Box seleccionar menú y submenu-->     


      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue">
          <div>
            <h3 class="box-title">Lista de citas</h3>
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="remove">
              <i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          <div class="row">
            <div class="col-md-12" align="center" style="display:true">
              <div class="control-group ">
                <label style="cursor: pointer">
                  <input checked name="rbListaCitas" id="rbListaCitasC" type="radio"  value="C" onchange="cargarTablaCitas();" style="cursor: pointer">
                  <span class="lbl">Consultorio</span>
                </label>
                <!-- Radio -->
                <label style="margin-left:10px;cursor: pointer; ">
                  <input name="rbListaCitas" id="rbListaCitasL" type="radio"  value="L" onchange="cargarTablaCitas();" style="cursor: pointer">
                  <span class="lbl">Laboratorio</span>
                </label>                
                <!-- Radio -->
              </div>
            </div>
          </div>
          <br>
          <div class="row">            
            <div class="col-md-2">
              <label class="form-label">Fecha</label>
              <div class="input-group">
                <input id="txtFechaCita" name="txtFechaCita" class="form-control date-picker input-sm" placeholder="dd-mm-aaaa" type="text" data-date-format="dd-mm-yyyy" value="<?php echo $fechaHoyDMA?>" onchange="cargarTablaCitas();">
                <span class="input-group-addon">
                  <i class="fa fa-calendar bigger-110"></i>
                </span>
              </div>
            </div>
            <div class="col-md-2">
              <label class="form-label">Estado</label>
              <select class="form-control input-sm" id="cboEstado" name="cboEstado" onchange="cargarTablaCitas();">
                <option value="T" selected>Todos</option>
                <option value="R" class="label-warning">Reservado</option>
                <option value="C" class="label-info">Confirmada</option>
                <option value="S" class="label-primary">En Sala</option>
                <option value="A" class="label-success">Atendido</option>
                <option value="X" class="label-danger">Anulado</option>
              </select>
            </div>
          </div>
          <!-- ROW -->
          <hr>
          <table id="tablaCitas" width="100%" class="table table-bordered table-hover tablaDatos">
            <thead>
              <tr>                
                <th>Paciente</th>                
                <th>Especialidad</th>
                <th>Servicio</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Médico</th>
                <th>Estado</th>
                <th>Pago</th>
                <th></th>
              </tr>
            </thead>
            <tbody class="cuerpoTabla" id="cuerpoTablaCitas">
              <!-- Aqui irán los elementos de la tabla -->        
            </tbody>
          </table>
          <hr>
          <div class="row">
            <div class="col-md-2">
              <button type="button" class="btn btn-block btn-primary btn-flat" onclick="abrirModal('#modalRegPersonal');">
                Triaje
                <i class="fa fa-stethoscope"></i>
              </button>
            </div>
            <div class="col-md-2">
              <button type="button" class="btn btn-block btn-primary btn-flat" onclick="abrirModal('#modalRegPersonal');">
                Atender cita
                <i class="fa fa-sign-in"></i>
              </button>
            </div>
          </div>
        </div>            
        <!-- /.box-body -->
      </div>
      <!-- Lista de citas - consultorio -->

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
  cargarTablaCitas();
  $('#tablaCitas tbody').on('click','tr',function(){seleccionSimple(this);}); 
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













<!-- <script src="../../plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="../../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>


  <script src="../../plugins/jQueryUI/jquery-ui.min.js"></script>
  <script src="../../plugins/daterangepicker/moment.min.js"></script>
  
  <script src="../../plugins/datepicker/bootstrap-datepicker.min.js"></script>


  <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
  <script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="../../dist/js/pages/dashboard.js"></script>
  <script src="../../dist/js/demo.js"></script>
  <script src="../../plugins/knob/jquery.knob.js"></script> -->