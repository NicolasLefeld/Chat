<?php

include("../mysqli.php");

if (isset($_POST['color']) && isset($_POST['tonalidad']) && isset($_POST['exposicion']) && isset($_POST['fuente'])) {
    $color = filter_var($_POST['color'], FILTER_SANITIZE_STRING);
    $tonalidad = filter_var($_POST['tonalidad'], FILTER_SANITIZE_STRING);
    $exposicion = filter_var($_POST['exposicion'], FILTER_SANITIZE_STRING);
    $fuente = filter_var($_POST['fuente'], FILTER_SANITIZE_STRING);
    /*if (!$color || !$tonalidad || !$exposicion) {
        echo 0;
        die;
    }*/

    if (MySQLDB::getInstance()->query("UPDATE config SET color_fondo = '$color $tonalidad-$exposicion', fuente_texto = '$fuente' 
                                          WHERE idUsr = '" . $_SESSION['idUsr'] . "'  ")) {
        $rs = mysqli_fetch_assoc(MySQLDB::getInstance()->query("SELECT * FROM config WHERE idUsr = '" . $_SESSION['idUsr'] . "' "));
        $_SESSION['color_fondo'] = $rs['color_fondo'];
        $_SESSION['fuente_texto'] = $rs['fuente_texto'];

        echo 1;
        die;
    } else {
        echo 0;
        die;
    }
}
