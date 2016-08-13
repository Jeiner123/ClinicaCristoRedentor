<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<?php 
  $opcion='N';
  $proveedorID='';
  if(isset($_POST['txtProveedorID'])){
    $proveedorID = $_POST['txtProveedorID'];
    $opcion = $_POST['txtOpcion'];
  }

 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Nuevo proveedor | CLÍNICA CRISTO REDENTOR</title>
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
      <h1 id="tituloPagina">
        Registrar nuevo proveedor
        <!-- <small>Consultorio - Laboratorio</small> -->
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="listado_pacientes.php">Gestión de compras</a>
        </li>
        <li class="active">
          Nuevo proveedor
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <form class="form-horizontal" role="form" method="post" id="formProveedor" name="formProveedor" enctype="multipart/form-data">
        <div class="box box-primary color-palette-box">          
          <div class="box-body">
            <input id="txtFlag" name="txtFlag" class="form-control" type="hidden" value="<?php echo $opcion; ?>">
              <div class="row">
                <div class="col-md-12">
                  <h1 style="font-size:17px; margin:0px;" class="header blue">
                    Datos del proveedor
                  </h1>
                </div>
              </div>
             
                <div class="row">
                  <div class="col-md-6">
                    <label class="control-label">Tipo de documento</label>
                    <label class="control-label" style="color:red;">*</label>
                    <select class="form-control input-sm" id="cboDocumento" name="cboDocumento" onchange="bloquearCampos()">
                    </select> 
                  </div>
                  <div class="col-md-3">
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
                </div><br>
                <div class="row">
                <div class="col-md-12">
                  <h1 style="font-size:17px; margin:0px;" class="header blue">
                    Modalidad de pago
                  </h1>
                </div>
              </div>
                <div class="row">
                    <div class="col-md-3">
                    <label class="control-label">Cond. de Pago</label>
                    <select class="form-control" id="cboModalidadPago" name="cboModalidadPago">
                    </select> 
                  </div>
                   <div class="col-md-3">
                    <label class="control-label">Entidad bancaria</label>
                    <select class="chosen-select form-control" id="cboBanco" name="cboBanco">
                    </select> 
                  </div>
                  <div class="col-md-3">
                    <label class="control-label">Nº Cuenta principal</label>
                    <input type="text" id="txtCuenta" name="txtCuenta"class="form-control input-sm">
                  </div>
                   <div class="col-md-3">
                    <label class="control-label">Nº Cuenta de detracción</label>
                    <input type="text" id="txtDetraccion" name="txtDetraccion"class="form-control input-sm" placeholder="CUENTA DEL BANCO DE LA NACIÓN">
                  </div>
                </div>
               <br>
                <div class="row">
                  <div class="col-md-12">
                    <h1 style="font-size:17px; margin:0px;" class="header blue">
                      Datos del contacto
                    </h1>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <label class="control-label">Nombres</label>
                    <label class="control-label" style="color:red;"> *</label>
                    <input type="text" id="txtNombre" name="txtNombre"class="form-control input-sm"  onkeypress="return soloLetras(event);" style="text-transform:uppercase;">
                  </div>
                  <div class="col-md-3">
                    <label class="control-label">Apellido paterno</label>
                    <label class="control-label" style="color:red;"> *</label>
                    <input type="text" id="txtApellidoPat" name="txtApellidoPat"class="form-control input-sm" onkeypress="return soloLetras(event);" style="text-transform:uppercase;">
                  </div>
                  <div class="col-md-3">
                    <label class="control-label">Apellido materno</label>
                    <label class="control-label" style="color:red;"> *</label>
                    <input type="text" id="txtApellidoMat" name="txtApellidoMat"class="form-control input-sm"  onkeypress="return soloLetras(event);" style="text-transform:uppercase;">
                  </div>
                  <div class="col-md-3">
                    <label class="control-label">Email</label>
                    <input id="txtEmail" name="txtEmail"class="form-control input-sm" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <label class="control-label">Teléfono</label>
                    <label class="control-label" style="color:red;"> *</label>
                    <input id="txtTelefono" name="txtTelefono"class="form-control input-sm"  maxlength="15" onkeypress="return soloNumeroEntero(event);" >
                  </div>
                  <div class="col-md-3">
                    <label for="cboTipoTelefono1">Operador</label>
                    <label class="control-label" style="color:red;"> *</label>
                    <select class="form-control input-sm" id="cboTipoTelefono1" name="cboTipoTelefono1">
                      <option value="0">-- Seleccionar --</option>
                    </select>
                </div>
                  <div class="col-md-12">
                    <label class="control-label">Observaciones</label>
                    <textarea class="form-control" id="txtObservaciones" name="txtObservaciones"></textarea>
                  </div>
                </div>
          </div>
          <!-- BOx-body -->
          <div class="box-footer" align="ceter">
            <div class="row" align="center">
              <input  onClick="mantenerProveedor(this.form);" value="Guardar" style="margin-right:20px;" type="button" class="btn btn-success btn-flat" id="btnGuardar"/>
              <a class="btn btn-primary btn-flat" data-dismiss="modal" href="listado_proveedores.php">Ver proveedores</a>                      
            </div>
          </div>
        </div>
      </form>
      <!-- Formulario registrar nuevo paciente -->
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
  datosProveedor(<?php echo $proveedorID ?>);
</script>
