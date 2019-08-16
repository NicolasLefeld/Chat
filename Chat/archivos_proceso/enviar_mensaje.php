<?php
include("../mysqli.php");

if (isset($_POST['mensaje'])) {
    $mensaje = filter_var($_POST['mensaje'], FILTER_SANITIZE_STRING);
    if (!($mensaje)) {
        echo 0;
        die;
    }

    $contador = 0;



    $mensaje = $_SESSION['usr'].' ('.date('H:m:s').')'."&&&".$mensaje."\n";

    $busqueda_sala = MySQLDB::getInstance()->query("SELECT sala FROM usr_sala WHERE idUsr = " . $_SESSION['idUsr'] . " ");
    $rs = mysqli_fetch_assoc($busqueda_sala);

    $sala = $rs['sala'].".txt";


    if ($archivo = fopen("../salas/$sala","a")){
        $contador++;
    }
    if (fwrite($archivo,$mensaje)){
        $contador++;
    }
    if (fclose($archivo)){
        $contador++;
    }
    if ($contador == 3){
        echo 1;
    }else{
        echo 0;
    }

}
