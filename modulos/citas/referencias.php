<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>Lista de referencias médicas| CLÍNICA CRISTO REDENTOR</title>
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
            <h3 class="box-title">Listado de referencias</h3>
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
              <label for="cboMeses">Mes</label>
              <select class="form-control input-sm" id="cboMeses" name="cboMeses" onchange="cargarTablaReferencias();">
                <?php 
                  foreach ($meses as $id => $value) {
                    echo "<option ";
                    if($id == date('m')){
                      echo "selected ";
                    }
                    echo "value='".$id."'>".$value."</option>";
                  }
                ?>
              </select>
            </div>
            <div class="col-md-4">
              <label for="cboMedicos">Médico</label>
              <select class="form-control input-sm" id="cboMedicos" name="cboMedicos" onchange="cargarTablaReferencias();">
                <!--  -->
              </select>
            </div>
            <div class="col-md-4">
              <label for="cboEspecialidades">Especialidad</label>
              <select class="form-control input-sm" id="cboEspecialidades" name="cboEspecialidades" onchange="cargarTablaReferencias();">
                <!--  -->
              </select>
            </div>
            
            <!-- <div class="col-md-2">
              <label for="cboEstadoPago">Estado pago</label>
              <select class="form-control input-sm" id="cboEstadoPago" name="cboEstadoPago" onchange="cargarTablaReferencias();">
                <option value="T" selected>Todos</option>
                <option value="PEN" >Pendiente</option>
                <option value="PAR" >Parcial</option>
                <option value="PAG" >Pagada</option>
              </select>
            </div> -->
            
          </div>
          <!-- ROW -->
          <hr>
          <table id="tablaReferencias" width="100%" class="table table-bordered table-hover tablaDatos">
            <thead>
              <tr> 
                <th>P.</th>
                <th>Médico</th>
                <th>Servicio</th>
                <th>Especialidad</th>
                <th>Fecha</th>
                <th>Cita</th>
                <th>Pago</th>                
              </tr>
            </thead>
            <tbody class="cuerpoTabla" id="cuerpoTablaReferencias">
              <!-- Aqui irán los elementos de la tabla -->        
            </tbody>
          </table>
          <hr>
          <div class="row">
            <div class="col-md-2">
              <label for="txtNumeroFilas" class="text-red"><strong>N° de referencias</strong></label>
              <input class="form-control input-sm" id="txtNumeroFilas" name="txtNuMroFilas" disabled>
            </div>
          </div>
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
  cargarCboPersonalSalud();
  cargarTablaReferencias();
  cargarCboMedicos('#cboMedicos',0);
  cargarCboEspecialidades('#cboEspecialidades',-1);

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
