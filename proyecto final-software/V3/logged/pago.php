<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nymph</title>
    <?php include 'lib.php';?>
  </head>
  <body>
    <h1>DATOS DE PAGO</h1>
    <form method="post" action="comprar.php">
    <?php

    $email = $_SESSION["email"];
    $total = $_POST["total"];
    $r = selectT("select * from tarjeta where email = '$email'");
    echo '<div class="col-md-2">';
    echo '<label >Tarjeta:</label>';
    echo "<select class='form-control' name= 'tarjeta' required>";
    echo "<option value=''>Seleccione tarjeta</option>";

    while ($row = pg_fetch_assoc($r)){
      $numero = $row["numero"];
      echo "<option value = '$numero'>$numero</option>";
    }
    echo "</select>";
    echo '</div>';
    echo '<div class="col-md-2">';
    echo '<label>Direccion:</label>';
    echo "<select class='form-control' name= 'direccion' required>";
    echo "<option value=''>Seleccione dirección</option>";
    $r = selectT("select * from direccion where email = '$email'");
    while ($row = pg_fetch_assoc($r)){
      $id_direccion = $row["id_direccion"];
      $addr = $row["addr"];
      echo "<option value = '$id_direccion'>$addr</option>";
    }
    echo "</select>";
    echo '</div>';
    echo '<div class="col-md-2">';
    echo '<label >Telefono:</label>';
    echo "<select class='form-control' name= 'telefono' required>";
    echo "<option value=''>Seleccione telefono</option>";
    $r = selectT("select * from telefono where email = '$email'");
    while ($row = pg_fetch_assoc($r)){
      $telefono = $row["numero"];

      echo "<option value = '$telefono'>$telefono</option>";
    }
    echo "</select>";
    echo '</div>';
    ?>
      <div class="col-md-2">
        <?php echo "<button type ='submit' name='total' value ='$total'>COMPRAR</button>"; ?>
      </div>
    </form>
  </body>
</html>
