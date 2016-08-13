url = 'bd/bd_operaciones.php';

function cargarTablaPlanContable(){

	$('.tablaDatos').DataTable(
		{
	   	"columnDefs": [
            { "targets": [ 0 ],"width": "15%"}, 
            { "targets": [ 1 ],"width": "45%"},										 		//DNI
            { "targets": [ 2 ],"width": "15%"},											 //nomresb
            { "targets": [ 3 ],"width": "10%"},	
            { "targets": [ 4 ],"width": "15%"},
		      ]

		}
	);
}

function cargarCboNivel(valorDefecto){
	opc = 'CC_NIVEL';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: url,
			success: function(rpta){
				$('#cboNivel').html(rpta);
				$('#cboNivel').val(valorDefecto);
				cerrarCargando();
				return true;		
			},
			error: function(rpta){
				alert(rpta);
			}
		});
}

function cargarCboTipoCuenta(valorDefecto,estructuraID){
	opc = 'CC_TC';
		$.ajax({
			type: 'POST',
			data:'opc='+opc+'&estructuraID='+estructuraID,
			url: url,
			success: function(rpta){
				$('#cboTipoCuenta').empty();
				$('#cboTipoCuenta').html(rpta);
				$('#cboTipoCuenta').val(valorDefecto);
				funcionSelect('#cboTipoCuenta');
				$('#cboTipoCuenta').trigger("chosen:updated");
				cerrarCargando();		
			},
			error: function(rpta){
				alert(rpta);
			}
		});
}

function cargarCuentas(){
	estructuraID=parseInt($('#cboNivel').val())-1;
	cargarCboTipoCuenta(0,estructuraID);
}