<?php
include('../mysqli.php');

//echo 1; die;


if (isset($_POST['mail']) && isset($_POST['user']) && isset($_POST['pass'])) {
    $mail = filter_var($_POST['mail'], FILTER_SANITIZE_STRING);
    $user = filter_var($_POST['user'], FILTER_SANITIZE_STRING);
    $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);


    if (!$mail || !$user || !$pass) { //Filtrado de variables
        echo 0;
        die;
    }
}


$existencia = MySQLDB::getInstance()->query("SELECT * FROM auth WHERE usr = '$user'");
if ($existencia->num_rows > 0) {
    echo 2;
    die;
}

//Generamos el idUsr
$sql_id = MySQLDB::getInstance()->query("SELECT idUsr FROM auth");
if ($sql_id->num_rows) {
    $sql_id = $sql_id->fetch_assoc();
    $identificacion = $sql_id['idUsr'];
    $identificacion = $identificacion + 2;
} else {
    $identificacion = 1;
}


$insert_usr = MySQLDB::getInstance()->query("INSERT INTO usr (idUsr, mail, rol, status) VALUES ('$identificacion','$mail', 1, 1)");

$insert_config = MySQLDB::getInstance()->query("INSERT INTO config (idUsr, color_fondo, fuente_texto) VALUES ('$identificacion', 'indigo', 'Arial')");

$insert_auth = MySQLDB::getInstance()->query("INSERT INTO auth (idUsr, usr, pass, encrypt) VALUES ('$identificacion', '$user','$pass', SHA2(pass,'SHA2_256'))");

$insert_usr_sala = MySQLDB::getInstance()->query("INSERT INTO usr_sala (idUsr,sala) VALUES ('$identificacion', 'Home')");


if ($insert_usr && $insert_config && $insert_config) {
    echo 1;

} else {
    echo 3;
}
