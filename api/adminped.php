<?php
include "config.php";
include "utils.php";
$conexion =  Conectar($db);
if ($_SERVER['REQUEST_METHOD'] == 'GET'){

    if ($_GET['type']=='dire'){
        $sql = $conexion->prepare("SELECT * FROM `direcciones` WHERE id=:var");
        $sql->execute(array(':var'=>$_GET['var']));
        //$sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetch(PDO::FETCH_ASSOC));
        exit();
    }
    if ($_GET['type']=='prodN'){
        $sql = $conexion->prepare("SELECT v_detalle.id, `venta`, `producto`, `cantidad`, v_detalle.precio,productos.nombre, productos.imagen FROM `v_detalle`,productos WHERE venta=:var AND v_detalle.producto=productos.id");
        $sql->execute(array(':var'=>$_GET['var']));
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['type']=='prodP'){
        $sql = $conexion->prepare("SELECT v_detalle.id, `venta`, promocion, `cantidad`, v_detalle.precio,promocion.nombre, promocion.imagen FROM `v_detalle`,promocion WHERE venta=:var AND v_detalle.promocion=promocion.id");
        $sql->execute(array(':var'=>$_GET['var']));
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['type']=='venta'){
        $sql = $conexion->prepare("SELECT venta.id,`clientes`, `usuarios`, `direccion`, `costo_pedido`, `fecha`, `hora`, `metodo`, `apellido`, `nit`, `total`, `entregado`, `time`, venta.estado, clientes.nombre, clientes.apellidos FROM `venta`,clientes WHERE entregado=0 and venta.estado=1 and clientes.id=venta.clientes");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['type']=='ventaR'){
        $sql = $conexion->prepare("SELECT venta.id,`clientes`, `usuarios`, `direccion`, `costo_pedido`, `fecha`, `hora`, `metodo`, `apellido`, `nit`, `total`, `entregado`, `time`, venta.estado, clientes.nombre, clientes.apellidos FROM `venta`,clientes WHERE entregado=1 and venta.estado=1 and clientes.id=venta.clientes");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['type']=='yes'){
        $sql = $conexion->prepare("UPDATE `venta` SET `entregado`=1 WHERE id=:var");
        $sql->execute(array(':var'=>$_GET['var']));
        //$sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( 'success');
        exit();
    }
    if ($_GET['type']=='not'){
        $sql = $conexion->prepare("UPDATE `venta` SET `entregado`=2 WHERE id=:var");
        $sql->execute(array(':var'=>$_GET['var']));
        //$sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode('success');
        exit();
    }

}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['type']=='venta'){
        $input = $_POST;
        $sql = "INSERT INTO `venta`(`clientes`,`direccion`, `costo_pedido`, `fecha`, `hora`, `metodo`, `apellido`, `nit`, `total`,entregado,`time`, `estado`)
 VALUES (:cli,:dir,:cos,:fec,:hor,:met,:ape,:nit,:tot,0,:tim,1)";
        $resultado = $conexion->prepare($sql);
        //bindAllValues($resultado, $input);
        $resultado->execute(array(
            ':cli'=>$input['cli'],
            ':dir'=>$input['dir'],
            ':cos'=>$input['cos'],
            ':fec'=>$input['fec'],
            ':hor'=>$input['hor'],
            ':met'=>$input['met'],
            ':ape'=>$input['ape'],
            ':nit'=>$input['nit'],
            ':tot'=>$input['tot'],
            ':tim'=>$input['tim']

        ));
        $id = $conexion->lastInsertId();
        if($id){
            $input['id'] = $id;
            header("HTTP/1.1 200 OK");
            echo json_encode($input['id']);
            exit();
        }
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