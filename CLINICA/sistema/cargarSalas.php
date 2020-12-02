<?php 
$idCita = $_GET["idSala"];

include 'connection.php';

$myArray=findData(1,"sala",$idCita);
echo json_encode($myArray,JSON_UNESCAPED_UNICODE);



/*
$myArray = findData(1,"paciente",$idCita);
echo json_encode($myArray,JSON_UNESCAPED_UNICODE);*/
?>