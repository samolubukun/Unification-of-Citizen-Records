<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ncrup";

    //create connection
    $connection = new mysqli($servername, $username, $password, $database);

    // Check connection
    if (!$connection) {
        die("Connection Failed: ". mysqli_error($connection));
    }

    
?>