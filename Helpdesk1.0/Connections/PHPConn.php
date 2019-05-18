<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_PHPConn = "localhost";
$database_PHPConn = "CMINTRANET";
$username_PHPConn = "cmintranet";
$password_PHPConn = "";
$PHPConn = mysql_pconnect($hostname_PHPConn, $username_PHPConn, $password_PHPConn) or trigger_error(mysql_error(),E_USER_ERROR); 
?>