<?php

include "db.php";

$db = new DATABASE();

$con = $db->getConnection();

$input = $_POST;

$statement = $con->prepare("INSERT INTO actores
(NOMBRE,APELLIDO,FECHA_NACIMIENTO,FECHA,EDAD,PELICULAS,EMAIL,FK_PELICULA) VALUES (?,?,?,?,?,?,?,?)");

$statement->execute([
      $_POST['nombre'],
      $_POST['apellido'],
      $_POST['fecha_nacimiento'],
      $_POST['fecha'],
      $_POST['edad'],
      $_POST['peliculas'],
      $_POST['email'],
      $_POST['fk_pelicula']
]);

$postId = $con->lastInsertId();

//buscamos los campos del registro insertado
$sql = $con->prepare("SELECT * FROM actores where id= ?");
$sql->execute(
      [
            $postId
      ]);

$dato = $sql->fetch(PDO::FETCH_OBJ);

 //busca el los datos del fk 
 $sql1 = $con->prepare("SELECT * FROM pelicula where id= ?");
 $sql1->execute([$dato->FK_PELICULA]);

 $fk =$sql1->fetch(PDO::FETCH_OBJ);

 $res =  array(
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

header("HTTP/1.1 200 OK");
echo json_encode($res);


