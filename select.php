<?php 
/**
 * Select Data from DB
 */
include_once('cors.php');
include_once('controller.php');

$results_db = index();

echo json_encode($results_db);
