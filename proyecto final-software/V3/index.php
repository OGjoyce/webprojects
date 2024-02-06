<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nymph</title>
    <?php include 'lib.php';?>
  </head>
  <body>
<br>
<div class = "col-md-7 ">
</div>
<div class = "col-md-5 ">
  <form method="post" action="register/cliente.php">
    <div class="form-group">
      <input required id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre" >
    </div>
    <div class="form-group">
      <input required id="apellido" type="text" class="form-control" name="apellido" placeholder="Apellido">
    </div>
    <div class="form-group">
      <input required id="email" type="text" class="form-control" name="email" placeholder="Email">
    </div>
    <div class="form-group">
      <input required  type="password" class="form-control" placeholder="Password" name="passwordi"  id="passwordi" >
    </div>
    <div class="form-group">
      <input required type="password" class="form-control" placeholder="Confirm Password" name ="confirm_password" id="confirm_password" >
    </div>
    <div class="form-group">
      <label for="formato">Fecha de nacimiento</label>
      <input required id="date" type="date" class="form-control" name="date" placeholder="date" >
    </div>
 <button type="submit" name = "submit" class="btn btn-default">Sign up</button>
  </form>
  <ul class="pagination">
  <li class="active"><a href="#">Cliente</a></li>
  <li><a href="empresa.php">Empresa</a></li>
</ul>
</div>
<!--  -->

<script>
var password = document.getElementById("passwordi");
var confirm_password = document.getElementById("confirm_password");
function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
 </script>

  </body>
</html>
