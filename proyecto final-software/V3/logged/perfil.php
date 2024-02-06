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
  $dir_target = "../imagen/";
  $id_empresa = $_POST['empresa'];
  $email = $_SESSION["email"];

  $r = selectT("select * from empresa where id_empresa = '$id_empresa'");
  $row = pg_fetch_assoc($r);
  $logo = $dir_target. $row['logo'];
  $nombre_emp= $row["nombre"];
  $email_emp = $row["email"];
  echo "<div class='col-md-6'>";
    echo "<img src='$logo' class='img-rounded' alt='Cinque Terre' width='300' height='300'>";
  echo "</div>";
  echo "<div class='col-md-6'>";
    echo "<h1>$nombre_emp</h1>";
    echo "<h4>$email_emp</h4>";
  echo "</div>";

  $r = selectT("select * from producto where id_empresa = '$id_empresa'");

  while($row = pg_fetch_assoc($r)){
    $id_producto = $row['id_producto'];
    $id_empresa = $row['id_empresa'];
    $nombre = $row['nombre'];
    $descripcion = $row['descripcion'];
    $precio = $row['precio'];
    $stock= $row['stock'];
    $tipo = $row['tipo'];
    $imagen = $dir_target. $row['imagen'];
    ?>
    <div class="col-md-2">
    <?php
    echo "<td><img src='$imagen' class='img-rounded' alt='Cinque Terre' width='100' height='100'></td>";
    echo "<br>". $nombre ."<br>";
    echo $precio ."\n";
    echo "<form method = 'post' action='detalles.php'>
<button type='submit' name = 'id_producto' id = 'id_producto' value= $id_producto >Ver</button>
</form>";
?>

</div>
<?php
}
?>
</body>
</html>
