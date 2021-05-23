<?php


$db_server = "localhost";
$db_name = "labrary";
$db_user = "labrary";
$db_pass = "UJ4nwHAu[9d86yy!";

$conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

if($conn->connect_error) {
    exit('Error connecting to database');
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

?>