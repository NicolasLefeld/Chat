<?php
include ('mysqli.php');
if (isset($_SESSION['logeo'])){
    if ($_SESSION['logeo'] != 1){
        header('Location: index.php');
    }
}else{
    header('Location: index.php');
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Menu</title>
        <meta name="google-signin-client_id"
              content="1085646747577-fs1oskls25khvmag2fhcfuubjr93quc2.apps.googleusercontent.com">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="estilos/estilos.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
              integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
              crossorigin="anonymous">
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Lobster">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    </head>
    <body class="body_main">


    <?php
    include('navbar.php');
    ?>

    <table class="responsive-table striped z-depth-5"
           style="background: white;width: 40%; margin-left: auto;margin-right: auto;margin-top: 100px;">
        <thead>
        <tr>
            <td colspan="2" style="text-align: center;">
                DATOS DEL USUARIO
            </td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="2" style="text-align: center;">
                <img src="estilos/img/avatar_usr/<?php echo $_SESSION['avatar'];?>" style="max-height: 80px;border-radius: 20px;">
            </td>
        </tr>
        <tr>
            <td>
                ID
            </td>
            <td>
                <?php echo "#".$_SESSION['idUsr']; ?>
            </td>
        </tr>
        <tr>
            <td>
                ROL
            </td>
            <td>
                <?php

                $sql = MySQLDB::getInstance()->query("SELECT rol FROM roles WHERE id_rol = " . $_SESSION['rol'] . " ");
                $rs = $sql->fetch_assoc();
                echo $rs['rol']; ?>
            </td>
        </tr>
        </tbody>
    </table>

    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

    <script src="js/salas.js"></script>


    <div id="salas" class="modal fade" role="dialog" style="display: none;">
        <div class="modal-dialog" >
            <div class="modal-content <?php echo $_SESSION['color_fondo']; ?>">
                <div class="modal-body">
                    <h4>Salas de chat disponibles</h4>
                    <hr>
                    <div id="cuerpo_salas"></div>
                </div>
                <?php
                if ($_SESSION['rol'] == 2){
                    echo '<hr>
                    <button class="btn grey lighten-5" style="color: #282828" id="crear_sala">Crear sala</button>';
                }
                ?>
            </div>
        </div>
    </div>
    </html>
<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 4/7/2019
 * Time: 10:43 PM
 */