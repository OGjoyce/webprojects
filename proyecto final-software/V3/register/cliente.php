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
    $apellido = $_POST["apellido"];
    $password = $_POST["passwordi"];
    $fecha= $_POST["date"];
    $row=selectT("select nombre from usuario where email= '$email'");
    if ($row['nombre'] != NULL){
      header('Location: ../error.php'); //error
    }
    else{
      $_SESSION["email"] = $email;
      $_SESSION["password"] = $password;
      insertT("usuario",array($email, md5($password), $nombre, $apellido, $fecha));
    }
    ?>
    <h1>Bienvenido</h1>
    <form action='last_cli.php' method='post' enctype="multipart/form-data">
    <div class = "col-md-4 ">
      <h1>Ingrese datos de pago</h1>

      <div class="form-group">
        <input required type="text" class="form-control" name="tarjeta" id="tarjeta" placeholder="numero" >
      </div>
      <div class="form-group">
        <label for="formato">Fecha de vencimiento</label>
        <input required type="date" class="form-control" name="fecha" id="fecha" placeholder="fecha">
      </div>
      <div class="form-group">
        <input required type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
      </div>
      <div class="form-group">
        <input required type="text" class="form-control" name="cvv" id="cvv" placeholder="cvv">
      </div>

    </div>
    <div class = "col-md-4 ">
      <h1>Ingrese datos de dirección</h1>
      <div class="form-group">
        <input required type="text" class="form-control" name="addr" id="addr" placeholder="Direccion">
      </div>
    </div>
    <div class = "col-md-4 ">
      <h1>Ingrese numero de telefono</h1>
      <div class="form-group">
        <input required type="text" class="form-control" name="telefono" id="telefono" placeholder="telefono">
      </div>
      <button type="submit" name ="submit" class="btn btn-success">Empezar ya</button>
    </div>

  </form>


  </body>
</html>
