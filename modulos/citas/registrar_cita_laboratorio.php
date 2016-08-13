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
        Registrar cita para laboratorio
        <small>Laboratorio</small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../gestion"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="../../gestion">Citas</a>
        </li>
        <li class="active">
          Registrar cita laboratorio
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-primary color-palette-box">
        <form method="post"  id="formDatosGenerales" enctype="multipart/form-data">
          <div class="box-body" align="center">
            <input id="txtFlag" name="txtFlag" class="form-control" value="N" type="hidden">
            <div class="row">
              <div class="col-md-12">
                <div class="box-header" style="margin: 0px 0px -15px -10px">
                  <h1 class="box-title">Datos generales</h1>
                </div>
              </div>
            </div>
            <hr>
            <!-- Titulo datos generales  -->          
            <div class="row">
              <div class="col-sm-5">
                <div class="form-group">
                  <label class="control-label">Paciente</label><label style="color:red">&nbsp;*</label>
                  <select onchange="seleccionarCboPaciente(this)" class="chosen-select form-control input-sm" id="cboPacientes" name="cboPacientes" data-placeholder="-- Paciente --">
                    <!-- Lista de diagnósticos -->
                  </select> 
                </div>
              </div>
              <!-- COL- Paciente -->
              <div class="col-sm-5">
                <div class="form-group">
                  <label class="control-label">Médico Referencia</label>                  
                  <select onchange="seleccionarCboMedico(this);" class="chosen-select form-control input-sm" id="cboMedicosRef" name="cboMedicosRef" data-placeholder="-- Médico --">
                    <!-- Lista de diagnósticos -->
                  </select> 
                </div>
              </div>
              <!-- COL Medico -->
              <div class="col-md-2" >
                <div class="form-group">
                  <label class="control-label">Vía</label>                    
                  <select class="form-control input-sm" id="cboVia" name="cboVia">
                    <option value="P" selected>Personal</option>
                    <option value="T">Teléfono</option>
                    <option value="W">Web</option>
                    <option value="F">Facebook</option>
                  </select>
                </div>
              </div>
              <!-- COL Via -->
             <!--  <div class="col-sm-2 col-xs-6" hidden>
                <div class="form-group">
                  <label class="control-label">N° Hist.</label>
                  <input type="text" id="txtPacienteID" name="txtPacienteID"class="form-control input-sm" placeholder="Nro Hist." readonly="true">
                </div>
              </div> -->
            <!-- COL numero historia-->
            </div>
            <!-- ROW - Datos generales -->
            <div class="row">
              <div class="col-md-12">
                <div class="box-header" style="margin: 0px 0px -15px -10px">
                  <h1 class="box-title">Examenes y análisis</h1>
                </div>
              </div>
            </div>
            <hr>
            <!-- Titulo datos Examens  -->
            <div class="row">
              <div class="col-sm-5">
                <div class="form-group">
                  <label class="control-label">Servicio</label>
                  <select onchange="seleccionarCboServicios(this.value);" class="chosen-select form-control" id="cboServicios" name="cboServicios" data-placeholder="-- Médico --">
                    <!-- Lista de diagnósticos -->
                  </select> 
                </div>
              </div>
              <div class="col-md-2 col-xs-3">
                <div class="form-group">
                  <label class="form-label">Precio</label>
                  <input type="text" id="txtPrecio" name="txtPrecio" class="form-control input-sm" placeholder="Precio Unit." readonly="true">
                </div>
              </div>
              <div class="col-md-1  col-xs-3">
                <div class="form-group">
                  <label class="form-label">Cantidad</label>
                  <input type="text" id="txtCantidad" name="txtCantidad" value="1" maxlength="2"class="form-control input-sm" onchange="calcularImporte();" onkeypress="return soloNumeroEntero(event);">
                </div>
              </div>
               <div class="col-md-2  col-xs-3">
                <div class="form-group">
                  <label class="form-label">Importe</label>
                  <input type="text" id="txtImporte" name="txtImporte" class="form-control input-sm" placeholder="Importe" readonly="true" >
                </div>
              </div>
              <div class="col-md-1  col-xs-12" align="center">
                <div class="form-group">
                  <label class="control-label"style="color:white;">--</label>
                  <button type="button" class="btn btn-successInverse btn-sm" onclick="agregarServicioDetalle();" style="margin-right:20px;">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
              </div>              
              <div class="col-md-3  col-xs-3">
                <label class="form-label">Fecha</label>
                <div class="input-group">
                  <input id="txtFechaCita" name="txtFechaCita"class="form-control date-picker input-sm" placeholder="dd-mm-aaaa" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" onchange="validarFechaMayor(this);" value="<?php echo $fechaHoyDMA?>">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                  </span>
                </div>
              </div>                
              <div class="col-md-2 col-xs-3">
                <label class="form-label">Hora</label>
                <div class="input-group">
                  <input id="txtHoraCita" name="txtHoraCita" type="text" class="form-control timepicker input-sm" value="8:00 AM">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                </div>
              </div>
              <div class="col-md-5 col-xs-6">
                <div class="form-group">
                  <label class="form-label">Observaciones</label>
                  <input type="text" id="txtObservaciones" name="txtObservaciones" class="form-control input-sm" >
                </div>
              </div>
            </div>
            <div class="col-md-2 col-xs-4">
              <input style="display:none" id="txtServicio" name="txtServicio" readonly="true" class="form-control">
            </div>
            <!-- Servicios -->
            <div class="row" id="servicioDetalle">
              <div class="col-md-12">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                  <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                      <table id="tablaServiciosLab" class="table table-bordered table-striped table-hover dataTable"role="grid"aria-describedby="example1_info">
                        <thead style="background-color:#ccc;">
                          <tr>                          
                            <th>ID</th>
                            <th>Servicio</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Importe</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th></th>
                            <th>Observaciones</th>
                          </tr>
                        </thead>
                        <tbody class="cuerpoTabla" id="cuerpoTablaServiciosLab">
                          <!-- Aqui irán los elementos de la tabla -->
                        </tbody>
                      </table>
                      <!--tablaServiciosLab-->  
                    </div>
                  </div>
                </div>         
              </div>
            </div>
            <!-- Tabla servicios -->
            <div class="row">
              <div class="col-md-12">
                <div class="box-header" style="margin: 0px 0px -15px -10px">
                  <h1 class="box-title">Importe</h1>
                </div>
              </div>
            </div>
            <hr>
            <!-- Titulo Importe  -->
            <div class="row">
              <div class="col-sm-2 col-xs-3 col-sm-offset-5">
                <div class="form-group">
                  <label class="form-label">Sub total</label>
                  <input type="text" id="txtSubTotal" name="txtSubTotal" class="form-control"  value="0" readonly="true">
                </div>
              </div>
              <div class="col-sm-2 col-xs-3">
                <div class="form-group">
                  <label class="form-label">IGV</label>
                  <input type="text" id="txtIGV" name="txtIGV" class="form-control" value="0" readonly="true">
                </div>
              </div>
              <div class="col-sm-2 col-xs-3">
                <div class="form-group">
                  <label class="form-label text-red"><strong>TOTAL</strong></label>
                  <input style="font-weight: bold;" type="text" id="txtTotal" name="txtTotal" class="form-control" value="0" readonly="true">
                </div>
              </div>
            </div>                 
          </div>
        </form>
        <!-- /.box-body -->
        <div class="box-footer" align="ceter">
          <div class="form-group" align="center">
            <div class="col-md-6">
              <input  onClick="guardarCitaLaboratorio(this.form);" id="btnGuardar" value="Guardar" style="margin-right:20px;" type="button" class="btn btn-success btn-block btn-flat" />  
            </div>
            <div class="col-md-6">
              <a class="btn btn-primary btn-flat btn-block" data-dismiss="modal" onClick="limpiarForm(this.form);">Regresar</a>  
            </div>
          </div>
        </div>
        <!-- Facturación -->
      </div>
      <!-- Facturación -->
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
  cargarCboServicios('#cboServicios',0,0);
  
  
  // $( document ).ajaxStop(function(){
  //   openSelect('#cboPacientes_chosen');
  // });
  $('#tablaServiciosLab tbody').on( 'click', 'a.eliminarServicioDetalle', function () {
    fila = $(this).parents('tr');
    precio = fila.find("td").eq(2).html();
    cantidad = fila.find("td").eq(3).html();
    signo = -1;    
    if(quitarFila(this,'#tablaServiciosLab','¿Seguro que desea quitar el servicio?')){
      calcularImporteTotal(precio,cantidad,signo);
      return false;
    }   
  });
  function calcularImporte(){
    var servicio = $('#txtServicio').val();
    var precio = $('#txtPrecio').val();
    var cantidad = $('#txtCantidad').val();
    if(precio==""){
      alert("Debe seleccionar un servicio");
      $('#txtCantidad').val("1");
      return false;
    }
    if(cantidad<1 || cantidad>5){
      alert("Cantidad no válida");
      $('#txtCantidad').val("1");
      return false;
    }
    $('#txtImporte').val(cantidad*precio);
  }
  $('#tablaServiciosLab').DataTable(
        {
           "columnDefs": [            
            { "targets": [ 0 ],"width": "0%", "orderable": false,"class":"hidden","searchable": false,},
            { "targets": [ 1 ],"width": "50%", "orderable": false, "searchable": false,},
            { "targets": [ 2 ],"width": "10%", "orderable": false, },
            { "targets": [ 3 ],"width": "6%", "orderable": false, "searchable": false , },
            { "targets": [ 4 ],"width": "8%", "orderable": false, "searchable": false ,"type": "double"},
            { "targets": [ 5 ],"width": "10%", "orderable": false,"searchable": false ,},
            { "targets": [ 6 ],"width": "7%", "orderable": false,"searchable": false ,},
            { "targets": [ 7 ],"width": "5%", "orderable": false,"searchable": false ,},
            { "targets": [ 8 ],"width": "5%", "orderable": false,"class":"hidden","searchable": false ,}  //Observaciones
            
          ]
        }
    );
  $('#tablaServiciosLab_filter').parent('div').remove();
  $('#tablaServiciosLab_length').parent('div').remove();
  $('#tablaServiciosLab_info').parent('div').remove();
  $('#tablaServiciosLab_paginate').parent('div').remove();
  
  
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