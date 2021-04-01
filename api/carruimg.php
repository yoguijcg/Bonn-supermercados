<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
$res = [];
$target_dir = "carrusel/";
$name = md5($_FILES["fileToUpload"]["name"]).'.jpg';
$target_file = $target_dir . basename($name);
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $res["message"] =  "success";
    $res['ubicacion']  = $target_file;
} else {
    $res["message"] =  "error";
}


echo json_encode($res);
die();


?>