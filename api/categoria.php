<?php
include "config.php";
include "utils.php";
$conexion =  Conectar($db);
if ($_SERVER['REQUEST_METHOD'] == 'GET'){

    if ($_GET['e']==1){
        $sql = $conexion->prepare("SELECT * FROM categorias where estado=:e");
        $sql->bindValue(':e', $_GET['e']);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['e']==0){
        $sql = $conexion->prepare("SELECT * FROM categorias where estado=:e");
        $sql->bindValue(':e', $_GET['e']);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }


}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if ($_POST['type']=='yimg'){
        $input = $_POST;
        $id = $input['id'];
        $sql = "UPDATE categorias SET titulo=:t, titulo_dos=:td, titulo_tres=:tt, img=:img WHERE id='$id'";
        $resultado = $conexion->prepare($sql);
        $resultado->execute(
            array(
                ':t'=>$input['titulo'],
                ':td'=>$input['titulo_dos'],
                ':tt'=>$input['titulo_tres'],
                ':img'=>$input['img']
            )
        );
        header("HTTP/1.1 200 OK");
        echo json_encode('success');
        exit();
    }
    if ($_POST['type']=='nimg') {
        $input = $_POST;
        $id = $input['id'];
        $sql = "UPDATE categorias SET titulo=:t, titulo_dos=:td, titulo_tres=:tt WHERE id='$id'";
        $resultado = $conexion->prepare($sql);
        $resultado->execute(
            array(
                ':t'=>$input['titulo'],
                ':td'=>$input['titulo_dos'],
                ':tt'=>$input['titulo_tres']
            )
        );
        header("HTTP/1.1 200 OK");
        echo json_encode('success');
        exit();
    }
    if ($_POST['type']=='restart') {
        $id = $_POST['id'];
        $resultado = $conexion->prepare("UPDATE categorias SET estado = 1 WHERE id=:id");
        $resultado->bindValue(':id', $id);
        $resultado->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode('success');
        exit();
    }
    if ($_POST['type']=='delete') {
        $id = $_POST['id'];
        $resultado = $conexion->prepare("UPDATE categorias SET estado = 0 WHERE id=:id");
        $resultado->bindValue(':id', $id);
        $resultado->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode('success');
        exit();
    }
    if ($_POST['type']=='create') {
        $input = $_POST;
        $sql = "INSERT INTO `categorias`(titulo, `titulo_dos`, `titulo_tres`, `img`, `estado`) VALUES (:cate,:cated,:catet,:img, 1)";
        $resultado = $conexion->prepare($sql);
        $resultado->execute(array(
            ':cate'=>$input['cate'],
            ':cated'=>$input['cated'],
            ':catet'=>$input['catet'],
            ':img'=>$input['img'],
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

header("HTTP/1.1 400 Peticion HTTP inexistente");
?>