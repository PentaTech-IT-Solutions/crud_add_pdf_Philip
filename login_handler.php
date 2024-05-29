<?php
// Start session
session_start();

// Include database connection file
require_once "conn.php";

// Initialize an empty errors array
$errors = array();

// Check if the form is submitted
if (isset($_POST['login'])) {
    // Retrieve user credentials from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query the database to fetch user data based on the provided username/email
    $sql = "SELECT * FROM users WHERE username = ? OR password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute(); 
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the provided password against the hashed password stored in the database
        if (password_verify($password . $user['salt'], $user['password'])) {
            // Password is correct, set up a session to keep the user logged in
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            // Redirect to the appropriate page after login
            header("Location: home.php");
            exit();
        } else {
            // Password is incorrect
            $error_params = http_build_query(['error_message' => "Wrong username or password."]);
            header("Location: login.php?$error_params");
            exit();
        }
    } else {
        // User not found
        $error_params = http_build_query(['error_message' => "User not found."]);
        header("Location: login.php?$error_params");
        exit();
    }

    // Close statement
    $stmt->close();
}

?>
