<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title> Gestión de citas | CLÍNICA CRISTO REDENTOR</title>
  <?php include '../general/header.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <input type='hidden' value='gestion' id='menuPrincipal'>
  <input type='hidden' value='m_registrar_cita' id='menuIzquierda'>
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
      <form method="post" class="form-horizontal" id="formRegistrarCita" enctype="multipart/form-data">
        <div class="box box-solid color-palette-box">
          <div class="box-header bg-blue" >
            <div>
              <h3 class="box-title">Registrar nueva cita</h3>
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
          <div class="box-body">
            <form method="post" class="form-horizontal" id="formEspecialidad" enctype="multipart/form-data">
              <input id="txtFlag" name="txtFlag" class="form-control" value="N" type="hidden">
              <div class="form-group">
                <div class="col-md-2" align="center">
                  <label class="control-label">Paciente</label>
                </div>
                <div class="col-md-5">
                  <div class="input-group">
                    <div class="input-group-btn">
                      <button onclick="abrirModal('#modalListaPacientes');" type="button"class="btn btn-secundary" title="Buscar paciente">
                        <strong>...</strong>
                      </button>
                    </div>
                    <input onclick="abrirModal('#modalListaPacientes');" id="txtNombresPaciente" name="txtNombresPaciente"class="form-control" placeholder="NOMBRES Y APELLIDOS - PACIENTE" readonly="true">
                  </div>
                </div>
                <div class="col-md-2">
                   <input type="text" id="txtDNI" name="txtDNI"class="form-control" placeholder="DNI" readonly="true">
                </div>
                <div class="col-md-2">
                  <div class="input-group">
                    <input type="text" id="txtPacienteID" name="txtPacienteID"class="form-control" placeholder="Nro Hist." readonly="true"> 
                    <div class="input-group-btn">
                      <button onclick="verHistoriaCitas();"type="button"class="btn btn-secundary" title="Ver histórico de citas">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- PACIENTE -->
              <div class="form-group">
                <div class="col-md-2" align="center">
                  <label class="control-label">Servicio</label>
                </div>
                <div class="col-md-3  ">
                  <select class="form-control " id="cboEspecialidad" name="cboEspecialidad" onchange="cargarListaPersonalSalud();">
                    <option value="0" selected> -- Especialidad -- </option>
                  </select> 
                </div>
                <div class="col-md-3">
                  <select class="form-control " id="cboTipoServicio" name="cboTipoServicio">
                    <option value="0" selected> -- Tipo de servicio -- </option>
                  </select> 
                </div>
              </div>
              <!-- SERVICIO -->              
              <div class="form-group">
                <div class="col-md-7 col-md-offset-2">
                  <div class="input-group">
                    <div class="input-group-btn">
                      <button onclick="abrirModal('#modalListaServicios');" title="Seleccionar servicio" type="button"class="btn btn-secundary" >
                        <strong>...</strong>
                      </button>
                    </div>
                    <input onclick="abrirModal('#modalListaServicios');" class="form-control" placeholder="SERVICIO" readonly="true" id="txtServicio" name="txtServicio">
                  </div>
                </div>
                <div class="col-md-2">
                  <input type="text" id="txtServicioID" name="txtServicioID" readonly="true" class="form-control" placeholder="ID servicio">
                </div>
              </div>
              <!-- SERVICIO -->
              <div class="form-group">
                <div class="col-md-2" align="center">
                  <label class="control-label">Médico Referencia</label>
                </div>
                <div class="col-md-5">
                  <div class="input-group">
                    <div class="input-group-btn">
                      <button onclick="abrirModal('#modalListaPersonalSaludRef');" type="button"class="btn btn-secundary" title="Buscar paciente">
                        <strong>...</strong>
                      </button>
                    </div>
                    <input onclick="abrirModal('#modalListaPersonalSaludRef');" id="txtNombresMedicoRef" name="txtNombresMedicoRef"class="form-control" placeholder="NOMBRES Y APELLIDOS - PACIENTE" readonly="true">
                  </div>
                </div>
                <div class="col-md-2">
                   <input type="text" id="txtCodigoMedicoRef" name="txtCodigoMedicoRef"class="form-control" placeholder="Cod. Med. Ref" readonly="true">
                </div>
              </div>
              <!-- MEDICO REFERENCIA -->
              <div class="form-group">
                <div class="col-md-2" align="center">
                  <label class="control-label">Médico</label>
                </div>
                <div class="col-md-5">
                  <div class="input-group">
                    <div class="input-group-btn">
                      <button onclick="abrirModal('#modalListaPersonalSalud');cargarListaPersonalSalud();" type="button"class="btn btn-secundary" title="Buscar paciente">
                        <strong>...</strong>
                      </button>
                    </div>
                    <input id="txtNombresMedico" name="txtNombresMedico"class="form-control" placeholder="NOMBRES Y APELLIDOS - MÉDICO"  onclick="abrirModal('#modalListaPersonalSalud');cargarListaPersonalSalud();" readonly="true">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="input-group">
                    <input type="text" id="txtMedicoCodigo" name="txtMedicoCodigo"class="form-control" placeholder="Cod. Médico" readonly="true"> 
                    <div class="input-group-btn">
                    </div>
                  </div>
                </div>
              </div>
              <!-- MEDICO -->
              <div class="form-group">
                <div class="col-md-2" align="center">
                  <label class="control-label">Día / Hora</label>
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                    <input id="txtFechaCita" name="txtFechaCita"class="form-control date-picker" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                    </span>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                    <input id="txtHoraCita" name="txtHoraCita" value="" type="text" class="form-control timepicker">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                </div>
                <div class="col-md-1" align="center">
                  <label class="control-label">Vía</label>
                </div>
                <div class="col-md-2">
                  <select class="form-control " id="cboVia" name="cboVia">
                    <option value="P" selected>Personal</option>
                    <option value="T">Teléfono</option>
                    <option value="W">Web</option>
                    <option value="F">Facebook</option>
                  </select> 
                </div>
              </div>
              <!-- DIA / HORA  / Vía-->
              <div class="form-group">
                <div class="col-md-2" align="center">
                  <label class="control-label">Motivo</label>
                </div>
                <div class="col-md-6">
                    <textarea class="form-control" id="txtMotivo" name="txtMotivo" rows="2"></textarea>
                </div>
              </div>
              <!-- MOTIVO -->
            </form>
            <!-- /.form -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer" align="ceter">
            <div class="form-group" align="center">
              <input  onClick="guardarCita(this.form);" id="btnGuardar" value="Reservar" style="margin-right:20px;" type="button" class="btn btn-success btn-flat" />
              <a class="btn btn-primary btn-flat" data-dismiss="modal" onClick="limpiarForm(this.form);">Regresar</a>
            </div>
          </div>
        </div>
      </form>
      <!-- Formulario registrar nueva cita médica -->
      <div class="modal fade" id="modalListaPacientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 id="titulo" class="modal-title subfuente text-center">
                    Seleccionar paciente
                  </h4>
              </div>
              <!-- /.modal-header -->
              <div class="modal-body">
                <table id="tablaPacientes" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style='text-align:center;'>N°</th>
                      <th style='text-align:center;'>DNI</th>
                      <th>Nombres y apellidos</th>
                      <th style='text-align:center;'>Edad</th>
                      <th>Tel. / Cel.</th>
                      <th>Procedencia</th>
                      <th style='text-align:center;'>Seleccionar</th>
                    </tr>
                  </thead>
                  <tbody class="cuerpoTabla" id="cuerpoTablaPacientes">
                    <!-- Aqui irán los elementos de la tabla -->
                  </tbody>
                </table>
              </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-Dialog -->
      </div>
      <!-- /.modalListaPacientes -->
      <div class="modal fade" id="modalListaPersonalSalud" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 id="titulo" class="modal-title subfuente text-center">
                    Seleccionar médico
                  </h4>
              </div>
              <!-- /.modal-header -->
              <div class="modal-body">
                <table id="tablaPersonalSalud" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style='text-align:center;'>Código</th>
                      <th>Nombres y apellidos</th>
                      <th style='text-align:center;'>Especialidad</th>
                      <th style='text-align:center;'>Seleccionar</th>
                    </tr>
                  </thead>
                  <tbody class="cuerpoTabla" id="cuerpoTablaPersonalSalud">
                    <!-- Aqui irán los elementos de la tabla -->
                  </tbody>
                </table>
              </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-Dialog -->
      </div>
      <!-- /.modalListaPersonalSalud -->
      <div class="modal fade" id="modalListaPersonalSaludRef" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 id="titulo" class="modal-title subfuente text-center">
                    Seleccionar médico  de referencia
                  </h4>
              </div>
              <!-- /.modal-header -->
              <div class="modal-body">
                <table id="tablaPersonalSaludRef" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style='text-align:center;'>Código</th>
                      <th>Nombres y apellidos</th>
                      <th style='text-align:center;'>Especialidad</th>
                      <th style='text-align:center;'>Seleccionar</th>
                    </tr>
                  </thead>
                  <tbody class="cuerpoTabla" id="cuerpoTablaPersonalSaludRef">
                    <!-- Aqui irán los elementos de la tabla -->
                  </tbody>
                </table>
              </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-Dialog -->
      </div>
      <!-- /.modalListaPersonalSaludRef -->
      <div class="modal fade" id="modalListaServicios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="center">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 id="titulo" class="modal-title subfuente text-center">
                    Seleccionar servicio
                  </h4>
              </div>
              <!-- /.modal-header -->
              <div class="modal-body">
                <table id="tablaServicios" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style='text-align:center;'>ID</th>
                      <th>Servicio</th>
                      <th style='text-align:center;'>Precio</th>
                      <th>Especialidad</th>
                      <th>EspecialidadID</th>
                      <th>Tipo de servicio</th>
                      <th>Tipo de servicio ID</th>
                      <th style='text-align:center;'>Seleccionar</th>
                    </tr>
                  </thead>
                  <tbody class="cuerpoTabla" id="cuerpoTablaServicios">
                    <!-- Aqui irán los elementos de la tabla -->
                  </tbody>
                </table>
              </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-Dialog -->
      </div>
      <!-- /.modalListaServicios -->
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

  // abrirModal("#modalListaServicios");
  cargarCboTipoServicio();
  cargarCboEspecialidades();
  cargarListaPacientes();
  cargarListaServicios();
  cargarListaPersonalSaludRef();
  
  // cargartablaPacientes();  

  // $('#tablaPacientes tbody').on('click','tr',function(){seleccionSimple(this);});  
  

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

