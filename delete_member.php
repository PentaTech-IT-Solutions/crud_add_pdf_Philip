<?php
// Start session
session_start();

// Include database connection file
require_once 'conn.php';

// Check if the member_id is provided
if (isset($_GET['id'])) {
    $member_id = $_GET['id'];

    // Prepare the SQL delete query
    $sql = "DELETE FROM team_members WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("i", $member_id);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to home page after successful deletion
            header("Location: home.php");
            exit();
        } else {
            // Log error and provide user feedback
            error_log("Error executing query: " . $stmt->error);
            die("Error: Unable to execute the query.");
        }

        // Close statement
        $stmt->close();
    } else {
        // Log error and provide user feedback
        error_log("Error preparing query: " . $conn->error);
        die("Error: Unable to prepare the SQL statement.");
    }
} else {
    die("Error: member_id not provided.");
}

// Close database connection
$conn->close();
?>
