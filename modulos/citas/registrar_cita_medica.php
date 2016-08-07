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
              </div>

              <div class="col-sm-5">
                <div class="form-group">
                  <label class="control-label">Paciente</label>                    
                  <select onchange="seleccionarCboPaciente(this)" class="chosen-select form-control input-sm" id="cboPacientes" name="cboPacientes" >
                    <!-- Lista de diagnósticos -->
                  </select> 
                </div>
              </div>
              <!-- COL- Paciente -->
              <div class="col-md-2" hidden>
                <div class="input-group">
                  <input type="text" id="txtPacienteID" name="txtPacienteID"class="form-control" placeholder="Nro Hist." readonly="true">                     
                </div>
              </div>
              <!-- COL- PAcienteID -->
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="cboEspecialidad">Especialidad</label>
                  <select class="form-control input-sm" id="cboEspecialidad" name="cboEspecialidad" onchange="cargarListaPersonalSalud();">
                    <option value="0" selected> -- Especialidad -- </option>
                  </select> 
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="cboTipoServicio">Tipo de servicio</label>
                  <select class="form-control input-sm" id="cboTipoServicio" name="cboTipoServicio">
                    <option value="0" selected> -- Tipo de servicio -- </option>
                  </select> 
                </div>
              </div>
              <div class="col-sm-5">                 
                <div class="form-group">
                  <label for="cboServicios">Servicio</label>
                  <select class="chosen-select form-control" id="cboServicios" name="cboServicios" >
                    <!-- Lista de diagnósticos -->
                  </select> 
                </div>
              </div>
              <div class="col-md-2" hidden>
                <input type="text" id="txtServicioID" name="txtServicioID" readonly="true" class="form-control" placeholder="ID servicio">
              </div>
              <div class="col-sm-5">
                <div class="form-group">
                  <label class="control-label">Médico</label>                  
                  <select onchange="seleccionarCboMedico(this);" class="chosen-select form-control input-sm" id="cboMedicos" name="cboMedicos">
                    <!-- Lista de diagnósticos -->
                  </select> 
                </div>
              </div>
              <!-- COL Medico referencia -->
              <div class="col-md-2" hidden>
                 <input type="text" id="txtCodigoMedicoRef" name="txtCodigoMedicoRef"class="form-control" placeholder="Cod. Med. Ref" readonly="true">
              </div>
              <div class="col-sm-5">
                <div class="form-group">
                  <label class="control-label">Médico Referencia</label>                  
                  <select onchange="seleccionarCboMedico(this);" class="chosen-select form-control input-sm" id="cboMedicosRef" name="cboMedicosRef" data-placeholder="-- Médico --">
                    <!-- Lista de diagnósticos -->
                  </select> 
                </div>
              </div>
              <!-- COL Medico -->
              <div class="col-md-2" hidden>
                <div class="input-group">
                  <label>Medico</label>
                  <input type="text" id="txtMedicoCodigo" name="txtMedicoCodigo"class="form-control" placeholder="Cod. Médico" readonly="true"> 
                  <div class="input-group-btn">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="txtFechaCita">Día</label>
                  <div class="input-group">
                    <input id="txtFechaCita" name="txtFechaCita"class="form-control date-picker" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label class="txtHoraCita">Hora</label>
                  <div class="input-group">
                    <input id="txtHoraCita" name="txtHoraCita" value="" type="text" class="form-control timepicker">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div for="cboVia">
                  <label for="txtHoraCita">Vía</label>
                  <select class="form-control " id="cboVia" name="cboVia">
                    <option value="P" selected>Personal</option>
                    <option value="T">Teléfono</option>
                    <option value="W">Web</option>
                    <option value="F">Facebook</option>
                  </select> 
                </div>
              </div>
              <div class="col-md-3">
                <div for="cboVia">
                  <label for="txtMotivo">Motivo</label>
                  <textarea class="form-control" id="txtMotivo" name="txtMotivo" rows="2"></textarea>
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
  cargarCboEspecialidades();

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

