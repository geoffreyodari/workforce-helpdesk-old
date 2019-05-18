<?php
require_once('Connections/PHPConn.php'); 
require_once("e_wfhd/php/links.php");
ini_set('display_errors', 1); error_reporting(E_ALL);

//create a databas connection
 $conn = new mysqli($hostname_PHPConn,$username_PHPConn,$password_PHPConn,$database_PHPConn);

 
//check connection 
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
 
//sql statement
$sql_get_admins = "SELECT DISTINCT(wfrole) FROM `e_wfhelpdesk_admins` LIMIT 0, 30 ";
 
$result_get_admins = $conn->query($sql_get_admins);


$conn->close();
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
        <li class="active"><a><span class="sr-only">(current)</span>Home</a></li>
        <li><a href="">View Tickets</a></li>
		<li><a href="">Stats</a></li>
		</ul>
		<ul class="nav pull-right">
                    <li><a><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Geoffrey Ochenge </a></li>
                </ul>
    </div><!-- /.navbar-collapse -->
	
  </div><!-- /.container-fluid -->
</nav>
</div>
<div class="container">
<?php
if ($result_get_admins->num_rows > 0) {
	
	echo "<table class=\"table table-responsive\"><thead><tr><th>Role</th><th>Edit</th></tr></thead><tbody>";
    // output data of each row
    while($row_get_admins = $result_get_admins->fetch_assoc()) {
        echo "<tr><td>". $row_get_admins["wfrole"]."</td><td><a href=\"".$admin_edit_support."?wrole=" . $row_get_admins["wfrole"]."\"><span class=\"glyphicon glyphicon-edit\"></span>Edit</a></td></tr>";
    }
	echo "</tbody></table>";
} else {
    echo "0 results";
}
?>
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
