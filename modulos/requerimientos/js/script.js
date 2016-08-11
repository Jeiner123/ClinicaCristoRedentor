function crearfila(){
	fila=1;
	$("#tablaRequerimiento tbody tr").each(function (index) {
		fila++;
    })
    
	$("#tablaRequerimiento")
	.append
	(
		'<tr><td><input class="form-control input-sm" value="'+fila+'" id="txtItem'+fila+'" name="txtItem'+fila+'" style="text-align:right"; readonly value=""/></td><td><input class="form-control input-sm" id="txtProducto'+fila+'" name="txtProducto'+fila+'"></td><td><input class="form-control input-sm" name="txtUnidad'+fila+'" id="txtUnidad'+fila+'"></td><td><input class="form-control input-sm" name="txtDescripcion'+fila+'" id="txtDescripcion'+fila+'"></td><td><input class="form-control input-sm" id="txtCantidad'+fila+'" name="txtCantidad'+fila+'"  onkeypress="return soloNumeroEntero(event);"></td><td><input class="form-control input-sm" id="txtRequerimiento'+fila+'" name="txtRequerimiento'+fila+'"></td></tr>'
	);
}