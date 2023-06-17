var funcion, tabña_respaldoo;

function traer_datos_de_empresa() {
    funcion = "traer_datos_de_empresa";
    $.ajax({
        url: "../ADMIN/controlador/empresa/empresa.php",
        type: "POST",
        data: { funcion: funcion },
    }).done(function (resp) {
        var data = JSON.parse(resp);
        if (data.length > 0) {
            document.getElementById("nombres_empresa").value = data[0][1];
            document.getElementById("ruc_empresa").value = data[0][2];
            document.getElementById("direccion_empresa").value = data[0][3];
            document.getElementById("telefono_empresa").value = data[0][4];
            document.getElementById("correo_empresa").value = data[0][5];
            document.getElementById("propietario_empresa").value = data[0][6];
            document.getElementById("descripcion_empresa").innerHTML = data[0][7];

            document.getElementById("foto_empresa").src = data[0][8];
            document.getElementById("foto_actual").value = data[0][8];
        }
    });
}

function cambiar_foto_perfil_empresa() {

    var foto = document.getElementById("foto_nueva").value;
    var ruta_actual = document.getElementById("foto_actual").value;

    if (foto == "" || ruta_actual.length == 0 || ruta_actual == "") {
        return swal.fire(
            "Mensaje de advertencia",
            "Ingrese una imagen para actualizar",
            "warning"
        );
    }

    var f = new Date();
    //este codigo me captura la extenion del archivo
    var extecion = foto.split(".").pop();
    //renombramoso el archivo con las hora minutos y segundos
    var nombrearchivo =
        "IMG" +
        f.getDate() +
        "" +
        (f.getMonth() + 1) +
        "" +
        f.getFullYear() +
        "" +
        f.getHours() +
        "" +
        f.getMinutes() +
        "" +
        f.getSeconds() +
        "." +
        extecion;

    var formdata = new FormData();
    var foto = $("#foto_nueva")[0].files[0];

    //est valores son como los que van en la data del ajax
    funcion = "cambiar_foto_perfilempresa";
    formdata.append("funcion", funcion);
    formdata.append("foto", foto);
    formdata.append("ruta_actual", ruta_actual);
    formdata.append("nombrearchivo", nombrearchivo);

    alerta = [
        "datos",
        "Se esta editando la imagen de empresa",
        "Editando imagen empresa",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/empresa/empresa.php",
        type: "POST",
        //aqui envio toda la formdata
        data: formdata,
        contentType: false,
        processData: false,
        success: function (resp) {
            if (resp > 0) {
                if (resp == 1) {
                    document.getElementById("foto_nueva").value = "";
                    traer_datos_de_empresa();
                    alerta = [
                        "exito",
                        "success",
                        "La foto de empresa se edito con exito",
                    ];
                    cerrar_loader_datos(alerta);
                }
            } else {
                alerta = [
                    "error",
                    "error",
                    "No se pudo editar la foto de empresa",
                ];
                cerrar_loader_datos(alerta);
            }
        },
    });
    return false;
}

function editra_datos_empresa() {
    var nomber = document.getElementById("nombres_empresa").value;
    var ruc = document.getElementById("ruc_empresa").value;
    var direcc = document.getElementById("direccion_empresa").value;
    var telefono = document.getElementById("telefono_empresa").value;
    var correo = document.getElementById("correo_empresa").value;
    var dueño = document.getElementById("propietario_empresa").value;
    var descrp = document.getElementById("descripcion_empresa").value;

    if (
        nomber.length == 0 ||
        ruc.length == 0 ||
        direcc.length == 0 ||
        telefono.length == 0 ||
        correo.length == 0 ||
        dueño.length == 0 ||
        descrp.length == 0
    ) {

        validar_registro(
            nomber,
            ruc,
            direcc,
            telefono,
            correo,
            dueño,
            descrp
        );

        return swal.fire(
            "Mensaje de alerta",
            "Ingrese todo los datos, no debe quedar ningun dato vacio",
            "warning"
        );
    } else {
        $("#nombre_empresa_oblig").html("");
        $("#ruc_obliga").html("");
        $("#dirccion_obliga").html("");
        $("#telefono_empresa").html("");
        $("#correo_empresa").html("");
        $("#propietraio_obliga").html("");
        $("#descripcion_obliga").html("");
    }


    funcion = "cambiar_datos_empresa";
    alerta = [
        "datos",
        "Se esta modificando los datos de perfil",
        "Cambiando datos del usuario",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/empresa/empresa.php",
        type: "POST",
        data: {
            funcion: funcion,
            nomber: nomber,
            ruc: ruc,
            direcc: direcc,
            telefono: telefono,
            correo: correo,
            dueño: dueño,
            descrp: descrp
        },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                traer_datos_de_empresa();
                alerta = [
                    "exito",
                    "success",
                    "Los datos de empresa se actualizo con exito",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = [
                "error",
                "error",
                "No se pudo actualizar el registro",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function validar_registro(
    nomber,
    ruc,
    direcc,
    telefono,
    correo,
    dueño,
    descrp
) {
    if (nomber.length == 0) {
        $("#nombre_empresa_oblig").html("Ingrese nombre de empresa");
    } else {
        $("#nombre_empresa_oblig").html("");
    }

    if (ruc.length == 0) {
        $("#ruc_obliga").html("Ingrese ruc empresa");
    } else {
        $("#ruc_obliga").html("");
    }

    if (direcc.length == 0) {
        $("#dirccion_obliga").html("Ingrese direccion");
    } else {
        $("#dirccion_obliga").html("");
    }

    if (telefono.length == 0) {
        $("#telefono_empresa").html("Ingrese telefono empresa");
    } else {
        $("#telefono_empresa").html("");
    }

    if (correo.length == 0) {
        $("#correo_empresa").html("Ingrese correo empresa");
    } else {
        $("#correo_empresa").html("");
    }

    if (dueño.length == 0) {
        $("#propietraio_obliga").html("Ingrese propietario de la empresa");
    } else {
        $("#propietraio_obliga").html("");
    }

    if (descrp.length == 0) {
        $("#descripcion_obliga").html("Ingrese descripcion de la empresa");
    } else {
        $("#descripcion_obliga").html("");
    }
}

////////
function ver_modal_respaldo() {
    $("#ingres_pass").val("");
    $("#conf_pass").val("");

    $("#model_respando_datos").modal({
        backdrop: "static",
        keyboard: false,
    });
    $("#model_respando_datos").modal("show");
}

function realizar_respaldo() {

    var pass1 = $("#ingres_pass").val();
    var pass2 = $("#conf_pass").val();

    if (pass1.length == 0 || pass2.length == 0) {
        return swal.fire(
            "Mensaje de advertencia",
            "Ingrese los password para ralizar el respaldo",
            "warning"
        );
    }

    if (pass1 != pass2) {
        return swal.fire(
            "Mensaje de advertencia",
            "Los 2 password no coinciden",
            "warning"
        );
    }

    funcion = "realizar_respaldo";
    alerta = [
        "datos",
        "Se esta creando el respaldo de informacion",
        "Creando respaldo",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/empresa/backup.php",
        type: "POST",
        data: {
            funcion: funcion,
            pass1: pass1,
        },
    }).done(function (response) { 
        if (response == 10) {
            alerta = [
                "error",
                "error",
                "El password ingresado es incorrecto o no pertenece a este usuario",
            ];
            cerrar_loader_datos(alerta);

        } else if (response == 20) {
            alerta = [
                "error",
                "error",
                "No se pudo crear el respando",
            ];
            cerrar_loader_datos(alerta);
        } else if (response == 1) {
            $("#model_respando_datos").modal("hide");
            tabña_respaldoo.ajax.reload();
            alerta = [
                "exito",
                "success",
                "El respando se creo con exito",
            ];
            cerrar_loader_datos(alerta);
        } else {
            alerta = [
                "error",
                "error",
                "No se pudo crear el respaldo",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function listar_respaldo() {
    funcion = "listar_respaldo";
    tabña_respaldoo = $("#tbla_respaldp").DataTable({
        ordering: true,
        paging: true,
        aProcessing: true,
        aServerSide: true,
        searching: { regex: true },
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"],
        ],
        pageLength: 10,
        destroy: true,
        async: false,
        processing: true,

        ajax: {
            url: "../ADMIN/controlador/empresa/backup.php",
            type: "POST",
            data: { funcion: funcion },
        },
        //hay que poner la misma cantidad de columnas y tambien en el html
        columns: [
            { defaultContent: "" },
            {
                data: "ruta",
                render: function (data, type, row) {
                    return `<a href="${data}" style='font-size:13px;' type='button' class='inactivar btn btn-success' title='Inactivar el Oftalmólogo'> <i class="fa fa-download"></i> </a> `;

                },
            },
            {
                data: "estado",
                render: function (data, type, row) {
                    if (data == 1) {
                        return "<span class='label label-success'>RESPALDO</span>";
                    } else {
                        return "<span class='label label-danger'>NO RESPALDO</span>";
                    }
                },
            },
            { data: "usuario" },
            { data: "fecha_hora" },
        ],

        language: {
            rows: "%d fila seleccionada",
            processing: "Tratamiento en curso...",
            search: "Buscar&nbsp;:",
            lengthMenu: "Agrupar en _MENU_ items",
            info: "Mostrando los item (_START_ al _END_) de un total _TOTAL_ items",
            infoEmpty: "No existe datos.",
            infoFiltered: "(filtrado de _MAX_ elementos en total)",
            infoPostFix: "",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontro resultados en tu busqueda",
            emptyTable: "No hay datos disponibles en la tabla",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Ultimo",
            },
            select: {
                rows: "%d fila seleccionada",
            },
            aria: {
                sortAscending: ": active para ordenar la columa en orden ascendente",
                sortDescending: ": active para ordenar la columna en orden descendente",
            },
        },
        select: true,
        responsive: "true",
        dom: "Bfrtilp",
        buttons: [
            {
                extend: "excelHtml5",
                text: "Excel",
                titleAttr: "Exportar a Excel",
                className: "btn btn-success greenlover",
            },
            {
                extend: "pdfHtml5",
                text: "PDF",
                titleAttr: "Exportar a PDF",
                className: "btn btn-danger redfule",
            },
            {
                extend: "print",
                text: "Imprimir",
                titleAttr: "Imprimir",
                className: "btn btn-primary azuldete",
            },
        ],
        order: [[0, "desc"]],
    });

    //esto es para crearn un contador para la tabla este contador es automatico
    tabña_respaldoo.on("draw.dt", function () {
        var pageinfo = $("#tbla_respaldp").DataTable().page.info();
        tabña_respaldoo
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}