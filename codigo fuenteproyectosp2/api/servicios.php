<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Request-Method: *');
header('Content-type: application/json');
 
$servername = "localhost";
$username = "id10799327_admin";
$password = "admin";

// Create connection
$conn = new mysqli($servername, $username, $password, 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "use id10799327_mydb";
$result = $conn->query($sql);
#hacemos una conexion post con un parametro y mandamos a llamar la funccion

if(isset($_GET['token'])&& $_GET['token']=='insertarservicio'){
    $date = date('Y-m-d H:i:s');
    $costo = $_GET['costo'];
    $descripcion = $_GET['descripcion'];
    $servicio = $_GET['servicio'];
    $iduser = $_GET['userid'];
    
    $sql = "SELECT * FROM `User` WHERE `idUser`=$iduser";
    $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
           // echo $row['idMunicipios'] . " ". $row["Municipio"];
          $iduser = $row['informacion_id'];
        }
 
    
    $sql="INSERT INTO `Servicios` (`idServicios`, `nombre_servicio`, `serviciodescripcion`, `estado`, `Informacion_idInformacion`, `fechaInicio`, `fechaFin`, `costoHora`) VALUES (NULL, '$servicio', '$descripcion', '1', '$iduser', '$date', '$date', '$costo')";
   $result = $conn->query($sql);
       if (!$result) {
         trigger_error('Invalid query: ' . $conexion->error);
        } else {
            echo "1";
        }
        
    
}
if(isset($_GET['token'])&& $_GET['token']=='top10') {
    $sql = "select * from Servicios S, productos P where S.idServicios = P.id_servicio order by S.fechaInicio desc LIMIT 10";
    $result = $conn->query($sql);
   
    if ($result->num_rows > 0) {
        // output data of each row
        $number = 0;
        $array = array();
       
        while($row = $result->fetch_assoc()) {
         
            array_push($array, $row);
        }
        echo json_encode($array);
    } else {
       echo null;
    }
}
if(isset($_GET['token'])&& $_GET['token']=='15services') {
    $sql = "select * from Servicios S, productos P, Informacion I where S.idServicios = P.id_servicio AND I.idInformacion = S.Informacion_idInformacion ";
    $result = $conn->query($sql);
   $array = array();
       
        while($row = $result->fetch_assoc()) {
         
            array_push($array, $row);
        }
        echo json_encode($array);
  
}
if(isset($_GET['token'])&& $_GET['token']=='getMarkersByFilter') {
    $filter = $_GET['filtro'];
    $sql = "select * from Servicios S, productos P, Informacion I where S.idServicios = P.id_servicio AND I.idInformacion = S.Informacion_idInformacion AND S.titulodescripcion like '%$filter%' ";
    $result = $conn->query($sql);
   $array = array();
       
        while($row = $result->fetch_assoc()) {
         
            array_push($array, $row);
        }
        echo json_encode($array);
  
}

if(isset($_POST) && $_GET['token']=='addProducts')
 {
        $nombre_servicio = $_POST['imagen'];
        $serviciodescripcion =$_POST['titulo'];
        $titulo = $_POST['titulo'];
        $titulodescripcion = $_POST['tipo'];
        $someArray = json_decode($_POST['products'], true);
        $iduser = $_POST['idUser'];
        $productosLength = count($someArray);
        
         $sql = "SELECT * FROM `User` WHERE `idUser` = '$iduser'";
           $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
           // echo $row['idMunicipios'] . " ". $row["Municipio"];
          $iduser = $row['informacion_id'];
        }
         $zeus_helper = 0;
        $date = date('Y-m-d H:i:s');
           $sql = "INSERT INTO `Servicios`(`idServicios`, `nombre_servicio`, `serviciodescripcion`, `titulo`, `titulodescripcion`, `estado`, `Informacion_idInformacion`, `fechaInicio`, `fechaFin`, `costoHora`) VALUES (NULL,'$nombre_servicio','$serviciodescripcion','$titulo','$titulodescripcion','1','$iduser','$date','$date','1')";
           $result = $conn->query($sql);
           if($result){
               $zeus_helper++;
           }
           else{
               echo $sql;
           }
           $sql = "select * from Servicios order by idServicios DESC ";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
             if($result){
              
           }
           else{
               echo "ERRRRRRRRR";
           }
            $last_user = $row['idServicios'];
       
        
        foreach ($someArray as $value)
           {
               $id;
               $product;
               $productDes;
            $iterator = 0;
               
            foreach($value as $node){
                //echo $node;
                if($iterator == 0){
                    $id = $node;
                }
                elseif($iterator == 1){
                    $product = $node;
                }
                else{
                    $productDes = $node;
                }
                $iterator++;
            }
            $sql = "INSERT INTO `productos`(`id`, `producto`, `descripcion`, `id_usuario`, `id_servicio`) VALUES (NULL,'$product','$productDes','$iduser', '$last_user')";
            $result = $conn->query($sql);
        
           }
           
          
           
           
           if($zeus_helper==1){
               echo "1";
           }
           else{
               echo "0";
           }
         
     
}
if (isset($_GET)&&$_GET['token']=='myServices'){
     $iduser;
     $sql = "SELECT * FROM `User` WHERE `idUser` = $_GET[userid]";
           $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
          $iduser = $row['informacion_id'];
        }
        $sql = "select * from Servicios S, productos P where S.idServicios = P.id_servicio AND S.Informacion_idInformacion = $iduser";
        $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
         $servicio = new stdClass();
         $oldserv;
         $helper=0;
    if ($result->num_rows > 0) {
        // output data of each row
        $arr = array();
        while($row = $result->fetch_assoc()) {
            if($helper == 0){
                $servicio->titulo=$row["titulo"];
            $servicio->descripcion=$row["titulodescripcion"];
            $servicio->nombreServicio=$row["nombre_servicio"];
            $servicio->serviciodescripcion=$row["serviciodescripcion"];
            array_push($arr, $row);
            $oldserv = $row["nombre_servicio"];
            }
            
            if($helper >0){
                if($oldserv =$row["nombre_servicio"]){
                      array_push($arr, $row);
                }
                else{
                    $helper=0;
                }
                
            }
            else{
                $helper++;
            }
              
          
            
            
        }
        $servicio->productos = $arr;
         echo json_encode($arr);
        }
    
    
    
}
}
if (isset($_GET)&&$_GET['token']=='insertRank'){
    $curruser = $_GET['esclavo'];
    $nextRank = 0;
    $punteo = $_GET['punteo'];
    $maestro = $_GET['maestro'];
    $idproduct = $_GET['productid'];
    $sql = "SELECT contrataciones from ranking where iduser = '$curruser'";
    $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
    if ($result->num_rows > 0) {
        $nextRank = $row['contrataciones'];
        $nextRank++;
    }
    else{
        $nextRank++;
        
    }
            }

            $sql = "INSERT INTO `ranking`(`idrank`, `contrataciones`, `rank`, `iduser`) VALUES (NULL,$nextRank,$punteo,$curruser)";
             $result = $conn->query($sql);
           
             $sql = "UPDATE `Contactos` SET `estado`= '0' WHERE Contratado = '$curruser' AND Contratador = '$maestro' AND productId = '$idproduct'";
              $result = $conn->query($sql);
               if($result){
                 echo $nextRank;
             }
             else{
                 echo null;
             }
             
}



?>