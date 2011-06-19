<?php
	function anzeigen(){
	echo '<form action="script.php" method="post">';
	   echo '<fieldset>';
           	echo '<legend>Formularart</legend>';
		echo '<label><input type="radio" name="formular" value="1" checked="checked" />Formular prätherapeutische Prostatakonferenz</label><br>';
		echo '<label><input type="radio" name="formular" value="2" disabled="disabled" />Formular posttherapeutische Prostatakonferenz</label><br>';
		echo '<label><input type="radio" name="formular" value="3" disabled="disabled" />Formular Prostata-Histologie</label><br>';
		echo '<label><input type="radio" name="formular" value="4" disabled="disabled" />Formular Pathologischer Befund Prostatakarzinom</label><br>';
	   echo '</fieldset>';
	   echo '<br>';
	echo '<fieldset>';
        echo '<legend>Patientenauswahl</legend>';
	$db = @new mysqli('localhost', 'obiwan11880', 'Porsche845', 'obiwan11880');
	$sql = 'SELECT
	patientid,
	firstname,
	lastname,
	savedformular
	FROM
    	patient';
	$result = $db->query($sql);

             echo '<select name="lacrimosa" size="20" style="width: 550px">';
		while ($row = $result->fetch_assoc()){
		     echo '<option value="'.$row['patientid'].'">'.'ID: '.$row['patientid'].' '.$row['firstname'].' '.$row['lastname'];

			  if ($row['savedformular']) echo ' - Formular prätherapeutische Prostatakonferenz';
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
    		echo '<li><a href=\'anzeigen.php?PHPSESSID='.session_id().'\' style="background-color:#b0c4de;">Formular aufrufen</a></li>';
      		echo '<li><a href=\'erzeugen.php?PHPSESSID='.session_id().'\'>Formular erzeugen</a></li>';
		echo '<li><a href=\'doku.php?PHPSESSID='.session_id().'\'>Dokumentation</a></li>';


    	echo '</ul>';
  	echo '</div>';
	echo '</div>';
	  echo '<div id="content">';
	   echo '<div id="label">';
   	   echo '<div id="box">';

	  
             if ($_SESSION['permission']){
		if($_SESSION['reading']){
			anzeigen();
		}
		else{
			echo '<fieldset>';
			echo 'Sie haben kein Leserecht für das Formular';
			echo '</fieldset>';
		    }
  	     }
	     else
	     {
	           echo '<fieldset>';
		   echo 'Sie sind nicht eingeloggt!';
      	           echo '</fieldset>';
	     }


    echo'</div>';
  include 'bottom.html';
?>