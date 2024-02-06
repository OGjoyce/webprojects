<?php
header('Access-Control-Allow-Origin: *');
$target_path = "uploads/";
 
$target_path = $target_path . basename( $_FILES['file']['name']);
 
if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
    echo "1";
} else {
    echo "0";
}
?>