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

/*
user will be First Letter of name and first apellido+ hex()

*/ 

function hexToStr($hex){
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2){
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
}
 
function doRegister($get, $conexion){
   
    $nombre = $get['nombres'] . $get['apellidos'];
    $user = $get['nombres'][0];
    $user = $user . substr($get['apellidos'], strrpos(' ', $get['apellidos']));
    $toHex = substr($get['dpi'],0,4 );
    $user = $user . $toHex;
    $get['lat'] =hexToStr($get['lat']);
    $get['lng'] =hexToStr($get['lng']);
    $get['lat'] =hexToStr($get['lat']);
    $get['lng'] =hexToStr($get['lng']);


    //primer insert en informacion
    $sql = "INSERT INTO `Informacion` (`idInformacion`, `nacimiento`,
     `telefono`, `longitud`,
     `latitud`, `altitud`,
      `Direccion`, `Municipios_idMunicipios`,
       `dpi`, `correo`) 
       VALUES (NULL, CURDATE(), '$get[cel]', '$get[lng]', '$get[lat]', '1', 'x', '$get[municipio]', '$get[dpi]', '$get[email]')";
       $result = $conexion->query($sql);
       if (!$result) {
    trigger_error('Invalid query: ' . $conexion->error);
}
    
    //segundo insert
    //primero un select
    $sql = "select * from Informacion where dpi = '$get[dpi]'";
    $result = $conexion->query($sql);

    if($result){
    $row = $result->fetch_assoc();
    $id = $row['idInformacion'];
   
    //insert en user
    $sql = "insert into User (`idUser`, `Nombres`, `user`, `pswd`, `Estado`, `informacion_id`, `tokenLogin`)
    VALUES (NULL, '$nombre', '$user', '$get[pws]', '1', '$id', 'null')";
    $result = $conexion->query($sql);

    }
    else{

    }
    


    echo json_encode($user);
}

if(isset($_GET)){
    //Requesting http -> municipios
    if($_GET['token']=='getMunicipios'){
        $sql = "SELECT `idMunicipios`,`Municipio` FROM `Municipios` ";
        $result = $conn->query($sql);
      
    $municipios = array();
    if ($result->num_rows >= 0) {
        // output data of each row
        $i = 0;
        while($row = $result->fetch_assoc()) {
           // echo $row['idMunicipios'] . " ". $row["Municipio"];
           $i = $row["idMunicipios"];
            $municipios[$i]=$row["Municipio"];
        }
         echo json_encode($municipios);
    } else {
        echo null;
    }
    }
    if($_GET['token']=='register'){
        doRegister($_GET, $conn);
    }
}

?>