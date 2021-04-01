<?php
$db = ['servidor' => 'localhost','usuario' => 'id15321429_market1', 'password' => 'Desnyjcg1124-','db' => 'id15321429_market'];

function Conectar($db)
{
    try {
        $conexion = new PDO("mysql:host={$db['servidor']};dbname={$db['db']};charset=utf8", $db['usuario'], $db['password']);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}
function getParams($input){
    $filterParams = [];
    foreach($input as $param => $value){
        $filterParams[] = "$param=:$param";
    }
    return implode(", ", $filterParams);
}
function bindAllValues($statement, $params){
    foreach($params as $param => $value){
        $statement->bindValue(':'.$param, $value);
    }
    return $statement;
}


?>
