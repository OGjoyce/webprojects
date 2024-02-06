<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nymph</title>
    <?php include 'lib.php';?>
  </head>
  <body>
<div class = "col-md-7 ">
</div>
<div class = "col-md-5 ">
  <form method="post" action="register/empresa.php" enctype="multipart/form-data">
    <div class="form-group">
      <input required id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre de empresa" >
    </div>
    <div class="form-group">
      <input required id="email" type="text" class="form-control" name="email" placeholder="Email">
    </div>
    <div class="form-group">
      <input required  type="password" class="form-control" placeholder="Password" name="passwordi"  id="passwordi" >
    </div>
    <div class="form-group">
      <input required type="password" class="form-control" placeholder="Confirm Password" id="confirm_password" >
    </div>
    <div class="form-group">
      <label for="formato">Logo</label>
      <input required type="file" class="form-control" name="logo" id="logo" >
    </div>
 <button type="submit" name = "submit" class="btn btn-default">Sign up</button>
  </form>

  <ul class="pagination">
    <li><a href="index.php">Cliente</a></li>
    <li class="active"><a href="#">Empresa</a></li>
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
