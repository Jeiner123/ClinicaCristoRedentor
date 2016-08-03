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

-- /*TABLAS CON DATOS, PERO NO REALES.... */
	create table especialidad(
		especialidadID int  not null auto_increment,
		especialidad varchar(100)  not null,
		estado int not null, 								/*1: Activo, 2:Inactivo, 3:Elimnado*/
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
	pacienteID int(6) not null auto_increment, /*Nro de historia clinica tbm*/
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


insert into tipo_telefono(tipoTelefono,estado) values		
	('Otro',1),
	('Fijo',1),
	('Claro',1),
	('RPC Claro ',1),
	('Movistar',1),
	('RPM Movistar ',1),
	('Bitel',1),
	('Entel',1);
insert into tipo_personal(tipoPersonal,estado) values
	('MEDICO',1),			
	('DE SALUD',1),   /*Enfermeras - Laboratoristas*/
	('DE APOYO',1),
	('ADMINISTRATIVO',1);
insert into area(area,estado) values
	/*1*/('GERENCIA',1),
	/*2*/('DIRECCION DE GESTION',1),
	/*3*/('TECNOLOGIAS DE LA INFORMACION',1),
	/*4*/('ADMINISTRACION',1),
	/*5*/('RECURSOS HUMANOS',1),
	/*6*/('INFRAESTRUCTURA Y LOGISTICA',1),
	/*7*/('CONTABILIDAD Y FINANZAS',1),
	/*8*/('MARKETING Y VENTAS',1),
	/*9*/('DIRECCION MEDICA',1),
	/*10*/('ADMINISION Y SERVICIO AL CLIENTE',1),
	/*11*/('ESPECIALIDADES MEDICAS',1),
	/*12*/('APOYO DX Y TERAPEUTICO',1),
	/*13*/('LABORATORIO',1),
	/*14*/('SALUD OCUPACIONAL',1),
	/*15*/('HOSPITALIZACION',1);
insert into cargo(areaID,cargo,estado) values
	(1,'GERENTE',1),
	(1,'ASISTENTE',1),
	(2,'DIRECTOR',1),
	(2,'ASISTENTE',1),
	(3,'COORDINADOR',1),
	(3,'PRACTICANTE',1),
	(4,'ADMINISTRADOR',1),
	(5,'JEFE',1),
	(5,'COORDINADOR',1),
	(6,'COORDINADOR',1),
	(6,'ASISTENTE',1),
	(7,'CONTADOR',1),
	(7,'ASISTENTE',1),
	(8,'COORDINADOR',1),
	(8,'JEFE',1),
	(9,'DIRECTOR',1),
	(9,'MEDICO',1),
	(10,'ENFERMERA',1),
	(10,'RECEPCIONISTA',1),
	(11,'MEDICO',1),
	(11,'ENFERMERA',1),
	(11,'ASISTENTE',1),
	(12,'COORDINADOR',1),	
	(12,'JEFE',1),
	(13,'COORDINADOR',1),
	(13,'ASISTENTE',1),
	(13,'PRACTICANTE',1),
	(14,'RECEPCIONISTA',1),
	(14,'MEDICO',1),
	(14,'ENFERMERA',1),
	(14,'PSICOLOGA',1),
	(15,'DIRECTOR',1),
	(15,'MEDICO',1),
	(15,'ENFERMERA',1);
insert into procedencia(procedencia,estado) values
	('B - LAREDO' ,1),
	('B - EL PORVENIR' ,1),
	('B - FLORENCIA DE MORA' ,1),
	('B - LA ESPERANZA' ,1),
	('B - TRUJILLO' ,1);

INSERT INTO persona (DNI, nombres, apPaterno, apMaterno, fechaNacimiento, sexo, telefono1, tipoTelefono1, telefono2, tipoTelefono2, correoPersonal, RUC, direccion, foto, timestamp) VALUES
('47790815', 'JUAN JEINY', 'HARO', 'GUTIERREZ', '1993-05-24', 'M', '987050724', 4, NULL, NULL, 'jeiner.24@gmail.com', NULL, 'HUERTA BELLA MZ. F LT. 05 - LA RINCONADA', NULL, '2016-07-29 15:31:43');
INSERT INTO personal (personalID, DNI, tipoPersonalID, cargoID, fechaIngreso, correoCorporativo, sueldoMensual, estado, observaciones) VALUES
(1001, '47790815', 3, 5, '2016-03-01', 'soporteti@clinicacristoredentor.com', '0.00', 1, '');
INSERT INTO usuario (usuario, clave, DNI, permisoID, estado) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', '47790815', 3, 1);
