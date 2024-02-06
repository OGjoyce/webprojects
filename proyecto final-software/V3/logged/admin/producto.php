<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Administrador</title>
    <?php include 'lib.php';?>
  </head>
  <body>
    <div class="container col-md-5 ">
      <table class="table">
          <thead>
            <tr>
              <th>id_producto</th>
              <th>id_empresa</th>
              <th>nombre</th>
              <th>descripcion</th>
              <th>imagen</th>
              <th>precio</th>
              <th>tipo</th>
              <th>Borrar</th>
            </tr>
           </thead>
           <tbody>
    <?php
    $r = selectT("select * from producto");
    while ($row=pg_fetch_assoc($r)){
      echo "<tr>";
      echo "<th>". $row['id_producto'] . "</th>";
      echo "<th>". $row['id_empresa'] . "</th>";
      echo "<th>". $row['nombre'] . "</th>";
      echo "<th>". $row['descripcion'] . "</th>";
      echo "<th>". $row['imagen'] . "</th>";
      echo "<th>". $row['precio'] . "</th>";
      echo "<th>". $row['tipo'] . "</th>";
      echo "<th>". $row['fecha_nac'] . "</th>";
      echo "<th> <form action='producto.php' method='post'><button type='submit' class='btn-danger' name = 'borrar' value = '". $row['id_producto'] . "' >Borrar </button> </form> </th>";

      echo "</tr>";
    }
    echo "</tbody>
</table>";
$x = $_POST["borrar"];
if ($x != ""){
    deleteT("producto", array("id_producto" => $x));
    }
    ?>
    <form action='producto.php' method='post' enctype="multipart/form-data">
  <div class="form-group">
    <input type="text" class="form-control" name="id_empresa" id="id_empresa" placeholder="id_empresa"  >
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

<button type="submit" name ="submit" class="btn btn-success">Agregar</button>
</form>
<?php
$id_empresa = $_POST["id_empresa"];
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$imagen = $_FILES["imagen"]["name"];
$target_dir = "../../imagen/";
$target_file = $target_dir . basename($_FILES["imagen"]["name"]);
$precio = $_POST["precio"];
$tipo = $_POST["tipo"];
if ($id_empresa != ""){
  insertT("producto", array("DEFAULT", $id_empresa, $nombre, $descripcion, $imagen, $precio, 'true', $tipo));
  insertI("imagen", $target_file);
}
?>
<form action='producto.php' method='post' enctype="multipart/form-data">
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
      echo "<select class='form-control' name= 'tipo'>";
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
