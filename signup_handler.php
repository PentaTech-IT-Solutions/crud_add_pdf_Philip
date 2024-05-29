<?php
// Include database connection file
require_once "conn.php";

// Initialize an empty errors array
$errors = array();

// Check if the form is submitted
if (isset($_POST['register'])) {
    // Retrieve user data from the form
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $username = $_POST["username"];
    $phone = $_POST["phone"];
    $confirm_password = $_POST["confirm_password"];

    // Generate a random salt
    $salt = bin2hex(random_bytes(16)); // Generate a 16-byte salt (128 bits)

    // Append the salt to the password and hash it
    $hashed_password = password_hash($password . $salt, PASSWORD_DEFAULT);

    // Validate full name
   // if (!empty($fullname) && !preg_match("/^[a-zA-Z]+$/", $fullname)) {
    //$errors['fullname'] = "Full name can only contain alphabets";
    //}

    // Validate username
    if (empty($username)) {
        $errors['username'] = "Username is required";
    } elseif (!preg_match("/^[a-zA-Z0-9_]{4,}$/", $username)) {
        $errors['username'] = "Username must be alphanumeric and at least 4 characters long";
    }

    // Validate email
    //if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
     //   $errors['email'] = "Valid email is required";
   // }

   // Validate email
    if (!empty($email) && !preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $email)) {
    $errors['email'] = "Invalid email format";
    }


    // Validate password
    if (empty($password) || strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters long";
    }

    // Confirm password match
    if ($password != $confirm_password) {
        $errors['confirm_password'] = "Password does not match";
    }

    // Validate phone number
    if (!empty($phone) && !preg_match("/^[0-9+]+$/", $phone)) {
    $errors['phone'] = "Phone number can only contain numbers and the plus sign (+)";
    }

    // If there are no validation errors, proceed with registration
    if (empty($errors)) {
        // Insert user data into the database along with the salt
        $sql = "INSERT INTO users (fullname, email, salt, password, username, phone) 
        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $fullname, $email, $salt, $hashed_password, $username, $phone);

        if ($stmt->execute()) {
            // Registration successful
            header("Location: login.php");
            exit();
        } else {
            // Registration failed
            $error['database_error'] = "Registration failed. Please try again later.";
        }
        // Close statement
        $stmt->close();
    } else {
        // If there are validation errors, pass them back to the signup.php page
        // You can use session or URL parameters to pass the errors back
        // For simplicity, let's pass them as URL parameters
        $error_params = http_build_query($errors);
        header("Location: signup.php?$error_params");
        exit();
    }
}
?>
