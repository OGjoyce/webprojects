<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "Lab7");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$code = $_POST['codigo'];
$name = $_POST['nombre'];
$edad = $_POST['edad'];
 
// attempt insert query execution
$sql = "INSERT INTO personas (Codigo, Nombre, Edad) VALUES ($code, '$name', $edad)";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);
?>