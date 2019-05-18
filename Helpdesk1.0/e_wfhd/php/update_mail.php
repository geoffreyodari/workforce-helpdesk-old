<?php ini_set('display_errors', 1);  error_reporting(E_ALL); ?>

<?php require_once('Connections/PHPConn.php'); ?>

<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


#GET email recepients : 
	mysql_select_db($database_PHPConn, $PHPConn);
	$query_Usr = "SELECT * FROM `E_WFhelpDeskentries` WHERE `idx`='".$rID."'";
	$rsUsr = mysql_query($query_Usr, $PHPConn) or die(mysql_error());
	$row_Usr = mysql_fetch_assoc($rsUsr);
	


if(date("H:i:s")>'16:00:00'){
$salut='Good Evening';
} elseif(date("H:i:s")>'12:00:00'){
$salut='Good Afternoon';
 } else { $salut='Good Morning'; }
?>

<?php
//Send mail 
	
include_once('Mail.php');

$recipients = $row_Usr['submitter'].'@safaricom.co.ke,' ; 
$recipients .= 'NoReply_Workforce@safaricom.co.ke ,';
$recipients .= $row_Usr['wfanalyst1'].'@safaricom.co.ke';

$headers['Content-Type'] = "text/html; charset=\"UTF-8\"";
$headers['Content-Transfer-Encoding'] = "32bit"; 

$headers['From']    = 'NoReply_Workforce@safaricom.co.ke,' ;
$headers['To']   	= $row_Usr['submitter'].'@safaricom.co.ke,'; 
$headers['cc']   	= 'gochenge@safaricom.co.ke,'; 
$headers['Subject'] = 'Workforce HelpDesk Ticket Update: '.$row_Usr['wfissue'] . ' Ticket ID' . $row_Usr['idx'];


$body = "
<html>
<head>
<title>HTML email</title>
</head>
<body>

<font face='Trebuchet MS, Arial, Helvetica, sans-serif' size='2'>

".$salut.", <p />

Your helpdesk query has been updated as below: <p />
<table cellpadding='3' cellspacing='2'>
	<tr> <th>Segment: </th> <td> ".$row_Usr['segment']."</td> </tr>
	<tr> <th>Section: </th> <td> ".$row_Usr['wfsegment']." </td> </tr>
	<tr> <th>Category: </th> <td> ".$row_Usr['category']." </td> </tr>
	<tr> <th>Sub-Category: </th> <td> ".$row_Usr['wfissue']." </td> </tr>
	<tr> <th>Comments: </th> <td> ".$row_Usr['verboseComments']." </td> </tr>
	<tr> <td colspan='2'> <hr/> </td> </tr>
	<tr> <th>Status: </th> <td><font color='red'> ".$_POST['vstat']." </font></td> </tr>
	<tr> <th>Feedback: </th> <td> ".$_POST['fbComm']." </td> </tr>
</table>
<br />

<p /><br />

Regards, <br />
".$row_Usr['wfanalyst1']."<br/>
Workforce Team<br />
<p />
	</font>
</body>
</html>
";


$params['host'] = '172.28.229.69';
$params['port'] = '25';
//$params['auth'] = 'PLAIN';
$params['username'] = 'CMWebAdmin'; 

/* The following option enables SMTP debugging and will print the SMTP conversation to the page, it will only help with authentication issues, if PEAR::Mail is not installed you won't get this far. */
$params['debug'] = 'true';

// Create the mail object using the Mail::factory method
$mail_object =& Mail::factory('smtp', $params);

// Send the message
$mail_object->send($recipients, $headers, $body); 





?>




