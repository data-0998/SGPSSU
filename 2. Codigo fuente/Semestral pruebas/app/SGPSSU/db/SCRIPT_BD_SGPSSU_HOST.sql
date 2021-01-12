USE id15644510_sgpssu3;

CREATE TABLE IF NOT EXISTS participanteproyecto (
	CodParticipante INT NOT NULL AUTO_INCREMENT,
	NombreParticipante VARCHAR(25) NOT NULL,
	ApellidoParticipante VARCHAR(25) NOT NULL,
	Cedula VARCHAR(20) NOT NULL,
	TelMovilParticipante VARCHAR(8) NOT NULL,
	TelResidencialParticipante VARCHAR(7),
	PRIMARY KEY(CodParticipante),
	UNIQUE KEY (Cedula)
);

CREATE TABLE IF NOT EXISTS tipodeproyecto (
	CodTipoDeProyecto INT NOT NULL AUTO_INCREMENT,
	Descripcion VARCHAR(25) NOT NULL,
	PRIMARY KEY(CodTipoDeProyecto)
);

CREATE TABLE IF NOT EXISTS niveldeproyecto (
	CodNivelDeProyecto INT NOT NULL AUTO_INCREMENT,
	Descripcion VARCHAR(25) NOT NULL,
	PRIMARY KEY(CodNivelDeProyecto)

);

CREATE TABLE IF NOT EXISTS modalidad (
	CodModalidad INT NOT NULL AUTO_INCREMENT,
	Descripcion VARCHAR(25) NOT NULL,
	PRIMARY KEY (CodModalidad)
);

CREATE TABLE IF NOT EXISTS estado (
	CodEstado INT NOT NULL AUTO_INCREMENT,
	Descripcion VARCHAR(25) NOT NULL,
	PRIMARY KEY (CodEstado)
);

CREATE TABLE IF NOT EXISTS supervisordeproyecto (
	CodSupervisor INT NOT NULL AUTO_INCREMENT,
	TelMovilSupervisor VARCHAR(8) NOT NULL ,
	TelOficinaSupervisor VARCHAR(7) NOT NULL ,
	NombreSupervisor VARCHAR(25)NOT NULL ,
	ApellidoSupervisor VARCHAR(25) NOT NULL ,
	CedulaSupervisor VARCHAR(20) NOT NULL,
	CorreoSupervisor VARCHAR(50) NOT NULL ,
	PRIMARY KEY(CodSupervisor),
	UNIQUE KEY (CedulaSupervisor)
);

CREATE TABLE IF NOT EXISTS responsabledeproyecto (
	CodResponsable INT NOT NULL AUTO_INCREMENT,
	TelMovilResponsable VARCHAR(8) NOT NULL ,
	TelOficinaResponsable VARCHAR(7) NOT NULL ,
	NombreResponsable VARCHAR(25)NOT NULL ,
	ApellidoResponsable VARCHAR(25) NOT NULL ,
	CedulaResponsable VARCHAR(20) NOT NULL,
	CorreoResponsable VARCHAR(50) NOT NULL ,
	PRIMARY KEY(CodResponsable),
	UNIQUE KEY (CedulaResponsable)
);

CREATE TABLE IF NOT EXISTS facultad (
	CodFacultad INT NOT NULL AUTO_INCREMENT,
	NombreFacultad VARCHAR(5),
	PRIMARY KEY(CodFacultad)
);

CREATE TABLE IF NOT EXISTS propuestadeproyecto (
	CodProyecto INT NOT NULL AUTO_INCREMENT,
	CodSupervisor INT NOT NULL ,
	CodResponsable INT NOT NULL ,
	Fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	Proponente VARCHAR(25) NOT NULL ,
	CodTipoDeProyecto INT NOT NULL ,
	TituloProyecto VARCHAR(50) NOT NULL ,
	Objetivo VARCHAR(200) NOT NULL ,
	Descripcion VARCHAR(200) NOT NULL,
	CodNivelDeProyecto INT NOT NULL,
	CodModalidad INT NOT NULL,
	CantidadEstudiantesMax INT NOT NULL,
	CantidadEstudiantesActual INT NOT NULL,
	PerfilEstudiantes VARCHAR(200),
	CodEstado INT NOT NULL,
	Motivo VARCHAR(200),
	PRIMARY KEY(CodProyecto),
	FOREIGN KEY (CodSupervisor) REFERENCES supervisordeproyecto(CodSupervisor),
	FOREIGN KEY (CodTipoDeProyecto) REFERENCES tipodeproyecto(CodTipoDeProyecto),
	FOREIGN KEY (CodNivelDeProyecto) REFERENCES niveldeproyecto(CodNivelDeProyecto),
 	FOREIGN KEY (CodModalidad) REFERENCES modalidad(CodModalidad),
	FOREIGN KEY (CodEstado) REFERENCES estado(CodEstado) 
);

CREATE TABLE IF NOT EXISTS actividad (
	CodActividad INT NOT NULL AUTO_INCREMENT,
	CodProyecto INT NOT NULL,
	DescripcionLugar VARCHAR(200),
	Lugar VARCHAR(20) NOT NULL,
	PRIMARY KEY(CodActividad,CodProyecto),
	FOREIGN KEY (CodProyecto) REFERENCES propuestadeproyecto(CodProyecto)
);


CREATE TABLE IF NOT EXISTS descripcionactividad (
	CodDescripcion INT NOT NULL AUTO_INCREMENT,
	CodActividad INT NOT NULL,
	DescripcionActividad VARCHAR(200) NOT NULL,
	Tiempo INT NOT NULL,
	PRIMARY KEY(CodDescripcion),
	FOREIGN KEY (CodActividad) REFERENCES actividad(CodActividad)
);

CREATE TABLE IF NOT EXISTS producto (
	CodProducto INT NOT NULL AUTO_INCREMENT,
	CodProyecto INT NOT NULL,
	DocenteAsesor VARCHAR(2) NOT NULL,
	TiempoElaboracionProducto INT NOT NULL,
	Materiales VARCHAR(200),
	Facilidades VARCHAR(200),
	DescripcionProducto VARCHAR(200),
	PRIMARY KEY(CodProducto,CodProyecto),
	FOREIGN KEY (CodProyecto) REFERENCES propuestadeproyecto(CodProyecto)
);

CREATE TABLE IF NOT EXISTS propuestafacultad (
	CodProyecto INT NOT NULL AUTO_INCREMENT,
	CodFacultad INT NOT NULL,
	PRIMARY KEY(CodProyecto,CodFacultad),
	FOREIGN KEY (CodFacultad) REFERENCES facultad(CodFacultad),
	FOREIGN KEY (CodProyecto) REFERENCES propuestadeproyecto(CodProyecto)
);

CREATE TABLE IF NOT EXISTS participantepropuesta (
	CodProyecto INT NOT NULL AUTO_INCREMENT,
	CodParticipante INT NOT NULL,
	PRIMARY KEY(CodProyecto,CodParticipante),
	FOREIGN KEY(CodProyecto) REFERENCES propuestadeproyecto(CodProyecto),
	FOREIGN KEY(CodParticipante) REFERENCES participanteproyecto(CodParticipante)
);






INSERT INTO tipodeproyecto (Descripcion) VALUES ('Producto');
INSERT INTO tipodeproyecto (Descripcion) VALUES ('Actividad');

INSERT INTO niveldeproyecto (Descripcion) VALUES ('Voluntariado');
INSERT INTO niveldeproyecto (Descripcion) VALUES ('Servicio Social');

INSERT INTO modalidad (Descripcion) VALUES ('Individual');
INSERT INTO modalidad (Descripcion) VALUES ('Grupal');

INSERT INTO estado (Descripcion) VALUES ('Aprobado');
INSERT INTO estado (Descripcion) VALUES ('Rechazado');
INSERT INTO estado (Descripcion) VALUES ('Pendiente de Aprobación');
INSERT INTO estado (Descripcion) VALUES ('Envíado a la Comisión');

INSERT INTO facultad (NombreFacultad) VALUES ('FCyT');
INSERT INTO facultad (NombreFacultad) VALUES ('FIC');
INSERT INTO facultad (NombreFacultad) VALUES ('FIE');
INSERT INTO facultad (NombreFacultad) VALUES ('FII');
INSERT INTO facultad (NombreFacultad) VALUES ('FIM');
INSERT INTO facultad (NombreFacultad) VALUES ('FISC');

