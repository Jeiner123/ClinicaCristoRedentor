var f = new Date();
var año=f.getFullYear();
var mes= f.getMonth()+1;
if(mes<10){
	mes='0'+mes;
}
var fechaHoyDMA = f.getDate()+'-'+mes+'-'+año;
var fechaHoyAMD = año+'-'+mes+'-'+f.getDate();
var numeroCargas = 0;
var meses = ["nombre del mes","ENERO", "FEBRERO", "MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SETIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"];

window.onload = function() {
    activarMenuLateral();    
};
var openSelect = function(selector){
  var element = $(selector)[0], worked = false;
  if (document.createEvent) { // all browsers
      var e = document.createEvent("MouseEvents");
      e.initMouseEvent("mousedown", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
      worked = element.dispatchEvent(e);
  } else if (element.fireEvent) { // ie
      worked = element.fireEvent("onmousedown");
  }
  // if (!worked) { // unknown browser / error
  //     alert("It didn't worked in your browser.");
  // }   
}
function funcionSelect(combo) {
	if(!ace.vars['touch']) {
	$(combo).chosen({allow_single_deselect:true});
	//resize the chosen on window resize
	$(window)
	.off('resize.chosen')
	.on('resize.chosen', function() {
		$(combo).each(function() {
			 var $this = $(this);
			 $this.next().css({'width': $this.parent().width()});
		})
	}).trigger('resize.chosen');
	//resize chosen on sidebar collapse/expand
	$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
		if(event_name != 'sidebar_collapsed') return;
		$(combo).each(function() {
			 var $this = $(this);
			 $this.next().css({'width': $this.parent().width()});
		})
	});


	$('#chosen-multiple-style .btn').on('click', function(e){
		var target = $(this).find('input[type=radio]');
		var which = parseInt(target.val());
		if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
		 else $('#form-field-select-4').removeClass('tag-input-style');
	});
}
}
function validarNumeroComprobante(element){
  var valor = $(element).val();
  if(valor.length == 1) valor = '000000'+valor;
  else if(valor.length == 2) valor = '00000'+valor;
  else if(valor.length == 3) valor = '0000'+valor;
  else if(valor.length == 4) valor = '000'+valor;
  else if(valor.length == 5) valor = '00'+valor;
  else if(valor.length == 6) valor = '0'+valor;  
  $(element).val(valor);
}
function validarNumeroSerie(element){
  var valor = $(element).val();
  if(valor.length == 1) valor = '000'+valor;
  else if(valor.length == 2) valor = '00'+valor;
  else if(valor.length == 3) valor = '0'+valor;  
  $(element).val(valor);
}
function validarFechaMayor(elemento){
	var fecha = $(elemento).val();
  if(fecha.length<1){
    $(elemento).parent().addClass('has-error');
    return false;
  }else{
    $(elemento).parent().removeClass('has-error');
  }  
  var valuesStart= fechaHoyDMA.split("-");
  var valuesEnd=fecha.split("-");
  var dateStart = new Date(valuesStart[2],(valuesStart[1]-1),valuesStart[0]);
  var dateEnd = new Date(valuesEnd[2],(valuesEnd[1]-1),valuesEnd[0]);
  if(dateStart > dateEnd){
    $(elemento).parent().addClass('has-error');        
  }else{
    $(elemento).parent().removeClass('has-error');
  }  
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

// Validamos que el combo esté seleccionado
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

function activarMenuLateral() {
    var enlaces = $('.sidebar-menu li a');
    for (var i=0; i<enlaces.length; ++i) {
        if (enlaces[i].href == location.href) {
            $(enlaces[i]).parent().addClass('active');
            $(enlaces[i]).parent().parent().parent().addClass('active');
            break;
        }
    }
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

// Funcion para abrir modal -- manda el ID del modal
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

// Limpia los campos del formulario
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