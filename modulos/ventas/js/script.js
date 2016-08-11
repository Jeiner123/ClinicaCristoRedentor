var url = 'bd/bd_operaciones.php';

//CARGAR LA TABLA DE LOS PEDIDOS
function cargarTablaPedidos(){
	var anio = $('#cboAnio').val();
	var mes = $('#cboMes').val();
 	var estado = $('#cboEstadoPedido').val();
 	var tipo = $('#cboTipoPedido').val(); 	
	abrirCargando();
	opc = 'CT_PED_01';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&anio='+anio+'&mes='+mes+'&estado='+estado+'&tipo='+tipo,
		url: url,
		success: function(rpta){			
			$('#tablaPedidos').DataTable().destroy();
			$('#cuerpoTablaPedidos').html(rpta);
			$('#tablaPedidos').DataTable(
				{
           "columnDefs": [
            { "targets": [ 0 ],"width": "4%", "searchable": false,}, //#
            { "targets": [ 1 ],"width": "4%",	"orderable": false, },											//PedidoID
            { "targets": [ 2 ],"width": "9%", "orderable": false, "searchable": false , }, //Fecha
            { "targets": [ 3 ],"width": "22%","orderable": false, "searchable": false ,"type": "double"},//Paciente
            { "targets": [ 4 ],"width": "10%","orderable": false,"searchable": false ,},	//Tipo
            { "targets": [ 5 ],"width": "5%", "orderable": false,"searchable": false ,},	//IGV
            { "targets": [ 6 ],"width": "7%", "orderable": false,"searchable": false ,},	//Importe sin IGV
            { "targets": [ 7 ],"width": "7%", "orderable": false,"searchable": false ,}, //Importe IGV
            { "targets": [ 8 ],"width": "8%", "orderable": false,"searchable": false ,},	//Importe Total
            { "targets": [ 9 ],"width": "7%", "orderable": false,"searchable": false ,},	//Importe Pagado
            { "targets": [ 10 ],"width":"10%","orderable": false,"searchable": false ,},	//Forma de pago
            { "targets": [ 11 ],"width":"7%", "searchable": false ,},	//Estado

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
//CARGAR LA TABLA DE CITAS
function cargarTablaCitas(){
	var anio = $('#cboAnio').val();
	var mes = $('#cboMes').val();
 	var estado = $('#cboEstadoPedido').val();
 	var tipo = $('#cboTipoPedido').val(); 	
	abrirCargando();
	opc = 'CT_PED_01';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&anio='+anio+'&mes='+mes+'&estado='+estado+'&tipo='+tipo,
		url: url,
		success: function(rpta){			
			$('#tablaPedidos').DataTable().destroy();
			$('#cuerpoTablaPedidos').html(rpta);
			$('#tablaPedidos').DataTable(
				{
           "columnDefs": [
            { "targets": [ 0 ],"width": "4%", "searchable": false,}, //#
            { "targets": [ 1 ],"width": "4%",	"orderable": false, },											//PedidoID
            { "targets": [ 2 ],"width": "9%", "orderable": false, "searchable": false , }, //Fecha
            { "targets": [ 3 ],"width": "22%","orderable": false, "searchable": false ,"type": "double"},//Paciente
            { "targets": [ 4 ],"width": "10%","orderable": false,"searchable": false ,},	//Tipo
            { "targets": [ 5 ],"width": "5%", "orderable": false,"searchable": false ,},	//IGV
            { "targets": [ 6 ],"width": "7%", "orderable": false,"searchable": false ,},	//Importe sin IGV
            { "targets": [ 7 ],"width": "7%", "orderable": false,"searchable": false ,}, //Importe IGV
            { "targets": [ 8 ],"width": "8%", "orderable": false,"searchable": false ,},	//Importe Total
            { "targets": [ 9 ],"width": "7%", "orderable": false,"searchable": false ,},	//Importe Pagado
            { "targets": [ 10 ],"width":"10%","orderable": false,"searchable": false ,},	//Forma de pago
            { "targets": [ 11 ],"width":"7%", "searchable": false ,},	//Estado

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