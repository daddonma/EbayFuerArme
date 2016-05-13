-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 13. Mai 2016 um 12:59
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL,
  `imgdata` longblob,
  `imgtype` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
  `Startpreis` double DEFAULT NULL,
  `Text` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Trigger `produkte`
--
DELIMITER $$
CREATE TRIGGER `produkte_AFTER_INSERT` AFTER INSERT ON `produkte`
 FOR EACH ROW BEGIN
	INSERT INTO auktion (Produkt, aktuelles_Gebot) VALUES (new.pid, new.startpreis);
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`uid`, `Username`, `Passwort`) VALUES
(23, '1234', '1234');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `auktion`
--
ALTER TABLE `auktion`
  ADD PRIMARY KEY (`AuktionID`),
  ADD KEY `Höchstbietender_idx` (`Höchstbietender`),
  ADD KEY `Produkt_idx` (`Produkt`);

--
-- Indizes für die Tabelle `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`KID`);

--
-- Indizes für die Tabelle `produkte`
--
ALTER TABLE `produkte`
  ADD PRIMARY KEY (`PID`),
  ADD KEY `Anbieter_idx` (`Anbieter`),
  ADD KEY `Kategorie_idx` (`KategorieID`);

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
  MODIFY `AuktionID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT für Tabelle `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `KID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT für Tabelle `produkte`
--
ALTER TABLE `produkte`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `auktion`
--
ALTER TABLE `auktion`
  ADD CONSTRAINT `Höchstbietender` FOREIGN KEY (`Höchstbietender`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Produkt` FOREIGN KEY (`Produkt`) REFERENCES `produkte` (`PID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `produkte`
--
ALTER TABLE `produkte`
  ADD CONSTRAINT `Anbieter` FOREIGN KEY (`Anbieter`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Kategorie` FOREIGN KEY (`KategorieID`) REFERENCES `kategorie` (`KID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_anbieter` FOREIGN KEY (`Anbieter`) REFERENCES `user` (`uid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
