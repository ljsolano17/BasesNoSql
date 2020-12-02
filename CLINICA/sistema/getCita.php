<?php 
$idCita = $_GET["idCita"];

include 'connection.php';
//$elSQL = $idCita ;

$myArray = findData(1,"paciente",$idCita);
echo json_encode($myArray,JSON_UNESCAPED_UNICODE);
?>