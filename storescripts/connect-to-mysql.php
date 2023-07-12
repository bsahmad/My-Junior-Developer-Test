<?php
// credentials for the offline database
$db_host = "localhost";
$db_username = "root";
$db_pass = "";
$db_name = "id18818745_scandiweb";
// credentials for the online database
// $db_host = "localhost";
// $db_username = "u3rtaxnr3zrmg";
// $db_pass = "j1xgfngsbqzp";
// $db_name = "dbsdeg4mkwfau5";
// Running actual connection
$con = mysqli_connect($db_host, $db_username, $db_pass) or die("could not connect to mysql");
mysqli_select_db($con, $db_name) or die("no databse");
