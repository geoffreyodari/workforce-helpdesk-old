<?php
# #FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_DBConn = "localhost";
$database_DBConn = "CMINTRANET";
$username_DBConn = "cmintranet";
$password_DBConn = "";
$DBConn = mysql_pconnect($hostname_DBConn, $username_DBConn, $password_DBConn) or trigger_error(mysql_error(),E_USER_ERROR); 
?>

<?php  //being used by GRAPHS !DO NOT DELETE!

// In this page, we open the connection to the Database
// In this page, we open the connection to the Database
// Our MySQL database (blueprintdb) for the Blueprint Application
// Function to connect to the DB
// Now you can pass the database name to the function
function connectToDB( $dbName="" ) {
    // These four parameters must be changed dependent on your MySQL settings
    $hostdb = 'localhost';   // MySQl host
    $userdb = 'cmintranet';    // MySQL username
    $passdb = '';    // MySQL password
    $namedb =  $dbName ? $dbName : 'CMINTRANET'; // MySQL database name

  	$link = mysql_connect ($hostdb, $userdb, $passdb);
		
    if (!$link) {
        // we should have connected, but if any of the above parameters
        // are incorrect or we can't access the DB for some reason,
        // then we will stop execution here
        die('Could not connect: ' . mysql_error());
    }

    $db_selected = mysql_select_db($namedb);
    if (!$db_selected) {
        die ('Can\'t use database : ' . mysql_error());
    }
    return $link;
}
?>