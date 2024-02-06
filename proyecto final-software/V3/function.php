<?php
//insert Tuple
function insertT($table, $values){
  $host="localhost";
  $user="adminnymph";
  $pass="nymph";
  $dbname="nymph";
  $dbconn = pg_connect("host=$host dbname=$dbname user=$user password=$pass");
  $query = "insert into $table values(";
  $length = count($values);
  for($i = 0; $i < $length; $i++){
    $value = $values[$i];
    if ($value != "DEFAULT"){
      $value = "'$value'";
    }
    if ($i == ($length-1)){
      $query = $query . "$value )";
    }
    else{
      $query = $query . "$value ,";
    }
  }
      //echo $query;
      if (pg_query($dbconn, $query)){
        echo "ingreso exitosamente";
      }
      else{
        echo "no se pudo ingresar";
      }
}

function deleteT($table, $where){
  $host="localhost";
  $user="adminnymph";
  $pass="nymph";
  $dbname="nymph";
  $dbconn = pg_connect("host=$host dbname=$dbname user=$user password=$pass");
  $query = "delete from $table where ";
  $length = count($where);
  $i = 0;
  foreach ($where as $key => $value) {
    if ($i == ($length-1)){
      $query = $query . "$key = '$value'";
    }
    else{
      $query = $query . "$key = '$value' AND ";
    }
    $i++;
  }
  //echo $query;
  if (pg_query($dbconn, $query)){
    echo "elimino exitosamente";
  }
  else{
    echo "no se pudo eliminar";
  }
}

function updateT($table, $values, $where){
  $host="localhost";
  $user="adminnymph";
  $pass="nymph";
  $dbname="nymph";
  $dbconn = pg_connect("host=$host dbname=$dbname user=$user password=$pass");
  $query = "update $table SET ";
  $length = count($values);
  $i = 0;
  $keys = "(";
  $valor = "(";
  foreach ($values as $column => $value) {
    if ($i == ($length-1)){
      $keys = $keys."$column)";
      $valor = $valor."'$value')";
    }
    else{
      $keys = $keys. "$column,";
      $valor = $valor. "'$value',";
    }
    $i++;
  }
      $query = $query . $keys ." = ". $valor. " where ";
      $i = 0;
      $length = count($where);
      foreach ($where as $key => $value) {
        if ($i == ($length-1)){
          $query = $query . "$key = '$value'";
        }
        else{
          $query = $query . "$key = '$value' AND ";
        }
        $i++;
      }

  //echo $query;
  if (pg_query($dbconn, $query)){
    echo "edito exitosamente";
  }
  else{
    echo "no se pudo editar";
  }
}

function selectT($query){
  $host="localhost";
  $user="adminnymph";
  $pass="nymph";
  $dbname="nymph";
  $dbconn = pg_connect("host=$host dbname=$dbname user=$user password=$pass");
  $r = pg_query($dbconn, $query);
  //echo $query;
  // if ($r){
  //   echo "select si";
  // }
  // else{
  //   echo "select no";
  // }
  return $r;
}

function insertI($name, $target_file){
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
      echo "The file ". basename( $_FILES["logo"]["name"]). " has been uploaded.";
  } else {
      echo "Sorry";
      // Sorry, there was an error uploading your file.
  }
}
?>
