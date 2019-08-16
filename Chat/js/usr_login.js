$(document).ready(function () {
    $.ajax({
        type: 'POST',
        url: 'archivos_proceso/proceso_login.php',
        data: {
            'accion': 1,
        },
        success: function (response) {
            if (response == 1) { //Usuario logeado
                setInterval(carga_mensaje, 1000);

                $('#bajar').click(function () {
                    bajar();
                });

                $('#enviar').click(function () {
                    enviar_mensaje();
                    bajar();
                });
                $(document).on('keyup', function (e) {
                    if (e.key == "Enter") {
                        enviar_mensaje();
                        bajar();
                    }
                });

            } else if (response == 0) { //Usuario no logeado

                $("#cuerpo").append('<div id="login" class="modal fade" role="dialog">' +
                    '  <div class="modal-dialog">' +
                    '    <div class="modal-content modal-content-gradiente">' +
                    '      <div class="modal-body">' +
                    '        <h4>Login</h4>' +
                    '        <form>' +
                    '          <input type="text" id="username" class="username form-control" placeholder="Usuario"/>' +
                    '          <input type="password" id="password" class="password form-control" placeholder="Contraseña"/>' +
                    '          <a class="btn login grey lighten-5" style="color:black;" id = "logeo">Ingresar</a>' +
                    '        </form>' +
                    '        <hr>' +
                    '        <p style="text-align: center;margin-bottom: 0;"><a id = "nuevo_usuario" style="color:white;cursor: pointer;">¿Nuevo usuario?</a></p>' +
                    '      </div>' +
                    '    </div>' +
                    '  </div>  ' +
                    '</div>');


                $('#login').modal({dismissible: false});
                $('#login').modal('open');


                $("#nuevo_usuario").click(function () {
                    $('#login').modal('close');

                    $("#cuerpo").append('<div id="modal_nuevo_usuario" class="modal fade" role="dialog">' +
                        '  <div class="modal-dialog">' +
                        '    <div class="modal-content modal-content-gradiente">' +
                        '      <div class="modal-body">' +
                        '        <h4>Crear nuevo usuario</h4>' +
                        '        <form>' +
                        '           <input type="text" placeholder="Correo personal" id="mail">' +
                        '           <input type="text" placeholder="Usuario" id="user">' +
                        '           <input type="password" placeholder="Contraseña" id="pass">' +
                        '           <input type="password" placeholder="Repetir contraseña" id="pass_rep">' +
                        '           <a class="btn login grey lighten-5 disabled" style="color:black;" id = "generar_usuario">Crear nuevo usuario</a>' +
                        '        </form>' +
                        '        <hr>' +
                        '        <p style="text-align: center;margin-bottom: 0;"><a id = "volver_login" style="color:white;cursor: pointer;">Volver</a></p>' +
                        '      </div>' +
                        '    </div>' +
                        '  </div>  ' +
                        '</div>');
                    $('.modal').modal();
                    $('#modal_nuevo_usuario').modal('open');


                    $('#mail').change(function () {
                        if (isEmail($('#mail').val())){
                            $('#mail').removeClass('invalid');
                            $('#mail').addClass('valid');
                        }else{
                            $('#mail').removeClass('valid');
                            $('#mail').addClass('invalid');
                        }
                        check_valido();
                    });


                    $('#user').change(function () {
                        if ($('#user').val().length > 6 && $('#user').val().length < 14) {
                            $('#user').removeClass('invalid');
                            $('#user').addClass('valid');
                        } else {
                            $('#user').removeClass('valid');
                            $('#user').addClass('invalid');
                        }
                        check_valido();
                    });


                    $('#pass').change(function () {
                        if ($('#pass').val().length > 6 && $('#pass').val().length < 14) {
                            $('#pass').removeClass('invalid');
                            $('#pass').addClass('valid');
                        } else {
                            $('#pass').removeClass('valid');
                            $('#pass').addClass('invalid');
                        }
                        check_valido();
                    });


                    $('#pass_rep').change(function () {
                        if ($('#pass').val() == $('#pass_rep').val()) {
                            $('#pass').removeClass('invalid');
                            $('#pass').addClass('valid');
                            $('#pass_rep').removeClass('invalid');
                            $('#pass_rep').addClass('valid');
                        } else {
                            $('#pass').removeClass('valid');
                            $('#pass').addClass('invalid');
                            $('#pass_rep').removeClass('valid');
                            $('#pass_rep').addClass('invalid');
                        }
                        check_valido();
                    });

                    $('#generar_usuario').click(function () {
                        if ($('#mail').hasClass('valid') && $('#user').hasClass('valid') && $('#pass').hasClass('valid') && $('#pass_rep').hasClass('valid')) {

                            var correo = $('#mail').val();
                            var usr = $('#user').val();
                            var pass = $('#pass').val();


                            $.ajax({
                                type: 'POST',
                                url: 'archivos_proceso/crear_usuario.php',
                                data: {
                                    'mail': correo,
                                    'user': usr,
                                    'pass': pass,
                                },
                                success: function (response) {
                                    console.log(response);
                                    if (response == 1) {
                                        Swal.fire({
                                            title: 'Usuario creado!',
                                            type: 'success',
                                            confirmButtonText: 'Ok',
                                        }).then((result) => {
                                            $('#modal_nuevo_usuario').modal('close');
                                            $('#login').modal('open');
                                        });
                                    } else if (response == 2) {
                                        Swal.fire({
                                            title: 'Usuario existente!',
                                            type: 'warning',
                                        });
                                    } else if (response == 0 || response == 3) {
                                        Swal.fire({
                                            title: 'Error interno!',
                                            type: 'warning',
                                        });
                                    }
                                }
                            });
                        }
                    });

                    $('#volver_login').click(function () {
                        $('#modal_nuevo_usuario').modal('close');
                        $('#login').modal('open');
                    });
                });


                $("#logeo").click(function () {
                    var user = $('#username').val();
                    var pass = $('#password').val();
                    if (user == "" || pass == "") {
                        Swal.fire({
                            title: 'Complete los campos!',
                            type: 'warning',
                        });
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: 'archivos_proceso/proceso_login.php',
                            data: {
                                'accion': 2,
                                'usr': user,
                                'pass': pass,
                            },
                            success: function (response) {
                                console.log(response);
                                if (response == 1) {
                                    location.reload();
                                } else {
                                    Swal.fire({
                                        title: 'Usuario/Contraseña erroneos',
                                        type: 'warning',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: '¡Ok!',
                                    });
                                    console.log("ERROR: " + response);
                                }
                            }
                        });
                    }
                });
            }
        }
    });
});

$(document).on('keypress',function(e) {
    if(e.which == 13) {
        $("#logeo").click();
    }
});

function check_valido() {
    if ($('#mail').hasClass('valid') && $('#user').hasClass('valid') && $('#pass').hasClass('valid') && $('#pass_rep').hasClass('valid')) {
        $('#generar_usuario').removeClass('disabled');
    }else{
        $('#generar_usuario').addClass('disabled');
    }
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}