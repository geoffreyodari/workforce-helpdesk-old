
<?php 
ini_set('display_errors', 1);  error_reporting(E_ALL);
require_once("e_wfhd/php/links.php");
require_once('Connections/DBConn.php'); 

//$user =&JFactory::getUser(); 
$alias = "gochenge";//$user->get('username');
//$bpepe = $user->get('email');

$fullname = "Geoffrey Ochenge";//$user->get('name');

?>
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




#get the record details from url
if (isset($_GET['ID'])){
	$rID=$_GET['ID'];
} else {
	$rID=$_POST['ID'];
}
#Query the record 
mysql_select_db($database_DBConn, $DBConn);
$MainQuery = sprintf("SELECT * FROM `e_wfhelpdeskentries` WHERE `idx`='".$rID."' ");
$record_srch = mysql_query($MainQuery, $DBConn) or die(mysql_error());
$row_rec= mysql_fetch_assoc($record_srch);
$totalRec = mysql_num_rows($record_srch);

#insert record on click
if ((isset($_POST["Submit"])) && ($_POST["MM_insert"] == "form1")) 
{ 
// $redirectURL='http://localhost/hdnew/e_wfhd_support_detail.php?ID='.$rID.'';
	//to allow special characters(',") into the sql database
	$feedback = addslashes($_POST['fbComm']);
	//insert data to DB
mysql_select_db($database_DBConn, $DBConn);
	$newQuery="UPDATE `e_wfhelpdeskentries` SET	
		wStatus='".((isset($_POST['vstat']))?$_POST['vstat']:'')."', 
		feedback1= '".$feedback."',
		wfAnalyst1='".((isset($_POST['Submitter']))?$_POST['Submitter']:'')."',
		feedbackdate1='".((isset($_POST['SubmitDate']))?$_POST['SubmitDate']:'')."'
			WHERE idx='$rID'";			
	$myCA= mysql_query($newQuery, $DBConn) or die(mysql_error()); 
	$affR= mysql_affected_rows();
	

	if ($affR>0){ 	
	//include mail to concerned parties	
			if($_POST["vstat"]=='Closed'){	
			  include "e_wfhd/php/update_mail.php"; 
			  echo "<script>location.reload();</script>";
			}
			//send update notification
			if ( ($_POST["vstat"]=='In Progress') &&($_POST["notCheck"]=='YES') ){				
			  include "e_wfhd/php/update_mail.php"; 
			  echo "<script>location.reload();</script>";
			}
		echo "<script language=\"JavaScript\">\n";
		echo "alert('Update submitted!');";
		echo "window.location='".$redirectURL."'";	
		echo "</script>";	
	} else {
		echo "<script language=\"JavaScript\">\n";
		echo "alert('update failed!');\n";
		echo "window.location='".$redirectURL."'";	
		echo "</script>";	
	}

}

?>

 

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
 
<!-- If IE use the latest rendering engine -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
 
<!-- Set the page to the width of the device and set the zoon level -->
<meta name="viewport" content="width = device-width, initial-scale = 1">
<title>WFM Helpdesk</title>
<link rel="stylesheet" type="text/css" href="e_wfhd/css/bootstrap.min.css">
<link rel='stylesheet prefetch' href='e_wfhd/css/bootstrap-datetimepicker.min.css'>
<script src="e_wfhd/js/jquery.min.js"></script>
	<!-- font awesome -->
<link rel="stylesheet" href="e_wfhd/css/font-awesome.min.css">
	<!-- rating star css -->
<link rel="stylesheet" href="e_wfhd/css/ratingstar.css">
<style>

</style>
 <script language="JavaScript">
		<!--
		function check_Null(){
		
			var CVal=document.forms["form1"]["fbComm"].value;	
			if (trimAll(CVal) === '')
			  {
				 alert("You must enter the feedback.");
				 return false;
			  }

			var Cstat=document.forms["form1"]["vstat"].value;
			if (Cstat == 'Pending')
			  {
				 alert("You must update the ticket status");
				 return false;
			  }
			  
			return true;
		}
		
		
	function trimAll(sString){ 
	  while (sString.substring(0,1) == ' ')   {
        sString = sString.substring(1, sString.length);
	  }
      while (sString.substring(sString.length-1, sString.length) == ' ')  {
        sString = sString.substring(0,sString.length-1);
      }
	 return sString;
	}
	
		// -->
	</script>
	
	<script type="text/javascript">
<!--
    function toggle_Me() {
       var xtl = document.getElementById('vstat').value;
	  
	   var T1 = document.getElementById('Tell_1');
	   var T2 = document.getElementById('Tell_2');
	   
	   if(xtl=='In Progress'){	   
			T1.style.display = 'block';
			T2.style.display = 'none';			
	   }
	   
	   if(xtl=='Closed'){
			T2.style.display = 'block';
			T1.style.display = 'none';				
	   }	   
     
    }
//-->
</script>
</head>
<body>
 <div class="container">
<!-- .navbar-fixed-top, or .navbar-fixed-bottom can be added to keep the nav bar fixed on the screen -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
 
      <!-- Button that toggles the navbar on and off on small screens -->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
 
      <!-- Hides information from screen readers -->
        <span class="sr-only"></span>
        <!-- Draws 3 bars in navbar button when in small mode -->
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- You'll have to add padding in your image on the top and right of a few pixels (CSS Styling will break the navbar) -->
      <a class="pull-left" ><img src="e_wfhd\images\e_wfhd.png"></a>
    </div>
 
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo $support_assigned_tickets; ?>">Assigned Tickets</a></li>
        <li ><a href="<?php echo $support_view_all_tickets; ?>">All Tickets</a></li>
		<li class="active"><a> <span class="sr-only">(current)</span>Ticket Details</a></li>
		</ul>
		<ul class="nav pull-right">
                    <li><a><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $fullname; ?> </a></li>
                </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!--details table-->
<table class="table table-bordered">
  <tbody>
    <tr>
      <th scope="row">Ticket ID:</th>
      <td><?php echo $row_rec['idx']; $id_backup = $row_rec['idx']; $ticket_rating = $row_rec['rating'];?></td>
    </tr>
	<tr>
      <th scope="row">Date Submitted:</th>
      <td><?php echo $row_rec['submitDate']; ?></td>
	      <tr>
    <tr>
      <th scope="row">Submitter:</th>
      <td><?php echo $row_rec['submitterName']; ?></td>
	      <tr>
      <th scope="row">Staff ID:</th>
      <td><?php echo $row_rec['staffid']; ?></td>
    </tr>
    </tr>
	    <tr>
      <th scope="row">Segment:</th>
      <td><?php echo $row_rec['segment']; ?></td>
    </tr>
	    <tr>
      <th scope="row">Manager:</th>
      <td><?php echo $row_rec['manager']; ?></td>
    </tr>
		    <tr>
      <th scope="row">Team Assigned:</th>
      <td><?php echo $row_rec['wfsegment']; ?></td>
    </tr>
		    <tr>
      <th scope="row">Assigned to:</th>
      <td><?php echo $row_rec['wfanalyst2']; ?></td>
    </tr>   <tr>
      <th scope="row">Category:</th>
      <td><?php echo $row_rec['category']; ?></td>
    </tr>
		    <tr>
      <th scope="row">Sub Category:</th>
      <td><?php echo $row_rec['wfissue']; ?></td>
	    <tr>
      <th colspan="2">Details:</th>
    </tr>
    <tr>
      <td colspan="2"><?php echo $row_rec['verboseComments']; ?></td>
    </tr>
	
	<form action="" METHOD="POST" name="form1" id="form1" enctype="multipart/form-data"  onSubmit="javascript: return check_Null();" >
	<tr>
	  <th>
	
       <?php 
	   $status = $row_rec['wStatus'];
	   if($row_rec['wStatus']=="Closed")
	   {
		   echo $row_rec['wStatus'] . "</th><td id=\"service_level\" role= \"alert\"></td></tr>";
		   
	   }	
	 else
	 {		 
	  echo "<div class=\"col-sm-8\"><div class=\"form-group\"><label for=\"Select\">Status:</label><select id=\"vstat\" class=\"form-control\" name=\"vstat\"  onClick=\"toggle_Me();\">";
      	 
	   if($row_rec['wStatus']=='') { ?>
         <option selected="selected" value="Pending">Pending</option>
            <?php } else {?>
         <option selected="selected" value="<?php echo $row_rec['wStatus'];  ?>" ><?php echo $row_rec['wStatus']; ?></option>
	 <?php echo "<option value=\"In Progress\">In Progress</option> <option value=\"Closed\">Closed</option></select></div>";       
        
    
	
	echo "</th><td id=\"service_level\" role= \"alert\"></td></tr><tr>
	  <th colspan=\"2\"><div class=\"col-sm-8\"><div class=\"form-group\">
     <div  id='Tell_1' style=\"display:none;\"><p><input type=\"checkbox\" name='notCheck' value=\"YES\" checked>
	 Send an email update to the initiator.</p></div>
	<div id='Tell_2' style=\"display:none;\"><p>Closing the ticket will automatically send a notification to the initiator.</p></div></th></tr>";
   } }?>  
	  <?php
	if (empty($row_rec['feedbackdate1'])){
		echo "<tr><td colspan=\"2\"><p>[Please type your feedback here]</p><div class=\"form-group\">
				<label for=\"exampleFormControlTextarea1\"></label>
				<textarea class=\"form-control\" id=\"exampleFormControlTextarea1\" name=\"fbComm\" rows=\"3\"></textarea></div>";
		echo "<input type=hidden name=\"fbComm2\"></input></div></td></td>";
	}
	elseif ($row_rec['wStatus']=='In Progress'){
		echo "<tr><td colspan=\"2\"><p>[Please type your feedback here]</p><div class=\"form-group\">
				<label for=\"exampleFormControlTextarea1\"></label>
				<textarea class=\"form-control\" id=\"exampleFormControlTextarea1\" name=\"fbComm\" rows=\"3\"></textarea></div>";
		echo "<input type=hidden name=\"fbComm2\"></input></div></td></td>";
	}
	else
	{
	echo "<tr><th colspan=\"2\">Feedback:</th>
    </tr><tr><td>Closed by analyst: " .    $row_rec['wfanalyst1'] ."</td><td>Date: " . $row_rec['feedbackdate1'] . "</td></tr>
	<tr><td colspan=\"2\"><p>" . $row_rec['feedback1'] . "<p></td></tr>";?>
	<div class="row" >
	<?php
	echo "<input type=\"hidden\" name=\"fbComm2\" value=\"<h4>Analyst: " . $row_rec['wfanalyst1'] . " </h3><p>Date: " . $row_rec['feedbackdate1'] . "</p>" . $row_rec['feedback1'] . "<p>\">";
	//rating feedback
	$rating_feedback = $row_rec['ratingfeedback'];
	
	}?>
	</div>
   </div>
   <tr><th>Rating</th><?php
if ($status == "Closed") {
	if(empty($row_rec['rating'])){
	echo "<td>No Rating feedback</td>";
	}
	else{
	include("e_wfhd/php/agent_rating_results.php");	
	echo "</tr><tr><td colspan=\"2\"> Comments: <p><i>".$rating_feedback."</i></p></td>";
	}
} 
else
{
	echo "<td></td>";
}	
?></tr>
		</tbody>
</table>
<?php include("e_wfhd/php/status.php");?>
<div class="row" >
	<div class="well well-sm>
	<div class="form-group">
	<input type="hidden"value= "<?php echo $Id_backup; ?>" name="ID" >
	<?php if ($status != "Closed") { echo "<input type=\"submit\" value=\"Update\" class =\"btn btn-success\" name =\"Submit\" > <input type=\"reset\" value=\"Reset\" class =\"btn btn-danger\">"; }?>
	<input type="hidden" name="MM_insert" value="form1" />
	<input name="Submitter" type="hidden" id="Submitter" value="<?php echo $alias; ?>" />
    <input name="SubmitDate" type="hidden" id="SubmitDate" value="<?php echo date("Y-m-d H:i:s");?>" />
   <input name="ppath" type="hidden" id="ppath" />
</div>

	</div>
	
</form>

</div> 
<!--./details table-->



<script src="e_wfhd/js/jquery.min.js"></script>
<script src="e_wfhd/js/bootstrap.min.js"></script>
<!--datetime Picker-->
<script src='e_wfhd/js/moment-with-locales.min.js'></script>
<script src='e_wfhd/js/bootstrap-datetimepicker.min.js'></script>
<script  src="e_wfhd/js/index.js"></script>
<!--/.datetime Picker-->
 <!--dropdown menu-->
<script  src="e_wfhd/js/wf-dropdown.js"></script>
<!--/.dropdown menu-->
<!-- star js -->
<script src="e_wfhd/js/ratingstar.js"></script>
</body>
</html>