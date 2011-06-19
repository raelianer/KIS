<?php
	function anzeigen(){

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
	   echo $_POST['formular'];
	   $_SESSION['permission']=false;	  
	   session_unset();
	   session_destroy();
             if ($_SESSION['permission']){
		if($_SESSION['writing']){
			anzeigen();
		}
		else{
			echo '<fieldset>';
			echo 'Sie haben kein Schreibrecht für das Formular';
			echo '</fieldset>';
		    }
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