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
        $sql = $conexion->prepare("SELECT productos.id, `nombre`, `empresa`, `precioV`, `precioC`, `ganancia`, `codigoBarras`, `imagen`, descripcion, productos.estado, categorias.titulo, categorias.titulo_dos, categorias.titulo_tres FROM `productos`, categorias WHERE productos.estado=:e and categorias.id=productos.categoria");
        $sql->bindValue(':e', $_GET['e']);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
        exit();
    }
    if ($_GET['e']==0){
        $sql = $conexion->prepare("SELECT productos.id, `nombre`, `empresa`, `precioV`, `precioC`, `ganancia`, `codigoBarras`, `imagen`, descripcion, productos.estado, categorias.titulo, categorias.titulo_dos, categorias.titulo_tres FROM `productos`, categorias WHERE productos.estado=:e and categorias.id=productos.categoria");
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
        //$input = $_POST;
        $sql = "select id from categorias where estado=1 and titulo=:cate and titulo_dos=:cated and titulo_tres=:catet";
        $resultado = $conexion->prepare($sql);
        //bindAllValues($resultado, $input);
        $resultado->execute(array(
            ':cate'=>$_POST['cate'],
            ':cated'=>$_POST['cated'],
            ':catet'=>$_POST['catet']
        ));
        $categoria = $resultado->fetch(PDO::FETCH_ASSOC);

        $sqla = "INSERT INTO `productos`(`categoria`, `nombre`, `empresa`, `precioV`, `precioC`, `ganancia`, `codigoBarras`, `imagen`,descripcion, `estado`) VALUES (:cat,:nombre,:empresa,:preciov,:precioc,:ganancia,:codigo,:img,:des, 1)";
        $resultada = $conexion->prepare($sqla);
        //bindAllValues($resultado, $input);
        $resultada->execute(array(
            ':cat'=>$categoria['id'],
            ':nombre'=> $_POST['nombre'],
            ':empresa'=> $_POST['empresa'],
            ':preciov'=> $_POST['preciov'],
            ':precioc'=> $_POST['precioc'],
            ':ganancia'=> $_POST['ganancia'],
            ':codigo'=> $_POST['codigo'],
            ':img'=> $_POST['img'],
            ':des'=> $_POST['descrip'],
        ));

        header("HTTP/1.1 200 OK");
        echo json_encode('success');
        exit();
    }
    if ($_POST['type']=='yimg') {
        $sqla = "select id from categorias where estado=1 and titulo=:cate and titulo_dos=:cated and titulo_tres=:catet";
        $resultada = $conexion->prepare($sqla);
        $resultada->execute(array(
            ':cate'=>$_POST['titulo'],
            ':cated'=>$_POST['titulo_dos'],
            ':catet'=>$_POST['titulo_tres']
        ));
        $categoria = $resultada->fetch(PDO::FETCH_ASSOC);
        $input = $_POST;
        $id = $input['id'];
        $sql = "UPDATE productos SET `categoria`=:cat, `nombre`=:nom, `empresa`=:emp, `precioV`=:pv, `precioC`=:pc, `ganancia`=:gan, `codigoBarras`=:cod, `imagen`=:img,descripcion=:des WHERE id='$id'";
        $resultado = $conexion->prepare($sql);
        $resultado->execute(
            array(
                ':cat'=>$categoria['id'],
                ':nom'=>$input['nombre'],
                ':emp'=>$input['empresa'],
                ':pv'=>$input['pv'],
                ':pc'=>$input['pc'],
                ':gan'=>$input['gana'],
                ':cod'=>$input['codigo'],
                ':img'=>$input['img'],
                ':des'=>$input['des'],
            )
        );
        header("HTTP/1.1 200 OK");
        echo json_encode('success');
        exit();
    }
    if ($_POST['type']=='nimg') {
        $sqla = "select id from categorias where estado=1 and titulo=:cate and titulo_dos=:cated and titulo_tres=:catet";
        $resultada = $conexion->prepare($sqla);
        $resultada->execute(array(
            ':cate'=>$_POST['titulo'],
            ':cated'=>$_POST['titulo_dos'],
            ':catet'=>$_POST['titulo_tres']
        ));
        $categoria = $resultada->fetch(PDO::FETCH_ASSOC);
        $input = $_POST;
        $id = $input['id'];
        $sql = "UPDATE productos SET `categoria`=:cat, `nombre`=:nom, `empresa`=:emp, `precioV`=:pv, `precioC`=:pc, `ganancia`=:gan, `codigoBarras`=:cod, descripcion=:des WHERE id='$id'";
        $resultado = $conexion->prepare($sql);
        $resultado->execute(
            array(
                ':cat'=>$categoria['id'],
                ':nom'=>$input['nombre'],
                ':emp'=>$input['empresa'],
                ':pv'=>$input['pv'],
                ':pc'=>$input['pc'],
                ':gan'=>$input['gana'],
                ':cod'=>$input['codigo'],
                ':des'=>$input['des'],
            )
        );
        header("HTTP/1.1 200 OK");
        echo json_encode('success');
        exit();
    }
    if ($_POST['type']=='restart') {
        $id = $_POST['id'];
        $resultado = $conexion->prepare("UPDATE productos SET estado = 1 WHERE id=:id");
        $resultado->bindValue(':id', $id);
        $resultado->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode('success');
        exit();
    }
    if ($_POST['type']=='delete') {
        $id = $_POST['id'];
        $resultado = $conexion->prepare("UPDATE productos SET estado = 0 WHERE id=:id");
        $resultado->bindValue(':id', $id);
        $resultado->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode('success');
        exit();
    }


}

header("HTTP/1.1 400 Peticion HTTP inexistente");
?>