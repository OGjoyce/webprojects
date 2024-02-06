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
  <a class='navbar-brand' href='#'>NYMPH</a>
  <?php echo '<a href="#">'. $_SESSION["email"]   .'</a>'; ?>
</div>
<ul class='nav navbar-nav navbar-right'>
<li><a href="../index.php"><span class="glyphicon glyphicon-log-in"></span>Log out</a></li>
</ul>
</div>
</nav>
