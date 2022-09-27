<?php


include "db.php";

$db = new DATABASE();

$con = $db->getConnection();

//verificar si existe el usuario
$sql = $con->prepare("SELECT * FROM actores where id= ?");
$sql->execute([$_GET['id']]);
$result = $sql->rowCount();

if ($result<=0) {
   $res = array("ID ". $_GET['id'] => "no exite este registro");

  echo json_encode($res);

}else{

  //Mostrar lista de post
  $sql = $con->prepare("SELECT * FROM actores WHERE ID = ?");
  $sql->execute(
    [$_GET['id']
  ]);
  
  $dato = $sql->fetch(PDO::FETCH_OBJ);   

 //busca el los datos del fk 
 $sql1 = $con->prepare("SELECT * FROM pelicula where id= ?");
 $sql1->execute([$dato->FK_PELICULA]);

 $fk =$sql1->fetch(PDO::FETCH_OBJ);

 $res = array(
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
  echo json_encode( $res  );

}


  exit();
