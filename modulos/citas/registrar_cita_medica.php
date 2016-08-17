<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title>Gestión de citas | CLÍNICA CRISTO REDENTOR</title>
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
        Registrar nueva cita
        <small>Consultorio - Laboratorio</small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../gestion"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="../../gestion">Citas</a>
        </li>
        <li class="active">
          Registrar nueva cita
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <form method="post"  id="formRegistrarCita" enctype="multipart/form-data">
        <div class="box box-solid color-palette-box">
          <div class="box-header bg-blue" >
            <div>
              <h3 class="box-title">Registrar nueva cita</h3>
            </div>
            <div class="box-tools pull-right">
              <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="box-body">
            <form method="post" id="formCitaConsultorio" enctype="multipart/form-data">
              <input id="txtFlag" name="txtFlag" class="form-control" value="N" type="hidden">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="cboPacientes">Paciente</label><label style="color:red">&nbsp;*</label>                    
                    <select onchange="seleccionarCboPaciente(this)" class="chosen-select form-control input-sm" id="cboPacientes" name="cboPacientes" >
                      <!-- Lista de diagnósticos -->
                    </select> 
                  </div>
                  <div class="form-group">
                    <label for="cboServicios">Servicio</label><label style="color:red">&nbsp;*</label>
                    
                    <select class="chosen-select form-control" id="cboServicios" name="cboServicios"  onchange="seleccionarCboServicios(this.value);">
                      <!-- Lista de diagnósticos -->
                    </select> 
                  </div>                  
                  <div class="form-group">
                    <label for="cboMedicos">Médico</label><label style="color:red">&nbsp;*</label>
                    <select onchange="seleccionarCboMedico(this);" class="chosen-select form-control input-sm" id="cboMedicos" name="cboMedicos">
                      <!-- Lista de diagnósticos -->
                    </select> 
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="txtFechaCita">Día</label><label style="color:red">&nbsp;*</label>
                        <div class="input-group">
                          <input id="txtFechaCita" name="txtFechaCita"class="form-control date-picker" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);">
                          <span class="input-group-addon">
                            <i class="fa fa-calendar bigger-110"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">                      
                      <div class="form-group">
                        <label for="txtHoraCita">Hora</label><label style="color:red">&nbsp;*</label>                        
                        <div class="input-group">
                          <input id="txtHoraCita" name="txtHoraCita" value="" type="text" class="form-control timepicker">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group ">
                    <div for="txtMotivo">
                      <label for="txtMotivo">Motivo/observaciones</label>
                      <textarea class="form-control" id="txtMotivo" name="txtMotivo" rows="2"></textarea>
                    </div>
                  </div>
                </div>
                <!-- COL MD 6 -->
                <div class="col-sm-6">
                  <div class="form-group" align="left">
                    <label for="cboMedicosRef">Médico Referencia</label>
                    <span class="text-blue" title="descripción"><i class="fa fa-question-circle bigger-110" onclick="$('#helpMR').show('slow');" onmouseout="$('#helpMR').hide('slow');" style="cursor:pointer"></i></span>
                    <p id="helpMR" class="help-block" style="display:none;">Si algún médico sugirió realizarse esta cita.</p>
                    <select onchange="seleccionarCboMedico(this);" class="chosen-select form-control input-sm" id="cboMedicosRef" name="cboMedicosRef">
                      <!-- Lista de diagnósticos -->
                    </select> 
                  </div>
                  <div class="form-group">
                    <label for="cboEspecialidad">Especialidad</label>
                    <select class="form-control input-sm" id="cboEspecialidad" name="cboEspecialidad" onchange="cargarListaPersonalSalud();">
                      <option value="0" selected> -- Especialidad -- </option>
                    </select> 
                  </div>
                  <div class="form-group">
                    <label for="cboTipoServicio">Tipo de servicio</label>
                    <select class="form-control input-sm" id="cboTipoServicio" name="cboTipoServicio">
                      <option value="0" selected> -- Tipo de servicio -- </option>
                    </select> 
                  </div>
                  <div class="form-group">
                    <label for="txtHoraCita">Vía</label>
                    <select class="form-control " id="cboVia" name="cboVia">
                      <option value="P" selected>Personal</option>
                      <option value="T">Teléfono</option>
                      <option value="W">Web</option>
                      <option value="F">Facebook</option>
                    </select> 
                  </div>                  
                </div>                  
              </div>              
            </form>
            <!-- /.form -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer" align="ceter">
            <div class="row">
              <div class="col-sm-4 col-sm-offset-2">
                <input  onClick="guardarCita(this.form);" id="btnGuardarCita" value="Reservar" type="button" class="btn btn-success  btn-block" />
              </div>
              <div class="col-sm-4">
                <a class="btn btn-primary  btn-block" onClick="limpiarForm(this.form);bloqueoTotalForm(this.form,false);">Nuevo</a>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- Formulario registrar nueva cita médica -->
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
  cargarCboPacientes();
  cargarCboMedicos('#cboMedicosRef',0);
  cargarCboMedicos('#cboMedicos',0);
  cargarCboServicios('#cboServicios',0,0);  
  cargarCboTipoServicio();
  cargarCboEspecialidades2("#cboEspecialidad",-1);
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
    $('.date-picker').datepicker({
      autoclose: true,
      todayHighlight: true
    })
    //show datepicker when clicking on the icon
    .next().on(ace.click_event, function(){
      $(this).prev().focus();
    });
    
</script>

