<?php
require 'vendor/autoload.php';


function Conectar($coleccion){
  try{
    $collection = (new MongoDB\Client)->clinica->$coleccion;
    return $collection;

  }catch(Exception $e){

    guardarExceptions($e);
  
  }
}

function encontrarDoctor($id){
  try{
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

  }catch(Exception $e){

    guardarExceptions($e);
  
  }

}



function findData($accion,$coleccion,$pid){
  try{



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

 return $rawdata;

}else if($coleccion=="paciente" && $accion==1){
    $collection = Conectar($coleccion);
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
  $id=$pid;
  $cursor = $collection->find(['_id_sala' => $id]);
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
 

return $rawdata;
}
}catch(Exception $e){

  guardarExceptions($e);

}
}

function InsertarCita($pnombrePaciente,$pcedula,$pcorreo,$pidDoctor,$pidSala,$pfecha,$phora,$pdescripcion){
 try{
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
    "Estado"=>"Pendiente",
    "id"=>getPacienteCount()
 );
  
  $collection->insertOne($document);

  $response = "El paciente ha sido agregado satisfactoriamente";

  return $response;

  }catch(Exception $e){

    guardarExceptions($e);
        
  }
}

function insertarFactura($idPaciente,$idMedicamento,$user,$cantidad){
try{
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

    }catch(Exception $e){

      guardarExceptions($e);
  
    }
}

function insertarReceta($idPaciente,$idMedicamento1,$cantidad,$comentario){
  try{
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
   
    $updateResult=$collection->updateOne( 
      [ 'idPaciente' =>(int)$idPaciente ],
      [ '$push' => [ 
        'receta' => array(
          'idProducto'=>(int)$idMedicamento1,'cantidad'=>(int)$cantidad,'comentario'=>$comentario
          )
      ]
      ]);
     
  }else {
  

    $document = array( 
      "id"=>getMedicinasCount(),
      "idPaciente" => (int)$idPaciente, 
      'receta' => array(
      array('idProducto'=>(int)$idMedicamento1,'cantidad'=>(int)$cantidad,'comentario'=>$comentario)
      ));
      $collection->insertOne($document);

    }


  }catch(Exception $e){

    guardarExceptions($e);

  }
  }
      
function getMedicinasCount(){
 try{

    
   
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

}catch(Exception $e){

  guardarExceptions($e);

  }

}  

function getFacturaCount(){

try{
   
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

}catch(Exception $e){

  guardarExceptions($e);

}
}  

function getPacienteCount(){
    
   try{
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

    }catch(Exception $e){

      guardarExceptions($e);
  
    }
  }

function getPacienteCantidad(){
    
   try{
      $collection = Conectar("paciente");
     
  
      $cursor = $collection->find();
      $rawdata=array();
      $i = 0;
      foreach ($cursor as $pacientes) {
       $myJSON = $pacientes;
       $rawdata[$i]=$myJSON;
       $i++;
      };
    return count($rawdata);

  }catch(Exception $e){

    guardarExceptions($e);

  }
}
   

function EliminaPaciente($pidCita){
try{
$collection = (new MongoDB\Client)->clinica->paciente;
$collection2 = (new MongoDB\Client)->clinica->medicinas;
$idCita=(int)$pidCita;
$collection->deleteOne(['id' =>$idCita ]);
$collection2->deleteOne(['idPaciente' =>$idCita ]);
$response = "El paciente ha sido eliminado del sistema satisfactoriamente";
return $response;

}catch(Exception $e){

  guardarExceptions($e);

}
}


function EliminaUsuario($pidUser){
try{
  $collection =Conectar("users"); ;
  $idUser=(int)$pidUser;
  $collection->deleteOne(['idusuario' =>$idUser ]);
  $response = "El paciente ha sido eliminado del sistema satisfactoriamente";
  return $response;
}catch(Exception $e){

  guardarExceptions($e);

}                      
  }




function actualizaDatos($pidCita,$pnombrePaciente,$pcedula,$pcorreo,$pidDoctor,$pfecha,$phora,$pdescripcion){
  try{
  
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

    $response = "El paciente ha sido actualizado satisfactoriamente";
    return $response;

  }catch(Exception $e){

    guardarExceptions($e);

 }
}

function insertUsers($nombre,$correo,$usuario,$contrasena){
try{
  
           
   $collection=Conectar("users");
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


  }catch(Exception $e){
    guardarExceptions($e);
  }
}

function getTotalUsers($accion){
  try{
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
    }catch(Exception $e){
      guardarExceptions($e);
   }
}

function getUserExist($user,$pass,$count){
    
  try{

 
  $collection = Conectar("users");
  
  $cursor = $collection->findOne(['user' => $user,'password'=>$pass]);

 if($cursor==null){

   return 0;

 }else{

  $rawdata=array();
  $i = 0;
  foreach ($cursor as $pacientes) 
   {
   $myJSON = $pacientes;
  
     $rawdata[$i]=$myJSON;
     $i++;
    };
  }
   if($count==1)
  {
     return count($rawdata);

  }
  
}catch(Exception $e){
  guardarExceptions($e);
}

}



function LookUp ($accion,$id){
 try{
 if($accion==1){
   $collection = Conectar("medicinas");
 
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
  foreach ($cursor as $medicinas) 
  {
     $myJSON = $medicinas;
     $rawdata[$i]=$myJSON;
     $i++;
  };
 return $rawdata;

 }else if($accion==2){
 $collection=Conectar("paciente");

 $cursor = $collection->aggregate([
   ['$lookup'=>[
    "from"=>"doctores",
    "localField"=>"idDoctor",
    "foreignField"=>"_id",
    "as"=>"idDoctor"
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
  
  }

}catch(Exception $e){
  guardarExceptions($e);
}

}

function insertFactura($nombre,$correo,$usuario,$contrasena){

  try{
      
    $collection=Conectar("users");
          
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


  }catch(Exception $e){
     guardarExceptions($e);
  }
}




function cambiarEstadoPaciente($pidPaciente){
 /* try{

 
  $idPaciente=(int)$pidPaciente;
  $collection = Conectar("paciente");

  $updateResult=$collection->updateOne( 
  [ 'id' =>(int) $idPaciente ],
  [ '$set' => [ 
  'Estado' => "Facturado"
  ]
  ]);
}catch(Exception $e){

  guardarExceptions($e);
  
}*/
}
function guardarExceptions($exception){
  $collection=Conectar("excepciones");
          //print(getPacienteCount());
  $document = array( 
   "excepcion" => $exception,
   "fecha" => 'new Date()'

);
 
$collection->insertOne($document);

}