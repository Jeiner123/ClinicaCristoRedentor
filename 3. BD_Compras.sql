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

create table ENTIDAD_FINANCIERA(
	entidadFinancieraID char(02) not null,
	entidadFinanciera varchar(150) not null,
	estado char(01) not null,
	primary key(entidadFinancieraID)
);


insert into TIPO_EXISTENCIA values
	('01','MERCADERÍAS, MATERIAS PRIMAS, SUMINISTROS, ENVASES Y EMBALAJES','A'),
	('02','ACTIVO FIJO','A'),
	('03','OTROS ACTIVOS NO CONSIDERADOS EN EL NUMERAL 01 Y 02','A'),
	('04','GASTOS DE EDUCACIÓN,SALUD, RECREACION, CULTURALES','A'),
	('05','OTROS GASTOS NO INCLUIDOS EN EL NUMERAL 04','A');

	
insert into TIPO_DOCUMENTO values
	('0','OTROS TIPOS DE DOCUMENTOS','A'),
	('1','DOCUMENTO NACIONAL DE IDENTIDAD (DNI)','A'),
	('4','CARNET DE EXTRANJERIA','A'),
	('6','REGISTRO ÚNICO DE CONTRIBUYENTES(RUC)','A'),
	('7','PASAPORTE','A');

insert into ENTIDAD_FINANCIERA values
	('01','CENTRAL RESERVA DEL PERU ','A'),
	('02','DE CREDITO DEL PERU','A'),
	('03','INTERNACIONAL DEL PERU','A'),
	('05','LATINO ','A'),
	('07','CITIBANK DEL PERU S.A.','A'),
	('08','STANDARD CHARTERED','A'),
	('09','SCOTIABANK PERU','A'),
	('11','CONTINENTAL','A'),
	('12','DE LIMA','A'),
	('16','MERCANTIL ','A'),
	('18','NACION ','A'),
	('22','SANTANDER CENTRAL HISPANO','A'),
	('23','DE COMERCIO','A'),
	('25','REPUBLICA','A'),
	('26','NBK BANK','A'),
	('29','BANCOSUR','A'),
	('35','FINANCIERO DEL PERU','A'),
	('37','DEL PROGRESO','A'),
	('38','INTERAMERICANO FINANZAS','A'),
	('39','BANEX','A'),
	('40','NUEVO MUNDO','A'),
	('41','SUDAMERICANO','A'),
	('42','DEL LIBERTADOR','A'),
	('43','DEL TRABAJO','A'),
	('44','SOLVENTA','A'),
	('45','SERBANCO SA.','A'),
	('46','BANK OF BOSTON','A'),
	('47','ORION ','A'),
	('48','DEL PAIS ','A'),
	('49','MI BANCO','A'),
	('50','BNP PARIBAS','A'),
	('53','HSBC BANK PERU S.A.','A'),
	('59','OTROS','A');

insert into TIPO_ADQUISICION values
	('1','DESTINO GRAVADO','A'),
	('2','DESTINO MIXTO','A'),
	('3','DESTINO NO GRAVADO','A'),
	('4','NO GRAVADA','A');

	