url = 'bd/bd_operaciones.php';

function crearfila(){
	fila=1;
	$("#tablaRequerimiento tbody tr").each(function (index) {
		fila++;
    })
    
	$("#tablaRequerimiento")
	.append
	(
		'<tr><td><input class="form-control input-sm item" value="'+fila+'" id="txtItem'+fila+'" name="txtItem'+fila+'" style="text-align:right"; readonly value=""/></td><td><input class="form-control input-sm" id="txtProducto'+fila+'" name="txtProducto'+fila+'"></td><td><input class="form-control input-sm" name="txtUnidad'+fila+'" id="txtUnidad'+fila+'"></td><td><input class="form-control input-sm" name="txtDescripcion'+fila+'" id="txtDescripcion'+fila+'"></td><td><input class="form-control input-sm" id="txtCantidad'+fila+'" name="txtCantidad'+fila+'"  onkeypress="return soloNumeroEntero(event);"></td><td><input class="form-control input-sm" id="txtRequerimiento'+fila+'" name="txtRequerimiento'+fila+'"></td></tr>'
	);
}

function registrarRequerimiento(){
	detalles=0;
	$(".item").each(function (index){
		detalles++;
	});

	abrirCargando();
	opc = 'RRQ_01';
		$.ajax({
			type: 'POST',
			data:'opc='+opc+'&detalles='+detalles,
			url: url,
			success: function(rpta){
				if(rpta!=0){
					ajaSaveDetalleRequerimiento(rpta);
					alert("Requerimiento registrado");
					cerrarCargando();
				}else{
					cerrarCargando();
					alert("Ocurrió un error mientrás se intentaba registrar el requerimiento");
				}
			},
			error: function(rpta){
				alert(rpta);
			}
		});
}

function ajaSaveDetalleRequerimiento(requerimientoID){

	$(".item").each(function (index){
			index=parseInt(index)+1;
            producto=$("#txtProducto"+index).val();
            if(producto!=""){
            	var formData = new FormData($('#formRequerimiento')[0]);
				formData.append("opc", "RRQ_02");
				formData.append("item",index);
				formData.append("requerimientoID",requerimientoID);
				$.ajax({
					type: 'POST',
					data: formData,
					url: url,
					contentType :false,
					processData: false,
					success: function(rpta){
					},
					error: function(rpta){
						alert(rpta);
						cerrarCargando();	
					}
				});	
            }
    })
}

function cargarTablaRequerimiento(){
	abrirCargando();
	var opc = 'RRQ_03';
	$.ajax({
		type: 'POST',
		data:'opc='+opc,
		url: url,
		success: function(rpta){
			$('.tablaDatos').DataTable().destroy();
			$('#cuerpoTablaRequerimiento').html(rpta);
			$('.tablaDatos').DataTable(
				{
			   	"columnDefs": [
		            { "targets": [ 0 ],"width": "5%"}, 
		            { "targets": [ 1 ],"width": "10%"},										 		//DNI
		            { "targets": [ 2 ],"width": "15%"},											 //nomresb
		            { "targets": [ 3 ],"width": "20%"},	
		            { "targets": [ 4 ],"width": "25%"},
		            { "targets": [ 5 ],"width": "5%"},
		            { "targets": [ 6 ],"width": "10%"},											 //nomresb
		            { "targets": [ 7 ],"width": "10%"},											 //nomresb
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

function UpdateEstadoRequerimiento(estado,requerimientoID,item){
	if(estado=='R'){
		r = confirm("Seguro que desea rechazar el requerimiento?");
		if (r != true){
		  return false;
		}
	}
	
	var opc = 'RRQ_04';
	$.ajax({
		type: 'POST',
		data:'opc='+opc+'&estado='+estado+'&requerimientoID='+requerimientoID+'&item='+item,
		url: url,
		success: function(rpta){
			if(rpta==1){
				cargarTablaRequerimiento();
			}else{
				alert("No se puede actualizar el requerimiento en estos momentos");
			}
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();
		}
	});
	
}
