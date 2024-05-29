<?php
// Start session
session_start();

// Include database connection file
require_once 'conn.php';

// Check if form is submitted
if (isset($_POST['update_member'])) {
    $member_id = $_POST['member_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $about = $_POST['about'];

    // Handle file upload
    $profile_picture = $_FILES['profile_picture']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($profile_picture);

    if ($profile_picture) {
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
            $sql = "UPDATE team_members SET firstname = ?, lastname = ?, position = ?, department = ?, about = ?, image_url = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $firstname, $lastname, $position, $department, $about, $target_file, $member_id);
        } else {
            die("Error: Unable to upload the profile picture.");
        }
    } else {
        $sql = "UPDATE team_members SET firstname = ?, lastname = ?, position = ?, department = ?, about = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $firstname, $lastname, $position, $department, $about, $member_id);
    }

    // Check if statement was prepared successfully
    if ($stmt) {
        // Execute the query
        if ($stmt->execute()) {
            // Redirect to home page after successful update
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
    die("Error: Form not submitted correctly.");
}

// Close database connection
$conn->close();
?>
