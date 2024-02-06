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
          <th>id_busqueda</th>
          <th>id_producto</th>
          <th>fecha</th>

          <th>Borrar</th>
        </tr>
       </thead>
       <tbody>
         <?php
         $r = selectT("select * from busqueda");
    while ($row=pg_fetch_assoc($r)){
      echo "<tr>";
            echo "<th>". $row['id_busqueda'] . "</th>";
            echo "<th>". $row['id_producto'] . "</th>";
            echo "<th>". $row['fecha'] . "</th>";
            echo "<th> <form action='busqueda.php' method='post'><button type='submit' class='btn-danger' name = 'borrar' value = '". $row['id_busqueda'] . "' >Borrar </button> </form> </th>";

            echo "</tr>";
}
echo "</tbody>
</table>";
$x = $_POST["borrar"];
if ($x != ""){
  deleteT("busqueda", array("id_busqueda" => $x));
}
?>
<form action='busqueda.php' method='post' enctype="multipart/form-data">
      <div class="form-group">
        <input type="text" class="form-control" name="id_producto" id="id_producto" placeholder="id_producto">
      </div>
  <div class="form-group">
    <input type="date" class="form-control" name="fecha"   >
  </div>

<button type="submit" name ="submit" class="btn btn-success">Agregar</button>
</form>
<?php
$id_producto = $_POST["id_producto"];
$fecha = $_POST["fecha"];
if ($id_producto != ""){
  insertT("busqueda", array("DEFAULT", $id_producto, $fecha));
  }
?>

<form action='busqueda.php' method='post' enctype="multipart/form-data">
  <div class="form-group">
    <?php
    $r = selectT("select * from busqueda");
    echo '<label >Editar:</label>';
    echo "<select class='form-control' name= 'busqueda' required>";
    echo "<option value=''>Seleccione a editar</option>";

    while ($row = pg_fetch_assoc($r)){
      $id_busqueda = $row["id_busqueda"];
      echo "<option value = '$id_busqueda'> $id_busqueda </option>";
    }
    echo "</select>";
    ?>
    <input type="text" class="form-control" name="id_producto" id="id_producto" placeholder="id_producto">
  </div>
<div class="form-group">
<input type="date" class="form-control" name="fecha"   >
</div>

<button type="submit" name ="submit" class="btn btn-warning">Editar</button>
</form>
<?php
$busqueda = $_POST["busqueda"];
$id_producto = $_POST["id_producto"];
$fecha = $_POST["fecha"];
$value = array();
if ($id_producto != ""){
$value = array_merge($value,array("id_producto" =>$id_producto));
}
if ($fecha != ""){
  $value = array_merge($value,array( "fecha" =>$fecha));
}
$where = array("id_busqueda" => $busqueda);


if ($busqueda != ""){
  updateT("busqueda", $value, $where);
  }


?>

    </div>
    </body>
  </html>
