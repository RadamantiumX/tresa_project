<?php 
//include_once('cors.php');
include_once('controller.php');

$results_db = register('mail@example.com','user','abc123');

echo $results_db;