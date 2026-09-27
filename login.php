<?php
session_start();
include 'db.php';

$error = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT id, password FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: register.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>AyuMatrix Login</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #4b7bec, #20bf6b);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-box {
      background: #fff;
      width: 380px;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.2);
      text-align: center;
    }

    .logo {
      font-size: 26px;
      font-weight: bold;
      color: #4b7bec;
    }

    .tagline {
      font-size: 14px;
      color: #666;
      margin-bottom: 25px;
    }

    h2 {
      margin-bottom: 5px;
    }

    p {
      color: #777;
      font-size: 14px;
      margin-bottom: 20px;
    }

    input {
      width: 100%;
      padding: 12px;
      margin-top: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
    }

    button {
      width: 100%;
      padding: 12px;
      margin-top: 20px;
      border: none;
      border-radius: 8px;
      background: #4b7bec;
      color: white;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background: #3867d6;
    }

    .links {
      margin-top: 15px;
      font-size: 13px;
    }

    .links a {
      color: #4b7bec;
      text-decoration: none;
      margin: 0 5px;
    }

    .error {
      color: red;
      margin-top: 10px;
      font-size: 14px;
    }
  </style>
</head>

<body>

<div class="login-box">
  <div class="logo">AyuMatrix</div>
  <div class="tagline">Tech Driven Life Grid</div>

  <h2>Welcome Back</h2>
  <p>Sign in to continue to your safety dashboard</p>

  <form method="post">
    <input type="email" name="email" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button name="login">Login</button>
  </form>

  <div class="error"><?= $error ?></div>

  <div class="links">
    <a href="register.php">Create New Account</a> |
    <a href="#">Forgot Password</a>

  </div>
</div>

</body>
</html>
