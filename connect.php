<?php

$host="localhost";
$user="root";
$pass="";
$db="coffee_shop";
$conn=new mysqli($host,$user,$pass, $db);
if($conn->connect_error){
    die("Connection failed". $conn->connect_error);
}
else{
    mysqli_select_db($conn, $db);
    echo "Connection Successful";
}
?>
<section class="menu" id="menu">
    <h1 class="heading">our <span>menu</span></h1>
    <div class="box-container">
        <div class="box">
            <img src="Images/Affogato.jpg" alt="">
        </div>
    </div>

</section>