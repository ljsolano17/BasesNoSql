<?php 

include 'connection.php';
//$elSQL = "doctor";
//$doctor="doctores"
//$myArray = getData(1,null,"doctores",null,null,null,null,null,null,null,null);
$myArray=findData(1,"doctores",0);
echo json_encode($myArray,JSON_UNESCAPED_UNICODE);

?>
