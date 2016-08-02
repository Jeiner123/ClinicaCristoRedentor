function  cargarTablaRegistrosReq(){
	abrirCargando();
	var control_documento = $('#control_documento').val();	
	var opc = 'LRR_01';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&control_documento='+control_documento,
		url: 'bd/bd_operaciones.php',
		success: function(rpta){
			$('#tablaRegistroReq').DataTable().destroy();
			$('#cuerpoTablaRegistroReq').html(rpta);
			$('#tablaRegistroReq').DataTable(
					{
				   	"columnDefs": [
	            { "targets": [ 0 ],"width": "8%",},
	            { "targets": [ 1 ],"width": "7%", },
	            { "targets": [ 2 ],"width": "37%",},
	            { "targets": [ 3 ],"width": "10%",},
	            { "targets": [ 4 ],"width": "10%",},
	            { "targets": [ 5 ],"width": "13%", },
	            { "targets": [ 6 ],"width": "10%", },
	            { "targets": [ 7 ],"width": "5%","orderable": false , },
	            
			      ]
			      // "order": [[ 3, "asc" ]]  ------ "searchable": false ,
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
function cargarCboControlDocumento(){
	abrirCargando();
	opc = 'LCD_01';
	$.ajax({
		type: 'POST',
		data:'opc='+opc,
		url: 'bd/bd_operaciones.php',
		success: function(rpta){			
			if(rpta=="\"\""){
				cerrarCargando();
				return false;
			}
			html = "<option value='0'>-- Seleccionar --</option>";
			rpta = JSON.parse(rpta);

			$.each(rpta, function(i,o){
				html += "<option value='"+o.controlDocumentoID+"'>"+o.titulo+"</option>";
			});

			$('#cboControlDocumento').html(html);
			cerrarCargando();
			return true;
		},
		error: function(rpta){
			alert(rpta);
		}
	});
}
function guardarRegistroRequerido(form){
	// Validaciones
		flag = $.trim($('#txtFlag').val());
		if(flag == ''){
			alert("Se produjo un error en el formulario - Variable bandera");
			return false;
		}			
		if($('#cboEstado').val()==0){
			$('#cboEstado').parent().addClass('has-error');
		}else{
			$('#cboEstado').parent().removeClass('has-error');
		}
		if($('#cboControlDocumento').val()==0){
			$('#cboControlDocumento').parent().addClass('has-error');
		}else{
			$('#cboControlDocumento').parent().removeClass('has-error');
		}
		if($('#cboArea').val()==0){
			$('#cboArea').parent().addClass('has-error');
		}else{
			$('#cboArea').parent().removeClass('has-error');
		}
		if($('#cboFrecuencia').val()==0){
			$('#cboFrecuencia').parent().addClass('has-error');
		}else{
			$('#cboFrecuencia').parent().removeClass('has-error');
		}

		if($.trim($('#txtCodigo').val()).length<1){
			$('#txtCodigo').parent().addClass('has-error');
		}else{
			$('#txtCodigo').parent().removeClass('has-error');
		}		
		if($.trim($('#txtAreaResponsable').val()).length<1){
			$('#txtAreaResponsable').parent().addClass('has-error');
		}else{
			$('#txtAreaResponsable').parent().removeClass('has-error');
		}
		if($.trim($('#txtRevisionN').val()).length<1){
			$('#txtRevisionN').parent().addClass('has-error');
		}else{
			$('#txtRevisionN').parent().removeClass('has-error');
		}
		if($.trim($('#txtTitulo').val()).length<1){
			$('#txtTitulo').parent().addClass('has-error');
		}else{
			$('#txtTitulo').parent().removeClass('has-error');
		}
		if($.trim($('#txtFormato').val()).length<1){
			$('#txtFormato').parent().addClass('has-error');
		}else{
			$('#txtFormato').parent().removeClass('has-error');
		}
		
		var numErrores = document.getElementsByClassName("has-error").length;
		if(numErrores>0){
			alert("Verifique los datos ingresados");			
			return false;
		}
		abrirCargando();
		var formData = new FormData($('#formRegistroReq')[0]);		
		if(flag == 'N'){
			formData.append("opc","RR_02");   //Agregar nuevo
		}
		if(flag == 'M'){
			formData.append("opc","RR_03");   //Modificar
		}		
		$.ajax({
			type: 'POST',
			data: formData,
			url: 'bd/bd_operaciones.php',
			contentType :false,
			processData: false,
			success: function(rpta){
				if(rpta==1){
					cargarTablaRegistrosReq();
					cerrarCargando();
					cerrarModal('#modalRegistroReq');
					limpiarForm(form);
					alert("Registro exitoso");
					return true;
				}
				cerrarCargando();
				alert(rpta);
				return false;
			},
			error: function(rpta){
				cerrarCargando();
				alert(rpta);
			}
		});
	
}



function cargarTablaDocumentos(){
	abrirCargando();
	var opc = 'CT_DOC_01';
	$.ajax({
		type: 'POST',
		data:'opc='+opc,
		url: 'bd/bd_operaciones.php',
		success: function(rpta){
			$('.tablaDatos').DataTable().destroy();
			$('#cuerpoTablaDocumentos').html(rpta);
			$('.tablaDatos').DataTable(
					{
				   	"columnDefs": [
	            { "targets": [ 0 ],"width": "7%","type": "text"},										 		//Codigo		            
	            { "targets": [ 1 ],"width": "8%", "searchable": false ,},	//Revisiones
	            { "targets": [ 2 ],"width": "30%",},											 //Titulo
	            { "targets": [ 3 ],"width": "15%","searchable": false ,},	//Estado
	            { "targets": [ 4 ],"width": "15%","searchable": false , },	//Tipo Doc
	            { "targets": [ 5 ],"width": "15%", },	//Area
	            { "targets": [ 6 ],"width": "10%","orderable": false }												//Operaciones
			      ],
			      "order": [[ 2, "asc" ]]
					}
			);
			cerrarCargando();
		},
		error: function(rpta){
			alert(rpta);
		}
	});
}
function guardarDocumento(form){
	// Validaciones
		flag = $.trim($('#txtFlag').val());
		if(flag == ''){
			alert("Se produjo un error en el formulario - Variable bandera");
			return false;
		}			
		if($('#cboEstado').val()==0){
			$('#cboEstado').parent().addClass('has-error');
		}else{
			$('#cboEstado').parent().removeClass('has-error');
		}
		if($('#cboTipoDocumento').val()==0){
			$('#cboTipoDocumento').parent().addClass('has-error');
		}else{
			$('#cboTipoDocumento').parent().removeClass('has-error');
		}
		if($('#cboArea').val()==0){
			$('#cboArea').parent().addClass('has-error');
		}else{
			$('#cboArea').parent().removeClass('has-error');
		}

		if($.trim($('#txtCodigo').val()).length<1){
			$('#txtCodigo').parent().addClass('has-error');
		}else{
			$('#txtCodigo').parent().removeClass('has-error');
		}
		if($.trim($('#txtRuta').val()).length<1){
			$('#txtRuta').parent().addClass('has-error');
		}else{
			$('#txtRuta').parent().removeClass('has-error');
		}
		if($.trim($('#txtTitulo').val()).length<1){
			$('#txtTitulo').parent().addClass('has-error');
		}else{
			$('#txtTitulo').parent().removeClass('has-error');
		}
		
	var numErrores = document.getElementsByClassName("has-error").length;
	if(numErrores>0){
		alert("Verifique los datos ingresados");			
		return false;
	}
	abrirCargando();
	var formData = new FormData($('#formDocumento')[0]);		
	if(flag == 'N'){
		formData.append("opc","D_02");   //Agregar nuevo
	}
	if(flag == 'M'){
		formData.append("opc","D_03");   //Modificar
	}		
	$.ajax({
		type: 'POST',
		data: formData,
		url: 'bd/bd_operaciones.php',
		contentType :false,
		processData: false,
		success: function(rpta){
			if(rpta==1){
				cargarTablaDocumentos();
				cerrarCargando();
				cerrarModal('#modalRegDocumento');
				limpiarForm(form);					
				alert("Registro exitoso");					
				return true;
			}
			cerrarCargando();
			alert(rpta);
			return false;
		},
		error: function(rpta){
			cerrarCargando();
			alert(rpta);
		}
	});
}	
function mostrarDocumento(controlDocID, nroRevision){
	abrirModal("#modalRegDocumento");
	abrirCargando();
	$('#btnGuardar').hide();
	opc = 'D_03';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&documentoID='+controlDocID+'&nroRevision='+nroRevision,
		url: 'bd/bd_operaciones.php',			
		success: function(rpta){				
			objeto = JSON.parse(rpta);
			$('#txtCodigo').val(objeto[0]);
			$('#txtRevisionN').val(objeto[3]);
			$('#txtTitulo').val(objeto[1]);
			$('#cboEstado').val(objeto[4]);
			$('#cboArea').val(objeto[10]);
			$('#cboTipoDocumento').val(objeto[9]);
			$('#txtFechaAp').val(objeto[7]);
			$('#txtFechaV').val(objeto[6]);
			$('#txtAcceso').val(objeto[11]);
			$('#txtDistribucion').val(objeto[12]);
			$('#txtObservaciones').val(objeto[13]);
			cerrarCargando();
		},
		error: function(rpta){
			cerrarCargando();
			alert(rpta);				
		}
	});
}