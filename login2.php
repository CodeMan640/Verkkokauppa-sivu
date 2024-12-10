<?php
require 'tuotehaku.php'; // Ensure this file connects to your database
require 'session_start.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL query to fetch user details
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Start session and set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            // Set a session variable to show the notification
            $_SESSION['login_success'] = true;
            // Redirect to the homepage or dashboard
            header("Location: index.php");
            exit();
        } else {
            echo "Väärä salasana.";
        }
    } else {
        echo "Käyttäjää ei löytynyt tällä sähköpostilla.";
    }
}
?>

