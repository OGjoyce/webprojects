<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nymph</title>
    <?php include 'lib.php';?>
  </head>
  <body>
    <?php
    $dir_target = "../imagen/";
    $id_producto = $_POST["id_producto"];
    $hoy = getdate();
    $fecha = $hoy["year"] ."-". $hoy["mon"] ."-". $hoy["mday"];
    insertT("busqueda", array("DEFAULT",$id_producto, $fecha));
    $r = selectT("select * from producto where id_producto = '$id_producto'");
    $row = pg_fetch_assoc($r);
    $id_empresa = $row['id_empresa'];
    $nombre = $row['nombre'];
    $descripcion = $row['descripcion'];
    $precio = $row['precio'];
    $stock= $row['stock'];
    $tipo = $row['tipo'];
    $imagen = $dir_target. $row['imagen'];
    ?>
    <div class="col-md-4">
      <?php
      echo "<td><img src='$imagen' class='img-rounded' alt='Cinque Terre' width='300' height='300'></td>";
      ?>
    </div>
    <div class="col-md-4">
      <?php
      echo "<h1>$nombre</h1> <br>";
      $row = pg_fetch_assoc(selectT("select nombre from empresa where id_empresa = '$id_empresa'") ) ;
      $nombre_emp = $row['nombre'];
      echo "<form action='perfil.php' method='post'>";
      echo "<button type='submit' class ='form-control' name='empresa' value = '$id_empresa'>$nombre_emp</button> <br>";
      echo "</form>";
      echo "<h4>$precio</h4> <br>";
      echo "<p>$descripcion</p>";
      ?>
    </div>
    <div class="col-md-4">
      <?php
      $disable = 'disabled';
      if ($stock == 't'){
        echo "$stock in stock";
        $disable = 'active';
        echo "<form action='addcarrito.php' method='post'> <button type='submit' class='btn btn-default $disable' name='add' id='add' value=$id_producto>
  <span class='glyphicon glyphicon-usd'></span> ADD CART
  </button></form>";
      }
      else{
        echo "no available";
        echo " <button type='button' class='btn btn-default $disable' name='add' id='add' value=$id_producto>
  <span class='glyphicon glyphicon-usd'></span> ADD CART
  </button>";
      }


      ?>
    </div>
  </body>
</html>
