var importeSinIGV = 0.0;
var importeIGV = 0.0;
var importeTotal = 0.0;
function guardarCita(form){
	$('#btnGuardarCita').attr('disabled',true);
	
	inputObligatorio('#txtNombresPaciente',3);
	inputObligatorio('#txtServicio',3);
	inputObligatorio('#txtNombresMedico',3);
	inputObligatorio('#txtHoraCita',1);
	validarFechaMayor('#txtFechaCita');

	var numErrores = document.getElementsByClassName("has-error").length;
	if(numErrores>0){
		alert("Verifique los datos ingresados");
		$('#btnGuardarCita').attr('disabled',false);			
		return false;
	}
	abrirCargando();
	var formData = new FormData($('#formRegistrarCita')[0]);
	formData.append("opc","RC_01");				
	$.ajax({
		type: 'POST',
		data: formData,
		url: 'bd/bd_operaciones.php',
		contentType :false,
		processData: false,
		success: function(rpta){
			if(rpta==1){
				bloqueoTotalForm(form,true);
				alert("Registro exitoso");
				cerrarCargando();
				// window.location.replace("listar_citas.php");
				return true;
			}
			cerrarCargando();
			alert(rpta);
			$('#btnGuardarCita').attr('disabled',false);
			return false;
		},
		error: function(rpta){
			cerrarCargando();
			alert(rpta);
			
		}
	});
}
function guardarCitaLaboratorio(){	
	$('#btnGuardar').attr('disabled',true);
	var listaServicios="";
	if($.trim($('#txtPacienteID').val()).length<1){
		$('#txtNombresPaciente').parent().addClass('has-error');
	}else{
		$('#txtNombresPaciente').parent().removeClass('has-error');
	}
	
	if ($('#tablaServiciosLab >tbody >tr').length == 1){
		if($('#tablaServiciosLab >tbody >tr >td').length == 1){
    	alert( "Debe seleccionar por lo menos un servicio" );
    	$('#btnGuardar').attr('disabled',false);
    	return false;
    }
	}
	$("#tablaServiciosLab tbody tr").each(function (index){
    var servicioID, cantidad, fecha, hora, obs, precio;
    $(this).children("td").each(function (index2){
        switch (index2){
            case 0: servicioID = $(this).text();break; //ID
            case 2: precio = $(this).text();break;	//Precio
            case 3: cantidad = $(this).text();break; 	//Cantidad
            case 5: fecha = $(this).text();break;	//Fecha
            case 6: hora = $(this).text();break;	//Hota
            case 8: obs = $(this).text();break;	//Observaciones

        }
        $(this).css("background-color", "#ECF8E0");
    })
    listaServicios = listaServicios + servicioID +',,'+ cantidad +',,'+ fecha +',,'+ hora +',,'+ obs +',,'+ precio+"&&";
    // listaServicios.push(campo1,campo3,campo5,campo6);    
  })  
	var numErrores = document.getElementsByClassName("has-error").length;
	if(numErrores>0){
		alert("Verifique los datos ingresados");
		$('#btnGuardar').attr('disabled',false);			
		return false;
	}	
	abrirCargando();
	var formData = new FormData($('#formDatosGenerales')[0]);
	formData.append("opc","RCL_01");
	formData.append("listaServicios",listaServicios);
	$.ajax({
		type: 'POST',
		data: formData,
		url: 'bd/bd_operaciones.php',
		contentType :false,
		processData: false,
		success: function(rpta){
			if(rpta==1){
				alert("Registro exitoso");
				cerrarCargando();
				// window.location.replace("listar_citas.php");
				return true;
			}
			cerrarCargando();
			alert(rpta);
			$('#btnGuardarCita').attr('disabled',false);
			return false;
		},
		error: function(rpta){
			cerrarCargando();
			alert(rpta);
			
		}
	});
	// var pacienteID
	// var personalReferenciaID
	// var 
}
function cargarTablaCitas(tipo){	
	abrirCargando();
	fecha = $("#txtFechaCita").val();
	estado = $("#cboEstado").val();	
	tipo = $("input[name=rbListaCitas]:checked").val();	
	var opc = 'LCC_01';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&fecha='+fecha+'&estado='+estado+'&tipo='+tipo,
		url: 'bd/bd_operaciones.php',
		success: function(rpta){			
			$('#tablaCitas').DataTable().destroy();
			$('#cuerpoTablaCitas').html(rpta);
			$('#tablaCitas').DataTable(
				{
			   	"columnDefs": [
            { "targets": [ 0 ],"width": "19%",},						//Paciente
            { "targets": [ 1 ],"width": "10%", },						//Espcialidad
            { "targets": [ 2 ],"width": "21%",  "searchable": false , },	//Servicio
            { "targets": [ 3 ],"width": "8%",  "searchable": false ,},		//Fecha

            { "targets": [ 4 ],"width": "7%","searchable": false ,},	//Hora
            { "targets": [ 5 ],"width": "15%","searchable": false ,},	//Medico
            { "targets": [ 6 ],"width": "8%","searchable": false ,},	//Estado
            { "targets": [ 7 ],"width": "8%","searchable": false ,},  //Pago
            { "targets": [ 8 ],"width": "4%", "orderable": false,"searchable": false ,}
		      ],
		      "order": [[ 3, "asc" ]],
		      "iDisplayLength": 25
				}
			);
			numeroCargas--;
			if(numeroCargas==0){
				cerrarModal("#modalCargando");
			}			
		},
		error: function(rpta){
			alert(rpta);
		}
	});
}

//Validar fecha mayor a la de hoy  //'#txtFecha'

// Agregar los servicios a la tabla de detalle
function agregarServicioDetalle(){
	validarFechaMayor('#txtFechaCita');
	var servicioID = $("#txtServicioID").val();	
	if(servicioID==''){
		alert("Seleccione un servicio");
		return false;
	}
	var existe = false;
	// Recorremos las filas
 	$("#tablaServiciosLab tbody tr").each(function (index){
 		//Obtenemos el valor de la primera columna
    dato = $('#tablaServiciosLab').DataTable().cell(index,0).data();
    if(dato == servicioID){
    	existe = true;
    	return false;
    }
	});
	if(existe){
		alert("El servicio ya esta seleccionado");
		return false;
	}
	var servicio = $("#txtServicio").val();
	var precioU = $("#txtPrecio").val();
	var cantidad = $("#txtCantidad").val();
	var importe = $("#txtImporte").val();
	var fecha = $("#txtFechaCita").val();
	var hora = $("#txtHoraCita").val();
	var obs = $("#txtObservaciones").val();	
	if(fecha==''){
		alert("Fecha no válida");
		return false;
	}
	var t = $('#tablaServiciosLab').DataTable();
	var rowNode = t.row.add( [
				servicioID,
				servicio,
        precioU,
        cantidad,
        importe,
        fecha,
        hora,
        "<a href='javascript:;' style='font-size:15px;' class='text-red eliminarServicioDetalle' title='Quitar servicio'><i class='ace-icon fa fa-times bigger-120'></i></a>",
        obs,        
   ])
	.draw()
	.node();
	calcularImporteTotal(precioU,cantidad,1);
	$('#txtServicio').val("");
	$('#txtServicioID').val("");
	$('#txtPrecio').val("");
	$('#txtImporte').val("");
	$('#txtObservaciones').val("");
	$('#txtCantidad').val("1");
}
// Calcular importe Total de un pedido aumento(1) o resta(-1)
function calcularImporteTotal(precioU,cantidad,signo){	
	var importe = precioU*cantidad*signo;
	importeSinIGV = importeSinIGV + Number(importe/1.18); 	$("#txtSubTotal").val(importeSinIGV.toFixed(2));
	importeIGV = importeIGV + Number(importe-importe/1.18); 	$("#txtIGV").val(importeIGV.toFixed(2));
	importeTotal = importeTotal + Number(importe); 	$("#txtTotal").val(importeTotal.toFixed(2));
}
// Quitar una fila de una tabla, // Fila,'#tabla', '¿Seguro que desea quitar la fila?'
function quitarFila(object,tabla,confirmacion){	
	r = confirm(confirmacion);
	if (r != true){
	  return false;
	}
	var table = $(tabla).DataTable();
	table
    .row( $(object).parents('tr') )
    .remove()
    .draw();
  return true;
}

function seleccionarServicio(id,servicio,precio,tipoServicioID,especialidadID){
	cerrarModal('#modalListaServicios');
	$('#txtServicioID').val(id);
	$('#txtServicio').val(servicio);
	$('#txtPrecio').val(parseFloat(precio));
	$('#cboTipoServicio').val(tipoServicioID);
	$('#cboEspecialidad').val(especialidadID);
	importe = parseFloat(precio) * parseFloat($('#txtCantidad').val());
	$('#txtImporte').val(parseFloat(importe));
	$('#txtCantidad').focus();
}


function recorrerCeldas(){
 	$("#tabla tbody tr").each(function (index){
    var campo1, campo2, campo3;
    $(this).children("td").each(function (index2){
        switch (index2){
            case 0: campo1 = $(this).text();break;
            case 1: campo2 = $(this).text();break;
            case 2: campo3 = $(this).text();break;
        }
        $(this).css("background-color", "#ECF8E0");
    })
    alert(campo1 + ' - ' + campo2 + ' - ' + campo3);
  })
}

//Cargar tabla de referencias médicas
function cargarTablaReferencias(){
	abrirCargando();
	// fecha = $("#txtFechaCita").val();
	// estadoPago = $("#cboEstadoPago").val();
	var mes = $("#cboMeses").val();
	var personalID = $("#cboPersonalSalud").val();
	if(personalID == null)personalID = 0;	

	var opc = 'CTR_01';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&mes='+mes+'&personalID='+personalID,
		url: 'bd/bd_operaciones.php',
		success: function(rpta){			
			$('#tablaReferencias').DataTable().destroy();			
			$('#cuerpoTablaReferencias').html(rpta);
			var numFilas = $('#tablaReferencias >tbody >tr').length;   //Numero de referencias			
			$('#tablaReferencias').DataTable(
					{
				   	"columnDefs": [
	            { "targets": [ 0 ],"width": "27%",},						//Medico
	            { "targets": [ 1 ],"width": "27%", },						//Servicio
	            { "targets": [ 2 ],"width": "16%",  "searchable": false , },	//Especialidad
	            { "targets": [ 3 ],"width": "10%",  "searchable": false ,},		//Estado cita 
	            { "targets": [ 4 ],"width": "10%","searchable": false ,},	//Estado pago 
	            { "targets": [ 5 ],"width": "10%","searchable": false ,}	//Estado pago 
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

// function guardarServicioDetalle(){
// 	var importeSinIGV = Number($("#txtSubTotal").val());
// 	var importeIGV = Number($("#txtIGV").val());
// 	var total = Number($("#txtTotal").val());

// 	if(isNaN(importeSinIGV) || isNaN(importeIGV) || isNaN(total)){
// 		alert("Hay errores en el formulario");
// 		return false;
// 	}
// 	// guardar a la base de datos 
// 	var servicio = $("#txtServicio").val();
// 	var precioU = $("#txtPrecio").val();
// 	var cantidad = $("#txtCantidad").val();
// 	var importe = $("#txtImporte").val();		
// 	if(importe==""){
// 		alert("Debe seleccionar el servicio");
// 		return false;
// 	}
// 	agregarServicioDetalle(servicio,precioU,cantidad,importe);
// 	importeSinIGV = importeSinIGV + Number(importe/1.18); 	$("#txtSubTotal").val(importeSinIGV.toFixed(2));
// 	importeIGV = importeIGV + Number(importe-importe/1.18); 	$("#txtIGV").val(importeIGV.toFixed(2));
// 	total = total + Number(importe); 	$("#txtTotal").val(total.toFixed(2));
// }
// function calcularSaldo(o){
// 	var total = Number($("#txtTotal").val());
// 	var saldo = total - o.value;
// 	if(saldo<0){
// 		alert("Valor no válido");
// 		// $("#txtSaldo").val("0");
// 		return false;
// 	}
// 	$("#txtSaldo").val(saldo.toFixed(2));
// }
