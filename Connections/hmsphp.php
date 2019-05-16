<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_hmsphp = "localhost";
$database_hmsphp = "hms";
$username_hmsphp = "root";
$password_hmsphp = "";
$hmsphp = mysql_pconnect($hostname_hmsphp, $username_hmsphp, $password_hmsphp) or trigger_error(mysql_error(),E_USER_ERROR); 
?>