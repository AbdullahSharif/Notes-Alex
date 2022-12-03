<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "notesaxel";

    $connection = mysqli_connect($serverName, $userName, $password, $database);

    if(!$connection){
        echo"Not Connected!";
    }
?>