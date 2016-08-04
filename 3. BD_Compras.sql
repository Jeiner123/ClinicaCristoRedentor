USE clinica;

create table PROVEEDOR(
	proveedorID varchar(15) NOT NULL,
	tipoEntidad int not null,
	tipoDocumento int not null,
	razonSocial varchar(100) null,
	emailEmpresa varchar(50) null,
	direccion varchar(100) null,
	banco int null,
	cuentaBanco varchar(100) null,
	nombres varchar(50) not null,
	apellidoPat varchar(20) not null,
	apellidoMat varchar(20) not null,
	telefono varchar(20) not null,
	emailPersonal varchar(50) null,
	observaciones varchar(500) null,
	estado char(01) not null,
	primary key(proveedorID)
);

create table TIPO_TRANSACCION(
	codigo char(04) not null,
	descripcion varchar(150) not null,
	tipo char(01) not null,
	estado char(01) not null,
	primary key(codigo)
);

CREATE TABLE PRODUCTO(
	codigo int not null,
	descripcion varchar(150) not null,
	estado char(01) not null,
	fecha date not null,
	primary key(codigo)
);

insert into TIPO_TRANSACCION values
	('C001','COMPRA DE MERCADERÍAS(PRODUCTOS)','C','A'),
	('C002','IMPORTACIÓN DE MERCADERÍAS(PRODUCTOS)','C','A'),
	('C003','COMPRA DE MATERIA PRIMA','C','A'),
	('C004','IMPORTACIÓN DE MATERIA PRIMA','C','A'),
	('C005','COMPRA DE MATERIALES AUXILIARES','C','A'),
	('C006','COMPRA DE SUMINISTROS','C','A'),
	('C007','COMPRA DE ENVASES','C','A'),
	('C008','COMPRA DE EMBALAJES','C','A');
	