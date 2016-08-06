url = 'bd/bd_operaciones.php';

//============MANTENEDOR PROVEEDORES=============================================

function mantenerProveedor(form){
	comboObligatorio('#cboDocumento',0);
	if($("#cboDocumento").val()==0){
		inputObligatorio('#txtDocumento',4);
	}

	if($("#cboDocumento").val()==1){
		inputMismoValor('#txtDocumento',8);	
	}
	if($("#cboDocumento").val()==6){
		inputMismoValor('#txtDocumento',11);	
		inputObligatorio('#txtRazonSocial',4);
		inputObligatorio('#txtDireccion',4);
	}

	inputObligatorio('#txtNombre',2);
	inputObligatorio('#txtApellidoPat',4);
	inputObligatorio('#txtApellidoMat',4);
	inputObligatorio('#txtTelefono',6);
	comboObligatorio('#cboTipoTelefono1',0);

	if(document.getElementsByClassName("has-error").length > 0){
		alert("Verifique los datos ingresados");
		return false;
	}	

	if($("#txtFlag").val()=="N"){
		guardarProveedor(form)
	}
	if($("#txtFlag").val()=="M"){
		updateProveedor();
	}
}
function guardarProveedor(form){
	var formData = new FormData($('#formProveedor')[0]);
	formData.append("opc", "CC_01");
	$.ajax({
		type: 'POST',
		data: formData,
		url: url,
		contentType :false,
		processData: false,
		success: function(rpta){
			alert(rpta);
		},
		error: function(rpta){
			alert(rpta);
			
		}
	});
	
}

function updateProveedor(){
	var formData = new FormData($('#formProveedor')[0]);
	formData.append("opc", "CC_04");
	$.ajax({
		type: 'POST',
		data: formData,
		url: url,
		contentType :false,
		processData: false,
		success: function(rpta){
			alert(rpta);
		},
		error: function(rpta){
			alert(rpta);
			
		}
	});
}

function bloquearCampos(){
	if($("#cboDocumento").val()!=6){
		$('#txtRazonSocial').prop("readonly", true);
		$('#txtDireccion').prop("readonly", true);
		$('#txtEmailE').prop("readonly", true);
	}else{
		$('#txtRazonSocial').prop("readonly",false);
		$('#txtDireccion').prop("readonly",false);	
		$('#txtEmailE').prop("readonly", false);
	}

}

function cargarTablaProveedor(){
	abrirCargando();
	var opc = 'CC_02';
	$.ajax({
		type: 'POST',
		data:'opc='+opc,
		url: url,
		success: function(rpta){
			$('.tablaDatos').DataTable().destroy();
			$('#cuerpoTablaProveedor').html(rpta);
			$('.tablaDatos').DataTable(
				{
			   	"columnDefs": [
		            { "targets": [ 0 ],"width": "15%"}, 
		            { "targets": [ 1 ],"width": "25%"},										 		//DNI
		            { "targets": [ 2 ],"width": "15%"},											 //nomresb
		            { "targets": [ 3 ],"width": "10%"},	
		            { "targets": [ 4 ],"width": "15%"},
				      ]
	
				}
			);
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});
}

function cargarTablaOCompra(){
	$('.tablaDatos').DataTable(
				{
			   	"columnDefs": [
		            { "targets": [ 0 ],"width": "10%"}, 
		            { "targets": [ 1 ],"width": "15%"},										 		//DNI
		            { "targets": [ 2 ],"width": "25%"},											 //nomresb
		            { "targets": [ 3 ],"width": "15%"},	
		            { "targets": [ 4 ],"width": "5%"},
		            { "targets": [ 5 ],"width": "15%"},	
		            { "targets": [ 5 ],"width": "15%"},	
				      ]
	
				}
			);
}


function eliminarProveedor(documento){
	r = confirm("Seguro que desea eliminar al proveedor");
	if (r != true){
	  return false;
	}
	var opc = 'CC_05';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&documento='+documento,
		url: url,
		success: function(rpta){
			alert(rpta);	
			cargarTablaProveedor();		
		},
		error: function(rpta){
			alert(rpta);			
		}
	});
}

function datosProveedor(documento){
	if($("#txtFlag").val()!='N'){
	abrirCargando();
	var opc = 'CC_03';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&documento='+documento,
		url: url,
		success: function(data){
			var datos= JSON.parse(data);
			$('#cboDocumento').prop("disabled", true);
			$("#txtDocumento").prop("readonly", true);
			for(var i in datos){
                	documento=datos[i].tipoDocumento;
                	condicion=datos[i].condPago;
                	operador=datos[i].tipoTelefono;
                	$("#txtDocumento").val(datos[i].proveedorID);
                	$("#txtRazonSocial").val(datos[i].razonSocial);
                	$("#txtDireccion").val(datos[i].direccion);
                	$("#txtEmailE").val(datos[i].emailEmpresa);
                	entidad=datos[i].banco;
                	$("#txtDetraccion").val(datos[i].cuentaDetraccion);
                	$("#txtCuenta").val(datos[i].cuentaBanco);
                	$("#txtNombre").val(datos[i].nombres);
                	$("#txtApellidoPat").val(datos[i].apellidoPat);
                	$("#txtApellidoMat").val(datos[i].apellidoMat);
                	$("#txtTelefono").val(datos[i].telefono);
                	$("#txtEmail").val(datos[i].emailPersonal);
                	$("#txtObservaciones").val(datos[i].observaciones);
              
                }
             cargaOperador(operador);
             cargarCboCondPago(condicion);
             cargarCboTipoDocumento(documento);
             cargarCboEntidadFinanciera(entidad);

			if($("#txtFlag").val()=='V'){
				bloqueoTotalForm('#formProveedor',true);
				$("#btnGuardar").addClass("hidden");
			}
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});

	}else{
		cargaOperador(0);
		cargarCboCondPago(0);
		cargarCboTipoDocumento('');
		cargarCboEntidadFinanciera('00');
	}
	
}

function cargaOperador(operador){
	opc = 'CC_TT_01';
	$.ajax({
		type: 'POST',
		data:'opc='+opc,
		url: urlGeneral,
		success: function(rpta){
			$('#cboTipoTelefono1').html(rpta);
			$('#cboTipoTelefono2').html(rpta);
			$("#cboTipoTelefono1").val(operador);
			cerrarCargando();
			return true;		
		},
		error: function(rpta){
			alert(rpta);
		}
	});
}


//============MANTENEDOR COMPRAS=============================================

function cargarListaProveedor(){
	abrirCargando();
	var opc = 'CC_06';
	$.ajax({
		type: 'POST',
		data:'opc='+opc,
		url: url,
		success: function(rpta){
			$('.tablaProveedor').DataTable().destroy();
			$('#cuerpoTablaProveedor').html(rpta);
			$('.tablaProveedor').DataTable(
				{
			   	"columnDefs": [
		            { "targets": [ 0 ],"width": "15%"}, 
		            { "targets": [ 1 ],"width": "25%"},										 		//DNI
		            { "targets": [ 2 ],"width": "20%"},											 //nomresb
		            { "targets": [ 3 ],"width": "10%"},	
				      ]
	
				}
			);
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});
}

function cargarListaProductos()
{
	
	abrirCargando();
	var opc = 'CC_09';
	$.ajax({
		type: 'POST',
		data:'opc='+opc,
		url: url,
		success: function(rpta){
			$('#tablaMProducto').DataTable().destroy();
			$('#cuerpoTablaMProducto').html(rpta);
			$('#tablaMProducto').DataTable(
				{
			   	"columnDefs": [
		            { "targets": [ 0 ],"width": "5%"}, 
		            { "targets": [ 1 ],"width": "75%"},										 
		            { "targets": [ 2 ],"width": "20%"},											 
				      ]
	
				}
			);
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});	
}


function cargarListaTComprobante(){
	abrirCargando();
	var opc = 'CC_08';
	$.ajax({
		type: 'POST',
		data:'opc='+opc,
		url: url,
		success: function(rpta){
			$('#cboDocumento').html(rpta);
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});	
}

function seleccionarProveedor(documento,proveedor){
		cerrarModal('#modalListaProveedor');
		$('#txtDocumento').val(documento);
		$('#txtProveedor').val(proveedor);
	}	

function seleccionarTCompra(codigo,descripcion){
	cerrarModal('#modalListaTipCompra');
	$('#txtcodTCompra').val(codigo);
	$('#txtTCompra').val(descripcion);
}

function seleccionarTComprobante(codigo,descripcion){
	cerrarModal('#modalListaTipComprobante');
	$('#txtcodTComprobante').val(codigo);
	$('#txtCPago').val(descripcion);
}

//=====================GESTION DE ORDEN DE COMPRA==========================

function crearOrden(){
	//$("#txtFlag").val("N");
	//$("#btnGuardar").removeClass("hidden");
	//$("#titulo").text("Nueva orden de compra");
	$("#RegOCompra").show();
	$("#listaOrden").hide();
	$("#subtitulo").text("Registro de orden de compra");
}

function mostrarListaOrden(){
	limpiarForm(this.form);
	$("#RegOCompra").hide();
	$("#listaOrden").show();
}

function crearfila(){
	fila=1;
	$("#tablaProducto tbody tr").each(function (index) {
		fila++;
    })
    
	$("#tablaProducto")
	.append
	(
		'<tr><td><input class="form-control input-sm" value="'+fila+'" id="txtItem'+fila+'" name="txtItem'+fila+'" style="text-align:right"; readonly value=""/></td><td><input class="form-control input-sm" id="txtCodigo'+fila+'" name="txtCodigo'+fila+'"></td><td><input class="form-control input-sm" name="txtDescripcion'+fila+'" id="txtDescripcion'+fila+'"></td><td><input class="form-control input-sm" name="txtUnidad'+fila+'" id="txtUnidad'+fila+'"></td><td><input class="form-control input-sm" id="txtCantidad'+fila+'" name="txtCantidad'+fila+'"  onkeypress="return soloNumeroEntero(event);"></td><td><input class="form-control input-sm" id="txtCosto'+fila+'" name="txtCosto'+fila+'" onkeypress="return soloNumeroDecimal(event);"></td><td><input class="form-control input-sm" id="txtDescuento'+fila+'" name="txtDescuento'+fila+'" onkeypress="return soloNumeroDecimal(event);"></td><td><input class="form-control input-sm" id="txtImporte'+fila+'" name="txtImporte'+fila+'" onkeypress="return soloNumeroDecimal(event);" readonly></td></tr>'
	);
}
 
//======================GESTIÓN DE FACTURA=======================================
function crearDetalleFactura(){
	fila=1;
	$("#tablaProducto tbody tr").each(function (index) {
		fila++;
    })
    
	$("#tablaProducto")
	.append
	(
		'<tr><td><input class="form-control input-sm" value="'+fila+'" id="txtItem'+fila+'" name="txtItem'+fila+'" style="text-align:right"; readonly value=""/></td><td><input class="form-control input-sm" id="txtReferencia'+fila+'" name="txtReferencia'+fila+'"></td><td><input class="form-control input-sm" name="txtCuenta'+fila+'" id="txtCuenta'+fila+'"></td><td><input class="form-control input-sm" name="txtDescripcion'+fila+'" id="txtDescripcion'+fila+'"></td><td><input class="form-control input-sm" id="txtCantidad'+fila+'" name="txtCantidad'+fila+'"  onkeypress="return soloNumeroEntero(event);"></td><td><input class="form-control input-sm" id="txtCosto'+fila+'" name="txtCosto'+fila+'" onkeypress="return soloNumeroDecimal(event);"></td><td><input class="form-control input-sm" id="txtImporte'+fila+'" name="txtImporte'+fila+'" onkeypress="return soloNumeroDecimal(event);" readonly></td></tr>'
	);
}

function SeleccionarPeriodo(mes){
	bloqueoTotalForm('#formFactura',true);
	if($("#txtFlag").val()=="N"){
		mes=parseInt(mes)
		abrirModal("#modalPeriodo");
		$("#cboMes").val(mes);
	}
}

function generarPeriodo(mes,anio){
	mes=parseInt(mes);
	if($("#cboMes").val()>mes){
		comboObligatorio('#cboMes',$("#cboMes").val());
		$("#lbError").text("Periódo no permitido");
		return;
	}
	bloqueoTotalForm('#formFactura',false);
	cerrarModal('#modalPeriodo');
	cargarCboCondPago("CON");
	cargarListaProveedor();
	cargarCboAreas();
	cargarCboExistencias();
	cargarCboTipoAdquision(0);
	combo=document.getElementById("cboMes");
	periodo = combo.options[combo.selectedIndex].text;
	$("#txtPeriodo").val(periodo+"-"+anio);
}