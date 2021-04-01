<?php
include "config.php";
include "utils.php";
$conexion =  Conectar($db);
if ($_SERVER['REQUEST_METHOD'] == 'GET'){

    if ($_GET['type']=='delevery'){
        $sql = $conexion->prepare("SELECT * FROM `delevery` WHERE 1");
        $sql->execute();
        //$sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetch(PDO::FETCH_ASSOC));
        exit();
    }
    if ($_GET['type']=='get'){
        $sql = $conexion->prepare("SELECT caruimg.id, `carusel`, `img`, `estado`,carusel.titulo FROM `caruimg`,carusel WHERE caruimg.carusel=carusel.id and caruimg.estado=1");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['type']=='car'){
        $sql = $conexion->prepare("SELECT * FROM `carusel`");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['type']=='delete'){
        $sql = $conexion->prepare("UPDATE `caruimg` SET `estado`=0 WHERE id=:var");
        $sql->execute(array(':var'=>$_GET['var']));
        //$sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( 'success');
        exit();
    }
    if ($_GET['type']=='caruo'){
        $sql = $conexion->prepare("SELECT * FROM `caruimg` WHERE estado=1 and carusel=1");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['type']=='carud'){
        $sql = $conexion->prepare("SELECT * FROM `caruimg` WHERE estado=1 and carusel=3");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['type']=='caruu'){
        $sql = $conexion->prepare("SELECT * FROM `caruimg` WHERE estado=1 and carusel=2 ");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }

}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['type']=='create'){
        $input = $_POST;
        $sql = "INSERT INTO `caruimg`(`carusel`, `img`, `estado`) 
VALUES (:car,:img,1)";
        $resultado = $conexion->prepare($sql);
        $resultado->execute(array(
            ':car'=>$input['car'],
            ':img'=>$input['img'],
        ));
        $id = $conexion->lastInsertId();

        header("HTTP/1.1 200 OK");
        echo json_encode('success');
        exit();

    }
    if ($_POST['type']=='detall'){
        $input = $_POST;
        if ($input['typ']=='normal'){
            $sql = "INSERT INTO `v_detalle`(`venta`, `producto`, `cantidad`, `precio`) 
VALUES (:vet,:prod,:can,:pre)";
            $resultado = $conexion->prepare($sql);
            $resultado->execute(array(
                ':vet'=>$input['vet'],
                ':prod'=>$input['pro'],
                ':can'=>$input['can'],
                ':pre'=>$input['pre']
            ));
            $id = $conexion->lastInsertId();
            if($id){
                $input['id'] = $id;
                header("HTTP/1.1 200 OK");
                echo json_encode('success');
                exit();
            }
        }else{
            $sql = "INSERT INTO `v_detalle`(`venta`, `promocion`, `cantidad`, `precio`) 
VALUES (:vet,:prom,:can,:pre)";
            $resultado = $conexion->prepare($sql);
            $resultado->execute(array(
                ':vet'=>$input['vet'],
                ':prom'=>$input['pro'],
                ':can'=>$input['can'],
                ':pre'=>$input['pre']
            ));
            $id = $conexion->lastInsertId();
            if($id){
                $input['id'] = $id;
                header("HTTP/1.1 200 OK");
                echo json_encode('success');
                exit();
            }
        }

    }

}

header("HTTP/1.1 400 Peticion HTTP inexistente");
?>