var url = 'bd/bd_operaciones.php';

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
			if(datos[7] == 0){
				// $('#tablaPagos_filter').parent('div').remove();
				bloqueoTotalForm('#formFacturar',true);
				$('.opcionesPago').hide("slow");
			}
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
            { "targets": [ 2 ],"width": "30%", "searchable": false , "orderable":false,},	//Tipo documento
            { "targets": [ 3 ],"width": "20%", "orderable":false,"searchable": false  },		//Numero
		      ]		      
				}
			);
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
			$('#tablaPagos').DataTable().destroy();
			$('#cuerpoTablaPagos').html(rpta);
			$('#tablaPagos').DataTable(
				{
			   	"columnDefs": [
            { "targets": [ 0 ],"width": "20%", },						//Fecha
            { "targets": [ 1 ],"width": "20%", "orderable":false,},						//Importe
            { "targets": [ 2 ],"width": "30%", "searchable": false , "orderable":false,},	//Tipo documento
            { "targets": [ 3 ],"width": "20%", "orderable":false,"searchable": false  },		//Numero
		      ]		      
				}
			);
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
// activa el campo para permitir el numero de documento
function permitirDocumento(){
	var documento = $('#cboDocumento').val();
	if(documento == 'B' || documento == 'F'){
		$('#txtNroDocumento').attr('disabled',false);
	}else{
		$('#txtNroDocumento').attr('disabled',true);
		$('#txtNroDocumento').val("");
		inputObligatorio('#txtNroDocumento',0);
	}
}
// Guarda los pagos
function facturar(form,DNI,pedidoID){	
	var formaPagoID = $('#cboFormaPago').val();	
	var documento = $('#cboDocumento').val();	
	var nroDocumento = $('#txtNroDocumento').val();
	var importe = $('#txtPagar').val();
	if(documento!='N'){
		inputObligatorio('#txtNroDocumento',4);
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
		return false;
	}
	
	opc = 'FAC_01';
	// $('#btnFacturar').hide();
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&DNI='+DNI+'&pedidoID='+pedidoID+'&documento='+documento+'&nroDocumento='+nroDocumento
				+'&importe='+importe,
		url: url,
		success: function(rpta){			
			alert(rpta);
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
