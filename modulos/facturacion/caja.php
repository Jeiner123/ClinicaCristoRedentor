<?php include '../general/validar_sesion.php';?>
<!DOCTYPE html>
<html>
<head>
  <title> Caja - Facturación | CLÍNICA CRISTO REDENTOR</title>
  <?php include '../general/header.php';?>
<style type="text/css">
</style>
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
        Caja
        <small>Apertura / Cierre</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Gestión de documentos</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="row" align="center">
          <div class="col-xs-4 col-xs-offset-4">
            <div class="row" id="btnAbrirCaja">
              <div class="col-sm-4 col-sm-offset-4">
                  <a href="javascrit:;" id="mostrarDatosCaja" data-toggle="modal" class="btn btn-block btn-success">
                      <i class="ace-icon fa fa-unlock bigger-110" style="font-size:30px;"></i>
                      <br>
                      ABRIR
                  </a>
              </div>
            </div>
            <div class="row" id="btnCerrarCaja" style="display:none" >
              <div class="col-sm-4 col-sm-offset-4" >
                  <a href="javascrit:;" id="mostrarDatosCaja" data-toggle="modal" class="btn btn-block btn-danger">
                      <i class="ace-icon fa fa-lock  bigger-110" style="font-size:30px;"></i>
                      <br>
                      CERRAR
                  </a>
              </div>
            </div>
          </div>
        </div>
        <br>
                  
      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Historial de registros</h3>
            <a href="#" style='color:#fff; font-size:16px; margin-left:15px;' onclick="abrirModal('#modalRegDocumento');limpiarForm('formDocumento');">
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
          <table id="tablaDocumentos" class="table table-bordered table-hover tablaDatos">
            <thead>
              <tr>                
                <th>Item</th>
                <th>Apertura</th>
                <th>Saldo inicial</th>
                <th>Cierre</th>
                <th>ESTADO</th>
                <th>TIPO DOC</th>
                <th>ÁREA</th>
                <th> </th>
              </tr>
            </thead>
            <tbody class="cuerpoTabla" id="cuerpoTablaDocumentos">
              <!-- Aqui irán los elementos de la tabla -->
              <!-- <tr role="row" class="odd">
                    <td>PG-09</td>
                    <td style="text-align:center;">0</td>
                    <td class="sorting_1">ATENCION DE QUEJAS Y RECLAMOS DE CLIENTES</td>
                    <td>APROBADO</td>
                    <td>PROCEDIMIENTO</td>
                    <td>DIRECCION DE GESTION</td>
                    <td style="text-align:center;">
                      <div class="action-buttons">
                        <a href="../../docs/PG-09 ATENCIÓN QUEJAS CLIENTES R00.pdf" class="text-blue" target="blanck" style="margin-right:7px;">
                            <i class="fa fa-file-o" title="Ver documento"></i>
                        </a>
                         <a href="#" class="text-green" onclick="alert(No disponible&quot;);" style="margin-right:7px;">
                            <i class="fa fa-search" title="Modificar servicio"></i>
                        </a>
                        <a href="#" class="text-yellow" onclick="alert(&quot;No disponible&quot;);" style="margin-right:7px;">
                            <i class="fa fa-pencil" title="Modificar servicio"></i>
                        </a>                  
                        <a href="#" class="text-red" onclick="alert(&quot;No disponible&quot;);" style="margin-right:7px;">
                            <i class="fa fa-trash" title="Eliminar"></i>
                        </a>
                      </div>
                    </td>
                  </tr> -->
            </tbody>            
          </table>
        </div>            
        <!-- /.box-body -->
      </div>
      <!-- Lista de items -->
      <div class="modal fade" id="modalRegDocumento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
          <div class="modal-content">             
            <form method="post"   id="formDocumento" class="form-horizontal" enctype="multipart/form-data">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 id="titulo" class="modal-title subfuente text-center">Registrar nuevo documento</h4>
              </div>
              <!-- /.modal-header -->
              <div class="modal-body">
                <input id="txtFlag" name="txtFlag" class="form-control" value="N"  type="hidden" >
                <input id="txtEspecialidadID" name="txtEspecialidadID" class="form-control" type="hidden" >
                <div class="row" align="center">
                  <div class="col-md-4 col-md-offset-4">
                    <label class="control-label"><strong>Seleccionar documento</strong></label>
                    <label style="color:red;">*</label>
                    <input type="file" id="txtRuta" name="txtRuta"class="">
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
                    <label class="control-label"><strong>Estado</strong></label>
                    <label style="color:red;">*</label>
                    <select class="form-control input-sm" id="cboEstado" name="cboEstado">
                      <option value="0">-- Seleccionar --</option>                      
                      <option value="EN ELABORACIÓN"> EN ELABORACIÓN </option>
                      <option value="ELABORADO"> ELABORADO </option>
                      <option value="REVISIÓN"> REVISIÓN </option>
                      <option value="APROBADO"> APROBADO </option>
                      <option value="IMPLEMENTADO"> IMPLEMENTADO </option>
                      <option value="OBSOLETO"> OBSOLETO </option>
                    </select>
                  </div>                  
                  <div class="col-md-4">
                    <label class="control-label"><strong>Área</strong></label>
                    <label style="color:red;">*</label>
                    <select class="form-control input-sm" id="cboArea" name="cboArea">
                      <option value="0">-- Seleccionar --</option>
                      <option value="1">-- SALUD OCUPACIONAL --</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label class="control-label"><strong>Tipo de documento</strong></label>
                    <label style="color:red;">*</label>
                    <select class="form-control input-sm" id="cboTipoDocumento" name="cboTipoDocumento">
                      <option value="0">-- Seleccionar --</option>
                      <option value="MANUAL"> MANUAL </option>
                      <option value="POLÍTICO"> POLÍTICO </option>
                      <option value="PROCEDIMIENTO"> PROCEDIMIENTO </option>
                      <option value="INSTRUCTIVO"> INSTRUCTIVO </option>
                      <option value="EXTERNO"> EXTERNO </option>
                      <option value="LEGAL"> LEGAL </option>
                      <option value="REGALMENTO"> REGLAMENTO </option>
                    </select>
                  </div>                    
                </div>
                <div class="row">                  
                  <div class="col-md-3">
                    <label class="control-label"><strong>Fecha aprobación</strong></label>
                    <label style="color:white;">*</label>
                    <input type="date" id="txtFechaAp" name="txtFechaAp"class=" form-control input-sm">
                  </div>
                  <div class="col-md-3">
                    <label class="control-label"><strong>Fecha vencimiento</strong></label>
                    <label style="color:white;">*</label>
                    <input type="date" id="txtFechaV" name="txtFechaV"class=" form-control input-sm">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="control-label"><strong>Acceso</strong></label>
                    <label style="color:white;">*</label>
                    <input id="txtAcceso" name="txtAcceso"class="form-control input-sm"  maxlength="150">
                  </div>
                  <div class="col-md-6">
                    <label class="control-label"><strong>Distribución</strong></label>
                    <label style="color:white;">*</label>
                    <input id="txtDistribucion" name="txtDistribucion"class="form-control input-sm"  maxlength="255">
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
                  <input type="button" class="btn btn-successInverse btnGuardar" id="btnGuardar" onClick="guardarDocumento(this.form);" value="Guardar"/>
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
      <!-- /.modalRegDocumento -->
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
  cargarTablaDocumentos();
  cargarCboAreas();
  $('#tablaDocumentos tbody').on('click','tr',function(){seleccionSimple(this);});
</script>
