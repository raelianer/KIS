<?php
error_reporting(E_ALL);
$db = new mysqli('localhost', 'obiwan11880', 'Porsche845', 'obiwan11880');

$sql = "CREATE TABLE `obiwan11880`.`rollen` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `position` VARCHAR(32) NOT NULL, `read` BOOLEAN NOT NULL, `write` BOOLEAN NOT NULL, UNIQUE (`position`)) ENGINE = InnoDB;";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen1: " . mysql_error());

$sql = "CREATE TABLE `obiwan11880`.`users` (`userid` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `rollenid` INT NOT NULL, `username` VARCHAR(32) NOT NULL, `password` VARCHAR(32) NOT NULL, `firstname` VARCHAR(32) NOT NULL, `lastname` VARCHAR(32) NOT NULL, UNIQUE (`username`)) ENGINE = InnoDB;";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen: " . mysql_error());

$sql = "CREATE TABLE `obiwan11880`.`patient` (`patientid` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `firstname` VARCHAR(32) NOT NULL, `lastname` VARCHAR(32) NOT NULL, `birth` DATE NOT NULL, `formularid` INT NULL) ENGINE = InnoDB;";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen: " . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `obiwan11880`.`formular` (
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


$sql = "INSERT INTO `obiwan11880`.`users` (`userid`, `rollenid`, `username`, `password`, `firstname`, `lastname`) VALUES (NULL, '1', 'mueller', 'abc', 'Hans', 'M�ller');";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen7: " . mysql_error());

$sql = "INSERT INTO `obiwan11880`.`users` (`userid`, `rollenid`, `username`, `password`, `firstname`, `lastname`) VALUES (NULL, '2', 'admin', '123', 'Klaus', 'Maier');";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen8: " . mysql_error());

$sql = "INSERT INTO `obiwan11880`.`users` (`userid`, `rollenid`, `username`, `password`, `firstname`, `lastname`) VALUES (NULL, '3', 'schmidt', 'xyz', 'Harald', 'Schmidt');";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen9: " . mysql_error());



$sql = "INSERT INTO `obiwan11880`.`rollen` (`id`, `position`, `read`, `write`) VALUES (NULL, 'Chefarzt', '1', '1');";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen10: " . mysql_error());

$sql = "INSERT INTO `obiwan11880`.`rollen` (`id`, `position`, `read`, `write`) VALUES (NULL, 'Administrator', '0', '0');";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen11: " . mysql_error());

$sql = "INSERT INTO `obiwan11880`.`rollen` (`id`, `position`, `read`, `write`) VALUES (NULL, 'Arzthelfer', '1', '0');";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen12: " . mysql_error());





$sql = "INSERT INTO `obiwan11880`.`patient` (`patientid`, `firstname`, `lastname`, `birth`, `formularid`) VALUES (NULL, 'Max', 'Mustermann', '1980-08-15', NULL);";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen13: " . mysql_error());

$sql = "INSERT INTO `obiwan11880`.`patient` (`patientid`, `firstname`, `lastname`, `birth`, `formularid`) VALUES (NULL, 'Paul', 'Panta', '1972-01-25', NULL);";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen14: " . mysql_error());

$sql = "INSERT INTO `obiwan11880`.`patient` (`patientid`, `firstname`, `lastname`, `birth`, `formularid`) VALUES (NULL, 'Peter', 'Pollmann', '1954-02-05', NULL);";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen15: " . mysql_error());

$sql = "INSERT INTO `obiwan11880`.`patient` (`patientid`, `firstname`, `lastname`, `birth`, `formularid`) VALUES (NULL, 'Bernd', 'B�cker', '1960-02-10', NULL);";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen16: " . mysql_error());