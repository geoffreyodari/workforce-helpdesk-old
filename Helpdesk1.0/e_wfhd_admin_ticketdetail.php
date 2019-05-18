<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head><title>Workforce Helpdesk</title>

<style>
#wf_header {
  text-align: right;
  background-color: #33cc00;
  margin-bottom: 0px;
}
.wf_links {
  border:  none;
  font-family: Arial,Helvetica,sans-serif;
  text-decoration: none;
  color: white;
  background-color: #33cc00;
  font-size: larger;
  font-weight: normal;
  margin-right: 6px;
  margin-left: 6px;

}
.wf_links2 {
  border:  none;
  font-family: Arial,Helvetica,sans-serif;
  text-decoration: none;
  font-size: larger;
  font-weight: normal;
  background-color: white;
  color: #33cc00;
  margin-right: 6px;
  margin-left: 6px;
}
#wf_banner {
  font-family: Arial,Helvetica,sans-serif;
  font-size: large;
  color: black;
}
#wf_body {
  border: thin solid #33cc00;
  padding: 3px 3px 3px 12px;
  font-family: Arial,Helvetica,sans-serif;
  text-decoration: none;
  font-weight: normal;
  font-size: small;
  background-color: white;
  color: #009900;
}
wf_heading {
  font-family: Arial,Helvetica,sans-serif;
  text-decoration: none;
  font-size: small;
  color: red;
  font-weight: normal;
}
.wf_th {
  font-family: Arial,Helvetica,sans-serif;
  text-align: center;
  font-size: small;
  background-color: #33cc00;
  color: black;
}
.hr { 
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: inset;
    border-width: 1px;
    border-color: #33cc00;
}
.wf_chat {
  border: 1px solid #33cc00;
  margin: 0 auto 25px;
  padding: 10px;
  background: #ffffff none repeat scroll 0% 50%;
  height: 200px;
  width: 400px;
  overflow: auto;
  color: #000000;
}
textarea {
  outline: none;
  resize: none;
  overflow: auto;
  width: 100%;
}
</style>
<?php 
ini_set('display_errors', 1);  error_reporting(E_ALL);

require_once('Connections/DBConn.php'); 

$user =&JFactory::getUser(); 
$alias = $user->get('username');
$bpepe = $user->get('email');

$mnm = $user->get('name');
$namestring = explode(" ", $mnm)
?>

</head>
<body>
<div id="wf_banner">Hi <?php echo $alias; ?>!</div>
<div id="wf_header"><a href="https://ccintranet/index.php?option=com_php&Itemid=613" class="wf_links">Home</a><a href="https://ccintranet/index.php?option=com_php&Itemid=616" class="wf_links">Back</a>
</div>
<wf_heading>Ticket Details</wf_heading><br>
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


#select viewers of unverified data
mysql_select_db($database_DBConn, $DBConn);
$query_NV = "SELECT * FROM `cm_users` WHERE  username= '" . $user->username ."'";
$rsNV = mysql_query($query_NV, $DBConn) or die(mysql_error());
$row_NV= mysql_fetch_assoc($rsNV);
$totalNVS = mysql_num_rows($rsNV);

if ($totalNVS>0 )
{  
//Do not block
}else{ ?>

	<script language="javascript">
     alert('You do not have rights to access this page. \n\n Please contact the Systems Administrator for assistance') 
     window.history.back();
     </script>
<?php
  }


#get the record details from url
if (isset($_GET['ID'])){
	$rID=$_GET['ID'];
} else {
	$rID=0;
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
 $redirectURL='http://localhost/hdnew/https://ccintranet/index.php?option=com_php&Itemid=625?ID='.$rID.'';
		
	//insert data to DB
	mysql_select_db($database_DBConn, $DBConn);
	$newQuery="UPDATE `e_wfhelpdeskentries` SET	
		wStatus='".((isset($_POST['vstat']))?$_POST['vstat']:'')."', 
		feedback1= '".((isset($_POST['fbComm']))?$_POST['fbComm'] . $_POST['fbComm2']:'')."',
		wfAnalyst1='".((isset($_POST['Submitter']))?$_POST['Submitter']:'')."',
		feedbackdate1='".((isset($_POST['SubmitDate']))?$_POST['SubmitDate']:'')."'
			WHERE idx='$rID'";			
	$myCA= mysql_query($newQuery, $DBConn) or die(mysql_error()); 
	$affR= mysql_affected_rows();
	

	if ($affR>0){ 	
	//include mail to concerned parties	
			if($_POST["vstat"]=='Closed'){	
			  //include "E_WorkforceHelpDesk/E_WorkforceHD_closeGo.php"; 
			}
			//send update notification
			if ( ($_POST["vstat"]=='In Progress') &&($_POST["notCheck"]=='YES') ){	
			  include "E_WorkforceHelpDesk/E_WorkforceHD_updateGo.php"; 
			}
		echo "<script language=\"JavaScript\">\n";
		echo "alert('Update submitted!');\n";
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
 
<div id="wf_body">



 
<div id="wrap">
 
  <div id="content1">  
<br />
  
    <!-------------start details------------->   
  <div >
<table width="617"  border="0" align="center"> 
	<tr>
    <th width="159"  >Ticket ID: </th>
    <td width="448" > <input type="text" name="tpoint" id="tpoint" readonly size="35" value="<?php echo $row_rec['idx']; ?>"/></td>
   </tr> 
   <tr>
    <th width="159"  >Submitter: </th>
    <td width="448" > <input type="text" name="tpoint" id="tpoint" readonly size="35" value="<?php echo $row_rec['submitterName']; ?>"/></td>
   </tr>
   <tr>
    <th width="159"  >Staff ID: </th>
    <td width="448" > <input type="text" name="tpoint" id="tpoint" readonly size="35" value="<?php echo $row_rec['staffid']; ?>"/></td>
   </tr>
  <tr>
    <th>Submit Date: </th>
    <td> <input type="text"  size="35" readonly value="<?php echo $row_rec['submitDate']; ?>" /></td>
  </tr>
   <tr>
    <th>Manager: </th>
    <td> <input type="text"  size="35"  readonly value="<?php echo $row_rec['manager']; ?>" /> </td>
  </tr>
  <tr>
    <th>Segment: </th>
    <td> <input type="text"  size="35" readonly value="<?php echo $row_rec['segment']; ?>" />  </td>
  </tr>
   <tr>
    <th>Section: </th>
    <td> <input type="text"  size="35" readonly value="<?php echo $row_rec['wfsegment']; ?>" /> </td>
  </tr>
   <tr>
    <th>Category: </th>
    <td> <input type="text"  size="35" readonly value="<?php echo $row_rec['category']; ?>" /> </td>
  </tr>
    <tr>
    <th>Sub-Category: </th>
    <td> <input type="text"  size="35" readonly value="<?php echo $row_rec['wfissue']; ?>" /> </td>
  </tr>
  </table>
 <wf_heading>Issue Description: </wf_heading>
<div class="wf_chat"><?php echo $row_rec['verboseComments']; ?></div>
  <br>
  <hr>

    <form action="" METHOD="POST" name="form1" id="form1" enctype="multipart/form-data"  onSubmit="javascript: return check_Null();" >

<wf_heading>Feedback:</wf_heading><br>

	<?php
	if (empty($row_rec['feedbackdate1'])){
		echo "<div class=\"wf_chat\">[Please type your feedback here]<br><textarea id=\"fbComm\" name=\"fbComm\" >
		</textarea></div>";
		echo "<input type=hidden name=\"fbComm2\"></input></div>";
	}
	else
	{
	echo "<div class=\"wf_chat\">[Please type your feedback here]<br><textarea id=\"fbComm\" name=\"fbComm\" ></textarea><br>";
	echo "<b>Analyst:</b>" . $row_rec['wfAnalyst1'] . " <br><b>Date:</b>" . $row_rec['feedbackdate1'] . "<br><b>Feedback:</b></br>" . $row_rec['feedback1'] .""; 
	echo "<input type=hidden name=\"fbComm2\" value=\"<hr><br><b>Analyst:</b>" . $row_rec['wfAnalyst1'] . " <br><b>Date:</b>" . $row_rec['feedbackdate1'] . "
	<br>Feedback:</br>" . $row_rec['feedback1'] ."\"></div>";}?>


 <table> 
  <tr>
    <th>Ticket Status: <span class="red"><strong>*</strong></span></th>
    <td valign="bottom"><select name="vstat" id="vstat" style="width:210px;" onClick="toggle_Me()"> 
	<?php if($row_rec['wStatus']=='') { ?>
         <option selected="selected" value="Pending">Pending</option>
            <?php } else {?>
         <option selected="selected" value="<?php echo $row_rec['wStatus']; ?>" ><?php echo $row_rec['wStatus']; ?></option>
            <?php } ?>        
        <option value="In Progress">In Progress</option>
        <option value="Closed">Closed</option>
    </select></td>
  </tr>
  <tr>
  <th class="WADADataTableHeader">&nbsp;</th>
  <td class="WADADataTableCell">
	<br />
	<div id='Tell_1' style="display:none;"><font color="#FF0000">*</font> <input type="checkbox" name='notCheck' value='YES'/>
	 Send an email update to the initiator.</div>
	<div id='Tell_2' style="display:none;"><font color="#FF0000">*</font>Closing the ticket will automatically send a notification to the initiator.</div>
  </td>
 </tr> 
  <tr>
    <td valign="bottom">      
      <input name="Submitter" type="hidden" id="Submitter" value="<?php echo $alias; ?>" />
      <input name="SubmitDate" type="hidden" id="SubmitDate" value="<?php echo date("Y-m-d H:i:s");?>" /></td>
    <td width="74%" valign="bottom"><input name="ppath" type="hidden" id="ppath" /></td>
  </tr>
  
  <?php if( $row_rec['wStatus'] != 'Closed'){ ?>
  <tr>
    <td valign="bottom" align="right"><input name="Reset" type="reset" class="button" id="Reset" value="Reset" />&nbsp;&nbsp;&nbsp;</td>
    <td height="40" valign="bottom"><input name="Submit" type="submit" class="button" id="Submit" value=" Update " />
	<input type="hidden" name="MM_insert" value="form1" />
    </td> 
  </tr>
  <?php } ?>
</table><br />

 </form>

 
</div>
  </div>
  </div>
  
</body></html>