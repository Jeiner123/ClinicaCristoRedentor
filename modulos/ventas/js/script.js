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
			var numFilas = $('#tablaPedidos >tbody >tr').length;   //Numero de pedidos
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
			$('#txtNumeroPedidos').val(numFilas);
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
 	var estadoCita = $('#cboEstadoCita').val();
 	var estadoPago = $('#cboEstadoPagoCita').val();
 	var medicoID = $('#cboMedicos').val();
 	if(medicoID == null) medicoID = '0';
	abrirCargando();
	opc = 'CT_CIT_01';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&anio='+anio+'&mes='+mes+'&estadoCita='+estadoCita+'&estadoPago='+estadoPago+'&medicoID='+medicoID,
		url: url,
		success: function(rpta){						
			$('#tablaCitas').DataTable().destroy();
			$('#cuerpoTablaCitas').html(rpta);
			var numFilas = $('#tablaCitas >tbody >tr').length;   //Numero de citas
			$('#tablaCitas').DataTable(
				{
           "columnDefs": [
            { "targets": [ 0 ],"width": "3%", "searchable": false,}, //#
            { "targets": [ 1 ],"width": "4%",	"orderable": false, },											//PedidoID
            { "targets": [ 2 ],"width": "8%", "orderable": false, "searchable": false , }, //Fecha
            { "targets": [ 3 ],"width": "20%","orderable": false, "searchable": false ,},//Paciente
            { "targets": [ 4 ],"width": "8%","orderable": false,"searchable": false ,},	//Tipo
            { "targets": [ 5 ],"width": "5%", "orderable": false,"searchable": false ,},	//especialidad
            { "targets": [ 6 ],"width": "25%", "orderable": false,"searchable": false ,},	//Servicio
            { "targets": [ 7 ],"width": "14%", "orderable": false,"searchable": false ,}, //Medico
            { "targets": [ 8 ],"width": "6%", "orderable": false,"searchable": false ,},	//Importe 
            { "targets": [ 9 ],"width": "7%", "orderable": false,"searchable": false ,}	//Estado
          ]
        }
			);
			$('#txtNumeroCitas').val(numFilas);
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});
}
//CARGAR TABLA DE REFERENCIAS
function cargarTablaReferencias(){
	abrirCargando();
	// fecha = $("#txtFechaCita").val();
	// estadoPago = $("#cboEstadoPago").val();
	var mes = $("#cboMes").val();
	var anio = $("#cboAnio").val();
	var personalID = $("#cboMedicosReferencia").val();
	var especialidadID = $("#cboEspecialidades").val();
	if(personalID == null)personalID = 0;
	if(especialidadID == null)especialidadID = -1;

	var opc = 'CTR_01';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&mes='+mes+'&anio='+anio+'&personalID='+personalID+'&especialidadID='+especialidadID,
		url: url,
		success: function(rpta){			
			$('#tablaReferencias').DataTable().destroy();			
			$('#cuerpoTablaReferencias').html(rpta);
			var numFilas = $('#tablaReferencias >tbody >tr').length;   //Numero de referencias			
			$('#tablaReferencias').DataTable(
					{
				   	"columnDefs": [
				   		{ "targets": [ 0 ],"width": "4%",},						//Pedido ID
	            { "targets": [ 1 ],"width": "27%",},						//Medico
	            { "targets": [ 2 ],"width": "27%", },						//Servicio
	            { "targets": [ 3 ],"width": "18%",  "searchable": false , },	//Especialidad
	            { "targets": [ 4 ],"width": "10%",  "searchable": false ,},		//Estado cita 
	            { "targets": [ 5 ],"width": "7%","searchable": false ,},	//Estado pago 
	            { "targets": [ 6 ],"width": "7%","searchable": false ,}	//Estado pago 
			      ],
			      "order": [[ 0, "asc" ]]
			      
					}
			);
			$('#txtNumeroFilas').val(numFilas);
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
		}
	});
}
// CARGAR TABLA DE PAGOS 
function cargarTablaPagos(){
	var mes = $("#cboMes").val();
	var anio = $("#cboAnio").val();
	abrirCargando();
	opc = 'CTP_01';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&mes='+mes+'&anio='+anio,
		url: url,
		success: function(rpta){			
			$('#tablaPagos').DataTable().destroy();
			$('#cuerpoTablaPagos').html(rpta);
			var numFilas = $('#tablaPagos >tbody >tr').length;   //Numero de citas
			$('#tablaPagos').DataTable(
				{
           "columnDefs": [
           	{ "targets": [ 0 ],"width": "5", "searchable": false,},	//Peidod
            { "targets": [ 1 ],"width": "5", "searchable": false,},	//Peidod
            { "targets": [ 2 ],"width": "10%", "orderable": false, },		//fecha
            { "targets": [ 3 ],"width": "33%",  "searchable": false , },	//Pacinete
            { "targets": [ 4 ],"width": "10%", "orderable": false, "searchable": false ,"type": "double"},	//Teleofno
            { "targets": [ 5 ],"width": "15%","searchable": false ,},	//Comprobante
            { "targets": [ 6 ],"width": "15%", "orderable": false,"searchable": false ,},	//numero com
            { "targets": [ 7 ],"width": "7%","searchable": false ,}, //Importe             
          ]
        }
			);
			$('#txtNumeroPagos').val(numFilas);
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});
}