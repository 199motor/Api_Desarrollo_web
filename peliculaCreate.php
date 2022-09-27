<?php

include "db.php";

$db = new DATABASE();

$con = $db->getConnection();

$sql =$con->prepare("INSERT INTO pelicula (PELICULA,DESCRIPCION,CATEGORIA) VALUES (?,?,?)");

$sql->execute([
      $_POST['pelicula'],
      $_POST['descripcion'],
      $_POST['categoria']
]);

$id = $con->lastInsertId();

if($id)
{
  $input = array(
      'id' => $id,
      'pelicula'=> $_POST['pelicula'],
      'descripcion' => $_POST['descripcion'],
      'categoria' => $_POST['categoria']
  );

  header("HTTP/1.1 200 OK");
  echo json_encode($input);
  exit();
 }

