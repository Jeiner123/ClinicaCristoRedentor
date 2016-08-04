USE clinica;
insert into especialidad(especialidad,estado) values
	('NINGUNO',1),
	('PEDIATRIA',1),
	('TRAUMATOLOGIA',1),
	('GASTROENTEROLOGIA',1),
	('MEDICINA GENERAL',1),
	('DERMATOLOGIA',1),
	('MEDICINA INTERNA',1),
	('GINECOLOGIA',1),
	('NEUROLOGIA',1),
	('NEUMOLOGIA',1),
	('UROLOGIA',1),
	('REUMATOLOGIA',1),
	('TRAUMATOLOGIA',1),
	('PSICOLOGIA',1),
	('ECOGRAFIA GINECOLOGICA',1),
	('ECOGRAFIA ABDOMINAL',1),
	('ECOGRAFIAs VIAS URINARIAS',1),
	('CIRUGIA',1),
	('TOPICO',1),
	('ALERGOLOGO',1),
	('GASTROENTEROLOGIA',1),
	('ECOGRAFIA DOPLLER',1),
	('ECOGRAFIA PELVICA',1),
	('FISIOTERAPIA Y REHABILITACION',1),
	('LABORATORIO',1),
	('RADIOLOGIA',1),
	('PATOLOGIA',1),
	('OTORRINOLARINGOLOGIA',1),
	('ENDOCRINOLOGIA',1);
insert into tipo_servicio(tipoServicio,estado) values
	('OTROS',1),
	('LABORATORIO',1),
	('TOPICO',1),
	('CONSULTA EXTERNA',1),
	('CIRUGIA',1),
	('ECOGRAFIA',1);
insert into servicio(servicio,precioUnitario,tipoServicioID,especialidadID,estado) values
	('CONSULTA MEDICA INTERNA',40.00,1,1,1),
	('DROGAS PANEL (ORINA)',180.00,1,1,1),	
	('RX DE MANOS COMPARATIVAS',120.00,1,1,1),
	('BIOPSIA 80',80.00,1,1,1),
	('DUPLICADO DE ANALISIS DE LABORATORIO',10.00,1,1,1),
	('CONSULTA ALERGOLOGO USO CONSULTORIO',20.00,1,1,1),
	('CRIOTERAPIA S/.120',120.00,1,1,1),
	('OBSERVACION POR MEDIO DIA ESPECIAL',40.00,1,1,1),
	('RX LUMBAR AP-LAT',100.00,1,1,1),
	('CONSULTA ALERLOLOGIA',50.00,1,1,1),
	('RIESGO QUIRURGICO',100.00,1,1,1),
	('ALOPECIA',100.00,1,1,1),
	('RX COLUMNA DORSAL AP LAT',100.00,1,1,1),
	('CONSULTA ENDOCRINOLOGIA',70.00,1,1,1),
	('INDICE RETICULOSITARIO',40.00,1,1,1),
	('RX DE PELVIS AP',90.00,1,1,1),
	('RX DE RODILLA AP-L',80.00,1,1,1),
	('RX DE CODO AP-L',80.00,1,1,1),
	('SUTURA MEDIANA',50.00,1,1,1),
	('2 MUESTRAS DE PARCHE',12.00,1,1,1),
	('INTERCONSULTA',80.00,1,1,1),
	('RX DE CADERAS COMPARATIVAS',120.00,1,1,1),
	('CONSULTA + ECOGRAFIA OBST.',83.00,1,1,1),
	('ECOGRAFIA DE TIROIDES',80.00,1,1,1),
	('RX DE PIES COMPARATIVOS',120.00,1,1,1),
	('CONSULTA 20.00',20.00,1,1,1),
	('ECOGRAFIA GENETICA',80.00,1,1,1),
	('PERFILR REUMATICO',270.00,1,1,1),
	('ECOGRAFIA DOOPLER MIENBROS INFERIORES DSCTO',280.00,1,1,1),
	('PEDIATRIA',40.00,1,1,1),
	('PROCEDIMIENTO NEUMOLOGIA',180.00,1,1,1),
	('RX DE TRANSITO INTESTINAL',280.00,1,1,1),
	('CAUTERIZACION + CRIOTERAPIA',200.00,1,1,1),
	('1 MUESTRA DE HECES',6.00,1,1,1),
	('PROCEDIMIENTO CIRUGIA 300',300.00,1,1,1),
	('EXTRACCION DE PUNTOS DSCTO',30.00,1,1,1),
	('1 NEBULIZACION',10.00,1,1,1),
	('ANTICARDIOLIPINAS IGG',70.00,1,1,1),
	('DESHIDROGENASA LACTICA EN LIQ. PERITONEAL',50.00,1,1,1),
	('DESHIDROGENASA LACTICA LIQUIDO SINOVIAL',50.00,1,1,1),
	('FACTOR VIII-COAGULACION',130.00,1,1,1),
	('MICROALBUMINURIA EN ORINA DE 12 HORAS',55.00,1,1,1),
	('MICROALBUMINURIA EN ORINA OCASIONAL',55.00,1,1,1),
	('T3 UPTAKE',60.00,1,1,1),
	('TROPONINA I (CUANTITATIVO)',70.00,1,1,1),
	('TSH ULTRASENSIBLE',48.00,1,1,1),
	('ECOGRAFIA OBSTETRICA CONTROL',0.00,1,1,1),
	('ITEMS BLANCO.',0.00,1,1,1),
	('RX NARIZ',100.00,1,1,1),
	('ECOGRAFIA DOOPLER GESTANTE',60.00,1,1,1),
	('RX PIE LAT COMPARATIVO',120.00,1,1,1),
	('HDL Y LDL',18.00,1,1,1),
	('PUNZION LUMBAR',300.00,1,1,1),
	('RX CUELLO ',90.00,1,1,1),
	('colocacion de via',20.00,1,1,1),
	('EXTRACCION DE UÃ‘A - DERMATO',80.00,1,1,1),
	('ANTI TIRO PEROXIDASA',70.00,1,1,1),
	('LEVANTAMIENTO OBSERVACION MEDICINA',70.00,1,1,1),
	('INFILTRACION S/ 80.00',80.00,1,1,1),
	('RX HOMBRO ESPECIAL',50.00,1,1,1),
	('BIOPSIA 70.00',70.00,1,1,1),
	('3 BK EN ESPUTO',60.00,1,1,1),
	('OXIGENACION POR 1 HORA',30.00,1,1,1),
	('ECOGRAFIA 4D',160.00,1,1,1),
	('EXCERESIS DE GRANULOMA',300.00,1,1,1),
	('RX PIERNA COMPARATIVO',120.00,1,1,1),
	('EXAMEN TOXICOLOGICO PARTICULAR',60.00,1,1,1),
	('EXTRACCION LUNAR 150',150.00,1,1,1),
	('USO DE TOPICO - DR.DIAZ',50.00,1,1,1),
	('ALQUILER CONSULTORIO - DR.DIAZ',10.00,1,1,1),
	('PARRILLA COSTAL BILATERAL AP + OBLICUA DE AMBOS LADOS',120.00,1,1,1),
	('CONSULTA GINECOLOGIA',43.00,1,1,1),
	('CONSULTA CIRUGIA',40.00,1,1,1),
	('ALQUILER TOPICO',80.00,1,1,1),
	('ALQUILER TOPICO CIRUGIA MENOR',50.00,1,1,1),
	('CONSULTA DERMATOLOGIA',40.00,1,1,1),
	('EXAMEN TOXICOLOGICO PARA EMPRESA',20.00,1,1,1),
	('RX ABDOMEN DE PIE Y CUBITO',140.00,1,1,1),
	('ECOGRAFIA VIAS URINARIAS DR VERA 60',60.00,1,1,1),
	('RX PARRILLA COSTA BILATERAL AP',80.00,1,1,1),
	('PROCEDIMIENTO GINECOLOGIA AMEU 450',450.00,1,1,1),
	('INTERCONSULTA MEDICINA INTERNA',50.00,1,1,1),
	('BIOPSIA DERMATO 100.00',100.00,1,1,1),
	('RX BRAZO COMPARATIVO',120.00,1,1,1),
	('RX VAN ROSSEN',90.00,1,1,1),
	('TGP',15.00,1,1,1),
	('CONSULTA FISIOTERAPIA 15',15.00,1,1,1),
	('CONSULTA FISIOTERAPIA 20',20.00,1,1,1),
	('ECOGRAFIA VIAS URINARIAS DR VERA 70 ',70.00,1,1,1),
	('VACUNA HEXAVALENTE',200.00,1,1,1),
	('HIPERPLASIA SEBACEA 150.00',150.00,1,1,1),
	('GLUCOSA 3 MUESTRAS',27.00,1,1,1),
	('GLUCOSA 02 MUESTRAS',18.00,1,1,1),
	('LLENADO DE CERTIFICADO ESPECIALIDAD',50.00,1,1,1),
	('RX PARRILLA COSTAL BILATERAL AP ESPECIAL',60.00,1,1,1),
	('RX DE PELVIS ESPECIAL',60.00,1,1,1),
	('PROCEDIMIENTO OTORRINO',100.00,1,1,1),
	('CONSULTA PETROPERU',0.00,1,1,1),
	('RX DE HOMBROS COMPARATIVOS',120.00,1,1,1),
	('ECOGRAFIA ABDOMINAL ESPECIAL 60',60.00,1,1,1),
	('ECOGRAFIA PROTATICA ESPECIAL 50',50.00,1,1,1),
	('CONSULTA NEUROLOGIA DOCTOR ',100.00,1,1,1),
	('RX MANOS COMPARATIVAS ESPECIAL',100.00,1,1,1),
	('RX CADERA UN LADO',90.00,1,1,1),
	('CONSULTA NUTRICION',40.00,1,1,1),		
	('INFORME RIESGO QUIRURGICO 70',70.00,1,1,1),
	('EXTRACCION DE PUNTOS 20.00',20.00,1,1,1);


insert into forma_pago(formaPagoID,formaPago,numeroCuotas,estado) values
		("CON","CONTADO",1,1),
		("CRE","CREDITO",1,1);





