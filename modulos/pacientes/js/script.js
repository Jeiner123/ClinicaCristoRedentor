url = 'bd/bd_operaciones.php';

//Guardar personal
function guardarPaciente(form){
	// Validaciones
	flag = $.trim($('#txtFlag').val());
	if(flag==''){
		alert("Hay problemas en el formulario.");
		return false;
	}
	comboObligatorio('#txtDNI',8);
	comboObligatorio('#cboTipoTelefono1',0);
	comboObligatorio('#cboEstado',0);
	// comboObligatorio('#cboProcedencia',0);
	inputObligatorio('#txtNombres',4);
	inputObligatorio('#txtPaterno',2);
	inputObligatorio('#txtMaterno',2);
	inputObligatorio('#txtFechaN',2);	
	inputObligatorio('#txtTelefono1',4);
	if(document.getElementsByClassName("has-error").length > 0){
		alert("Verifique los datos ingresados");
		return false;
	}	
	var formData = new FormData($('#formPaciente')[0]);
	if(flag == 'N'){
		formData.append("opc", "PA_02");   //Agregar nuevo
	}
	if(flag == 'M'){
		formData.append("opc", "PL_03");   //Modificar
	}
	abrirCargando();
	$.ajax({
		type: 'POST',
		data: formData,
		url: url,
		contentType :false,
		processData: false,
		success: function(rpta){			
			if(rpta>0){
				alert("Registro exitoso");
				$('#txtNroHistoria').val(rpta);
				// limpiarForm(form);
				// cargarTablaPersonal();
				cerrarCargando();
				return true;
			}
			alert(rpta);
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});
}
// Cargar la tabla de todos los personales
function cargarTablaPacientes(){
	abrirCargando();
	var opc = 'CTP_01';	
	$.ajax({
		type: 'POST',
		data:'opc='+opc,
		url: url,
		success: function(rpta){
			$('.tablaDatos').DataTable().destroy();
			$('#cuerpoTablaPacientes').html(rpta);
			$('.tablaDatos').DataTable(
				{
			   	"columnDefs": [
            { "targets": [ 0 ],"width": "10%","searchable": false,}, 		//Historia
            { "targets": [ 1 ],"width": "8%"},										 		//DNI
            { "targets": [ 2 ],"width": "26%"},											 //nomresb
            { "targets": [ 3 ],"width": "8%"},											 //Edad
            { "targets": [ 4 ],"width": "16%", "searchable": false ,"orderable":false},	//telefono
            { "targets": [ 5 ],"width": "13%"},											 //ultima visita
            { "targets": [ 6 ],"width": "8%", "searchable": false ,},	//Estado
            { "targets": [ 7 ],"width": "11%","searchable": false ,"orderable":false },	//Operaciones
		      ],
		      "iDisplayLength": 25
		      // "order": [[ 3, "asc" ]]
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
// Cargar los dato del paciente y mostrarlos en el formulario
function mostrarPaciente(historia){	
	abrirCargando();
	// bloquearForm('#formPersonal',true);
	opc = 'MPAC_02';
	$('#btnGuardar').hide();
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&historia='+historia,
		url: url,
		success: function(rpta){
			// alert(rpta);
			// limpiarForm(form);
			bloqueoTotalForm('#formPaciente',true);
			
			if(rpta!=0){
				var datos = rpta.split(",,");
				$('#txtDNI').val(datos[0]);
				$('#txtNombres').val(datos[1]);	
				$('#txtPaterno').val(datos[2]);	
				$('#txtMaterno').val(datos[3]);	
				$('#txtFechaN').val(datos[4]);	
				$('#cboSexo').val(datos[5]);		
				$('#txtTelefono1').val(datos[6]); 	
				$('#cboTipoTelefono1').val(datos[7]);	
				$('#txtTelefono2').val(datos[8]);	
				$('#cboTipoTelefono2').val(datos[9]);	
				$('#txtCorreoP').val(datos[10]);
				$('#txtRUC').val(datos[11]);	
				$('#txtDireccion').val(datos[12]);

				$('#txtNroHistoria').val(datos[13]);
				$('#cboProcedencia').val(datos[14]);
				$('#cboEstado').val(datos[15]);
				$('#txtObservaciones').val(datos[16]);
			}

			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});	
}
function modificarPaciente(historia){

}
