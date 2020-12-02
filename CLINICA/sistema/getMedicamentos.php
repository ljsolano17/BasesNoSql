<?php 

include 'connection.php';
//$elSQL = "select * from vista_medicinas";

$myArray = findData(-1,"medicinas",null);
echo json_encode($myArray,JSON_UNESCAPED_UNICODE);

?>