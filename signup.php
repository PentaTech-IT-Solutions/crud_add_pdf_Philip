<?php
$error_message = "";
$fullname_error = "";
$username_error = "";
$password_error = "";
$conf_pass_error = "";
$phone_error = "";
$email_error = "";
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <title>Responsive Registration Form | CodingLab</title>
  <link rel="stylesheet" href="./styles/style.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    .error-message {
      color: red;
      font-size: 12px;
    }

    .password-message {
      color: red; /* Default color for weak password */
    }
    .strong-password {
      color: green; /* Color for strong password */
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form method="POST" action="signup_handler.php">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" placeholder="Enter your name" name="fullname" required />
            <label id="fullname-error" class="error-message"><?php echo isset($_GET['fullname']) ? $_GET['fullname'] : ''; ?></label>
           
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" placeholder="Enter your username" name="username" required />
            <label id="username-error" class="error-message"><?php echo isset($_GET['username']) ? $_GET['username'] : ''; ?></label>

          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" placeholder="Enter your email" name="email" required />
            <label id="email-error" class="error-message"><?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?></label>

          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your number" name="phone" required />
            <label id="phone-error" class="error-message"><?php echo isset($_GET['phone']) ? $_GET['phone'] : ''; ?></label>

          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" placeholder="Enter your password" id="password" name="password" required />
            <label id="password-message" class="password-message"></label>
            <label id="password-error" class="error-message"><?php echo isset($_GET['password']) ? $_GET['password'] : ''; ?></label>

          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" placeholder="Confirm your password" name="confirm_password" required />
            <label id="confirm_password-error" class="error-message"><?php echo isset($_GET['confirm_password']) ? $_GET['confirm_password'] : ''; ?></label>


          </div>
        </div>

        <div class="button">
          <input type="submit" value="Register" name="register">
        </div>

          <!-- Display errors -->
  <?php if (!empty($errors)): ?>
    <div class="error-message">
      <?php foreach ($errors as $error): ?>
        <label><?php echo $error; ?></label>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

        <p>Don't have an account? <a href="./login.php">Sign In</a></p>
        <label id="database_error" class="error-message"><?php echo isset($_GET['database_error']) ? $_GET['database_error'] : ''; ?></label>


      </form>
    </div>
  </div>

  <script>
    // Function to update password strength message and color
    function updatePasswordStrength() {
      var passwordInput = document.getElementById('password');
      var passwordMessage = document.getElementById('password-message');
      //when password is greater and equal to 6
      if (passwordInput.value.length >= 6) {
        passwordMessage.textContent = 'Strong password';
        passwordMessage.classList.remove('password-message'); // Remove default class
        passwordMessage.classList.add('strong-password'); // Add class for strong password

        //when password is greater and equal to 10
        if(passwordInput.value.length >= 10){
        passwordMessage.textContent = 'Very Strong password';
        passwordMessage.classList.remove('password-message'); // Remove default class
        passwordMessage.classList.add('strong-password'); // Add class for strong password
      }
        
      }
       
      else {
        passwordMessage.textContent = 'Weak password';
        passwordMessage.classList.remove('strong-password'); // Remove class for strong password
        passwordMessage.classList.add('password-message'); // Add default class
      }
    }

    // Add event listener for key press events
    document.getElementById('password').addEventListener('input', updatePasswordStrength);
  </script>
  
</body>
</html>






