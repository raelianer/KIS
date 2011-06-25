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



    echo'</div>';

// Den unteren Teil des Dokuments reinladen

  include 'bottom.html';
?>