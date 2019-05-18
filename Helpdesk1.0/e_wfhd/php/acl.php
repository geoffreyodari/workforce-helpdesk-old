<?php


//to check whether user is part of support team
//$check_if_support="SELECT FROM e_wfhelpdesk_admins where wfusername ='".$user->username."'";

require_once('Connections/PHPConn.php');
$conn = new mysqli($hostname_PHPConn,$username_PHPConn,$password_PHPConn,$database_PHPConn); 

//get user details from joomla jFactory
//$user =& JFactory::getUser();
//user's full name
$user_name ="Geoffrey Ochenge"; //$user->name;
//users name 
$user_username ="gochenge";//$user->username;

$check_if_support="SELECT * FROM e_wfhelpdesk_admins where wfusername='" . $user_username . "'";

$result_if_support=$conn->query($check_if_support);

if ($result_if_support->num_rows == 0){
	
	echo "<script type=\"text/javascript\">
         <!--
				alert(\"Welcome ".$user_name." to the helpdesk !\");
                window.location=\"". $agent_raise_ticket."\";
            
         //-->
      </script>";

}
else
{
echo  "<script type=\"text/javascript\"> 
		<!--
			alert(\"Welcome ".$user_name." to the support page\"); 
			window.location=\"".$support_home."\";
		//-->
	</script>";

}
?>




