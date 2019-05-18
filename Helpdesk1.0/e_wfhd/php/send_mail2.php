 <?php ini_set('display_errors', 1);  error_reporting(E_ALL); ?>

<?php require_once('Connections/PHPConn.php'); ?>

<?php



if(date("H:i:s")>'16:00:00'){
$salut='Good Evening';
} elseif(date("H:i:s")>'12:00:00'){
$salut='Good Afternoon';
 } else { $salut='Good Morning'; }
?>

<?php
//Send mail 
	
include_once('Mail.php');

//$recipients = $bpepe.',' ; 
$recipients  = $row_ASGN['USERNAME'].'@safaricom.co.ke ,';
$recipients .= 'NoReply_Workforce@safaricom.co.ke ,';
$recipients .= $usernam . '@safaricom.co.ke';

$headers['Content-Type'] = "text/html; charset=\"UTF-8\"";
$headers['Content-Transfer-Encoding'] = "32bit"; 

$headers['From']    = 'NoReply_Workforce@safaricom.co.ke' ;
$headers['To']   	= $row_ASGN['USERNAME'].'@safaricom.co.ke'; 

$headers['Subject'] = 'New HelpDesk Ticket ID' . $uniqid;

$body = "
<html>
<head>
<title>HTML email</title>
</head>
<body>

<font face='Trebuchet MS, Arial, Helvetica, sans-serif' size='2'>

".$salut.", <p />

" . $fullname[0]." has raised a new  request. <p />

<table cellpadding='3' cellspacing='2'>
	<tr> <th>Segment: </th> <td> ".((isset($_POST['csegment']))?$_POST['csegment']:'')."</td> </tr>
	<tr> <th>Section: </th> <td> ".$str[0]." </td> </tr>
	<tr> <th>Category: </th> <td> ".$str[1]." </td> </tr>
	<tr> <th>Sub-Category: </th> <td> ".$str[2]." </td> </tr>
	<tr> <th>Service Level Agreement: </th> <td> ".$str[3]." Hours </td> </tr>
	<tr> <th>Comments: </th> <td> ".((isset($_POST['WFissue']))?$_POST['WFissue']:'')." </td> </tr>
</table>
<br />

<p /><br />

Regards, <br />
Intranet Web Admin<br />
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
//$params['debug'] = 'true';

// Create the mail object using the Mail::factory method
$mail_object =& Mail::factory('smtp', $params);

// Send the message
$mail_object->send($recipients, $headers, $body); 

?>




