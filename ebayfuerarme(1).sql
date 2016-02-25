-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Feb 2016 um 08:25
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
  `aktuelles_gebot` double DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `auktion`
--

INSERT INTO `auktion` (`AuktionID`, `Produkt`, `Höchstbietender`, `aktuelles_gebot`) VALUES
(1, 4, NULL, 15),
(3, 6, NULL, 1000000),
(5, 8, NULL, 1),
(6, 9, NULL, 88),
(7, 10, NULL, 52),
(8, 11, NULL, 98),
(9, 12, NULL, 0.01);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `produkte`
--

INSERT INTO `produkte` (`PID`, `Bezeichnung`, `KategorieID`, `Anbieter`, `Startpreis`, `Text`) VALUES
(4, 'Buch', 3, 14, 1, 'wie neu'),
(6, 'Nichts', 8, 17, 80, 'Hallo ich bin ein behinderter Spast!'),
(8, 'Ich bin doof', 10, 14, 5, ''),
(9, 'Spast', 10, 18, 88, ''),
(10, '1^2^2^2', 6, 14, 52, 'assas23213'),
(11, 'Fusball', 9, 19, 98, ''),
(12, 'Muddis Lustkugeln', 5, 14, 0.01, 'Lustkugeln deiner Mudder');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`uid`, `Username`, `Passwort`) VALUES
(1, 'Marco', 'Test123'),
(2, 'Marco', 'Test123'),
(3, 'Karl', 'Hermann'),
(4, 'Marco', 'Test123'),
(5, 'Hallo', 'hi'),
(6, 'Marco', 'Test123'),
(7, 'Marco', '123'),
(8, 'KarlHermann', 'Karl'),
(9, 'Marco', 'Test123'),
(10, 'Tessst', 'Test'),
(11, 'HansPeter', '123'),
(12, 'engel', '123'),
(13, 'Pablo', '123'),
(14, 'Timon', 'asd'),
(15, 'Niger', '321'),
(16, 'Pablo', '123'),
(17, 'BehinderterSpast', 'Spast'),
(18, 'Spast', 'spast'),
(19, 'MaxMustermann', 'Muster'),
(20, 'migthye', 'damudder');

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
  MODIFY `AuktionID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT für Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `KID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT für Tabelle `produkte`
--
ALTER TABLE `produkte`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
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
