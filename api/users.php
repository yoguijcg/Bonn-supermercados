<?php
include "config.php";
include "utils.php";
$conexion =  Conectar($db);
if ($_SERVER['REQUEST_METHOD'] == 'GET'){

    if ($_GET['e']==1){
        $sql = $conexion->prepare("SELECT * FROM usuarios where estado=:e");
        $sql->bindValue(':e', $_GET['e']);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['e']==0){
        $sql = $conexion->prepare("SELECT * FROM usuarios where estado=:e");
        $sql->bindValue(':e', $_GET['e']);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }


}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $input = $_POST;
    $sql = "INSERT INTO `usuarios`(`nombre`, `apellido_paterno`, `apelido_materno`, `carnet`, `celular`, `correo`, `direccion`, `user`, `password`, `cargo`, estado) 
VALUES (:nombre,:ap,:am,:carnet,:celular,:correo,:direccion,:carnet,:carnet,:cargo, 1)";
    $resultado = $conexion->prepare($sql);
    bindAllValues($resultado, $input);
    $resultado->execute();
    $id = $conexion->lastInsertId();
    if($id){
        $input['id'] = $id;
        header("HTTP/1.1 200 OK");
        echo json_encode('success');
        exit();
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
    $input = $_GET;
    $id = $input['id'];
    $campos = getParams($input);
    $sql = "UPDATE usuarios SET $campos WHERE id='$id'";
    $resultado = $conexion->prepare($sql);
    bindAllValues($resultado, $input);
    $resultado->execute();
    header("HTTP/1.1 200 OK");
    echo json_encode('success');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    if ($_GET['r']=='r'){
        $id = $_GET['id'];
        $resultado = $conexion->prepare("UPDATE usuarios SET estado = 1 WHERE id=:id");
        $resultado->bindValue(':id', $id);
        $resultado->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode('success');
        exit();
    }
    if ($_GET['r']=='e'){
        $id = $_GET['id'];
        $resultado = $conexion->prepare("UPDATE usuarios SET estado = 0 WHERE id=:id");
        $resultado->bindValue(':id', $id);
        $resultado->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode('success');
        exit();
    }
}
header("HTTP/1.1 400 Peticion HTTP inexistente");
?>