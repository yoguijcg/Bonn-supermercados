<?php
include "config.php";
include "utils.php";
$conexion =  Conectar($db);
if ($_SERVER['REQUEST_METHOD'] == 'GET'){

    if ($_GET['type']=='cat1'){
        $sql = $conexion->prepare("SELECT titulo FROM categorias where estado=1  group by titulo");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['type']=='cat2'){
        $sql = $conexion->prepare("SELECT titulo_dos FROM `categorias` WHERE estado='1' AND titulo=:var GROUP BY titulo_dos");
        $sql->execute(array(':var'=>$_GET['bus']));
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
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
    if ($_GET['type']=='busq'){
        if ($_GET['bus']=='categoria'){
            $sql = $conexion->prepare("SELECT * FROM `categorias` WHERE estado=1 and titulo=:var or titulo_dos=:var OR titulo_tres=:var LIMIT 1");
            $sql->execute(array(':var'=>$_GET['txt']));
            header("HTTP/1.1 200 OK");
            echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
            exit();
        }
        if ($_GET['bus']=='productos'){
            $sql = $conexion->prepare("SELECT * FROM `productos` WHERE estado=1 and nombre=:var LIMIT 1");
            $sql->execute(array(':var'=>$_GET['txt']));
            header("HTTP/1.1 200 OK");
            echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
            exit();
        }

    }
    if ($_GET['type']=='busqueda'){
        $sql = $conexion->prepare("SELECT * FROM `productos` WHERE estado=1");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }


}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $input = $_POST;
    $sql = "UPDATE `clientes` SET `nombre`=:nom,`apellidos`=:ape,`carnet`=:car,telefono_1=:te1,`telefono_2`=:te2 WHERE id=:ide";
    $resultado = $conexion->prepare($sql);
    bindAllValues($resultado, $input);
    $resultado->execute();
    header("HTTP/1.1 200 OK");
    echo json_encode('success');
    exit();

}

header("HTTP/1.1 400 Peticion HTTP inexistente");
?>