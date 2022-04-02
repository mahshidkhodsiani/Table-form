<?php

$servername = "localhost";
$username   = "root";
$dbname     = "mydb";

$conn = new mysqli($servername, $username, "", $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

