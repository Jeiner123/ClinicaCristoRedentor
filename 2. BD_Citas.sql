USE clinica;

drop table if exists movimiento_caja;
drop table if exists DETALLE_CAJA;
drop table if exists CAJA;
drop table if exists CITA;
drop table if exists PAGO;
drop table if exists PEDIDO_SERVICIO;






CREATE TABLE PEDIDO_SERVICIO(
	pedidoServicioID INT 				NOT NULL auto_increment,
	pacienteID INT 							NOT NULL,
	personalReferenciaID INT 		NULL,
	tipo CHAR(1) 								NOT NULL, 								/* C: Consultorio | L: Laboratorio */
	via CHAR(1) 								NOT NULL,									/* P: Personal | T: Teléfono |	W:Web |	F:Facebook */
	tasaIGV decimal(9,2) 				NULL,					/* IGV ACTUAL */
	importeSinIGV decimal(9,2) 	NULL,
	importeIGV decimal(9,2) 		NULL,
	importeTotal decimal(9,2) 	NULL,
	importePagado decimal(9,2) 	NULL,
	formaPagoID CHAR(3) 				NULL,					/* Contado | Crédito */
	estadoPago CHAR(3) 					NOT NULL,				/* PAG: Pagado | PEN: Pendiente | PAR:Parcial | XXX: Anulado*/
	timestamp timestamp 				NOT NULL,
	primary key(pedidoServicioID),
	foreign key(pacienteID) references paciente(pacienteID),
	foreign key(formaPagoID) references forma_pago(formaPagoID),
	foreign key(personalReferenciaID) references personal(personalID)
);
CREATE TABLE PAGO(
	pagoID INT NOT NULL auto_increment,
	pedidoServicioID INT NOT NULL,
	comprobanteID CHAR(3) NULL,    		/* B: Boleta | F: Factura */
	numeroSerie VARCHAR(5) NULL,
	numeroComprobante VARCHAR(9) NULL,
	IGV decimal(9,2) NOT NULL,
	importeSinIGV decimal(9,2) NOT NULL,
	importeIGV decimal(9,2) NOT NULL,
	importeTotal decimal(9,2) NOT NULL,
	fechaPago date NOT NULL,
	fechaVence date NULL,
	estado INT NOT NULL,
	timestamp timestamp NOT NULL,
	primary key(pagoID),
	foreign key(pedidoServicioID) references PEDIDO_SERVICIO(pedidoServicioID),
	foreign key(comprobanteID) references COMPROBANTE_PAGO(comprobanteID)
);
CREATE TABLE CITA(
	citaID INT NOT NULL auto_increment,
	pedidoServicioID INT NOT NULL,
	pacienteID INT NOT NULL,
	medicoID INT NULL,								/* Médico que atenderá */
	especialidadID INT NULL,			/* Especialidad */
	servicioID INT NULL,
	tipo CHAR(1) NOT NULL, 						/* C: Consultorio | L: Laboratorio */
	fecha date NOT NULL,
	hora VARCHAR(8) NOT NULL,
	observaciones VARCHAR(500) NULL,
	estado CHAR(1) NOT NULL,				/* R: Reservado | C: Confirmado | S: En sala | A: Atendido | X: Anulado */
	precio decimal(9,2) NOT NULL,
	cantidad decimal(9,2) NOT NULL,
	diagnostico VARCHAR(500) NULL,
	tratamiento VARCHAR(500) NULL,
	medicamento	VARCHAR(500) NULL,	
	primary key(citaID),
	foreign key(pedidoServicioID) references PEDIDO_SERVICIO(pedidoServicioID),
	foreign key(pacienteID) references paciente(pacienteID),	
	foreign key(medicoID) references personal(personalID),
	foreign key(especialidadID) references especialidad(especialidadID),
	foreign key(servicioID) references servicio(servicioID)
);

CREATE TABLE caja(
  cajaID          INT       		NOT NULL AUTO_INCREMENT,
  descripcion     VARCHAR(100)  NULL,
  estado          CHAR(1)       NOT NULL ,     /* A:APERTURADA - C:CERRADA - I:INACTIVO */
  fechaCreacion   DATE          NOT NULL,  
  PRIMARY KEY(cajaID)
);
CREATE TABLE detalle_caja(
	detalleCajaID   	INT 		 			NOT NULL AUTO_INCREMENT,
	cajaID 						INT 		 			NOT NULL,
	personalID 				INT     	 		NOT NULL,
	fechaApertura			TIMESTAMP 	 	NOT NULL,
	saldoInicial			DECIMAL(9,2) 	NOT NULL,
	fechaCierre 			TIMESTAMP 	 	NULL,
	boucherInicial		VARCHAR(20)  	NULL,
	boucherFinal			VARCHAR(20)  	NULL,
	totalBoucher			DECIMAL(9,2) 	NULL,
	cantidadBouchers  INT 		 			NULL,
	boletaInicial 		VARCHAR(20)  	NULL,
	boletaFinal 			VARCHAR(20)  	NULL,
	totalBoleta 			DECIMAL(9,2) 	NULL,
	cantidadBoletas 	INT 		 			NULL,
	facturaInicial 		VARCHAR(20)  	NULL,
	facturaFinal   		VARCHAR(20)  	NULL,
	totalFactura  		DECIMAL(9,2) 	NULL,
	cantidadFacturas 	INT 		 			NULL,
	totalVentas       DECIMAL(9,2) 	NULL,
	totalTarjeta      DECIMAL(9,2) 	NULL,
	totalDescuentos   DECIMAL(9,2) 	NULL,
	totalIngresos     DECIMAL(9,2) 	NULL,
	totalEgresos      DECIMAL(9,2) 	NULL,
	saldoActual       DECIMAL(9,2) 	NULL,
	saldoReal         DECIMAL(9,2) 	NULL,
	descuadre         DECIMAL(9,2) 	NULL,
	retiro						DECIMAL(9,2) 	NULL,
	remanente         DECIMAL(9,2) 	NULL,
	observaciones     VARCHAR(255) 	NULL,
	PRIMARY KEY (detalleCajaID),
	FOREIGN KEY (cajaID)  		REFERENCES caja(cajaID),
	FOREIGN KEY (personalID) REFERENCES personal(personalID)
);
CREATE TABLE movimiento_caja(
	movimientoCajaID 	INT 				 NOT NULL AUTO_INCREMENT,
	detalleCajaID 			INT   			 NOT NULL,
	fecha 						DATE 				 NOT NULL,
	motivo 						VARCHAR(200) NULL,
	ingreso 					DECIMAL(9,2) NULL,
	egreso 	 					DECIMAL(9,2) NULL,
	pagoID 	    			INT 				 NULL,
	PRIMARY KEY (movimientoCajaID),
	FOREIGN KEY (detalleCajaID) REFERENCES detalle_caja(detalleCajaID),
	FOREIGN KEY (pagoID) REFERENCES pago(pagoID)
);

INSERT INTO caja(cajaID,descripcion,estado,fechaCreacion) VALUES
	(1,"Caja principal",'C','2016-08-13 16:05:25');