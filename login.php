<?php
include("db.php");
session_start();

$error = "";

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($conn,
        "SELECT * FROM users WHERE username='$username'");

    if(mysqli_num_rows($result) == 1){

        $row = mysqli_fetch_assoc($result);

        if(password_verify($password,$row['password'])){

            // ✅ Set proper session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];

            header("Location: dashboard.php");
            exit();

        }else{
            $error = "Wrong Password ❌";
        }

    }else{
        $error = "User not found ❌";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="login-wrapper">
    <div class="login-box">
        <a href="#" class="auth-brand d-flex justify-content-center mb-3">
           <img src="https://erp.mmumullana.org/assets/assets1/images/logo.webp" alt="dark logo" width="100%" class="logo-dark">                    
        </a>
        <h4 class="fw-semibold mb-1 fs-28 text-start">Welcome Back</h4>
        <h4 class="fw-normal mb-3 fs-16 text-start">Log in to your account</h4>

      <form id="loginForm" method="POST">
  
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required>

          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>

          <button type="submit" name="login">Login</button>

          <p class="signup-text">
            Don’t have an account?
            <a href="register.php">Register</a>
          </p>
          <p style="margin-top:10px;">
            <a href="forgot_password.php">Forgot Password?</a>
          </p>
      </form>

      <?php if (!empty($error)) { ?>
          <p style="color:red;"><?= $error ?></p>
      <?php } ?>

    </div>
  </div>
</body>
</html>
