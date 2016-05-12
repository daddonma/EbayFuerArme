-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Mai 2016 um 18:00
-- Server-Version: 5.6.26
-- PHP-Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `ebayfuerarme`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auktion`
--

CREATE TABLE IF NOT EXISTS `auktion` (
  `AuktionID` int(11) NOT NULL,
  `Produkt` int(11) DEFAULT NULL,
  `Höchstbietender` int(11) DEFAULT NULL,
  `aktuelles_gebot` double DEFAULT NULL,
  `Auktion_ende` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `auktion`
--

INSERT INTO `auktion` (`AuktionID`, `Produkt`, `Höchstbietender`, `aktuelles_gebot`, `Auktion_ende`) VALUES
(1, 1, NULL, 35, '2016-05-19'),
(2, 2, NULL, 7500, '2016-05-26'),
(3, 3, NULL, 1, '2016-05-13'),
(4, 4, NULL, 1, '2016-05-11');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorie`
--

CREATE TABLE IF NOT EXISTS `kategorie` (
  `KID` int(11) NOT NULL,
  `Bezeichnung` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `kategorie`
--

INSERT INTO `kategorie` (`KID`, `Bezeichnung`) VALUES
(1, 'Technik'),
(2, 'Textilien'),
(3, 'Literatur'),
(4, 'Automobilien'),
(5, 'Erotik'),
(6, 'Videospiele'),
(7, 'Hardware'),
(8, 'Kunst'),
(9, 'Sport'),
(10, 'Haus und Garten');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produkte`
--

CREATE TABLE IF NOT EXISTS `produkte` (
  `PID` int(11) NOT NULL,
  `Bezeichnung` varchar(45) DEFAULT NULL,
  `KategorieID` int(11) DEFAULT NULL,
  `Anbieter` int(11) DEFAULT NULL,
  `Text` varchar(255) DEFAULT NULL,
  `Startpreis` double DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `produkte`
--

INSERT INTO `produkte` (`PID`, `Bezeichnung`, `KategorieID`, `Anbieter`, `Text`, `Startpreis`) VALUES
(1, 'Fifa 16', 6, 1, 'Dies ist ein Super Spiel fÃ¼r die PS4', 35),
(2, 'BMW 118i', 4, 1, 'Sehr gepflegt', 7500),
(3, 'Kugelschreiber', 10, 1, 'Schreibt sehr gut', 1),
(4, 'Bleistift', 10, 1, 'Schreibt nicht gut', 1);

--
-- Trigger `produkte`
--
DELIMITER $$
CREATE TRIGGER `produkte_AFTER_INSERT` AFTER INSERT ON `produkte`
 FOR EACH ROW BEGIN
INSERT INTO auktion(Produkt, aktuelles_gebot) VALUES(new.PID, new.Startpreis);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL,
  `Username` varchar(45) DEFAULT NULL,
  `Passwort` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`uid`, `Username`, `Passwort`) VALUES
(1, 'Marco', '123'),
(2, 'Test', '123'),
(3, 'Karl', '123');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `auktion`
--
ALTER TABLE `auktion`
  ADD PRIMARY KEY (`AuktionID`);

--
-- Indizes für die Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`KID`);

--
-- Indizes für die Tabelle `produkte`
--
ALTER TABLE `produkte`
  ADD PRIMARY KEY (`PID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `uid_UNIQUE` (`uid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `auktion`
--
ALTER TABLE `auktion`
  MODIFY `AuktionID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `KID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT für Tabelle `produkte`
--
ALTER TABLE `produkte`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
