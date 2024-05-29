<?php
// Start session
session_start();

// Include database connection file
require_once 'conn.php';

// Check if the form is submitted
if (isset($_POST['add_member'])) {
    // Retrieve team member data from the form
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $about = $_POST['about'];
    $image_url = '';

    // Check if an image file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = basename($_FILES['image']['name']);
        $target_dir = 'uploads/';
        $target_file = $target_dir . $image_name;

        // Ensure the 'uploads' directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Create directory if it does not exist
        }

        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_url = $target_file;
        } else {
            die("Error: Unable to move uploaded file.");
        }
    }

    // Prepare SQL query
    $sql = "INSERT INTO team_members (firstname, lastname, position, department, about, image_url) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("ssssss", $firstname, $lastname, $position, $department, $about, $image_url);

        // Execute query
        if ($stmt->execute()) {
            // Redirect to home page after successful addition
            header("Location: home.php");
            exit();
        } else {
            die("Error: Unable to execute the query.");
        }

        // Close statement
        $stmt->close();
    } else {
        die("Error: Unable to prepare the SQL statement.");
    }
} else {
    die("Error: Form not submitted correctly.");
}

// Close database connection
$conn->close();
?>
