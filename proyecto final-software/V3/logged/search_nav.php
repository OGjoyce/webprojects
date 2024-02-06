<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nymph</title>
    <?php include 'lib.php';
    include '../Sidebar/log.php';?>

  </head>
  <body>
        <?php

        $search = $_POST["search"];
        echo $search;
        if ($search == ""){
          header('Location: index.php');
        }

        $dir_target = "../imagen/";
        $r = selectT("select * from producto where nombre LIKE '%$search%'");
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
