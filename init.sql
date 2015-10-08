# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.28)
# Database: immobiliare
# Generation Time: 2015-10-08 06:17:55 +0000
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table annunci
# ------------------------------------------------------------
CREATE TABLE `annunci` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rif` varchar(11) DEFAULT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `comune` text,
  `cap` varchar(5) DEFAULT NULL,
  `indirizzo` varchar(255) DEFAULT '0',
  `contratto` varchar(255) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `tipologia` varchar(255) DEFAULT '0',
  `descrizione` text,
  `prezzo` int(11) DEFAULT NULL,
  `spesecondominialianno` int(11) DEFAULT NULL,
  `spesecondominialimese` int(11) DEFAULT NULL,
  `trattativariservata` int(11) DEFAULT NULL,
  `riscaldamento` varchar(255) DEFAULT NULL,
  `giardinoprivato` varchar(255) DEFAULT NULL,
  `giardinocondominiale` varchar(255) DEFAULT NULL,
  `numerobagni` int(11) DEFAULT NULL,
  `annocostruzione` int(11) DEFAULT NULL,
  `condizioni` varchar(255) DEFAULT NULL,
  `garage` varchar(255) DEFAULT NULL,
  `piano` varchar(255) DEFAULT NULL,
  `classe_energetica` varchar(10) DEFAULT NULL,
  `ipe` varchar(10) DEFAULT NULL,
  `latitudine` varchar(255) DEFAULT NULL,
  `longitudine` varchar(255) DEFAULT NULL,
  `scroll` varchar(255) DEFAULT NULL,
  `inevidenza` varchar(255) DEFAULT NULL,
  `notepubbliche` varchar(255) DEFAULT NULL,
  `immagini` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_rif` (`rif`),
  KEY `index_rif` (`rif`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;