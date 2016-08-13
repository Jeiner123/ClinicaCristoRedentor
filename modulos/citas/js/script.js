var url = 'bd/bd_operaciones.php';
var importeSinIGV = 0.0;
var importeIGV = 0.0;
var importeTotal = 0.0;

// CITAS
function guardarCita(form){
	$('#btnGuardarCita').attr('disabled',true);	
	comboObligatorio('#cboPacientes',0);
	comboObligatorio('#cboServicios',0);
	comboObligatorio('#cboMedicos',0);	
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
		url: url,
		contentType :false,
		processData: false,
		success: function(rpta){
			if(rpta == 1){
				bloqueoTotalForm(form,true);
				alert("Registro exitoso");
				window.location.replace("listar_citas.php");				
			}else{
				alert(rpta);
				$('#btnGuardarCita').attr('disabled',false);
			}
			cerrarCargando();
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
	comboObligatorio('#cboPacientes',0);	
	
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
		url: url,
		contentType :false,
		processData: false,
		success: function(rpta){
			if(rpta==1){
				alert("Registro exitoso");
				cerrarCargando();
				bloqueoTotalForm('#formDatosGenerales',true);
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
function cargarTablaCitas(){
	abrirCargando();
	fecha = $("#txtFechaCita").val();
	estado = $("#cboEstado").val();
	tipo = $("input[name=rbListaCitas]:checked").val();
	var opc = 'CTC_01';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&fecha='+fecha+'&tipo='+tipo+'&estado='+estado,
		url: url,
		success: function(rpta){			
			$('#tablaCitas').DataTable().destroy();
			$('#cuerpoTablaCitas').html(rpta);
			$('#tablaCitas').DataTable(
				{
			   	"columnDefs": [
			   		{ "targets": [ 0 ],"width": "4%",},						//Pedido ID
            { "targets": [ 1 ],"width": "19%",},						//Paciente
            { "targets": [ 2 ],"width": "10%", },						//Espcialidad
            { "targets": [ 3 ],"width": "21%",  "searchable": false , },	//Servicio
            { "targets": [ 4 ],"width": "8%",  "searchable": false ,},		//Fecha

            { "targets": [ 5 ],"width": "7%","searchable": false ,},	//Hora
            { "targets": [ 6 ],"width": "13%","searchable": false ,},	//Medico
            { "targets": [ 7 ],"width": "7%","searchable": false ,},	//Estado
            { "targets": [ 8 ],"width": "7%","searchable": false ,},  //Pago
            { "targets": [ 9 ],"width": "4%", "orderable": false,"searchable": false ,}
		      ],
		      "order": [[ 4, "asc" ]],
		      "order": [[ 7, "desc" ]],
		      "iDisplayLength": 25
				}
			);
			cerrarCargando();	
		},
		error: function(rpta){
			alert(rpta);
		}
	});
}
function editarEstadoCita(citaID,estadoNuevo){
	if(estadoNuevo == "X"){
			r = confirm("Seguro que desea anular la cita");
		if (r != true){
		  return false;
		}
	}
	abrirCargando();
	var opc = 'ME_C_01'; //Modificar estado cita
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&citaID='+citaID+'&estadoNuevo='+estadoNuevo,
		url: url,
		success: function(rpta){
			if(rpta == 1){
				alert("Operación exitosa");
				cargarTablaCitas();
			}else{
				alert(rpta);
			}
			cerrarCargando();
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
	var servicioID = $("#cboServicios").val();
	if(servicioID == '0'){
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

function seleccionarCboServicios(servicioID){
	opc = 'M_SERV_01';	
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&servicioID='+servicioID,
		url: url,		
		success: function(rpta){
			$.each(jQuery.parseJSON(rpta), function(i,item){
			    $('#txtPrecio').val(item.precioUnitario);
					$('#txtServicio').val(item.servicio);
					$('#cboEspecialidad').val(item.especialidadID); //para COnsultorio
					$('#cboTipoServicio').val(item.tipoServicioID);	//para COnsultorio
					importe = parseFloat(item.precioUnitario) * parseFloat($('#txtCantidad').val());
					$('#txtImporte').val(parseFloat(importe));
					$('#txtCantidad').focus();
			});			
		},
	});
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
	var personalID = $("#cboMedicos").val();
	var especialidadID = $("#cboEspecialidades").val();
	if(personalID == null)personalID = 0;
	if(especialidadID == null)especialidadID = -1;

	var opc = 'CTR_01';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&mes='+mes+'&personalID='+personalID+'&especialidadID='+especialidadID,
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
