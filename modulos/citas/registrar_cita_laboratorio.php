<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title> Gestión de citas | CLÍNICA CRISTO REDENTOR</title>
  <?php include '../general/header.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <!-- <input type='hidden' value='gestion' id='menuPrincipal'> -->
  <input type='hidden' value='m_registrar_lab' id='menuIzquierda'>
  <?php include '../general/menu_principal.php';?>
<div class="wrapper">
  <?php include '../general/izquierda_menu.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registrar cita para laboratorio
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
          Registrar cita laboratorio
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">      
      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Datos generales</h3>            
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="remove">
              <!-- <i class="fa fa-times"></i> -->
            </button>
          </div>
        </div>
        <div class="box-body" align="center">
          <form method="post"  id="formDatosGenerales" enctype="multipart/form-data">
            <input id="txtFlag" name="txtFlag" class="form-control" value="N" type="hidden">
            <div class="box-body">
              <div class="row">
                <div class="col-md-5 col-md-offset-1">
                  <div class="form-group">
                    <label class="control-label">Paciente</label>
                    <div class="input-group">
                      <div class="input-group-btn">
                        <button onclick="abrirModal('#modalListaPacientes');" type="button"class="btn btn-secundary" title="Buscar paciente">
                          <strong>...</strong>
                        </button>
                      </div>
                      <input onclick="abrirModal('#modalListaPacientes');" id="txtNombresPaciente" name="txtNombresPaciente"class="form-control" placeholder="Seleccionar paciente" readonly="true">
                    </div>
                  </div>
                  <!-- form-group -->
                </div>
                <!-- Col-md-2 -->
                <div class="col-md-2 col-xs-6">
                  <label class="control-label">DNI</label>
                  <div class="form-group">
                    <input type="text" id="txtDNI" name="txtDNI"class="form-control" placeholder="DNI" readonly="true">                    
                  </div>
                  <!-- form-group -->
                </div>
                <!-- cOL -->
                <div class="col-md-2 col-xs-6">
                  <label class="control-label">N° Hist.</label>
                  <div class="input-group">
                    <input type="text" id="txtPacienteID" name="txtPacienteID"class="form-control" placeholder="Nro Hist." readonly="true"> 
                    <div class="input-group-btn">
                      <button onclick="verHistoriaCitas();"type="button"class="btn btn-secundary" title="Ver histórico de citas">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
                  <!-- input-group -->
                </div>
              </div>
              <!-- ROW - PACIENTE -->
              <div class="row">
                <div class="col-md-5 col-md-offset-1">
                  <label class="control-label">Médico Referencia</label>
                  <div class="input-group">
                    <div class="input-group-btn">
                      <button onclick="abrirModal('#modalListaPersonalSaludRef');" type="button"class="btn btn-secundary" title="Buscar paciente">
                        <strong>...</strong>
                      </button>
                    </div>
                    <input onclick="abrirModal('#modalListaPersonalSaludRef');" id="txtNombresMedicoRef" name="txtNombresMedicoRef"class="form-control" placeholder="Seleccionar médico" readonly="true">
                  </div>
                </div>
                <!-- COL -->
                <div class="col-md-2">
                  <label class="control-label">Codigo Médico</label>
                  <div class="form-group">
                    <input type="text" id="txtCodigoMedicoRef" name="txtCodigoMedicoRef"class="form-control" placeholder="Cod. Med. Ref" readonly="true">
                  </div>
                </div>
                <!-- COL -->
              </div>
              <!-- ROW MEDICO REF -->
              <div class="row">
                <div class="col-md-2 col-md-offset-1" >
                  <label class="control-label">Vía</label>
                  <div class="form-group">
                    <select class="form-control " id="cboVia" name="cboVia">
                      <option value="P" selected>Personal</option>
                      <option value="T">Teléfono</option>
                      <option value="W">Web</option>
                      <option value="F">Facebook</option>
                    </select> 
                  </div>                    
                </div>
              </div>
            </div>
            <div class="box-body">              
            </div>
            <!-- box - body - Medico refencia -->         
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- Formulario Datos Generales -->
      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Servicios - detalle</h3>            
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="remove">
              <!-- <i class="fa fa-times"></i> -->
            </button>
          </div>
        </div>
        <div class="box-body" align="center">
          <div class="row">
            <div class="col-md-5 col-md-offset-1 col-xs-12">
              <label class="form-label">Servicio</label>
              <div class="input-group">
                <div class="input-group-btn">
                  <button onclick="abrirModal('#modalListaServicios');" title="Seleccionar servicio" type="button"class="btn btn-secundary" >
                    <strong>...</strong>
                  </button>
                </div>                  
                <input onclick="abrirModal('#modalListaServicios');" class="form-control" placeholder="Seleccionar servicio" readonly="true" id="txtServicio" name="txtServicio">
              </div>
            </div>
            <div class="col-md-2 col-xs-3">
              <div class="form-group">
                <label class="form-label">Precio</label>
                <input type="text" id="txtPrecio" name="txtPrecio" class="form-control" placeholder="Precio Unit." readonly="true">
              </div>
            </div>
            <div class="col-md-1  col-xs-3">
              <div class="form-group">
                <label class="form-label">Cantidad</label>
                <input type="text" id="txtCantidad" name="txtCantidad" value="1" maxlength="2"class="form-control" onchange="calcularImporte();" onkeypress="return soloNumeroEntero(event);">
              </div>
            </div>
             <div class="col-md-2  col-xs-3">
              <div class="form-group">
                <label class="form-label">Importe</label>
                <input type="text" id="txtImporte" name="txtImporte" class="form-control" placeholder="Importe" readonly="true" >
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
            <div type="hidden"class="col-md-2 col-xs-4">
              <input type="hidden" id="txtServicioID" name="txtServicioID" readonly="true" class="form-control" placeholder="ID">
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 col-md-offset-1  col-xs-3">
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
        </div>
        <!-- /.box-body -->
      </div>
      <!-- Detalle del pedido -->
      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Importe</h3>            
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="remove">
              <!-- <i class="fa fa-times"></i> -->
            </button>
          </div>
        </div>
        <div class="box-body" align="center">
          <div class="row">
            <div class="col-md-2 col-xs-3 col-md-offset-2">
              <div class="form-group">
                <label class="form-label">Sub total</label>
                <input type="text" id="txtSubTotal" name="txtSubTotal" class="form-control"  value="0" readonly="true">
              </div>
            </div>
            <div class="col-md-2 col-xs-3">
              <div class="form-group">
                <label class="form-label">IGV</label>
                <input type="text" id="txtIGV" name="txtIGV" class="form-control" value="0" readonly="true">
              </div>
            </div>
            <div class="col-md-2 col-xs-3">
              <div class="form-group">
                <label class="form-label text-red">TOTAL</label>
                <input type="text" id="txtTotal" name="txtTotal" class="form-control" value="0" readonly="true">
              </div>
            </div>
          </div>
          <!-- <div class="row">
            <div class="col-md-2 col-xs-3 col-md-offset-2">
              <div class="form-group">
                <label class="form-label">Pagado</label>
                <input type="text" id="txtPagado" name="txtPagado" class="form-control" value="0" onkeypress="return soloNumeroDecimal(event);" onchange="calcularSaldo(this);">
              </div>
            </div>
            <div class="col-md-2 col-xs-3">
              <div class="form-group">
                <label class="form-label">Saldo</label>
                <input type="text" id="txtSaldo" name="txtSaldo" class="form-control"  readonly="true" value="0">
              </div>
            </div>
          </div> -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer" align="ceter">
          <div class="form-group" align="center">
            <input  onClick="guardarCitaLaboratorio(this.form);" id="btnGuardar" value="Guardar" style="margin-right:20px;" type="button" class="btn btn-successInverse" />
            <a class="btn btn-secundary" data-dismiss="modal" onClick="limpiarForm(this.form);">Cancelar</a>
          </div>
        </div>
      </div>
      <!-- Facturación -->

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
      <div class="modal fade" id="modalListaPersonalSaludRef" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
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