var url = 'bd/bd_operaciones.php';
// ESPECIALIDADES
function cargarTablaEspecialidades(){
	var opc = 'E_01';
	abrirCargando();
	$.ajax({
		type: 'POST',
		data:'opc='+opc,
		url: url,
		success: function(rpta){			
			$('.tablaDatos').DataTable().destroy();
			$('#cuerpoTablaEspecialidades').html(rpta);
			$('.tablaDatos').DataTable(
				{
			   	"columnDefs": [
            { "targets": [ 0 ],"width": "10%",  "searchable": false,},
            { "targets": [ 1 ],"width": "55%", },
            { "targets": [ 2 ],"width": "15%",  "searchable": false , },
            { "targets": [ 3 ],"width": "5%",  "searchable": false ,},
            { "targets": [ 4 ],"width": "15%", "orderable": false,"searchable": false ,}
            
		      ],
		      "order": [[ 1, "asc" ]]
				}
			);
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
		}
	});
}
function guardarEspecialidad(form){
	// Validaciones
	flag = $.trim($('#txtFlag').val());
	if(flag!='N' && flag !='M'){
		alert("Hay problemas con el formulario");
		return false;
	}
	inputObligatorio('#txtEspecialidad',4);
	comboObligatorio('#cboEstado',0)
	var numErrores = document.getElementsByClassName("has-error").length;
	if(numErrores>0){
		alert("Verifique los datos ingresados");			
		return false;
	}	
	var formData = new FormData($('#formEspecialidad')[0]);		
	if(flag == 'N'){
		formData.append("opc", "E_02");   //Nuevo
	}
	if(flag == 'M'){
		formData.append("opc", "E_03");   //Modificar
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
				limpiarForm(form);
				cerrarModal('#modalRegEspec');
				cargarTablaEspecialidades();				
				alert("Registro exitoso");
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
function mostrarEspecialidad(especialidadID,especialidad,estado){
	abrirModal('#modalRegEspec');
	$('#txtEspecialidadID').val(especialidadID);
	$('#txtEspecialidad').val(especialidad);
	$('#cboEstado').val(estado);
	$('.btnGuardar').hide();
}
function modificarEspecialidad(especialidadID,especialidad,estado){
	mostrarEspecialidad(especialidadID,especialidad,estado);
	$('#txtFlag').val('M');
	$('.btnGuardar').show();
}
function eliminarEspecialidad(especialidadID){
	r = confirm("¿Seguro que desea eliminar la especialidad?");
	if (r == true) {
	  editarEstadoEspecialidad(especialidadID,3);
	} else {
	    return ;
	}
}
function editarEstadoEspecialidad(especialidadID,estado){	
  opc = 'E_04';
  abrirCargando();
  $.ajax({
		type: 'POST',
		data: 'opc='+opc+'&especialidadID='+especialidadID+'&estado='+estado,
		url: url,
		success: function(rpta){
			if(rpta==1){
				alert("Operación exitosa");
				cargarTablaEspecialidades();
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
// SERRVICIOS
function cargarTablaServicios(){
	var opc = 'S_01';
	abrirCargando();
	$.ajax({
		type: 'POST',
		data:'opc='+opc,
		url: url,
		success: function(rpta){
			$('.tablaDatos').DataTable().destroy();
			$('#cuerpoTablaServicios').html(rpta);
			$('.tablaDatos').DataTable(
				{
			   	"columnDefs": [
            { "targets": [ 0 ],"width": "5%",  "searchable": false,},
            { "targets": [ 1 ],"width": "52%", },
            { "targets": [ 2 ],"width": "13%", },
            { "targets": [ 3 ],"width": "20%",},            
            { "targets": [ 4 ],"width": "%","visible": false, "searchable": false ,},
            { "targets": [ 5 ],"width": "15%",},
            { "targets": [ 6 ],"width": "%","visible": false, "searchable": false ,},
            { "targets": [ 7 ],"width": "5%",},
            { "targets": [ 8 ],"width": "10%","orderable": false,}
		      ],
		      "order": [[ 0, "asc" ]]
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
function guardarServicio(form){
	// Validaciones
	flag = $.trim($('#txtFlag').val());
	if(flag!='N' && flag !='M'){
		alert("Hay problemas con el formulario");
		return false;
	}
	inputObligatorio('#txtServicio',2)
	inputObligatorio('#txtPrecio',2)
	comboObligatorio('#cboEspecialidad',0);
	comboObligatorio('#cboTipoServicio',0);
	comboObligatorio('#cboEstado',0);
	var numErrores = document.getElementsByClassName("has-error").length;
	if(numErrores>0){
		alert("Verifique los datos ingresados");
		return false;
	}	
	var formData = new FormData($('#formEspecialidad')[0]);		
	if(flag == 'N'){
		formData.append("opc", "S_02");   //Agregar nuevo
	}
	if(flag == 'M'){
		formData.append("opc", "S_03");   //Modificar
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
				alert("Operación exitosa");
				limpiarForm(form);
				cerrarModal('#modalRegServicio');
				cargarTablaServicios();
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
function mostrarServicio(servicioID){		
	abrirModal("#modalRegServicio");
	bloqueoTotalForm('#formEspecialidad',true);
	$('#btnGuardar').hide();
	opc = 'S_05';
	abrirCargando();
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&servicioID='+servicioID,
		url: url,
		success: function(rpta){
			objeto = JSON.parse(rpta);
			$('#txtServicioID').val(objeto[0]);
			$('#txtServicio').val(objeto[1]);
			$('#txtPrecio').val(objeto[2]);
			$('#cboEstado').val(objeto[3]);
			$('#cboEspecialidad').val(objeto[5]);
			$('#cboTipoServicio').val(objeto[4]);
			
			$('#tituloServicio').html(objeto[1]);
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});
}
function modificarServicio(servicioID){
	mostrarServicio(servicioID);
	$('#txtFlag').val('M');	
	$('#btnGuardar').show();
	$('#cboEspecialidad').attr('disabled',false);
	$('#cboTipoServicio').attr('disabled',false);
	$('#cboEstado').attr('disabled',false);	
	// bloqueoTotalForm('#formEspecialidad',false);
}
function eliminarServicio(servicioID){
	r = confirm("¿Seguro que desea eliminar el servicio?");
	if (r == true) {
	  editarEstadoServicio(servicioID,3);
	} else {
	    return ;
	}
};
function editarEstadoServicio(servicioID,estado){	
  opc = 'S_04';
  abrirCargando();
  $.ajax({
		type: 'POST',
		data: 'opc='+opc+'&servicioID='+servicioID+'&estado='+estado,
		url: url,
		success: function(rpta){
			if(rpta==1){
				alert("Operación exitosa");
				cargarTablaServicios();
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
};
