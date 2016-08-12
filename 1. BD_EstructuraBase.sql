DROP DATABASE IF EXISTS clinica;
CREATE DATABASE clinica;
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

-- LOS PARAMETROS NO SE RELACIONAN CON OTRAS TABLAS
-- SOLO SE UTILIZARÁN SUS VALORES
CREATE TABLE parametro (
  parametroID INT         NOT NULL AUTO_INCREMENT,
  parametro   VARCHAR(50) NOT NULL,
  valor       VARCHAR(50) NOT NULL,
  estado      INT         NOT NULL,
  PRIMARY KEY (parametroID)
);

CREATE TABLE especialidad (
  especialidadID INT          NOT NULL AUTO_INCREMENT,
  especialidad   VARCHAR(100) NOT NULL,
  estado         INT          NOT NULL, /* 1: Activo | 2: Inactivo | 3: Elimnado */
  PRIMARY KEY (especialidadID)
);
CREATE TABLE tipo_servicio (
  tipoServicioID INT          NOT NULL AUTO_INCREMENT,
  tipoServicio   VARCHAR(150) NOT NULL,
  estado         INT          NOT NULL,
  PRIMARY KEY (tipoServicioID)
);
CREATE TABLE servicio (
  servicioID     INT           NOT NULL AUTO_INCREMENT,
  servicio       VARCHAR(150)  NOT NULL,
  precioUnitario DECIMAL(9, 2) NOT NULL,
  tipoServicioID INT           NULL,
  especialidadID INT           NOT NULL,
  estado         INT           NOT NULL,
  PRIMARY KEY (servicioID),
  FOREIGN KEY (tipoServicioID) REFERENCES tipo_servicio (tipoServicioID),
  FOREIGN KEY (especialidadID) REFERENCES especialidad (especialidadID)
);
CREATE TABLE tipo_telefono (
  tipoTelefonoID INT         NOT NULL AUTO_INCREMENT,
  tipoTelefono   VARCHAR(50) NOT NULL,
  estado         INT         NOT NULL,
  PRIMARY KEY (tipoTelefonoID)
);
CREATE TABLE procedencia (
  procedenciaID INT         NOT NULL AUTO_INCREMENT,
  procedencia   VARCHAR(50) NOT NULL,
  estado        INT         NOT NULL,
  PRIMARY KEY (procedenciaID)
);
CREATE TABLE tipo_personal (
  tipoPersonalID INT         NOT NULL AUTO_INCREMENT,
  tipoPersonal   VARCHAR(50) NOT NULL,
  estado         INT         NOT NULL,
  PRIMARY KEY (tipoPersonalID)
);
CREATE TABLE area (
  areaID INT         NOT NULL AUTO_INCREMENT,
  area   VARCHAR(50) NOT NULL,
  estado INT         NOT NULL,
  PRIMARY KEY (areaID)
);
CREATE TABLE cargo (
  cargoID INT         NOT NULL AUTO_INCREMENT,
  areaID  INT         NOT NULL,
  cargo   VARCHAR(50) NOT NULL,
  estado  INT         NOT NULL,
  PRIMARY KEY (cargoID),
  FOREIGN KEY (areaID) REFERENCES area (areaID)
);
CREATE TABLE persona (
  personaID       INT          NOT NULL AUTO_INCREMENT,
  DNI             CHAR(8)      NOT NULL,
  nombres         VARCHAR(50)  NOT NULL,
  apPaterno       VARCHAR(50)  NOT NULL,
  apMaterno       VARCHAR(50)  NOT NULL,
  fechaNacimiento DATE         NULL,
  sexo            CHAR(1)      NOT NULL,
  telefono1       VARCHAR(20)  NULL,
  tipoTelefono1   INT          NULL,
  telefono2       VARCHAR(20)  NULL,
  tipoTelefono2   INT          NULL,
  correoPersonal  VARCHAR(150) NULL,
  RUC             CHAR(11)     NULL,
  direccion       VARCHAR(255) NULL,
  foto            VARCHAR(255) NULL,
  timestamp       TIMESTAMP    NULL,
  PRIMARY KEY (personaID),
  FOREIGN KEY (tipoTelefono1) REFERENCES tipo_telefono (tipoTelefonoID),
  FOREIGN KEY (tipoTelefono2) REFERENCES tipo_telefono (tipoTelefonoID)
);
CREATE TABLE paciente (
  pacienteID        INT          NOT NULL AUTO_INCREMENT, /* Nro de historia clínica */
  personaID         INT          NOT NULL,
  procedenciaID     INT          NULL,
  familiar          VARCHAR(255) NULL,
  telefonoFamiliar  VARCHAR(255) NULL,
  parentesco        VARCHAR(100) NULL,
  estado            INT          NOT NULL,   /*1: Activo , 2: Inactivo*/ 
  observaciones     VARCHAR(255) NULL,
  PRIMARY KEY (pacienteID),
  FOREIGN KEY (personaID) REFERENCES persona (personaID),  
  FOREIGN KEY (procedenciaID) REFERENCES procedencia (procedenciaID)
);

CREATE TABLE personal (
  personalID        INT           NOT NULL AUTO_INCREMENT,
  personaID         INT           NOT NULL,
  tipoPersonalID    INT           NOT NULL,
  cargoID           INT           NOT NULL,
  fechaIngreso      DATE          NULL,
  correoCorporativo VARCHAR(150)  NULL,
  sueldoMensual     DECIMAL(9, 2) NULL,
  estado            INT           NOT NULL,
  observaciones     VARCHAR(255)  NULL,
  PRIMARY KEY (personalID),
  FOREIGN KEY (personaID) REFERENCES persona (personaID),
  FOREIGN KEY (cargoID) REFERENCES cargo (cargoID),
  FOREIGN KEY (tipoPersonalID) REFERENCES tipo_personal (tipoPersonalID)
);
ALTER TABLE personal AUTO_INCREMENT = 1001;

CREATE TABLE personal_salud (
  personalID     INT NOT NULL,
  especialidadID INT NOT NULL,
  PRIMARY KEY (personalID, especialidadID),
  FOREIGN KEY (personalID) REFERENCES personal (personalID),
  FOREIGN KEY (especialidadID) REFERENCES especialidad (especialidadID)
);

CREATE TABLE control_documento (
  controlDocumentoID VARCHAR(10)  NOT NULL,
  nroRevision        CHAR(2)      NOT NULL,
  titulo             VARCHAR(200) NOT NULL,
  ruta               VARCHAR(255) NOT NULL,
  estado             VARCHAR(20)  NOT NULL,
  fechaCreacion      DATE         NULL,
  fechaVencimiento   DATE         NULL,
  fechaActualizacion DATE         NULL,
  fechaAprobacion    DATE         NULL,
  tipoDocumento      VARCHAR(50)  NOT NULL,
  areaID             INT          NOT NULL,
  acceso             VARCHAR(150) NULL,
  distribucion       VARCHAR(255) NULL,
  observaciones      VARCHAR(255) NULL,
  evidencia          VARCHAR(255) NULL,
  PRIMARY KEY (controlDocumentoID, nroRevision),
  FOREIGN KEY (areaID) REFERENCES area (areaID)
);

CREATE TABLE registro_requerido (
  registroRequeridoID VARCHAR(10)  NOT NULL,
  nroRevision         CHAR(2)      NOT NULL,
  controlDocumentoID  VARCHAR(10)  NOT NULL,
  nroRevisionCD       CHAR(2)      NOT NULL,
  titulo              VARCHAR(200) NOT NULL,
  frecuencia          VARCHAR(20)  NOT NULL,
  formato             VARCHAR(255) NULL,
  estado              VARCHAR(20)  NOT NULL,
  fechaAprobacion     DATE         NULL,
  areaOrigenID        INT          NOT NULL,
  areaResponsable     VARCHAR(50)  NULL,
  soporte             VARCHAR(150) NULL,
  acceso              VARCHAR(150) NULL,
  retencionArea       VARCHAR(20)  NULL,
  retencionAlmacen    VARCHAR(20)  NULL,
  observaciones       VARCHAR(255) NULL,
  PRIMARY KEY (registroRequeridoID, nroRevision),
  FOREIGN KEY (controlDocumentoID, nroRevisionCD) REFERENCES control_documento (controlDocumentoID, nroRevision),
  FOREIGN KEY (areaOrigenID) REFERENCES area (areaID)
);

CREATE TABLE usuario (
  usuario     VARCHAR(100) NOT NULL,
  clave       VARCHAR(200) NOT NULL,
  personaID   INT          NOT NULL,
  estado      INT          NOT NULL,
  PRIMARY KEY (usuario),
  FOREIGN KEY (personaID) REFERENCES persona (personaID)
);
CREATE TABLE forma_pago (
  formaPagoID  CHAR(3)     NOT NULL,
  formaPago    VARCHAR(50) NOT NULL,
  numeroCuotas INT         NOT NULL,
  estado       INT         NOT NULL,
  PRIMARY KEY (formaPagoID)
);
CREATE TABLE comprobante_pago (
  comprobanteID CHAR(2)      NOT NULL,
  descripcion   VARCHAR(300) NOT NULL,
  estado        INT          NOT NULL,
  compras       BOOLEAN      NOT NULL,
  ventas        BOOLEAN      NOT NULL,
  ingresos      BOOLEAN      NOT NULL,
  egresos       BOOLEAN      NOT NULL,
  honorarios    BOOLEAN      NOT NULL,
  diario        BOOLEAN      NOT NULL,
  PRIMARY KEY (comprobanteID)
);

CREATE TABLE modules (
  id int NOT NULL PRIMARY KEY,
  nombre VARCHAR(35) NOT NULL,
  folder VARCHAR(35) NOT NULL
);

CREATE TABLE items (
  id int AUTO_INCREMENT PRIMARY KEY,
  module_id int NOT NULL,
  nombre VARCHAR(55) NOT NULL,
  file VARCHAR(55) NOT NULL,
  FOREIGN KEY (module_id) REFERENCES modules(id)
);

CREATE TABLE permissions (
  username VARCHAR(100) NOT NULL,
  item_id int NOT NULL,
  FOREIGN KEY (username) REFERENCES usuario(usuario),
  FOREIGN KEY (item_id) REFERENCES items(id)
);


/*---------------- PIERI----------------------------*/

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

create table TIPO_PERCEPCION(
  tipoPercepcionID int not null,
  tipoPercepcion varchar(200) not null,
  porcentaje decimal(6,3) not null,
  estado char(01) not null,
  primary key(tipoPercepcionID)
);

create table ENTIDAD_FINANCIERA(
  entidadFinancieraID char(02) not null,
  entidadFinanciera varchar(150) not null,
  estado char(01) not null,
  primary key(entidadFinancieraID)
);

CREATE TABLE MEDIO_PAGO(
  medioPagoID CHAR(3)      NOT NULL,
  medioPago   VARCHAR(200) NOT NULL,
  estado      CHAR(01)          NOT NULL,
  PRIMARY KEY (medioPagoID)
);