<?php

$host = 'localhost';
$user ="root";
$password = "";
$dbname = "perfume_schedule";

// FIXED: Changed $database to $dbname
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>