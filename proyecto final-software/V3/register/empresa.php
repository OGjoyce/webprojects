<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nymph</title>
    <?php include 'lib.php';?>
  </head>
  <body>
    <?php
    $email = $_POST["email"];
    $nombre = $_POST["nombre"];
    $password = $_POST["passwordi"];
    $email = $_POST["email"];
    $row = selectT("select id_empresa from empresa where email= '$email'");
    if ($row['id_empresa'] != NULL){
      header('Location: ../error.php'); // variable de error
    }
    else{
      $_SESSION["email"] = $email;
      $_SESSION["password"] = $password;
      $logo = $_FILES["logo"]["name"];
      echo $logo;
      $target_dir = "../imagen/";
      $target_file = $target_dir . basename($_FILES["logo"]["name"]);
      insertT("empresa", array("DEFAULT" ,$nombre, $logo, md5($password), $email));
      insertI("logo",$target_file);

    }
    ?>
    <h1>Bienvenido</h1>

  <div class = "col-md-4 ">
  </div>
  <div class = "col-md-4 ">
    <h1>Ingrese su primer producto</h1>
    <form action='last_emp.php' method='post' enctype="multipart/form-data">
  <div class="form-group">
    <input required type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
  </div>
  <div class="form-group">
    <input required type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion">
  </div>
  <div class="form-group">
    Imagen del producto:
    <input required type="file" class="form-control" name="imagen" id="imagen" placeholder="imagen">
  </div>
  <div class="form-group">
    <input required type="text" class="form-control" name="precio" id="precio" placeholder="Precio">
  </div>

  <div class="form-group">
    <?php
    $r = selectT("select * from tipo");
    echo "<select class='form-control' name= 'tipo' required>";
    echo "<option value=''>Seleccione un tipo</option>";

    while ($row = pg_fetch_assoc($r)){
      $id_tipo = $row["id_tipo"];
      $nombre = $row["nombre"];
      echo "<option value = '$id_tipo'> $nombre </option>";
    }
    echo "</select>";
    ?>
  </div>
  <button type="submit" name ="submit" class="btn btn-success">Empezar ya</button>
  </form>

  </div>
  <div class = "col-md-4 ">
  </div>

  </body>
</html>
