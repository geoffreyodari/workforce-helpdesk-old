<?php
require_once('../../Connections/DBConn.php'); 

if(isset($_POST)){
	mysql_select_db($database_DBConn, $DBConn);
	$RatingQuery="UPDATE `e_wfhelpdeskentries` SET rating='" .  $_POST['v1'] . "',ratingfeedback='".  $_POST['v3'] ."' WHERE idx='". $_POST['v2'] ."'";
	if(mysql_query($RatingQuery, $DBConn)){
		echo "1";		
	}else{ 
		echo "2";
	}
}


?>

