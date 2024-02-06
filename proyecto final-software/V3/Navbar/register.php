<style>
html, body {
    height: 100%;
}
.navbar-inverse {
  background-color: #41719A;
  border-color: #000000;*/

}
.navbar-default .navbar-brand {
  color: #FFF;
}

</style>

<nav class='navbar navbar-inverse'>
  <div class='container-fluid'>
    <div class='navbar-header'>
  <a class='navbar-brand' href='#'>NYMPH</a>
</div>
<ul class='nav navbar-nav navbar-right'>
<form class='navbar-form navbar-left' method='post' action = '../logged/login.php'>
  <div class='form-group'>
    <input name='email' id='email' type='text' class='form-control' placeholder='Correo'>
    <input id='password' name='password' type='password' class='form-control' placeholder='Password'>
  </div>
  <button type='submit' class='btn btn-default'>Login</button>
</form>
</ul>
</div>
</nav>
