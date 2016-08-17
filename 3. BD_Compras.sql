USE clinica;

create table PROVEEDOR(
	proveedorID varchar(15) NOT NULL,
	tipoDocumento int not null,
	razonSocial varchar(300) null,
	emailEmpresa varchar(50) null,
	direccion varchar(100) null,
	condPago char(03) null,
	banco char(02) null,
	cuentaBanco varchar(100) null,
	cuentaDetraccion varchar(100) null,
	nombres varchar(50) not null,
	apellidoPat varchar(20) not null,
	apellidoMat varchar(20) not null,
	telefono varchar(20) not null,
	tipoTelefono int null,
	emailPersonal varchar(50) null,
	observaciones varchar(500) null,
	estado char(01) not null,
	primary key(proveedorID),
	foreign key(tipoDocumento) references tipo_documento(tipoDocumentoID)
);

create table ORDEN_COMPRA(
	codigo int not null,
	fecha date not null,
	areaID int not null,
	proveedorID varchar(15) NOT NULL,
	formaPagoID char(03) NOT NULL,
	moneda int not null,
	igv decimal(9,2) null,
	percepcion decimal(9,2) null,
	valorPercepcion decimal(9,2) null,
	totalBruto decimal(9,2) not null,
	descuento decimal(9,2) not null,
	valorVenta decimal(9,2) not null,
	impuesto decimal(9,2) not null,
	precioVenta decimal(9,2) not null,
	total decimal(9,2) not null,
	etado CHAR(01) NOT NULL,
	primary key(codigo),
	foreign key(areaID) references area(areaID),
	foreign key(proveedorID) references proveedor(proveedorID),
	foreign key(formaPagoID) references forma_pago(formaPagoID)
);

create table DETALLE_ORDEN_COMPRA(
	codigo int not null,
	item int not null,
	descripcion varchar(200) not null,
	unidad varchar(100) not null,
	cantidad int not null,
	costo decimal(9,2) NOT NULL,
	descuento decimal(9,2) NOT NULL,
	importe decimal(9,2) NOT NULL,
	primary key(codigo,item),
	foreign key(codigo) references ORDEN_COMPRA(codigo)
);

create table COMPRA(
	mesID int not null,
	anio int not null,
	codigo int not null,
	fecha date not null,
	comprobanteID char(2) not null,
	proveedorID varchar(15) not null,
	serie varchar(4) null,
	numero varchar(8) null,
	fechaEmision date not null,
	fechaVencimiento date not null,
	moneda int not null,
	formaPagoID char(3) not null,
	tipoAdquisicionID int not null,
	tipoExistencia char(02) not null,
	IGV decimal(9,2) null,
	detraccion decimal(9,2) null,
	valorDetraccion decimal(9,2) null,
	percepcion decimal(9,2) null,
	valorPercepcion decimal(9,2) null,
	renta decimal(9,2) null,
	valorRenta decimal(9,2) null,
	retencion decimal(9,2) null,
	valorRetencion decimal(9,2) null,
	totalBruto decimal(9,2) not null,
	descuento decimal(9,2) not null,
	valorVenta decimal(9,2) not null,
	impuesto decimal(9,2) not null,
	precioVenta decimal(9,2) not null,
	saldo decimal(9,2) not null,
	saldoPagar decimal(9,2) not null,
	detalles int not null,
	estado char(01) not null,
	primary key(mesID,anio,codigo),
	foreign key(comprobanteID) references comprobante_pago(comprobanteID),
	foreign key(proveedorID) references PROVEEDOR(proveedorID),
	foreign key(formaPagoID) references forma_pago(formaPagoID),
	foreign key(tipoAdquisicionID) references TIPO_ADQUISICION(tipoAdquisicionID),
	foreign key(tipoExistencia) references TIPO_EXISTENCIA(codigo)
);

create table DETALLE_COMPRA(
	mesID int not null,
	anio int not null,
	codigo int not null,
	item int not null,
	referencia varchar(10) null,
	cuenta varchar(10) null,
	descripcion varchar(150) not null,
	cantidad int not null,
	costoUnitario decimal(9,2) not null,
	importe decimal(9,2) not null,
	primary key(mesID,anio,codigo,item),
	foreign key(mesID,anio,codigo) references COMPRA(mesID,anio,codigo)
);

create table PAGO_COMPRA(
	mesID int not null,
	anio int not null,
	correlativo int not null,
	mesReferencia int not null,
	anioReferencia int not null,
	codigoReferencia int not null,
	fechaEmision date not null,
	medioPagoID CHAR(3) NOT NULL,
	valorVenta decimal(9,2),
	igv decimal(9,2),
	monto decimal(9,2),
	saldo decimal(9,2),
	entidadFinancieraID char(02) null,
	cuenta varchar(30) null,
	voucher varchar(30) null,
	numeroCk varchar(30) null,
	fechaVctoCk date null,
	concepto char(01) null,
	primary key(mesID,anio,correlativo),
	foreign key(mesReferencia,anioReferencia,codigoReferencia) references COMPRA(mesID,anio,codigo)
);

create table requerimiento(
	requerimientoID int not null,
	personalID INT  NOT NULL,
	fecha date NOT NULL,
	detalle int not null,
	estado char(01) NOT NULL,
	primary key(requerimientoID),
	foreign key(personalID) references personal(personalID)
);

create table detalle_requerimiento(
	requerimientoID int not null,
	item int not null,
	producto varchar(150) not null,
	unidadMedida varchar(50) null,
	descripcion varchar(200) null,
	stock int not null,
	requerimiento int null,
	estado char(01) not null,
	primary key(requerimientoID,item),
	foreign key(requerimientoID) references requerimiento(requerimientoID)
);


create table estructura_plan_contable(
	estructuraID int not null,
	nombre varchar(100) not null,
	estado char(01) not null,
	primary key(estructuraID)
);

create table tipo_cuenta(
	tipoCuentaID varchar(8) NOT NULL,
	estructuraID int not null,
	CuentaPadre varchar(8) null,
	tipoCuenta varchar(200) not null,
	estado char(01) not null,
	primary key(tipoCuentaID),
	foreign key(estructuraID) references estructura_plan_contable(estructuraID)
);

INSERT INTO estructura_plan_contable VALUES
  (1, 'Clase','A'),
  (2, 'Grupo','A'),
  (3, 'Cuenta','A'),
  (4, 'Subcuenta','A'),
  (5, 'Auxiliares','A');

 INSERT INTO tipo_cuenta VALUES
  (1,1,0,'ACTIVOS','A'),
  (2,1,0,'PASIVOS','A'),
  (3,1,0,'PATRIMONIO','A'),
  (4,1,0,'INGRESOS','A'),
  (5,1,0,'GASTOS','A'),
  (6,1,0,'COSTOS DE VENTAS','A'),
  (7,1,0,'COSTOS DE TRANSFORMACIÓN','A'),
  (8,1,0,'CUENTAS DE ORDEN DEUDORAS','A'),
  (9,1,0,'CUENTAS DE ORDEN ACREEDORAS','A'),
  (11,2,1,'EFECTIVO Y EQUIVALENTES AL EFECTIVO','A'),
  (12,2,1,'INVERSIONES E INSTRUMENTOS DERIVADAS','A'),
  (13,2,1,'CUENTAS POR COBRAR','A'),
  (14,2,1,'PRÉSTAMOS POR COBRAR','A');

INSERT INTO proveedor VALUES
('18182000', 1, '', '', '', '0', '00', '', '', 'LUIS', 'NEYRA', 'QUIPUSCO', '938302014', 5, '', '', 'A'),
('20100018625', 6, 'MEDIFARMA S A', '', 'JR. ECUADOR NRO. 787 LIMA - LIMA - LIMA', '0', '00', '', '', 'Eduardo', 'samana', 'velarde', '044563212', 2, '', '', 'A'),
('20131911310', 6, 'SEDALIB S.A.', '', 'AV. FEDERICO VILLARREAL NRO. 1300 URB. SEMI RUSTICA EL BOSQUE LA LIBERTAD - TRUJILLO - TRUJILLO', 'CON', '00', '', '', '', '', '', '', 0, '', '', 'A'),
('20132023540', 6, 'EMPRESA REGIONAL DE SERVICIO PUBLICO DE ELECTRICIDAD ELECTRONORTEMEDIO SOCIEDAD ANONIMA - HIDRANDINA', '', 'JR. SAN MARTIN NRO. 831 LA LIBERTAD - TRUJILLO - TRUJILLO', '0', '00', '', '', '', '', '', '', 0, '', '', 'A'),
('20559727459', 6, 'CONSTRUCTORES & ACABADOS S.A.C.', '', 'CAL.LAS ORQUIDEAS NRO. 250 INT. 402 URB. SANTA EDELMIRA LA LIBERTAD - TRUJILLO - VICTOR LARCO HERRER', '0', '00', '', '', 'pEDRO', 'MARTINEZ', 'PEÑA', '987458656', 3, '', '', 'A'),
('48055960', 1, '', '', '', 'CON', '00', '', '', 'MARÍA', 'MEDINA', 'CARRERA', '958654589', 8, '', '', 'A');