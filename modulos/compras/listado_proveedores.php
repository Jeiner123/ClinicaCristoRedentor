<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title> Gestión de proveedores | CLÍNICA CRISTO REDENTOR</title>
  <?php include '../general/header.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <input type='hidden' value='m_para_proveedores' id='menuPrincipal'>
  <input type='hidden' value='m_para_proveedores' id='menuIzquierda'>
  <?php include '../general/menu_principal.php';?>

<div class="wrapper">
  <?php include '../general/izquierda_menu.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Proveedores
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
          Proveedores
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title">Listado de proveedores</h3>
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>        
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          <div class="row">
            <div class="col-md-2 col-xs-6 col-md-offset-5">
              <a href="#" class="btn btn-block btn-primary btn-sm btn-flat" onclick="crearProveedor();">
                Nuevo
              </a>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <table id="tablaProveedor" class="table table-bordered table-hover tablaDatos">
                <thead>
                  <tr>
                    <th>RUC/DNI</th>
                    <th>Razón Social</th>
                    <th>Contacto</th>
                    <th style="text-align:center">Número de contacto</th>
                    <th style="text-align:center">Estado</th>
                    <th style="text-align:center">Opciones</th>
                  </tr>
                </thead>
                <tbody class="cuerpoTabla" id="cuerpoTablaProveedor">
                  <!-- Aqui irán los elementos de la tabla -->
                </tbody>
              </table>
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


<!-- modal registrar proveedor-->
<div class="modal fade" id="modalRegProveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="center">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
             <form class="form-horizontal" role="form" method="post" id="formProveedor" name="formProveedor" enctype="multipart/form-data">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 id="titulo" class="modal-title subfuente text-center">
                      Registrar nuevo proveedor
                    </h4>
                </div>

                <!-- /.modal-header -->
                <div class="modal-body">
                  <input id="txtFlag" name="txtFlag" class="form-control" type="hidden">
                  <div class="row">
                    <div class="col-md-12">
                      <h1 style="font-size:17px; margin:0px;" class="header blue">
                        Datos del proveedor
                      </h1>
                    </div>
                  </div>
                 
                    <div class="row">
                      <div class="col-md-4">
                        <label class="control-label">Tipo de entidad</label>
                        <label class="control-label" style="color:red;">*</label>
                        <select class="form-control input-sm" id="cboEntidad" name="cboEntidad">
                          <option value="0">-- Seleccionar --</option>
                          <option value="1">PERSONA NATURAL</option>
                          <option value="2">PERSONA JURÍDICA</option>
                          <option value="3">OTROS</option>
                        </select> 
                      </div>
                      <div class="col-md-4">
                        <label class="control-label">Tipo de documento</label>
                        <label class="control-label" style="color:red;">*</label>
                        <select class="form-control input-sm" id="cboDocumento" name="cboDocumento" onchange="bloquearCampos()">
                          <option value="0">-- Seleccionar --</option>
                          <option value="1">DNI</option>
                          <option value="2">CARNET DE EXTRANJERIA</option>
                          <option value="3">RUC</option>
                          <option value="4">OTROS</option>
                        </select> 
                      </div>
                      <div class="col-md-4">
                        <label class="control-label">Número (RUC, DNI, Etc)</label>
                        <label class="control-label" style="color:red;"> *</label>
                        <input type="text" id="txtDocumento" name="txtDocumento"class="form-control input-sm"  onkeypress="return soloNumeroEntero(event);">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label class="control-label">Razón social</label>
                        <input type="text" id="txtRazonSocial" name="txtRazonSocial"class="form-control input-sm">
                      </div>
                      <div class="col-md-6">
                        <label class="control-label">Dirección fiscal</label>
                        <input type="text" id="txtDireccion" name="txtDireccion"class="form-control input-sm">
                      </div>
                      <div class="col-md-6">
                        <label class="control-label">Email principal</label>
                        <input type="text" id="txtEmailE" name="txtEmailE"class="form-control input-sm">
                      </div>
                    </div>
                    <div class="row">
                       <div class="col-md-6">
                        <label class="control-label">Entidad bancaria</label>
                        <select class="form-control input-sm" id="cboBanco" name="cboBanco">
                          <option value="0">-- Seleccionar --</option>
                          <option value="1">Banco de Crédito del Perú</option>
                          <option value="2">Banco de la Nación</option>
                          <option value="3">Banco Sudamericano</option>
                          <option value="4">Scotiabank Perú</option>
                          <option value="5">BCR del Perú</option>
                          <option value="6">BBVA Banco Continental</option>
                          <option value="7">Banco Interbank</option>
                          <option value="8">Banco de Comercio</option>
                          <option value="9">Mibanco</option>
                          <option value="10">Banco Financiero</option>
                          <option value="11">Banco Interamericano BIF</option>
                          <option value="12">Banco Santander (Chile)</option>
                          <option value="13">BBVA (España)</option>
                          <option value="13">Otro</option>
                        </select> 
                      </div>
                       <div class="col-md-4">
                        <label class="control-label">Nº Cuenta de detracción</label>
                        <input type="text" id="txtDetraccion" name="txtDetraccion"class="form-control input-sm">
                      </div>
                    </div>
                   
                    <div class="row">
                      <div class="col-md-12">
                        <h1 style="font-size:17px; margin:0px;" class="header blue">
                          Datos del contacto
                        </h1>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <label class="control-label">Nombres</label>
                        <label class="control-label" style="color:red;"> *</label>
                        <input type="text" id="txtNombre" name="txtNombre"class="form-control input-sm"  onkeypress="return soloLetras(event);">
                      </div>
                      <div class="col-md-4">
                        <label class="control-label">Apellido paterno</label>
                        <label class="control-label" style="color:red;"> *</label>
                        <input type="text" id="txtApellidoPat" name="txtApellidoPat"class="form-control input-sm" onkeypress="return soloLetras(event);">
                      </div>
                      <div class="col-md-4">
                        <label class="control-label">Apellido materno</label>
                        <label class="control-label" style="color:red;"> *</label>
                        <input type="text" id="txtApellidoMat" name="txtApellidoMat"class="form-control input-sm"  onkeypress="return soloLetras(event);">
                      </div>
                      <div class="col-md-3">
                        <label class="control-label">Teléfono</label>
                        <label class="control-label" style="color:red;"> *</label>
                        <input id="txtTelefono" name="txtTelefono"class="form-control input-sm"  maxlength="15" onkeypress="return soloNumeroEntero(event);" >
                      </div>
                      <div class="col-md-9">
                        <label class="control-label">Email</label>
                        <input id="txtEmail" name="txtEmail"class="form-control input-sm" >
                      </div>
                      <div class="col-md-12">
                        <label class="control-label">Observaciones</label>
                        <textarea class="form-control" id="txtObservaciones" name="txtObservaciones"></textarea>
                      </div>
                    </div>
                  </div>
                  <!-- /.modal-body -->
                  <div class="modal-footer">                  
                    <div class="row" align="center">
                      <input  onClick="mantenerProveedor(this.form);" value="Guardar" style="margin-right:20px;" type="button" class="btn btn-success btn-flat" id="btnGuardar"/>
                      <a class="btn btn-primary btn-flat" data-dismiss="modal" onClick="limpiarForm(this.form);">Regresar</a>                      
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
        <!-- /.modalRegPersonal -->
<!-- modal-->

<!-- ./wrapper -->
  <?php include '../general/pie_pagina.php';?>  
</body>
</html>
<script src="js/script.js"></script>
<script type="text/javascript">
  cargarTablaProveedor();
  $('#tablaProveedor tbody').on('click','tr',function(){seleccionSimple(this);});  
  
</script>
