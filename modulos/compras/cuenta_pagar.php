<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title>Facturas | CLÍNICA CRISTO REDENTOR</title>
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
        Cuenta corriente por pagar
        <!-- <small>Lista - Registro - Actualización</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="listado_pacientes.php">Compras</a>
        </li>
        <li class="active">
          Cuenta corriente por pagar
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Listado de documentos de compra</h3>
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>        
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          <div class="row">
            <div class="col-md-1"><label class="control-label">Estado</label></div>
            <div class="col-md-2">
              <select class="form-control input-sm" id="cboEstado" name="cboEstado" onchange="cargarFacturasFiltro();">
                <option value="0">Todas</option>
                <option value="D">Pendientes</option>
                <option value="P">Pagadas</option>
                <option value="V">Vencidas</option>
                <option value="A">Anuladas</option>
              </select>
            </div>
            <div class="col-md-1"><label class="control-label">Proveedor</label></div>
           <div class="col-md-4">
              <select class="chosen-select" name="cboProveedor" id="cboProveedor" onchange="cargarFacturasFiltro();">
              </select>
            </div>
            <div class="col-md-1"><label class="control-label">Periodo</label></div>
            <div class="col-md-3">
              <select class="chosen-select form-control" name="cboPeriodoCompra" id="cboPeriodoCompra" onchange="cargarFacturasFiltro();">
              </select>
            </div>
             
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <table id="tablaFactura" class="table table-bordered table-hover tablaDatos">
                <thead>
                  <tr>
                    <th>Periódo</th>
                    <th>Serie</th>
                    <th>Número</th>
                    <th style="text-align:center">Fecha de factura</th>
                    <th style="text-align:center">Fecha de vcto.</th>
                    <th style="text-align:center">Total</th>
                    <th style="text-align:center">Estado</th>
                    <th style="text-align:center">Opciones</th>
                  </tr>
                </thead>
                <tbody class="cuerpoTabla" id="cuerpoTablaFactura">
                  <!-- Aqui irán los elementos de la tabla -->
                </tbody>
              </table>
            </div>
            <div class="col-sm-2"><br>
              <div class="form-group">
                <a href="javascript:;" class="btn btn-block btn-success btn-sm btn-flat" >
                  Exportar a  excel
                  <i class="fa fa-download"></i>
                </a>
              </div>
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
<style type="text/css">
  .datepicker{z-index:1151 !important;}
</style>
<script type="text/javascript">
  cargarCboPeriodoCompra(0);
  cargarCboProveedor(0);
  cargarTablaFactura(); 
  $('#tablaFactura tbody').on('click','tr',function(){seleccionSimple(this);});  
  
</script>
