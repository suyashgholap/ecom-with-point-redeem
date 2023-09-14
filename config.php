<?php
    session_start();
    $servername = "localhost";  //Database Server Address (DO NOT CHANGE IF NOT KNOWN)
    $username = "root"; //Database Server Username (DO NOT CHANGE IF NOT KNOWN)
    $password = ""; //Database Server Password (DO NOT CHANGE IF NOT KNOWN)
    $dbname = "pranjal"; //Database Server Database (DO NOT CHANGE IF NOT KNOWN)
    error_reporting(0);
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>