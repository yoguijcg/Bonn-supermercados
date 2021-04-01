<?php
include "config.php";
include "utils.php";
$conexion =  Conectar($db);


if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $sql = $conexion->prepare("SELECT script FROM clientes where correo=:correo");
    $sql->bindValue(':correo', $_GET['correo']);
    $sql->execute();
    header("HTTP/1.1 200 OK");
    echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $input = $_POST;
    $sql = "INSERT INTO `clientes`(`nombre`, `apellidos`, `carnet`, `correo`, `images`, `telefono_1`, `telefono_2`,script, `estado`) VALUES (:nombre,:apellido,:carnet,:correo,:img,:tel1,:tel2,md5(:correo),1)";
    $resultado = $conexion->prepare($sql);
    bindAllValues($resultado, $input);
    $resultado->execute();
    $id = $conexion->lastInsertId();

    if($id){
        $sql1 = $conexion->prepare("SELECT script FROM clientes where id=:correo");
        $sql1->bindValue(':correo', $id);
        $sql1->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode($sql1->fetch(PDO::FETCH_ASSOC));
        exit();
    }

}
header("HTTP/1.1 400 Peticion HTTP inexistente");
?>