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
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


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
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_precede_estado1`
    FOREIGN KEY (`estado_hijo_id`)
    REFERENCES `PGPI_grupo01`.`estado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


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
    ON UPDATE NO ACTION,
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

USE `PGPI_grupo01` ;

-- -----------------------------------------------------
-- Placeholder table for view `PGPI_grupo01`.`solicitud_estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PGPI_grupo01`.`solicitud_estado` (`id` INT, `descripcion_breve` INT, `descripcion_detallada` INT, `impacto` INT, `prioridad` INT, `temporizacion` INT, `riesgos` INT, `artefacto` INT, `id_artefacto` INT, `creador` INT, `id_creador` INT, `probador` INT, `id_probador` INT, `desarrollador` INT, `id_desarrollador` INT, `nombre_estado` INT, `id_estado` INT, `fecha_estado` INT, `usuario_estado` INT, `id_usuario_estado` INT);

-- -----------------------------------------------------
-- View `PGPI_grupo01`.`solicitud_estado`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `PGPI_grupo01`.`solicitud_estado` ;
DROP TABLE IF EXISTS `PGPI_grupo01`.`solicitud_estado`;
USE `PGPI_grupo01`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`PGPI_grupo01`@`localhost` SQL SECURITY DEFINER VIEW `PGPI_grupo01`.`solicitud_estado` AS select `sc`.`id` AS `id`,`sc`.`descripcion_breve` AS `descripcion_breve`,`sc`.`descripcion_detallada` AS `descripcion_detallada`,`sc`.`impacto` AS `impacto`,`sc`.`prioridad` AS `prioridad`,`sc`.`temporizacion` AS `temporizacion`,`sc`.`riesgos` AS `riesgos`,`PGPI_grupo01`.`artefacto`.`nombre` AS `artefacto`,`PGPI_grupo01`.`artefacto`.`id` AS `id_artefacto`,`creador`.`username` AS `creador`,`creador`.`id` AS `id_creador`,`probador`.`username` AS `probador`,`probador`.`id` AS `id_probador`,`desarrollador`.`username` AS `desarrollador`,`desarrollador`.`id` AS `id_desarrollador`,`e`.`nombre` AS `nombre_estado`,`e`.`id` AS `id_estado`,`ce`.`fecha` AS `fecha_estado`,`ceusr`.`username` AS `usuario_estado`,`ceusr`.`id` AS `id_usuario_estado` from (((((((`PGPI_grupo01`.`solicitud_de_cambio` `sc` left join `PGPI_grupo01`.`usuario` `desarrollador` on((`desarrollador`.`id` = `sc`.`desarrollador`))) left join `PGPI_grupo01`.`usuario` `probador` on((`probador`.`id` = `sc`.`probador`))) left join `PGPI_grupo01`.`artefacto` on((`PGPI_grupo01`.`artefacto`.`id` = `sc`.`artefacto_id`))) join `PGPI_grupo01`.`usuario` `creador`) join `PGPI_grupo01`.`cambio_de_estado` `ce`) join `PGPI_grupo01`.`estado` `e`) join `PGPI_grupo01`.`usuario` `ceusr`) where ((`creador`.`id` = `sc`.`creador`) and (`ce`.`solicitud_de_cambio_id` = `sc`.`id`) and (`ce`.`estado_id` = `e`.`id`) and (`ce`.`usuario_id` = `ceusr`.`id`) and (`ce`.`fecha` = (select max(`ce2`.`fecha`) from `PGPI_grupo01`.`cambio_de_estado` `ce2` where (`ce`.`solicitud_de_cambio_id` = `ce2`.`solicitud_de_cambio_id`) group by `ce2`.`solicitud_de_cambio_id`)));

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
