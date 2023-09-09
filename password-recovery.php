<?php 
include_once('controller.php');
include('cors.php');

if(isset($_POST['email'])){
   
    $email = $_POST['email'];

    $result = passwordRecovery($email);

    echo json_encode($result);
}else{
    echo json_encode('datos incompletos');
}