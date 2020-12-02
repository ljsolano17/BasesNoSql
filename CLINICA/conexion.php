<?php
require 'sistema/vendor/autoload.php';


      
function getUserCount($user,$pass,$count){
    
   
  $collection = (new MongoDB\Client)->clinica->users;
  
  
  $cursor = $collection->findOne(['user' => $user,'password'=>$pass]);
 if($cursor==null){
return 0;
 }else{
  $rawdata=array();
  $i = 0;
  foreach ($cursor as $pacientes) {
   $myJSON = $pacientes;
   //  echo($myJSON);
   $rawdata[$i]=$myJSON;
   $i++;
  };
 }
 if($count==1){
  return count($rawdata);

 }else if($count==0){
  //$someArray = json_encode($rawdata, false);
  return $rawdata;
 }
  

//
}
 

?>