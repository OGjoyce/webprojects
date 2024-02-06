<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nymph</title>
    <link rel="stylesheet" href="../misc/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../misc/bootstrap/css/font-awesome.min.css">
    <link rel="stylesheet" href="../misc/bootstrap/css/main.css">
    <script src="../misc/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../misc/bootstrap/js/bootstrap.min.js"></script>
    <?php
    session_start();
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    include '../Navbar/empresa.php';
    include '../function.php';
    ?>
    <!--  -->
  </head>
  <body>
<?php
$dir_target = "../imagen/";
  $email = $_SESSION["email"];

  $r = selectT("select * from empresa where email = '$email'");
  $row = pg_fetch_assoc($r);
  $logo = $dir_target. $row['logo'];
  $nombre_emp= $row["nombre"];
  $email_emp = $row["email"];
  $id_empresa = $row["id_empresa"];
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
    echo "<form action='editp.php' method='post'><button type='submit' class='btn-danger' name = 'borrar' value = '$id_producto' >Borrar </button> </form>";
?>

</div>
<?php
}
$x = $_POST["borrar"];
if ($x != ""){
    deleteT("producto", array("id_producto" => $x));
    }
?>
<br>
<div class="col-md-4">
  <form action='editp.php' method='post' enctype="multipart/form-data">
  <div class="form-group">
  <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
  </div>
  <div class="form-group">
  <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="descripcion">
  </div>
  <div class="form-group">
  <input type="file" class="form-control" name="imagen" id="imagen">
  </div>
  <div class="form-group">
  <input type="text" class="form-control" name="precio" id="precio" placeholder="precio">
  </div>
  <div class="form-group">
    <?php
    $r = selectT("select * from tipo");
    echo "<select class='form-control' name= 'tipo' required>";
    echo "<option value=''>Seleccione un tipo</option>";

    while ($row = pg_fetch_assoc($r)){
      $id_tipo = $row["id_tipo"];
      $nombre = $row["nombre"];
      echo "<option value = '$id_tipo'> $nombre </option>";
    }
    echo "</select>";
    ?>
  </div>

  <button type="submit" name ="add" value ="1"class="btn btn-success">Agregar</button>
  </form>
  <?php
  $nombre = $_POST["nombre"];
  $descripcion = $_POST["descripcion"];
  $imagen = $_FILES["imagen"]["name"];
  $target_dir = "../imagen/";
  $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
  $precio = $_POST["precio"];
  $tipo = $_POST["tipo"];
  $add = $_POST["add"];
  if ($add != ""){
    insertT("producto", array("DEFAULT", $id_empresa, $nombre, $descripcion, $imagen, $precio, 'true', $tipo));
    insertI("imagen", $target_file);
  }
  ?>
  <form action='editp.php' method='post' enctype="multipart/form-data">
    <div class="form-group">
      <?php
      $r = selectT("select * from producto");
      echo '<label >Editar:</label>';
      echo "<select class='form-control' name= 'producto' required>";
      echo "<option value=''>Seleccione a editar</option>";

      while ($row = pg_fetch_assoc($r)){
        $id_producto = $row["id_producto"];
        echo "<option value = '$id_producto'> $id_producto </option>";
      }
      echo "</select>";
      ?>
    </div>
      <div class="form-group">
      <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
      </div>
      <div class="form-group">
      <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="descripcion">
      </div>
      <div class="form-group">
      <input type="file" class="form-control" name="imagen" id="imagen">
      </div>
      <div class="form-group">
      <input type="text" class="form-control" name="precio" id="precio" placeholder="precio">
      </div>
      <div class="form-group">
        <select class='form-control' name= 'stock' >
          <option value=''>Stock</option>
          <option value = 'true'> true</option>
          <option value = 'false'> false</option>
        </select>
      </div>
      <div class="form-group">
        <?php
        $r = selectT("select * from tipo");
        echo "<select class='form-control' name= 'tipo' required>";
        echo "<option value=''>Seleccione un tipo</option>";

        while ($row = pg_fetch_assoc($r)){
          $id_tipo = $row["id_tipo"];
          $nombre = $row["nombre"];
          echo "<option value = '$id_tipo'> $nombre </option>";
        }
        echo "</select>";
        ?>
      </div>

  <button type="submit" name ="edit" value="1" class="btn btn-warning">Editar</button>
  </form>
  <?php
  $producto = $_POST["producto"];
  $nombre = $_POST["nombre"];
  $descripcion = $_POST["descripcion"];
  $imagen = $_FILES["imagen"]["name"];
  $target_dir = "../imagen/";
  $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
  $precio = $_POST["precio"];
  $tipo = $_POST["tipo"];
  $stock = $_POST["stock"];
  $edit = $_POST["edit"];
  if ($edit!=""){
    $value = array();
    if ($nombre != ""){
    $value = array_merge($value,array("nombre" =>$nombre));
    }
    if ($descripcion != ""){
    $value = array_merge($value,array( "descripcion" => $descripcion));
    }
    if ($imagen != ""){
      $value = array_merge($value,array( "imagen" =>$imagen));
    }
    if ($precio != ""){
      $value = array_merge($value,array( "precio" =>$precio));
    }
    if ($tipo != ""){
      $value = array_merge($value,array( "tipo" =>$tipo));
    }
    if ($stock != ""){
      $value = array_merge($value,array( "stock" =>$stock));
    }
    $where = array("id_producto" => $producto);


    if ($producto != ""){
      insertI("imagen", $target_dir);
      updateT("producto", $value, $where);
      }
  }



  ?>
</div>
</body>
</html>
