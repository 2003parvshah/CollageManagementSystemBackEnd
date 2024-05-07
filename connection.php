<?php

// Database connection parameters
$servername = "localhost";

// $username = "id22114337_root";
// $password = "20-11@Parv";
// $dbname = "id22114337_sdp";
$username = "root";
$password = "1256";
$dbname = "sdp";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
