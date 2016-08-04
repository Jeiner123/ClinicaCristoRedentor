var url = 'bd/bd_operaciones.php';
//Cargar combo de comprobante de pago
function cargarCboComprobante(){
	abrirCargando();
	opc = 'CC_CV_01';
	$.ajax({
		type: 'POST',
		data:'opc='+opc,
		url: url,
		success: function(rpta){			
			$('#cboComprobante').html(rpta);
			$('#cboComprobante').val('003');
			cerrarCargando();

			return true;
		},
		error: function(rpta){
			alert(rpta);
		}
	});
}
// Trae los datos generales del pedido
function cargarPedido(DNI,pedidoID){
	abrirCargando();	
	opc = 'MP_01';
	$('#btnGuardar').hide();
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&DNI='+DNI+'&pedidoID='+pedidoID,
		url: url,
		success: function(rpta){
			// alert(rpta);
			bloqueoTotalForm('#formPedido',true);
			if(rpta!=0){
				var datos = rpta.split(",,");
				$('#txtDNI').val(datos[0]);
				$('#txtPaciente').val(datos[1]);
				$('#txtTelefono1').val(datos[2]);
				$('#txtSubTotal').val(datos[3]);
				$('#txtImporteIGV').val(datos[4]);
				$('#txtTotal').val(datos[5]);
				$('#txtPagado').val(datos[6]);
				$('#txtSaldo').val(datos[7]);
				$('#cboFormaPago').val(datos[8]);

				$('#txtNuevoSaldo').val(datos[7]);
			}
			if(datos[8]==''){
				$('#cboFormaPago').parent().addClass('has-error');
				$('#cboFormaPago').val(0);
				$('#cboFormaPago').attr('disabled',false);
			}
			if(datos[7] != 0){
				$('#formularioPago').show();
				// $('#tablaPagos_filter').parent('div').remove();
				// bloqueoTotalForm('#formFacturar',true);
				// $('#formularioPago').remove();
			}
			// if(datos[7] == 0){
			// 	// $('#tablaPagos_filter').parent('div').remove();
			// 	bloqueoTotalForm('#formFacturar',true);
			// 	$('#formularioPago').remove();
			// }
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});
}
// Trae los pagos que ya se han realizado
function traerPagos(pedidoID){
	abrirCargando();
	opc = 'TP_01';	
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&pedidoID='+pedidoID,
		url: url,
		success: function(rpta){
			$('#tablaPagos').DataTable().destroy();
			$('#cuerpoTablaPagos').html(rpta);
			$('#tablaPagos').DataTable(
				{
			   	"columnDefs": [
            { "targets": [ 0 ],"width": "20%", },						//Fecha
            { "targets": [ 1 ],"width": "20%", "orderable":false,},						//Importe
            { "targets": [ 2 ],"width": "30%", "searchable": false , "orderable":false,},	//Tipo Comprobante
            { "targets": [ 3 ],"width": "20%", "orderable":false,"searchable": false  },		//Numero
		      ]		      
				}
			);
			$('#tablaPagos_info').parent('div').remove();
		  $('#tablaPagos_paginate').parent('div').remove();
			$('#tablaPagos_filter').parent('div').remove();
  		$('#tablaPagos_length').parent('div').remove();
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});	
}
//Trae los servicios de el pedido
function traerServicios(pedidoID){
	abrirCargando();
	opc = 'TS_01';	
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&pedidoID='+pedidoID,
		url: url,
		success: function(rpta){			
			$('#tablaServiciosLab').DataTable().destroy();
			$('#cuerpoTablaServiciosLab').html(rpta);
			$('#tablaServiciosLab').DataTable(
				{
           "columnDefs": [
            { "targets": [ 0 ],"width": "50%", "orderable": false, "searchable": false,},
            { "targets": [ 1 ],"width": "15%", "orderable": false, },
            { "targets": [ 2 ],"width": "15%", "orderable": false, "searchable": false , },
            { "targets": [ 3 ],"width": "12%", "orderable": false, "searchable": false ,"type": "double"},
            { "targets": [ 4 ],"width": "8%", "orderable": false,"searchable": false ,}
          ]
        }
			);
			$('#tablaServiciosLab_filter').parent('div').remove();
		  $('#tablaServiciosLab_length').parent('div').remove();
		  $('#tablaServiciosLab_info').parent('div').remove();
		  $('#tablaServiciosLab_paginate').parent('div').remove();
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});	
}

// Guarda los pagos
function facturar(form,DNI,pedidoID){
	$('#btnFacturar').attr('disabled',true);
	var formaPagoID = $('#cboFormaPago').val();	
	var comprobante = $('#cboComprobante').val();	
	var nroSerie = $('#txtNroSerie').val();
	var nroComprobante = $('#txtNroComprobante').val();
	var importe = $('#txtPagar').val();		
	comboObligatorio('#cboComprobante',"0");
	inputObligatorio('#txtNroComprobante',0);
	if(comprobante!="000"){
		inputObligatorio('#txtNroComprobante',4);
		comboObligatorio('#cboComprobante',"0");
	}
	inputObligatorio('#txtPagar',1);
	calcularNuevoSaldo();
	if(formaPagoID == "CON" ){
		var nuevoSaldo = $('#txtNuevoSaldo').val();
		if(nuevoSaldo != 0){
			$('#txtNuevoSaldo').parent().addClass('has-error');			
		}else{
			$('#txtNuevoSaldo').parent().removeClass('has-error');
		}
	}
	if(document.getElementsByClassName("has-error").length > 0){
		alert("Verifique los datos ingresados");
		$('#btnFacturar').attr('disabled',false);
		return false;
	}
	
	opc = 'FAC_01';
	// $('#btnFacturar').hide();
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&DNI='+DNI+'&pedidoID='+pedidoID+'&comprobante='+comprobante+
				'&nroSerie='+nroSerie+'&nroComprobante='+nroComprobante
				+'&importe='+importe,
		url: url,
		success: function(rpta){
			if(rpta == 1){
				alert("Pago exitoso");				
				location.reload(true);
			}else{
				alert(rpta);
			}
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});
}
// Calcula el nuevo saldo
function calcularNuevoSaldo(){
	var saldo = parseFloat($('#txtSaldo').val());
	if($('#txtPagar').val() == ''){
		$('#txtNuevoSaldo').val(saldo);
		return false;
	}
	var saldo = parseFloat($('#txtSaldo').val());
	var pagar = parseFloat($('#txtPagar').val());

	var nuevoSaldo = saldo - pagar;
	$('#txtNuevoSaldo').val(nuevoSaldo);
	if(nuevoSaldo<0){
		$('#txtPagar').parent().addClass('has-error');
	}else{
		$('#txtPagar').parent().removeClass('has-error');
	}
}
// Actulaizar la forma de pago
function actualizarCampoPedidoServicio(pedidoID,campo){
	var pedidoID = pedidoID;
	var campo = campo;
	var nuevoValor = $('#cboFormaPago').val();	
	if(nuevoValor == 0){
		$('#cboFormaPago').parent().addClass('has-error');
		alert('No valido');
		return false;
	}else{
		$('#cboFormaPago').parent().removeClass('has-error');
	}
	opc = 'ACT_P_S';
	abrirCargando();
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&pedidoID='+pedidoID+'&campo='+campo+'&nuevoValor='+nuevoValor,				
		url: url,
		success: function(rpta){
			if(rpta ==1 ){
				$('#cboFormaPago').parent().removeClass('has-error');
				// $('#cboFormaPago').attr('disabled',true);
			}else{
				alert(rpta);
			}
			cerrarCargando();
			return;
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});	
}
// Carga todos los pagos de hoy
function cargarTablaPagos(){
	var fechaPago = $('#txtFechaCita').val();
	abrirCargando();
	opc = 'CTP_01';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&fechaPago='+fechaPago,
		url: url,
		success: function(rpta){			
			$('#tablaPagos').DataTable().destroy();
			$('#cuerpoTablaPagos').html(rpta);
			$('#tablaPagos').DataTable(
				// {
    //        "columnDefs": [
    //         { "targets": [ 0 ],"width": "50%", "orderable": false, "searchable": false,},
    //         { "targets": [ 1 ],"width": "15%", "orderable": false, },
    //         { "targets": [ 2 ],"width": "15%", "orderable": false, "searchable": false , },
    //         { "targets": [ 3 ],"width": "12%", "orderable": false, "searchable": false ,"type": "double"},
    //         { "targets": [ 4 ],"width": "8%", "orderable": false,"searchable": false ,}
    //       ]
    //     }
			);
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});
}
// Carga la tabla de todos los ppedidos que están pendientes de facturar
function cargarTablaPedidoPendiente(){	
	abrirCargando();
	opc = 'CTPP_01';	
	$.ajax({
		type: 'POST',
		data:'opc='+opc,
		url: url,
		success: function(rpta){
			// alert(rpta);
			$('#tablaPedidoPendiente').DataTable().destroy();
			$('#cuerpoTablaPedidoPendiente').html(rpta);
			$('#tablaPedidoPendiente').DataTable(
				{
           "columnDefs": [
            { "targets": [ 0 ],"width": "5%",  "searchable": false,}, //ID
            { "targets": [ 1 ],"width": "30%",  },											//Paciente
            { "targets": [ 2 ],"width": "7%","searchable": false , }, //Tipo
            { "targets": [ 3 ],"width": "8%", "orderable": false, "searchable": false ,"type": "double"},//Via
            { "targets": [ 4 ],"width": "10%","searchable": false ,},	//Ikmporte
            { "targets": [ 5 ],"width": "10%", "orderable": false,"searchable": false ,},	//importe Pagado
            { "targets": [ 6 ],"width": "15%","searchable": false ,},	//Forma Pago
            { "targets": [ 7 ],"width": "7%", "searchable": false ,}	,//Estado
            { "targets": [ 8 ],"width": "8%", "orderable": false,"searchable": false ,}
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