<?php
error_reporting(E_ALL);


$db = new mysqli('localhost', 'root', '', 'kis');

$sql = "SELECT * FROM `formular` WHERE ID=1";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen1: " . mysql_error());

$row = $result->fetch_object();

// Daten nicht vom Benutzer eingegeben, also aus Datenbank laden:
if ( (!isset( $_POST['submit'] )) && (!$row==null) ) {
	$_POST['Name'] = $row->Name;
	$_POST['Vorname'] = $row->Vorname;
	$_POST['Geburtsdatum'] = $row->Geburtsdatum;
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
} else {
// Benutzer hat Formular abgeschickt, aber leere Checkboxen sind nicht gleich 0!
if (!isset( $_POST['Praetherapeutisch'] )) $_POST['Praetherapeutisch'] = 0;
if (!isset( $_POST['BiopsieErgebnis'] )) $_POST['BiopsieErgebnis'] = 0;
if (!isset( $_POST['PIN'] )) $_POST['PIN'] = 0;
if (!isset( $_POST['Prostatitis'] )) $_POST['Prostatitis'] = 0;
if (!isset( $_POST['AAH'] )) $_POST['AAH'] = 0;
if (!isset( $_POST['Benigne'] )) $_POST['Benigne'] = 0;
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

echo'<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KIS Fiktiv</title>
</head>
<body>';
echo'<form action="formular.php" method="post">
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
      ng/ml (Beckman-Coulter Access Referenzbereich < 3,2), </label>
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
      <input type="radio" name="DigitalePalpation" value="1" />
      normal</label>
    <label>
      <input type="radio" name="DigitalePalpation" value="2" />
      dubios</label>
    <label>
      <input type="radio" name="DigitalePalpation" value="3" />
      suspekt</label>
    <label>
      <input type="radio" name="DigitalePalpation" value="4" />
      V.a. Organüberschreitung, Lokalisation:</label>
    <textarea name="DigPalKommentar">'.$_POST['DigPalKommentar'].'</textarea>
  </fieldset>
  <fieldset>
    <legend>Transrektaler Ultraschall</legend>
    <label>
      <input type="radio" name="TransrektalerUltraschall" value="1" />
      normal</label>
    <label>
      <input type="radio" name="TransrektalerUltraschall" value="2" />
      dubios</label>
    <label>
      <input type="radio" name="TransrektalerUltraschall" value="3" />
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
    <input type="text" name="BMI" value="'.$_POST['BMI'].'" disabled /> (wird automatisch berechnet)
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
    </label>
    <br/>
    <label>Helpap-Grad:
      <select name="Helpap">
        <option> </option>
        <option> G1a</option>
        <option> G1b</option>
        <option> G11a</option>
        <option> G11b</option>
        <option> G111a</option>
        <option> G111b</option>
      </select>
    </label>
    <br>
    <label>PIN 3&deg;:
      <select name="PIN3">
        <option> </option>
        <option> PIN 1</option>
        <option>PIN 2</option>
        <option>PIN 3</option>
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
</body>
</html>';