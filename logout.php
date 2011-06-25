<?php
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
// Die Erlaubnis wird auf Falsch gesetzt, die Session beendet und das Sessionobjekt zerstört

	   $_SESSION['permission']=false;	  
	   session_unset();
	   session_destroy();
	           echo '<fieldset>';
		   echo 'Sie sind nicht eingeloggt!<br><br>';
		   echo '<a href=\'index.html\'>Hier wieder einloggen</a>';
      	           echo '</fieldset>';
	  


    echo'</div>';

// Den unteren Teil des Dokuments reinladen

  include 'bottom.html';
?>