<?php

include "db.php";

$db = new DATABASE();

$con = $db->getConnection();

 //verificar si existe el usuario
 $sql = $con->prepare("SELECT * FROM actores where ID= ?");
 $sql->execute([$_POST['id']]);
 $result = $sql->rowCount();

 if ($result<=0) {
    $res = array("ID ". $_POST['id'] => "no exite registro");

   echo json_encode($res);

 } else {
   
    $dato =$sql->fetch(PDO::FETCH_OBJ);

    //busca el los datos del fk 
    $sql1 = $con->prepare("SELECT * FROM pelicula where id= ?");
    $sql1->execute(
      [
        $dato->FK_PELICULA
      ]
    );

    $fk =$sql1->fetch(PDO::FETCH_OBJ);

    
$id = $_POST['id'];
$statement = $con->prepare("DELETE FROM actores where id= ? ");

$statement->execute([
  $_POST['id']
]);
header("HTTP/1.1 200 OK");

$res = array(
  'mensaje'=> 'Registro eliminado satisfactoriamente',
  'id' =>  $dato->ID ,
  'nombre' =>  $dato->NOMBRE,
  'apellido' =>  $dato->APELLIDO,
  'email' =>  $dato->EMAIL, 
  'edad' =>  $dato->EDAD,
  'peliculas' =>  $dato->PELICULAS,
  'fecha_nacimiento' =>  $dato->FECHA_NACIMIENTO,
  'fecha' =>  $dato->FECHA, 
  "data_fk"=> array(
    'id' =>  $fk->ID ,
    'pelicula' =>  $fk->PELICULA,
    'descripcion' =>  $fk->DESCRIPCION ,
    'categoria' =>  $fk->CATEGORIA
  )
);
   echo json_encode($res);
   exit();
 }