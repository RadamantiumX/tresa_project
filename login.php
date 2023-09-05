<?php 
include_once('controller.php');
include('cors.php');

if(isset($_POST['email']) && isset($_POST['password']) ){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = userLogin($email,$password);
    
    echo json_encode($result);



}else{
    echo json_encode('Datos icompletos...');
}