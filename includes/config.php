<?php 
    ob_start();

    session_start(); // keep track of user logged in 

    $timezone = date_default_timezone_set("America/Toronto");

    $con = mysqli_connect("localhost", "root", "", "Authentication"); // connection to the db 

    if(mysqli_connect_errno()){
        echo "Failed to Connect: " . mysqli_connect_errno();
    }

?>