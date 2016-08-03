url = 'bd/bd_operaciones.php';


function mantenerProveedor(form){
	comboObligatorio('#cboEntidad',0);
	comboObligatorio('#cboDocumento',0);

	if($("#cboDocumento").val()==1){
		inputMismoValor('#txtDocumento',8);	
	}
	if($("#cboDocumento").val()==3){
		inputMismoValor('#txtDocumento',11);	
		inputObligatorio('#txtRazonSocial',4);
		inputObligatorio('#txtDireccion',4);
	}

	inputObligatorio('#txtNombre',2);
	inputObligatorio('#txtApellidoPat',4);
	inputObligatorio('#txtApellidoMat',4);
	inputObligatorio('#txtTelefono',9);

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
	var formData = new FormData($('#formPersonal')[0]);
	formData.append("opc", "CC_01");
	$.ajax({
		type: 'POST',
		data: formData,
		url: url,
		contentType :false,
		processData: false,
		success: function(rpta){
			alert(rpta);
			cargarTablaProveedor();
		},
		error: function(rpta){
			alert(rpta);
			
		}
	});
	
}

function updateProveedor(){
	var formData = new FormData($('#formPersonal')[0]);
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
	if($("#cboDocumento").val()!=3){
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
		            { "targets": [ 0 ],"width": "5%"}, 		//Codigo
		            { "targets": [ 1 ],"width": "10%"},										 		//DNI
		            { "targets": [ 2 ],"width": "20%"},											 //nomresb
		            { "targets": [ 3 ],"width": "20%"},	//telefono
		            { "targets": [ 4 ],"width": "15%"},	//tipo personal
		            { "targets": [ 5 ],"width": "20%"},	//Especia
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

function crearProveedor(){
	$("#txtFlag").val("N");
	abrirModal('#modalRegProveedor');
	$('#cboEntidad').prop("disabled", false);
	$('#cboDocumento').prop("disabled", false);
	$("#txtDocumento").prop("readonly", false);
	$("#titulo").text("Registrar nuevo proveedor");
}

function modificarProveedor(){
	if($('#tablaProveedor').DataTable().cell('.active',5).data()==null){
		alert("Seleccione un proveedor");
		return false;
	}
	documento=$('#tablaProveedor').DataTable().cell('.active',1).data();


	var opc = 'CC_03';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&documento='+documento,
		url: url,
		success: function(data){
			var datos= JSON.parse(data);

			abrirModal('#modalRegProveedor');
			$('#cboEntidad').prop("disabled", true);
			$('#cboDocumento').prop("disabled", true);
			$("#txtDocumento").prop("readonly", true);
			for(var i in datos){
                	$("#cboEntidad").val(datos[i].tipoEntidad);
                	$("#cboDocumento").val(datos[i].tipoDocumento);
                	$("#txtDocumento").val(datos[i].proveedorID);
                	$("#txtRazonSocial").val(datos[i].razonSocial);
                	$("#txtDireccion").val(datos[i].direccion);
                	$("#txtEmailE").val(datos[i].emailEmpresa);
                	$("#cboBanco").val(datos[i].banco);
                	$("#txtDetraccion").val(datos[i].cuentaBanco);
                	$("#txtNombre").val(datos[i].nombres);
                	$("#txtApellidoPat").val(datos[i].apellidoPat);
                	$("#txtApellidoMat").val(datos[i].apellidoMat);
                	$("#txtTelefono").val(datos[i].telefono);
                	$("#txtEmail").val(datos[i].emailPersonal);
                	$("#txtObservaciones").val(datos[i].observaciones);
              
                }
			$("#titulo").text("Editar proveedor");
			$("#txtFlag").val("M");
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});

	
}


