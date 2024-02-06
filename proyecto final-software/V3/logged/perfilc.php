<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nymph</title>
    <?php include 'lib.php';?>
    <!--  -->
  </head>
  <body>
<?php
  $dir_target = "../imagen/";
  $email = $_SESSION["email"];
  $r = selectT("select * from usuario where email = '$email'");
  $row = pg_fetch_assoc($r);
  $nombre= $row["nombre"];
  $apellido = $row["apellido"];
  echo "<div class='col-md-4'>";
    echo "<h1>$nombre $apellido</h1>";
  echo "</div>";

  $r = selectT("select * from telefono where email = '$email'");
  echo "<div class='col-md-2'>";
  while ($row=pg_fetch_assoc($r)){
    $telefono = $row["numero"];
    echo "<h4>Telefono</h4>";
    echo "<h5>$telefono</h5> ";
    echo "<form action='perfilc.php' method='post'><button type='submit' class='btn-danger' name = 'borrar1' value = '$telefono' >Borrar </button> </form> <br>";

  }
    echo "</div>";

    $r = selectT("select * from direccion where email = '$email'");
    echo "<div class='col-md-2'>";
    while ($row=pg_fetch_assoc($r)){
      $direccion = $row["addr"];
      $id_direccion = $row["id_direccion"];
      echo "<h4>Direccion</h4>";
      echo "<h5>$direccion</h5> ";
      echo "<form action='perfilc.php' method='post'><button type='submit' class='btn-danger' name = 'borrar2' value = '$id_direccion' >Borrar </button> </form> <br>";

    }
      echo "</div>";

      $r = selectT("select * from tarjeta where email = '$email'");
      echo "<div class='col-md-2'>";
      while ($row=pg_fetch_assoc($r)){
        $numero = $row["numero"];
        echo "<h4>Tarjeta</h4>";
        echo "<h5>$numero</h5> ";
        echo "<form action='perfilc.php' method='post'><button type='submit' class='btn-danger' name = 'borrar3' value = '$numero' >Borrar </button> </form> <br>";

      }
        echo "</div>";

        $x = $_POST["borrar1"];
        if ($x != ""){
          deleteT("telefono", array("numero" => $x));
        }
        $x = $_POST["borrar2"];
        if ($x != ""){
          deleteT("direccion", array("id_direccion" => $x));
        }
        $x = $_POST["borrar3"];
        if ($x != ""){
          deleteT("tarjeta", array("numero" => $x));
        }
?>
<div class='col-md-4'>
<form action='perfilc.php' method='post' enctype="multipart/form-data">
      <div class="form-group">
        <input type="text" class="form-control" name="numero" id="numero" placeholder="telefono">
      </div>


<button type="submit" name ="submit" class="btn btn-success">Agregar</button>
</form>
</div>
<?php
$numero = $_POST["numero"];
if ($numero != ""){
  insertT("telefono", array($numero, $email));
  }
?>
<div class='col-md-4'>
<form action='perfilc.php' method='post' enctype="multipart/form-data">
<div class="form-group">
<input type="text" class="form-control" name="addr" id="addr" placeholder="Direccion">
</div>
<button type="submit" name ="submit" class="btn btn-success">Agregar</button>
</form>
</div>
<?php
$addr = $_POST["addr"];
if ($addr != ""){
insertT("direccion", array("DEFAULT", $email, $addr));
}
?>
<div class='col-md-4'>
<form action='perfilc.php' method='post' enctype="multipart/form-data">
<div class="form-group">
<input type="text" class="form-control" name="numero" id="numero" placeholder="numero" >
</div>
<div class="form-group">
<label for="formato">Fecha de vencimiento</label>
<input type="date" class="form-control" name="fecha" id="fecha" placeholder="fecha">
</div>
<div class="form-group">
<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
</div>
<div class="form-group">
<input type="text" class="form-control" name="cvv" id="cvv" placeholder="cvv">
</div>
<button type="submit" name ="submit" class="btn btn-success">Agregar</button>
</form>
</div>
<?php
$numero = $_POST["numero"];
$fecha= $_POST["fecha"];
$nombre = $_POST["nombre"];
$cvv = $_POST["cvv"];
if ($numero != ""){
insertT("tarjeta", array($numero, $email, $fecha, $nombre, $cvv));
}
?>
  </body>
  </html>
