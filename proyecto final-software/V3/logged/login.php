<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nymph</title>
    <?php include 'lib.php';?>
    <!--  -->
  </head>
  <body>
<?php
  const NUM = 1;
$email = $_POST["email"];
$password = $_POST["password"];
$row = pg_fetch_assoc(selectT("select * from empresa where email= '$email' and password ='".md5($password)."'"));
$id_empresa = $row['id_empresa'];
$row = pg_fetch_assoc(selectT("select * from usuario where email= '$email' and password ='". md5($password) ."'"));
$nombre = $row['nombre'];
echo $nombre;
echo $id_empresa;
if ($id_empresa == NULL && $nombre == NULL){
    header('Location: ../index.php'); //error
  }
  else {
    $_SESSION["email"] = $email;
    $_SESSION["password"] = $password;
    if ($id_empresa == NUM) {
      header('Location: admin/');
    }
     else {
       if($id_empresa != NULL && $nombre!=NULL){
         header('Location: choose.php');
       }
       elseif ($id_empresa != NULL && $nombre==NULL) {
         header('Location: editp.php');
       }
       elseif ($id_empresa == NULL && $nombre!=NULL) {
         header('Location: index.php');
       }
       else{
         header('Location: ../index.php');
       }

     }
   }
?>

    </body>
    </html>
