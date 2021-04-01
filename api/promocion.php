<?php
include "config.php";
include "utils.php";
$conexion =  Conectar($db);
if ($_SERVER['REQUEST_METHOD'] == 'GET'){

    if ($_GET['cat']=='catu'){
        $sql = $conexion->prepare("SELECT titulo FROM categorias where estado=1  group by titulo");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['cat']=='catd'){
        $sql = $conexion->prepare("SELECT titulo_dos FROM `categorias` WHERE estado='1' AND titulo=:var GROUP BY titulo_dos");
        $sql->execute(array(':var'=>$_GET['var']));
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['cat']=='catt'){
        $sql = $conexion->prepare("SELECT titulo_tres FROM `categorias` WHERE estado='1' AND titulo_dos=:var");
        $sql->execute(array(':var'=>$_GET['var']));
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['cat']=='catdg'){
        $sql = $conexion->prepare("SELECT titulo_dos FROM `categorias` WHERE estado='1' GROUP BY titulo_dos");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['cat']=='cattg'){
        $sql = $conexion->prepare("SELECT titulo_tres FROM `categorias` WHERE estado='1'");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['e']==1){
        $sql = $conexion->prepare("SELECT promocion.id, `nombre`, `empresa`, `precio`, `total`, `tipo`, `codigoBarras`, `imagen`, descuento, dias, descripcion, promocion.estado, categorias.titulo, categorias.titulo_dos, categorias.titulo_tres FROM `promocion`, categorias WHERE promocion.estado=:e and categorias.id=promocion.categoria");
        $sql->bindValue(':e', $_GET['e']);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['e']==0){
        $sql = $conexion->prepare("SELECT promocion.id, `nombre`, `empresa`, `precio`, `total`, `tipo`, `codigoBarras`, `imagen`, descuento, dias, descripcion, promocion.estado, categorias.titulo, categorias.titulo_dos, categorias.titulo_tres FROM `promocion`, categorias WHERE promocion.estado=:e and categorias.id=promocion.categoria");
        $sql->bindValue(':e', $_GET['e']);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if ($_POST['type']=='create'){
        $sql = "select id from categorias where estado=1 and titulo=:cate and titulo_dos=:cated and titulo_tres=:catet";
        $resultado = $conexion->prepare($sql);
        $resultado->execute(array(
            ':cate'=>$_POST['cate'],
            ':cated'=>$_POST['cated'],
            ':catet'=>$_POST['catet']
        ));
        $categoria = $resultado->fetch(PDO::FETCH_ASSOC);
        $fecha = date('Y-m-d');
        $sqla = "INSERT INTO `promocion`(`categoria`, `nombre`, `empresa`, `precio`, `total`, `codigoBarras`, `imagen`, `tipo`, `descuento`, `dias`, `fecha`,descripcion, `estado`) VALUES (:cat,:nom,:emp,:pre,:tot,:cod,:img,:tip,:des,:dia,:fec,:descr, 1)";
        $resultada = $conexion->prepare($sqla);
        $resultada->execute(array(
            ':cat'=>$categoria['id'],
            ':nom'=> $_POST['nombre'],
            ':emp'=> $_POST['empresa'],
            ':pre'=> $_POST['precio'],
            ':tot'=> $_POST['total'],
            ':cod'=> $_POST['codigo'],
            ':img'=> $_POST['img'],
            ':tip'=> $_POST['tipo'],
            ':des'=> $_POST['des'],
            ':dia'=> $_POST['dias'],
            ':descr'=>$_POST['descripcion'],
            ':fec'=> $fecha,
        ));

        header("HTTP/1.1 200 OK");
        echo json_encode('success');
        exit();
    }
    if ($_POST['type']=='update'){
        $fecha = date('Y-m-d');
        $sqla = "select id from categorias where estado=1 and titulo=:cate and titulo_dos=:cated and titulo_tres=:catet";
        $resultada = $conexion->prepare($sqla);
        $resultada->execute(array(
            ':cate'=>$_POST['titulo'],
            ':cated'=>$_POST['titulo_dos'],
            ':catet'=>$_POST['titulo_tres']
        ));
        $categoria = $resultada->fetch(PDO::FETCH_ASSOC);
        if ($_POST['res']=='cambiar'){
            $input = $_POST;
            $id = $input['id'];
            $sql = "UPDATE promocion SET `categoria`=:cat, `nombre`=:nom, `empresa`=:emp, `precio`=:pre, `total`=:tot, `codigoBarras`=:cod, `imagen`=:img,tipo=:tip,descuento=:descu,dias=:dia,descripcion=:des,fecha=:fec WHERE id='$id'";
            $resultado = $conexion->prepare($sql);
            $resultado->execute(
                array(
                    ':cat'=>$categoria['id'],
                    ':nom'=>$input['nombre'],
                    ':emp'=>$input['empresa'],
                    ':pre'=>$input['precio'],
                    ':tot'=>$input['total'],
                    ':cod'=>$input['codigo'],
                    ':img'=>$input['img'],
                    ':tip'=>$input['tipo'],
                    ':descu'=>$input['descuento'],
                    ':dia' =>$input['dias'],
                    ':des' =>$input['descripcion'],
                    ':fec' =>$fecha
                )
            );
            header("HTTP/1.1 200 OK");
            echo json_encode($resultado);
            exit();
        }else{
            $input = $_POST;
            $id = $input['id'];
            $sql = "UPDATE promocion SET `categoria`=:cat, `nombre`=:nom, `empresa`=:emp, `precio`=:pre, `total`=:tot, `codigoBarras`=:cod, tipo=:tip,descuento=:descu,dias=:dia,descripcion=:des,fecha=:fec WHERE id='$id'";
            $resultado = $conexion->prepare($sql);
            $resultado->execute(
                array(
                    ':cat'=>$categoria['id'],
                    ':nom'=>$input['nombre'],
                    ':emp'=>$input['empresa'],
                    ':pre'=>$input['precio'],
                    ':tot'=>$input['total'],
                    ':cod'=>$input['codigo'],
                    ':tip'=>$input['tipo'],
                    ':descu'=>$input['descuento'],
                    ':dia' =>$input['dias'],
                    ':des' =>$input['descripcion'],
                    ':fec' =>$fecha
                )
            );
            header("HTTP/1.1 200 OK");
            echo json_encode('success');
            exit();
        }
    }
    if ($_POST['type']=='delete'){
        $id = $_POST['id'];
        $resultado = $conexion->prepare("UPDATE promocion SET estado = 0 WHERE id=:id");
        $resultado->bindValue(':id', $id);
        $resultado->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode('success');
        exit();
    }
    if ($_POST['type']=='restart'){
        $id = $_POST['id'];
        $resultado = $conexion->prepare("UPDATE promocion SET estado = 1 WHERE id=:id");
        $resultado->bindValue(':id', $id);
        $resultado->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode('success');
        exit();
    }

}
header("HTTP/1.1 400 Peticion HTTP inexistente");
?>