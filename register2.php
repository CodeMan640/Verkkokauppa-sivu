<?php
require 'tuotehaku.php'; // Ensure this file connects to your database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Securely hash the password

    // Prepare SQL query to insert new user
    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password); // Corrected to "ss"

    if ($stmt->execute()) {
        echo "Rekisteröinti onnistui!";
        // Redirect to login page
        header("Location: login.php");
        exit(); // Ensure the script stops after redirect
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

