<?php
include('mysqli.php');
if (isset($_SESSION['logeo'])) {
    if ($_SESSION['logeo'] != 1) {
        header('Location: index.php');
    }
} else {
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

<div>
    <?php
    include('navbar.php');
    ?>

    <table class="z-depth-5"
           style="width: 50%;margin-left: auto; margin-right: auto;background: whitesmoke;margin-top: 50px;">
        <tbody>
        <tr>
            <td style="text-align: center;">
                <i class="material-icons medium">color_lens</i>
            </td>
            <td>
                <select style="display: block;background: whitesmoke;" id="color">
                    <option value="" disabled selected>Color de navbar</option>
                    <option value="red">Rojo</option>
                    <option value="purple">Violeta</option>
                    <option value="indigo">Indigo</option>
                    <option value="lime">Lima</option>
                </select>
                <select style="display: block;background: whitesmoke;" id="tonalidad">
                    <option value="" disabled selected>Tonalidad</option>
                    <option value="">Basica</option>
                    <option value="darken">Oscura</option>
                    <option value="lighten">Clara</option>
                    <option value="acent">Acentuada</option>
                </select>
                <select style="display: block;background: whitesmoke;" id="exposicion">
                    <option value="" disabled selected>Exposicion</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                    <option value="0">0</option>
                </select>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <i class="material-icons medium">text_format</i>

            </td>
            <td>
                <select style="display: block;background: whitesmoke;" id="fuente">
                    <option value="" disabled selected>Fuente del chat</option>
                    <option value="Arial">Arial</option>
                    <option value="Times New Roman">Times New Roman</option>
                    <option value="Verdana">Verdana</option>
                    <option value="Bookman">Bookman</option>
                    <option value="Comic Sans MS">Comic Sans MS</option>
                    <option value="Impact">Impact</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <button id="enviar" class="btn grey lighten-5" style="color: #282828">Guardar cambios</button>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <form action="archivos_proceso/carga_archivos.php" method="post" enctype="multipart/form-data"
                      id="form_subir_imagen">
                    <div class="file-field input-field">
                        <div class="btn grey lighten-5" style="color: #282828">
                            <span>Buscar</span>
                            <input type="file" name="imagen" id="imagen">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Modificar su avatar">
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <input class="btn btn-small grey lighten-5" type="submit" value="Modificar"
                               style="color: #282828;">
                    </div>
                </form>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <button style="color: red;background: rgba(255,255,255,0); border: 0px;" id="borrar">
                    <i class="material-icons medium">delete_forever</i>
                    <p>¿Borrar cuenta?</p>
                </button>
            </td>
        </tr>
        </tbody>
    </table>


</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

<script src="js/salas.js"></script>
<div id="salas" class="modal fade" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content <?php echo $_SESSION['color_fondo']; ?>">
            <div class="modal-body">
                <h4>Salas de chat disponibles</h4>
                <hr>
                <div id="cuerpo_salas"></div>
            </div>
            <?php
            if ($_SESSION['rol'] == 2) {
                echo '<hr>
                    <button class="btn grey lighten-5" style="color: #282828" id="crear_sala">Crear sala</button>';
            }
            ?>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#borrar').click(function () {
            Swal.fire({
                title: '¿Está seguro?',
                text: "Esta es una acción irreversible!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Borrar!',
                cancelButtonText: 'Cancelar!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: 'archivos_proceso/borrar_usuario.php',
                        success: function (response) {
                            if (response == 1) {
                                Swal.fire({
                                    title: 'Cuenta eliminada!',
                                    type: 'success',
                                })
                            } else {
                                Swal.fire({
                                    title: 'Error de sistema!',
                                    type: 'error',
                                })
                            }
                        }
                    });

                }
            })
        });

        $('#enviar').click(function () {
            var color = $('#color').find("option:selected").val();
            var tonalidad = $('#tonalidad').find("option:selected").val();
            var exposicion = $('#exposicion').find("option:selected").val();
            var fuente = $('#fuente').find("option:selected").val();

            if (color == "") {
                color = "red";
            } else if (tonalidad == "") {
                tonalidad = "";
            } else if (exposicion == "") {
                exposicion = "";
            } else if (fuente == "") {
                fuente = "Arial";
            }
            $.ajax({
                type: 'POST',
                url: 'archivos_proceso/modificar_configuracion.php',
                data: {
                    'color': color,
                    'tonalidad': tonalidad,
                    'exposicion': exposicion,
                    'fuente': fuente,
                },
                success: function (response) {
                    if (response == 1) {
                        Swal.fire({
                            title: 'Cambios realizados correctamente',
                            type: 'success',
                            confirmButtonColor: '#3085d6',
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        })

                    } else {
                        console.log("ERROR " + response);
                    }
                }
            });

        });
    });
</script>

</body>
</html>
