url = 'bd/bd_operaciones.php';

function validarCorrelativo(element){
  var valor = $(element).val();
  if(valor.length == 1) valor = '00'+valor;
  else if(valor.length == 2) valor = '00'+valor;
  return valor;
}

//CARGAR PERIODOS DE COMPRA
	function cargarCboPeriodoCompra(valorDefecto){
		opc = 'CC_PC';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: url,
			success: function(rpta){
				$('#cboPeriodoCompra').html(rpta);
				$('#cboPeriodoCompra').val(valorDefecto);
				funcionSelect('#cboPeriodoCompra');
				cerrarCargando();
				return true;		
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}

//CARGAR PERIODOS DE PAGOS
	function cargarCboPeriodoPago(valorDefecto){
		opc = 'CC_PP';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: url,
			success: function(rpta){
				$('#cboPeriodoCompra').html(rpta);
				$('#cboPeriodoCompra').val(valorDefecto);
				funcionSelect('#cboPeriodoCompra');
				cerrarCargando();
				return true;		
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}


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

function cargarCboProveedor(valorDefecto){
	abrirCargando();
	var opc = 'CC_06';
	$.ajax({
		type: 'POST',
		data:'opc='+opc,
		url: url,
		success: function(rpta){
			$('#cboProveedor').html(rpta);
			$("#cboProveedor").val(valorDefecto);
			funcionSelect('#cboProveedor');
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
		'<tr><td><input class="form-control input-sm" value="'+fila+'" id="txtItem'+fila+'" name="txtItem'+fila+'" style="text-align:right"; readonly value=""/></td><td><input class="form-control input-sm" id="txtReferencia'+fila+'" name="txtReferencia'+fila+'"></td><td><input class="form-control input-sm" name="txtCuenta'+fila+'" id="txtCuenta'+fila+'"></td><td><input class="form-control input-sm" name="txtDescripcion'+fila+'" id="txtDescripcion'+fila+'" onblur="validarDescripcion(event)"></td><td><input class="form-control input-sm" id="txtCantidad'+fila+'" name="txtCantidad'+fila+'"  onkeypress="return soloNumeroEntero(event);"  onblur="calcularImporte(event)"></td><td><input class="form-control input-sm" id="txtCosto'+fila+'" name="txtCosto'+fila+'" onkeypress="return soloNumeroDecimal(event);" onblur="calcularImporte(event)"></td><td><input class="form-control input-sm importe" value="0.0" id="txtImporte'+fila+'" name="txtImporte'+fila+'" onkeypress="return soloNumeroDecimal(event);" readonly></td></tr>'
	);
}

function validaDetraccion(){
	if($("#cboDetraccion").val()!=0){
		$("#divDetraccion").show();
		valorDetraccion=parseFloat($("#cboDetraccion").val());
		total=parseFloat($("#txtPrecioVenta").val());
		detraccion=valorDetraccion*total
		$("#txtDetraccion").val(detraccion.toFixed(2));
	}else{
		$("#divDetraccion").hide();
	}
}

function validaRetencion(){
	if($("#cboRetencion").val()!=0){
		$("#divValorRetencion").show();
		valorRetencion=parseFloat($("#cboRetencion").val());
		total=parseFloat($("#txtPrecioVenta").val());
		Retencion=valorRetencion*total
		$("#txtRetencion").val(Retencion.toFixed(2));
	}else{
		$("#divValorRetencion").hide();
	}
}

function SeleccionarPeriodo(mes){
	bloqueoTotalForm('#formFactura',true);
	if($("#txtFlag").val()=="N"){
		mes=parseInt(mes)
		abrirModal("#modalPeriodo");
		$("#cboMes").val(mes);
	}else{
		mes=$("#txtMes").val();
		anio=$("#txtAnio").val();
		correlativo=$("#txtCorrelativo").val();
		datosFactura(mes,anio,correlativo);
	}
}

function generarPeriodo(mes,anio){
	mes=parseInt(mes);
	anio=parseInt(anio);
	if($("#cboMes").val()>mes && $("#cboAnio").val()>=anio){
		comboObligatorio('#cboMes',$("#cboMes").val());
		$("#lbError").text("Periódo no permitido");
		return;
	}

	mesPeriodo=$("#cboMes").val();
	anioPeriodo=$("#cboAnio").val();

	bloqueoTotalForm('#formFactura',false);
	cerrarModal('#modalPeriodo');
	cargarCboCondPago("CON");
	cargarCboProveedor(0);
	cargarCboAreas();
	cargarCboExistencias();
	cargarCboTipoAdquision(0);
	cargarCboComprobanteCompra('03');
	cargarCboDetraccion(0);
	cargarCboPercepcion(0);
	cargarCboParametro(1,"#cboIGV",0);
	cargarCboParametro(2,"#cboRetencion",0);
	$("#txtFecha").prop("disabled",true);
	$("#txtMes").val(mesPeriodo);
	$("#txtAnio").val(anioPeriodo);
	combo=document.getElementById("cboMes");
	periodo = combo.options[combo.selectedIndex].text;
	$("#txtPeriodo").val(periodo+"-"+anioPeriodo);
	generarCorrelativo(mesPeriodo,anioPeriodo);
}

function generarCorrelativo(mes,anio){
	var opc = 'CC_GC';
		$.ajax({
			type: 'POST',
			data:'opc='+opc+'&mes='+mes+'&anio='+anio,
			url: url,
			success: function(rpta){
				rpta=parseInt(rpta);
				$("#txtCodigo").val(rpta);
				$("#txtCodigo").val(validarCorrelativo("#txtCodigo"));

			},
			error: function(rpta){
				alert(rpta);
			}
		});
}

function cargarTablaFactura(){
	abrirCargando();
	var opc = 'CC_10';
	$.ajax({
		type: 'POST',
		data:'opc='+opc,
		url: url,
		success: function(rpta){
			$('.tablaDatos').DataTable().destroy();
			$('#cuerpoTablaFactura').html(rpta);
			$('#tablaFactura').DataTable(
			{
				   	"columnDefs": [
				        { "targets": [ 0 ],"width": "15%"}, 									 
				        { "targets": [ 1 ],"width": "5%"}, 									 
				        { "targets": [ 2 ],"width": "10%"},											 
				        { "targets": [ 3 ],"width": "15%"},											 
				        { "targets": [ 4 ],"width": "15%"},											 
				        { "targets": [ 5 ],"width": "5%"},											 
				        { "targets": [ 6 ],"width": "15%"},											 
				        { "targets": [ 7 ],"width": "10%"},											 
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

function cargarTablaFacturaFiltro(estado,periodo,proveedor){
	if(periodo!=0){
		var i = periodo.indexOf('-');
		mes=periodo.substr(0,i);
		anio=periodo.substr(i+1);
	}else{
		mes=0;
		anio=0;
	}
	abrirCargando();
	var opc = 'CC_16';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&estado='+estado+'&mes='+mes+'&anio='+anio+'&proveedor='+proveedor,
		url: url,
		success: function(rpta){
			$('.tablaDatos').DataTable().destroy();
			$('#cuerpoTablaFactura').html(rpta);
			$('#tablaFactura').DataTable(
			{
				   	"columnDefs": [
				        { "targets": [ 0 ],"width": "15%"}, 									 
				        { "targets": [ 1 ],"width": "5%"}, 									 
				        { "targets": [ 2 ],"width": "10%"},											 
				        { "targets": [ 3 ],"width": "15%"},											 
				        { "targets": [ 4 ],"width": "15%"},											 
				        { "targets": [ 5 ],"width": "5%"},											 
				        { "targets": [ 6 ],"width": "15%"},											 
				        { "targets": [ 7 ],"width": "10%"},											 
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

function validarTributos(){
	if($('#cboComprobante').val()=='01' || $('#cboComprobante').val()=='03'){
		$("#divRenta").hide();
	}else{
		$("#divRenta").show();
	}

	if($('#cboComprobante').val()=='02'){
		$(".tributo-comun").hide();
	}else{
		$(".tributo-comun").show();
	}
}

function calcularImporte(e){
	if (e.srcElement)
	  tag = e.srcElement.id;
  	else if (e.target)
  	  tag = e.target.id;
  	
	var campo = tag.length;
	if(campo==9){
		var fila = tag.substr(8);
	}
	if(campo==12){
		var fila = tag.substr(11);	
	}

	cantidad=$("#txtCantidad"+fila).val();
	costo=$("#txtCosto"+fila).val();
	
	if(cantidad=='' || costo==''){
		inputObligatorio("#txtDescripcion"+fila,0);
		$("#txtImporte"+fila).val('0.0');
	}else{
		inputObligatorio("#txtDescripcion"+fila,3);
		importe=parseFloat(cantidad)*parseFloat(costo);
		$("#txtImporte"+fila).val(importe.toFixed(2));
	}

	CalcularTotal();
}

function validarDescripcion(e){
	if (e.srcElement)
	  tag = e.srcElement.id;
  	else if (e.target)
  	  tag = e.target.id;
  	
	// var i = respuesta.indexOf('-');
	var campo = tag.length;
	if(campo==9){
		var fila = tag.substr(8);
	}
	if(campo==12){
		var fila = tag.substr(11);	
	}

	cantidad=$("#txtCantidad"+fila).val();
	costo=$("#txtCosto"+fila).val();

	if(cantidad=='' || costo==''){
		inputObligatorio("#txtDescripcion"+fila,0);
	}else{
		inputObligatorio("#txtDescripcion"+fila,3);
	}

}

function CalcularTotal(){
	if($("#txtDescuento").val()==""){
		$("#txtDescuento").val("0.0");
	}
	total=0;
	$(".importe").each(function (index){
			index=parseInt(index)+1;
            importe=$("#txtImporte"+index).val();
            if(importe!="0.0"){
            	total=parseFloat(total)+parseFloat(importe);
            }
    })

    $("#txtTotalBruto").val(total.toFixed(2));
    descuento=parseFloat($("#txtDescuento").val());
    valorVenta=total-descuento;
    if($("#cboIGV").val()!=0){
    	valoIGV=$("#cboIGV").val();
    	igv=parseFloat(valorVenta)*parseFloat(valoIGV);
    	$("#txtIGV").val(igv.toFixed(2));
    	precioVenta=valorVenta+igv;
    }else{
    	$("#txtIGV").val("0.00");
    	precioVenta=valorVenta;
    }

    if($("#cboDetraccion").val()!=0){
    	detraccion=$("#cboDetraccion").val();
    	valorDetraccion=precioVenta*parseFloat(detraccion);
		$("#txtDetraccion").val(valorDetraccion.toFixed(2));
	}else{
		$("#txtDetraccion").val("0.00");
	}

	if($("#cboRetencion").val()!=0){
		retencion=$("#cboRetencion").val();
    	valorRetencion=precioVenta*parseFloat(retencion);
		$("#txtRetencion").val(valorRetencion.toFixed(2));
	}else{
		$("#txtRetencion").val("0.00");
	}

    $("#txtValorVenta").val(valorVenta.toFixed(2));
    $("#txtPrecioVenta").val(precioVenta.toFixed(2));
}


function RegistrarCompra(){
	detalles=0;
	inputObligatorio('#txtPeriodo',1);
	comboObligatorio('#cboComprobante',0);
	inputObligatorio('#txtSerie',4);
	inputObligatorio('#txtNumero',7);
	inputObligatorio('#txtFechaEmision',10);
	inputObligatorio('#txtFechaVcto',10);
	comboObligatorio('#cboModalidadPago',0);
	comboObligatorio('#cboAdquisicion',0);
	comboObligatorio('#cboProveedor',0);

	if(document.getElementsByClassName("has-error").length > 0){
		alert("Verifique los datos ingresados");
		return false;
	}	

	$(".importe").each(function (index){
		detalles++;
	});

	if($("#txtFlag").val()=="N"){
		ajaxSaveFactura(detalles);
	}
	if($("#txtFlag").val()=="M"){
		
	}
}

function ajaxSaveFactura(detalles){
	abrirCargando();
	var formData = new FormData($('#formFactura')[0]);
	formData.append("opc", "CC_08");
	formData.append("detalles",detalles);
	$.ajax({
		type: 'POST',
		data: formData,
		url: url,
		contentType :false,
		processData: false,
		success: function(rpta){
			if(rpta==1){
				ajaSaveDetalleFactura();
				alert("Compra registrada");
    			cerrarCargando();
			}else{
				cerrarCargando();
				alert("Ocurrió un error mientrás se intentaba registrar la compra");
			}
			
		},
		error: function(rpta){
			cerrarCargando();
			alert(rpta);
		}
	});	
}

function ajaSaveDetalleFactura(){

	$(".importe").each(function (index){
			index=parseInt(index)+1;
            importe=$("#txtImporte"+index).val();
            if(importe!="0.0"){
            	var formData = new FormData($('#formFactura')[0]);
				formData.append("opc", "CC_09");
				formData.append("item",index);
				$.ajax({
					type: 'POST',
					data: formData,
					url: url,
					contentType :false,
					processData: false,
					success: function(rpta){
					},
					error: function(rpta){
						alert(rpta);
						cerrarCargando();	
					}
				});	
            }
    })
}

function datosFactura(mes,anio,codigo){
	abrirCargando();
	var opc = 'CC_11';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&mes='+mes+'&anio='+anio+'&codigo='+codigo,
		url: url,
		success: function(data){
			var datos= JSON.parse(data);
			for(var i in datos){
					comprobante=datos[i].comprobanteID;
					formaPago=datos[i].formaPagoID;
					proveedor=datos[i].proveedorID;
                	existencia=datos[i].tipoExistencia;
                	adquisicion=datos[i].tipoAdquisicionID;
                	detraccion=datos[i].detraccion;
                	$("#txtFecha").val(datos[i].fecha);
                	$("#txtSerie").val(datos[i].serie);
                	$("#txtNumero").val(datos[i].numero);
                	$("#txtFechaEmision").val(datos[i].fechaEmision);
                	$("#txtFechaVcto").val(datos[i].fechaVencimiento);
                	$("#txtCodigo").val(validarCorrelativo("#txtCorrelativo"));
                	$("#txtPeriodo").val(meses[mes]+"-"+anio);
                	$("#cboMoneda").val(datos[i].moneda);
                	$("#cboIGV").val(datos[i].IGV);
                	$("#cboPercepcion").val(datos[i].percepcion);
                	$("#cboRenta").val(datos[i].renta);
                	$("#txtTotalBruto").val(datos[i].totalBruto);
                	$("#txtDescuento").val(datos[i].descuento);
                	$("#txtValorVenta").val(datos[i].valorVenta);
                	$("#txtIGV").val(datos[i].impuesto);
                	$("#txtPrecioVenta").val(datos[i].precioVenta);
                }
             	cargarCboCondPago(formaPago);
				cargarCboProveedor(proveedor);
				cargarCboExistencias(existencia);
				cargarCboTipoAdquision(adquisicion);
				cargarCboComprobanteCompra(comprobante);
				cargarCboDetraccion(detraccion);

			if($("#txtFlag").val()=='V'){
				$("#btnGuardar").addClass("hidden");
			}
			cargarDetallesFactura(mes,anio,codigo);
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});

}

function cargarDetallesFactura(mes,anio,codigo){
	var opc = 'CC_12';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&mes='+mes+'&anio='+anio+'&codigo='+codigo,
		url: url,
		success: function(data){
			var datos= JSON.parse(data);
			for(var i in datos){
					item=datos[i].item;
					$("#txtDescripcion"+item).val(datos[i].descripcion);
					$("#txtCantidad"+item).val(datos[i].cantidad);
					$("#txtCosto"+item).val(datos[i].costoUnitario);
					$("#txtImporte"+item).val(datos[i].importe);
            }
         	cerrarCargando();

		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});

}

function AnularFactura(mes,anio,codigo){
	r = confirm("Seguro que desea anular el comprobante de compra");
	if (r != true){
	  return false;
	}else{
		var opc = 'CC_15';
		$.ajax({
			type: 'POST',
			data:'opc='+opc+'&mes='+mes+'&anio='+anio+'&codigo='+codigo,
			url: url,
			success: function(rpta){
				if(rpta==1){
					cargarTablaFactura();
				}else{
					alert("No se puede anular la factura en estos momentos");
				}
			},
			error: function(rpta){
				alert(rpta);
				cerrarCargando();
			}
		});
	}
}

function cargarFacturasFiltro(){
	estado=$("#cboEstado").val();
	periodo=$("#cboPeriodoCompra").val();
	proveedor=$("#cboProveedor").val();
	if(estado==0 && proveedor==0 && periodo==0){
		cargarTablaFactura();
	}else{
		cargarTablaFacturaFiltro(estado,periodo,proveedor);
	}
}
//===================GESTIÓN DE MOVIMIENTOS DE SALIDA==========================

function datosParaPago(){
	mes=$("#txtMesRef").val();
	anio=$("#txtAnioRef").val();
	codigo=$("#txtCodigoRef").val();
	flag=$("#txtFlag").val();
	
	abrirCargando();
	var opc = 'CC_11';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&mes='+mes+'&anio='+anio+'&codigo='+codigo,
		url: url,
		success: function(data){
			var datos= JSON.parse(data);
			for(var i in datos){
					comprobante=datos[i].comprobanteID;
					formaPago=datos[i].formaPagoID;
					proveedor=datos[i].proveedorID;
                	$("#txtProveedorID").val(datos[i].proveedorID);
                	$("#txtProveedor").val(datos[i].proveedor);
                	$("#txtSerie").val(datos[i].serie);
                	$("#txtNumero").val(datos[i].numero);
                	$("#txtFechaEmision").val(datos[i].fechaEmision);
                	$("#txtFechaVcto").val(datos[i].fechaVencimiento);
                	$("#txtSaldo").val(datos[i].saldo);
                	$("#txtTotal").val(datos[i].precioVenta);
                }
				cargarCboComprobanteCompra(comprobante);
  				cargarCboMedioPago('008');
  			bloqueoTotalForm("#formPagoCompra",true);
			if(flag=='V'){
				$("#btnGuardar").addClass("hidden");
			}else{
				if(flag=='N'){
					mes=parseInt(mes);
					anio=parseInt(anio);
					abrirModal("#modalPeriodo");
					$("#cboMes").val(mes);
					$("#cboAnio").val(anio);
				}
			}
			cargarDetallePago(mes,anio,codigo);
			
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});
}

function generarPeriodoPago(mes,anio){
	mes=parseInt(mes);
	anio=parseInt(anio);

	if($("#cboMes").val()>mes && $("#cboAnio").val()>=anio){
		comboObligatorio('#cboMes',$("#cboMes").val());
		$("#lbError").text("Periódo no permitido");
		return;
	}

	mes=$("#cboMes").val();
	anio=$("#cboAnio").val();
	$("#txtMes").val(mes);
	$("#txtAnio").val(anio);
	$("#txtPeriodo").val(meses[mes]+' - '+anio);
	bloqueoTotalForm("#formPagoCompra",false);
	cerrarModal("#modalPeriodo")
}

function cargarDetallePago(mes,anio,codigo){
	var opc = 'CC_12';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&mes='+mes+'&anio='+anio+'&codigo='+codigo,
		url: url,
		success: function(data){
			var datos= JSON.parse(data);
			for(var i in datos){
				item=datos[i].item;
				descripcion=datos[i].descripcion;
				cantidad=datos[i].cantidad;
				costo=datos[i].costoUnitario;
				importe=datos[i].importe;

				$("#tablaDetallePago")
				.append
				(
					'<tr><td>'+item+'</td><td>'+descripcion+'</td><td>'+cantidad+'</td><td style="text-align:right">'+costo+'</td><td style="text-align:right">'+importe+'</td></tr>'
				);
            }
         	cerrarCargando();

		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});

}

function ValidarMedioPago(){
	if($('#cboMedioPago').val()=='008' || $('#cboMedioPago').val()=='009' || $('#cboMedioPago').val()=='999'){
		$("#divExtra").hide();
	}else{
		$("#divExtra").show();
		cargarCboEntidadFinanciera('00');
	}

	if($('#cboMedioPago').val()=='007' || $('#cboMedioPago').val()=='102'){
		$("#subtitulo").text("DETALLE PAGO CON CHEQUE");
		$(".ck").show();
		$(".cuenta").hide();
	}else{
		$("#subtitulo").text("");
		$(".ck").hide();
		$(".cuenta").show();
	}
}

function RegistrarPagoCompra(){
	inputObligatorio('#txtMonto',1);
	inputObligatorio('#txtPeriodo',1);
	if(document.getElementsByClassName("has-error").length > 0){
		alert("Verifique los datos ingresados");
		return false;
	}

	abrirCargando();
	var formData = new FormData($('#formPagoCompra')[0]);
	formData.append("opc", "CC_13");
	$.ajax({
		type: 'POST',
		data: formData,
		url: url,
		contentType :false,
		processData: false,
		success: function(rpta){
			cerrarCargando();	
			if(rpta==1){
				saldo=parseFloat($("#txtSaldo").val());
				monto=parseFloat($("#txtMonto").val());
				nTotal=saldo-monto;
				$("#txtSaldo").val(nTotal.toFixed(2));
				$("#txtMonto").val('');
				if(nTotal<=0){
					$("#txtMonto").prop("disabled",true);
				}
				alert("Pago registrado")
			}
			if(rpta==0){
				alert("Ocurrió un error inesperado mientras se intentaba registrar el pago");
			}
		},
		error: function(rpta){
			cerrarCargando();
			alert(rpta);
		}
	});	
}

//==================GESTIÓN DE MOVIMIENTOS DE CAJA==============================
function cargarTablaMovimientosSalida(){
	abrirCargando();
	var opc = 'CC_14';
	$.ajax({
		type: 'POST',
		data:'opc='+opc,
		url: url,
		success: function(rpta){
			$('.tablaDatos').DataTable().destroy();
			$('#cuerpoTablaMovSalida').html(rpta);
			$('.tablaDatos').DataTable(
			{
				   	"columnDefs": [
				        { "targets": [ 0 ],"width": "15%"}, 									 
				        { "targets": [ 1 ],"width": "5%"}, 									 
				        { "targets": [ 2 ],"width": "10%"},											 
				        { "targets": [ 3 ],"width": "45%"},											 
				        { "targets": [ 4 ],"width": "5%"},											 
				        { "targets": [ 5 ],"width": "10%"}											 
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

function cargarPagosCompraFiltro(){
	proveedor=$("#cboProveedor").val();
	periodo=$("#cboPeriodoCompra").val();
	if(periodo!=0){
		var i = periodo.indexOf('-');
		mes=periodo.substr(0,i);
		anio=periodo.substr(i+1);
	}else{
		mes=0;
		anio=0;
	}

	if(proveedor==0 && periodo==0){
		cargarTablaMovimientosSalida();
	}else{
		abrirCargando();
		var opc = 'CC_17';
		$.ajax({
			type: 'POST',
			data:'opc='+opc+'&proveedor='+proveedor+'&mes='+mes+'&anio='+anio,
			url: url,
			success: function(rpta){
				$('.tablaDatos').DataTable().destroy();
				$('#cuerpoTablaMovSalida').html(rpta);
				$('.tablaDatos').DataTable(
				{
					   	"columnDefs": [
					        { "targets": [ 0 ],"width": "15%"}, 									 
					        { "targets": [ 1 ],"width": "5%"}, 									 
					        { "targets": [ 2 ],"width": "10%"},											 
					        { "targets": [ 3 ],"width": "45%"},											 
					        { "targets": [ 4 ],"width": "5%"},											 
					        { "targets": [ 5 ],"width": "10%"}											 
						  ]
					}
				);
				cerrarCargando();
				//alert(rpta);
			},
			error: function(rpta){
				alert(rpta);
				cerrarCargando();
			}
		});
	}
}