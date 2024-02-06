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
            <th>id_tipo</th>
            <th>nombre</th>

            <th>Borrar</th>
          </tr>
         </thead>
         <tbody>
           <?php
           $r = selectT("select * from tipo");
           while ($row=pg_fetch_assoc($r)){
      echo "<tr>";
      echo "<th>". $row['id_tipo'] . "</th>";
      echo "<th>". $row['nombre'] . "</th>";
      echo "<th> <form action='tipo.php' method='post'><button type='submit' class='btn-danger' name = 'borrar' value = '". $row['id_tipo'] . "' >Borrar </button> </form> </th>";

      echo "</tr>";
    }
    echo "</tbody>
    </table>";
    $x = $_POST["borrar"];
    if ($x != ""){
      deleteT("tipo", array("id_tipo" => $x));
    }
           ?>
           <form action='tipo.php' method='post' enctype="multipart/form-data">
  <div class="form-group">
    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
  </div>

<button type="submit" name ="submit" class="btn btn-success">Agregar</button>
</form>
<?php
$nombre = $_POST["nombre"];
if ($nombre != ""){
  insertT("tipo", array("DEFAULT", $nombre));
}
?>

<form action='tipo.php' method='post' enctype="multipart/form-data">
  <div class="form-group">
    <?php
    $r = selectT("select * from tipo");
    echo '<label >Editar:</label>';
    echo "<select class='form-control' name= 'tipo' required>";
    echo "<option value=''>Seleccione a editar</option>";

    while ($row = pg_fetch_assoc($r)){
      $id_tipo = $row["id_tipo"];
      echo "<option value = '$id_tipo'> $id_tipo </option>";
    }
    echo "</select>";
    ?>
    <input type="text" class="form-control" name="nombre1" id="nombre1" placeholder="nombre">
  </div>


<button type="submit" name ="submit" class="btn btn-warning">Editar</button>
</form>
<?php
$tipo = $_POST["tipo"];
$nombre1 = $_POST["nombre1"];

$value = array();
if ($nombre1 != ""){
$value = array_merge($value,array("nombre" =>$nombre1));
}

$where = array("id_tipo" => $tipo);


if ($tipo != ""){
  updateT("tipo", $value, $where);
  }


?>

          </div>
          </body>
        </html>
