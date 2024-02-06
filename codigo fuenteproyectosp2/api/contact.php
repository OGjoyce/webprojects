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

if (isset($_GET['token']) && $_GET['token']=='contact'){
    $contratado = $_GET['contratado'];
    $contratador = $_GET['contratador'];
    $sql = "SELECT * FROM `User` WHERE `informacion_id` = '$contratado'";
           $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
           // echo $row['idMunicipios'] . " ". $row["Municipio"];
          $contratado = $row['idUser'];
        }
    $sql = "INSERT INTO `Contactos`(`contactId`, `Contratado`, `Contratador`, `estado`) VALUES (NULL,$contratado,$contratador,1)";
       $result = $conn->query($sql);
    if($result){
        echo "1";
    }
    else{
        echo null;
       
    }
   
}

if (isset($_GET['token']) && $_GET['token']=='getChatList'){
$contratador = $_GET['contratador'];
$sql = "SELECT * from User U, Contactos C WHERE U.idUser IN (SELECT contratado FROM `Contactos` WHERE Contratador = '$contratador' AND Contratado <> '$contratador' group by Contratado)AND C.productId IN (SELECT productId FROM `Contactos` WHERE Contratador = '$contratador' AND Contratado <> '$contratador' group by productId) AND C.Contratador ='$contratador' AND C.productId <> '0' AND C.estado <> '0' AND idUser=Contratado GROUP by C.productId  ";
         $result = $conn->query($sql);
$user = new stdClass();
$array = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $sql = "select producto from productos where id='".$row['productId']."'";
        $resultDesc = $conn->query($sql);
        $rowDesc = $resultDesc->fetch_assoc();
        $row["newKey"] = $rowDesc['producto'];
        array_push($array, $row);
    }
     echo json_encode($array);
} else {
    echo null;
}
}

if (isset($_GET['token']) && $_GET['token']=='contactbymap'){
    $servicio = $_GET['idservicio'];
    $idproducto = $_GET['idproducto'];
    $sql = "SELECT * from User where informacion_id = (SELECT Informacion_idInformacion from Servicios where idServicios = $servicio)";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $contratado = $row['idUser'];
    $contratador = $_GET['contratador'];
    $sql = "INSERT INTO `Contactos`(`contactId`, `Contratado`, `Contratador`, `productId`, `estado`) VALUES (NULL,$contratado,$contratador,$idproducto, 1)";
      $result = $conn->query($sql);
      $sql = "INSERT INTO `Contactos`(`contactId`, `Contratado`, `Contratador`, `productId`, `estado`) VALUES (NULL,$contratador,$contratado,$idproducto, 1)";
      $result = $conn->query($sql);
    if($result){
        echo "1";
    }
    else{
        echo null;
       
    }
   
}
if (isset($_GET['token']) && $_GET['token']=='profile'){
   
    $contratador = $_GET['contratador'];
    $verperfilde = $_GET['idservicio'];
    $sql = "SELECT * FROM User U WHERE U.informacion_id = (SELECT S.Informacion_idInformacion FROM Servicios S WHERE S.idServicios = '$verperfilde')";
     $result = $conn->query($sql);
    $user = new stdClass();
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $user->name=$row["Nombres"];
            $user->usr=$row["user"];
            $user->id=$row["idUser"];
            $user->key=md5($row['idUser'].$row["Nombres"]);
        }
         echo json_encode($user);
    } else {
        echo null;
    }
    
}

if (isset($_GET['token']) && $_GET['token']=='mensajeria' ){
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO `Orders`(`msgID`, `personOne`, `personTwo`, `message`, `fecha`) VALUES (NULL,$_GET[sender],$_GET[emiter],'$_GET[msg]', '$date')";
     $result = $conn->query($sql);
    if($result){
        echo "1";
    }else{
        echo "0";
    }
    
}

if (isset($_GET['token']) && $_GET['token']=='getmsgs' ){
    $emiter = $_GET['emiter'];
    $sender = $_GET['sender'];
    $sql= "SELECT * FROM `Orders` WHERE `personOne` IN($sender,$emiter) AND `personTwo`IN ($sender,$emiter) order by fecha ASC";
    $result = $conn->query($sql);
if($result){
        $array = array();
         while($row = $result->fetch_assoc()) {
           array_push($array, $row);
        }
        echo json_encode($array);
        
    }
    else{
        echo "0";
       
    }
}
?>