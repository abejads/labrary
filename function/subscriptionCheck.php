<?php
    session_start();
    session_regenerate_id();
    if(!isset($_SESSION["uid"])){
        header("Location: ../login.php");
        die();
    }
?>