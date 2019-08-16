$('#chat_selection').click(function () {
    $("#cuerpo").append('');


    $('.modal').modal();
    $('#salas').modal('open');


    //Proceso para la creacion de salas
    $('#crear_sala').click(function () {
        $('#salas').modal('close');


        Swal.mixin({
            input: 'text',
            confirmButtonText: 'Next &rarr;',
            showCancelButton: true,
            progressSteps: ['1', '2']
        }).queue([
            {
                title: 'Nombre de la sala'
            },
            'Cantidad máxima de usuarios'
        ]).then((result) => {
            if (result.value) {

                $.ajax({
                    type: 'POST',
                    url: 'archivos_proceso/proceso_salas.php',
                    data: {
                        'accion': 1,
                        'datos': result.value,
                    },
                    success: function (response) {
                        if (response == 1) {
                            Swal.fire({
                                title: 'Sala creada!',
                                type: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok!'
                            });
                        } else {
                            console.log("Error: " + response);
                        }
                    }
                });
            }
        });
    });


    //Proceso para el cambio de sala de un usuario
    var cuerpo_salas = "";
    $.ajax({
        type: 'POST',
        url: 'archivos_proceso/proceso_salas.php',
        data: {
            'accion': 0,
        },
        success: function (response) {
            $('#cuerpo_salas').empty();
            if (response != 0 && response != 1 && response != "") {
                var salas = JSON.parse(response);
                if (salas.length > 0) {
                    var cantidad_paginas = 0;
                    for (var i = 0; i < salas.length - 1; i++) {
                        if ((i % 7) == 0) {
                            $('#cuerpo_salas').append('<div id="contenedor' + cantidad_paginas + '" style="display: none;"></div>');
                            var j = cantidad_paginas;
                            cantidad_paginas++;
                        }
                        $('#contenedor' + j).append("<button class = 'btn grey lighten-5' style='color: #282828;' id = 'sala" + (salas[i]['nombre']).replace(/ /g,"_") + "'>" + salas[i]['nombre'] + "</button>&nbsp;");


                        $('#sala' + (salas[i]['nombre']).replace(/ /g,"_")).click(function () {
                            $.ajax({
                                type: 'POST',
                                url: 'archivos_proceso/proceso_salas.php',
                                data: {
                                    'accion': 3,
                                    'update_sala': $(this).attr('id').substr(4).replace(/_/g, ' '),
                                },
                                success: function (response) {
                                    if (response == 1) {
                                        console.log("OK");
                                        $('#salas').modal('close');
                                    } else {
                                        console.log("Error: " + response);
                                    }
                                }
                            })
                        });
                    }

                    //Paginas

                    $('#cuerpo_salas').append('<div style="text-align: center;color: white;mix-blend-mode: difference;"><br>' +
                        '<ul class="pagination" id="contenedor_botones_paginas"> </ul></div>');

                    for (i = 0; i < cantidad_paginas; i++) {
                        $('#contenedor_botones_paginas').append('<li class="waves-effect botones_paginas" id="' + i + '"><a>' + (i + 1) + '</a></li>');
                    }


                    $('.botones_paginas').click(function () {
                        for (i = 0; i < cantidad_paginas; i++) {
                            $('#contenedor' + i).hide();
                        }

                        var id_pagina = $(this).attr('id');
                        $('#contenedor' + id_pagina).show();

                    });


                    $('#contenedor0').show();
                }
            } else {
                console.log("Error: " + response);
            }
        }
    });
});
