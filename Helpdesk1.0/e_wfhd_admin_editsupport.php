<?php
/**helpdesk admins Table
Name,Username,role,admin

roles 	Workforce Planning, Admin/Transport,Workforce Performance

**/
//error reporting
ini_set('display_errors', 1); 
error_reporting(E_ALL);

//Links- file containing links
require_once('e_wfhd/php/links.php');
//database connection
require_once('Connections/PHPConn.php');
$conn = new mysqli($hostname_PHPConn,$username_PHPConn,$password_PHPConn,$database_PHPConn); 

//get user details from joomla jFactory
//$user =& JFactory::getUser();
//user's full name
$user_name ="Geoffrey Ochenge"; //$user->name;
//user's username
$user_username ="gochenge";//$user->username;


if (isset($_GET['role'])){
$str = $_GET['role'];
$user_asign_role=(explode(',',$str));
$sql_update_roles="UPDATE e_wfhelpdesk_distributions SET `".$user_asign_role[0]."`=\"".$user_asign_role[1]."\"";
$conn->query($sql_update_roles);
}

if (isset($_GET['wrole'])){
$user_role =$_GET['wrole'];
}
else
{
$user_role = $user_asign_role[0];
}	

$sql_get_admins="SELECT * FROM e_wfhelpdesk_admins WHERE wfrole ='".$user_role."'";
$sql_get_segments="SELECT DISTINCT(`" . $user_role ."`)FROM e_wfhelpdesk_distributions";

//test connection
if($conn->connect_error){
	die("Connection failed: " .$conn->connect_error);
} 
//quey admins database
$result_get_admins= $conn->query($sql_get_admins);
$result_get_segments=$conn->query($sql_get_segments);

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
		<li class="active"><a href="<?php echo $admin_home ;?>">Home</a></li>
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
<div class="well">
<?php
if ($user_role=="Workforce Planning"){
	
if ($result_get_segments->num_rows > 0) {
    // output data of each row
	
	echo "<table>";
    while($row_get_segments = $result_get_segments->fetch_assoc()) {
		
        echo "<tr><td>".$row_get_segments[$user_role]."</td></tr>";
		
    }
	echo "</table>";
} else {
    echo "0 results";
}	
	
}


else
{
	if ($result_get_segments->num_rows > 0) {
    // output data of each row
	
	
    while($row_get_segments = $result_get_segments->fetch_assoc()) {
		
        echo "<div class=\"alert alert-success\" role=\"alert\">User " .$row_get_segments[$user_role] . " is currently assigned to " . $user_role. " tickets</div>";
		
    }
	echo "</table>";
} else {
    echo "0 results";
}	
if ($result_get_admins->num_rows > 0) {
    // output data of each row
	
	echo "<form method=\"GET\" action=\"\"><table>";
    while($row_get_admins = $result_get_admins->fetch_assoc()) {
		echo "<div class=\"radio\"><label>";
        echo "<input type=\"radio\"   name=\"role\" value=\"".$row_get_admins["wfrole"].",". $row_get_admins["wfusername"]."\">";
		echo $row_get_admins["wfname"];
		echo "</label></div>";
    } 
	echo "<input class=\"btn btn-success\" type=\"submit\" name=\"submit\" value=\"Assign Role\" onClick=\"checkRadio()\"></form>";
} 
else 
{
    echo "0 results";
}
}


?>
</div>
</div>
<script src="e_wfhd/js/jquery.min.js"></script>
<script src="e_wfhd/js/bootstrap.min.js"></script>
<!--datetime Picker-->
<script src='e_wfhd/js/moment-with-locales.min.js'></script>
<script src='e_wfhd/js/bootstrap-datetimepicker.min.js'></script>
<script  src="e_wfhd/js/index.js"></script>
<!--/.datetime Picker-->
<script> if (document.getElementByName("role")=""){
	alert("Please select an option");
}</script>
</body>
</html>