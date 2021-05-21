<?php


$db_server = "localhost";
$db_name = "labrarym_1";
$db_user = "labrarym_1";
$db_pass = "iiYvDGwoS(#@";

$conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

if($conn->connect_error) {
    exit('Error connecting to database');
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

?>