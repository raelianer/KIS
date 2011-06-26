<?php

// Funkion anzeigen() zeigt die eigentliche Dokumentation an

	function anzeigen(){
	echo '<fieldset>
	        <legend>Beschreibung </legend>

		<b>Installation:</b><br>
		Die <a href="http://www.kis-fiktiv.de.ms/quellcode.zip">Quellcodedateien</a> werden auf einen PHP- und datenbankf�higen Server kopiert, z.B. auf  
		<a href="http://www.bplaced.net/">http://www.bplaced.net/</a>. Die Datenbank wird erstellt indem die Datei gen.php
		auf dem Server ausgef�hrt wird. Dazu muss der Hostname, Benutzername, Passwort, Name der eigenen Datenbank vorher in 
		die Datei config.php eingetragen werden.<br><br>
		
		<b>Rollen und Rechtesystem:</b><br>
		Der Benutzer kann sich unter 3 verschiedenen Rollen in das System einw�hlen. Chefarzt, Arzthelfer, Admin.
		Je nach Rolle hat er dann ein Lese- und / oder Schreibrecht f�r das Formular.<br><br>

		<b>Funktionalit�t:</b><br>
		Ein Patient wird ausgew�hlt, dann wird auf  "weiter" geklickt. Es wird ein leeres Formular erstellt, falls noch kein Formular 			gespeichert ist. Andernfalls wird das Formular des Patienten angezeigt. Das Formular kann dann ge�ndert oder gel�scht 				werden.<br><br>

		<b>Plausibilit�t der Eingaben:</b><br>
		Bei Einigen Feldern im Formular ist die Eingabe nur mit bestimmten Datentypen und Werten m�glich:<br>
		<div id="tab">
		- Der PSA-Wert muss kleiner als 3,2 sein <br>
		- IPSS liegt zwischen 0 und 35 <br>
		- 1. und 2. Gleasonfeld muss Werte zwischen 1 und 5 haben <br><br>
		</div>
	      </fieldset>';		
	}


// Session starten

	session_start();



// Grafische Oberfl�sche reinladen

  	include 'head2.html';
    		echo '<li><a href=\'login.php?PHPSESSID='.session_id().'\'>Home</a></li>';
    		echo '<li><a href=\'logout.php?PHPSESSID='.session_id().'\'>Logout</a></li>';
		echo '<li><a href=\'doku.php?PHPSESSID='.session_id().'\'>Dokumentation</a></li>';


    	echo '</ul>';
  	echo '</div>';
	echo '</div>';
	  echo '<div id="content">';
	   echo '<div id="label">';
   	   echo '<div id="box">';

// Ab hier f�ngt der Inhalt des Dokuments an

		if ($_SESSION['permission']){
			anzeigen();

		}
		else
		{
			echo '<fieldset>';
			echo 'Falscher Benutzername und/oder Passwort !<br><br>';
 	        	echo '<a href=\'index.html\'>Hier wieder einloggen</a>';
			echo '</fieldset><br>';
		}


    echo'</div>';

// Den unteren Teil des Dokuments reinladen

  include 'bottom.html';
?>