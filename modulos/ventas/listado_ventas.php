<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title>Reporte de ventas | CLÍNICA CRISTO REDENTOR</title>
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
        Ventas
        <!-- <small>Lista - Registro - Actualización</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="listado_ventas.php">Ventas</a>
        </li>
        <li class="active">
          Reporte de ventas
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row" >
        <div class="col-sm-2 col-md-offset-4">
          <div class="form-group">            
            <select class="form-control input-sm" id="cboAnio" name="cboAnio" onchange="cargarTablasVentas();">
              <option value="2015">2015</option>
              <option value="2016" selected>2016</option>
            </select>
          </div>            
        </div>
        <div class="col-sm-2">
          <div class="form-group">            
            <select class="form-control input-sm" id="cboMes" name="cboMes" onchange="cargarTablasVentas();">
              <?php 
                foreach ($meses as $id => $value){
                  echo "<option ";
                  if($id == date('m')) echo "selected ";
                  echo "value='".$id."'>".$value."</option>";
                }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Listado de Pedidos</h3>
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>        
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          <div class="row">            
            <div class="col-sm-2">
              <label for="cboEstadoPedido">Estado</label>
              <select class="form-control input-sm" id="cboEstadoPedido" name="cboEstadoPedido" onchange="cargarTablaPedidos();">
                <option value="0">-- Todos --</option>
                <option value="PEN">PENDIENTE</option>
                <option value="PAR">PARCIAL</option> 
                <option value="PAG">PAGADO</option>
                <option value="XXX">ANULADO</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="cboTipoPedido">Tipo</label>
              <select class="form-control input-sm" id="cboTipoPedido" name="cboTipoPedido" onchange="cargarTablaPedidos();">
                <option value="0">-- Todos --</option>
                <option value="L">LABORATORIO</option>
                <option value="C">CONSULTA</option>
              </select>
            </div>
            <div class="col-sm-2 col-sm-offset-6">
              <div class="form-group">
                <a href="javascript:;" class="btn btn-block btn-success btn-sm btn-flat" >
                  Exportar a excel
                  <i class="fa fa-download"></i>
                </a>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-sm-12">
              <table id="tablaPedidos" width="100%" class="table table-bordered table-hover tablaDatos">
                <thead>
                  <tr>
                    <th style='text-align:left;'>#</th>
                    <th style='text-align:center;'>Ped.</th>
                    <th style='text-align:center;'>Fecha</th>
                    <th style='text-align:center;'>Paciente</th>
                    <th style='text-align:center;'>Tipo</th>
                    <th style='text-align:center;'>IGV</th>
                    <th style='text-align:center;'>VV</th>
                    <th style='text-align:center;'>IGV</th>
                    <th style='text-align:center;'>Importe</th>
                    <th style='text-align:center;'>Pagado</th>
                    <th style='text-align:center;'>Forma pago</th>
                    <th style='text-align:left;'>Estado</th>
                  </tr>
                </thead>
                <tbody class="cuerpoTabla" id="cuerpoTablaPedidos">
                  <!-- Aqui irán los elementos de la tabla -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- Lista de pedidos -->
      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Listado de Citas</h3>
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>        
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          <div class="row">
            <div class="col-sm-2">
              <label for="cboEstadoCita">Estado</label>
              <select class="form-control input-sm" id="cboEstadoCita" name="cboEstadoCita" onchange="cargarTablaCitas();">
                <option value="0">-- Todos --</option>
                <option value="R">RESERVADO</option>
                <option value="C">CONFIRMADO</option> 
                <option value="S">EN SALA</option>
                <option value="A">ATENDIDO</option>
                <option value="X">ANULADO</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="cboEstadoPagoCita">Estado de pago</label>
              <select class="form-control input-sm" id="cboEstadoPagoCita" name="cboEstadoPagoCita" onchange="cargarTablaCitas();">
                <option value="0">-- Todos --</option>
                <option value="PEN">PENDIENTE</option>
                <option value="PAR">PARCIAL</option> 
                <option value="PAG">PAGADO</option>
                <option value="XXX">ANULADO</option>
              </select>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label">Médico de atención</label>
                <select  id="cboMedicos" name="cboMedicos" class="chosen-select form-control input-sm" onchange="cargarTablaCitas();">
                  <!-- Lista de diagnósticos -->
                </select> 
              </div>
            </div>            
            <div class="col-sm-2 col-sm-offset-2">
              <div class="form-group">
                <a href="javascript:;" class="btn btn-block btn-success btn-sm btn-flat" >
                  Exportar a excel
                  <i class="fa fa-download"></i>
                </a>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <table id="tablaCitas" width="100%" class="table table-bordered table-hover tablaDatos">
                <thead>
                  <tr>
                    <th style='text-align:left;'>#</th>
                    <th style='text-align:center;'>Ped.</th>
                    <th style='text-align:center;'>Fecha cita</th>
                    <th style='text-align:center;'>Paciente</th>
                    <th style='text-align:center;'>Tipo</th>
                    <th style='text-align:center;'>Especialidad</th>
                    <th style='text-align:center;'>Servicio</th>
                    <th style='text-align:center;'>Medico</th>                    
                    <th style='text-align:center;'>Importe </th>
                    <th style='text-align:center;'>Estado</th>
                  </tr>
                </thead>
                <tbody class="cuerpoTabla" id="cuerpoTablaCitas">
                  <!-- Aqui irán los elementos de la tabla -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- Lista de Citas -->
      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Listado de Pagos</h3>
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>        
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          <div class="row">
            <div class="col-sm-2 col-sm-offset-10">
              <div class="form-group">
                <a href="javascript:;" onclick="exportarPagosExcel();" class="btn btn-block btn-success btn-sm btn-flat" >
                  Exportar a excel
                  <i class="fa fa-download"></i>
                </a>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <table id="tablaPagos"  width="100%" class="table table-bordered table-hover tablaDatos">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Ped.</th>
                    <th style='text-align:center;'>Fecha</th>
                    <th>Paciente</th>
                    <th>Telefono</th>
                    <th>Comprobante</th>
                    <th>Número Comprob.</th>
                    <th>Importe</th>                    
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
      <!-- Lista de Pagos -->
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
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label">Referencia de </label>
                <select  id="cboMedicosReferencia" name="cboMedicosReferencia" class="chosen-select form-control input-sm" onchange="cargarTablaReferencias();">
                  <!-- Lista de diagnósticos -->
                </select> 
              </div>
            </div> 
            <div class="col-md-4">
              <label for="cboEspecialidades">Especialidad</label>
              <select class="form-control input-sm" id="cboEspecialidades" name="cboEspecialidades" onchange="cargarTablaReferencias();">
                <!--  -->
              </select>
            </div>
            <div class="col-sm-2 col-sm-offset-2">
              <div class="form-group">
                <a href="javascript:;" class="btn btn-block btn-success btn-sm btn-flat" >
                  Exportar a excel
                  <i class="fa fa-download"></i>
                </a>
              </div>
            </div>
          </div>
          <!-- ROW -->
          <br>
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
<script type="text/javascript">

  function cargarTablasVentas () {
    cargarTablaPedidos();
    cargarTablaCitas();
    cargarTablaReferencias();    
    cargarTablaPagos();
  }
  cargarTablasVentas();

  // cargarCboEspecialidades("#cboEspecialidad",-1);
  cargarCboMedicos('#cboMedicos',0);
  cargarCboMedicos('#cboMedicosReferencia',0);
  cargarCboEspecialidades('#cboEspecialidades',-1);
  
  
  $('#tablaPedidos tbody').on('click','tr',function(){seleccionSimple(this);} );
  $('#tablaCitas tbody').on('click','tr',function(){seleccionSimple(this);});
  $('#tablaPagos tbody').on('click','tr',function(){seleccionSimple(this);});
  $('#tablaReferencias tbody').on('click','tr',function(){seleccionSimple(this);});
  function exportarPagosExcel(){
    var mes = $("#cboMes").val();
    var anio = $("#cboAnio").val();    
    window.open("reporte_ventas_vs_14.1.php?mes="+mes+"&anio="+anio, '_blank');
  }
</script>
