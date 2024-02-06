<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nymph</title>
    <?php include 'lib.php';?>
  </head>
  <body>
    <?php
    session_start();
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $tipo = $_POST["tipo"];
    $email = $_SESSION["email"];
    $row = pg_fetch_assoc(selectT("select id_empresa from empresa where email = '$email'"));
    $id_empresa = $row['id_empresa'];
    $imagen = $_FILES["imagen"]["name"];
    $target_dir = "../imagen/";
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    insertI("imagen", $target_file);
    insertT("producto", array("DEFAULT", $id_empresa, $nombre, $descripcion, $imagen, $precio, 'true', $tipo));
    //header('Location: ../logged/perfil.php');
    ?>
</body>
</html>
