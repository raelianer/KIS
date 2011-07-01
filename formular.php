<?php session_start();
include 'config.php';
error_reporting(E_ALL);

/*
	Fälle, die zu unterscheiden sind:
	* Nutzer nicht eingeloggt
		-> weiterleiten zur index.html
		
	ansonsten ist Nutzer eingeloggt
	* keine FormularID -> leeres Formular anlegen
	* FormularID liegt vor
		-> Daten zur FormularID aus Datenbank laden
	* Formular wurde an sich selbst abgeschickt
		-> Korrektur der leeren Checkboxen und speichern?

*/

// Prüfen, ob der Nutzer eingeloggt ist
if ( (!isset( $_SESSION['permission'] ) ) || $_SESSION['permission']==false) header('Location: index.html');

if (!$_SESSION['reading']){
header('Location: leserecht.php?PHPSESSID="'.session_id());
}
if (isset( $_POST['submit'] ) and !$_SESSION['writing']){
header('Location: schreibrecht.php?PHPSESSID="'.session_id());
}
if (isset( $_POST['delete'] ) and !$_SESSION['writing']){
header('Location: schreibrecht.php?PHPSESSID="'.session_id());
}



$db = new mysqli(HOST, USER, PASS, DB);

	// FormularID retten:
	if ( (isset($_POST['patientid']))) {
	$_SESSION['PatientID'] = $_POST['patientid'];
	}
	
	// Formular löschen
if ( (isset($_POST['delete'])) and $_SESSION['writing'] ) {
	$sql = "DELETE FROM `formular` WHERE `ID` =".$_SESSION['PatientID'];
	$result = $db->query($sql)
or die("Anfrage fehlgeschlagen1: " . mysql_error());
	$sql2 = "UPDATE patient SET formularid = null WHERE patientid = '".$_SESSION['PatientID']."';";
	$result2 = $db->query($sql2);
}

// Datenbankabfrage durchführen
// $sql = "SELECT * FROM `patient` INNER JOIN `formular` ON `patient`.`patientid` = `formular`.`ID` WHERE `patientid` =".$_SESSION['PatientID']."";
$sql = "SELECT * FROM `patient` WHERE `patientid` =".$_SESSION['PatientID']."";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen1: " . mysql_error());

$stammdaten = $result->fetch_object();


$sql = "SELECT * FROM `formular` WHERE `ID` =".$_SESSION['PatientID']."";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen1: " . mysql_error());

$row = $result->fetch_object();

// Bisher kein Formular gespeichert und auch nicht an sich selbst geschickt
if ( ($row==NULL) && (!isset($_POST['submit'])) ){
	// Neues Formular anlegen
	$_POST['Name'] = $stammdaten->lastname;
	$_POST['Vorname'] = $stammdaten->firstname;
	$_POST['Geburtsdatum'] = $stammdaten->birth;
	$_POST['Praetherapeutisch'] = "";
	$_POST['PSA'] = "";
	$_POST['DatumPSA'] = "";
	$_POST['FreiesPSA'] = "";
	$_POST['Prostatavolumen'] = "";
	$_POST['Uebergangszone'] = "";
	$_POST['DigitalePalpation'] = "";
	$_POST['DigPalKommentar'] = "";
	$_POST['TransrektalerUltraschall'] = "";
	$_POST['TransUltraKommentar'] = "";
	$_POST['IPSS'] = "";
	$_POST['Koerpergewicht'] = "1";
	$_POST['Koerperlaenge'] = "1";
	$_POST['BMI'] = "";
	$_POST['PSAVorwerte'] = "";
	$_POST['PSAVorDatum'] = "";
	$_POST['BiopsieErgebnis'] = "";
	$_POST['BiopsieposFund'] = "";
	$_POST['BiopsieposGesamt'] = "";
	$_POST['PIN'] = "";
	$_POST['PINFund'] = "";
	$_POST['PINGesamt'] = "";
	$_POST['Prostatitis'] = "";
	$_POST['Gleason1'] = "";
	$_POST['Gleason2'] = "";
	$_POST['Gleason3'] = "";
	$_POST['Helpap'] = "";
	$_POST['PIN3'] = "";
	$_POST['AAH'] = "";
	$_POST['Benigne'] = "";
	$_POST['BenigneKommentar'] = "";
	$_POST['In1'] = "";
	$_POST['In2'] = "";
	$_POST['Skelettszintigramm'] = "";
	$_POST['Besprechung'] = "";
	$_POST['ReBiopsie'] = "";
	$_POST['PSAKontrolle'] = "";
	$_POST['radikaleProstatektomie'] = "";
	$_POST['Bestrahlung'] = "";
	$_POST['extern'] = "";
	$_POST['HDR'] = "";
	$_POST['LDR'] = "";
	$_POST['ActiveSurveillance'] = "";
}


// index -> passwort eingeben mit POST
// login.php -> prüft Login-Daten und wählt Formular aus mit POST FormularID


//		$_SESSION['permission'] = true; -> eingeloggt
//		$_SESSION['reading'] = $row['read']; -> Ausgabe kein Leserecht
//		$_SESSION['writing'] = $row['write']; -> Ausgabe kein Schreibrecht
//		$_POST['formular']; -> FormularID


// Formular wurde nicht abgeschickt! -> Daten aus Datenbank laden
if ( (!isset($_POST['submit'])) && (!$row==NULL) ) {
	$_POST['Name'] = $stammdaten->lastname;
	$_POST['Vorname'] = $stammdaten->firstname;
	$_POST['Geburtsdatum'] = $stammdaten->birth;
	$_POST['Praetherapeutisch'] = $row->Praetherapeutisch;
	$_POST['PSA'] = $row->PSA;
	$_POST['DatumPSA'] = $row->DatumPSA;
	$_POST['FreiesPSA'] = $row->FreiesPSA;
	$_POST['Prostatavolumen'] = $row->Prostatavolumen;
	$_POST['Uebergangszone'] = $row->Uebergangszone;
	$_POST['DigitalePalpation'] = $row->DigitalePalpation;
	$_POST['DigPalKommentar'] = $row->DigPalKommentar;
	$_POST['TransrektalerUltraschall'] = $row->TransrektalerUltraschall;
	$_POST['TransUltraKommentar'] = $row->TransUltraKommentar;
	$_POST['IPSS'] = $row->IPSS;
	$_POST['Koerpergewicht'] = $row->Koerpergewicht;
	$_POST['Koerperlaenge'] = $row->Koerperlaenge;
	$_POST['BMI'] = $row->BMI;
	$_POST['PSAVorwerte'] = $row->PSAVorwerte;
	$_POST['PSAVorDatum'] = $row->PSAVorDatum;
	$_POST['BiopsieErgebnis'] = $row->BiopsieErgebnis;
	$_POST['BiopsieposFund'] = $row->BiopsieposFund;
	$_POST['BiopsieposGesamt'] = $row->BiopsieposGesamt;
	$_POST['PIN'] = $row->PIN;
	$_POST['PINFund'] = $row->PINFund;
	$_POST['PINGesamt'] = $row->PINGesamt;
	$_POST['Prostatitis'] = $row->Prostatitis;
	$_POST['Gleason1'] = $row->Gleason1;
	$_POST['Gleason2'] = $row->Gleason2;
	$_POST['Gleason3'] = $row->Gleason3;
	$_POST['Helpap'] = $row->Helpap;
	$_POST['PIN3'] = $row->PIN3;
	$_POST['AAH'] = $row->AAH;
	$_POST['Benigne'] = $row->Benigne;
	$_POST['BenigneKommentar'] = $row->BenigneKommentar;
	$_POST['In1'] = $row->In1;
	$_POST['In2'] = $row->In2;
	$_POST['Skelettszintigramm'] = $row->Skelettszintigramm;
	$_POST['Besprechung'] = $row->Besprechung;
	$_POST['ReBiopsie'] = $row->ReBiopsie;
	$_POST['PSAKontrolle'] = $row->PSAKontrolle;
	$_POST['radikaleProstatektomie'] = $row->radikaleProstatektomie;
	$_POST['Bestrahlung'] = $row->Bestrahlung;
	$_POST['extern'] = $row->extern;
	$_POST['HDR'] = $row->HDR;
	$_POST['LDR'] = $row->LDR;
	$_POST['ActiveSurveillance'] = $row->ActiveSurveillance;
} 

// Formular wurde abgeschickt... Korrektur für leere Variablen
if (isset( $_POST['submit'] )) {
// Benutzer hat Formular abgeschickt, aber leere Checkboxen sind nicht gleich 0!

//if (!isset( $_POST['Name'] )) $_POST['Name'] = '';
//if (!isset( $_POST['Vorname'] )) $_POST['Vorname'] = '';
//if (!isset( $_POST['Geburtsdatum'] )) $_POST['Geburtsdatum'] = '';
if (!isset( $_POST['Praetherapeutisch'] )) $_POST['Praetherapeutisch'] = 0;
//if (!isset( $_POST['PSA'] )) $_POST['PSA'] = 0;
//if (!isset( $_POST['DatumPSA'] )) $_POST['DatumPSA'] = 0;
//if (!isset( $_POST['FreiesPSA'] )) $_POST['FreiesPSA'] = 0;
//if (!isset( $_POST['Prostatavolumen'] )) $_POST['Prostatavolumen'] = 0;
//if (!isset( $_POST['Uebergangszone'] )) $_POST['Uebergangszone'] = 0;
if (!isset( $_POST['DigitalePalpation'] )) $_POST['DigitalePalpation'] = '';
//if (!isset( $_POST['DigPalKommentar'] )) $_POST['DigPalKommentar'] = '';
if (!isset( $_POST['TransrektalerUltraschall'] )) $_POST['TransrektalerUltraschall'] = '';
//if (!isset( $_POST['TransUltraKommentar'] )) $_POST['TransUltraKommentar'] = '';
//if (!isset( $_POST['IPSS'] )) $_POST['IPSS'] = '';
//if (!isset( $_POST['Koerpergewicht'] )) $_POST['Koerpergewicht'] = '';
//if (!isset( $_POST['Koerperlaenge'] )) $_POST['Koerperlaenge'] = '';
//if (!isset( $_POST['BMI'] )) $_POST['BMI'] = '';
//if (!isset( $_POST['PSAVorwerte'] )) $_POST['PSAVorwerte'] = '';
//if (!isset( $_POST['PSAVorDatum'] )) $_POST['PSAVorDatum'] = '';
if (!isset( $_POST['BiopsieErgebnis'] )) $_POST['BiopsieErgebnis'] = 0;
//if (!isset( $_POST['BiopsieposFund'] )) $_POST['BiopsieposFund'] = 0;
//if (!isset( $_POST['BiopsieposGesamt'] )) $_POST['BiopsieposGesamt'] = 0;
if (!isset( $_POST['PIN'] )) $_POST['PIN'] = 0;
//if (!isset( $_POST['PINFund'] )) $_POST['PINFund'] = 0;
//if (!isset( $_POST['PINGesamt'] )) $_POST['PINGesamt'] = 0;
if (!isset( $_POST['Prostatitis'] )) $_POST['Prostatitis'] = 0;
//if (!isset( $_POST['Gleason1'] )) $_POST['Gleason1'] = 0;
//if (!isset( $_POST['Gleason2'] )) $_POST['Gleason2'] = 0;
//if (!isset( $_POST['Gleason3'] )) $_POST['Gleason3'] = 0;
//if (!isset( $_POST['Helpap'] )) $_POST['Helpap'] = 0;
//if (!isset( $_POST['PIN3'] )) $_POST['PIN3'] = 0;
if (!isset( $_POST['AAH'] )) $_POST['AAH'] = 0;
if (!isset( $_POST['Benigne'] )) $_POST['Benigne'] = 0;
//if (!isset( $_POST['BenigneKommentar'] )) $_POST['BenigneKommentar'] = 0;
//if (!isset( $_POST['In1'] )) $_POST['In1'] = 0;
//if (!isset( $_POST['In2'] )) $_POST['In2'] = 0;
if (!isset( $_POST['Skelettszintigramm'] )) $_POST['Skelettszintigramm'] = 0;
if (!isset( $_POST['Besprechung'] )) $_POST['Besprechung'] = 0;
if (!isset( $_POST['ReBiopsie'] )) $_POST['ReBiopsie'] = 0;
if (!isset( $_POST['PSAKontrolle'] )) $_POST['PSAKontrolle'] = 0;
if (!isset( $_POST['radikaleProstatektomie'] )) $_POST['radikaleProstatektomie'] = 0;
if (!isset( $_POST['Bestrahlung'] )) $_POST['Bestrahlung'] = 0;
if (!isset( $_POST['extern'] )) $_POST['extern'] = 0;
if (!isset( $_POST['HDR'] )) $_POST['HDR'] = 0;
if (!isset( $_POST['LDR'] )) $_POST['LDR'] = 0;
if (!isset( $_POST['ActiveSurveillance'] )) $_POST['ActiveSurveillance'] = 0;
}


// Wenn abgesendet wird, dann soll auch gespeichert werden
if ($_SESSION['writing'] and isset( $_POST['submit'] )){
	// Falls kein Datenbankeintrag für das Formular vorhanden -> neuen Datensatz anlegen!
	if ($row==NULL) {
	$sql = "INSERT INTO `".DB."`.`formular` (`ID`, `Praetherapeutisch`, `PSA`, `DatumPSA`, `FreiesPSA`, `Prostatavolumen`, `Uebergangszone`, `DigitalePalpation`, `DigPalKommentar`, `TransrektalerUltraschall`, `TransUltraKommentar`, `IPSS`, `Koerpergewicht`, `Koerperlaenge`, `BMI`, `PSAVorwerte`, `PSAVorDatum`, `BiopsieErgebnis`, `BiopsieposFund`, `BiopsieposGesamt`, `PIN`, `PINFund`, `PINGesamt`, `Prostatitis`, `Gleason1`, `Gleason2`, `Gleason3`, `Helpap`, `PIN3`, `AAH`, `Benigne`, `BenigneKommentar`, `In1`, `In2`, `Skelettszintigramm`, `Besprechung`, `ReBiopsie`, `PSAKontrolle`, `radikaleProstatektomie`, `Bestrahlung`, `extern`, `HDR`, `LDR`, `ActiveSurveillance`) VALUES ('".$_SESSION['PatientID']."', '".$_POST['Praetherapeutisch']."', '".$_POST['PSA']."', '".$_POST['DatumPSA']."', '".$_POST['FreiesPSA']."', '".$_POST['Prostatavolumen']."', '".$_POST['Uebergangszone']."', '".$_POST['DigitalePalpation']."', '".$_POST['DigPalKommentar']."', '".$_POST['TransrektalerUltraschall']."', '".$_POST['TransUltraKommentar']."', '".$_POST['IPSS']."', '".$_POST['Koerpergewicht']."', '".$_POST['Koerperlaenge']."', '".$_POST['BMI']."', '".$_POST['PSAVorwerte']."', '".$_POST['PSAVorDatum']."', '".$_POST['BiopsieErgebnis']."', '".$_POST['BiopsieposFund']."', '".$_POST['BiopsieposGesamt']."', '".$_POST['PIN']."', '".$_POST['PINFund']."', '".$_POST['PINGesamt']."', '".$_POST['Prostatitis']."', '".$_POST['Gleason1']."', '".$_POST['Gleason2']."', '".$_POST['Gleason3']."', '".$_POST['Helpap']."', '".$_POST['PIN3']."', '".$_POST['AAH']."', '".$_POST['Benigne']."', '".$_POST['BenigneKommentar']."', '".$_POST['In1']."', '".$_POST['In2']."', '".$_POST['Skelettszintigramm']."', '".$_POST['Besprechung']."', '".$_POST['ReBiopsie']."', '".$_POST['PSAKontrolle']."', '".$_POST['radikaleProstatektomie']."', '".$_POST['Bestrahlung']."', '".$_POST['extern']."', '".$_POST['HDR']."', '".$_POST['LDR']."', '".$_POST['ActiveSurveillance']."');";
	$sql2 = "UPDATE patient SET formularid = '".$stammdaten->patientid."' WHERE patientid = '".$_SESSION['PatientID']."';";
	$result2 = $db->query($sql2);
	} else {
	// Falls Formular bereits vorhanden -> Datensatz ändern!
	$sql = "UPDATE `".DB."`.`formular` SET `Praetherapeutisch` = '".$_POST['Praetherapeutisch']."', `PSA` = '".$_POST['PSA']."', `DatumPSA` = '".$_POST['DatumPSA']."', `FreiesPSA` = '".$_POST['FreiesPSA']."', `Prostatavolumen` = '".$_POST['Prostatavolumen']."', `Uebergangszone` = '".$_POST['Uebergangszone']."', `DigitalePalpation` = '".$_POST['DigitalePalpation']."', `DigPalKommentar` = '".$_POST['DigPalKommentar']."', `TransrektalerUltraschall` = '".$_POST['TransrektalerUltraschall']."', `TransUltraKommentar` = '".$_POST['TransUltraKommentar']."', `IPSS` = '".$_POST['IPSS']."', `Koerpergewicht` = '".$_POST['Koerpergewicht']."', `Koerperlaenge` = '".$_POST['Koerperlaenge']."', `BMI` = '".$_POST['BMI']."', `PSAVorwerte` = '".$_POST['PSAVorwerte']."', `PSAVorDatum` = '".$_POST['PSAVorDatum']."', `BiopsieErgebnis` = '".$_POST['BiopsieErgebnis']."', `BiopsieposFund` = '".$_POST['BiopsieposFund']."', `BiopsieposGesamt` = '".$_POST['BiopsieposGesamt']."', `PIN` = '".$_POST['PIN']."', `PINFund` = '".$_POST['PINFund']."', `PINGesamt` = '".$_POST['PINGesamt']."', `Prostatitis` = '".$_POST['Prostatitis']."', `Gleason1` = '".$_POST['Gleason1']."', `Gleason2` = '".$_POST['Gleason2']."', `Gleason3` = '".$_POST['Gleason3']."', `Helpap` = '".$_POST['Helpap']."', `PIN3` = '".$_POST['PIN3']."', `AAH` = '".$_POST['AAH']."', `Benigne` = '".$_POST['Benigne']."', `BenigneKommentar` = '".$_POST['BenigneKommentar']."', `In1` = '".$_POST['In1']."', `In2` = '".$_POST['In2']."', `Skelettszintigramm` = '".$_POST['Skelettszintigramm']."', `Besprechung` = '".$_POST['Besprechung']."', `ReBiopsie` = '".$_POST['ReBiopsie']."', `PSAKontrolle` = '".$_POST['PSAKontrolle']."', `radikaleProstatektomie` = '".$_POST['radikaleProstatektomie']."', `Bestrahlung` = '".$_POST['Bestrahlung']."', `extern` = '".$_POST['extern']."', `HDR` = '".$_POST['HDR']."', `LDR` = '".$_POST['LDR']."', `ActiveSurveillance` = '".$_POST['ActiveSurveillance']."' WHERE ID = '".$_SESSION['PatientID']."';";
	}
	$result = $db->query($sql)
or die("Speichern fehlgeschlagen: " . mysql_error());
	/*echo '
	<script language="javascript" type="text/javascript">
	alert(\'Das Formular wurde gespeichert\' );
	</script>
	';'*/
}


echo'<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
<title>KIS Fiktiv</title>
<link rel="stylesheet" href="default.css" type="text/css" />
</head>
<body>';
echo'	<div id="head"><div id="fiktiv">KIS Fiktiv</div>
	 <div id="menu">
    	  <ul>';
		  
// Inhalt aus der login.php
    		echo '<li><a href=\'login.php?PHPSESSID='.session_id().'\'>Home</a></li>';
    		echo '<li><a href=\'logout.php?PHPSESSID='.session_id().'\'>Logout</a></li>';
		echo '<li><a href=\'doku.php?PHPSESSID='.session_id().'\'>Dokumentation</a></li>';
    	  echo '</ul>';
  	  echo '</div>';
	echo '</div>';
	echo '<div id="content">';
	echo '<div id="label">';
	echo '<div id="box2">';		  
		  
		  
		  
echo '<div id="headline">Protokoll prätherapeutische Prostatakonferenz</div>';
echo'<form action="formular.php?'.SID.'" method="post">
  <fieldset>
    <legend>Patientendaten</legend>
	<label for="Name" class="left">Name:</label>
      <input type="text" id="Name" name="Name" value="'.$_POST['Name'].'" readonly="readonly" /><br />
	<label for="Vorname" class="left">Vorname:</label>
      <input type="text" id="Vorname" name="Vorname" value="'.$_POST['Vorname'].'" readonly="readonly" /><br />
	<label for="Geburtsdatum" class="left">Geburtsdatum:</label>
      <input type="date" id="Geburtsdatum" name="Geburtsdatum" value="'.$_POST['Geburtsdatum'].'" readonly="readonly" /><br />
  </fieldset>
  <fieldset>
    <legend>Biopsie</legend>
      <input type="checkbox" id="Praetherapeutisch" name="Praetherapeutisch" value="1" ';
	  if ($_POST['Praetherapeutisch']) echo 'checked="checked"';
	  echo' class="right"/>
	  <label for="Praetherapeutisch">Prätherapeutisch</label>
    <br />
    <label for="PSA" class="left">PSA:</label>
      <input type="text" id="PSA" name="PSA" value="'.$_POST['PSA'].'" ';
	  if ($_POST['PSA'] >= 3.2) echo 'class="wrong" ';
	  echo'/>
      ng/ml (Beckman-Coulter Access Referenzbereich < 3,2), <br/>';

	  if ($_POST['PSA'] >= 3.2) echo '<span class="right wrong">PSA zu hoch!</span><br />';
	  if ($_POST['PSA'] < 0) echo '<span class="right wrong">PSA muss positiv sein!</span><br />';
	  echo'
	<label for="DatumPSA" class="left">PSA-Datum:</label>
      <input type="date" id="DatumPSA" name="DatumPSA" value="'.$_POST['DatumPSA'].'" /><br/>';
	  echo'<label for="FreiesPSA" class="left">Freies PSA:</label>
      <input type="text" id="FreiesPSA" name="FreiesPSA" value="'.$_POST['FreiesPSA'].'" />
      ng/ml, Quotient frei/gesamt - PSA<br/>
	<label for="Prostatavolumen" class="left">Prostatavolumen gesamte Prostata:</label>
      <input type="text" id="Prostatavolumen" name="Prostatavolumen" value="'.$_POST['Prostatavolumen'].'" />
      ccm,<br />
    <label for="Uebergangszone" class="left">Übergangszone:</label>
      <input type="text" id="Uebergangszone" name="Uebergangszone" value="'.$_POST['Uebergangszone'].'" />
      cmm
  </fieldset>
  <fieldset>
    <legend>Digitale Palpation</legend>
      <input type="radio" id="DigitalePalpation1" name="DigitalePalpation" value="normal" ';
	  if ($_POST['DigitalePalpation']=='normal') echo 'checked="checked" ';
	  echo 'class="right"/>
      <label for="DigitalePalpation1">normal</label><br />
      <input type="radio" id="DigitalePalpation2" name="DigitalePalpation" value="dubios" ';
	  if ($_POST['DigitalePalpation']=='dubios') echo 'checked="checked" ';
	  echo 'class="right"/>
      <label for="DigitalePalpation2">dubios</label><br />
      <input type="radio" id="DigitalePalpation3" name="DigitalePalpation" value="suspekt" ';
	  if ($_POST['DigitalePalpation']=='suspekt') echo 'checked="checked" ';
	  echo 'class="right"/>
      <label for="DigitalePalpation3">suspekt</label><br />
      <input type="radio" id="DigitalePalpation4" name="DigitalePalpation" value="VA" onclick="document.getElementById(\'tx1\').disabled=\'\'"' ;
	  if ($_POST['DigitalePalpation']=='VA') echo 'checked="checked" ';
	  echo 'class="right" style="vertical-align:top;"/>
      <label for="DigitalePalpation4">V.a. Organüberschreitung</label><br/><label class="left" style="vertical-align:top;"> Lokalisation:</label>
    <textarea name="DigPalKommentar" id="tx1">'.$_POST['DigPalKommentar'].'</textarea>
  </fieldset>
  <fieldset>
    <legend>Transrektaler Ultraschall</legend>
      <input type="radio" id="TransrektalerUltraschall1" name="TransrektalerUltraschall" value="normal" ';
	  if ($_POST['TransrektalerUltraschall']=='normal') echo 'checked="checked" ';
	  echo 'class="right" />
      <label for="TransrektalerUltraschall1">normal</label><br />
      <input type="radio" id="TransrektalerUltraschall2" name="TransrektalerUltraschall" value="dubios" ';
	  if ($_POST['TransrektalerUltraschall']=='dubios') echo 'checked="checked" ';
	  echo 'class="right" />
      <label for="TransrektalerUltraschall2">dubios</label><br />
      <input type="radio" id="TransrektalerUltraschall3" name="TransrektalerUltraschall" value="suspekt" onclick="document.getElementById(\'tx2\').disabled=\'\'"';
	  if ($_POST['TransrektalerUltraschall']=='suspekt') echo 'checked="checked" ';
	  echo 'class="right"  style="vertical-align:top;"/>
      <label for="TransrektalerUltraschall3">suspekt</label><br><label class="left" style="vertical-align:top;"> Lokalisation:</label>
   
	<label>
      <textarea name="TransUltraKommentar" id="tx2">'.$_POST['TransUltraKommentar'].'</textarea>
    </label><br />
    <label for="IPSS" class="left">IPSS:</label>
      <input type="text" id="IPSS" name="IPSS" value="'.$_POST['IPSS'].'"';
	if ($_POST['IPSS'] > 35 or $_POST['IPSS'] < 0) echo 'class="wrong" ';
	echo'	  />';
    echo'  (0-35)</label>
    <br/>';
	if ($_POST['IPSS'] > 35 or $_POST['IPSS'] < 0) echo '<span class="right wrong">IPSS muss >=0 und <=35 sein !</span><br />';
	echo'
    <label for="Koerpergewicht" class="left">Körpergewicht:</label>';
if ($_POST['Koerpergewicht']==1) $_POST['Koerpergewicht']=null;
	echo '<input type="text" id="Koerpergewicht" name="Koerpergewicht" value="'.$_POST['Koerpergewicht'].'" />';

echo'	kg<br />
    <label for="Koerperlaenge" class="left">Körperlänge:</label>';
	if ($_POST['Koerperlaenge']==1) $_POST['Koerperlaenge']=null;
	echo '
      <input type="text" id="Koerperlaenge" name="Koerperlaenge" value="'.$_POST['Koerperlaenge'].'" />
      cm<br />
  </fieldset>
  <fieldset>
    <legend>Body-Mass-Index</legend>';
	if ($_POST['Koerperlaenge'] == 0) $_POST['BMI'] = null;
	else $_POST['BMI'] = round($_POST['Koerpergewicht'] / ($_POST['Koerperlaenge']/100 * $_POST['Koerperlaenge']/100));
	
	echo '
    <input type="text" name="display" value="'.$_POST['BMI'].'" disabled class="right" /> (wird automatisch berechnet)
	<input type="hidden" name="BMI" value="'.$_POST['BMI'].'">
  </fieldset>
  <fieldset>
    <legend>PSA-Vorwerte, Datum</legend>
    <label for="PSAVorwerte" class="left">PSA-Vorwerte:</label>
      <input type="text" id="PSAVorwerte" name="PSAVorwerte" value="'.$_POST['PSAVorwerte'].'" /><br />
    <label for="PSAVorDatum" class="left">Datum:</label>
      <input type="text" id="PSAVorDatum" name="PSAVorDatum" value="'.$_POST['PSAVorDatum'].'" />
  </fieldset>
  <fieldset>
    <legend>Biopsie-Ergebnis</legend>
    Wieviele Biopsien zeigen PCa?<br/>
      <input type="checkbox" id="BiopsieErgebnis" name="BiopsieErgebnis" value="1" ';
	  if ($_POST['BiopsieErgebnis']) echo 'checked="checked"';
	  echo' class="right"/>
      <label for="BiopsieErgebnis">Positiv</label>
      <input type="text" name="BiopsieposFund" value="'.$_POST['BiopsieposFund'].'" size="5"/>
      /
      <input type="text" name="BiopsieposGesamt" value="'.$_POST['BiopsieposGesamt'].'" size="5" />
    
    <br/>
      <input type="checkbox" id="PIN" name="PIN" value="1" ';
	  if ($_POST['PIN']) echo 'checked="checked"';
	  echo' class="right" />
      <label for="PIN">PIN</label>
      <input type="text" name="PINFund" value="'.$_POST['PINFund'].'" size="5" />
      /
      <input type="text" name="PINGesamt" value="'.$_POST['PINGesamt'].'" size="5" />
    <br/>
      <input type="checkbox" id="Prostatitis" name="Prostatitis" value="1" ';
	  if ($_POST['Prostatitis']) echo 'checked="checked"';
	  echo' class="right" />
      <label for="Prostatitis">Stärkergradige Prostatitis</label>
    <br/>
    <br/>
    <label for="Gleason" class="left">Gleason:</label>
      <input type="text" id="Gleason" name="Gleason1" value="'.$_POST['Gleason1'].'" size="5"';
if (isset( $_POST['submit'] ) or (!$row==NULL))
if ($_POST['Gleason1']<1 or $_POST['Gleason1'] > 5) echo 'class="wrong" ';

echo'	  />
      +
      <input type="text" id="Gleason" name="Gleason2" value="'.$_POST['Gleason2'].'" size="5"';
if (isset( $_POST['submit'] ) or (!$row==NULL))
	  if ($_POST['Gleason2']<1 or $_POST['Gleason2'] > 5) echo 'class="wrong" ';
echo'	  />
      =';
	  $_POST['Gleason3'] = $_POST['Gleason1'] + $_POST['Gleason2'];
	  echo '
      <input type="text" name="Gleason3" value="'.$_POST['Gleason3'].'" disabled size="5" />
	  <input type="hidden" name="Gleason3" value="'.$_POST['Gleason3'].'">
    <br/>';
if (isset( $_POST['submit'] )or(!$row==NULL))
	if ($_POST['Gleason1']>5 or $_POST['Gleason1']<1 or $_POST['Gleason2']>5 or $_POST['Gleason2']<1) echo '<span class="right wrong">Werte müssen >1 und <=5 sein</span><br />';
	echo'
    <label for="Helpap" class="left">Helpap-Grad:</label>
      <select id="Helpap" name="Helpap" style="width: 60px; background: #ddd;">
        <option> </option>
        <option'; if ($_POST['Helpap']=="G1a") echo" selected";
		echo'> G1a</option>
        <option'; if ($_POST['Helpap']=="G1b") echo" selected";
		echo'> G1b</option>
        <option'; if ($_POST['Helpap']=="G11a") echo" selected";
		echo'> G11a</option>
        <option'; if ($_POST['Helpap']=="G11b") echo" selected";
		echo'> G11b</option>
        <option'; if ($_POST['Helpap']=="G111a") echo" selected";
		echo'> G111a</option>
        <option'; if ($_POST['Helpap']=="G111b") echo" selected";
		echo'> G111b</option>
      </select>
    <br>
    <label for="PIN3" class="left">PIN 3&deg;:</label>
      <select id="PIN3" name="PIN3" style="width: 60px; background: #ddd;">
        <option> </option>
        <option'; if ($_POST['PIN3']=="PIN 1") echo" selected";
		echo'> PIN 1</option>
        <option'; if ($_POST['PIN3']=="PIN 2") echo" selected";
		echo'>PIN 2</option>
        <option'; if ($_POST['PIN3']=="PIN 3") echo" selected";
		echo'>PIN 3</option>
      </select>
    <br>
      <input type="checkbox" id="AAH" name="AAH" value="1" ';
	  if ($_POST['AAH']) echo 'checked="checked"';
	  echo' class="right" />
      <label for="AAH">AAH</label>
    <br/>
      <input type="checkbox" id="Benigne" name="Benigne" value="1" ';
	  if ($_POST['Benigne']) echo 'checked="checked"';
	  echo' class="right" />
      <label for="Benigne">Benigne</label>
    <br/>
    <label for="BenigneKommentar" class="left">Kommentar:</label>
      <textarea id="BenigneKommentar" name="BenigneKommentar">'.$_POST['BenigneKommentar'].'</textarea>
    <br/>
    <label for="In" class="right">In</label>
      <input type="text" id="In" name="In1" value="'.$_POST['In1'].'" size="5" />
      /
      <input type="text" id="In" name="In2" value="'.$_POST['In2'].'" size="5" />
      Stanzen, Details siehe "Befundbericht-Prostatabiopsie"
  </fieldset>
  <fieldset>
    <legend>Empfehlung</legend>
      <input type="checkbox" id="Skelettszintigramm" name="Skelettszintigramm" value="1" ';
	  if ($_POST['Skelettszintigramm']) echo 'checked="checked"';
	  echo'class="right" />
      <label for="Skelettszintigramm">Skelettszintigramm</label>
    <br/>
      <input type="checkbox" id="Besprechung" name="Besprechung" value="1" ';
	  if ($_POST['Besprechung']) echo 'checked="checked"';
	  echo'class="right" />
      <label for="Besprechung">Besprechung der Therapieoptionen, z.B. radikale prostatektonomie, Radiatio, Androgenentzug</label>
    <br/>
      <input type="checkbox" id="ReBiopsie" name="ReBiopsie" value="1" ';
	  if ($_POST['ReBiopsie']) echo 'checked="checked"';
	  echo'class="right" />
      <label for="ReBiopsie">Re-Biopsie in 3-6 Monaten</label>
    <br/>
      <input type="checkbox" id="PSAKontrolle" name="PSAKontrolle" value="1" ';
	  if ($_POST['PSAKontrolle']) echo 'checked="checked"';
	  echo'class="right" />
      <label for="PSAKontrolle">PSA-Kontrolle, ggfs. Re-Biopsie</label>
    <br/>
      <input type="checkbox" id="radikaleProstatektomie" name="radikaleProstatektomie" value="1" ';
	  if ($_POST['radikaleProstatektomie']) echo 'checked="checked"';
	  echo'class="right" />
      <label for="radikaleProstatektomie">radikale Prostatekonomie</label>
    <br/>
    <br/>
      <input type="checkbox" id="Bestrahlung" name="Bestrahlung" value="1" ';
	  if ($_POST['Bestrahlung']) echo 'checked="checked"';
	  echo'class="right" />
      <label for="Bestrahlung">Bestrahlung</label>
    <br/>
      <input type="checkbox" id="extern" name="extern" value="1" ';
	  if ($_POST['extern']) echo 'checked="checked"';
	  echo'class="rightPlus" />
      <label for="extern">extern</label>
    <br/>
      <input type="checkbox" id="HDR" name="HDR" value="1" ';
	  if ($_POST['HDR']) echo 'checked="checked"';
	  echo'class="rightPlus" />
      <label for="HDR">HDR-Brachytherapie möglich</label>
    <br/>
      <input type="checkbox" id="LDR" name="LDR" id="empf1" value="1" ';
	  if ($_POST['LDR']) echo 'checked="checked"';
	  echo'class="rightPlus" />
      <label for="LDR">LDR-Brachytherapie möglich</label></span>
    <br/>
    <br/>
      <input type="checkbox" id="ActiveSurveillance" name="ActiveSurveillance" value="1" ';
	  if ($_POST['ActiveSurveillance']) echo 'checked="checked"';
	  echo'class="right" />
      <label for="ActiveSurveillance">"Active Surveillance"</label>
  </fieldset>
  <br/>
  <div id="savebutton"><div id="boxbutton">
  <input type="button" value="Zurück" name="back_button"
onClick="javascript:history.back(1)">
  <input type="submit" name="submit" value="Formular speichern">
  <input type="submit" name="delete" value="Löschen">

  </form>';

if (!$row==NULL){
echo'<form action="formular.php?'.SID.'" method="post">
</form>';
}
echo '<form action="login.php?'.SID.'" method="post">
</form></div></div>';
// von Matthias
echo'  </div>
  </div>';
  
echo '</body>
</html>';
?>