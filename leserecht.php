<?php

// Funkion anzeigen() zeigt die eigentliche Dokumentation an

	function anzeigen(){
	echo '
	        <legend>Hinweis </legend>
		Sie haben kein Leserecht bzw. Schreibrecht!
	      ';		
	}


// Session starten

	session_start();



// Grafische Oberfläsche reinladen

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

// Ab hier fängt der Inhalt des Dokuments an

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