<?php 
ini_set('display_errors', 1);  error_reporting(E_ALL);
require_once("e_wfhd/php/links.php");
require_once('Connections/DBConn.php'); 

//$user =&JFactory::getUser(); 
$usernam  = "gochenge"; //$user->get('username');
$fullname ="Geoffrey Ochenge"; //$user->get('name');

#select viewers of unverified data
mysql_select_db($database_DBConn, $DBConn);
$query_NV = "SELECT * FROM `cm_users` WHERE  username= '" . $usernam  ."'";
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
 <link href="e_wfhd/css/sticky-footer.css" rel="stylesheet">
 <script src="e_wfhd/js/jquery.min.js"></script>
	<!-- font awesome -->
<link rel="stylesheet" href="e_wfhd/css/font-awesome.min.css">
	<!-- rating star css -->
<link rel="stylesheet" href="e_wfhd/css/ratingstar.css">
<style>

</style>
 
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
      <a class="pull-left" ><img src="e_wfhd/images/e_wfhd.png"></a>
    </div>
 
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="https://cmintranet/wfm">Home</a></li>
        <li ><a href="<?php echo $agent_raise_ticket;?>">Raise a Query</a></li>
		<li class="active"><a> <span class="sr-only">(current)</span>My Requests</a></li>
		</ul>
		<ul class="nav pull-right">
                    <li><a ><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $fullname; ?> </a></li>
                </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!--details table-->
<table class="table table-bordered">
  <tbody>
    <tr>
      <th scope="row">Ticket ID:</th>
      <td><?php echo $row_rec['idx'];
	$idx =	$row_rec['idx'];  
	$ticket_rating = $row_rec['rating'];?></td>
    </tr>
    <tr>
      <th scope="row">Date Submitted:</th>
      <td><?php echo $row_rec['submitDate']; ?></td>
	      <tr>
      <th scope="row">Status:</th>
	  
	  <?php 
	  $status = $row_rec['wStatus'];
	  if ($row_rec['wStatus']=="Closed"){
		$raised = strtotime($row_rec['submitDate']);
		$service_level = ($row_rec['sl'] *60*60);
		$due = $raised + $service_level; 
		$now = Date($row_rec['feedbackdate1']);
			if ($now<=$raised){
				echo "<td class=\"bg-success\">" . $row_rec['wStatus'] . " Within " . $row_rec['sl'] . " hour  SLA</td>";
					}
					else
					{
				echo "<td class=\"bg-danger\">" . $row_rec['wStatus'] . " Past " . $row_rec['sl'] . " hour SLA</td>";
					}
	  }
		else 
		{
		$raised = strtotime($row_rec['submitDate']);
		$service_level = ($row_rec['sl'] *60*60);
		$due = $raised + $service_level; 
		$now = Date('Y-m-d H:i:s');
			if ($now<=$raised){
				echo "<td class=\"bg-success\">" . $row_rec['wStatus'] . " Within " . $row_rec['sl'] . " hour  SLA</td>";
					}
					else
					{
				echo "<td class=\"bg-danger\">" . $row_rec['wStatus'] . " Past " . $row_rec['sl'] . " hour SLA</td>";
					}
	  }
	  ?>
	 
	  

    </tr>
	    <tr>
      <th scope="row">Team assigned to:</th>
      <td><?php echo $row_rec['wfsegment']; ?></td>
    </tr>
	    <tr>
      <th scope="row">Assigned to:</th>
      <td><?php echo $row_rec['wfanalyst2'];  ?></td>
    </tr>
	    <tr>
      <th colspan="2">Details:</th>
    </tr>
    <tr>
      <td colspan="2"><?php if (empty($row_rec['verboseComments'])){
		echo "No Details Provided";
	}
	else
	{
	echo $row_rec['verboseComments']; }?></td>

    </tr>
		    <tr>
      <th colspan="2">Feedback:</th>
    </tr>
    
      <?php
	if (empty($row_rec['feedbackdate1'])){
		echo "<tr><td colspan=\"2\">No feedback Provided";
	}
	else
	{
	echo "<tr><td>Analyst:" . $row_rec['wfanalyst1'] . "</td><td> Date:" . $row_rec['feedbackdate1'] . "</td></tr><tr><td colspan=\"2\">
	" . $row_rec['feedback1'] .""; }?></td>
    </tr>
	<?php
if ($status == "Closed") {
	if(empty($row_rec['rating'])){
	echo	"<tr>";
	include("e_wfhd/php/agent_rating.php");
	echo "</tr>";
	}
	else{
		//rating feedback
	$rating_feedback = $row_rec['ratingfeedback'];
	echo	"<tr><th>Rating</th>";
	include("e_wfhd/php/agent_rating_results.php");
	echo "</tr><tr><td colspan=\"2\"> Comments: <p><i>".$rating_feedback."</i></p></td></tr>";
	}
}
?>
</tbody></table>
</div>
<!-- /.footer-->
<footer class="footer">
      <div class="container">
        <p class="text-muted">Copyright @ 2018 | Workforce Helpdesk 1.0 | All right reserved <script> document.write(new Date().getFullYear());</script></p>
		<p class="text-muted">Special Thanks to developer: Geofrey Ochenge and Daniel Kinyanjui</p>
      </div>
    </footer>


<script src="e_wfhd/js/jquery.min.js"></script>
<script src="e_wfhd/js/bootstrap.min.js"></script>

<!--datetime Picker-->
<script src='e_wfhd/js/moment-with-locales.min.js'></script>
<script src='e_wfhd/js/bootstrap-datetimepicker.min.js'></script>
<script  src="e_wfhd/js/index.js"></script>
<!--/.datetime Picker-->
<!-- star js -->
<script src="e_wfhd/js/ratingstar.js"></script>
</body>
</html>