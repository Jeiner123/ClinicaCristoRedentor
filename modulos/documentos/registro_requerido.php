<?php include '../general/validar_sesion.php';?>
<?php 
  $control_documento = "";
  if(!isset($_GET['control_documento'])){ 
    $control_documento = "";
  }else{
    $control_documento = $_GET['control_documento'];
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title> Registros requeridos | CLÍNICA CRISTO REDENTOR</title>
  <?php include '../general/header.php';?>
<style type="text/css">
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <input type='hidden' value='gestion' id='menuPrincipal'>
  <input type='hidden' value='m_registro_requerido' id='menuIzquierda'>
  <?php include '../general/menu_principal.php';?>

<div class="wrapper">
  <?php include '../general/izquierda_menu.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registros requeridos
        <!-- <small>Lista</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="../gestion"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a></li>
        <li class="active">Registros requeridos</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Lista de registros requeridos</h3>
            <a href="#" style='color:#fff; font-size:16px; margin-left:15px;' onclick="abrirModal('#modalRegistroReq');limpiarForm('formDocumento');">
              <i class='fa fa-plus-square' title='Registrar nuevo'></i>  
            </a>
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
          <input type="hidden" id="control_documento" name="control_documento" value="<?php echo $control_documento; ?>">
          <table id="tablaRegistroReq" class="table table-bordered table-hover tablaDatos">
            <thead>
              <tr>                
                <th>Código</th>
                <th>Rev.</th>
                <th>Título</th>
                <th>Frecuencia</th>
                <th>Estado</th>
                <th>Fecha aprov.</th>
                <th>Area Resp.</th>
                <th></th>
              </tr>
            </thead>
            <tbody class="cuerpoTabla" id="cuerpoTablaRegistroReq">
              <!-- Aqui irán los elementos de la tabla -->
            </tbody>            
          </table>
        </div>            
        <!-- /.box-body -->
      </div>
      <!-- Lista de items -->
      <div class="modal fade" id="modalRegistroReq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
          <div class="modal-content">             
            <form method="post"   id="formRegistroReq" class="form-horizontal" enctype="multipart/form-data">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 id="titulo" class="modal-title subfuente text-center">Gestión de registros</h4>
              </div>
              <!-- /.modal-header -->
              <div class="modal-body">
                <input id="txtFlag" name="txtFlag" class="form-control" value="N"  type="hidden" >
                <div class="row" align="center">                  
                  <div class="col-md-4 col-md-offset-2">
                    <label class="control-label"><strong>Seleccionar control documento</strong></label>
                    <label style="color:red;">*</label>
                    <select class="form-control input-sm" id="cboControlDocumento" name="cboControlDocumento">
                      <option value="0">-- Seleccionar --</option>
                    </select>
                  </div>
                  <div class="col-md-4 ">
                    <label class="control-label"><strong>Adjuntar formato</strong></label>
                    <label style="color:red;">*</label>
                    <input type="file" id="txtFormato" name="txtFormato" class="">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <label class="control-label"><strong>Código</strong></label>
                    <label style="color:red;">*</label>
                    <input id="txtCodigo" name="txtCodigo"class="form-control input-sm"  maxlength="10" >
                  </div>                  
                  <div class="col-md-7">
                    <label class="control-label"><strong>Título</strong></label>
                    <label style="color:red;">*</label>
                    <input id="txtTitulo" name="txtTitulo"class="form-control input-sm"  maxlength="200">
                  </div>
                  <div class="col-md-2">
                    <label class="control-label"><strong>Revisión N°</strong></label>
                    <label style="color:white;">*</label>
                    <input id="txtRevisionN" name="txtRevisionN"class="form-control input-sm" onkeypress="return soloNumeroEntero(event);">
                  </div>
                  <div class="col-md-3">
                    <label class="control-label"><strong>Frecuencia</strong></label>
                    <label style="color:red;">*</label>
                    <select class="form-control input-sm" id="cboFrecuencia" name="cboFrecuencia">
                      <option value="0">-- Seleccionar --</option>
                      <option value="SEMANAL"> SEMANAL </option>
                      <option value="MENSUAL"> MENSUAL </option>
                      <option value="SEMESTRAL"> SEMESTRAL </option>
                      <option value="ANUAL"> ANUAL </option>
                    </select>
                  </div>   
                  <div class="col-md-5">
                    <label class="control-label"><strong>Área origen</strong></label>
                    <label style="color:red;">*</label>
                    <select class="form-control input-sm" id="cboArea" name="cboArea">
                      <option value="0">-- Seleccionar --</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label"><strong>Área responsable</strong></label>
                    <label style="color:red;">*</label>
                    <input id="txtAreaResponsable" name="txtAreaResponsable"class="form-control input-sm"  maxlength="200">
                  </div>
                  <div class="col-md-3">
                    <label class="control-label"><strong>Estado</strong></label>
                    <label style="color:red;">*</label>
                    <select class="form-control input-sm" id="cboEstado" name="cboEstado">
                      <option value="0">-- Seleccionar --</option>
                      <option value="ELABORADO"> ELABORADO </option>
                      <option value="APROBADO"> APROBADO </option>
                      <option value="OBSOLETO"> OBSOLETO </option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label class="control-label"><strong>Fecha aprobación</strong></label>
                    <label style="color:white;">*</label>
                    <input type="date" id="txtFechaAp" name="txtFechaAp"class=" form-control input-sm">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <label class="control-label"><strong>Soporte</strong></label>
                    <label style="color:white;">*</label>
                    <input id="txtSoporte" name="txtSoporte"class="form-control input-sm"  maxlength="150">
                  </div>
                  <div class="col-md-3">
                    <label class="control-label"><strong>Acceso</strong></label>
                    <label style="color:white;">*</label>
                    <input id="txtAcceso" name="txtAcceso"class="form-control input-sm"  maxlength="150">
                  </div>
                  <div class="col-md-3">
                    <label class="control-label"><strong>T. Retención área</strong></label>
                    <label style="color:white;">*</label>
                    <input id="txtRetencionArea" name="txtRetencionArea"class="form-control input-sm"  maxlength="150">
                  </div>
                  <div class="col-md-3">
                    <label class="control-label"><strong>T. Retención almacén</strong></label>
                    <label style="color:white;">*</label>
                    <input id="txtRetencionAlmacen" name="txtRetencionAlmacen"class="form-control input-sm"  maxlength="150">
                  </div>
                  <div class="col-md-6">
                    <label class="control-label"><strong>Observaciones</strong></label>
                    <label style="color:white;">*</label>
                   <textarea  id="txtObservaciones" name="txtObservaciones" class="form-control input-sm" maxlength="250"></textarea>
                  </div> 
                </div>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <label style="color:red;">*</label> 
                    <small>Estos campos son obligatorios.</small>
                  </div>
                </div>                
              </div>
              <!-- /.modal-body -->
              <div class="modal-footer">
                <div class="row" align="center">
                  <input type="button" class="btn btn-successInverse btnGuardar" id="btnGuardar" onClick="guardarRegistroRequerido(this.form);" value="Guardar"/>
                  <a class="btn btn-secundary" data-dismiss="modal" onClick="limpiarForm(this.form);">Regresar</a>
                </div>
              </div>
              <!-- /.modal-footer -->
            </form>
            <!-- /.form -->
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-Dialog -->
      </div>
      <!-- /.modalRegistroReq -->
      <div>
        Revisión:  00 / Fecha: 05/2016
      </div>
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
  cargarTablaRegistrosReq();
  cargarCboControlDocumento();
  // abrirModal("#modalCargando");
  // cargarTablaDocumentos();
  cargarCboAreas();
  $('#tablaRegistroReq tbody').on('click','tr',function(){seleccionSimple(this);});  
  
</script>
