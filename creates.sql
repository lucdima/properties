CREATE  TABLE IF NOT EXISTS `centras3_hm`.`propiedades` (
  `idpropiedad` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(256) NOT NULL,
  `descripcion` VARCHAR(1014) NULL,
  `moneda` VARCHAR(3) NOT NULL,
  `precio` INT NULL,
  `superficie` INT NULL,
  `estado` VARCHAR(30) NULL,
  `visibilidad` VARCHAR(30) NOT NULL,
  `operacion` VARCHAR(30) NOT NULL,
  `mapa` VARCHAR(256) NULL,
  `fechaalta` DATETIME NOT NULL,
  PRIMARY KEY (`idpropiedad`))
  ENGINE = MyISAM
  AUTO_INCREMENT=1
  DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `centras3_hm`.`detalles` (
	`iddetalle` INT NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(256) NOT NULL,
	PRIMARY KEY (`iddetalle`))
	ENGINE = MyISAM
    AUTO_INCREMENT=1
    DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `centras3_hm`.`propxdetalles` (
	`idpd` INT NOT NULL AUTO_INCREMENT,
    `idpropiedad` INT NOT NULL,
    `iddetalle` INT NOT NULL,
    `valor` VARCHAR(256) NULL,
    PRIMARY KEY (`idpd`))
	ENGINE = MyISAM
    AUTO_INCREMENT=1
    DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `centras3_hm`.`fotos` (
	`idfoto` INT NOT NULL AUTO_INCREMENT,
	`descripcion` VARCHAR(256) NULL,
	`idpropiedad` INT NOT NULL,
	PRIMARY KEY (`idfoto`))
	ENGINE = MyISAM
    AUTO_INCREMENT=1
    DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `centras3_hm`.`videos` (
	`idvideo` INT NOT NULL AUTO_INCREMENT,
	`descripcion` VARCHAR(256) NULL,
	`url` VARCHAR(256) NULL,
	`idpropiedad` INT NOT NULL,
	PRIMARY KEY (`idvideo`))
	ENGINE = MyISAM
    AUTO_INCREMENT=1
    DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `centras3_hm`.`estados` (
	`idestado` INT NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(64) NOT NULL,
	`idpropiedad` INT NOT NULL,
	PRIMARY KEY (`idestado`))
	ENGINE = MyISAM
    AUTO_INCREMENT=1
    DEFAULT CHARSET=latin1;
    
CREATE TABLE IF NOT EXISTS `centras3_hm`.`monedas` (
	`idmoneda` INT NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(3) NOT NULL,
	`idpropiedad` INT NOT NULL,
	PRIMARY KEY (`idmoneda`))
	ENGINE = MyISAM
    AUTO_INCREMENT=1
    DEFAULT CHARSET=latin1;
    
