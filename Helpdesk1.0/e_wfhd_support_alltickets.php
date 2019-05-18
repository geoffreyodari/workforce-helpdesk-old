<?php 
ini_set('display_errors', 1); error_reporting(E_ALL);
require_once('Connections/PHPConn.php'); 
require_once("e_wfhd/php/links.php");
 $conn = new mysqli($hostname_PHPConn,$username_PHPConn,$password_PHPConn,$database_PHPConn);
//$user =& JFactory::getUser();
 $fullname =  "Geoffrey Ochenge"; //$user->name;
 $alias = "gochenge"; //$user->get('username'); 

/**This code will get the current page number with the help of $_GET Array. 
Note that if it is not present it will set the default page number to 1.**/

	if (isset($_GET['pageno'])) {
		$pageno = $_GET['pageno'];
	} else {
		$pageno = 1;
	}

/**To manage the number of records to be displayed in a page 
 change the value of $no_of_records_per_page variable.**/

	$no_of_records_per_page = 10;
	$offset = ($pageno-1) * $no_of_records_per_page; 

//Get the number of total number of pages
	$sql_pagination = "SELECT * FROM e_wfhelpdeskentries";
	$result_pagination = $conn->query($sql_pagination);
	$total_rows=$result_pagination->num_rows;
	$total_pages = ceil($total_rows / $no_of_records_per_page);
  
#get the submitters
 /**mysql_select_db($database_PHPConn, $PHPConn);
 $GetSubmitters="SELECT DISTINCT(submitter), `Name` as Jina FROM `e_wfhelpdeskentries`,e_masterdata WHERE `e_wfhelpdeskentries`.submitter=e_masterdata.USERNAME ORDER BY e_masterdata.`Name`"; 
 $rsSubmitters= mysql_query($GetSubmitters,$PHPConn) OR trigger_error(mysql_error(),E_USER_ERROR);
 $row_Submitters = mysql_fetch_assoc($rsSubmitters);	

 /*get distinct WF segments for distribution*/
 mysql_select_db($database_PHPConn, $PHPConn);
 $query_SEG= "SELECT * FROM `e_wfhelpdesk_distributions`ORDER BY segment"; 
 $rsSEG = mysql_query($query_SEG, $PHPConn) or die(mysql_error());
 $row_SEG = mysql_fetch_assoc($rsSEG);
 $totalRows_SEG= mysql_num_rows($rsSEG); 
 
 
 
 /*Querying the database for tickets assigned*/
 mysql_select_db($database_PHPConn, $PHPConn);

?>
<?php

if (isset($_POST['ticketid2'])){
	$from= $_POST['from'];
	$to= $_POST['to'];	
$query_obc = "SELECT * FROM `e_wfhelpdeskentries` WHERE idx LIKE '".$_POST['ticketid2']."' OR staffid LIKE '".$_POST['ticketid2']."' OR submitter LIKE '".$_POST['ticketid2']."'OR wstatus LIKE '".$_POST['ticketid2']."' ORDER BY submitDate DESC LIMIT " . $offset . "," . $no_of_records_per_page ."";
$result = mysql_query($query_obc);
$sql_pagination = "SELECT * FROM `e_wfhelpdeskentries` WHERE idx LIKE '".$_POST['ticketid2']."' OR staffid LIKE '".$_POST['ticketid2']."' OR submitter LIKE '".$_POST['ticketid2']."'OR wstatus LIKE '".$_POST['ticketid2']."' ORDER BY submitDate DESC";
	$result_pagination = $conn->query($sql_pagination);
	$total_rows=$result_pagination->num_rows;
	$total_pages = ceil($total_rows / $no_of_records_per_page);
}
else
{
	$query_obc = "SELECT * FROM `e_wfhelpdeskentries` ORDER BY submitDate DESC LIMIT " . $offset . "," . $no_of_records_per_page ."";
	$result = mysql_query($query_obc);
	$sql_pagination = "SELECT * FROM `e_wfhelpdeskentries` ORDER BY submitDate DESC";
	$result_pagination = $conn->query($sql_pagination);
	$total_rows=$result_pagination->num_rows;
	$total_pages = ceil($total_rows / $no_of_records_per_page);
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
 <link href="e_wfhd/css/sticky-footer.css" rel="stylesheet">
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
      <a class="pull-left"><img src="e_wfhd/images/e_wfhd.png"></a>
    </div>
 
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo $support_home; ?>">Home</a></li>
        <li ><a href="<?php echo $support_assigned_tickets; ?>">My Tickets</a></li>
		<li class="active"><a><span class="sr-only">(current)</span>All Tickets</a></li>
		</ul>
		<ul class="nav pull-right">
                    <li><a><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $fullname; ?> </a></li>
                </ul>
    </div><!-- /.navbar-collapse -->
	
  </div><!-- /.container-fluid -->
</nav>

<div class="well well-sm">
<form method="POST" action ="">
<!--datepickers-->
<div class="container">
<div class="row">
        <div class='col-sm-3'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" name="from" placeholder="From">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
	 <div class='col-sm-3'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' class="form-control" name="to" placeholder="To">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>


 <div class="col-sm-5" >
	<div class="input-group">
		<input class="form-control" name="ticketid2" type="text"  id="example-text-input" placeholder ="Enter Ticket ID,User Name,Staff ID,Status">
		<span class="input-group-btn"><input class="btn btn-primary" name="ticketid" value="Search" type="submit"></span>
	</div>
  </div>
  </div>
</form>

<!--the table-->
<table class="table table-responsive">
  <thead>
    <tr>
      <th scope="col">ID#</th>
      <th scope="col">Date</th>
      <th scope="col">Raised By</th>
      <th scope="col">Issue</th>
	  <th scope="col">Status</th>
	  <th scope="col">Ratings</th>
    </tr>
  </thead>
  <?php
while ($row_obc = mysql_fetch_assoc($result)) { ?>
  <tbody>
    <tr>
      <th scope="row"><?php echo($row_obc['idx']); ?></th>
      <td><?php echo($row_obc['submitDate']); ?></td>
      <td><?php echo($row_obc['submitterName']); ?></td>
      <td><?php echo($row_obc['wfissue']); ?></td>
	  <td><a href="<?php echo $support_ticket_details. "?ID="; echo($row_obc['idx']); ?>"><span class="glyphicon glyphicon-pencil"></span><?php echo($row_obc['wStatus']); ?></a></td>
	 <?php $rate = $row_obc['rating'];
	 include("e_wfhd/php/agent_rating_results2.php"); 
	 include("e_wfhd/php/table_status.php");  ?>
</tr>
  </tbody>
  <?php }  ?>
</table>
</div>
</div>
</div>
<!-- Pagination -->
<div class="container ">
<div class="row">
   <div class="col-lg-6 col-lg-offset-3 text-center">
<ul class="pagination">
        <li><a href="<?php echo $support_view_all_tickets ?>?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo $support_view_all_tickets  . "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo  $support_view_all_tickets  . "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="<?php echo $support_view_all_tickets  ?>?pageno=<?php echo $total_pages;  ?>">Last</a></li>
    </ul>
</div>
</div>
</div>



<script src="e_wfhd/js/jquery.min.js"></script>
<script src="e_wfhd/js/bootstrap.min.js"></script>
<!--datetime Picker-->
<script src='e_wfhd/js/moment-with-locales.min.js'></script>
<script src='e_wfhd/js/bootstrap-datetimepicker.min.js'></script>
<script  src="e_wfhd/js/index.js"></script>
<!--/.datetime Picker-->

</body>
</html>
