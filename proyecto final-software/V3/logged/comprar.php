<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nymph</title>
    <?php include 'lib.php';?>
  </head>
  <body>
    <?php
    $email = $_SESSION["email"];
    $total = $_POST["total"];
    $hoy = getdate();
    $fecha = $hoy["year"] ."-". $hoy["mon"] ."-". $hoy["mday"];
    insertT("transaccion", array("DEFAULT", $email, $total, $fecha));

    deleteT("carrito",array("email"=>$email));
    
    //print_r($hoy);





    ?>
  </body>
</html>
