var f = new Date();
var año=f.getFullYear();
var mes= f.getMonth()+1;
if(mes<10){
	mes='0'+mes;
}
var fechaHoyDMA = f.getDate()+'-'+mes+'-'+año;
var fechaHoyAMD = año+'-'+mes+'-'+f.getDate();
var numeroCargas = 0;

window.onload = function(){
	activarMenuPrincipal();
	activarMenuIzquierda();
	// alert(fechaHoyDMA);	
}

function abrirCargando(){
	numeroCargas++;
	$("#modalCargando").modal({
		show:true,
		backdrop:'static',
	});
}
function cerrarCargando(){
	numeroCargas--;
	if(numeroCargas<=0){
		cerrarModal("#modalCargando");
	}
}
// Validamos que el combo este seleccionado
function comboObligatorio(combo,valor){
	if($(combo).val() ==valor){
		$(combo).parent().addClass('has-error');
	}else{
		$(combo).parent().removeClass('has-error');
	}
}
// Validamos los campos que son obigatorios
function inputObligatorio(input,valor){
	if($.trim($(input).val()).length<valor){
		$(input).parent().addClass('has-error');
	}else{
		$(input).parent().removeClass('has-error');
	}
}

function inputMismoValor(input,valor){
	if($.trim($(input).val()).length!=valor){
		$(input).parent().addClass('has-error');
	}else{
		$(input).parent().removeClass('has-error');
	}
}

function seleccionSimple(e){
	if ($(e).parents("table").find('tbody tr td').length == 1){ //Si no hay datos
 	   return false;
	}
	if ( $(e).hasClass('active')){
 		$(e).removeClass('active');
 	}else{
		$(e).parents("table").find('tr.active').removeClass('active');
		$(e).addClass('active');
    }
}
function activarMenuPrincipal(){
	var idMenu = "#"+$("#menuPrincipal").val();
	$(idMenu).addClass('active');
	($(idMenu).parent()).parent().addClass('active');
}
function activarMenuIzquierda(){
	var idMenu = "#"+$("#menuIzquierda").val();
	$(idMenu).addClass('active');
	($(idMenu).parent()).parent().addClass('active');
}
function soloNumeroEntero(e){
	key = e.keycode || e.which;	
	teclado = String.fromCharCode(key).toLowerCase();	
	letras = "1234567890";
	especiales = "8-37-38-46-164-32-0";
	teclado_especial = false;
	for(var i in especiales){
		if(key == especiales[i]){
			teclado_especial = true;
		}
	}
	if(letras.indexOf(teclado)==-1 && !teclado_especial){		
		return false;
	}
}
function soloTelefono(e){
	key = e.keycode || e.which;	
	teclado = String.fromCharCode(key).toLowerCase();	
	letras = " -1234567890";
	especiales = "8-37-38-46-164-32-0";
	teclado_especial = false;
	for(var i in especiales){
		if(key == especiales[i]){
			teclado_especial = true;
		}
	}
	if(letras.indexOf(teclado)==-1 && !teclado_especial){		
		return false;
	}
}
function soloNumeroDecimal(e){
	key = e.keycode || e.which;	
	teclado = String.fromCharCode(key).toLowerCase();	
	letras = ".1234567890";
	especiales = "8-37-38-46-164-32-0";
	teclado_especial = false;
	for(var i in especiales){
		if(key == especiales[i]){
			teclado_especial = true;
		}
	}
	if(letras.indexOf(teclado)==-1 && !teclado_especial){		
		return false;
	}
}
function soloLetras(e){
	key = e.keycode || e.which;	
	teclado = String.fromCharCode(key).toLowerCase();	
	letras = " abcdefghijklmñnopqrstuvwxyzáéíóú";
	especiales = "8-37-38-46-164-32-0";
	teclado_especial = false;
	for(var i in especiales){
		if(key == especiales[i]){
			teclado_especial = true;
		}
	}
	if(letras.indexOf(teclado)==-1 && !teclado_especial){		
		return false;
	}
}
function validaCorreo(email){
	var correo = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !correo.test(email) )
       return false;
    else
    	return true;
}
function enviarCorreo(form){
	var nombres = $.trim($('#txtNombres').val());
	var empresa = $.trim($('#txtEmpresa').val());
	var telefono = $.trim($('#txtTelefono').val());
	var correo = $.trim($('#txtCorreo').val());
	var mensaje = $.trim($('#txtMensaje').val());

	if(nombres.length<5){
		return false;
	}
	if(empresa.length<2){
		return false;
	}
	if(telefono.length<9){
		return	false;
	}
	if(correo.length<5){
		return false;
	}
	if(mensaje.length<5){
		return	false;
	}
	return true;
}
// Funcion para abrir el modal -- manda el ID del modal
function abrirModal(modal){
	limpiarForm(modal);
	bloquearForm(modal,false);
	// bloquearForm(modal,false);
	$(modal).modal({
		show:true,
		// backdrop:'static',
	});
	$('#txtFlag').val('N');
	$('.btnGuardar').show();
	$('#btnGuardar').show();
}
// Funcion para cerrar el modal -- manda el ID del modal
function cerrarModal(modal){
	$(modal).modal('hide');
}
function abrirVentana(ventanaID,valor){
	if(valor){
    $(ventanaID).show("slow");
  }else{
    $(ventanaID).hide( "slow");
  }
}
//Limpia los campos del formulario
function limpiarForm(miForm) {
	// recorremos todos los campos que tiene el formulario
	$(':input', miForm).each(function() {
		var type = this.type;
		var tag = this.tagName.toLowerCase();
		//limpiamos los valores de los campos…
		if (type == 'text' 		|| type == 'date' 		|| type == 'email' ||
			type == 'password' 	|| tag == 'textarea' 	|| type == 'file'){
			this.value = "";
			$(this).parent().removeClass('has-error');
		}
		// excepto de los checkboxes y radios, le quitamos el checked
		// // pero su valor no debe ser cambiado
		// else if (type == 'checkbox' || type == 'radio')
		// 	this.checked = false;
		// los selects le ponesmos el indice a -
		else{
			if (tag == 'select'){
				this.selectedIndex = 0;
				$(this).parent().removeClass('has-error');
			}
		}
	});
	$(".btnGuardar").attr("disabled",false);
}
function bloquearForm(miForm,modo){ 		//'#formulario',true
	// recorremos todos los campos que tiene el formulario
	$(':input', miForm).each(function() {
		var type = this.type;
		var tag = this.tagName.toLowerCase();
		//limpiamos los valores de los campos…
		if (type == 'text' || type == 'date' || type == 'email' ||
			type == 'password' || tag == 'textarea' || type == 'file'){
			// this.disabled = modo;
			this.readOnly = modo;
		}
		// excepto de los checkboxes y radios, le quitamos el checked
		// // pero su valor no debe ser cambiado
		// else if (type == 'checkbox' || type == 'radio')
		// 	this.checked = false;
		// los selects le ponesmos el indice a -
		else{
			if (tag == 'select'){
				this.disabled = modo;
				$(this).parent().removeClass('has-error');
			}
		}
	});
	// $(".btnGuardar").attr("disabled",modo);
}
function bloqueoTotalForm(miForm,modo){ 		//'#formulario',true
	// recorremos todos los campos que tiene el formulario
	$(':input', miForm).each(function() {
		var type = this.type;
		var tag = this.tagName.toLowerCase();
		//limpiamos los valores de los campos…
		if (type == 'text' || type == 'date' || type == 'email' ||
			type == 'password' || tag == 'textarea' || type == 'file'){
			// this.disabled = modo;
			this.disabled = modo;
		}
		// excepto de los checkboxes y radios, le quitamos el checked
		// // pero su valor no debe ser cambiado
		// else if (type == 'checkbox' || type == 'radio')
		// 	this.checked = false;
		// los selects le ponesmos el indice a -
		else{
			if (tag == 'select'){
				this.disabled = modo;
				$(this).parent().removeClass('has-error');
			}
		}
	});
	// $(".btnGuardar").attr("disabled",modo);
}