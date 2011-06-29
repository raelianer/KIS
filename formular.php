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


$db = new mysqli(HOST, USER, PASS, DB);

	// FormularID retten:
	if ( (isset($_POST['patientid']))) {
		echo"PatientenID retten: ".$_POST['patientid'];
	$_SESSION['PatientID'] = $_POST['patientid'];
	}
	
	// Formular löschen
if ( (isset($_POST['delete'])) ) {
	$sql = "DELETE FROM `kis`.`formular` WHERE `formular`.`ID` = 3";
	$result = $db->query($sql)
or die("Anfrage fehlgeschlagen1: " . mysql_error());
echo "Formular gelöscht!";
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
	echo"Neues Formular anlegen";
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
if (isset( $_POST['submit'] )){
	// Falls kein Datenbankeintrag für das Formular vorhanden -> neuen Datensatz anlegen!
	if ($row==NULL) {
	$sql = "INSERT INTO `".DB."`.`formular` (`ID`, `Praetherapeutisch`, `PSA`, `DatumPSA`, `FreiesPSA`, `Prostatavolumen`, `Uebergangszone`, `DigitalePalpation`, `DigPalKommentar`, `TransrektalerUltraschall`, `TransUltraKommentar`, `IPSS`, `Koerpergewicht`, `Koerperlaenge`, `BMI`, `PSAVorwerte`, `PSAVorDatum`, `BiopsieErgebnis`, `BiopsieposFund`, `BiopsieposGesamt`, `PIN`, `PINFund`, `PINGesamt`, `Prostatitis`, `Gleason1`, `Gleason2`, `Gleason3`, `Helpap`, `PIN3`, `AAH`, `Benigne`, `BenigneKommentar`, `In1`, `In2`, `Skelettszintigramm`, `Besprechung`, `ReBiopsie`, `PSAKontrolle`, `radikaleProstatektomie`, `Bestrahlung`, `extern`, `HDR`, `LDR`, `ActiveSurveillance`) VALUES ('".$_SESSION['PatientID']."', '".$_POST['Praetherapeutisch']."', '".$_POST['PSA']."', '".$_POST['DatumPSA']."', '".$_POST['FreiesPSA']."', '".$_POST['Prostatavolumen']."', '".$_POST['Uebergangszone']."', '".$_POST['DigitalePalpation']."', '".$_POST['DigPalKommentar']."', '".$_POST['TransrektalerUltraschall']."', '".$_POST['TransUltraKommentar']."', '".$_POST['IPSS']."', '".$_POST['Koerpergewicht']."', '".$_POST['Koerperlaenge']."', '".$_POST['BMI']."', '".$_POST['PSAVorwerte']."', '".$_POST['PSAVorDatum']."', '".$_POST['BiopsieErgebnis']."', '".$_POST['BiopsieposFund']."', '".$_POST['BiopsieposGesamt']."', '".$_POST['PIN']."', '".$_POST['PINFund']."', '".$_POST['PINGesamt']."', '".$_POST['Prostatitis']."', '".$_POST['Gleason1']."', '".$_POST['Gleason2']."', '".$_POST['Gleason3']."', '".$_POST['Helpap']."', '".$_POST['PIN3']."', '".$_POST['AAH']."', '".$_POST['Benigne']."', '".$_POST['BenigneKommentar']."', '".$_POST['In1']."', '".$_POST['In2']."', '".$_POST['Skelettszintigramm']."', '".$_POST['Besprechung']."', '".$_POST['ReBiopsie']."', '".$_POST['PSAKontrolle']."', '".$_POST['radikaleProstatektomie']."', '".$_POST['Bestrahlung']."', '".$_POST['extern']."', '".$_POST['HDR']."', '".$_POST['LDR']."', '".$_POST['ActiveSurveillance']."');";
	$sql2 = "UPDATE patient SET formularid = '".$stammdaten->patientid."' WHERE patientid = '".$_SESSION['PatientID']."';";
	$result2 = $db->query($sql2);
	} else {
	// Falls Formular bereits vorhanden -> Datensatz ändern!
	$sql = "UPDATE `".DB."`.`formular` SET `Praetherapeutisch` = '".$_POST['Praetherapeutisch']."', `PSA` = '".$_POST['PSA']."', `DatumPSA` = '".$_POST['DatumPSA']."', `FreiesPSA` = '".$_POST['FreiesPSA']."', `Prostatavolumen` = '".$_POST['Prostatavolumen']."', `Uebergangszone` = '".$_POST['Uebergangszone']."', `DigitalePalpation` = '".$_POST['DigitalePalpation']."', `DigPalKommentar` = '".$_POST['DigPalKommentar']."', `TransrektalerUltraschall` = '".$_POST['TransrektalerUltraschall']."', `TransUltraKommentar` = '".$_POST['TransUltraKommentar']."', `IPSS` = '".$_POST['IPSS']."', `Koerpergewicht` = '".$_POST['Koerpergewicht']."', `Koerperlaenge` = '".$_POST['Koerperlaenge']."', `BMI` = '".$_POST['BMI']."', `PSAVorwerte` = '".$_POST['PSAVorwerte']."', `PSAVorDatum` = '".$_POST['PSAVorDatum']."', `BiopsieErgebnis` = '".$_POST['BiopsieErgebnis']."', `BiopsieposFund` = '".$_POST['BiopsieposFund']."', `BiopsieposGesamt` = '".$_POST['BiopsieposGesamt']."', `PIN` = '".$_POST['PIN']."', `PINFund` = '".$_POST['PINFund']."', `PINGesamt` = '".$_POST['PINGesamt']."', `Prostatitis` = '".$_POST['Prostatitis']."', `Gleason1` = '".$_POST['Gleason1']."', `Gleason2` = '".$_POST['Gleason2']."', `Gleason3` = '".$_POST['Gleason3']."', `Helpap` = '".$_POST['Helpap']."', `PIN3` = '".$_POST['PIN3']."', `AAH` = '".$_POST['AAH']."', `Benigne` = '".$_POST['Benigne']."', `BenigneKommentar` = '".$_POST['BenigneKommentar']."', `In1` = '".$_POST['In1']."', `In2` = '".$_POST['In2']."', `Skelettszintigramm` = '".$_POST['Skelettszintigramm']."', `Besprechung` = '".$_POST['Besprechung']."', `ReBiopsie` = '".$_POST['ReBiopsie']."', `PSAKontrolle` = '".$_POST['PSAKontrolle']."', `radikaleProstatektomie` = '".$_POST['radikaleProstatektomie']."', `Bestrahlung` = '".$_POST['Bestrahlung']."', `extern` = '".$_POST['extern']."', `HDR` = '".$_POST['HDR']."', `LDR` = '".$_POST['LDR']."', `ActiveSurveillance` = '".$_POST['ActiveSurveillance']."' WHERE ID = '".$_SESSION['PatientID']."';";
	}
	echo$sql;
	$result = $db->query($sql)
or die("Speichern fehlgeschlagen: " . mysql_error());
}


echo'<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KIS Fiktiv</title>
</head>
<body>';

echo'<form action="formular.php?'.SID.'" method="post">
  <fieldset>
    <legend>Patientendaten</legend>
    <label>Name:
      <input type="text" name="Name" value="'.$_POST['Name'].'" />
    </label>
    <label>Vorname:
      <input type="text" name="Vorname" value="'.$_POST['Vorname'].'" />
    </label>
    <label>Geburtsdatum:
      <input type="date" name="Geburtsdatum" value="'.$_POST['Geburtsdatum'].'" />
    </label>
  </fieldset>
  <fieldset>
    <legend>Biopsie</legend>
    <label>
      <input type="checkbox" name="Praetherapeutisch" value="1" ';
	  if ($_POST['Praetherapeutisch']) echo 'checked="checked"';
	  echo' />
      Prätherapeutisch</label>
    <br />
    <label>PSA:
      <input type="text" name="PSA" value="'.$_POST['PSA'].'" />
      ng/ml (Beckman-Coulter Access Referenzbereich < 3,2), </label>';
	  if ($_POST['PSA'] >= 3.2) echo "PSA zu hoch!";
	  if ($_POST['PSA'] < 0) echo "PSA muss positiv sein!";
	  echo'
    <label>Datum:
      <input type="date" name="DatumPSA" value="'.$_POST['DatumPSA'].'" />
    </label>
    <br/>
    <label>Freies PSA:
      <input type="text" name="FreiesPSA" value="'.$_POST['FreiesPSA'].'" />
      ng/ml, Quotient frei/gesamt - PSA</label>
    <br/>
    <label>Prostatavolumen gesamte Prostata:
      <input type="text" name="Prostatavolumen" value="'.$_POST['Prostatavolumen'].'" />
      ccm, </label>
    <label>Übergangszone:
      <input type="text" name="Uebergangszone" value="'.$_POST['Uebergangszone'].'" />
      cmm</label>
  </fieldset>
  <fieldset>
    <legend>Digitale Palpation</legend>
    <label>
      <input type="radio" name="DigitalePalpation" value="normal" ';
	  if ($_POST['DigitalePalpation']=='normal') echo 'checked="checked" ';
	  echo '/>
      normal</label>
    <label>
      <input type="radio" name="DigitalePalpation" value="dubios" ';
	  if ($_POST['DigitalePalpation']=='dubios') echo 'checked="checked" ';
	  echo '/>
      dubios</label>
    <label>
      <input type="radio" name="DigitalePalpation" value="suspekt" ';
	  if ($_POST['DigitalePalpation']=='suspekt') echo 'checked="checked" ';
	  echo '/>
      suspekt</label>
    <label>
      <input type="radio" name="DigitalePalpation" value="VA" ';
	  if ($_POST['DigitalePalpation']=='VA') echo 'checked="checked" ';
	  echo '/>
      V.a. Organüberschreitung, Lokalisation:</label>
    <textarea name="DigPalKommentar">'.$_POST['DigPalKommentar'].'</textarea>
  </fieldset>
  <fieldset>
    <legend>Transrektaler Ultraschall</legend>
    <label>
      <input type="radio" name="TransrektalerUltraschall" value="normal" ';
	  if ($_POST['TransrektalerUltraschall']=='normal') echo 'checked="checked" ';
	  echo '/>
      normal</label>
    <label>
      <input type="radio" name="TransrektalerUltraschall" value="dubios" ';
	  if ($_POST['TransrektalerUltraschall']=='dubios') echo 'checked="checked" ';
	  echo '/>
      dubios</label>
    <label>
      <input type="radio" name="TransrektalerUltraschall" value="suspekt" ';
	  if ($_POST['TransrektalerUltraschall']=='suspekt') echo 'checked="checked" ';
	  echo '/>
      suspekt, </label>
    <label>Lokalisation:
      <textarea name="TransUltraKommentar">'.$_POST['TransUltraKommentar'].'</textarea>
    </label>
    <label>International Prostate Syndrom Score:
      <input type="text" name="IPSS" value="'.$_POST['IPSS'].'" />
      (0-35)</label>
    <br/>
    <label>Körpergewicht:
      <input type="text" name="Koerpergewicht" value="'.$_POST['Koerpergewicht'].'" />
      kg, </label>
    <label>Körperlänge:
      <input type="text" name="Koerperlaenge" value="'.$_POST['Koerperlaenge'].'" />
      cm</label>
  </fieldset>
  <fieldset>
    <legend>Body-Mass-Index</legend>';
	$_POST['BMI'] = round($_POST['Koerpergewicht'] / ($_POST['Koerperlaenge']/100 * $_POST['Koerperlaenge']/100));
	echo '
    <input type="text" name="display" value="'.$_POST['BMI'].'" disabled /> (wird automatisch berechnet)
	<input type="hidden" name="BMI" value="'.$_POST['BMI'].'">
  </fieldset>
  <fieldset>
    <legend>PSA-Vorwerte, Datum</legend>
    <label>PSA-Vorwerte:
      <input type="text" name="PSAVorwerte" value="'.$_POST['PSAVorwerte'].'" />
    </label>
    <label>Datum:
      <input type="text" name="PSAVorDatum" value="'.$_POST['PSAVorDatum'].'" />
    </label>
  </fieldset>
  <fieldset>
    <legend>Biopsie-Ergebnis</legend>
    Wieviele Biopsien zeigen PCa?<br/>
    <label>
      <input type="checkbox" name="BiopsieErgebnis" value="1" ';
	  if ($_POST['BiopsieErgebnis']) echo 'checked="checked"';
	  echo' />
      Positiv
      <input type="text" name="BiopsieposFund" value="'.$_POST['BiopsieposFund'].'" />
      /
      <input type="text" name="BiopsieposGesamt" value="'.$_POST['BiopsieposGesamt'].'" />
    </label>
    <br/>
    <label>
      <input type="checkbox" name="PIN" value="1" ';
	  if ($_POST['PIN']) echo 'checked="checked"';
	  echo' />
      PIN
      <input type="text" name="PINFund" value="'.$_POST['PINFund'].'" />
      /
      <input type="text" name="PINGesamt" value="'.$_POST['PINGesamt'].'" />
    </label>
    <br/>
    <label>
      <input type="checkbox" name="Prostatitis" value="1" ';
	  if ($_POST['Prostatitis']) echo 'checked="checked"';
	  echo' />
      Stärkergradige Prostatitis</label>
    <br/>
    <br/>
    <label>Gleason:
      <input type="text" name="Gleason1" value="'.$_POST['Gleason1'].'" />
      +
      <input type="text" name="Gleason2" value="'.$_POST['Gleason2'].'" />
      =';
	  $_POST['Gleason3'] = $_POST['Gleason1'] + $_POST['Gleason2'];
	  echo '
      <input type="text" name="Gleason3" value="'.$_POST['Gleason3'].'" disabled />
	  <input type="hidden" name="Gleason3" value="'.$_POST['Gleason3'].'">
    </label>
    <br/>
    <label>Helpap-Grad:
      <select name="Helpap">
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
    </label>
    <br>
    <label>PIN 3&deg;:
      <select name="PIN3">
        <option> </option>
        <option'; if ($_POST['PIN3']=="PIN 1") echo" selected";
		echo'> PIN 1</option>
        <option'; if ($_POST['PIN3']=="PIN 2") echo" selected";
		echo'>PIN 2</option>
        <option'; if ($_POST['PIN3']=="PIN 3") echo" selected";
		echo'>PIN 3</option>
      </select>
    </label>
    <br>
    <label>
      <input type="checkbox" name="AAH" value="1" ';
	  if ($_POST['AAH']) echo 'checked="checked"';
	  echo' />
      AAH</label>
    <br/>
    <label>
      <input type="checkbox" name="Benigne" value="1" ';
	  if ($_POST['Benigne']) echo 'checked="checked"';
	  echo' />
      Benigne</label>
    <br/>
    <label>Kommentar:
      <textarea name="BenigneKommentar">'.$_POST['BenigneKommentar'].'</textarea>
    </label>
    <br/>
    <label>In
      <input type="text" name="In1" value="'.$_POST['In1'].'" />
      /
      <input type="text" name="In2" value="'.$_POST['In2'].'" />
      Stanzen, Details siehe "Befundbericht-Prostatabiopsie"</label>
  </fieldset>
  <fieldset>
    <legend>Empfehlung</legend>
    <label>
      <input type="checkbox" name="Skelettszintigramm" value="1" ';
	  if ($_POST['Skelettszintigramm']) echo 'checked="checked"';
	  echo' />
      Skelettszintigramm</label>
    <br/>
    <label>
      <input type="checkbox" name="Besprechung" value="1" ';
	  if ($_POST['Besprechung']) echo 'checked="checked"';
	  echo' />
      Besprechung der Therapieoptionen, z.B. radikale prostatektonomie, Radiatio, Androgenentzug</label>
    <br/>
    <label>
      <input type="checkbox" name="ReBiopsie" value="1" ';
	  if ($_POST['ReBiopsie']) echo 'checked="checked"';
	  echo' />
      Re-Biopsie in 3-6 Monaten</label>
    <br/>
    <label>
      <input type="checkbox" name="PSAKontrolle" value="1" ';
	  if ($_POST['PSAKontrolle']) echo 'checked="checked"';
	  echo' />
      PSA-Kontrolle, ggfs. Re-Biopsie</label>
    <br/>
    <label>
      <input type="checkbox" name="radikaleProstatektomie" value="1" ';
	  if ($_POST['radikaleProstatektomie']) echo 'checked="checked"';
	  echo' />
      radikale Prostatekonomie</label>
    <br/>
    <br/>
    <label>
      <input type="checkbox" name="Bestrahlung" value="1" ';
	  if ($_POST['Bestrahlung']) echo 'checked="checked"';
	  echo' />
      Bestrahlung</label>
    <br/>
    <label>
      <input type="checkbox" name="extern" value="1" ';
	  if ($_POST['extern']) echo 'checked="checked"';
	  echo' />
      extern</label>
    <br/>
    <label>
      <input type="checkbox" name="HDR" value="1" ';
	  if ($_POST['HDR']) echo 'checked="checked"';
	  echo' />
      HDR-Brachytherapie möglich</label>
    <br/>
    <label>
      <input type="checkbox" name="LDR" id="empf1" value="1" ';
	  if ($_POST['LDR']) echo 'checked="checked"';
	  echo' />
      LDR-Brachytherapie möglich</label>
    <br/>
    <br/>
    <label>
      <input type="checkbox" name="ActiveSurveillance" value="1" ';
	  if ($_POST['ActiveSurveillance']) echo 'checked="checked"';
	  echo' />
      "Active Surveillance"</label>
  </fieldset>
  <br/>
  <input type="button" value="Zurück" name="goback">
  <input type="submit" name="submit" value="Formular speichern" />
</form>
<form action="login.php?'.SID.'" method="post">
<input type="submit" name="zurück" value="Zurück"></form>
<form action="formular.php?'.SID.'" method="post">
<input type="submit" name="delete" value="Löschen"></form>
</body>
</html>';
?>