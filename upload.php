<?php 
/**
 * Lobby from uploaded files & save into DB
 */

include_once('controller.php');
include('cors.php');


if (isset($_FILES['file']) && isset($_POST['selection'])) {
    $file = $_FILES['file'];
    $file_tmp = $file['tmp_name'];
    $select = $_POST['selection'];

    $result = store($file_tmp,$select);

    echo json_encode($result);
}else{
    echo json_encode("No hay archivos...");
}