<?php ini_set('display_errors', 1); error_reporting(E_ALL);
require_once('Connections/PHPConn.php'); 
require_once("e_wfhd/php/links.php");
//$user =& JFactory::getUser();
$fullname = "Geoffrey Ochenge";//$user->name;
$usernam ="Gochenge"; //$user->get('username'); 

/*Querying the database for tickets assigned*/
 mysql_select_db($database_PHPConn, $PHPConn);
//database connection
 $conn = new mysqli($hostname_PHPConn,$username_PHPConn,$password_PHPConn,$database_PHPConn);
 // Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

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
      <a class="pull-left" ><img src="e_wfhd\images\e_wfhd.png"></a>
    </div>
 	
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo $agent_home; ?>">Home</a></li>
        <li ><a href="<?php echo $agent_raise_ticket; ?>">Raise a Query</a></li>
		<li class="active"><a> <span class="sr-only">(current)</span>My Requests</a></li>
		</ul>
		<ul class="nav pull-right">
             <li><a ><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $fullname; ?> </a></li>
                </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="well well-sm">
 
<form  action="<?php echo $agent_view_tickets;?>" method="GET">
<!--datepickers-->
<div class="container">
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
<!--select-->
<div class='col-sm-3'>
	<div class="input-group">
      <select id="Select" name ="status" class="form-control">
        <option  value="%%">Request Status</option>
		<option value ="Pending">Pending</option>
		<option value="in progress">In Progress</option>
		<option value="closed">Closed</option></select>
		</select>
		<span class="input-group-btn">
			<input name="Search" type="submit" value="Submit" class ="btn btn-success">
		</span>
	</div>
</div>
</div>
</form>
<!--the table-->
<table class="table table-compressed">
  <thead>
    <tr>
      <th scope="col">ID#</th>
      <th scope="col">Date</th>
      <th scope="col">Details</th>
      <th scope="col">Status</th>
	  <th scope="col">Rating</th>
    </tr>
  </thead>
    <tbody>
  <?php
  if (isset($_GET['Search'])){
$status= $_GET['status'];
$from= $_GET['from'];
$to= $_GET['to'];
  

mysql_select_db($database_PHPConn, $PHPConn);
$sql = "SELECT * FROM e_wfhelpdeskentries WHERE  (submitDate BETWEEN '".$from."'AND '".$to."')AND submitter LIKE '" . $usernam   . "' AND wStatus LIKE '" . $status . "' ORDER BY submitDate DESC LIMIT " . $offset . "," . $no_of_records_per_page ."";
$sql_pagination = "SELECT * FROM e_wfhelpdeskentries WHERE  (submitDate BETWEEN '".$from."'AND '".$to."')AND submitter LIKE '" . $usernam   . "' AND wStatus LIKE '" . $status . "' ORDER BY submitDate DESC ";
	$result_pagination = $conn->query($sql_pagination);
	$total_rows=$result_pagination->num_rows;
	$total_pages = ceil($total_rows / $no_of_records_per_page);
$result = mysql_query($sql);
  }
  else{
	 $sql = "SELECT * FROM `e_wfhelpdeskentries` WHERE  submitter LIKE '" . $usernam . "' ORDER BY submitDate DESC LIMIT " . $offset . "," . $no_of_records_per_page ."";
$sql_pagination = "SELECT * FROM e_wfhelpdeskentries WHERE  submitter LIKE '" . $usernam ."' ORDER BY submitDate DESC";
	$result_pagination = $conn->query($sql_pagination);
	$total_rows=$result_pagination->num_rows;
	$total_pages = ceil($total_rows / $no_of_records_per_page);
$result = mysql_query($sql); 
	  
	  
  }
if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

if (mysql_num_rows($result) == 0) {
    echo "<div class=\"alert alert-danger\" role= \"alert\">No tickets ".$status." found between " .$from ." and ". $to ."</div>";

}

// While a row of data exists, put that row in $row as an associative array
// Note: If you're expecting just one row, no need to use a loop
// Note: If you put extract($row); inside the following loop, you'll
//       then create $userid, $fullname, and $userstatus
while ($row = mysql_fetch_assoc($result)) { 
echo "<tr><th scope=\"row\">" . $row["idx"] . "</th>
      <td>" . $row["submitDate"] . "</td>
      <td>" . $row["category"] . "</td>
      <td><a href=\"".$agent_ticket_details."?ID=" . $row['idx'] . "\"><span class=\"glyphicon glyphicon-info-sign\"></span>" . $row["wStatus"] . "</a></td>"; 
	  $rate = $row['rating'];
	 include("e_wfhd/php/agent_rating_results2.php"); 
	 echo "</tr>";
}

?>
  </tbody>
</table>
</div>
</div>
<!-- Pagination -->

<div class="container ">
<div class="row">
   <div class="col-lg-6 col-lg-offset-3 text-center">

<ul class="pagination">
        <li><a href="<?php echo $agent_view_tickets . "?pageno=1"; ?>">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo $agent_view_tickets. "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo  $agent_view_tickets . "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="<?php echo $agent_view_tickets; ?>?pageno=<?php echo $total_pages;  ?>">Last</a></li>
    </ul>
	</div>
</div>
</div>

<div class="container ">
<!-- /.footer-->
<footer class="footer">
      <div class="container">
        <p class="text-muted">Copyright @ 2018 | Workforce Helpdesk 1.0 | All right reserved <script type="text/javascript"> document.write(new Date().getFullYear());</script></p>
		<p class="text-muted">Special Thanks to developer: Geofrey Ochenge and Daniel Kinyanjui</p>
      </div>
    </footer>
</div>
<?php

 

?>





<script src="e_wfhd\js\jquery.min.js"></script>
<script src="e_wfhd\js\bootstrap.min.js"></script>
<!--datetime Picker-->
<script src='e_wfhd/js/moment-with-locales.min.js'></script>
<script src='e_wfhd/js/bootstrap-datetimepicker.min.js'></script>
<script  src="e_wfhd/js/index.js"></script>
<!--/.datetime Picker-->
<!-- /.footer-->

</div>

</body>
</html>
