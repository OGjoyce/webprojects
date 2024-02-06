<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nymph</title>
    <?php include 'lib.php';?>
  </head>
  <body>
    <?php
    $tarjeta = $_POST["tarjeta"];
    $fecha = $_POST["fecha"];
    $nombre_t = $_POST["nombre"];
    $cvv = $_POST["cvv"];
    $addr = $_POST["addr"];
    $telefono = $_POST["telefono"];
    $email = $_SESSION["email"];
    insertT("tarjeta", array($tarjeta, $email, $fecha, $nombre_t, $cvv));
    insertT("direccion", array("DEFAULT", $email, $addr));
    insertT("telefono", array($telefono, $email));
    header('Location: ../logged/');


    ?>
  </body>
</html>
