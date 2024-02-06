<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nymph</title>
    <?php include 'lib.php';?>
  </head>
  <body>
    <table class="table">
        <thead>
          <tr>
            <th>Reserva</th>
            <th>Producto</th>
            <th>nombre</th>
            <th>cantidad</th>
            <th>subtotal</th>
          </tr>
         </thead>
         <tbody>

    <?php
    $dir_target = "../imagen/";
    $email = $_SESSION["email"];
    $total = 0;
    echo $email;
    $r = selectT("select * from carrito where email = '$email'");
    while ($row = pg_fetch_assoc($r)){
      echo "<tr>";
      $reserva = $row["reserva"];
      $id_producto = $row["id_producto"];
      $cantidad = $row["cantidad"];
      $ri = pg_fetch_assoc(selectT("select * from producto where id_producto = '$id_producto'"));
      $nombre = $ri['nombre'];
      $descripcion = $ri['descripcion'];
      $precio = $ri['precio'];
      $stock= $ri['stock'];
      $tipo = $ri['tipo'];
      $imagen = $dir_target. $ri['imagen'];
      $price = str_replace(",", "", $precio);
      $price = str_replace("$", "", $price);

      echo "<th> $reserva </th>";
      echo "<th><img src='$imagen' class='img-rounded' alt='Cinque Terre' width='150' height='150'></th>";
      echo "<th> $nombre </th>";
      echo "<th> $cantidad </th>";
      $subtotal = $cantidad* $price ;
      $total = $total + $subtotal;
      echo "<th>$".$subtotal . "</th>";
      echo "</tr>";
    }
    echo "</tbody>
    </table>";
    echo"<h3>TOTAL: $ $total</h3>";
    if ($total == 0){
      echo " <button type='button' class='btn btn-defaul disabled' name='total' id='total' value=$total>
  <span class='glyphicon glyphicon-usd'></span> CHECKOUT
  </button>";
    }
    else{
      echo "<form action='pago.php' method='post'> <button type='submit' class='btn btn-default' name='total' id='total' value=$total>
  <span class='glyphicon glyphicon-usd'></span> CHECKOUT
  </button></form>";
    }



    ?>
  </body>
</html>
