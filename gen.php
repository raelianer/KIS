<?php
include 'config.php';
error_reporting(E_ALL);
$db = new mysqli(HOST, USER, PASS);

$sql = "DROP DATABASE `".DB."`;";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen1: " . mysql_error());

$sql = "CREATE DATABASE `".DB."`;";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen2: " . mysql_error());

$sql = "CREATE TABLE `".DB."`.`rollen` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `position` VARCHAR(32) NOT NULL, `read` BOOLEAN NOT NULL, `write` BOOLEAN NOT NULL, UNIQUE (`position`)) ENGINE = InnoDB;";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen3: " . mysql_error());

$sql = "CREATE TABLE `".DB."`.`users` (`userid` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `rollenid` INT NOT NULL, `username` VARCHAR(32) NOT NULL, `password` VARCHAR(32) NOT NULL, `firstname` VARCHAR(32) NOT NULL, `lastname` VARCHAR(32) NOT NULL, UNIQUE (`username`)) ENGINE = InnoDB;";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen4: " . mysql_error());

$sql = "CREATE TABLE `".DB."`.`patient` (`patientid` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `firstname` VARCHAR(32) NOT NULL, `lastname` VARCHAR(32) NOT NULL, `birth` DATE NOT NULL, `formularid` INT NULL) ENGINE = InnoDB;";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen5: " . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `".DB."`.`formular` (
  `ID` INT NOT NULL PRIMARY KEY,
  `Praetherapeutisch` tinyint(1) NOT NULL,
  `PSA` float NOT NULL,
  `DatumPSA` date NOT NULL,
  `FreiesPSA` float NOT NULL,
  `Prostatavolumen` float NOT NULL,
  `Uebergangszone` float NOT NULL,
  `DigitalePalpation` enum('normal','dubios','suspekt','VA') NOT NULL,
  `DigPalKommentar` text NOT NULL,
  `TransrektalerUltraschall` enum('normal','dubios','suspekt') NOT NULL,
  `TransUltraKommentar` text NOT NULL,
  `IPSS` int(11) NOT NULL,
  `Koerpergewicht` float NOT NULL,
  `Koerperlaenge` float NOT NULL,
  `BMI` int(11) NOT NULL,
  `PSAVorwerte` text NOT NULL,
  `PSAVorDatum` date NOT NULL,
  `BiopsieErgebnis` tinyint(1) NOT NULL,
  `BiopsieposFund` int(11) NOT NULL,
  `BiopsieposGesamt` int(11) NOT NULL,
  `PIN` tinyint(1) NOT NULL,
  `PINFund` int(11) NOT NULL,
  `PINGesamt` int(11) NOT NULL,
  `Prostatitis` tinyint(1) NOT NULL,
  `Gleason1` int(11) NOT NULL,
  `Gleason2` int(11) NOT NULL,
  `Gleason3` int(11) NOT NULL,
  `Helpap` enum('','G1a','G1b','G11a','G11b','G111a','G111b') NOT NULL,
  `PIN3` enum('','PIN 1','PIN 2','PIN 3') NOT NULL,
  `AAH` tinyint(1) NOT NULL,
  `Benigne` tinyint(1) NOT NULL,
  `BenigneKommentar` text NOT NULL,
  `In1` int(11) NOT NULL,
  `In2` int(11) NOT NULL,
  `Skelettszintigramm` tinyint(1) NOT NULL,
  `Besprechung` tinyint(1) NOT NULL,
  `ReBiopsie` tinyint(1) NOT NULL,
  `PSAKontrolle` tinyint(1) NOT NULL,
  `radikaleProstatektomie` tinyint(1) NOT NULL,
  `Bestrahlung` tinyint(1) NOT NULL,
  `extern` tinyint(1) NOT NULL,
  `HDR` tinyint(1) NOT NULL,
  `LDR` tinyint(1) NOT NULL,
  `ActiveSurveillance` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen6: " . mysql_error());




$sql = "INSERT INTO `".DB."`.`users` (`userid`, `rollenid`, `username`, `password`, `firstname`, `lastname`) VALUES (NULL, '1', 'mueller', 'abc', 'Hans', 'Müller');";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen7: " . mysql_error());

$sql = "INSERT INTO `".DB."`.`users` (`userid`, `rollenid`, `username`, `password`, `firstname`, `lastname`) VALUES (NULL, '2', 'admin', '123', 'Klaus', 'Maier');";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen8: " . mysql_error());

$sql = "INSERT INTO `".DB."`.`users` (`userid`, `rollenid`, `username`, `password`, `firstname`, `lastname`) VALUES (NULL, '3', 'schmidt', 'xyz', 'Harald', 'Schmidt');";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen9: " . mysql_error());



$sql = "INSERT INTO `".DB."`.`rollen` (`id`, `position`, `read`, `write`) VALUES (NULL, 'Chefarzt', '1', '1');";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen10: " . mysql_error());

$sql = "INSERT INTO `".DB."`.`rollen` (`id`, `position`, `read`, `write`) VALUES (NULL, 'Administrator', '0', '0');";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen11: " . mysql_error());

$sql = "INSERT INTO `".DB."`.`rollen` (`id`, `position`, `read`, `write`) VALUES (NULL, 'Arzthelfer', '1', '0');";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen12: " . mysql_error());





$sql = "INSERT INTO `".DB."`.`patient` (`patientid`, `firstname`, `lastname`, `birth`, `formularid`) VALUES (NULL, 'Max', 'Mustermann', '1980-08-15', 1);";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen13: " . mysql_error());

$sql = "INSERT INTO `".DB."`.`patient` (`patientid`, `firstname`, `lastname`, `birth`, `formularid`) VALUES (NULL, 'Paul', 'Panta', '1972-01-25', NULL);";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen14: " . mysql_error());

$sql = "INSERT INTO `".DB."`.`patient` (`patientid`, `firstname`, `lastname`, `birth`, `formularid`) VALUES (NULL, 'Peter', 'Pollmann', '1954-02-05', NULL);";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen15: " . mysql_error());

$sql = "INSERT INTO `".DB."`.`patient` (`patientid`, `firstname`, `lastname`, `birth`, `formularid`) VALUES (NULL, 'Bernd', 'Bäcker', '1960-02-10', NULL);";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen16: " . mysql_error());

$sql = "INSERT INTO `".DB."`.`formular` (`ID`, `Praetherapeutisch`, `PSA`, `DatumPSA`, `FreiesPSA`, `Prostatavolumen`, `Uebergangszone`, `DigitalePalpation`, `DigPalKommentar`, `TransrektalerUltraschall`, `TransUltraKommentar`, `IPSS`, `Koerpergewicht`, `Koerperlaenge`, `BMI`, `PSAVorwerte`, `PSAVorDatum`, `BiopsieErgebnis`, `BiopsieposFund`, `BiopsieposGesamt`, `PIN`, `PINFund`, `PINGesamt`, `Prostatitis`, `Gleason1`, `Gleason2`, `Gleason3`, `Helpap`, `PIN3`, `AAH`, `Benigne`, `BenigneKommentar`, `In1`, `In2`, `Skelettszintigramm`, `Besprechung`, `ReBiopsie`, `PSAKontrolle`, `radikaleProstatektomie`, `Bestrahlung`, `extern`, `HDR`, `LDR`, `ActiveSurveillance`) VALUES ('1', '1', '5.3', '2011-06-08', '2', '31', '5', 'suspekt', 'asdnfasjdflök', 'dubios', 'asdgadsfgasfdgfsd', '52', '90', '185', '25', 'lkdsnfksdfandfsadnlf', '2011-05-02', '1', '1', '1', '1', '4', '7', '1', '2', '3', '4', 'G1b', 'PIN 3', '1', '1', 'adsfasdfasdfasdf', '23', '56', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen17: " . mysql_error());
?>