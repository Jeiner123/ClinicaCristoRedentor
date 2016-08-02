USE clinica;

drop table if exists CITA;
drop table if exists PAGO;
drop table if exists PEDIDO_SERVICIO;

create table PEDIDO_SERVICIO(
	pedidoServicioID int not null auto_increment,
	pacienteID int not null,
	personalReferenciaID int null,
	tipo char(1) not null, 								/*C:Consultorio, L:Laboratorio*/
	via char(1) not null,									/*P:Personal  	,T:Telefono,	W:Web , 	F:Facebook*/	
	tasaIGV decimal(9,2) null,					/*IGV ACTUAL*/
	importeSinIGV decimal(9,2) null,
	importeIGV decimal(9,2) null,
	importeTotal decimal(9,2) null,
	importePagado decimal(9,2) null,
	formaPagoID char(3) null,					/*CON - CRE*/
	estadoPago char(3) not null,					/*PAG:Pagado  	,PEN:Pendiente, 	PAR:Parcial*/
	timestamp timestamp not null,
	primary key(pedidoServicioID),
	foreign key(pacienteID) references paciente(pacienteID),
	foreign key(formaPagoID) references forma_pago(formaPagoID),
	foreign key(personalReferenciaID) references personal(personalID)
);
create table PAGO(
	pagoID int not null auto_increment,
	pedidoServicioID int not null,
	tipoDocumento char(2) null,    		/*B:Boleta, F:Factura*/
	numeroDocumento char(20) null,
	importe decimal(9,2) not null,
	fechaPago date not null,
	fechaVence date null,
	estado int not null,
	primary key(pagoID),
	foreign key(pedidoServicioID) references PEDIDO_SERVICIO(pedidoServicioID)
);

/*insert into pedido_servicio(pacienteID,personalReferenciaID,tipo,via,
	tipoDocumento,numeroDocumento,tasaIGV,importeSinIGV,importeIGV,
	importeTotal,importePagado,formaPagoID,estadoPago,timestamp)values
	('00001',null,'C','P',null,null,0,0,0,0,0,'CON','PE','2016-07-23 23:38:01');*/

create table CITA(
	citaID int not null auto_increment,
	pedidoServicioID int not null,
	pacienteID int not null,
	medicoID int null,								/*Medico que lo atenderá*/
	especialidadID int null,			/*Especialidad*/
	servicioID int null,
	tipo char(1) not null, 						/*C:Consultorio, L:Laboratorio*/
	fecha date not null,
	hora varchar(8) not null,
	observaciones varchar(500) null,
	estado char(1) not null,					/*R:Reservado 	,S:En Sala,		A:Atendido,	X:Anulado*/		
	diagnostico varchar(500) null,
	tratamiento varchar(500) null,
	medicamento	varchar(500) null,	
	primary key(citaID),
	foreign key(pedidoServicioID) references PEDIDO_SERVICIO(pedidoServicioID),
	foreign key(pacienteID) references paciente(pacienteID),	
	foreign key(medicoID) references personal(personalID),
	foreign key(especialidadID) references especialidad(especialidadID),
	foreign key(servicioID) references servicio(servicioID)
);

