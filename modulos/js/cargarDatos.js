var urlGeneral = '../bd/bd_operaciones.php';
// Cargar Combos

	//CARGAR DETRACCIONES
	function cargarCboDetraccion(valorDefecto){
		opc = 'CC_TDE';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: urlGeneral,
			success: function(rpta){
				$('#cboDetraccion').html(rpta);
				$('#cboDetraccion').val(valorDefecto);
				funcionSelect('#cboDetraccion');
				cerrarCargando();
				return true;		
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}

	// CARGAR COMBO SERVICIOS
	function cargarCboServicios(combo,especialidadID,tipoServicioID){
		abrirCargando();
		opc = 'CC_SERV_01';
		$.ajax({
			type: 'POST',
			data:'opc='+opc+'&especialidadID='+especialidadID+'&tipoServicioID='+tipoServicioID,
			url: urlGeneral,
			success: function(rpta){				
				$(combo).html(rpta);
				funcionSelect(combo);
				cerrarCargando();
				return true;
			},
			error: function(rpta){
				alert(rpta);
				cerrarCargando();
			}
		});
	}

	// CARGAR EL COMBO MEDICOS
	function cargarCboMedicos(combo,especialidadID){
		abrirCargando();
		opc = 'CC_MED_01';
		$.ajax({
			type: 'POST',
			data:'opc='+opc+'&especialidadID='+especialidadID,
			url: urlGeneral,
			success: function(rpta){				
				$(combo).html(rpta);
				funcionSelect(combo);
				cerrarCargando();
				return true;
			},
			error: function(rpta){
				alert(rpta);
				cerrarCargando();
			}
		});
	}

	// CARGA EL COMBO DE PACIENTE
	function cargarCboPacientes(){
		abrirCargando();
		opc = 'CC_PAC_01';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: urlGeneral,
			success: function(rpta){			
				$('#cboPacientes').html(rpta);
				funcionSelect('#cboPacientes');				
				cerrarCargando();				
				return true;
			},
			error: function(rpta){
				alert(rpta);
				cerrarCargando();
			}
		});
	}
	// Cargar combo comprobante de pago (Documento) para ventas
	function cargarCboComprobante(valorDefecto){
		abrirCargando();
		opc = 'CC_CV_01';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: urlGeneral,
			success: function(rpta){			
				$('#cboComprobante').html(rpta);
				$('#cboComprobante').val(valorDefecto);
				funcionSelect('#cboComprobante');
				cerrarCargando();
				return true;
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}

	// Cargar combo comprobante de pago (Documento) para compras
	function cargarCboComprobanteCompra(valorDefecto){
		abrirCargando();
		opc = 'CC_CV_02';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: urlGeneral,
			success: function(rpta){			
				$('#cboComprobante').html(rpta);
				$('#cboComprobante').val(valorDefecto);
				funcionSelect('#cboComprobante');
				cerrarCargando();
				return true;
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}

	function cargarCboPersonalSalud(){
		abrirCargando();
		especialidadID = $('#cboEspecialidad').val();
		opc = 'CC_PS_01';
		$.ajax({
			type: 'POST',
			data:'opc='+opc+'&especialidadID='+especialidadID,
			url: urlGeneral,
			success: function(rpta){
				$('#cboPersonalSalud').html(rpta);				
				cerrarCargando();
				return true;
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}
	function cargarCboAreas(){
		abrirCargando();
		opc = 'CC_AR_01';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: urlGeneral,
			success: function(rpta){
				$('#cboArea').html(rpta);
				cerrarCargando();
				return true;		
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}
	function cargarCboCargos(){
		abrirCargando();
		areaID = $('#cboArea').val();
		opc = 'CC_CARG_01';
		$.ajax({
			type: 'POST',
			data:'opc='+opc+'&areaID='+areaID,
			url: urlGeneral,
			success: function(rpta){
				$('#cboCargo').html(rpta);
				cerrarCargando();
				return true;		
			},
			error: function(rpta){
				alert(rpta);
				cerrarCargando();
			}
		});
	}
	function cargarCboTipoServicio(combo,valorDefecto){
		abrirCargando();		
		opc = 'TS_01';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: urlGeneral,
			success: function(rpta){
				$('#cboTipoServicio').html(rpta);
				cerrarCargando();
				return true;		
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}
	// Cargar combo de especialidades
	function cargarCboEspecialidades(combo,valorDefecto){
		abrirCargando();		
		opc = 'CC_E_05';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: urlGeneral,
			success: function(rpta){
				$(combo).html(rpta);
				$(combo).val(valorDefecto);
				funcionSelect(combo);
				cerrarCargando();
				return true;		
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}
	function cargarCboTipoTelefono(){
		abrirCargando();		
		opc = 'CC_TT_01';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: urlGeneral,
			success: function(rpta){
				$('#cboTipoTelefono1').html(rpta);
				$('#cboTipoTelefono2').html(rpta);
				cerrarCargando();
				return true;		
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}
	function cargarCboTipoPersonal(){
		abrirCargando();		
		opc = 'CC_TP_01';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: urlGeneral,
			success: function(rpta){
				$('#cboTipoPersonal').html(rpta);
				cerrarCargando();
				return true;		
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}
	function cargarCboProcedencias (){
		abrirCargando();		
		opc = 'CC_P_01';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: urlGeneral,
			success: function(rpta){				
				$('#cboProcedencia').html(rpta);
				cerrarCargando();
				return true;		
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}
	//Tipo de compras  o tipo de productos
	function cargarCboExistencias(){
		abrirCargando();
		var opc = 'CC_07';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: 'bd/bd_operaciones.php',
			success: function(rpta){				
				$('#cboTipoExistencia').html(rpta);
				cerrarCargando();
				return true;		
			},
			error: function(rpta){
				alert(rpta);
				cerrarCargando();
			}
		});
	}
	//Formas de pago : Contado - Credito Credito 7 dias..
	function cargarCboCondPago(valorDefecto){
		opc = 'CC_FP';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: urlGeneral,
			success: function(rpta){
				$('#cboModalidadPago').html(rpta);
				$('#cboModalidadPago').val(valorDefecto);
				cerrarCargando();
				return true;		
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}
	// RUC - DNI - Carnet de extranjeria
	function cargarCboTipoDocumento(valorDefecto){
		opc = 'CC_TD';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: urlGeneral,
			success: function(rpta){
				$('#cboDocumento').html(rpta);
				$('#cboDocumento').val(valorDefecto);
				cerrarCargando();
				return true;		
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}
	// Bancos
	function cargarCboEntidadFinanciera(valorDefecto){
		opc = 'CC_EF';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: urlGeneral,
			success: function(rpta){
				$('#cboBanco').html(rpta);
				$('#cboBanco').val(valorDefecto);
				funcionSelect('#cboBanco');
				cerrarCargando();
				return true;		
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}

	function cargarCboTipoAdquision(adquision){
		opc = 'CC_TA';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: urlGeneral,
			success: function(rpta){
				$('#cboAdquisicion').html(rpta);
				$('#cboAdquisicion').val(adquision);
				cerrarCargando();
				return true;		
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}

// --- CARGAR TABLAS --

	function cargarListaPersonalSalud(){		
		var especialidadID = $('#cboEspecialidad').val();
		var opc = 'CL_PS_01';
		abrirCargando();
		$.ajax({
			type: 'POST',
			data:'opc='+opc+'&especialidadID='+especialidadID,
			url: urlGeneral,
			success: function(rpta){				
				$('#tablaPersonalSalud').DataTable().destroy();
				$('#cuerpoTablaPersonalSalud').html(rpta);
				$('#tablaPersonalSalud').DataTable(
						// {
					 //   	"columnDefs": [
		    //         { "targets": [ 0 ],"width": "10%",  "searchable": false,},
		    //         { "targets": [ 1 ],"width": "55%", },
		    //         { "targets": [ 2 ],"width": "15%",  "searchable": false , },
		    //         { "targets": [ 3 ],"width": "5%",  "searchable": false ,},
		    //         { "targets": [ 4 ],"width": "15%", "orderable": false,"searchable": false ,}
		            
				  //     ],
				  //     "order": [[ 3, "asc" ]]
						// }
				);
				cerrarCargando();
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}
	function cargarListaPersonalSaludRef(){
		abrirCargando();
		var especialidadID = 0;
		var opc = 'CL_PSR_01';
		$.ajax({
			type: 'POST',
			data:'opc='+opc+'&especialidadID='+especialidadID,
			url: urlGeneral,
			success: function(rpta){				
				$('#tablaPersonalSaludRef').DataTable().destroy();
				$('#cuerpoTablaPersonalSaludRef').html(rpta);
				$('#tablaPersonalSaludRef').DataTable(
						// {
					 //   	"columnDefs": [
		    //         { "targets": [ 0 ],"width": "10%",  "searchable": false,},
		    //         { "targets": [ 1 ],"width": "55%", },
		    //         { "targets": [ 2 ],"width": "15%",  "searchable": false , },
		    //         { "targets": [ 3 ],"width": "5%",  "searchable": false ,},
		    //         { "targets": [ 4 ],"width": "15%", "orderable": false,"searchable": false ,}
		            
				  //     ],
				  //     "order": [[ 3, "asc" ]]
						// }
				);
				cerrarCargando();
			},
			error: function(rpta){
				alert(rpta);
				cerrarCargando();
			}
		});
	}

	function cargarListaServicios(){				
		var opc = 'CL_S_01';
		abrirCargando();
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: urlGeneral,
			success: function(rpta){				
				$('#tablaServicios').DataTable().destroy();
				$('#cuerpoTablaServicios').html(rpta);
				$('#tablaServicios').DataTable(
					{
				   	"columnDefs": [
	            { "targets": [ 0 ],"width": "10%",  "searchable": false,},
	            { "targets": [ 1 ],"width": "65%", },
	            { "targets": [ 2 ],"width": "10%", },
	            { "targets": [ 3 ],"width": "0%","visible": false,},            
	            { "targets": [ 4 ],"width": "0%","visible": false, "searchable": false ,},
	            { "targets": [ 5 ],"width": "0%","visible": false,},
	            { "targets": [ 6 ],"width": "0%","visible": false, "searchable": false ,},
	            { "targets": [ 7 ],"width": "15%",}	            
			      ],
			      "order": [[ 3, "asc" ]]
					}
				);
				cerrarCargando();
			},
			error: function(rpta){
				alert(rpta);
			}
		});		
	}

		function cargarListaPacientes(){
		abrirCargando();		
		var opc = 'CL_PAC_01';
		$.ajax({
			type: 'POST',
			data:'opc='+opc,
			url: urlGeneral,
			success: function(rpta){
				$('#tablaPacientes').DataTable().destroy();
				$('#cuerpoTablaPacientes').html(rpta);
				$('#tablaPacientes').DataTable(
						// {
					 //   	"columnDefs": [
		    //         { "targets": [ 0 ],"width": "10%",  "searchable": false,},
		    //         { "targets": [ 1 ],"width": "55%", },
		    //         { "targets": [ 2 ],"width": "15%",  "searchable": false , },
		    //         { "targets": [ 3 ],"width": "5%",  "searchable": false ,},
		    //         { "targets": [ 4 ],"width": "15%", "orderable": false,"searchable": false ,}
		            
				  //     ],
				  //     "order": [[ 3, "asc" ]]
						// }
				);
				cerrarCargando();
			},
			error: function(rpta){
				alert(rpta);
			}
		});
	}
	
	
