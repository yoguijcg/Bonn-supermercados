<?php
include "config.php";
include "utils.php";
$conexion =  Conectar($db);
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $sql = $conexion->prepare("SELECT costo FROM `delevery` where id=1");
    $sql->execute();
    header("HTTP/1.1 200 OK");
    echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $input = $_POST;
    $sql = "UPDATE `delevery` SET `costo`=:costo WHERE id=1";
    $resultado = $conexion->prepare($sql);
    bindAllValues($resultado, $input);
    $resultado->execute();
    header("HTTP/1.1 200 OK");
    echo json_encode('success');
    exit();

}
header("HTTP/1.1 400 Peticion HTTP inexistente");
?>