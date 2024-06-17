<?php
// Include necessary files and configurations
include('db_config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $_POST['username'];
    $passwordEntered = $_POST['password'];

    // Establish a database connection
    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPasswordFromDatabase = $row['password'];

        // Verify the entered password
        if (password_verify($passwordEntered, $storedPasswordFromDatabase)) {
            // Login successful
            $_SESSION['username'] = $username; // Store username in session
            header("Location: user_dashboard.php");
            exit();
        } else {
            // Incorrect password
            echo "Incorrect password";
        }
    } else {
        // User not found
        echo "User not found";
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>
