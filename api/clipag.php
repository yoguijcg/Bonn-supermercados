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