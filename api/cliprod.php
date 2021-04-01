<?php
include "config.php";
include "utils.php";
$conexion =  Conectar($db);
if ($_SERVER['REQUEST_METHOD'] == 'GET'){

    if ($_GET['type']=='cat1'){
        $sql = $conexion->prepare("SELECT * FROM `categorias` WHERE estado='1' AND id=:var");
        $sql->execute(array(':var'=>$_GET['bus']));
        //$sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetch(PDO::FETCH_ASSOC));
        exit();
    }
    if ($_GET['type']=='cat2'){
        $sql = $conexion->prepare("SELECT titulo_dos FROM `categorias` WHERE estado='1' AND titulo=:var GROUP BY titulo_dos");
        $sql->execute(array(':var'=>$_GET['bus']));
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit();
    }
    if ($_GET['type']=='cat3'){
        $sql = $conexion->prepare("SELECT id,titulo_tres FROM `categorias` WHERE estado='1' AND titulo_dos=:var");
        $sql->execute(array(':var'=>$_GET['bus']));
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }

    if ($_GET['type']=='prod'){
        $sql = $conexion->prepare("SELECT * FROM `productos` WHERE estado=1 and categoria=:var");
        $sql->execute(array(':var'=>$_GET['bus']));
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }

    if ($_GET['type']=='prom'){
        $sql = $conexion->prepare("SELECT * FROM `promocion` WHERE estado=1 ");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['type']=='mas'){
        $sql = $conexion->prepare("SELECT categoria FROM `productos` WHERE id=:var");
        $sql->execute(array(':var'=>$_GET['id']));
        //$sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetch(PDO::FETCH_ASSOC));
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

header("HTTP/1.1 400 Peticion HTTP inexistente");
?>