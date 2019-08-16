<?php
include('mysqli.php');
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
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Lobster">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body class="body_main" id="body" style="overflow: hidden;">

<?php
include('navbar.php');
?>


<div style="height: 105%;" id="cuerpo">

    <div id="salas" class="modal fade" role="dialog" style="display: none;">
        <div class="modal-dialog">
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

    <div id="chat-field"
         style="height:80%;background: rgba(255,255,255,0.76);overflow: auto;font-family: '<?php echo $_SESSION['fuente_texto']; ?>', sans-serif!important;">

    </div>

    <div style="position: fixed;bottom: 0;width: 100%; background: white;text-align: center;">
        <input type="text" style="background: white; width: 95%;margin: 0;" id="texto"
               placeholder="Su mensaje aqui...">
        <button class="btn-floating btn-small waves-effect waves-light red" style="border: 0; margin: 0; padding: 0;"
                id="bajar"><i class="material-icons">arrow_drop_down</i></button>

    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

<script src="js/salas.js"></script>
<script src="js/usr_login.js"></script>

<script>
    function bajar() {
        $('#chat-field').animate({scrollTop: $('#chat-field').prop("scrollHeight")}, 1000); //Scrolling del div
    }

    function enviar_mensaje() {
        $.ajax({
            type: 'POST',
            url: 'archivos_proceso/enviar_mensaje.php',
            data: {
                'mensaje': $('#texto').val(),
            },
            success: function (response) {
                if (response == 1) {
                    console.log("OK");
                    $('#texto').val('');
                } else {
                    console.log("ERROR " + response);
                }
            }
        });

    }

    function carga_mensaje() {
        var cuerpo = "";

        $.ajax({
            type: 'POST',
            url: 'archivos_proceso/cargar_mensaje.php',
            success: function (response) {
                $('#chat-field').empty();
                if (response == 0){
                    console.log("Todo mal");
                }else if (response != 0) {
                    var arreglo = JSON.parse(response);

                    for (var i = 0; i < arreglo.length; i++) {
                        var usuario = arreglo[i][0];
                        var texto = arreglo[i][1];
                        if (usuario != "undefined" && texto != "undefined" && cuerpo != "undefined") {
                            cuerpo = cuerpo + "<p style='margin: 0px;'><b>" + usuario + "</b> - " + texto + "</p>";
                        }
                        $('#chat-field').empty();

                        $('#chat-field').append(cuerpo); //Cargamos los mensajes en el chatfield
                    }
                } else {
                    $('#chat-field').empty();
                    console.log("ERROR " + response);
                }
            }
        });
    }
</script>

</body>
</html>