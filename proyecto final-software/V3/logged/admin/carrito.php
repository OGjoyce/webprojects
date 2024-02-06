reserva<!DOCTYPE html>
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
              <th>reserva</th>
              <th>email</th>
              <th>id_producto</th>
              <th>cantidad</th>
              <th>Borrar</th>
            </tr>
           </thead>
           <tbody>
    <?php
    $r = selectT("select * from carrito");

    while ($row=pg_fetch_assoc($r)){
      echo "<tr>";
      echo "<th>". $row['reserva'] . "</th>";
      echo "<th>". $row['email'] . "</th>";
      echo "<th>". $row['id_producto'] . "</th>";
      echo "<th>". $row['cantidad'] . "</th>";
      echo "<th> <form action='carrito.php' method='post'><button type='submit' class='btn-danger' name = 'borrar' value = '". $row['email'] . "' >Borrar </button> </form> </th>";
      echo "</tr>";
    }
    echo "</tbody>
    </table>";
    $x = $_POST["borrar"];
    if ($x != ""){
      deleteT("carrito", array("email" => $x));
    }
    ?>

    <form action='carrito.php' method='post' enctype="multipart/form-data">
  <div class="form-group">
    <input type="text" class="form-control" name="email" id="email" placeholder="email" >
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="id_producto" id="id_producto" placeholder="id_producto">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="cantidad">
  </div>
<button type="submit" name ="submit" class="btn btn-success">Agregar</button>
</form>
<?php
$email = $_POST["email"];
$id_producto= $_POST["id_producto"];
$cantidad = $_POST["cantidad"];
if ($email != ""){
insertT("carrito", array("DEFAULT", $email, $id_producto, $cantidad));
}
?>
<form action='carrito.php' method='post' enctype="multipart/form-data">
  <div class="form-group">
    <?php
    $r = selectT("select * from carrito");
    echo '<label >Editar:</label>';
    echo "<select class='form-control' name= 'carrito' required>";
    echo "<option value=''>Seleccione a editar</option>";

    while ($row = pg_fetch_assoc($r)){
      $reserva = $row["reserva"];
      echo "<option value = '$reserva'> $reserva </option>";
    }
    echo "</select>";
    ?>
    <div class="form-group">
    <input type="text" class="form-control" name="email" id="email" placeholder="email">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="id_producto" id="id_producto" placeholder="id_producto">
  </div>
<div class="form-group">
<input type="text" class="form-control" name="cantidad"   placeholder="cantidad">
</div>

<button type="submit" name ="submit" class="btn btn-warning">Editar</button>
</form>
<?php
$carrito = $_POST["carrito"];
$email = $_POST["email"];
$id_producto = $_POST["id_producto"];
$cantidad = $_POST["cantidad"];
$value = array();
if ($email != ""){
$value = array_merge($value,array("email" => $email));
}
if ($id_producto != ""){
$value = array_merge($value,array( "id_producto" => $id_producto));
}
if ($cantidad != ""){
  $value = array_merge($value,array( "cantidad" =>$cantidad));
}
$where = array("reserva" => $carrito);


if ($carrito != ""){
  updateT("carrito", $value, $where);
  }

?>

  </div>

  </body>
</html>
