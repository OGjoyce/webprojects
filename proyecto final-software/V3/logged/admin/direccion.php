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
              <th>id_direccion</th>
              <th>email</th>
              <th>direccion</th>
              <th>Borrar</th>
            </tr>
           </thead>
           <tbody>
    <?php
    $r = selectT("select * from direccion");
    while ($row=pg_fetch_assoc($r)){
      echo "<tr>";
      echo "<th>". $row['id_direccion'] . "</th>";
      echo "<th>". $row['email'] . "</th>";
      echo "<th>". $row['addr'] . "</th>";
      echo "<th> <form action='direccion.php' method='post'><button type='submit' class='btn-danger' name = 'borrar' value = '". $row['id_direccion'] . "' >Borrar </button> </form> </th>";
      echo "</tr>";
    }
    echo "</tbody>
      </table>";
      $x = $_POST["borrar"];
      if ($x != ""){
        deleteT("direccion", array("id_direccion" => $x));
      }
    ?>
    <form action='direccion.php' method='post' enctype="multipart/form-data">
  <div class="form-group">
    <input type="text" class="form-control" name="email" id="email" placeholder="email" >
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="addr" id="addr" placeholder="Direccion">
  </div>
<button type="submit" name ="submit" class="btn btn-success">Agregar</button>
</form>
<?php
$addr = $_POST["addr"];
$email = $_POST["email"];
if ($email != ""){
insertT("direccion", array("DEFAULT", $email, $addr));
}
?>


      </div>

      </body>
    </html>
