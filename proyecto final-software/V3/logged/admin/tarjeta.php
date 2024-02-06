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
              <th>Fecha de vencimiento</th>
              <th>nombre</th>
              <th>cvv</th>
              <th>Borrar</th>
            </tr>
           </thead>
           <tbody>
             <?php
             $r = selectT("select * from tarjeta");
                 while ($row=pg_fetch_assoc($r)){
                   echo "<tr>";
      echo "<th>". $row['numero'] . "</th>";
      echo "<th>". $row['email'] . "</th>";
      echo "<th>". $row['fecha_vec'] . "</th>";
      echo "<th>". $row['nombre'] . "</th>";
      echo "<th>". $row['cvv'] . "</th>";
      echo "<th> <form action='tarjeta.php' method='post'><button type='submit' class='btn-danger' name = 'borrar' value = '". $row['numero'] . "' >Borrar </button> </form> </th>";

      echo "</tr>";
                 }
                 echo "</tbody>
  </table>";
  $x = $_POST["borrar"];
  if ($x != ""){
    deleteT("tarjeta", array("numero" => $x));
  }
             ?>
             <form action='tarjeta.php' method='post' enctype="multipart/form-data">
  <div class="form-group">
    <input type="text" class="form-control" name="numero" id="numero" placeholder="numero" >
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="email" id="email" placeholder="email" >
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
<?php
$numero = $_POST["numero"];
$email = $_POST["email"];
$fecha= $_POST["fecha"];
$nombre = $_POST["nombre"];
$cvv = $_POST["cvv"];
if ($email != ""){
  insertT("tarjeta", array($numero, $email, $fecha, $nombre, $cvv));
}
?>

    </div>
    </body>
  </html>
