<?php

header('Access-Control-Allow-Origin: *');

//@conexion

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
//@montiel
if(isset($_GET['token']) && $_GET['token']=='getProfileServicios'){
    $key = $_GET['key'];
    $sql ="Select informacion_id from User where tokenLogin='$key'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $user = $row['informacion_id'];
    $sql = "SELECT COUNT(*) as conter FROM Servicios where Informacion_idInformacion=$user ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $services = $row['conter'];
    echo $services;
}
if(isset($_GET['token']) && $_GET['token']=='getProfileNames'){
    $key = $_GET['key'];
    $sql ="Select * from User where tokenLogin='$key'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $names = $row['Nombres'];
    $username = $row['user'];
    $arr = array();
    array_push($arr, $names, $username);
    echo json_encode($arr);
    
   
}   

if(isset($_GET['token']) && $_GET['token']=='getAllServices'){
    $iduser = $_GET['usrid'];
      $sql = "select * from Servicios S, productos P where S.idServicios = P.id_servicio AND S.Informacion_idInformacion = (
    Select informacion_id from User where idUser = $iduser)";
        $result = $conn->query($sql);
        $arr = array();
            while($row = $result->fetch_assoc()) {
                array_push($arr, $row);
                
            }
            echo json_encode($arr);
}

if(isset($_GET['token']) && $_GET['token']=='getRank'){
    $key = $_GET['key'];
    $sql ="Select * from User where tokenLogin='$key'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $id = $row['idUser'];
    $sql = "select (SELECT SUM(rank) as suma from ranking where iduser='$id') * 1/(SELECT contrataciones from ranking where iduser = '$id' group by contrataciones DESC LIMIT 1) as total";
     $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo $row['total'];

   
}   
    



?>
