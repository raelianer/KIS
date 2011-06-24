<?php
	include 'config.php';

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

	session_start();
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
	echo '<fieldset>';
	echo '<legend>Status: </legend>';
	if (isset($_SESSION['permission'])&$_SESSION['permission'] == false){
	$_SESSION['user']=$_POST['user'];
	$_SESSION['password']=$_POST['password'];
	}

	$db = new mysqli(HOST, USER, PASS, DB);
	$sql = 'SELECT * FROM users INNER JOIN rollen ON users.rollenid = rollen.id WHERE username=\''.$_SESSION['user'].'\' AND password=\''.$_SESSION['password'].'\';';
	$result = $db->query($sql);
	$userfound = false;
	if ($row = $result->fetch_assoc()){
		$userfound = true;
	}
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
		echo 'Falscher Benutzername und/oder Passwort !<br>';
 	        echo '<a href=\'index.html\'>Hier wieder einloggen</a>';
		echo '</fieldset><br>';
	}

    echo'</div>';
  include 'bottom.html';
?>