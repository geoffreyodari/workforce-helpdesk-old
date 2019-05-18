<?php 
require_once('Connections/PHPConn.php'); 
require_once("WA_DataAssist/WA_AppBuilder_PHP.php"); 
require_once("e_wfhd/php/links.php");
ini_set('display_errors', 1); error_reporting(E_ALL);

?>

<?php
//$user =& JFactory::getUser(); 
$usernam= "smuthui"; //$user->username;
$fullname = "Geoffrey Ochenge"; //$user->name);


        
/*get distinct WF segments*/
mysql_select_db($database_PHPConn, $PHPConn);
$query_wfSeg= "SELECT DISTINCT(WFsegment) FROM `e_wfhelpdeskcategories` ORDER BY WFsegment DESC"; 
$rs_wfSeg = mysql_query($query_wfSeg, $PHPConn) or die(mysql_error());
$row_wfSeg = mysql_fetch_assoc($rs_wfSeg);
$totalRows_wfSeg = mysql_num_rows($rs_wfSeg);

/*get all issues in the database*/
mysql_select_db($database_PHPConn, $PHPConn);
$query_ATcat= "SELECT * FROM `e_wfhelpdeskcategories`  ORDER BY WFsegment DESC"; 
$rsATcat = mysql_query($query_ATcat, $PHPConn) or die(mysql_error());
$rowATcat = mysql_fetch_assoc($rsATcat);
$totalRows_ATcat = mysql_num_rows($rsATcat);


/*get  WF segments, EK and Manager for User*/
mysql_select_db($database_PHPConn, $PHPConn);
$query_SEG= "SELECT * FROM `e_masterdata` where USERNAME = '" . $usernam . "'"; 
$rsSEG = mysql_query($query_SEG, $PHPConn) or die(mysql_error());
$row_SEG = mysql_fetch_assoc($rsSEG);
$totalRows_SEG= mysql_num_rows($rsSEG);

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
 <link href="e_wfhd/css/sticky-footer.css" rel="stylesheet">
<style>


</style>

<script language="JavaScript">

function check_Null(){
	
	if (document.WFinsertform.wfSeg.value==""){
				alert("Please select an Issue");
				return false;
			}
		
	var q2 = document.WFinsertform.WFissue.value;	
	if (trimAll(q2) === ''){
		alert("Please enter a brief description of the issue");
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
      <a class="pull-left" href="#"><img src="e_wfhd\images\e_wfhd.png"></a>
    </div>
 
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo $agent_home; ?>">Home <span class="sr-only">(current)</span></a></li>
        <li class="active"><a>Raise a Query</a></li>
		<li><a href="<?php echo $agent_view_tickets; ?>">My Requests</a></li>
		</ul>
		<ul class="nav pull-right">
                    <li><a ><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $fullname; ?> </a></li>
                </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
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



mysql_select_db($database_PHPConn, $PHPConn);
$query_rsTeams = "select DISTINCT(EmployeePosition) from A_Employees_2012 where Grade<>'CCR' ORDER BY EmployeePosition";
$rsTeams = mysql_query($query_rsTeams, $PHPConn) or die(mysql_error());
$row_rsTeams = mysql_fetch_assoc($rsTeams);
$totalRows_rsTeams = mysql_num_rows($rsTeams);


 
// WA Application Builder Insert
if (isset($_POST["Insert"])) // Trigger
{
	$wfSeg1 = $_POST["wfSeg"];
	$wfseg2 = explode("|",$wfSeg1);
			
				mysql_select_db($database_PHPConn, $PHPConn);
				$query_ASGN= "select * FROM e_wfhelpdesk_distributions WHERE  segment LIKE '".$_POST['csegment']."'"; // IN (" . $columns .") AND ROLE LIKE '". $wfseg2[0] ."'";  
				$rsASGN = mysql_query($query_ASGN, $PHPConn) or die(mysql_error());
			while ($row_ASGN= mysql_fetch_assoc($rsASGN))
	{
		//Assigning ticket to user
		if (isset($row_ASGN[$wfseg2[0]])){
				$assignto  = $row_ASGN[$wfseg2[0]];}
				else
				{
				$assignto  = "gochenge";	
				}
	}
  $WA_connection = $PHPConn;
  $WA_table = "e_wfhelpdeskentries";
  $WA_sessionName = "WADA_wfHelpDesk";
  //$WA_redirectURL = "http://localhost/wfhelp/E_WorkforceHD_Insert.php"; 
  //Create a unique ticket id
  $uniqid = uniqid();
  $WA_keepQueryString = false;
  $WA_indexField = "index";
  $WA_fieldNamesStr = "idx|staffid|submitterName|wfsegment|category|wfissue|sl|segment|manager|teammanager|verboseComments|wStatus|submitter|wfanalyst2|submitDate";
  $WA_fieldValuesStr = "".$uniqid ."" 
			   . "|" . "". ((isset($_POST["cEk"]))?$_POST["cEk"]:"")  ."" 
			   . "|" . "".((isset($_POST["cName"]))?$_POST["cName"]:"")  .""   
			   . "|" . "".((isset($_POST["wfSeg"]))?$_POST["wfSeg"]:"")  ."" 
			   . "|" . "".((isset($_POST["csegment"]))?$_POST["csegment"]:"")  ."" 
			   . "|" . "".((isset($_POST["cMgr"]))?$_POST["cMgr"]:"")  .""
			   . "|" . "".((isset($_POST["tl"]))?$_POST["tl"]:"")  ."" 
			   . "|" . "".((isset($_POST["WFissue"]))?$_POST["WFissue"]:"")  ."" 
			   . "|" . "Pending" 
			   . "|" . "".((isset($usernam))?$usernam:"")  ."" 
			   . "|" . "". $assignto ."" 
			   . "|" . "".((isset($_POST["SubmitDate1"]))?$_POST["SubmitDate1"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,NULL";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode("|", $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_PHPConn;
  
  mysql_select_db($WA_connectionDB, $WA_connection);
  if (!session_id()) session_start();
  $insertParamsObj = WA_AB_generateInsertParams($WA_fieldNames, $WA_columns, $WA_fieldValues, -1);
  $WA_Sql = "INSERT INTO `" . $WA_table . "` (" . $insertParamsObj-> WA_tableValues . ") VALUES (" . $insertParamsObj->WA_dbValues. ")";
  $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
  $_SESSION[$WA_sessionName] = mysql_insert_id();

	$VerifyUpdate=mysql_affected_rows();
	
	if ($VerifyUpdate>0){	
	
	echo "<div class=\"alert alert-success\" role= \"alert\"><p><span class=\"glyphicon glyphicon-saved\"></span>Your request has been succesfully submitted!</p></div>";
	}
 else
 {
  echo "<div class=\"alert alert-danger\" role= \"alert\">...OOPS something sent terribly wrong. please contact admin</div>";
  }

}
?>


<!-- well surrounds the text with a rounded border and gray background. The size can be changed with well-sm or well-lg -->
<div class="well well-sm">
<p>To raise a query please select the specific issue</p>
<form action="<?php echo $agent_raise_ticket; ?>" method="post" name="WFinsertform" id="WFinsertform" onSubmit="javascript: return check_Null();">
  <fieldset >

    <div class="form-group">
      <label for="Select">Issue</label>
      <select  class="form-control" id="myIssue" onchange="myIssueFunction()">
        <option selected="selected">Select</option>
		<?php do { ?><option value="<?php echo $rowATcat['WFsegment']  . "|" . "".$rowATcat['WFcategory'] . "|" . "".$rowATcat['WFissue']."|" . "" . $rowATcat['WFservicelevel'] ;?>"><?php echo $rowATcat['WFissue']?></option><?php } while ($rowATcat = mysql_fetch_assoc($rsATcat)); ?>
      </select>
	   <script>
		function myIssueFunction() {
		var x = document.getElementById("myIssue").value;
		document.getElementById("issuex").value =  x;
	}
	</script>
	  <input id="issuex" name="wfSeg"  value="" type="hidden">
    </div>
	 <div class="form-group">
	 <?php do { ?>
      <label for="disabledTextInput">Segment</label>
      <input type="text" id="disabledTextInput" class="form-control" value="<?php echo $row_SEG['SEGMENT']?>" name="csegment" readonly>
    </div> <div class="form-group">
      <label for="disabledTextInput">Manager</label>
      <input type="text" id="disabledTextInput" class="form-control" value="<?php echo $row_SEG['Reporting_Line']?>" name="cMgr" readonly>
    </div>
	 <div class="form-group">
      <label for="disabledTextInput">Staff ID</label>
      <input type="text" id="disabledTextInput" class="form-control" value="<?php echo $row_SEG['Ek']?>" name="cEk" readonly>
	  <input type="hidden" value="<?php echo $row_SEG['TL_Username']?>" name="tl">
	  <input name="cName" value="<?php echo $row_SEG['Name']?>"  type="hidden"><?php } while ($row_SEG = mysql_fetch_assoc($rsSEG)); ?>
    </div>
	 <div class="form-group">
    <label for="exampleFormControlTextarea1">Issue description</label>
    <textarea  class="form-control" id="exampleFormControlTextarea1" name="WFissue" rows="3"></textarea>
  </div>
	<input name="WADAInsertRecordID" id="WADAInsertRecordID" value="" type="hidden"> <input name="Submitter1" id="Submitter1" value="<?php echo $usernam; ?>" type="hidden">
	<input name="SubmitDate1" id="SubmitDate1" value="<?php echo date("Y-m-d H:i:s");?>" type="hidden">
	
    <input name="Insert" type="submit" value="Submit" class ="btn btn-success">
	<input name="" type="reset" value="Clear" class ="btn btn-danger">
  </fieldset>
  
</form>
</div>
</div>

<!-- /.footer-->
<footer class="footer">
      <div class="container">
        <p class="text-muted">Copyright @ 2018 | Workforce Helpdesk 1.0 | All right reserved <script type="text/javascript"> document.write(new Date().getFullYear());</script></p>
		<p class="text-muted">Special Thanks to developer: Geofrey Ochenge and Daniel Kinyanjui</p>
      </div>
    </footer>
</div>


<script src="e_wfhd/js/jquery.min.js"></script>
<script src="e_wfhd/js/bootstrap.min.js"></script>

</body>
</html>
<?php 
/*Sending email*/
if (isset($_POST['Submitter1'])){
		echo "Sending email notification to ". $assignto;
		$wfSeg1 = $_POST["wfSeg"];
		$wfseg2 = explode("|",$wfSeg1);
		mysql_select_db($database_PHPConn, $PHPConn);
			$query_ASGN= "select * FROM e_wfhelpdeskentries WHERE idx = '".$uniqid."'";
			//IN (".$columns .") AND ROLE LIKE '". $wfseg2[0] ."'"; 
	$rsASGN = mysql_query($query_ASGN, $PHPConn) or die(mysql_error());
	while ($row_ASGN= mysql_fetch_assoc($rsASGN))
	{
$str = explode("|",$_POST['wfSeg']);
include('e_wfhd/php/send_mail.php');
$str = explode("|",$_POST['wfSeg']);
		}
	}



?>


