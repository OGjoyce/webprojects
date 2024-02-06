<div class = "col-md-2 ">
  <div class="list-group">
    <?php
    $r = selectT("select * from tipo");
    while($row = pg_fetch_assoc($r)){
      $nombre = $row["nombre"];
      $id_tipo = $row["id_tipo"];
      echo "<form action='search.php' method='post'>";
      echo "<button type ='submit' name ='tipo' value = '$id_tipo' class='list-group-item'> $nombre</button>";
      echo "</form>";
    }
    ?>


</div>
</div>
