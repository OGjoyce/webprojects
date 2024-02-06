<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nymph</title>
    <?php include 'lib.php';?>
  </head>
  <body>
    <?php
    $email = $_SESSION['email'];
    $id_producto =  $_POST["add"];
    $row = pg_fetch_assoc(selectT("select * from carrito where email = '$email' and id_producto = '$id_producto' ")) ;
    if ($row['reserva'] == NULL){
      insertT("carrito", array("DEFAULT", $email, $id_producto, 1));
    }
    else{
      $cantidad = $row['cantidad'] + 1;
      updateT("carrito", array("cantidad" => $cantidad), array("email" => "$email",  "id_producto" => "$id_producto"));
    }
    header('Location: carrito.php');
    ?>

  </body>
</html>
