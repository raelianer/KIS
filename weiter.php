<?php
	function anzeigen(){
	$db = new mysqli(HOST, USER, PASS, DB);
	$sql = 'SELECT *
	FROM
    	patient where patientid='.$_SESSION['auswahl'];
	$result = $db->query($sql);
	$row = $result->fetch_assoc();



   if ($row['formularid']==false){
     if($_SESSION['writing']){
		echo '<form action="speichern.php?PHPSESSID='.session_id().'" method="post">';
		echo '<div id="headline">Protokoll prätherapeutische Prostatakonferenz</div>';
	   echo '<fieldset>';
       	 	echo '<legend>Patientendaten</legend>';
       	  echo '<div id="box1">';
	   echo '<table>';
  		echo '<tr>';
 		   echo '<td><label for="name">Name: </label></td>';
 		   echo '<td><input type="text" name="name" id="name" value="'.$row['lastname'].'" /></td>';
 		 echo '</tr>';
 		 echo '<tr>';
 		   echo '<td><label for="vorname">Vorname: </label></td>';
 		   echo '<td><input type="text" name="vorname" maxlength="10" disabled="disabled" value="'.$row['firstname'].'"/></td>';
 		 echo '</tr>';
	 echo '</table>';
	echo '</div>';
	echo '<div id="box3">';
	echo '<label for="vorname">Geb.Datum: </label>';
	echo '<input type="text" name="gebdat" maxlength="10" size="9" disabled="disabled"  value="'.$row['birth'].'"/>';
	echo '</div>';
		echo '</fieldset>';
	   echo '</div>';




		include 'formular.html';
		echo '<div id="savebutton">';
		echo '<input type="button" value="Zurück" name="goback" onClick="javascript:history.back()">';
		echo ' ';
		echo '<input type="submit" name="speichern" value="Formular speichern" />';
		echo '</div>';
		echo '</form>';

    }
    else{
			echo '<fieldset>';
		   echo 'Sie haben kein Schreibrecht für dieses Formular!<br>';
      	           echo '</fieldset>';
		   for ($i=1;$i<=25;$i++) echo '<br>';
			echo '</fieldset>';
        }
  }

else{
    if($_SESSION['reading']){
    echo '<form action="aktion.php" method="post">';
        echo '<fieldset>';
            echo '<legend>Aktionswahl</legend>';
            echo '<label><input type="radio" name="aktionswahl" value="1" /> Formular ansehen</label><br>';
            echo '<label><input type="radio" name="aktionswahl" value="2" /> Formular bearbeiten</label><br>';
            echo '<label><input type="radio" name="aktionswahl" value="3" /> Formular löschen</label><br><br>';
	  echo '<input type="button" value="Zurück" name="goback" onClick="javascript:history.back()">';
	  echo ' ';
          echo '<input type="submit" name="formaction" value="Weiter" />';
        echo '</fieldset>';
    echo '</form>';
    for ($i=1;$i<=25;$i++) echo '<br>';
    }
    else{
			echo '<fieldset>';
		   echo 'Sie haben kein Leserecht für dieses Formular!<br>';
      	           echo '</fieldset>';
		   for ($i=1;$i<=25;$i++) echo '<br>';
			echo '</fieldset>';
        }


}



	}


	session_start();
	$_SESSION['auswahl']=$_POST['formular'];
	if ($_POST['formular']==0) $_SESSION['auswahl']=1;
  	include 'head2.html';
    		echo '<li><a href=\'login.php?PHPSESSID='.session_id().'\'>Home</a></li>';
    		echo '<li><a href=\'logout.php?PHPSESSID='.session_id().'\'>Logout</a></li>';
		echo '<li><a href=\'doku.php?PHPSESSID='.session_id().'\'>Dokumentation</a></li>';


    	echo '</ul>';
  	echo '</div>';
	echo '</div>';
	  echo '<div id="content">';
	   echo '<div id="label">';
   	   echo '<div id="box2">';
	  
             if ($_SESSION['permission']){
			anzeigen();
  	     }
	     else
	     {
	           echo '<fieldset>';
		   echo 'Sie sind nicht eingeloggt!<br>';
 		   echo '<a href=\'index.html\'>Hier wieder einloggen</a>';
      	           echo '</fieldset>';
	     }


    echo'</div>';
  include 'bottom.html';
?>