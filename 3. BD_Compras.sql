USE clinica;

create table PROVEEDOR(
	proveedorID varchar(15) NOT NULL,
	tipoDocumento varchar(05) not null,
	razonSocial varchar(100) null,
	emailEmpresa varchar(50) null,
	direccion varchar(100) null,
	condPago char(03) null,
	banco int null,
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
	foreign key(tipoTelefono) references tipo_telefono(tipoTelefonoID)
);

create table TIPO_EXISTENCIA(
	codigo char(02) not null,
	descripcion varchar(150) not null,
	estado char(01) not null,
	primary key(codigo)
);

create table TIPO_DOCUMENTO(
	tipoDocumentoID int not null,
	tipoDocumento varchar(150) not null,
	estado char(01) not null,
	primary key(tipoDocumentoID)
);


insert into TIPO_EXISTENCIA values
	('01','MERCADERÍAS','A'),
	('02','PRODUCTOS TERMINADOS','A'),
	('03','MATERIAS PRIMAS','A'),
	('04','ENVASES','A'),
	('05','MATERIALES AUXILIARES','A'),
	('06','SUMINISTROS','A'),
	('07','REPUESTOS','A'),
	('08','EMBALAJES','A'),
	('09','SUBPRODUCTOS','A'),
	('10','DESECHOS Y DESPERDICIOS','A'),
	('99','OTROS','A');
	
insert into TIPO_DOCUMENTO values
	('0','OTROS TIPOS DE DOCUMENTOS','A'),
	('1','DOCUMENTO NACIONAL DE IDENTIDAD (DNI)','A'),
	('4','CARNET DE EXTRANJERIA','A'),
	('6','REGISTRO ÚNICO DE CONTRIBUYENTES(RUC)','A'),
	('7','PASAPORTE','A');
	