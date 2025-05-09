<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in and Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    $show_signup = isset($_GET['form']) && $_GET['form'] == 'signup';
    ?>
    <div class="container" id="signup" style="display: <?php echo $show_signup ? 'block' : 'none'; ?>;">
        <h1 class="form-title">Register</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="fName" placeholder="First Name" required>
                <label for="fName">First name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lName" id="lName" placeholder="Last Name">
                <label for="lName">Last Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>
        <div class="links">
            <p>Already Have an Account?</p>
            <a href="index.php"><button id="signInButton">Sign In</button></a>
        </div>
    </div>

    <!-- (admin link) -->
    <div class="container" id="signIn" style="display: <?php echo !$show_signup ? 'block' : 'none'; ?>;">
        <h1 class="form-title">Sign In</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <p class="recover">
                <a href="#">Recover Password</a>
            </p>
            <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        <div class="links">
            <p>Don't have an account?</p>
            <a href="index.php?form=signup"><button id="signUpButton">Sign Up</button></a>
<div class="admin-access">
    <div class="divider">or</div>
    <a href="admin_login.php" class="admin-login-btn">
        <i class="fas fa-user-shield"></i> Admin Login
    </a>
</div>
        </div>
    </div>
</body>
</html>