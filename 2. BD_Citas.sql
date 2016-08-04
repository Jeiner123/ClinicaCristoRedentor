USE clinica;

drop table if exists CITA;
drop table if exists PAGO;
drop table if exists PEDIDO_SERVICIO;
drop table if exists comprobante_pago;

CREATE TABLE comprobante_pago (
  comprobanteID char(3) NOT NULL,
  descripcion varchar (100) NOT NULL,
  estado int NOT NULL,
  compras boolean NOT NULL,
  ventas boolean NOT NULL,
  ingresos boolean NOT NULL,
  egresos boolean NOT NULL,
  honorarios boolean NOT NULL,
  diario boolean NOT NULL,
  PRIMARY KEY (comprobanteID)
);

create table PEDIDO_SERVICIO(
	pedidoServicioID int not null auto_increment,
	pacienteID int not null,
	personalReferenciaID int null,
	tipo char(1) not null, 								/* C: Consultorio | L: Laboratorio */
	via char(1) not null,									/* P: Personal | T: Teléfono |	W:Web |	F:Facebook */
	tasaIGV decimal(9,2) null,					/* IGV ACTUAL */
	importeSinIGV decimal(9,2) null,
	importeIGV decimal(9,2) null,
	importeTotal decimal(9,2) null,
	importePagado decimal(9,2) null,
	formaPagoID char(3) null,					/* Contado | Crédito */
	estadoPago char(3) not null,					/* PAG: Pagado | PEN: Pendiente |	PAR:Parcial */
	timestamp timestamp not null,
	primary key(pedidoServicioID),
	foreign key(pacienteID) references paciente(pacienteID),
	foreign key(formaPagoID) references forma_pago(formaPagoID),
	foreign key(personalReferenciaID) references personal(personalID)
);

create table PAGO(
	pagoID int not null auto_increment,
	pedidoServicioID int not null,
	comprobanteID char(3) null,    		/* B: Boleta | F: Factura */
	numeroSerie varchar(5) null,
	numeroComprobante varchar(20) null,
	importe decimal(9,2) not null,
	fechaPago date not null,
	fechaVence date null,
	estado int not null,
	primary key(pagoID),
	foreign key(pedidoServicioID) references PEDIDO_SERVICIO(pedidoServicioID),
	foreign key(comprobanteID) references COMPROBANTE_PAGO(comprobanteID)
);

create table CITA(
	citaID int not null auto_increment,
	pedidoServicioID int not null,
	pacienteID int not null,
	medicoID int null,								/* Médico que atenderá */
	especialidadID int null,			/* Especialidad */
	servicioID int null,
	tipo char(1) not null, 						/* C: Consultorio | L: Laboratorio */
	fecha date not null,
	hora varchar(8) not null,
	observaciones varchar(500) null,
	estado char(1) not null,					/* R: Reservado | S: En sala | A: Atendido |	X: Anulado */
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


insert into COMPROBANTE_PAGO(comprobanteID,descripcion,estado,compras,ventas,ingresos,egresos,honorarios,diario) values
	('000','OTRO',1,1,1,0,0,0,1),
	('001','FACTURA',1,1,1,0,0,0,1),
	('002','RECIBO POR NONORARIOS',1,1,0,0,0,1,1),
	('003','BOLETA DE VENTA',1,1,1,1,1,0,1),
	('004','LIQUIDACION DE COMPRA',1,1,0,0,0,0,0),
	('005','BOLETO DE COMPAÑIA DE AVIACION COMERCIAL POR EL SERVICIO DE TRANSPORTE AEREO DE PASAJEROS',1,0,0,0,0,0,0),
	('006','CARTA DE PORTE AEREO POR EL SERVICIO DE TRANSPORTE DE CARGA AEREA',1,0,0,0,0,0,0),
	('007','NOTA DE CREDITO',1,1,1,0,0,0,0),
	('008','NOTA DE DEBITO',1,1,1,0,0,0,0);
