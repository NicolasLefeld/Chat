<?php
include("../mysqli.php");


if (isset($_POST['accion'])) {
    $accion = filter_var($_POST['accion'], FILTER_SANITIZE_STRING);
    if (!$accion) { //Filtrado de variables
        echo 2;
        die;
    }


    if ($accion == 1) { //Chekeo de logeo existente
        if (isset($_SESSION['logeo'])) {
            if ($_SESSION['logeo'] == 1) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }




    } else if ($accion == 2) { //Caso para cuando el usuario logea
        if (isset($_POST['usr']) && isset($_POST['pass'])) {
            $usr = filter_var($_POST['usr'], FILTER_SANITIZE_STRING);
            $contrasenia = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
            if (!($usr || $contrasenia)) { //Filtrado de variables
                echo 2;
                die;
            }

            $contrasenia = hash("SHA256", $contrasenia);
            $SQL = MySQLDB::getInstance()->query("SELECT * 
                                                      FROM auth 
                                                      INNER JOIN usr ON usr.idUsr = auth.idUsr 
                                                      INNER JOIN config ON config.idUsr = auth.idUsr	 
                                                      WHERE usr = '$usr' AND usr.status = '1'");

            if (mysqli_num_rows($SQL) > 0) {
                $rs = mysqli_fetch_assoc($SQL);
                $user = $rs["usr"];
                $pass = $rs["pass"];

                $_SESSION["usr"] = $usr;
                $_SESSION['idUsr'] = $rs['idUsr'];
                $_SESSION['rol'] = $rs['rol'];
                $_SESSION['color_fondo'] = $rs['color_fondo'];
                $_SESSION['fuente_texto'] = $rs['fuente_texto'];
                $_SESSION['avatar'] = $rs['avatar'];
                $_SESSION['logeo'] = 1;
                echo 1;
                die;
            } else {
                echo 0;
                die;
            }
        } else {
            echo 2;
            die;
        }
    }
}







