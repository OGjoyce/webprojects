<?php
 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Request-Method: POST');
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

function select_user($name, $password, $conn)
{	
    $sql = "SELECT * FROM `User` WHERE `user` = '$name' AND `pswd` = '$password'";
    $result = $conn->query($sql);
    if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
        
    }
    //clavo aqui
   
    $user = new stdClass();
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $user->name=$row["Nombres"];
            $user->usr=$row["user"];
            $user->id=$row["idUser"];
            $user->key=md5($row['idUser'].$row["Nombres"]);
        }
        $sql = "UPDATE `User` SET `tokenLogin`='".$user->key."' WHERE idUser ='".$user->id."'";
        $result = $conn->query($sql);
         echo json_encode($user);
    } else {
        echo null;
    }
}
if(isset($_GET)){
	if(isset($_GET['token'])&&isset($_GET['user'])&&isset($_GET['pws'])){
		if ($_GET['token']=="login") {
			# code...

		select_user($_GET['user'],$_GET['pws'], $conn);
		}
	}
	if(isset($_GET['token'])&&$_GET['token']=='verificar'){
	    $sql = "SELECT estado FROM User where idUser='$_GET[userid]'";
	    $result = $conn->query($sql);
	  
	     $user = 0;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          
            if($row["estado"]!=1){
                 $user=0;
            }
            else{
                $user=1;
            }
           
        }
         echo $user;
    } else {
        echo null;
	}
}
    if(isset($_GET['key'])){
        $sql = "SELECT * FROM `User` where tokenLogin='$_GET[key]'";
         $user = new stdClass();
          $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $user->name=$row["Nombres"];
            $user->usr=$row["user"];
            $user->id=$row["idUser"];
            $user->key=md5($row['idUser'].$row["Nombres"]);
        }
        $sql = "UPDATE `User` SET `tokenLogin`='".$user->key."' WHERE idUser ='".$user->id."'";
        $result = $conn->query($sql);
         echo json_encode($user);
    } else {
        echo null;
    }
    }

}
 
?>