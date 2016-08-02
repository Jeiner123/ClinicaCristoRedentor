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

INSERT INTO `pedido_servicio` (`pedidoServicioID`, `pacienteID`, `personalReferenciaID`, `tipo`, `via`, `tasaIGV`, `importeSinIGV`, `importeIGV`, `importeTotal`, `importePagado`, `formaPagoID`, `estadoPago`, `timestamp`) VALUES
(1, 1001, NULL, 'C', 'P', '0.18', '33.90', '6.10', '40.00', '0.00', NULL, 'PEN', '2016-08-02 17:59:48');


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
	precio decimal(9,2) not null,
	cantidad decimal(9,2) not null,
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
INSERT INTO `cita` (`citaID`, `pedidoServicioID`, `pacienteID`, `medicoID`, `especialidadID`, `servicioID`, `tipo`, `fecha`, `hora`, `observaciones`, `estado`, `precio`, `cantidad`, `diagnostico`, `tratamiento`, `medicamento`) VALUES
(1, 1, 1001, 1002, 1, 1, 'C', '2016-08-02', '1:00 PM', '', 'R', '0.00', '0.00', NULL, NULL, NULL);

