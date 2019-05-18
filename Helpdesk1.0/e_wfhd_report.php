<?php 
ini_set('display_errors', 1); error_reporting(E_ALL);
require_once('Connections/PHPConn.php'); 
?>

<?php
 /*Querying the database for tickets */
 mysql_select_db($database_PHPConn, $PHPConn);
 
if (isset($_GET['ek'])){
	$from= $_GET['from'];
	$to= $_GET['to'];	
echo "Search results by EK" ." ". $_GET['ek'];
$query_obc = "SELECT * FROM `e_wfhelpdeskentries` WHERE staffid LIKE '".$_GET['ek']."'  AND (submitDate BETWEEN '".$from."'AND '".$to."') ORDER BY submitDate DESC";

$result = mysql_query($query_obc);
	}
if (isset($_GET['Username']))
	{
	$from= $_GET['from'];
	$to= $_GET['to'];			
echo "Search results by Username" ." ". $_GET['Username'];
$query_obc = "SELECT * FROM `e_wfhelpdeskentries` WHERE submitter LIKE '".$_GET['Username']."'AND (submitDate BETWEEN '".$from."'AND '".$to."')  ORDER BY submitDate DESC";
$result = mysql_query($query_obc);

	}
if (isset($_GET['status']))
	{
	$from= $_GET['from'];
	$to= $_GET['to'];	
echo "Search results by Status" ." " . $_GET['status'];
$query_obc = "SELECT * FROM `e_wfhelpdeskentries` WHERE wStatus LIKE '".$_GET['status']."' AND (submitDate BETWEEN '".$from."'AND '".$to."')ORDER BY submitDate DESC";
$result = mysql_query($query_obc);
	}
if (isset($_GET['team']))
	{
	$from= $_GET['from'];
	$to= $_GET['to'];	
echo "Search results by team " ." " . $_GET['team'];
$query_obc = "SELECT * FROM `e_wfhelpdeskentries` WHERE wfsegment LIKE '%".$_GET['team']."%' AND (submitDate BETWEEN '".$from."'AND '".$to."')ORDER BY submitDate DESC";
$result = mysql_query($query_obc);
	}
if (isset($_GET['analystusername']))
	{
	$from= $_GET['from'];
	$to= $_GET['to'];	
echo "Search results by Analyst " . $_GET['analystusername'];
$query_obc = "SELECT * FROM `e_wfhelpdeskentries` WHERE wfAnalyst1 LIKE '%".$_GET['analystusername']."%' AND (submitDate BETWEEN '".$from."'AND '".$to."')ORDER BY submitDate DESC";
$result = mysql_query($query_obc);
	}

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>WorkForce Helpdesk Report</title>
<?php
	$filename ="output.xls";
	header("Cache-Control: private");
	header("Pragma: cache");
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);
?>
</head>
<body>

<div name="result_container">
    <div><h4>WorkForce HelpDesk Report</h4></div>   

  
  <div>
      <table border="1" cellpadding="1" cellspacing="0" >
        <tr>
          <th>Status</th> 
		  <th>Segment</th> 
		  <th>Workforce Section </th> 
          <th>Category</th>
          <th>Sub-Category</th>
          <th>Comments</th>         
          <th>Workforce Feedback</th>
          <th>Manager</th>       
          <th>Submitter</th>
          <th>Submit Date</th> 		  
        </tr>
		
<?php
while ($row_obc = mysql_fetch_assoc($result)) { ?>
          <tr>
			<td><?php echo($row_obc['wStatus']); ?></td>
            <td><?php echo($row_obc['segment']); ?></td>
			<td><?php echo($row_obc['wfsegment']); ?></td>
            <td><?php echo($row_obc['category']); ?></td>
            <td><?php echo($row_obc['wfissue']); ?></td>
            <td><?php echo($row_obc['verboseComments']); ?></td>
            <td><?php echo($row_obc['feedback1']); ?></td>
            <td><?php echo($row_obc['manager']); ?></td>
            <td><?php echo($row_obc['submitter']); ?></td>         
            <td><?php echo($row_obc['submitDate']); ?></td> 
						
          </tr>
<?php }?>

</body>
</html>

