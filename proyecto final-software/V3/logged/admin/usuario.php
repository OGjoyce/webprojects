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
            <th>email</th>
            <th>nombre</th>
            <th>apellido</th>
            <th>Fecha Nacimiento</th>

            <th>Borrar</th>
          </tr>
         </thead>
         <tbody>
           <?php
           $r = selectT("select * from usuario");
           while ($row=pg_fetch_assoc($r)){
      echo "<tr>";
      echo "<th>". $row['email'] . "</th>";
      echo "<th>". $row['nombre'] . "</th>";
      echo "<th>". $row['apellido'] . "</th>";
      echo "<th>". $row['fecha_nac'] . "</th>";
      echo "<th> <form action='usuario.php' method='post'><button type='submit' class='btn-danger' name = 'borrar' value = '". $row['email'] . "' >Borrar </button> </form> </th>";

      echo "</tr>";
    }
    echo "</tbody>
    </table>";
    $x = $_POST["borrar"];
    if ($x != ""){
      deleteT("usuario", array("email" => $x));
    }
           ?>
           <form action='usuario.php' method='post' enctype="multipart/form-data">
  <div class="form-group">
    <input type="text" class="form-control" name="email" id="email" placeholder="email" >
  </div>
  <div class="form-group">
    <input type="password" class="form-control" name="password" id="password" placeholder="Password"  >
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido">
  </div>
  <div class="form-group">
    <input type="date" class="form-control" name="fecha" id="fecha" placeholder="fecha">
  </div>
<button type="submit" name ="submit" class="btn btn-success">Agregar</button>
</form>
<?php
$email = $_POST["email"];
$password = $_POST["password"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$fecha = $_POST["fecha"];
if ($email != ""){
  insertT("usuario", array($email, md5($password), $nombre, $apellido, $fecha));
}
?>
<form action='usuario.php' method='post' enctype="multipart/form-data">
  <div class="form-group">
    <?php
    $r = selectT("select * from usuario");
    echo '<label >Editar:</label>';
    echo "<select class='form-control' name= 'usuario' required>";
    echo "<option value=''>Seleccione a editar</option>";

    while ($row = pg_fetch_assoc($r)){
      $email = $row["email"];
      echo "<option value = '$email'> $email </option>";
    }
    echo "</select>";
    ?>
    <div class="form-group">
    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="apellido" id="apellido" placeholder="apellido">
  </div>
<div class="form-group">
<input type="password" class="form-control" name="password"   placeholder="password">
</div>
<div class="form-group">
<input type="date" class="form-control" name="fecha"   >
</div>

<button type="submit" name ="submit" class="btn btn-warning">Editar</button>
</form>
<?php
$usuario = $_POST["usuario"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$password = $_POST["password"];
$fecha = $_POST["fecha"];
$value = array();
if ($nombre != ""){
$value = array_merge($value,array("nombre" => $nombre));
}
if ($apellido != ""){
$value = array_merge($value,array( "apellido" => $apellido));
}
if ($password != ""){
  $value = array_merge($value,array( "password" =>md5($password)));
}
if ($fecha!= ""){
  $value = array_merge($value,array( "fecha" =>$fecha));
}
$where = array("email" => $usuario);


if ($usuario != ""){
  updateT("usuario", $value, $where);
  }

?>

          </div>
          </body>
        </html>
