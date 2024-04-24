<?php
session_start();
include 'db_connection.php'; // Use a separate file to handle DB connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update is_logged_in status to 0 for the logged-out user
if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $update_sql = "UPDATE users SET is_logged_in = 0 WHERE email = '$email'";
    if ($conn->query($update_sql) === TRUE) {
        // Destroy the session data
        unset($_SESSION['email']);
        session_destroy();
        header("Location: index.html");
        exit();
    } else {
	   

        echo "Error updating record: " . $conn->error;
    }
}
header("Location: index.html");
$conn->close();
?>
