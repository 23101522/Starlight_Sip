<?php

$host="localhost";
$user="root";
$pass="";
$db="starlight_sip";
$conn=new mysqli($host,$user,$pass, $db);
if($conn->connect_error){
    die("Connection failed". $conn->connect_error);
}
?>
<section class="menu" id="menu">
    <div class="box-container">
        <div class="box">
            <img src="Images/Affogato.jpg" alt="">
        </div>
    </div>

</section>