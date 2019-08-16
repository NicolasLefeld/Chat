<?php
include("../mysqli.php");



if (isset($_POST['accion'])) {
    $accion = filter_var($_POST['accion'], FILTER_VALIDATE_INT);
    /*if (!$accion) {
        echo 0;
        die;
    }*/

    if ($accion == 0) { //Listar salas
        $traer_salas = MySQLDB::getInstance()->query("SELECT * FROM salas_chat");
        while ($rs[] = mysqli_fetch_assoc($traer_salas)){

        }
        echo json_encode($rs);
    }

    if ($accion == 1) { //Creacion de salas
        if (isset($_POST['datos'])){
            $nombre = $_POST['datos'][0];
            $cantidad_maxima = $_POST['datos'][1];

            $archivo = $nombre.'.txt';
            $handle = fopen("../salas/".$archivo, 'w') or die('2');
            fclose($handle);

            $insertar_sala = MySQLDB::getInstance()->query("INSERT INTO salas_chat (nombre,cantidad_maxima,idUsr_creacion) 
                                                                VALUES ('$nombre', $cantidad_maxima, '" . $_SESSION['idUsr'] . "') ");
            if ($insertar_sala){
                echo 1;
            }else{
                echo 0;
            }
        }
    }

    if ($accion == 2) { //Borrado de salas

    }

    if ($accion == 3) { //Unirse a salas
        $update_sala = filter_var($_POST['update_sala'], FILTER_SANITIZE_STRING);
        $actualizar_sala = MySQLDB::getInstance()->query("UPDATE usr_sala SET sala = '$update_sala' WHERE idUsr = " . $_SESSION['idUsr'] . " ");
        if ($actualizar_sala){
            echo 1;
        }else{
            echo MySQLDB::getInstance()->error();
        }
    }

    if ($accion == 4) { //Darse de baja de salas

    }

} else {
    echo 10;
}