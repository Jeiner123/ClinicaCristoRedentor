<?php include '../general/validar_sesion.php';?>
<?php include '../general/variables.php';?>
<!DOCTYPE html>
<html>
<head>
  <title>Gestión de requerimientos | CLÍNICA CRISTO REDENTOR</title>
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
        Solicitud de requerimiento
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="../../"><i class="fa fa-dashboard" style="color:#"></i>Inicio</a>
        </li>
        <li>
          <a href="listado_pacientes.php">Requerimientos</a>
        </li>
        <li class="active">
          Solicitud de requerimiento
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box box-solid color-palette-box">
        <div class="box-header bg-blue" >
          <div>
            <h3 class="box-title" id="subtitulo">Registro de requerimiento</h3>
          </div>
          <div class="box-tools pull-right">
            <button style='color:#fff;' type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
          </div>
        </div>        
        <div class="box-body" style='overflow-x:scroll;overflow-y:hidden' align="center">
          <!--registro de orden de compra-->
          <form>
            <div id="RegOCompra">
            <!-- COL-MD-6 -->
                
                <div class="row" style="margin-left:5px;">
                  <div class="col-md-4 col-md-offset-4">
                    <label class="control-label">REQUERIMIENTO Nº <p></p></label>
                  </div>
                </div>
                <div class="row" style="margin-left:5px;">
                  <div class="col-md-4">
                    <label class="control-label">ÁREA: <p></p></label>
                  </div>
                  <div class="col-md-5">
                    <label class="control-label">NOMBRE: <?= $full_name ?></label>
                  </div>
                  <div class="col-md-3">
                    <label class="control-label">FECHA: <?= $fechaHoyDMA ?></label>
                  </div>
                </div>
                 <div class="col-md-12">
                  <div class="input-group"><br><hr>
                    <div class="input-group-btn">
                      <button onclick="crearfila();" type="button"class="btn btn-active" title="Agregar fila">
                        <strong><i class='fa fa-plus'></i></strong>
                      </button>
                    </div>
                  </div>
                </div>
                  <table id="tablaRequerimiento" class="tablaRequerimiento">
                        <thead>
                          <tr>
                            <th width="5%" style='text-align:center;'>&nbsp;ITEM
                            </th>
                            <th width="25%" style='text-align:center;'>&nbsp;PRODUCTO</th>
                            <th width="10%">&nbsp;UNIDAD/MEDIDA</th>
                            <th width="30%" style='text-align:center;'>DESCRIPCION</th>
                            <th width="10%" style='text-align:center;'>STOCK</th>
                            <th width="20%" style='text-align:center;'>REQUERIMIENTO</th>
                          </tr>
                        </thead>
                        <tbody class="cuerpoTabla" id="cuerpoTablaRequerimiento">
                        <?php for ($i=1;$i<=3;++$i): ?>
                          <tr>
                            <td><input class="form-control input-sm" id="txtItem<?php echo $i;?>" name="txtItem<?php echo $i;?>" style='text-align:right;' readonly value="<?php echo $i;?>" /></td>
                            <td><input class="form-control input-sm" id="txtProducto<?php echo $i;?>" name="txtProducto<?php echo $i;?>" /></td>
                            <td><input class="form-control input-sm" id="txtUnidad<?php echo $i;?>" name="txtUnidad<?php echo $i;?>" /></td>
                            <td><input class="form-control input-sm" id="txtDescripcion<?php echo $i;?>" name="txtDescripcion<?php echo $i;?>" /></td>
                            <td><input class="form-control input-sm" id="txtCantidad<?php echo $i;?>" name="txtCantidad<?php echo $i;?>"  onkeypress="return soloNumeroEntero(event);" /></td>
                            <td><input class="form-control input-sm" id="txtRequerimiento<?php echo $i;?>" name="txtRequerimiento<?php echo $i;?>" onkeypress="return soloNumeroDecimal(event);" /></td>
                          </tr>
                        <?php endfor; ?>
                        </tbody>
                      </table>    
                </div>
                <div class="row">
                  <div class="col-md-6" style="top:20px!important;">
                        <a href="#" class="btn btn-default btn-block">Cancelar registro</a>
                    </div>
                    <div class="col-md-6" style="top:20px!important;">
                        <button type="submit" class="btn btn-primary btn-block">Registrar requerimiento</button>
                    </div>
                </div><br><br>
                </div>

            </div>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="control-sidebar-bg"></div>
</div>
  <?php include '../general/pie_pagina.php';?>  
</body>
</html>
<script src="js/script.js"></script>
<script type="text/javascript">
  cargarListaProveedor();
  cargarListaProductos();
  cargarCboAreas();
  cargarCboExistencias();
  $('#tablaOCompra tbody').on('click','tr',function(){seleccionSimple(this);});  
   $('.date-picker').datepicker({
    autoclose: true,
    todayHighlight: true
  })    
</script>
