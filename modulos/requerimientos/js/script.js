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
				if(rpta==1){
					ajaSaveDetalleRequerimiento();
					alert("Compra registrada");
					cerrarCargando();
				}else{
					cerrarCargando();
					alert("Ocurrió un error mientrás se intentaba registrar la compra");
				}
			},
			error: function(rpta){
				alert(rpta);
			}
		});
}

function ajaSaveDetalleRequerimiento(){

	$(".item").each(function (index){
			index=parseInt(index)+1;
            producto=$("#txtProducto"+index).val();
            if(producto!=""){
            	var formData = new FormData($('#formRequerimiento')[0]);
				formData.append("opc", "RRQ_02");
				formData.append("item",index);
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