<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jesse_projekti";

// Yhteys
$conn = new mysqli($servername, $username, $password, $dbname);

// Yhteyden testaus
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
