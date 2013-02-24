-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 24, 2013 at 08:12 PM
-- Server version: 5.5.29
-- PHP Version: 5.4.6-1ubuntu1.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `properties`
--

-- --------------------------------------------------------

--
-- Table structure for table `detalles`
--

CREATE TABLE IF NOT EXISTS `detalles` (
  `iddetalle` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  PRIMARY KEY (`iddetalle`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `detalles`
--

INSERT INTO `detalles` (`iddetalle`, `nombre`) VALUES
(1, 'Ambientes'),
(3, 'Cocheras'),
(4, 'Terraza'),
(5, 'Balcones'),
(6, 'Ventanas'),
(7, 'Pisos'),
(8, 'Pileta'),
(9, 'Parrilla'),
(10, 'Muebles'),
(11, 'Balcón');

-- --------------------------------------------------------

--
-- Table structure for table `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `idestado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL,
  `idpropiedad` int(11) NOT NULL,
  PRIMARY KEY (`idestado`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fotos`
--

CREATE TABLE IF NOT EXISTS `fotos` (
  `idfoto` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(256) DEFAULT NULL,
  `idpropiedad` int(11) NOT NULL,
  PRIMARY KEY (`idfoto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=139 ;

--
-- Dumping data for table `fotos`
--

INSERT INTO `fotos` (`idfoto`, `descripcion`, `idpropiedad`) VALUES
(96, '', 13),
(95, '', 13),
(97, '', 13),
(98, '', 13),
(99, '', 13),
(100, '', 13),
(101, '', 13),
(102, '', 14),
(103, '', 14),
(104, '', 14),
(105, '', 14),
(111, '', 15),
(107, '', 14),
(108, '', 14),
(109, '', 14),
(110, '', 14),
(112, '', 15),
(113, '', 15),
(114, '', 15),
(115, '', 15),
(116, '', 15),
(117, '', 16),
(118, '', 16),
(119, '', 16),
(120, '', 16),
(121, '', 17),
(122, '', 17),
(123, '', 17),
(124, '', 17),
(125, '', 17),
(126, '', 17),
(127, '', 17),
(128, '', 17),
(129, '', 17),
(130, '', 18),
(131, '', 18),
(132, '', 18),
(133, '', 18),
(134, '', 18),
(135, '', 18),
(136, '', 18),
(137, '', 18);

-- --------------------------------------------------------

--
-- Table structure for table `monedas`
--

CREATE TABLE IF NOT EXISTS `monedas` (
  `idmoneda` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(3) NOT NULL,
  `idpropiedad` int(11) NOT NULL,
  PRIMARY KEY (`idmoneda`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `propiedades`
--

CREATE TABLE IF NOT EXISTS `propiedades` (
  `idpropiedad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(1014) DEFAULT NULL,
  `moneda1` varchar(3) DEFAULT NULL,
  `moneda2` varchar(3) DEFAULT NULL,
  `precio1` int(11) DEFAULT NULL,
  `precio2` int(11) DEFAULT NULL,
  `superficie` int(11) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `operacion` int(11) DEFAULT NULL,
  `visibilidad` varchar(30) DEFAULT NULL,
  `mapa` varchar(1024) DEFAULT NULL,
  `fotop` int(11) DEFAULT NULL,
  `plano` int(11) DEFAULT NULL,
  `fechaalta` datetime NOT NULL,
  `fechamod` datetime NOT NULL,
  PRIMARY KEY (`idpropiedad`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `propiedades`
--

INSERT INTO `propiedades` (`idpropiedad`, `nombre`, `descripcion`, `moneda1`, `moneda2`, `precio1`, `precio2`, `superficie`, `estado`, `operacion`, `visibilidad`, `mapa`, `fotop`, `plano`, `fechaalta`, `fechamod`) VALUES
(13, 'Palo Alto, California USA', 'Espectacular casa sobre la montaña.', 'ars', 'usd', 0, 950000, 650, 'Disponible', 2, 'Visible', '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Palo+Alto,+California&amp;aq=&amp;sll=-34.966667,-54.95&amp;sspn=0.082576,0.154324&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=Palo+Alto,+Santa+Clara,+California&amp;t=h&amp;z=12&amp;ll=37.441883,-122.14302&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Palo+Alto,+California&amp;aq=&amp;sll=-34.966667,-54.95&amp;sspn=0.082576,0.154324&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=Palo+Alto,+Santa+Clara,+California&amp;t=h&amp;z=12&amp;ll=37.441883,-122.14302" style="color:#0000FF;text-align:left">View Larger Map</a></small>', 95, 101, '2012-01-22 16:36:57', '2013-02-21 12:25:52'),
(14, 'Santa Clara, CA', 'Casa ecológica de dos plantas en medio de la naturaleza\r\nMinimalista con ventanas al techo y pileta de 2x10. Amplia terraza, mucha luz natural.', 'usd', 'usd', 4500, 0, 240, 'Reservado', 1, 'Visible', '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Santa+Clara,+CA,+United+States&amp;aq=0&amp;oq=Santa+Clara&amp;sll=37.441883,-122.14302&amp;sspn=0.160009,0.308647&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=Santa+Clara,+California&amp;t=h&amp;z=13&amp;ll=37.354108,-121.955236&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Santa+Clara,+CA,+United+States&amp;aq=0&amp;oq=Santa+Clara&amp;sll=37.441883,-122.14302&amp;sspn=0.160009,0.308647&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=Santa+Clara,+California&amp;t=h&amp;z=13&amp;ll=37.354108,-121.955236" style="color:#0000FF;text-align:left">View Larger Map</a></small>', 102, 110, '2012-01-22 16:43:56', '2012-01-22 16:45:48'),
(15, 'Cuppertino, CA. Casa sobre la ladera', 'Bonita propiedad moderna típica de la costa oeste.', 'ars', 'usd', 0, 970000, 450, 'Vendido', 2, 'Visible', '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Cupertino,+CA,+United+States&amp;aq=0&amp;oq=Cupert&amp;sll=37.354108,-121.955236&amp;sspn=0.080098,0.154324&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=Cupertino,+Santa+Clara,+California&amp;ll=37.354057,-121.95528&amp;spn=0.080132,0.154324&amp;t=h&amp;z=13&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Cupertino,+CA,+United+States&amp;aq=0&amp;oq=Cupert&amp;sll=37.354108,-121.955236&amp;sspn=0.080098,0.154324&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=Cupertino,+Santa+Clara,+California&amp;ll=37.354057,-121.95528&amp;spn=0.080132,0.154324&amp;t=h&amp;z=13" style="color:#0000FF;text-align:left">View Larger Map</a></small>', 111, 116, '2012-01-22 16:47:03', '2012-01-22 16:48:01'),
(16, 'Pilar, Buenos Aires - Casa clásica de dos plantas', 'Moderna y clásica casa de dos plantas ubicada a 30 minutos de la capital\r\nMuy accesible y segura.', 'ars', 'usd', 5900, 0, 900, 'Disponible', 1, 'Visible', '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Los+Cardales,+Buenos+Aires,+Argentina&amp;aq=0&amp;oq=Los+Cardales,+&amp;sll=37.322939,-122.032185&amp;sspn=0.080132,0.154324&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=Los+Cardales,+Buenos+Aires+Province,+Argentina&amp;t=h&amp;z=14&amp;ll=-34.331355,-58.987677&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Los+Cardales,+Buenos+Aires,+Argentina&amp;aq=0&amp;oq=Los+Cardales,+&amp;sll=37.322939,-122.032185&amp;sspn=0.080132,0.154324&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=Los+Cardales,+Buenos+Aires+Province,+Argentina&amp;t=h&amp;z=14&amp;ll=-34.331355,-58.987677" style="color:#0000FF;text-align:left">View Larger Map</a></small>', 117, 120, '2012-01-22 16:50:56', '2012-01-22 23:51:09'),
(17, 'Laguna del sauce', 'Chalet pequeño con vista a la laguna\r\n5 años de antigüedad, ideal recién casados.', 'ars', 'eur', 0, 560000, 230, 'Disponible', 2, 'Visible', '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Miami+Beach,+FL,+United+States&amp;aq=1&amp;oq=miami&amp;sll=37.0625,-95.677068&amp;sspn=40.732051,79.013672&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=Miami+Beach,+Miami-Dade,+Florida&amp;t=h&amp;z=13&amp;ll=25.790654,-80.130046&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Miami+Beach,+FL,+United+States&amp;aq=1&amp;oq=miami&amp;sll=37.0625,-95.677068&amp;sspn=40.732051,79.013672&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=Miami+Beach,+Miami-Dade,+Florida&amp;t=h&amp;z=13&amp;ll=25.790654,-80.130046" style="color:#0000FF;text-align:left">View Larger Map</a></small>', 121, 129, '2012-01-22 23:21:11', '2012-01-22 23:50:32'),
(18, 'Viña del mar', 'Exquisita propiedad con pileta incorporada\r\nA estrenar', 'ars', 'usd', 4900, 0, 390, 'Disponible', 1, 'Visible', '<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Punta+del+Este,+Maldonado,+Uruguay&amp;aq=0&amp;oq=Punta+del+este,+uru&amp;sll=25.790654,-80.130046&amp;sspn=0.090728,0.154324&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=Punta+del+Este,+Maldonado,+Uruguay&amp;t=h&amp;z=13&amp;ll=-34.966667,-54.95&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Punta+del+Este,+Maldonado,+Uruguay&amp;aq=0&amp;oq=Punta+del+este,+uru&amp;sll=25.790654,-80.130046&amp;sspn=0.090728,0.154324&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=Punta+del+Este,+Maldonado,+Uruguay&amp;t=h&amp;z=13&amp;ll=-34.966667,-54.95" style="color:#0000FF;text-align:left">View Larger Map</a></small>', 130, 137, '2012-01-22 23:23:23', '2012-01-22 23:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `propxdetalles`
--

CREATE TABLE IF NOT EXISTS `propxdetalles` (
  `idpd` int(11) NOT NULL AUTO_INCREMENT,
  `idpropiedad` int(11) NOT NULL,
  `iddetalle` int(11) NOT NULL,
  `valor` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`idpd`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `propxdetalles`
--

INSERT INTO `propxdetalles` (`idpd`, `idpropiedad`, `iddetalle`, `valor`) VALUES
(45, 13, 6, 'del piso al techo'),
(44, 13, 3, '3'),
(43, 13, 1, '7'),
(46, 13, 7, 'de madera'),
(47, 13, 8, 'rectangular de 3x10'),
(48, 14, 1, '5'),
(49, 14, 3, '2'),
(50, 17, 1, '3'),
(51, 17, 3, '2'),
(52, 17, 7, 'de cemento'),
(53, 17, 10, 'Philip Stark'),
(54, 16, 3, '2 cubiertas, 1 descubierta'),
(55, 16, 1, '2'),
(56, 18, 4, 'muy amplia y luminosa'),
(57, 18, 1, '5'),
(58, 18, 3, '1'),
(59, 13, 11, 'amplio'),
(60, 13, 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `idvideo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(256) DEFAULT NULL,
  `url` varchar(256) DEFAULT NULL,
  `idpropiedad` int(11) NOT NULL,
  PRIMARY KEY (`idvideo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`idvideo`, `descripcion`, `url`, `idpropiedad`) VALUES
(32, '', 'http://www.youtube.com/watch?v=wrp_etbfDsU', 13),
(33, '', 'http://www.youtube.com/watch?v=jvsnaN_uPeY&feature=related', 14),
(34, '', 'http://www.youtube.com/watch?v=hZttFFkmr8M&feature=related', 15),
(35, '', 'http://www.youtube.com/watch?v=49yJ2rYpRZ4&feature=related', 16),
(36, '', 'http://www.youtube.com/watch?v=DnU8u6940E8&feature=related', 17),
(37, '', 'http://www.youtube.com/watch?v=10dzUG8GPWU&feature=related', 18);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
