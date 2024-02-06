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
            <th>id</th>
            <th>nombre</th>
            <th>logo</th>
            <th>email</th>
            <th>Borrar</th>
          </tr>
         </thead>
         <tbody>

           <?php
           $r = selectT("select * from empresa");
           while ($row=pg_fetch_assoc($r)){
      echo "<tr>";
      echo "<th>". $row['id_empresa'] . "</th>";
      echo "<th>". $row['nombre'] . "</th>";
      echo "<th>". $row['logo'] . "</th>";
      echo "<th>". $row['email'] . "</th>";
      echo "<th> <form action='empresa.php' method='post'><button type='submit' class='btn-danger' name = 'borrar' value = '". $row['email'] . "' >Borrar </button> </form> </th>";
      echo "</tr>";

    }
    echo "</tbody>
    </table>";
    $x = $_POST["borrar"];
    if ($x != ""){
      deleteT("empresa", array("email" => $x));
    }

           ?>

           <form action='empresa.php' method='post' enctype="multipart/form-data">
  <div class="form-group">
    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" >
  </div>
  <div class="form-group">
    <input type="password" class="form-control" name="password" id="password" placeholder="Password"  >
  </div>
  <div class="form-group">
    <input type="file" class="form-control" name="logo" id="logo" >
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="email" id="email"  placeholder="email">
  </div>
<button type="submit" name ="submit" class="btn btn-success">Agregar</button>
</form>
<?php
$nombre = $_POST["nombre"];
$password = $_POST["password"];
$logo = $_FILES["logo"]["name"];
$target_dir = "../../imagen/";
$target_file = $target_dir . basename($_FILES["logo"]["name"]);
$email = $_POST["email"];
if ($email != ""){
  insertT("empresa", array("DEFAULT", $nombre, $logo, md5($password), $email));
  insertI("logo", $target_file);
}

?>
<form action='empresa.php' method='post' enctype="multipart/form-data">
  <div class="form-group">
    <?php
    $r = selectT("select * from empresa");
    echo '<label >Editar:</label>';
    echo "<select class='form-control' name= 'empresa' required>";
    echo "<option value=''>Seleccione a editar</option>";

    while ($row = pg_fetch_assoc($r)){
      $id_empresa = $row["id_empresa"];
      echo "<option value = '$id_empresa'> $id_empresa </option>";
    }
    echo "</select>";
    ?>
  </div>
    <div class="form-group">
    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
    </div>
    <div class="form-group">
    <input type="password" class="form-control" name="password" id="password" placeholder="password">
    </div>
    <div class="form-group">
    <input type="file" class="form-control" name="logo" id="logo">
    </div>
    <div class="form-group">
    <input type="text" class="form-control" name="email" id="email" placeholder="email">
    </div>

<button type="submit" name ="edit" value="1" class="btn btn-warning">Editar</button>
</form>
<?php
$empresa = $_POST["empresa"];
$nombre = $_POST["nombre"];
$password = $_POST["password"];
$logo = $_FILES["logo"]["name"];
$target_file = $target_dir . basename($_FILES["logo"]["name"]);
$email = $_POST["email"];
$edit = $_POST["edit"];
if ($edit!=""){
  $value = array();
  if ($nombre != ""){
  $value = array_merge($value,array("nombre" =>$nombre));
  }
  if ($password != ""){
  $value = array_merge($value,array( "password" => md5($password)));
  }
  if ($logo != ""){
    $value = array_merge($value,array( "logo" =>$logo));
  }
  if ($email != ""){
    $value = array_merge($value,array( "email" =>$email));
  }

  $where = array("id_empresa" => $empresa);


  if ($empresa != ""){
    insertI("logo", $target_dir);
    updateT("empresa", $value, $where);
    }
}



?>
      </div>

      </body>
    </html>
