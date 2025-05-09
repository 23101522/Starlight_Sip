<?php require_once 'init.php'; ?>

<?php 
include 'db.php';

if(isset($_POST['signUp'])){
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

    // Check if email exists
    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);
    
    if($result->num_rows > 0){
        echo "Email Address Already Exists!";
    } else {
        // Modified INSERT query to exclude id (let it auto-increment)
        $insertQuery = "INSERT INTO users (firstName, lastName, email, password) 
                       VALUES (?, ?, ?, ?)";
        
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssss", $firstName, $lastName, $email, $password);
        
        if($stmt->execute()){
            header("Location: index.php");
            exit();
        } else {
            echo "Error: ".$conn->error;
        }
        $stmt->close();
    }
}

if(isset($_POST['signIn'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    // Check if this is an admin login attempt
    if(isset($_POST['is_admin']) && $_POST['is_admin'] == 'on') {
        header("Location: admin_login.php");
        exit();
    }
   
    $sql = "SELECT * FROM users WHERE email=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header("Location: homepage.php");
        exit();
    } else {
        echo "Not Found, Incorrect Email or Password";
    }
    $stmt->close();
}

$conn->close();
?>