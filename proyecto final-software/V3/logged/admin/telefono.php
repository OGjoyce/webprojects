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
          <th>numero</th>
          <th>email</th>

          <th>Borrar</th>
        </tr>
       </thead>
       <tbody>
         <?php
         $r = selectT("select * from telefono");
    while ($row=pg_fetch_assoc($r)){
      echo "<tr>";
            echo "<th>". $row['numero'] . "</th>";
            echo "<th>". $row['email'] . "</th>";

            echo "<th> <form action='telefono.php' method='post'><button type='submit' class='btn-danger' name = 'borrar' value = '". $row['numero'] . "' >Borrar </button> </form> </th>";

            echo "</tr>";
}
echo "</tbody>
</table>";
$x = $_POST["borrar"];
if ($x != ""){
  deleteT("telefono", array("numero" => $x));
}
?>
<form action='telefono.php' method='post' enctype="multipart/form-data">
      <div class="form-group">
        <input type="text" class="form-control" name="numero" id="numero" placeholder="telefono">
      </div>
  <div class="form-group">
    <input type="text" class="form-control" name="email" id="email" placeholder="email" >
  </div>

<button type="submit" name ="submit" value="1" class="btn btn-success">Agregar</button>
</form>
<?php
$numero = $_POST["numero"];
$email = $_POST["email"];
if ($submit != ""){
  insertT("telefono", array($numero, $email));
  }
?>
<form action='telefono.php' method='post' enctype="multipart/form-data">
  <div class="form-group">
    <?php
    $r = selectT("select * from telefono");
    echo '<label >Editar:</label>';
    echo "<select class='form-control' name= 'telefono' required>";
    echo "<option value=''>Seleccione a editar</option>";

    while ($row = pg_fetch_assoc($r)){
      $numero = $row["numero"];
      echo "<option value = '$numero'> $numero </option>";
    }
    echo "</select>";
    ?>
    <div class="form-group">
    <input type="text" class="form-control" name="email" id="email" placeholder="email">
  </div>
<button type="submit" name ="submit" class="btn btn-warning">Editar</button>
</form>
<?php
$telefono = $_POST["telefono"];
$email = $_POST["email"];
$value = array();
if ($email != ""){
$value = array_merge($value,array("email" => $email));
}

$where = array("numero" => $telefono);


if ($telefono != ""){
  updateT("telefono", $value, $where);
  }

?>


    </div>
    </body>
  </html>
