<?php
include "config.php";
include "utils.php";
$conexion =  Conectar($db);
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $sql = $conexion->prepare("SELECT * FROM clientes where script=:id");
    $sql->bindValue(':id', $_GET['id']);
    $sql->execute();
    header("HTTP/1.1 200 OK");
    echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $input = $_POST;
    $sql = "SELECT * FROM usuarios WHERE user=:u and password=:p";
    $resultado = $conexion->prepare($sql);
    bindAllValues($resultado, $input);
    $resultado->execute();
    header("HTTP/1.1 200 OK");
    echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    exit();

    //METODO PARA HACER DIRECTAMENTE CON EL DATA DE ACXIOS Y NO ESTAR USANDO EL APPEND

    /*header("HTTP/1.1 200 OK");
    $data = json_decode(file_get_contents('php://input'),true);
    $sql = "SELECT * FROM `usuarios` WHERE user=:user";
    $resultado = $conexion->prepare($sql);
    $resultado->execute(
        array(
            ':user' => $data['u'],
        )
    );
    echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    exit();*/
}
header("HTTP/1.1 400 Peticion HTTP inexistente");
?>