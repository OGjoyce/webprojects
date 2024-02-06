<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nymph</title>
    <link rel="stylesheet" href="../misc/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../misc/bootstrap/css/font-awesome.min.css">
    <link rel="stylesheet" href="../misc/bootstrap/css/main.css">
    <script src="../misc/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../misc/bootstrap/js/bootstrap.min.js"></script>
    <?php
    session_start();
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    include '../Navbar/empresa.php';
    include '../function.php';
    ?>
  </head>
  <body>
    <div class = "col-md-7 ">
      <form action ="index.php">
      <button class="btn btn-default">Cliente</button>
    </form>
      <form action ="editp.php">
      <button class="btn btn-default">Empresa</button>
      <form>
    </div>
  </body>
  </html>
