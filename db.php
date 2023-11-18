<?php

    // Database connection parameters
    $servername = "127.0.0.1";
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "task_LCIC";
    $port = "3306";

    // Create connection
    // $conn = new mysqli($servername, $username, $password, $dbname, $port);
    try {
        $conn = new PDO("mysql:host={$servername}; dbname={$dbname}", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        $e->getMessage();
    }

?>