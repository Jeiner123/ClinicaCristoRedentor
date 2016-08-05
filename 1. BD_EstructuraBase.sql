drop database if exists clinica;
create database clinica;
USE clinica;

-- 	Especialidad
-- 	tipo Servicio
-- 	tipo Telefono
-- 	tipo Personal
-- 	Servicio
-- 	Procedencia
-- 	Usuario
-- 	Area
-- 	cargo
-- 	Persona
-- 	Personal

-- TABLES WITH DUMMY DATA

	create table especialidad(
		especialidadID int  not null auto_increment,
		especialidad varchar(100)  not null,
		estado int not null, 								/* 1: Activo | 2: Inactivo | 3: Elimnado */
		primary key(especialidadID)
	);
	create table tipo_servicio(
		tipoServicioID int not null auto_increment,
		tipoServicio varchar(150) not null,	
		estado int not null,
		primary key(tipoServicioID)
	);
	create table servicio(
		servicioID int not null auto_increment,	
		servicio varchar(150) not null,
		precioUnitario decimal(9,2) not null,		
		tipoServicioID int null,
		especialidadID int not null,
		estado int not null,
		primary key(servicioID),
		foreign key(tipoServicioID) references tipo_servicio(tipoServicioID),
		foreign key(especialidadID) references especialidad(especialidadID)
	);
	create table tipo_telefono(
		tipoTelefonoID int not null auto_increment,
		tipoTelefono varchar(50) not null,
		estado int not null,
		primary key(tipoTelefonoID)
	);
	create table procedencia(
		procedenciaID int not null auto_increment,
		procedencia varchar(50) not null,
		estado int not null,
		primary key(procedenciaID)
	);
	create table tipo_personal(
		tipoPersonalID int not null auto_increment,
		tipoPersonal varchar(50) not null,
		estado int not null,
		primary key(tipoPersonalID)
	);	
	create table area(
		areaID int not null auto_increment,
		area varchar(50) not null,
		estado int not null,
		primary	 key(areaID)
	);
	create table cargo(
		cargoID int not null auto_increment,
		areaID int not null,
		cargo varchar(50) not null,
		estado int not null,
		primary	 key(cargoID),
		foreign key(areaID) references area(areaID)
	);
	create table persona(
		DNI char(8) not null,
		nombres varchar(50) not null,
		apPaterno varchar(50)  not null,
		apMaterno varchar(50) not null,
		fechaNacimiento date null,
		sexo char(1) not null,
		telefono1 varchar(20)  null,
		tipoTelefono1 int  null,
		telefono2 varchar(20) null,
		tipoTelefono2 int null,
		correoPersonal varchar(150) null,
		RUC char(11) null,
		direccion varchar(255) null,
		foto varchar(255) null,
		timestamp timestamp null,
		primary key(DNI),
		foreign key(tipoTelefono1) references tipo_telefono(tipoTelefonoID),
		foreign key(tipoTelefono2) references tipo_telefono(tipoTelefonoID)
	);
create table paciente(
	pacienteID int(6) not null auto_increment, /* Nro de historia clínica */
	DNI char(8) not null,
	familiarDNI char(8) null,
	parentesco varchar(100) null,
	estado int not null,
	procedenciaID int null,
	observaciones varchar(255)	 null,
	primary key(pacienteID),
	foreign key(DNI) references persona(DNI),
	foreign key(familiarDNI) references persona(DNI),
	foreign key(procedenciaID) references procedencia(procedenciaID)
);
ALTER TABLE paciente AUTO_INCREMENT = 1001;
create table personal(
	personalID int not null auto_increment,
	DNI char(8) not null,
	tipoPersonalID int not null,	
	cargoID int not null,
	fechaIngreso date null,
	correoCorporativo varchar(150) null,
	sueldoMensual decimal(9,2) null,
	estado int not null,
	observaciones varchar(255) null,
	primary key(personalID),
	foreign key(DNI) references persona(DNI),
	foreign key(cargoID) references cargo(cargoID),
	foreign key(tipoPersonalID) references tipo_personal(tipoPersonalID)
);
ALTER TABLE personal AUTO_INCREMENT = 1001;

create table personal_salud(
	personalID int not null,
	especialidadID int  not null,
	primary key(personalID,especialidadID),
	foreign key (personalID) references personal(personalID),
	foreign key (especialidadID) references especialidad(especialidadID)
);

create table control_documento(
	controlDocumentoID varchar(10) not null,
	nroRevision char(2) not null,
	titulo varchar(200) not null,
	ruta varchar(255) not null,
	estado  varchar(20) not null,
	fechaCreacion date  null,
	fechaVencimiento date null,
	fechaActualizacion date null,
	fechaAprobacion date null,
	tipoDocumento varchar(50) not null,
	areaID int not null,
	acceso varchar(150) null,
	distribucion varchar(255) null,
	observaciones varchar(255) null,
	evidencia varchar(255) null,
	primary key(controlDocumentoID,nroRevision),
	foreign key(areaID) references area(areaID)
);
	
create table registro_requerido(
	registroRequeridoID varchar(10) not null,
	nroRevision char(2) not null,
	controlDocumentoID varchar(10) not null,
	nroRevisionCD char(2) not null,
	titulo varchar(200) not null,
	frecuencia varchar(20) not null,
	formato varchar(255) null,	
	estado  varchar(20) not null,
	fechaAprobacion date null,	
	areaOrigenID int not null,
	areaResponsable varchar(50) null,
	soporte varchar(150) null,
	acceso varchar(150) null,
	retencionArea varchar(20) null,
	retencionAlmacen varchar(20) null,
	observaciones varchar(255) null,
	primary key(registroRequeridoID,nroRevision),
	foreign key(controlDocumentoID,nroRevisionCD) references control_documento(controlDocumentoID,nroRevision),
	foreign key(areaOrigenID) references area(areaID)
);
create table usuario(
	usuario varchar(100) not null,
	clave varchar(200) not null,
	DNI char(8) not null,
	permisoID int not null,
	estado int not null,
	primary key(usuario),
	foreign key(DNI) references persona(DNI)
);
create table forma_pago(
	formaPagoID char(3) not null ,
	formaPago varchar(25) not null,
	numeroCuotas int not null,
	estado int not null,
	primary key(formaPagoID)
);
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

insert into forma_pago(formaPagoID,formaPago,numeroCuotas,estado) values
		("CON","CONTADO",1,1),
		("CRE","CREDITO",2,1);
insert into procedencia(procedencia,estado) values
	('B - LAREDO' ,1),
	('B - EL PORVENIR' ,1),
	('B - FLORENCIA DE MORA' ,1),
	('B - LA ESPERANZA' ,1),
	('B - TRUJILLO' ,1);

/*INSERT INTO persona (DNI, nombres, apPaterno, apMaterno, fechaNacimiento, sexo, telefono1, tipoTelefono1, telefono2, tipoTelefono2, correoPersonal, RUC, direccion, foto, timestamp) VALUES
('47790815', 'JUAN JEINY', 'HARO', 'GUTIERREZ', '1993-05-24', 'M', '987050724', 4, NULL, NULL, 'jeiner.24@gmail.com', NULL, 'HUERTA BELLA MZ. F LT. 05 - LA RINCONADA', NULL, '2016-07-29 15:31:43');
INSERT INTO personal (personalID, DNI, tipoPersonalID, cargoID, fechaIngreso, correoCorporativo, sueldoMensual, estado, observaciones) VALUES
(1001, '47790815', 3, 5, '2016-03-01', 'soporteti@clinicacristoredentor.com', '0.00', 1, '');
INSERT INTO usuario (usuario, clave, DNI, permisoID, estado) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', '47790815', 3, 1);
*/
