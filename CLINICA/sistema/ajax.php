<?php
include "connection.php";
session_start();
if($_POST['action'] == 'searchForDetalle'){
    $query = findData(-1,"farmacia",0);
    $cant = count($query);

    $detalleTabla = '';
    $total = 0;
    $arrayData = array();

    if($cant > 0){
    $data=$query;
    //return $data;
    //print_r($data);
    //print_r($cant);
  //  print_r($data[0]['nombre']);
    //print_r($data);

   // $result--;
        for($i=0;$i<$cant;$i++){
            $preciototal = round((int)$data[$i]['precio'] * (int)$data[$i]['precio'], 2);
            $total = round($total + $preciototal, 2);

            $detalleTabla = '<tr>
                                <td>'.$data[$i]['id'].'</td>
                                <td >'.$data[$i]['nombre'].'</td>
                                <td>'.$data[$i]['precio'].'</td>
                                <td>'.$data[$i]['descripcion'].'</td>                           
                                <td>'.$preciototal.'</td>
                                <td><a href="" class="btn btn-danger">Eliminar</a></td>
                            </tr>';
        }

        $detalleTotales = '<tr>
                                <td colspan="2">TOTAL</td>
                                <td>'.$total.'</td>
                            </tr>';
        
        $arrayData['detalle'] = $detalleTabla;
        $arrayData['totales'] = $detalleTotales;

        echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
        
    }else{
        echo 'error';
    }
   // mysqli_close($laconexion);
    

exit;
}
if($_POST['action'] == 'infoProducto'){

    if(!empty($_POST['producto'])){

        $producto = $_POST['producto'];

        $query = findData(1,"farmacia",$producto);
      // print_r($query+"asdasdasd");
        $result = count($query);

        if($result > 0){
            $data = $query;
            
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }else{
            echo 'error';
        }
        exit;
    }

}



if($_POST['action'] == 'addProductoDetalle'){

    $user = $_SESSION['user'];
    if(!empty($_POST['producto']) && !empty($_POST['cantidad']) ){

        $idproducto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $idPaciente = $_POST['paciente'];
       $comentario = $_POST['comentario'];

        $query = findData(1,"farmacia",$idproducto) ;

        
        $query2=insertarReceta($idPaciente,$idproducto,$cantidad,$comentario);
   //$array=[$idproducto,$];
        $response = ["Medicamento agregado"];
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
  
        
    }else{
        echo 'error';
    }
    exit;

}
















/*

if($_POST['action'] == 'addProductoDetalle'){

    $user = $_SESSION['user'];
    if(!empty($_POST['producto']) && !empty($_POST['cantidad']) ){

        $idproducto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $idPaciente = $_POST['paciente'];
       
       // $query = findData(-1,"farmacia",0);
       // $query =insertarFactura($idPaciente,$producto,$user,$cantidad); 
        /*Llamar a la funcion para insertar la cantidad y el producto a una tabla de factura;*/
/*if($idproducto==1){
   
    $insert = insertarReceta((int)$idPaciente,(int)$idproducto,0,0,$cantidad) ;
    print_r($insert);
}else if($idproducto==2){
    
    $insert = insertarReceta((int)$idPaciente,0,(int)$idproducto,0,$cantidad) ;
}else if($idproducto==3){
    
    $insert = insertarReceta((int)$idPaciente,0,0,(int)$idproducto,$cantidad) ;
}
        $query = findData(-1,"farmacia",0) ;
        $cant = count($query);

        $detalleTabla = '';
        $total = 0;
        $arrayData = array();
*/
       // echo ($idPaciente.$idproducto);
       /* if($cant > 0){
          //  $data=$query;
            for($i=0;$i<$cant;$i++){
                $preciototal = round((int)$data[$i]['precio'] *(int)$data[$i]['precio'], 2);
                $total = round($total + $preciototal, 2);

                $detalleTabla .= '<tr>
                <td>'.$data[$i]['id'].'</td>
                <td >'.$data[$i]['nombre'].'</td>
                <td>'.$data[$i]['precio'].'</td>
                <td>'.$data[$i]['descripcion'].'</td>                           
                <td>'.$preciototal.'</td>
                <td><a href="" class="btn btn-danger">Eliminar</a></td>
            </tr>';
            }

            $detalleTotales = '<tr>
                                  <td colspan="2">TOTAL</td>
                                 <td>'.$total.'</td>
                             </tr>';
            
            $arrayData['detalle'] = $detalleTabla;
            $arrayData['totales'] = $detalleTotales;

            echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
            
        }else{
            echo 'error';
        }*/
    /*
        
    }else{
        echo 'error';
    }
    exit;

}*/





?>