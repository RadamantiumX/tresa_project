<?php 
$dominioPermitido = "http://localhost:5173/";
header("Access-Control-Allow-Origin: *"); // Permitir acceso desde cualquier origen (esto puede ser ajustado según tu necesidad)
header("Content-Type: application/json; charset=UTF-8"); // Ajustar el tipo de contenido según corresponda
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE"); // Especificar los métodos permitidos
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
