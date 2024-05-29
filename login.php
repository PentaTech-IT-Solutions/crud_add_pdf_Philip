<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Responsive Registration Form | CodingLab</title>
    <link rel="stylesheet" href="./styles/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
      .input-box {
        width: 100% !important;
      }
      .container {
        max-width: 500px;
      }
      .user-details {
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }

      .error-message {
      color: red;
      font-size: 12px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="title">Login</div>
      <div class="content">
        <form method="POST" action="login_handler.php">
          <div class="user-details">
            <div class="input-box">
              <span class="details">Username</span>
              <input type="text" placeholder="Enter your username" id="username" name="username" required />
            </div>

            <div class="input-box">
              <span class="details">Password</span>
              <input type="password" placeholder="Enter your password" id="password" name="password" required />
            </div>
            <label id="error-message" class="error-message"><?php echo isset($_GET['error_message']) ? $_GET['error_message'] : ''; ?></label>
          </div>

          <div class="button">
            <input type="submit" value="Login" name="login"/>
          </div>
          <p>Dont have an accout? <a href="./signup.php">Signup</a></p>
        </form>
      </div>
    </div>
  </body>
</html>
