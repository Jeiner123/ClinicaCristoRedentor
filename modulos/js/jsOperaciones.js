// ---------------------------------------------
//	OPERACIONES
// ---------------------------------------------

// CITAS		
	function seleccionarPersonalSalud(personalID,especialidadID,nombresMedico){
		cerrarModal('#modalListaPersonalSalud');
		$('#txtNombresMedico').val(nombresMedico);
		$('#txtMedicoCodigo').val(personalID);
	}

	function seleccionarCboMedico(combo){
		$('#txtCodigoMedicoRef').val($(combo).val());
	}
	function seleccionarCboPaciente(combo){
		$('#txtPacienteID').val($(combo).val());
	}
// PERSONA
// VERIFICA EL DNI, SI EXISTE
function verificaDNI(form){
	if($.trim($('#txtDNI').val()).length!=8){
		$('#txtDNI').parent().addClass('has-error');
		return false;
	}else{
		$('#txtDNI').parent().removeClass('has-error');
	}
	DNI = $('#txtDNI').val();
	opc = 'PL_10';	
	abrirCargando();
  $.ajax({
		type: 'POST',
		data: 'opc='+opc+'&DNI='+DNI,
		url: '../bd/bd_operaciones.php',
		success: function(rpta){
			limpiarForm(form);
			bloquearForm(form,false);
			$('#txtDNI').val(DNI);
			if(rpta!=0){
				var datos = rpta.split(",,");				
				$('#txtNombres').val(datos[0]);	$('#txtNombres').attr('readonly',true);
				$('#txtPaterno').val(datos[1]);	$('#txtPaterno').attr('readonly',true);
				$('#txtMaterno').val(datos[2]);	$('#txtMaterno').attr('readonly',true);
				$('#txtFechaN').val(datos[3]);	$('#txtFechaN').attr('readonly',true);
				$('#cboSexo').val(datos[4]);		
				$('#txtTelefono1').val(datos[5]); 	
				$('#cboTipoTelefono1').val(datos[6]);	
				$('#txtTelefono2').val(datos[7]);	
				$('#cboTipoTelefono2').val(datos[8]);	
				$('#txtCorreoP').val(datos[9]);
				$('#txtRUC').val(datos[10]);	
				$('#txtDireccion').val(datos[11]);
			}
			cerrarCargando();	
		},
		error: function(rpta){
			alert(rpta);
			cerrarCargando();	
		}
	});
}
