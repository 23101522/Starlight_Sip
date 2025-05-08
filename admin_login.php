<?php
session_start();
$ad_user="manager";
$ad_pass="1234";
if ($_SERVER["REQUEST_METHOD"]=="POST")
    {$username=$_POST['username'];
     $password=$_POST["password"];
    if ($username==$ad_user && $password==$ad_pass)
        {$_SESSION["admin_logged_in"]=true;
        header("Location: admin_panel.php");
        exit();}
    else {$error='Invalid login!';}}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <style>
    .form-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 50px;
    }
    input {
      padding: 10px;
      width: 200px;
    }
    input[type="submit"] {
      cursor: pointer;
      background-color: #d4a373;
      border: none;
      color: white;
      font-weight: bold;
      transition: background-color 0.3s;
    }
    input[type="submit"]:hover {
      background-color: #b07545;
    }
  </style>
</head>
<body>
  <h2 align="center">Admin Login</h2>

  <?php if (isset($error)) { echo "<p style='color:red; text-align:center;'>$error</p>"; } ?>

  <form method="POST">
    <div class="form-container">
      <input type="text" name="username" placeholder="Username" required><br><br>
      <input type="password" name="password" placeholder="Password" required><br><br>
      <input type="submit" value="Login"><br><br>
    </div>
  </form>
</body>
</html>

