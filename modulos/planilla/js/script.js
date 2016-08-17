url = 'bd/bd_operaciones.php';
// Mostrar Personal
function  mostrarPersonal (personalID){		
	abrirModal("#modalRegPersonal");
	abrirCargando();
	bloquearForm('#formPersonal',true);
	opc = 'MP_01';
	$('#btnGuardar').hide();
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&personalID='+personalID,
		url: url,
		success: function(rpta){			
			objeto = JSON.parse(rpta);
			$('#txtDNI').val(objeto[0]);
			$('#txtNombres').val(objeto[1]);
			$('#txtPaterno').val(objeto[2]);
			$('#txtMaterno').val(objeto[3]);
			$('#txtFechaN').val(objeto[4]);
			$('#cboSexo').val(objeto[5]);
			$('#txtTelefono1').val(objeto[6]);
			$('#cboTipoTelefono1').val(objeto[7]);
			$('#txtTelefono2').val(objeto[8]);
			$('#cboTipoTelefono2').val(objeto[9]);
			$('#txtCorreoP').val(objeto[10]);
			$('#txtDireccion').val(objeto[11]);

			$('#txtCodigo').val(objeto[14]);
			$('#txtFechaI').val(objeto[18]);
			$('#txtSueldo').val(objeto[20]);
			$('#cboTipoPersonal').val(objeto[15]);
			$('#cboArea').val(objeto[17]);
			$('#cboEstado').val(objeto[21]);
			$('#txtObsrvaciones').val(objeto[22]);
			opc = 'CC_CARG_01';
			$.ajax({
				type: 'POST',
				data:'opc='+opc+'&areaID='+objeto[17],
				url: '../'+url,
				success: function(rpta){
					$('#cboCargo').html(rpta);
					$('#cboCargo').val(objeto[16]);
					cerrarCargando();
				},
				error: function(rpta){
					alert(rpta);
				}
			});					
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});	
}
// Guardar personal
function guardarPersonal(form){
	// Validaciones
	flag = $.trim($('#txtFlag').val());
	if(flag==''){
		alert("Hay problemas en el formulario.");
		return false;
	}
	comboObligatorio('#txtDNI',8);
	comboObligatorio('#cboTipoTelefono1',0);
	comboObligatorio('#cboTipoPersonal',0);
	comboObligatorio('#cboArea',0);
	comboObligatorio('#cboCargo',0);
	comboObligatorio('#cboEstado',0);
	inputObligatorio('#txtNombres',4);
	inputObligatorio('#txtPaterno',2);
	inputObligatorio('#txtMaterno',2);
	if($.trim($('#txtTelefono1').val()).length>0 && $('#cboTipoTelefono1').val()==0 ){
		$('#cboTipoTelefono1').parent().addClass('has-error');
	}else{
		$('#cboTipoTelefono1').parent().removeClass('has-error');
	}
	if(document.getElementsByClassName("has-error").length > 0){
		alert("Verifique los datos ingresados");
		return false;
	}	
	var formData = new FormData($('#formPersonal')[0]);
	if(flag == 'N'){
		formData.append("opc", "PL_02");   //Agregar nuevo
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
			if(rpta==1){
				alert("Registro exitoso");
				limpiarForm(form);
				cerrarModal('#modalRegPersonal');
				cargarTablaPersonal();
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
function cargarTablaPersonal() {
	abrirCargando();
	var opc = 'CT_P_01';
	var tipoPersonal = 'T';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&tipoPersonal='+tipoPersonal,
		url: url,
		success: function(rpta){
			$('.tablaDatos').DataTable().destroy();
			$('#cuerpoTablaPersonal').html(rpta);
			$('.tablaDatos').DataTable(
				{
			   	"columnDefs": [
            { "targets": [ 0 ],"width": "8%","searchable": false,}, 		//Codigo
            { "targets": [ 1 ],"width": "10%"},										 		//DNI
            { "targets": [ 2 ],"width": "30%"},											 //nomresb
            { "targets": [ 3 ],"width": "15%", "searchable": false ,},	//telefono
            { "targets": [ 4 ],"width": "12%", "searchable": false ,},	//tipo personal
            { "targets": [ 5 ],"width": "10%","searchable": false , },	//Especia
            { "targets": [ 6 ],"width": "10%","searchable": false , }, //Estado
		      ]
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
// Verificar existencia de DNI

// Modificar al personal
function modificarPersonal(personalID){
	mostrarPersonal(personalID);
	bloquearForm('#formPersonal',false);
	$('#btnGuardar').show();
	$("#txtDNI").attr("disabled",true);
	$("#txtCodigo").attr("disabled",true);
	$('#txtFlag').val('M');
}
// Cargar la tabla de todos los personales para asignacion de especialidades (Medicos y personal de salud)
function cargarTablaMedicos(){
	abrirCargando();
	var opc = 'CT_P_01';
	var tipoPersonal = 2;
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&tipoPersonal='+tipoPersonal,
		url: url,
		success: function(rpta){
			$('.tablaDatos').DataTable().destroy();
			$('#cuerpoTablaPersonal').html(rpta);
			$('.tablaDatos').DataTable(
				{
			   	"columnDefs": [
            { "targets": [ 0 ],"width": "7%","searchable": false,}, 		//Codigo
            { "targets": [ 1 ],"width": "10%", "orderable": false},										 		//DNI
            { "targets": [ 2 ],"width": "40%"},											 //nomresb
            { "targets": [ 3 ],"width": "0%", "searchable": false ,"visible":false,},	//telefono
            { "targets": [ 4 ],"width": "15%", "searchable": false ,},	//tipo personal
            { "targets": [ 5 ],"width": "5%","searchable": false , "orderable": false},	//Estado
            { "targets": [ 6 ],"width": "0%","searchable": false ,"visible":false, }, //Operaciones
		      ]
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
// Abrir modal parala asignacion
function asignarEspec(){
	if($('#tablaPersonal').DataTable().cell('.active',5).data()==null){
		alert("Seleccione un personal");
		return false;
	}
	var codigo = $('#tablaPersonal').DataTable().cell('.active',0).data();
	var personal = $('#tablaPersonal').DataTable().cell('.active',2).data();	
	abrirModal('#modalRegAsignacion');
	$('#txtCodigo').val(codigo);	$('#txtCodigo').attr("disabled",true);
	$('#txtPersonal').val(personal);	$('#txtPersonal').attr("disabled",true);
}	
// Guarda la asignacion en la base de datos
function guardarAsignacion(){
	personalID = $('#txtCodigo').val();
	especialidadID = $('#cboEspecialidad').val();
	var opc = 'GAE_02';
	$.ajax({
		type: 'POST',
		data: 'opc='+opc+'&personalID='+personalID+'&especialidadID='+especialidadID,
		url: url,
		success: function(rpta){
			if(rpta==1){
				alert("operación exitosa");
				cargarEspecialidadesMedico(personalID);
				cerrarModal('#modalRegAsignacion');								
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
// ELIMINAR UNA ASIGNACION
function eliminarAsignacion(personalID,especialidadID){
	r = confirm("Seguro que desea eliminar la asignación");
	if (r != true){
	  return false;
	}
	var opc = 'EAE_03';
	$.ajax({
		type: 'POST',
		data: 'opc='+opc+'&personalID='+personalID+'&especialidadID='+especialidadID,
		url: url,
		success: function(rpta){
			if(rpta==1){
				alert("operación exitosa");
				cargarEspecialidadesMedico(personalID);
				return true;
			}
			alert(rpta);			
		},
		error: function(rpta){
			alert(rpta);			
		}
	});
}
//Carga las especialidades del medico desde la base de datos
function cargarEspecialidadesMedico(personalID){
	var personalID = $('#tablaPersonal').DataTable().cell('.active',0).data();
	var opc = 'CEM_01';
	$.ajax({
		type: 'POST',
		data: 'opc='+opc+'&personalID='+personalID,
		url: url,
		success: function(rpta){
			$('#tablaEspecialidadesAsig').DataTable().destroy();
			$('#cuerpoTablaEspecialidadesAsig').html(rpta);
			$('#tablaEspecialidadesAsig').DataTable(
					{
				   	"columnDefs": [
		          { "targets": [ 0 ],"width": "95%","searchable": false,"orderable": false,}, 		
		          { "targets": [ 1 ],"width": "5%","orderable": false},
			      ]
			      // "order": [[ 3, "asc" ]]
					}
			);
			cerrarCargando();
			 $('#tablaEspecialidadesAsig_filter').parent('div').remove();
		  $('#tablaEspecialidadesAsig_length').parent('div').remove();
		  $('#tablaEspecialidadesAsig_info').parent('div').remove();
		  $('#tablaEspecialidadesAsig_paginate').parent('div').remove();
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});
}

