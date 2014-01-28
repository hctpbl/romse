SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `PGPI_grupo01` DEFAULT CHARACTER SET utf8 ;
USE `PGPI_grupo01` ;

-- -----------------------------------------------------
-- Table `PGPI_grupo01`.`proyecto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PGPI_grupo01`.`proyecto` ;

CREATE TABLE IF NOT EXISTS `PGPI_grupo01`.`proyecto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_fin` DATE NULL,
  `costes` DECIMAL(10,2) NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PGPI_grupo01`.`artefacto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PGPI_grupo01`.`artefacto` ;

CREATE TABLE IF NOT EXISTS `PGPI_grupo01`.`artefacto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `uri` VARCHAR(30) NOT NULL,
  `rol` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(200) NOT NULL,
  `version` VARCHAR(10) NOT NULL,
  `proyecto_id` INT NOT NULL,
  `depende_de` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_artefacto_proyecto_idx` (`proyecto_id` ASC),
  INDEX `fk_artefacto_artefacto1_idx` (`depende_de` ASC),
  CONSTRAINT `fk_artefacto_proyecto`
    FOREIGN KEY (`proyecto_id`)
    REFERENCES `PGPI_grupo01`.`proyecto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_artefacto_artefacto`
    FOREIGN KEY (`depende_de`)
    REFERENCES `PGPI_grupo01`.`artefacto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PGPI_grupo01`.`rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PGPI_grupo01`.`rol` ;

CREATE TABLE IF NOT EXISTS `PGPI_grupo01`.`rol` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO `rol` (`id`, `nombre`) VALUES(1, 'Administrador');
INSERT INTO `rol` (`id`, `nombre`) VALUES(2, 'CCC');
INSERT INTO `rol` (`id`, `nombre`) VALUES(3, 'Desarrollador');
INSERT INTO `rol` (`id`, `nombre`) VALUES(4, 'Usuario final');

-- -----------------------------------------------------
-- Table `PGPI_grupo01`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PGPI_grupo01`.`usuario` ;

CREATE TABLE IF NOT EXISTS `PGPI_grupo01`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nss` CHAR(10) NOT NULL,
  `dni` VARCHAR(9) NOT NULL,
  `nombre` VARCHAR(30) NOT NULL,
  `apellidos` VARCHAR(60) NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `numero_telefono` VARCHAR(13) NOT NULL,
  `salario` DECIMAL(8,2) NOT NULL,
  `fecha_incorporacion` DATE NOT NULL,
  `fecha_baja` DATE NULL,
  `username` VARCHAR(15) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `rol_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_solicitante_roles1_idx` (`rol_id` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  CONSTRAINT `fk_usuario_rol`
    FOREIGN KEY (`rol_id`)
    REFERENCES `PGPI_grupo01`.`rol` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


INSERT INTO `usuario` (`id`, `nss`, `dni`, `nombre`, `apellidos`, `fecha_nacimiento`, `email`, `numero_telefono`, `salario`, `fecha_incorporacion`, `fecha_baja`, `username`, `password`, `rol_id`) VALUES(1, '9874359172', '50381857K', 'CCC', 'ccc', '2010-02-10', '654377493', 'ccc@romse.com', '2500.00', '2010-02-10', NULL, 'ccc', '$2a$13$Eot4kioFeG9Il5PcDEPA/eedPSmdKtQf1lwaO8SgfAMifay9UO74y', 2);
INSERT INTO `usuario` (`id`, `nss`, `dni`, `nombre`, `apellidos`, `fecha_nacimiento`, `email`, `numero_telefono`, `salario`, `fecha_incorporacion`, `fecha_baja`, `username`, `password`, `rol_id`) VALUES(2, '0000000000', '00000000K', 'Administrador', 'Administrador', '1900-01-01', 'admin@romse.com', '000000000', '0.00', '1900-01-01', NULL, 'admin', '$2a$13$Eot4kioFeG9Il5PcDEPA/eedPSmdKtQf1lwaO8SgfAMifay9UO74y', 1);

-- -----------------------------------------------------
-- Table `PGPI_grupo01`.`solicitud_de_cambio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PGPI_grupo01`.`solicitud_de_cambio` ;

CREATE TABLE IF NOT EXISTS `PGPI_grupo01`.`solicitud_de_cambio` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descripcion_breve` VARCHAR(100) NOT NULL,
  `descripcion_detallada` VARCHAR(1000) NOT NULL,
  `impacto` VARCHAR(10) NULL,
  `prioridad` VARCHAR(10) NULL,
  `temporizacion` VARCHAR(10) NULL,
  `riesgos` VARCHAR(50) NULL,
  `artefacto_id` INT NULL,
  `creador` INT NOT NULL,
  `probador` INT NULL,
  `desarrollador` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_solicituddecambio_artefacto1_idx` (`artefacto_id` ASC),
  INDEX `fk_solicituddecambio_solicitante1_idx` (`creador` ASC),
  INDEX `fk_solicituddecambio_solicitante2_idx` (`probador` ASC),
  INDEX `fk_solicituddecambio_solicitante3_idx` (`desarrollador` ASC),
  CONSTRAINT `fk_solicituddecambio_artefacto`
    FOREIGN KEY (`artefacto_id`)
    REFERENCES `PGPI_grupo01`.`artefacto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicituddecambio_creador`
    FOREIGN KEY (`creador`)
    REFERENCES `PGPI_grupo01`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicituddecambio_probador`
    FOREIGN KEY (`probador`)
    REFERENCES `PGPI_grupo01`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicituddecambio_desarrollador`
    FOREIGN KEY (`desarrollador`)
    REFERENCES `PGPI_grupo01`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PGPI_grupo01`.`estado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PGPI_grupo01`.`estado` ;

CREATE TABLE IF NOT EXISTS `PGPI_grupo01`.`estado` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO `estado` (`id`, `nombre`) VALUES(0, 'Creado');
INSERT INTO `estado` (`id`, `nombre`) VALUES(1, 'Enviado');
INSERT INTO `estado` (`id`, `nombre`) VALUES(2, 'Abierto');
INSERT INTO `estado` (`id`, `nombre`) VALUES(3, 'Asignado');
INSERT INTO `estado` (`id`, `nombre`) VALUES(4, 'Resuelto');
INSERT INTO `estado` (`id`, `nombre`) VALUES(5, 'Verificado');
INSERT INTO `estado` (`id`, `nombre`) VALUES(6, 'Pruebas falladas');
INSERT INTO `estado` (`id`, `nombre`) VALUES(7, 'Duplicado/Rechazado');
INSERT INTO `estado` (`id`, `nombre`) VALUES(8, 'Más información');
INSERT INTO `estado` (`id`, `nombre`) VALUES(9, 'Envío actualizado');
INSERT INTO `estado` (`id`, `nombre`) VALUES(10, 'Cerrado');


-- -----------------------------------------------------
-- Table `PGPI_grupo01`.`precede`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PGPI_grupo01`.`precede` ;

CREATE TABLE IF NOT EXISTS `PGPI_grupo01`.`precede` (
  `estado_padre_id` INT NOT NULL,
  `estado_hijo_id` INT NOT NULL,
  PRIMARY KEY (`estado_padre_id`, `estado_hijo_id`),
  INDEX `fk_precede_estado1_idx` (`estado_hijo_id` ASC),
  CONSTRAINT `fk_estado_precede_a`
    FOREIGN KEY (`estado_padre_id`)
    REFERENCES `PGPI_grupo01`.`estado` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_precede_estado1`
    FOREIGN KEY (`estado_hijo_id`)
    REFERENCES `PGPI_grupo01`.`estado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `precede` (`estado_padre_id`, `estado_hijo_id`) VALUES(0, 1);
INSERT INTO `precede` (`estado_padre_id`, `estado_hijo_id`) VALUES(1, 2);
INSERT INTO `precede` (`estado_padre_id`, `estado_hijo_id`) VALUES(9, 2);
INSERT INTO `precede` (`estado_padre_id`, `estado_hijo_id`) VALUES(2, 3);
INSERT INTO `precede` (`estado_padre_id`, `estado_hijo_id`) VALUES(3, 4);
INSERT INTO `precede` (`estado_padre_id`, `estado_hijo_id`) VALUES(6, 4);
INSERT INTO `precede` (`estado_padre_id`, `estado_hijo_id`) VALUES(4, 5);
INSERT INTO `precede` (`estado_padre_id`, `estado_hijo_id`) VALUES(4, 6);
INSERT INTO `precede` (`estado_padre_id`, `estado_hijo_id`) VALUES(5, 6);
INSERT INTO `precede` (`estado_padre_id`, `estado_hijo_id`) VALUES(1, 7);
INSERT INTO `precede` (`estado_padre_id`, `estado_hijo_id`) VALUES(9, 7);
INSERT INTO `precede` (`estado_padre_id`, `estado_hijo_id`) VALUES(7, 8);
INSERT INTO `precede` (`estado_padre_id`, `estado_hijo_id`) VALUES(8, 9);
INSERT INTO `precede` (`estado_padre_id`, `estado_hijo_id`) VALUES(5, 10);
INSERT INTO `precede` (`estado_padre_id`, `estado_hijo_id`) VALUES(7, 10);

-- -----------------------------------------------------
-- Table `PGPI_grupo01`.`cambio_de_estado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PGPI_grupo01`.`cambio_de_estado` ;

CREATE TABLE IF NOT EXISTS `PGPI_grupo01`.`cambio_de_estado` (
  `solicitud_de_cambio_id` INT NOT NULL,
  `usuario_id` INT NOT NULL,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado_id` INT NOT NULL,
  PRIMARY KEY (`solicitud_de_cambio_id`, `usuario_id`, `fecha`, `estado_id`),
  INDEX `fk_solicitud_de_cambio_has_usuario_usuario1_idx` (`usuario_id` ASC),
  INDEX `fk_solicitud_de_cambio_has_usuario_solicitud_de_cambio1_idx` (`solicitud_de_cambio_id` ASC),
  INDEX `fk_solicitud_de_cambio_has_usuario_estado1_idx` (`estado_id` ASC),
  CONSTRAINT `fk_solicitud_de_cambio_has_usuario_solicitud_de_cambio1`
    FOREIGN KEY (`solicitud_de_cambio_id`)
    REFERENCES `PGPI_grupo01`.`solicitud_de_cambio` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_solicitud_de_cambio_has_usuario_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `PGPI_grupo01`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicitud_de_cambio_has_usuario_estado1`
    FOREIGN KEY (`estado_id`)
    REFERENCES `PGPI_grupo01`.`estado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- View `PGPI_grupo01`.`solicitud_estado`
-- -----------------------------------------------------

create or replace view solicitud_estado as
    select 
        sc.id,
        sc.descripcion_breve,
        sc.descripcion_detallada,
        sc.impacto,
        sc.prioridad,
        sc.temporizacion,
        sc.riesgos,
        artefacto.nombre as artefacto,
        artefacto.id as id_artefacto,
        creador.username as creador,
        creador.id as id_creador,
        probador.username as probador,
        probador.id as id_probador,
        desarrollador.username as desarrollador,
        desarrollador.id as id_desarrollador,
        e.nombre as nombre_estado,
        e.id as id_estado,
        ce.fecha as fecha_estado,
        ceusr.username as usuario_estado,
        ceusr.id as id_usuario_estado
    from
        solicitud_de_cambio as sc
            left join
        usuario as desarrollador ON desarrollador.id = desarrollador
            left join
        usuario as probador ON probador.id = probador
            left join
        artefacto ON artefacto.id = artefacto_id,
        usuario as creador,
        cambio_de_estado ce,
        estado e,
        usuario as ceusr
    where
        creador.id = creador
            and ce.solicitud_de_cambio_id = sc.id
            and ce.estado_id = e.id
            and ce.usuario_id = ceusr.id
            and ce.fecha = (select 
					max(fecha)
				from
					cambio_de_estado ce2
				where
					ce.solicitud_de_cambio_id = ce2.solicitud_de_cambio_id
				group by solicitud_de_cambio_id)

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
