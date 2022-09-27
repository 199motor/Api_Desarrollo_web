<?php
include "db.php";

$db = new DATABASE();

$con = $db->getConnection();

//verificar si existe el usuario
$sql = $con->prepare("SELECT * FROM pelicula where ID= ?");
$sql->execute([
    $_POST['id']
]);

$result = $sql->rowCount();

if ($result<=0) {
   $res = array("ID ". $_POST['id'] => "no exite registro");

  echo json_encode($res);

} else {
  
   $dato =$sql->fetch(PDO::FETCH_OBJ);

    $sql = "UPDATE pelicula SET PELICULA= ? , CATEGORIA = ? , DESCRIPCION = ?  WHERE id= ? ";

    $statement = $con->prepare($sql);
    $statement->execute([
        $_POST['pelicula'],
        $_POST['descripcion'],
        $_POST['categoria'],
    $_POST['id'],
    ]);

    header("HTTP/1.1 200 OK");

    $res = array(
        'mensaje'=> 'Registro actualizado satisfactoriamente',
        'data' => array(
            'id' =>  $_POST['id'] ,
            'producto' =>  $_POST['pelicula'],
            'precio' =>  $_POST['categoria'],
            'descripcion' =>  $_POST['descripcion'] 
        )
    );

echo json_encode($res);
exit();
}
