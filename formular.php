<?php
error_reporting(E_ALL);
$db = new mysqli('localhost', 'root', '');

$sql = "SELECT * FROM `kis`.`formular` WHERE ID=1";
$result = $db->query($sql)
or die("Anfrage fehlgeschlagen1: " . mysql_error());

$row = $result->fetch_object();

echo'<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KIS Fiktiv</title>
</head>
<body>';
echo'<form action="speichern.php" method="post">
  <fieldset>
    <legend>Patientendaten</legend>
    <label>Name:
      <input type="text" name="Name" value="'.$row->Name.'" />
    </label>
    <label>Vorname:
      <input type="text" name="Vorname" value="'.$row->Vorname.'" />
    </label>
    <label>Geburtsdatum:
      <input type="date" name="Geburtsdatum" value="'.$row->Geburtsdatum.'" />
    </label>
  </fieldset>
  <fieldset>
    <legend>Biopsie</legend>
    <label>
      <input type="checkbox" name="Praetherapeutisch" value="1" ';
	  if ($row->Praetherapeutisch) echo 'checked="checked"';
	  echo' />
      Prätherapeutisch</label>
    <br />
    <label>PSA:
      <input type="text" name="PSA" value="'.$row->PSA.'" />
      ng/ml (Beckman-Coulter Access Referenzbereich < 3,2), </label>
    <label>Datum:
      <input type="date" name="DatumPSA" value="'.$row->DatumPSA.'" />
    </label>
    <br/>
    <label>Freies PSA:
      <input type="text" name="FreiesPSA" value="'.$row->FreiesPSA.'" />
      ng/ml, Quotient frei/gesamt - PSA</label>
    <br/>
    <label>Prostatavolumen gesamte Prostata:
      <input type="text" name="Prostatavolumen" value="'.$row->Prostatavolumen.'" />
      ccm, </label>
    <label>Übergangszone:
      <input type="text" name="Uebergangszone" value="'.$row->Uebergangszone.'" />
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
    <textarea name="DigPalKommentar">'.$row->DigPalKommentar.'</textarea>
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
      <textarea name="TransUltraKommentar">'.$row->TransUltraKommentar.'</textarea>
    </label>
    <label>International Prostate Syndrom Score:
      <input type="text" name="IPSS" value="'.$row->IPSS.'" />
      (0-35)</label>
    <br/>
    <label>Körpergewicht:
      <input type="text" name="Koerpergewicht" value="'.$row->Koerpergewicht.'" />
      kg, </label>
    <label>Körperlänge:
      <input type="text" name="Koerperlaenge" value="'.$row->Koerperlaenge.'" />
      cm</label>
  </fieldset>
  <fieldset>
    <legend>Body-Mass-Index</legend>
    <input type="text" name="BMI" value="'.$row->BMI.'" disabled /> (wird automatisch berechnet)
  </fieldset>
  <fieldset>
    <legend>PSA-Vorwerte, Datum</legend>
    <label>PSA-Vorwerte:
      <input type="text" name="PSAVorwerte" value="'.$row->PSAVorwerte.'" />
    </label>
    <label>Datum:
      <input type="text" name="PSAVorDatum" value="'.$row->PSAVorDatum.'" />
    </label>
  </fieldset>
  <fieldset>
    <legend>Biopsie-Ergebnis</legend>
    Wieviele Biopsien zeigen PCa?<br/>
    <label>
      <input type="checkbox" name="BiopsieErgebnis" value="1" ';
	  if ($row->BiopsieErgebnis) echo 'checked="checked"';
	  echo' />
      Positiv
      <input type="text" name="BiopsieposFund" value="'.$row->BiopsieposFund.'" />
      /
      <input type="text" name="BiopsieposGesamt" value="'.$row->BiopsieposGesamt.'" />
    </label>
    <br/>
    <label>
      <input type="checkbox" name="PIN" value="1" ';
	  if ($row->PIN) echo 'checked="checked"';
	  echo' />
      PIN
      <input type="text" name="PINFund" value="'.$row->PINFund.'" />
      /
      <input type="text" name="PINGesamt" value="'.$row->PINGesamt.'" />
    </label>
    <br/>
    <label>
      <input type="checkbox" name="Prostatitis" value="1" ';
	  if ($row->Prostatitis) echo 'checked="checked"';
	  echo' />
      Stärkergradige Prostatitis</label>
    <br/>
    <br/>
    <label>Gleason:
      <input type="text" name="Gleason1" value="'.$row->Gleason1.'" />
      +
      <input type="text" name="Gleason2" value="'.$row->Gleason2.'" />
      =
      <input type="text" name="Gleason3" value="'.$row->Gleason3.'" disabled />
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
	  if ($row->AAH) echo 'checked="checked"';
	  echo' />
      AAH</label>
    <br/>
    <label>
      <input type="checkbox" name="Benigne" value="1" ';
	  if ($row->Benigne) echo 'checked="checked"';
	  echo' />
      Benigne</label>
    <br/>
    <label>Kommentar:
      <textarea name="BenigneKommentar">'.$row->BenigneKommentar.'</textarea>
    </label>
    <br/>
    <label>In
      <input type="text" name="In1" value="'.$row->In1.'" />
      /
      <input type="text" name="In2" value="'.$row->In2.'" />
      Stanzen, Details siehe "Befundbericht-Prostatabiopsie"</label>
  </fieldset>
  <fieldset>
    <legend>Empfehlung</legend>
    <label>
      <input type="checkbox" name="Skelettszintigramm" value="1" ';
	  if ($row->Skelettszintigramm) echo 'checked="checked"';
	  echo' />
      Skelettszintigramm</label>
    <br/>
    <label>
      <input type="checkbox" name="Besprechung" value="1" ';
	  if ($row->Besprechung) echo 'checked="checked"';
	  echo' />
      Besprechung der Therapieoptionen, z.B. radikale prostatektonomie, Radiatio, Androgenentzug</label>
    <br/>
    <label>
      <input type="checkbox" name="ReBiopsie" value="1" ';
	  if ($row->ReBiopsie) echo 'checked="checked"';
	  echo' />
      Re-Biopsie in 3-6 Monaten</label>
    <br/>
    <label>
      <input type="checkbox" name="PSAKontrolle" value="1" ';
	  if ($row->PSAKontrolle) echo 'checked="checked"';
	  echo' />
      PSA-Kontrolle, ggfs. Re-Biopsie</label>
    <br/>
    <label>
      <input type="checkbox" name="radikaleProstatektomie" value="1" ';
	  if ($row->radikaleProstatektomie) echo 'checked="checked"';
	  echo' />
      radikale Prostatekonomie</label>
    <br/>
    <br/>
    <label>
      <input type="checkbox" name="Bestrahlung" value="1" ';
	  if ($row->Bestrahlung) echo 'checked="checked"';
	  echo' />
      Bestrahlung</label>
    <br/>
    <label>
      <input type="checkbox" name="extern" value="1" ';
	  if ($row->extern) echo 'checked="checked"';
	  echo' />
      extern</label>
    <br/>
    <label>
      <input type="checkbox" name="HDR" value="1" ';
	  if ($row->HDR) echo 'checked="checked"';
	  echo' />
      HDR-Brachytherapie möglich</label>
    <br/>
    <label>
      <input type="checkbox" name="LDR" id="empf1" value="1" ';
	  if ($row->LDR) echo 'checked="checked"';
	  echo' />
      LDR-Brachytherapie möglich</label>
    <br/>
    <br/>
    <label>
      <input type="checkbox" name="ActiveSurveillance" value="1" ';
	  if ($row->ActiveSurveillance) echo 'checked="checked"';
	  echo' />
      "Active Surveillance"</label>
  </fieldset>
  <br/>
  <input type="button" value="Zurück" name="goback">
  <input type="submit" name="speichern" value="Formular speichern" />
</form>
</body>
</html>';