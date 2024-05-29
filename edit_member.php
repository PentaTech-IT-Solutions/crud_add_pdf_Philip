<?php
// Start session
session_start();

// Include database connection file
require_once 'conn.php';

// Check if member_id is provided
if (isset($_GET['member_id'])) {
    $member_id = $_GET['member_id'];

    // Fetch current details of the team member
    $sql = "SELECT * FROM team_members WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $member_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $member = $result->fetch_assoc();
    } else {
        die("Error: Member not found.");
    }

    // Close statement
    $stmt->close();
} else {
    die("Error: member_id not provided.");
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Team Member</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <div class="container">
        <div class="title">Edit Team Member</div>
        <div class="content">
            <form method="POST" action="edit_member_handler.php" enctype="multipart/form-data">
            <div class="user-details">
                <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
                
                <div class="input-box">
                    <span class="details">First Name</span>
                    <input type="text" name="firstname" value="<?php echo $member['firstname']; ?>" required>
                </div>
                
                <div class="input-box">
                    <span class="details">Last Name</span>
                    <input type="text" name="lastname" value="<?php echo $member['lastname']; ?>" required>
                </div>
                
                <div class="input-box">
                    <span class="details">Position</span>
                    <input type="text" name="position" value="<?php echo $member['position']; ?>" required>
                </div>
                
                <div class="input-box">
                    <span class="details">Department</span>
                    <input type="text" name="department" value="<?php echo $member['department']; ?>" required>
                </div>
                
                <div class="input-box">
                    <span class="details">About</span>
                    <textarea name="about" required><?php echo $member['about']; ?></textarea>
                </div>
                
                <div class="input-box">
                    <span class="details">Profile Picture</span>
                    <input type="file" name="profile_picture">
                    
                </div>

                <div>
                <img src="<?php echo $member['image_url']; ?>" alt="Current Profile Picture" width="150">
                </div>
               
            </div>
             
            <div class="button">
                    <input type="submit" value="Update" name="update_member">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
