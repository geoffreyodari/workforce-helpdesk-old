<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head><title>Workforce Helpdesk</title>
<?php 
ini_set('display_errors', 1); error_reporting(E_ALL);
require_once('Connections/PHPConn.php'); 

 $user =& JFactory::getUser();
 $fullname = $user->name;
 $alias = $user->get('username'); 
?>
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
</head>
<body>
<div id="wf_banner">
Hi <?php echo  $fullname; ?> !</div>
<div id="wf_header"><a href="https://ccintranet/index.php?option=com_php&Itemid=613" class="wf_links">Home</a>
<a href="https://ccintranet/index.php?option=com_php&Itemid=617" class="wf_links">View/Edit Support
Analysts</a> <a href="" class="wf_links2">Add Support
Analyst</a>
<a href="https://ccintranet/index.php?option=com_php&Itemid=616" class="wf_links">View Queries</a></div>
<div id="wf_body">
<form  name= "EnrollForm" action= "https://ccintranet/index.php?option=com_php&Itemid=614" onsubmit="return validateForm()" method ="POST" >
<table style="text-align: left; width: 652px; height: 146px;"
 border="0" cellpadding="2" cellspacing="2"align="center">
  <tbody>
    <tr>
      <td>Name</td>
      <td><input name="Name"></td>
    </tr>
    <tr>
      <td>Username</td>
      <td><input name="Username"></td>
    </tr>
    <tr>
      <td>Role</td>
      <td>
	  <Select Name="Role">
		<option>Admin & Transport </option>
		<option>Workforce Performance </option>
		<option>Workforce Planning</option>
	</select>
</td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input name="Email"></td>
    </tr>
    <tr>
      <td></td>
      <td><input name="Enroll" value="Enroll"
 type="submit" ></td>
    </tr>
  </tbody>
</table>


</form>
<br>

<?php


if (isset ($_POST["Name"],$_POST["Username"],$_POST["Role"],$_POST["Email"]))
{
$Name = $_POST["Name"];
$username = $_POST["Username"];
$Role = $_POST["Role"];
$Email = $_POST["Email"];


$conn = mysqli_connect($hostname_PHPConn,$username_PHPConn,$password_PHPConn,$database_PHPConn);
$sql= "INSERT INTO `e_wfhelpdesk_admins` SET NAME = '" . $Name . "', USERNAME = '" . $username. "', ROLE = '" .$Role ."', EMAIL ='" . $Email ."'";
if (mysqli_query($conn, $sql)) {
    echo "Record Added successfully<BR> to edit the segments <a href = \"https://ccintranet/index.php?option=com_php&Itemid=617&support=".$username ."\">click here</a>";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
}
else
{echo "FILL IN ALL THE DETAILS";}
?>
</div>
</body></html>