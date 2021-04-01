<?php
include "config.php";
include "utils.php";
$conexion =  Conectar($db);
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if ($_GET['type']=='qwe'){
        $sql = $conexion->prepare("SELECT * FROM clientes where script=:id");
        $sql->bindValue(':id', $_GET['id']);
        $sql->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
        exit();
    }
    if ($_GET['type']=='masven'){
        $sql = $conexion->prepare("SELECT v_detalle.producto, SUM(cantidad) as suma, productos.id, productos.nombre,productos.empresa,productos.precioV,productos.codigoBarras, productos.imagen, productos.descripcion FROM `v_detalle`, productos WHERE productos.id=v_detalle.producto GROUP BY v_detalle.producto ORDER By suma DESC LIMIT 10");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['type']=='reciente'){
        $sql = $conexion->prepare("SELECT * FROM `productos` WHERE estado=1 ORDER BY id DESC LIMIT 10");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['type']=='redwsfciente'){
        $sql = $conexion->prepare("SELECT * FROM `productos` WHERE estado=1 ORDER BY id DESC LIMIT 10");
        $sql->execute(array(':var'=>$_GET['var']));
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
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


