<?php
error_reporting(E_ALL);
$db = new mysqli('localhost', 'root', '');
$sql = "DROP DATABASE `kis`;";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen: " . mysql_error());
$sql = "CREATE DATABASE `kis`;";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen: " . mysql_error());
$sql = "CREATE DATABASE `kis`;";
$sql = "CREATE TABLE `kis`.`user` (`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `user` VARCHAR(32) NOT NULL, `password` VARCHAR(32) NOT NULL, UNIQUE (`user`)) ENGINE = InnoDB;";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen: " . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `kis`.`formular` (
  `ID` int(11) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Vorname` varchar(32) NOT NULL,
  `Geburtsdatum` date NOT NULL,
  `Praetherapeutisch` tinyint(1) NOT NULL,
  `PSA` decimal(10,0) NOT NULL,
  `DatumPSA` date NOT NULL,
  `FreiesPSA` decimal(10,0) NOT NULL,
  `Prostatavolumen` decimal(10,0) NOT NULL,
  `Uebergangszone` decimal(10,0) NOT NULL,
  `DigitalePalpation` enum('normal','dubios','suspekt','VA') NOT NULL,
  `DigPalKommentar` text NOT NULL,
  `TransrektalerUltraschall` enum('normal','dubios','suspekt') NOT NULL,
  `TransUltraKommentar` text NOT NULL,
  `IPSS` int(11) NOT NULL,
  `Koerpergewicht` decimal(10,0) NOT NULL,
  `Koerperlaenge` decimal(10,0) NOT NULL,
  `BMI` decimal(10,0) NOT NULL,
  `PSA-Vorwerte` text NOT NULL,
  `PSA-VorDatum` date NOT NULL,
  `Biopsie-Ergebnis` tinyint(1) NOT NULL,
  `Biopsie-pos-Fund` int(11) NOT NULL,
  `Biopsie-pos-Gesamt` int(11) NOT NULL,
  `PIN` tinyint(1) NOT NULL,
  `PIN-Fund` int(11) NOT NULL,
  `PIN-Gesamt` int(11) NOT NULL,
  `Prostatitis` tinyint(1) NOT NULL,
  `Gleason1` int(11) NOT NULL,
  `Gleason2` int(11) NOT NULL,
  `Gleason3` int(11) NOT NULL,
  `Helpap` enum('a','b') NOT NULL,
  `PIN3` enum('a','b') NOT NULL,
  `AAH` tinyint(1) NOT NULL,
  `Benigne` tinyint(1) NOT NULL,
  `Kommentar` text NOT NULL,
  `In1` int(11) NOT NULL,
  `In2` int(11) NOT NULL,
  `Skelettszintigramm` tinyint(1) NOT NULL,
  `Besprechung` tinyint(1) NOT NULL,
  `Re-Biopsie` tinyint(1) NOT NULL,
  `PSA-Kontrolle` tinyint(1) NOT NULL,
  `radikale-Prostatektomie` tinyint(1) NOT NULL,
  `Bestrahlung` tinyint(1) NOT NULL,
  `extern` tinyint(1) NOT NULL,
  `HDR` tinyint(1) NOT NULL,
  `LDR` tinyint(1) NOT NULL,
  `Active-Surveillance` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen: " . mysql_error());
?>