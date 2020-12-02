<?php
require 'vendor/autoload.php';


function Conectar($coleccion){
    $collection = (new MongoDB\Client)->clinica->$coleccion;
    return $collection;
}

function encontrarDoctor($id){
  $collection = Conectar("doctores");
  $cursor=$collection->find(['_id' => $id]);
  $rawdata=array();
  $i = 0;
  foreach ($cursor as $doctores) {
      
    $myJSON = $doctores['NOMBRE'];
    
    $rawdata[$i]=$myJSON;
    $i++;
   };
   return $rawdata;
}
function findData($accion,$coleccion,$pid){

if($coleccion=="paciente" && $accion==-1){

   
     $collection = Conectar($coleccion);
     $doctores=Conectar("doctores");
     $cursor = $collection->find();
     $cursor2 = $doctores->find();

     $rawdata=array();
     
     $i = 0;
    foreach ($cursor as $pacientes) {
      
      $myJSON = $pacientes;
      
      $rawdata[$i]=$myJSON;
      $i++;
     };
     foreach ($cursor2 as $doctores) {
      
      $myJSON = $doctores['NOMBRE'];
      
      $rawdata2[$i]=$myJSON;
      $i++;
     };


if(count($rawdata)<=0){
return [];
}else{
  for($x=0;$x<count($rawdata);$x++){

    if($rawdata[$x]['idDoctor']=="1"){
      $rawdata[$x]['idDoctor']=encontrarDoctor((int)$rawdata[$x]['idDoctor']);
    }else if($rawdata[$x]['idDoctor']=="2"){
      $rawdata[$x]['idDoctor']=encontrarDoctor((int)$rawdata[$x]['idDoctor']);
    }else if($rawdata[$x]['idDoctor']=="3"){
      $rawdata[$x]['idDoctor']=encontrarDoctor((int)$rawdata[$x]['idDoctor']);
    }
  }
}
   
     
    /////////////////////////////////////////////////////////////////////////
   // $cursor=([{$lookup:{from:$doctores,localField:$coleccion,foreignField:"_id",as:"idDoctor"}}])
   return $rawdata;

}else if($coleccion=="paciente" && $accion==1){
    $collection = Conectar($coleccion);
//db.paciente.aggregate([{$match:{id:3}},
//{$lookup:{from:"doctores",localField:"idDoctor",foreignField:"_id",as:"idDoctor"}}]).pretty()
$id=(int)$pid;   
$cursor = $collection->aggregate([['$match'=>["id"=>$id]],
      ['$lookup'=>[
        "from"=>"doctores",
        "localField"=>"idDoctor",
        "foreignField"=>"_id",
        "as"=>"idDoctor"
      ]]
      ]);
      $rawdata=null;
      $i = 0;
      foreach ($cursor as $paciente) {
       $myJSON = $paciente;
       $rawdata=$myJSON;
       $i++;
      };
       return $rawdata;
    /*$doctores=Conectar("doctores");
    $id=(int)$pid;
    $cursor=$collection->find(['id' => $id]);
    $cursor2 = $doctores->find();
    $rawdata=null;
    $i = 0;
    foreach ($cursor as $pacientes) {
        $myJSON = $pacientes;
        
        $rawdata=$myJSON;
        $i++;
       };
       foreach ($cursor2 as $doctores) {
      
        $myJSON = $doctores['NOMBRE'];
        
        $rawdata2[$i]=$myJSON;
        $i++;
       };
      

        if($rawdata['idDoctor']==1){
          $rawdata['idDoctor']=encontrarDoctor((int)$rawdata['idDoctor']);
        }else if($rawdata['idDoctor']==2){
          $rawdata['idDoctor']=encontrarDoctor((int)$rawdata['idDoctor']);
        }else if($rawdata['idDoctor']==3){
          $rawdata['idDoctor']=encontrarDoctor((int)$rawdata['idDoctor']);
        }
     
    return $rawdata;
*/
}else if($coleccion=="doctores"){
    $collection = Conectar($coleccion);
    $cursor = $collection->find();
    $rawdata=array();
    $i = 0;
    foreach ($cursor as $doctores) {
     $myJSON = $doctores;
     $rawdata[$i]=$myJSON;
     $i++;
    };
  return $rawdata;

}else if($coleccion=="farmacia" && $accion==-1){
  $collection = Conectar($coleccion);
    $cursor = $collection->find();
    $rawdata=array();
    $i = 0;
    foreach ($cursor as $medicinas) {
     $myJSON = $medicinas;
     $rawdata[$i]=$myJSON;
     $i++;
    };
   
  return $rawdata;
  }else if($coleccion=="farmacia" && $accion==1){
    $collection = Conectar($coleccion);
    $id=(int)$pid;
    $cursor=$collection->find(['id' => $id]);
    $rawdata=array();
    $i = 0;
    foreach ($cursor as $farmacia) {
     $myJSON = $farmacia;
     $rawdata[$i]=$myJSON;
     $i++;
    };
  return $rawdata;
}else if($coleccion=="sala" && $accion==1){
  $collection = Conectar($coleccion);
  $cursor = $collection->find();
  $rawdata=array();
  $i = 0;
  foreach ($cursor as $salas) {
   $myJSON = $salas;
   $rawdata[$i]=$myJSON;
   $i++;
  };
return $rawdata;
}else if($coleccion=="sala" && $accion==0){
  $collection = Conectar($coleccion);
  $id=(int)$pid;
  $cursor = $collection->find(['idSala' => $id]);
  $rawdata=array();
  $i = 0;
  foreach ($cursor as $salas) {
   $myJSON = $salas;
   $rawdata[$i]=$myJSON;
   $i++;
  };
return $rawdata;

}else if($coleccion=="medicinas"&& $accion==1){
  $collection = Conectar($coleccion);
  $idPaciente=(int)$pid;
  $cursor = $collection->find(['idPaciente' => $idPaciente]);
  $rawdata=array();
  $i=0;
  foreach ($cursor as $receta) {
    $myJSON = $receta;
    $rawdata[$i]=$myJSON;
    $i++;
   };
   return $rawdata;
}else if($coleccion=="medicinas" && $accion==-1){
  $collection = Conectar($coleccion);
  $farmacia = Conectar("farmacia");
  $cursor = $collection->find();
  $cursor_farmacia = $farmacia->find();


  $rawdata=array();
  $i = 0;
  foreach ($cursor as $medicinas) {
   $myJSON = $medicinas;
   $rawdata[$i]=$myJSON;
   $i++;
  };
  foreach ($cursor_farmacia as $farmacia) {
      
    $myJSON = $farmacia;
    
    $rawdata2[$i]=$myJSON;
    $i++;
   };
 
/*
if(count($rawdata)<=0){
  return [];
  }else{
    for($x=0;$x<count($rawdata);$x++){
      
      if($rawdata[$x]['receta']['c1']['id']==1){

  $rawdata[$x]['receta']['c1']['id']= $rawdata2[1]  ;

      }else if($rawdata[$x]['receta']['c2']['id']==2){

  $rawdata[$x]['receta']['c2']['id']= $rawdata2[2]  ;

      }else if($rawdata[$x]['receta']['c3']['id']==3){

 $rawdata[$x]['receta']['c3']['id']= $rawdata2[3]  ;

      }
   
    }
  }*/


return $rawdata;
}

}

    function InsertarCita($pnombrePaciente,$pcedula,$pcorreo,$pidDoctor,$pidSala,$pfecha,$phora,$pdescripcion){

   $collection=Conectar("paciente");
           
   $document = array( 
      
    "nombre" => $pnombrePaciente, 
    "cedula" => $pcedula, 
    "correo" => $pcorreo,
    "idDoctor" => $pidDoctor,
    "idSala" => $pidSala,
    "fecha" => $pfecha,
    "hora" => $phora,
    "descripcion" => $pdescripcion,
    "id"=>getPacienteCount()
 );
  
 $collection->insertOne($document);

            $response = "El paciente ha sido agregado satisfactoriamente";

            return $response;


    }

function insertarFactura($idPaciente,$idMedicamento,$user,$cantidad){

$collection=Conectar("factura");
     
$document = array( 

"idPaciente" => $idPaciente, 
"idMedicamento" => $idMedicamento, 
"usuario" => $user,
"cantidad" => $cantidad,
"precioConsulta" => 50000,
"id"=>getFacturaCount()
);

$collection->insertOne($document);

      $response = "La factura ha sido agregada satisfactoriamente";

     
      return $response;


}

function insertarReceta($idPaciente,$idMedicamento1,$cantidad,$comentario){
  $collection=Conectar("medicinas");
  $cursor=$collection->find(['idPaciente' => (int)$idPaciente]);
  $cursor2=$collection->find(['receta.idProducto' => (int)$idMedicamento1]);
  $rawdata2=array();
  $rawdata=array();
  $i = 0;
 foreach ($cursor as $medicina) {
   $myJSON = $medicina;
   $rawdata[$i]=$myJSON;
   $i++;
  };
  foreach ($cursor2 as $count) {
    $myJSON = $count;
    $rawdata2[$i]=$myJSON;
    $i++;
   };
  if(count($rawdata)>0){
    //lo que quiero hacer es que si un producto ya esta en los ids o sea que si el idProducto 1 ya esta hacer un update a la cantidad por la nueva
//print_r($rawdata);
//if(count($rawdata2)>0){
 // print($idMedicamento1);
  
 /* for($i=0;count($rawdata2[1]['receta']);$i++){

    if($idMedicamento1==$rawdata2[1]['receta'][0]['cantidad'][0]['cantidad']){
$a=$i;
}
  }*/
 // $a=$rawdata2[0]['receta'][0]['cantidad'][0]['cantidad'];
 // $a=0;
 // print(count($rawdata2[1]['receta']));
/*if(/*$rawdata2[1]['receta'][0]['idProducto']*//*1==1){
//echo ("...ddd.dd.d.d.d.d");
}*/
 /* $a=0;
 $collection->updateOne(array('idPaciente'=>(int)$idPaciente), array('$inc' => array('receta.'.$a.'.cantidad'=>(int)$cantidad)));
 */
 /*$collection->updateOne( 
  [ 'idPaciente' =>(int)$idPaciente ],
  [ '$push' => [ 
    'receta' => array(
      'prueba'=>$a
      )
  ]
  ]);*//*
}else{*/
    $updateResult=$collection->updateOne( 
      [ 'idPaciente' =>(int)$idPaciente ],
      [ '$push' => [ 
        'receta' => array(
          'idProducto'=>(int)$idMedicamento1,'cantidad'=>(int)$cantidad,'comentario'=>$comentario
          )
      ]
      ]);
      //  }
  }else {
  

    $document = array( 
      "id"=>getMedicinasCount(),
      "idPaciente" => (int)$idPaciente, 
      'receta' => array(
      array('idProducto'=>(int)$idMedicamento1,'cantidad'=>(int)$cantidad,'comentario'=>$comentario)
      ));
      $collection->insertOne($document);

    }
  }
      

  function getMedicinasCount(){
    
   
    $collection = Conectar("medicinas");
    
  
    $cursor = $collection->find();
    $rawdata=array();
    $i = 0;
    foreach ($cursor as $medicinas) {
     $myJSON = $medicinas;
     //  echo($myJSON);
     $rawdata[$i]=$myJSON;
     $i++;
    };
   
  return count($rawdata)+1;
  //
  }  

function getFacturaCount(){
    
   
  $collection = Conectar("factura");
  

  $cursor = $collection->find();
  $rawdata=array();
  $i = 0;
  foreach ($cursor as $pacientes) {
   $myJSON = $pacientes;
   //  echo($myJSON);
   $rawdata[$i]=$myJSON;
   $i++;
  };
 
return count($rawdata)+1;

}   
    function getPacienteCount(){
    
   
        $collection = Conectar("paciente");
        
    
        $cursor = $collection->find();
        $rawdata=array();
        $i = 0;
        foreach ($cursor as $pacientes) {
         $myJSON = $pacientes;
         //  echo($myJSON);
         $rawdata[$i]=$myJSON;
         $i++;
        };
       
      return count($rawdata)+1;
    //
    }

    function getPacienteCantidad(){
    
   
      $collection = Conectar("paciente");
     
  
      $cursor = $collection->find();
      $rawdata=array();
      $i = 0;
      foreach ($cursor as $pacientes) {
       $myJSON = $pacientes;
       //  echo($myJSON);
       $rawdata[$i]=$myJSON;
       $i++;
      };
     
    return count($rawdata);
  //
  }
   

function EliminaPaciente($pidCita){

$collection = (new MongoDB\Client)->clinica->paciente;
$collection2 = (new MongoDB\Client)->clinica->medicinas;
$idCita=(int)$pidCita;
$collection->deleteOne(['id' =>$idCita ]);
$collection2->deleteOne(['idPaciente' =>$idCita ]);
$response = "El paciente ha sido eliminado del sistema satisfactoriamente";
return $response;

}


function EliminaUsuario($pidUser){

  $collection =Conectar("users"); ;
  $idUser=(int)$pidUser;
  $collection->deleteOne(['idusuario' =>$idUser ]);
  $response = "El paciente ha sido eliminado del sistema satisfactoriamente";
  return $response;
  
  }




function actualizaDatos($pidCita,
$pnombrePaciente,$pcedula,$pcorreo,
$pidDoctor,$pfecha,$phora,$pdescripcion){
      print("id".$pidCita." nombre".
      $pnombrePaciente." cedula".$pcedula." correo".$pcorreo." iddoctor".
      $pidDoctor." fecha".$pfecha." hora".$phora." descrip".$pdescripcion);
    $response = "";
  
    

    $collection = Conectar("paciente");

    $updateResult=$collection->updateOne( 
    [ 'id' =>(int) $pidCita ],
    [ '$set' => [ 
    'nombre' => $pnombrePaciente,
    'cedula'=> $pcedula,
    'correo'=>$pcorreo,
    'idDoctor'=>(int)$pidDoctor,
    'fecha'=>$pfecha,
    'hora'=>(int)$phora,
    'descripcion'=>$pdescripcion,
    'id'=>(int)$pidCita
    ]
    ]);
    /*
printf("Matched %d document(s)\n", $updateResult->getMatchedCount());
printf("Modified %d document(s)\n", $updateResult->getModifiedCount());*/
    $response = "El paciente ha sido actualizado satisfactoriamente";
    

    return $response;

}

function insertUsers($nombre,$correo,$usuario,$contrasena){

  
           
   $collection=Conectar("users");
           //print(getPacienteCount());
   $document = array( 
    "user" => $usuario,
    "password" => $contrasena,
    "idusuario"=>getTotalUsers(-1),
    "email" => $correo,
    "nombre" => $nombre

 );
  
 $collection->insertOne($document);

            $response = true;

           
            return $response;

}

function getTotalUsers($accion){
  $collection = Conectar("users");
  $cursor = $collection->find();
      $rawdata=array();
      $i = 0;
      foreach ($cursor as $usuarios) {
       $myJSON = $usuarios;
       //  echo($myJSON);
       $rawdata[$i]=$myJSON;
       $i++;
      };
     if($accion==-1){
      return count($rawdata)+1;
     }else{
      return $rawdata;
     }
    //return count($rawdata)+1;
}

function getUserExist($user,$pass,$count){
    
   
  $collection = Conectar("users");
  
  
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

 }
  

//
}



function LookUp ($accion,$id){
 
 if($accion==1){
  $collection = Conectar("medicinas");
  //$farmacia = Conectar("farmacia");
  //$cursor = $collection->find();
  /*$cursor = $collection->aggregate([
['$lookup'=>[
  "from"=>"farmacia",
  "localField"=>"receta.idProducto",
  "foreignField"=>"id",
  "as"=>"datos"
]]
]);*/

$cursor = $collection->aggregate([['$match'=>["idPaciente"=>(int)$id]],
['$lookup'=>[
  "from"=>"farmacia",
  "localField"=>"receta.idProducto",
  "foreignField"=>"id",
  "as"=>"datos"
]]
    ]);

$rawdata=array();
$i = 0;
foreach ($cursor as $medicinas) {
 $myJSON = $medicinas;
 $rawdata[$i]=$myJSON;
 $i++;
};
 return $rawdata;

 }else if($accion==2){
$collection=Conectar("paciente");
//$collection=Conectar("medicinas");
//db.paciente.aggregate([{$lookup:{from:"doctores",localField:"idDoctor",foreignField:"_id",as:"idDoctor"}}])
$cursor = $collection->aggregate([
  ['$lookup'=>[
    "from"=>"doctores",
    "localField"=>"idDoctor",
    "foreignField"=>"_id",
    "as"=>"idDoctor"
  ]]
  ]);

/*
  $cursor = $collection->aggregate([['$match'=>["id"=>(int)$id]],
  ['$lookup'=>[
    "from"=>"doctores",
    "localField"=>"idDoctor",
    "foreignField"=>"_id",
    "as"=>"idDoctor"
  ]]
      ]);*/
  




  $rawdata=array();
  $i = 0;

 
  foreach ($cursor as $medicinas) {
   $myJSON = $medicinas;
   $rawdata[$i]=$myJSON;
   $i++;
  };
   return $rawdata;
  
 }

  
  //$cursor_farmacia = $farmacia->find();



}

function insertFactura($nombre,$correo,$usuario,$contrasena){

  
           
  $collection=Conectar("users");
          //print(getPacienteCount());
  $document = array( 
   "user" => $usuario,
   "password" => $contrasena,
   "idusuario"=>getTotalUsers(-1),
   "email" => $correo,
   "nombre" => $nombre

);
 
$collection->insertOne($document);

           $response = true;

          
           return $response;

}





