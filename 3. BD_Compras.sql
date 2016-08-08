USE clinica;

create table PROVEEDOR(
	proveedorID varchar(15) NOT NULL,
	tipoDocumento int not null,
	razonSocial varchar(100) null,
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
	foreign key(tipoTelefono) references tipo_telefono(tipoTelefonoID),
	foreign key(tipoDocumento) references tipo_documento(tipoDocumentoID)
);

create table TIPO_EXISTENCIA(
	codigo char(02) not null,
	descripcion varchar(150) not null,
	estado char(01) not null,
	primary key(codigo)
);

create table TIPO_ADQUISICION(
	tipoAdquisicionID int not null,
	tipoAdquisicion varchar(150) not null,
	estado char(01) not null,
	primary key(tipoAdquisicionID)
);

create table TIPO_DOCUMENTO(
	tipoDocumentoID int not null,
	tipoDocumento varchar(150) not null,
	estado char(01) not null,
	primary key(tipoDocumentoID)
);

create table TIPO_DETRACCION(
	tipoDetraccionID int not null,
	tipoDetraccion varchar(200) not null,
	tipoCompra char(01) not null,
	porcentaje decimal(6,3) not null,
	estado char(01) not null,
	primary key(tipoDetraccionID)
);

create table ENTIDAD_FINANCIERA(
	entidadFinancieraID char(02) not null,
	entidadFinanciera varchar(150) not null,
	estado char(01) not null,
	primary key(entidadFinancieraID)
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
	IGV int not null,
	detraccion int not null,
	percepcion int not null,
	renta int not null,
	totalBruto decimal(9,2) not null,
	descuento decimal(9,2) not null,
	valorVenta decimal(9,2) not null,
	impuesto decimal(9,2) not null,
	precioVenta decimal(9,2) not null,
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

	