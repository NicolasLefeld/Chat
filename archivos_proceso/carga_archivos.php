<?php
include("../mysqli.php");


$target_dir = "../estilos/img/avatar_usr/";

//Cambiamos  el nombre
$temp = explode(".", $_FILES["imagen"]["name"]);
$archivo = $_SESSION['idUsr'] . '.' . end($temp);


if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_dir . $archivo)) {

    $update_avatar = MySQLDB::getInstance()->query("UPDATE config SET avatar = '$archivo' 
                                                      WHERE idUsr = '" . $_SESSION['idUsr'] . "' ");
    if ($update_avatar){
        $_SESSION['avatar'] = $archivo;
    }
    header('Location: ../perfil.php');

} else {
    //header('Location: ../config.php');
}
