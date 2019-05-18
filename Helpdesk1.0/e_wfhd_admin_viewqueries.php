<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head><title>Workforce Helpdesk</title>
<?php 
ini_set('display_errors', 1); error_reporting(E_ALL);
require_once('Connections/PHPConn.php'); 

$user =& JFactory::getUser();
$fullname = $user->name;
$alias = $user->get('username'); 
?>
<head>
<script src="https://cmintranet/jsDate/datetimepicker_css.js"></script>
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
.hide {
  display: none;
}
  font-weight: bold;
}
</style>
</head>
<body>
<div id="wf_banner">
Hi <?php echo $fullname;?>!</div>
<div id="wf_header"><a href="https://ccintranet/index.php?option=com_php&Itemid=613" class="wf_links">Home</a>
<a href="https://ccintranet/index.php?option=com_php&Itemid=617" class="wf_links">View/Edit Support
Analysts</a> <a href="https://ccintranet/index.php?option=com_php&Itemid=614" class="wf_links">Add Support
Analyst</a>
<a href="" class="wf_links2">View Queries</a></div>
<div id="wf_body">
<wf_heading>All Tickets</wf_heading><br>

<form method="POST" action ="#">
<div style="text-align:center; ">
        <label for="tickdate1">From</label>
        <input type="Text" id="tickdate1" name="from"maxlength="25" size="25"/>
        <img src="https://cmintranet/jsDate/images2/cal.gif" onclick="javascript:NewCssCal ('tickdate1','yyyyMMdd')" style="cursor:pointer"/>
  
        <label for="tickdate2">To</label>
        <input type="Text" id="tickdate2" name= "to" maxlength="25" size="25"/>
        <img src="https://cmintranet/jsDate/images2/cal.gif" onclick="javascript:NewCssCal ('tickdate2','yyyyMMdd')" style="cursor:pointer"/>
    </div><br>
<p>Please select a search Option</p><br>
<input type="radio" name="tab" value="ek" onclick="show1();" />
Staff ID
<input type="radio" name="tab" value="ticketid" onclick="show2();" />
Ticket ID
<input type="radio" name="tab" value="username" onclick="show3();" />
Username
<input type="radio" name="tab" value="status" onclick="show4();" />
Status
<input type="radio" name="tab" value="team" onclick="show5();" />
Team
<input type="radio" name="tab" value="analystusername" onclick="show6();" />
Analyst Username
<div id="div1" class="hide">
EK: <input type="text" name="ek">
</div>
<div id="div2" class="hide">
Ticket ID: <input type="text" name="ticketid">
</div>
<div id="div3" class="hide">
Username: <input type="text" name="Username">
</div>
<div id="div4" class="hide">
<select name ="status">
<option  value="" selected></option>
<option value ="Pending">Pending</option>
	<option value="In Progress">In Progress</option>
	<option value="Closed">Closed</option></select>
</div>
<div id="div5" class="hide">
<select name ="team">
<option  value="" selected></option>
<option value ="Admin/Transport">Admin/Transport</option>
	<option value="workforce Planning">Workforce Planning</option>
	<option value="Workforce Performance">Workforce Performance</option></select>
</div>
<div id="div6" class="hide">
Analyst Username: <input type="text" name="analystusername">
</div>
<input type="submit">
</form><br>
<script>
function show1(){
  document.getElementById('div1').style.display = 'block';
  document.getElementById('div2').style.display ='none';
  document.getElementById('div3').style.display ='none';
  document.getElementById('div4').style.display ='none';
  document.getElementById('div5').style.display ='none';
  document.getElementById('div6').style.display ='none';
}
function show2(){
  document.getElementById('div1').style.display = 'none';
  document.getElementById('div2').style.display ='block';
  document.getElementById('div3').style.display ='none';
  document.getElementById('div4').style.display ='none';
  document.getElementById('div5').style.display ='none';
  document.getElementById('div6').style.display ='none';
}
function show3(){
  document.getElementById('div1').style.display = 'none';
  document.getElementById('div2').style.display ='none';
  document.getElementById('div3').style.display ='block';
  document.getElementById('div4').style.display ='none';
  document.getElementById('div5').style.display ='none';
  document.getElementById('div6').style.display ='none';
}
function show4(){
  document.getElementById('div1').style.display = 'none';
  document.getElementById('div2').style.display ='none';
  document.getElementById('div3').style.display ='none';
  document.getElementById('div4').style.display ='block';
  document.getElementById('div5').style.display ='none';
  document.getElementById('div6').style.display ='none';
}
function show5(){
  document.getElementById('div1').style.display = 'none';
  document.getElementById('div2').style.display ='none';
  document.getElementById('div3').style.display ='none';
  document.getElementById('div4').style.display ='none';
  document.getElementById('div5').style.display ='block';
  document.getElementById('div6').style.display ='none';
}
function show6(){
  document.getElementById('div1').style.display = 'none';
  document.getElementById('div2').style.display ='none';
  document.getElementById('div3').style.display ='none';
  document.getElementById('div4').style.display ='none';
  document.getElementById('div5').style.display ='none';
  document.getElementById('div6').style.display ='block';
}
</script>
<?php
 /*Querying the database for tickets */
 mysql_select_db($database_PHPConn, $PHPConn);
 
if (isset($_POST['tab'])){
	$tab = $_POST['tab'];
	if ($tab == "ek")
	{
	$from= $_POST['from'];
	$to= $_POST['to'];	
echo "Search results by EK" ." ". $_POST['ek']."<br>";
$query_obc = "SELECT * FROM `e_wfhelpdeskentries` WHERE staffid LIKE '".$_POST['ek']."'  AND (submitDate BETWEEN '".$from."'AND '".$to."') ORDER BY submitDate DESC";
echo "<a href = \"https://ccintranet/index.php?option=com_content&task=view&Itemid=627&ek=".$_POST['ek'] . "&from=" .$from. "&to=".$to."\">Download Excel report</a><br>";
$result = mysql_query($query_obc);
	}
	if ($tab == "ticketid")
	{
	$from= $_POST['from'];
	$to= $_POST['to'];			
echo "Search results by Ticket ID" ." ". $_POST['ticketid']."<br>";
$query_obc = "SELECT * FROM `e_wfhelpdeskentries` WHERE idx LIKE '".$_POST['ticketid']."' AND (submitDate BETWEEN '".$from."'AND '".$to."')  ORDER BY submitDate DESC";
$result = mysql_query($query_obc);
	}
	if ($tab == "username")
	{
	$from= $_POST['from'];
	$to= $_POST['to'];			
echo "Search results by Username" ." ". $_POST['Username']."<br>";
$query_obc = "SELECT * FROM `e_wfhelpdeskentries` WHERE submitter LIKE '".$_POST['Username']."'AND (submitDate BETWEEN '".$from."'AND '".$to."')  ORDER BY submitDate DESC";
$result = mysql_query($query_obc);
echo "<a href = \"https://ccintranet/index.php?option=com_php&Itemid=627&username=".$_POST['username'] . "&from=" .$from. "&to=".$to."\">Download Excel report</a><br>";
	}
		if ($tab == "status")
	{
	$from= $_POST['from'];
	$to= $_POST['to'];	
echo "Search results by Status" ." " . $_POST['status']."<br>";
$query_obc = "SELECT * FROM `e_wfhelpdeskentries` WHERE wStatus LIKE '".$_POST['status']."' AND (submitDate BETWEEN '".$from."'AND '".$to."')ORDER BY submitDate DESC";
$result = mysql_query($query_obc);
echo "<a href = \"https://ccintranet/index.php?option=com_php&Itemid=627&username=".$_POST['status'] . "&from=" .$from. "&to=".$to."\">Download Excel report</a><br>";
	}
		if ($tab == "team")
	{
	$from= $_POST['from'];
	$to= $_POST['to'];	
echo "Search results by team " ." " . $_POST['team']."<br>";
$query_obc = "SELECT * FROM `e_wfhelpdeskentries` WHERE wfsegment LIKE '%".$_POST['team']."%' AND (submitDate BETWEEN '".$from."'AND '".$to."')ORDER BY submitDate DESC";
$result = mysql_query($query_obc);
echo "<a href = href = \"https://ccintranet/index.php?option=com_php&Itemid=627&username=".$_POST['team'] . "&from=" .$from. "&to=".$to."\">Download Excel report</a><br>";
	}
			if ($tab == "analystusername")
	{
	$from= $_POST['from'];
	$to= $_POST['to'];	
echo "Search results by Analyst " . $_POST['analystusername'];
$query_obc = "SELECT * FROM `e_wfhelpdeskentries` WHERE wfAnalyst1 LIKE '%".$_POST['analystusername']."%' AND (submitDate BETWEEN '".$from."'AND '".$to."')ORDER BY submitDate DESC";
$result = mysql_query($query_obc);
echo "<a href = \"https://ccintranet/index.php?option=com_php&Itemid=627&username=".$_POST['analystusername'] . "&from=" .$from. "&to=".$to."\">Download Excel report</a><br>";
	}
}
else{
	
	$query_obc = "SELECT * FROM `e_wfhelpdeskentries`  ORDER BY submitDate DESC";
	$result = mysql_query($query_obc);
	
	echo $result;
}
?>
<wf_p>Your Current role is Administrator </wf_p><br>
<wf_p>Below is a list of all recent requests :</wf_p><br>

<table style="width: 80%; height: 68px; text-align: left; margin-left: auto; margin-right: auto;" border="2" cellpadding="2" cellspacing="0">
<tbody>
<tr>
<th style="width: 114px;" class="wf_th">Ticket#</th>
<th style="width: 250px;" class="wf_th">Date</th>
<th style="width: 536px;" class="wf_th">Staff Name</th>
<th style="width: 114px;" class="wf_th">Staff ID</th>
<th style="width: 536px;" class="wf_th">Catgory</th>
<th style="width: 536px;" class="wf_th">Assigned to</th>
<th style="width: 147px;" class="wf_th">Status</th>
</tr>
<?php
while ($row_obc = mysql_fetch_assoc($result)) { ?>
          <tr>
			<td><?php echo($row_obc['idx']); ?></td>
            <td><?php echo($row_obc['submitDate']); ?></td>
			<td><?php echo($row_obc['submitterName']); ?></td>
            <td><?php echo($row_obc['staffid']); ?></td>
            <td><?php echo($row_obc['category']); ?></td> 
			<td><?php echo($row_obc['wfAnalyst1']); ?></td>
            <td><?php if(($row_obc['wStatus'])=='Closed'){ echo($row_obc['wStatus']);} else{?><a href="https://ccintranet/index.php?option=com_php&Itemid=618&ID=<?php echo($row_obc['idx']);?>" target="_blank"><?php echo($row_obc['wStatus']); ?></a><?php } ?></td>
			</tr>
			 <?php }  ?>
      </table>
</div>
</body></html>