<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Team Member</title>
  <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
  <div class="container">
    <div class="title">Add Team Member</div>
    <div class="content">
      <form method="POST" action="add_member_handler.php" enctype="multipart/form-data">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" name="firstname" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" name="lastname" required>
          </div>
          <div class="input-box">
            <span class="details">Position</span>
            <input type="text" name="position" required>
          </div>
          <div class="input-box">
            <span class="details">Department</span>
            <input type="text" name="department" required>
          </div>
          <div class="input-box">
            <span class="details">About</span>
            <textarea  name="about" required></textarea>
          </div>
          <div class="input-box">
            <span class="details">Profile Picture</span>
            <input type="file" name="image" required>
          </div>
        </div>
        <div class="button">
          <input type="submit" name="add_member" value="Add Member">
        </div>
      </form>
    </div>
  </div>
</body>
</html>
