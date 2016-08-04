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