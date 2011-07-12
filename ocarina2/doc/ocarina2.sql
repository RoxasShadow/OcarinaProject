-- phpMyAdmin SQL Dump
-- version 3.3.7deb5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: 12 lug, 2011 at 12:39 AM
-- Versione MySQL: 5.1.49
-- Versione PHP: 5.3.3-7+squeeze3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ocarina2`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `annunci`
--

CREATE TABLE IF NOT EXISTS `annunci` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `autore` varchar(100) NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `contenuto` text NOT NULL,
  `data` varchar(10) NOT NULL,
  `ora` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `commenti`
--

CREATE TABLE IF NOT EXISTS `commenti` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `autore` varchar(100) NOT NULL,
  `contenuto` text NOT NULL,
  `news` varchar(100) NOT NULL,
  `data` varchar(10) NOT NULL,
  `ora` varchar(10) NOT NULL,
  `approvato` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `configurazione`
--

CREATE TABLE IF NOT EXISTS `configurazione` (
  `nomesito` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `bbcode` tinyint(1) NOT NULL,
  `registrazioni` tinyint(1) NOT NULL,
  `validazioneaccount` tinyint(1) NOT NULL,
  `commenti` tinyint(1) NOT NULL,
  `approvacommenti` tinyint(1) NOT NULL,
  `log` tinyint(1) NOT NULL,
  `cookie` varchar(20) NOT NULL,
  `skin` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `limitenews` int(10) NOT NULL,
  `impaginazionenews` int(10) NOT NULL,
  `limiteonline` int(10) NOT NULL,
  `url` varchar(100) NOT NULL,
  `url_index` varchar(100) NOT NULL,
  `url_admin` varchar(100) NOT NULL,
  `url_rendering` varchar(100) NOT NULL,
  `url_immagini` varchar(100) NOT NULL,
  `root` varchar(100) NOT NULL,
  `root_index` varchar(100) NOT NULL,
  `root_admin` varchar(100) NOT NULL,
  `root_rendering` varchar(100) NOT NULL,
  `root_immagini` varchar(100) NOT NULL,
  `versione` varchar(5) NOT NULL,
  `totalevisitatori` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(100) NOT NULL,
  `azione` varchar(100) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `data` varchar(10) NOT NULL,
  `ora` varchar(10) NOT NULL,
  `useragent` varchar(100) NOT NULL,
  `referer` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `autore` varchar(100) NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `minititolo` varchar(100) NOT NULL,
  `contenuto` text NOT NULL,
  `categoria` enum('Senza categoria') DEFAULT 'Senza categoria',
  `data` varchar(10) NOT NULL,
  `ora` varchar(10) NOT NULL,
  `dataultimamodifica` varchar(10) NOT NULL,
  `oraultimamodifica` varchar(10) NOT NULL,
  `autoreultimamodifica` varchar(100) NOT NULL,
  `approvato` tinyint(1) NOT NULL,
  `visite` int(10) NOT NULL,
  `visitatori` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `pagine`
--

CREATE TABLE IF NOT EXISTS `pagine` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `autore` varchar(100) NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `minititolo` varchar(100) NOT NULL,
  `contenuto` text NOT NULL,
  `categoria` enum('Senza categoria') DEFAULT 'Senza categoria',
  `data` varchar(10) NOT NULL,
  `ora` varchar(10) NOT NULL,
  `dataultimamodifica` varchar(10) NOT NULL,
  `oraultimamodifica` varchar(10) NOT NULL,
  `autoreultimamodifica` varchar(100) NOT NULL,
  `approvato` tinyint(1) NOT NULL,
  `visite` int(10) NOT NULL,
  `visitatori` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE IF NOT EXISTS `utenti` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `secret` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `grado` tinyint(1) NOT NULL,
  `data` varchar(10) NOT NULL,
  `ora` varchar(10) NOT NULL,
  `lastlogout` varchar(10) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `codiceregistrazione` varchar(40) NOT NULL,
  `codicerecupero` varchar(40) NOT NULL,
  `skin` varchar(100) NOT NULL DEFAULT 'default',
  `bio` text NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `browsername` varchar(100) NOT NULL,
  `browserversion` varchar(100) NOT NULL,
  `platform` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `visitatori`
--

CREATE TABLE IF NOT EXISTS `visitatori` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) NOT NULL,
  `lastaction` varchar(15) NOT NULL,
  `giorno` varchar(10) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
