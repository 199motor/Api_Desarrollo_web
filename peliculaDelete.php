<?php
include "db.php";

$db = new DATABASE();

$sql =$db->getConnection()->prepare("INSERT INTO pelicula (PELICULA,DESCRIPCION,CATEGORIA) VALUES (?,?,?)");


 //verificar si existe el usuario
 $sql = $db->getConnection()->prepare("SELECT * FROM pelicula where id= ?");
 $sql->execute(
    [
        $_POST['id']
]);

 $result = $sql->rowCount();

 if ($result<=0) {
    $res = array("ID ". $_POST['id'] => "no exite registro");

   echo json_encode($res);

 } else {
   
    $dato =$sql->fetch(PDO::FETCH_OBJ);

    
$statement = $db->getConnection()->prepare("DELETE FROM pelicula where id= ? ");

$statement->execute([
    $_POST['id']
]);

header("HTTP/1.1 200 OK");

$res = array(
    'mensaje'=> 'Registro eliminado satisfactoriamente',
    'data' => array(
        'id' =>  $dato->ID ,
        'producto' =>  $dato->PELICULA,
        'descripcion' =>  $dato->DESCRIPCION ,
        'precio' =>  $dato->CATEGORIA
    )
);
   echo json_encode($res);
   exit();
 }