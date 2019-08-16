<?php
include("../mysqli.php");



$busqueda_sala = MySQLDB::getInstance()->query("SELECT sala FROM usr_sala WHERE idUsr = " . $_SESSION['idUsr'] . " ");
$rs = mysqli_fetch_assoc($busqueda_sala);


$sala = $rs['sala'].".txt";
$texto = array();
$archivo = fopen("../salas/$sala","r");

if ($archivo) {
    while (($linea = fgets($archivo)) !== false) {
        $texto[] = $linea;
    }

    fclose($archivo);
} else {
    echo 0;
    die;
}

$devolucion = array();

foreach ($texto as $linea){
    $devolucion[] = explode('&&&',$linea);
}

if (count($devolucion) > 0){
    echo json_encode($devolucion);
}

