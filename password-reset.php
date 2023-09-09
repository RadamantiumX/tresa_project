<?php 
include_once('controller.php');
include('cors.php');

if(isset($_POST['password1']) && isset($_POST['password2'])){
   
    $password = $_POST['password1'];
    $email = $_POST['email'];

    $result = passwordReset($password,$email);

    echo json_encode($result);
}else{
    echo json_encode('datos incompletos');
}