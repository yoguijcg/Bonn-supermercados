<?php
include "config.php";
include "utils.php";
$conexion =  Conectar($db);
if ($_SERVER['REQUEST_METHOD'] == 'GET'){

    if ($_GET['type']=='dir'){
        $sql = $conexion->prepare("SELECT * FROM `direcciones` WHERE estado=1 and cliente=:var");
        $sql->execute(array(':var'=>$_GET['id']));
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit();
    }
    if ($_GET['type']=='deldir'){
        $sql = $conexion->prepare("UPDATE `direcciones` SET `estado`=0 WHERE id=:var");
        $sql->execute(array(':var'=>$_GET['id']));
        header("HTTP/1.1 200 OK");
        echo json_encode('succcess');
        exit();
    }

}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $input = $_POST;
    $sql = "INSERT INTO `direcciones`(`cliente`, `titulo`, `direccion`, `puerta`, `domicilio`, `referencia`,telefono, `ubicacion`, `estado`) 
VALUES (:idcli,:tipo,:dir,:num,:dom,:ref,:tel,:ubi,1)";
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