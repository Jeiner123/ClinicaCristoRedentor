var url = 'bd/bd_caja.php';

function abrirCaja(){	
	inputObligatorio('#txtSaldoInicial',1);
	var saldoInicial = $('#txtSaldoInicial').val();	
	var observaciones = $('#txtObservacionesI').val();
	opc = 'AP_CA_01';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&saldoInicial='+saldoInicial+'&observaciones='+observaciones,
		url: url,
		success: function(rpta){
			location.reload();
		}
	});
}
function cerrarCaja(form){	
	opc = 'CE_CA_01';
	$.ajax({
		type: 'POST',
		data:'opc='+opc,
		url: url,
		success: function(rpta){
			location.reload();
		}
	});
}
// // CARGAR TABLA REGISTROS - TRAE TODOS LO CIERRES DE CAJA
// function cargarTablaRegistros(){
// 	abrirCargando();
// 	opc = 'CT_REG_01';
// 	$.ajax({
// 		type: 'POST',
// 		data:'opc='+opc,
// 		url: url,
// 		success: function(rpta){
// 			alert(rpta);
// 		}
// 	});
// }