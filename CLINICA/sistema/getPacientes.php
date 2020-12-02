<?php
include 'connection.php';

$myArray = findData(-1,"paciente",0);
//$myArray=LookUp(2);
echo json_encode($myArray,JSON_UNESCAPED_UNICODE);
?>


