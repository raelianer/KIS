<?php

// Einbinden der Zugriffsdaten für die Datenbank und erstellen eines Datenbankobjekts

	include 'config.php';
	$db = new mysqli(HOST, USER, PASS, DB);
	
/* Funktion anzeigenFormular zeigt die Patienten und ob für Patient ein Formular gepeichert ist
   Wird aufgerufen wenn der Benutzer eingeloggt ist */

      function anzeigenFormular(){
	$db = new mysqli(HOST, USER, PASS, DB);
	echo '<form action="formular.php?PHPSESSID="'.session_id().' method="post">';
	echo '<fieldset>';
        echo '<legend>Patienten- und Formularauswahl</legend>';
	$sql2 = 'SELECT *
	FROM
    	patient';
	$result = $db->query($sql2);
             echo '<select name="formular" size="20" style="width: 550px">';
		while ($row = $result->fetch_assoc()){
		     echo '<option value="'.$row['patientid'].'">'.'ID: '.$row['patientid'].' '.$row['firstname'].' '.$row['lastname'];

			  if ($row['formularid']) echo ' - Formular prätherapeutische Prostatakonferenz gespeichert';
			else 
			  echo ' - Es exisistiert bisher kein gespeichertes Formular';


		     echo '</option>';
		}
  	      
  	      
             echo '</select>';
          echo '<br><br>';
	  Formularauswahl:
	 echo '<input type="submit" name="formaction" value="Weiter" />';
         echo '</fieldset>';
	echo '</form>';
	}



// Eine Session wird gestartet

	session_start();

// Das Design, inklusive Menü wird geladen

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

// Ab hier fängt der eigentliche Inhalt des Dokuments an

	echo '<fieldset>';
	echo '<legend>Status: </legend>';
	if (!isset($_SESSION['permission'])||$_SESSION['permission']==false){
	$_SESSION['user']=$_POST['user'];
	$_SESSION['password']=$_POST['password'];
	}

// Datensatz wird aus der Datenbank geladen bei dem der Benutzername und Passwort welche eingegeben wurden mit denen der Datenbank übereinstimmen

	$sql = 'SELECT * FROM users INNER JOIN rollen ON users.rollenid = rollen.id WHERE username=\''.$_SESSION['user'].'\' AND password=\''.$_SESSION['password'].'\';';
	$result = $db->query($sql);
	$userfound = false;

/* Wenn sich ein Datensatz in $result befindet dann hat sich der User mit dem richtigem Benutzernamen und Passwort eingewählt,
  was mit der folgenden if-Abfrage geprüft wird. */

	if ($row = $result->fetch_assoc()){
		$userfound = true;
	}


// Wenn der Benutzer gefunden wurde wird die Seite geladen, andernfalls wird ausgegeben: Falscher Benutzername und/oder Passwort !

	if ($userfound){
 	        echo '<div id="foto"><img src="fotos/foto'.$row['userid'].'.jpg" alt="foto" width="110" height="140"></div>';
		$_SESSION['permission'] = true;
		$_SESSION['reading'] = $row['read'];
		$_SESSION['writing'] = $row['write'];
		echo 'Rolle: '.$row['position'].'<br>';
		echo 'Vorname: '.$row['firstname'].'<br>';
		echo 'Nachname: '.$row['lastname'].'<br>';
		echo 'Leserecht: ';
		if ($row['read']) echo 'Ja'.'<br>'; else echo 'Nein'.'<br>';
		echo 'Bearbeitungsrecht: ';
		if ($row['write']) echo 'Ja'.'<br>'; else echo 'Nein'.'<br>';
  	        echo '</fieldset><br>';
		
		anzeigenFormular();
	}

	else

	{
		$_SESSION['permission'] = false;
		echo 'Falscher Benutzername und/oder Passwort !<br><br>';
 	        echo '<a href=\'index.html\'>Hier wieder einloggen</a>';
		echo '</fieldset><br>';
	}

    echo'</div>';

// Das Dokumentenende wird reingeladen

  include 'bottom.html';
?>