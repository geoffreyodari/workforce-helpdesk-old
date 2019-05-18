<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head><title>Workforce Helpdesk</title>
<?php 

require_once('Connections/PHPConn.php'); 

 $user =& JFactory::getUser();
 $fullname = $user->name;
 $alias = $user->get('username'); 

/*get Support*/ 
mysql_select_db($database_PHPConn, $PHPConn); 
$query_wfSup= "SELECT * FROM `e_wfhelpdesk_admins` ORDER BY USERNAME"; 
$rs_wfSup = mysql_query($query_wfSup, $PHPConn) or die(mysql_error()); 
$row_wfSup = mysql_fetch_assoc($rs_wfSup); $totalRows_wfSup = mysql_num_rows($rs_wfSup); 
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
Hi <?php echo  $fullname; ?>  !</div>
<div id="wf_header"><a href="https://ccintranet/index.php?option=com_php&Itemid=613" class="wf_links">Home</a>
<a href="" class="wf_links2">View/Edit Support
Analysts</a> <a href="https://ccintranet/index.php?option=com_php&Itemid=614" class="wf_links">Add Support
Analyst</a>
<a href="https://ccintranet/index.php?option=com_php&Itemid=616" class="wf_links">View Queries</a></div>
<div id="wf_body">
<table style="text-align: left; width: 986px; height: 58px;"
 border="0" cellpadding="2" cellspacing="2" align="center">
  <tbody>
    <tr>
      <th>Name</th>
      <th>Role</th>
    </tr>
	<?php do {  ?>
    <tr>
     
	<td><a href="https://ccintranet/index.php?option=com_php&Itemid=615&support=<?php echo $row_wfSup['USERNAME']; ?>" ><?php echo $row_wfSup['NAME']; ?></a></td>
      <td><?php echo $row_wfSup['ROLE']; ?></td>
    </tr>
<?php }while ($row_wfSup = mysql_fetch_assoc($rs_wfSup)); ?>
 </tbody>
</table>
</div>
</body></html>
