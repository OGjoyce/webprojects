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
          <th>id_transaccion</th>
          <th>email</th>
          <th>monto</th>
          <th>fecha</th>
          <th>Borrar</th>
        </tr>
       </thead>
       <tbody>
         <?php
         $r = selectT("select * from transaccion");
    while ($row=pg_fetch_assoc($r)){
      echo "<tr>";
            echo "<th>". $row['id_transaccion'] . "</th>";
            echo "<th>". $row['email'] . "</th>";
            echo "<th>". $row['monto'] . "</th>";
            echo "<th>". $row['fecha'] . "</th>";
            echo "<th> <form action='transaccion.php' method='post'><button type='submit' class='btn-danger' name = 'borrar' value = '". $row['id_transaccion'] . "' >Borrar </button> </form> </th>";

            echo "</tr>";
}
echo "</tbody>
</table>";
$x = $_POST["borrar"];
if ($x != ""){
  deleteT("transaccion", array("id_transaccion" => $x));
}
?>
<form action='transaccion.php' method='post' enctype="multipart/form-data">
      <div class="form-group">
        <input type="text" class="form-control" name="email" id="email" placeholder="email">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="monto" id="monto" placeholder="monto">
      </div>
  <div class="form-group">
    <input type="date" class="form-control" name="fecha"   >
  </div>

<button type="submit" name ="submit" class="btn btn-success">Agregar</button>
</form>
<?php
$email = $_POST["email"];
$monto = $_POST["monto"];
$fecha = $_POST["fecha"];
if ($email != ""){
  insertT("transaccion", array("DEFAULT",$email, $monto, $fecha));
  }


?>

<form action='transaccion.php' method='post' enctype="multipart/form-data">
  <div class="form-group">
    <?php
    $r = selectT("select * from transaccion");
    echo '<label >Editar:</label>';
    echo "<select class='form-control' name= 'transaccion' required>";
    echo "<option value=''>Seleccione a editar</option>";

    while ($row = pg_fetch_assoc($r)){
      $id_transaccion = $row["id_transaccion"];
      echo "<option value = '$id_transaccion'> $id_transaccion </option>";
    }
    echo "</select>";
    ?>
    <input type="text" class="form-control" name="email" id="email" placeholder="email">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="monto" id="monto" placeholder="monto">
  </div>
<div class="form-group">
<input type="date" class="form-control" name="fecha"   >
</div>

<button type="submit" name ="submit" class="btn btn-warning">Editar</button>
</form>
<?php
$transaccion = $_POST["transaccion"];
$email = $_POST["email"];
$monto = $_POST["monto"];
$fecha = $_POST["fecha"];
$value = array();
if ($email != ""){
$value = array_merge($value,array("email" =>$email));
}
if ($monto != ""){
$value = array_merge($value,array( "monto" => $monto));
}
if ($fecha != ""){
  $value = array_merge($value,array( "fecha" =>$fecha));
}
$where = array("id_transaccion" => $transaccion);


if ($transaccion != ""){
  updateT("transaccion", $value, $where);
  }


?>

    </div>
    </body>
  </html>
