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
a {
    color: white;
}
li {
    color: white;
}
</style>

<nav class='navbar navbar-inverse'>
  <div class='container-fluid'>
    <div class='navbar-header'>
  <a class='navbar-brand' href='index.php'>NYMPH</a>
  <?php echo '<a href="perfilc.php">'. $_SESSION["email"]   .'</a>'; ?>
</div>
<form class='navbar-form navbar-left' method='post' action = 'search_nav.php'>
    <input class="form-control" type="text" name="search" placeholder="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
<ul class='nav navbar-nav navbar-right'>
  <li><a href="carrito.php"><span class="glyphicon glyphicon-shopping-cart"></span>Cart</a></li>
<li><a href="../index.php"><span class="glyphicon glyphicon-log-in"></span>Log out</a></li>
</ul>
</div>
</nav>
