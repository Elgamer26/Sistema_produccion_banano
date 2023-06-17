var funcion, tabla_empleado;

function guardar_empledo() {
    var nombre = document.getElementById("nombres").value;
    var apellidos = document.getElementById("apellidos").value;
    var fecha = document.getElementById("fecha_nacimiento").value;
    var numero_docu = document.getElementById("numero_docu").value;
    var direccions = document.getElementById("direccions").value;
    var telefono_empleado = document.getElementById("telefono_empleado").value;
    var correo_empleado = document.getElementById("correo_empleado").value;
    var sexo = document.getElementById("sexo").value;
    var foto = document.getElementById("foto").value;

    if (
        nombre.length == 0 ||
        apellidos.length == 0 ||
        fecha.length == 0 ||
        numero_docu.length == 0 ||
        direccions.length == 0 ||
        telefono_empleado.length == 0 ||
        correo_empleado.length == 0
    ) {
        validar_registro_empleado(
            nombre,
            apellidos,
            fecha,
            numero_docu,
            direccions,
            telefono_empleado,
            correo_empleado
        );

        return swal.fire(
            "Campo vacios",
            "Debe ingresar todos los datos en los campos",
            "warning"
        );
    } else {
        $("#nombre_oblig").html("");
        $("#apellido_obliga").html("");
        $("#fecah_obliga").html("");
        $("#dcoumento_obliga").html("");
        $("#direccion_obliga").html("");
        $("#telefono_obliga").html("");
        $("#correo_obliga").html("");
    }

    //para scar la fecha para la foto
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
    var foto = $("#foto")[0].files[0];
    //est valores son como los que van en la data del ajax

    alerta = [
        "datos",
        "Se esta creando el empleado",
        "Creando empleado",
    ];
    mostar_loader_datos(alerta);

    funcion = "registra_empleado";

    formdata.append("funcion", funcion);
    formdata.append("nombre", nombre);
    formdata.append("apellidos", apellidos);
    formdata.append("fecha", fecha);
    formdata.append("numero_docu", numero_docu);
    formdata.append("direccions", direccions);
    formdata.append("telefono_empleado", telefono_empleado);
    formdata.append("correo_empleado", correo_empleado);
    formdata.append("sexo", sexo);

    formdata.append("foto", foto);
    formdata.append("nombrearchivo", nombrearchivo);

    $.ajax({
        url: "../ADMIN/controlador/empleado/empleado.php",
        type: "POST",
        //aqui envio toda la formdata
        data: formdata,
        contentType: false,
        processData: false,
        success: function (resp) {
            if (resp > 0) {
                if (resp == 1) {

                    alerta = ["exito", "success", "El empleado se registro con exito"];
                    cerrar_loader_datos(alerta);
                    cargar_contenido('contenido_principal', 'vista/empreado/nuevo_empreado.php');

                } else if (resp == 2) {
                    alerta = [
                        "existe",
                        "warning",
                        "El nombre " +
                        nombre +
                        " y " + apellidos + ", ya esta registrado",
                    ];
                    cerrar_loader_datos(alerta);
                } else if (resp == 3) {
                    alerta = [
                        "existe",
                        "warning",
                        "La cedula " +
                        numero_docu +
                        ", ya esta registrado",
                    ];
                    cerrar_loader_datos(alerta);
                } else if (resp == 4) {
                    alerta = [
                        "existe",
                        "warning",
                        "El correo " + correo_empleado + ", ya estan registrados",
                    ];
                    cerrar_loader_datos(alerta);
                }
            } else {
                alerta = [
                    "error",
                    "error",
                    "Error al registrar el empleado",
                ];
                cerrar_loader_datos(alerta);
            }
        },
    });
    return false;
}

function validar_registro_empleado(
    nombre,
    apellidos,
    fecha,
    numero_docu,
    direccions,
    telefono_empleado,
    correo_empleado
) {
    if (nombre.length == 0) {
        $("#nombre_oblig").html("Ingrese nombres");
    } else {
        $("#nombre_oblig").html("");
    }

    if (apellidos.length == 0) {
        $("#apellido_obliga").html("Ingrese apellidos");
    } else {
        $("#apellido_obliga").html("");
    }

    if (fecha.length == 0) {
        $("#fecah_obliga").html("Ingrese fecha");
    } else {
        $("#fecah_obliga").html("");
    }

    if (numero_docu.length == 0) {
        $("#dcoumento_obliga").html("Ingrese numero documento");
    } else {
        $("#dcoumento_obliga").html("");
    }

    if (direccions.length == 0) {
        $("#direccion_obliga").html("Ingrese direccion");
    } else {
        $("#direccion_obliga").html("");
    }

    if (telefono_empleado.length == 0) {
        $("#telefono_obliga").html("Ingrese telefono");
    } else {
        $("#telefono_obliga").html("");
    }

    if (correo_empleado.length == 0) {
        $("#correo_obliga").html("Ingrese correo");
    } else {
        $("#correo_obliga").html("");
    }
}

function listar_empleado() {
    funcion = "listar_empleado";
    tabla_empleado = $("#tabla_empleados_").DataTable({
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
            url: "../ADMIN/controlador/empleado/empleado.php",
            type: "POST",
            data: { funcion: funcion },
        },
        //hay que poner la misma cantidad de columnas y tambien en el html
        columns: [
            { defaultContent: "" },
            {
                data: "estado",
                render: function (data, type, row) {
                    if (data == 1) {
                        return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el usuario'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el usuario'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='file btn btn-warning' title='Editar el permiso'><i class='fa fa-file'></i></button> - <button style='font-size:13px;' type='button' class='photo btn btn-success' title='Editar la foto'><i class='fa fa-photo'></i></button>`;
                    } else {
                        return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el usuario'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el usuario'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='file btn btn-warning' title='Editar el permiso'><i class='fa fa-file'></i></button> - <button style='font-size:13px;' type='button' class='photo btn btn-success' title='Editar la foto'><i class='fa fa-photo'></i></button>`;
                    }
                },
            },
            {
                data: "estado",
                render: function (data, type, row) {
                    if (data == 1) {
                        return "<span class='label label-success'>ACTIVO</span>";
                    } else {
                        return "<span class='label label-danger'>INACTIVO</span>";
                    }
                },
            },
            {
                data: "hoja_vida",
                render: function (data, type, row) {
                    if (data == 1) {
                        return "<span class='label label-success'>SI TIENE</span>";
                    } else {
                        return "<span class='label label-danger'>NO TIENE</span>";
                    }
                },
            },
            { data: "nombres" },
            { data: "apellidos" },
            { data: "sexo" },
            {
                data: "foto",
                render: function (data, type, row) {

                    return "<img class='img-circle' src='" + data + "' width='45px' />";
                }
            },
            { data: "fecha" },
            { data: "cedula" },
            { data: "direccion" },
            { data: "telefono" },
            { data: "correo" },
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
        order: [[0, "ASC"]],
    });

    //esto es para crearn un contador para la tabla este contador es automatico
    tabla_empleado.on("draw.dt", function () {
        var pageinfo = $("#tabla_empleados_").DataTable().page.info();
        tabla_empleado
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

function guardar_hoja() {
    var id = document.getElementById("id_empleado").value;
    var nombres = document.getElementById("nombres").value;

    var primaria_estudio = document.getElementById("primaria_estudio").value;
    var secundaria_estudio = document.getElementById("secundaria_estudio").value;
    var superior_estudio = document.getElementById("superior_estudio").value;
    var cursos_relizados = document.getElementById("cursos_relizados").value;
    var licencia_conducir = document.getElementById("licencia_conducir").value;

    var tipo_licencia = document.getElementById("tipo_licencia").value;
    var ultimo_trabajo = document.getElementById("ultimo_trabajo").value;
    var expe_laboral = document.getElementById("expe_laboral").value;

    if (id.length == 0 || nombres.length == 0) {
        validar_registro_hoja(id, nombres);
        return swal.fire(
            "Campo vacios",
            "Debe ingresar datos del empleado",
            "warning"
        );
    } else {
        $("#cedula_oblig").html("");
        $("#nombre_oblig").html("");
    }

    if (primaria_estudio.length == 0 || secundaria_estudio.length == 0 || superior_estudio.length == 0 || cursos_relizados.length == 0 ||
        ultimo_trabajo.length == 0 || expe_laboral.length == 0) {
        validar_registro_hoja_registro(primaria_estudio, secundaria_estudio, superior_estudio, cursos_relizados, ultimo_trabajo, expe_laboral);
        return swal.fire(
            "Campo vacios",
            "Debe ingresar datos de la hoja de vida del empleado",
            "warning"
        );
    } else {
        $("#primaria_oblig").html("");
        $("#secundaria_oblig").html("");
        $("#superior_oblig").html("");
        $("#cursos_oblig").html("");
        $("#ultimo_trabajo_oblig").html("");
        $("#expe_laboral_oblig").html("");
    }

    funcion = "crear_hoja_vida";
    alerta = [
        "datos",
        "Se esta creando la hoja de vida",
        "Creando hoja de vida",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/empleado/empleado.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id,
            primaria_estudio: primaria_estudio,
            secundaria_estudio: secundaria_estudio,
            superior_estudio: superior_estudio,
            cursos_relizados: cursos_relizados,
            licencia_conducir: licencia_conducir,
            tipo_licencia: tipo_licencia,
            ultimo_trabajo: ultimo_trabajo,
            expe_laboral: expe_laboral,

        },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "La hoja de vida se creo con exito"];
                cerrar_loader_datos(alerta);
                cargar_contenido('contenido_principal', 'vista/empreado/crear_hoja_vida.php');
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al crear la hoja de vida",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function validar_registro_hoja(
    id,
    nombres
) {
    if (id.length == 0) {
        $("#cedula_oblig").html("Ingrese dato");
    } else {
        $("#cedula_oblig").html("");
    }

    if (nombres.length == 0) {
        $("#nombre_oblig").html("Ingrese dato");
    } else {
        $("#nombre_oblig").html("");
    }


}

function validar_registro_hoja_registro(primaria_estudio, secundaria_estudio, superior_estudio, cursos_relizados, ultimo_trabajo, expe_laboral) {
    if (primaria_estudio.length == 0) {
        $("#primaria_oblig").html("Ingrese dato");
    } else {
        $("#primaria_oblig").html("");
    }

    if (secundaria_estudio.length == 0) {
        $("#secundaria_oblig").html("Ingrese dato");
    } else {
        $("#secundaria_oblig").html("");
    }

    if (superior_estudio.length == 0) {
        $("#superior_oblig").html("Ingrese dato");
    } else {
        $("#superior_oblig").html("");
    }

    if (cursos_relizados.length == 0) {
        $("#cursos_oblig").html("Ingrese dato");
    } else {
        $("#cursos_oblig").html("");
    }

    if (ultimo_trabajo.length == 0) {
        $("#ultimo_trabajo_oblig").html("Ingrese dato");
    } else {
        $("#ultimo_trabajo_oblig").html("");
    }

    if (expe_laboral.length == 0) {
        $("#expe_laboral_oblig").html("Ingrese dato");
    } else {
        $("#expe_laboral_oblig").html("");
    }
}

$("#tabla_empleados_").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_empleado.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_empleado.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_empleado.row(this).data();
    }
    var dato = 0;
    var id = data.id_empleado;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del empleado se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_empleado(id, dato);
        }
    });
});

$("#tabla_empleados_").on("click", ".activar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_empleado.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_empleado.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_empleado.row(this).data();
    }
    var dato = 1;
    var id = data.id_empleado;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del empleado se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_empleado(id, dato);
        }
    });
});

function cambiar_estado_empleado(id, dato) {
    var res = "";
    if (dato == 1) {
        res = "activo";
    } else {
        res = "inactivo";
    }

    funcion = "estado_empleado";
    alerta = [
        "datos",
        "Se esta cambiando el estado a " + res + "",
        "Cambiando estado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/empleado/empleado.php",
        type: "POST",
        data: { id: id, dato: dato, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                cerrar_loader_datos(alerta);
                tabla_empleado.ajax.reload();
            }
        } else {
            alerta = [
                "error",
                "error",
                "No se pudo cambiar el estado",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

$("#tabla_empleados_").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_empleado.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_empleado.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_empleado.row(this).data();
    }

    document.getElementById("id_empleado_edit").value = data.id_empleado;
    document.getElementById("nombres").value = data.nombres;
    document.getElementById("apellidos").value = data.apellidos;
    document.getElementById("fecha_nacimiento").value = data.fecha;
    document.getElementById("numero_docu").value = data.cedula;
    document.getElementById("direccions").value = data.direccion;
    document.getElementById("telefono_empleado").value = data.telefono;
    document.getElementById("correo_empleado").value = data.correo;
    document.getElementById("sexo").value = data.sexo;


    $("#numero_docu").css("border", "1px solid green");
    $("#cedula_empleado").html("");

    $("#correo_empleado").css("border", "1px solid green");
    $("#email_correcto").html("");

    $("#nombre_oblig").html("");
    $("#apellido_obliga").html("");
    $("#fecah_obliga").html("");
    $("#dcoumento_obliga").html("");
    $("#direccion_obliga").html("");
    $("#telefono_obliga").html("");
    $("#correo_obliga").html("");

    $("#modal_editar_empleado").modal({ backdrop: "static", keyboard: false });
    $("#modal_editar_empleado").modal("show");
});

function editar_usuario() {
    var id = document.getElementById("id_empleado_edit").value;
    var nombre = document.getElementById("nombres").value;
    var apellidos = document.getElementById("apellidos").value;
    var fecha = document.getElementById("fecha_nacimiento").value;
    var numero_docu = document.getElementById("numero_docu").value;
    var direccions = document.getElementById("direccions").value;
    var telefono_empleado = document.getElementById("telefono_empleado").value;
    var correo_empleado = document.getElementById("correo_empleado").value;
    var sexo = document.getElementById("sexo").value;

    if (
        nombre.length == 0 ||
        apellidos.length == 0 ||
        fecha.length == 0 ||
        numero_docu.length == 0 ||
        direccions.length == 0 ||
        telefono_empleado.length == 0 ||
        correo_empleado.length == 0
    ) {
        validar_registro_empleado_edit(
            nombre,
            apellidos,
            fecha,
            numero_docu,
            direccions,
            telefono_empleado,
            correo_empleado
        );

        return swal.fire(
            "Campo vacios",
            "Debe ingresar todos los datos en los campos",
            "warning"
        );
    } else {
        $("#nombre_oblig").html("");
        $("#apellido_obliga").html("");
        $("#fecah_obliga").html("");
        $("#dcoumento_obliga").html("");
        $("#direccion_obliga").html("");
        $("#telefono_obliga").html("");
        $("#correo_obliga").html("");
    }

    funcion = "editar_empleado";
    alerta = [
        "datos",
        "Se esta editando el empleado",
        "Editando empleado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/empleado/empleado.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id,
            nombre: nombre,
            apellidos: apellidos,
            fecha: fecha,
            numero_docu: numero_docu,
            direccions: direccions,
            telefono_empleado: telefono_empleado,
            correo_empleado: correo_empleado,
            sexo: sexo,
        },
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {

                alerta = ["exito", "success", "El empleado se edito con exito"];
                cerrar_loader_datos(alerta);
                $("#modal_editar_empleado").modal("hide");
                tabla_empleado.ajax.reload();

            } else if (resp == 2) {
                alerta = [
                    "existe",
                    "warning",
                    "El nombre " +
                    nombre +
                    " y " + apellidos + ", ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            } else if (resp == 3) {
                alerta = [
                    "existe",
                    "warning",
                    "La cedula " +
                    numero_docu +
                    ", ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            } else if (resp == 4) {
                alerta = [
                    "existe",
                    "warning",
                    "El correo " + correo_empleado + ", ya estan registrados",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al editar el empleado",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function validar_registro_empleado_edit(
    nombre,
    apellidos,
    fecha,
    numero_docu,
    direccions,
    telefono_empleado,
    correo_empleado
) {
    if (nombre.length == 0) {
        $("#nombre_oblig").html("Ingrese nombres");
    } else {
        $("#nombre_oblig").html("");
    }

    if (apellidos.length == 0) {
        $("#apellido_obliga").html("Ingrese apellidos");
    } else {
        $("#apellido_obliga").html("");
    }

    if (fecha.length == 0) {
        $("#fecah_obliga").html("Ingrese fecha");
    } else {
        $("#fecah_obliga").html("");
    }

    if (numero_docu.length == 0) {
        $("#dcoumento_obliga").html("Ingrese numero documento");
    } else {
        $("#dcoumento_obliga").html("");
    }

    if (direccions.length == 0) {
        $("#direccion_obliga").html("Ingrese direccion");
    } else {
        $("#direccion_obliga").html("");
    }

    if (telefono_empleado.length == 0) {
        $("#telefono_obliga").html("Ingrese telefono");
    } else {
        $("#telefono_obliga").html("");
    }

    if (correo_empleado.length == 0) {
        $("#correo_obliga").html("Ingrese correo");
    } else {
        $("#correo_obliga").html("");
    }
}

$("#tabla_empleados_").on("click", ".file", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_empleado.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_empleado.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_empleado.row(this).data();
    }

    var id = data.id_empleado;

    alerta = [
        "datos",
        "Cargando datos de la hoja de vida",
        "Hoja de vida",
    ];
    mostar_loader_datos(alerta);
    traer_datos_hoja_vida(parseInt(id));
});

function traer_datos_hoja_vida(id) {
    funcion = "traer_datos_hoja_vida";
    $.ajax({
        url: "../ADMIN/controlador/empleado/empleado.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id
        },
    }).done(function (resp) {
        if (resp != 0) {
            var data = JSON.parse(resp);
            $("#id_empleado_hoja").val(id);
            $("#id_hoja_vida").val(data[0][0]);
            $("#primaria_estudio").val(data[0][2]);
            $("#secundaria_estudio").val(data[0][3]);
            $("#superior_estudio").val(data[0][4]);
            $("#cursos_relizados").val(data[0][5]);
            $("#licencia_conducir").val(data[0][6]);
            $("#tipo_licencia").val(data[0][7]);
            $("#ultimo_trabajo").val(data[0][8]);
            $("#expe_laboral").val(data[0][9]);

            alerta = [
                "",
                "",
                "",
            ];
            cerrar_loader_datos(alerta);

            $("#modal_hoja_vida").modal({ backdrop: "static", keyboard: false });
            $("#modal_hoja_vida").modal("show");
        } else {
            $("#id_empleado_hoja").val("");
            $("#id_hoja_vida").val("");
            $("#primaria_estudio").val("");
            $("#secundaria_estudio").val("");
            $("#superior_estudio").val("");
            $("#cursos_relizados").val("");
            $("#licencia_conducir").val("");
            $("#tipo_licencia").val("");
            $("#ultimo_trabajo").val("");
            $("#expe_laboral").val("");

            alerta = [
                "error",
                "error",
                "El empleado no tiene una hoja de vida creada",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function editar_hoja_vida() {
    var id_hoja = document.getElementById("id_hoja_vida").value;
    var id = document.getElementById("id_empleado_hoja").value;

    var primaria_estudio = document.getElementById("primaria_estudio").value;
    var secundaria_estudio = document.getElementById("secundaria_estudio").value;
    var superior_estudio = document.getElementById("superior_estudio").value;
    var cursos_relizados = document.getElementById("cursos_relizados").value;
    var licencia_conducir = document.getElementById("licencia_conducir").value;
    var tipo_licencia = document.getElementById("tipo_licencia").value;
    var ultimo_trabajo = document.getElementById("ultimo_trabajo").value;
    var expe_laboral = document.getElementById("expe_laboral").value;

    if (primaria_estudio.length == 0 || secundaria_estudio.length == 0 || superior_estudio.length == 0 || cursos_relizados.length == 0 ||
        ultimo_trabajo.length == 0 || expe_laboral.length == 0) {
        return swal.fire(
            "Campo vacios",
            "Debe ingresar datos de la hoja de vida del empleado",
            "warning"
        );
    }

    funcion = "editar_hoja_vida";
    alerta = [
        "datos",
        "Se esta editando la hoja de vida",
        "Editando hoja de vida",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/empleado/empleado.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id,
            id_hoja, id_hoja,
            primaria_estudio: primaria_estudio,
            secundaria_estudio: secundaria_estudio,
            superior_estudio: superior_estudio,
            cursos_relizados: cursos_relizados,
            licencia_conducir: licencia_conducir,
            tipo_licencia: tipo_licencia,
            ultimo_trabajo: ultimo_trabajo,
            expe_laboral: expe_laboral,

        },
    }).done(function (response) {
        console.log(response);
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "La hoja de vda se edito con exito"];
                cerrar_loader_datos(alerta);
                $("#modal_hoja_vida").modal("hide");
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al editar la hoja de vida",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

$("#tabla_empleados_").on("click", ".photo", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_empleado.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_empleado.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_empleado.row(this).data();
    }

    var id = data.id_empleado;
    var foto = data.foto;

    $("#id_foto_emplead").val(id);
    $("#foto_actu").val(foto);
    $("#foto_empleado").attr("src", foto);

    $("#modal_editar_foto").modal({ backdrop: "static", keyboard: false });
    $("#modal_editar_foto").modal("show");

});

function editar_foto_empleado() {

    var id = document.getElementById("id_foto_emplead").value;
    var foto = document.getElementById("foto_new").value;
    var ruta_actual = document.getElementById("foto_actu").value;

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

    if (foto == "" || ruta_actual.length == 0 || ruta_actual == "") {
        return swal.fire(
            "Mensaje de advertencia",
            "Ingrese una imagen para actualizar",
            "warning"
        );
    }

    var formdata = new FormData();
    var foto = $("#foto_new")[0].files[0];

    //est valores son como los que van en la data del ajax
    funcion = "editar_foto_empleado";
    formdata.append("funcion", funcion);
    formdata.append("id", id);
    formdata.append("foto", foto);
    formdata.append("ruta_actual", ruta_actual);
    formdata.append("nombrearchivo", nombrearchivo);

    alerta = [
        "datos",
        "Se esta editando la imagen del empleado",
        "Editando imagen empleado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/empleado/empleado.php",
        type: "POST",
        //aqui envio toda la formdata
        data: formdata,
        contentType: false,
        processData: false,
        success: function (resp) {
            if (resp > 0) {
                if (resp == 1) {
                    document.getElementById("foto_new").value = "";
                    tabla_empleado.ajax.reload();
                    alerta = [
                        "exito",
                        "success",
                        "La foto de empleado se edito con exito",
                    ];
                    cerrar_loader_datos(alerta);
                    $("#modal_editar_foto").modal("hide");
                }
            } else {
                alerta = [
                    "error",
                    "error",
                    "No se pudo editar la foto de perfil",
                ];
                cerrar_loader_datos(alerta);
            }
        },
    });
    return false;
}

/////////////////////////////
function listar_hoja_empleado() {
    funcion = "listar_hoja_empleado";
    $.ajax({
      url: "../ADMIN/controlador/empleado/empleado.php",
      type: "POST",
      data: { funcion: funcion },
    }).done(function (response) {
      var data = JSON.parse(response);
      var cadena = "";
      if (data.length > 0) {
        //bucle para extraer los datos del rol
        for (var i = 0; i < data.length; i++) {
          cadena +=
            "<option value='" + data[i][0] + "'> " + data[i][2] + " - " + data[i][3] + " - " + data[i][4] + " </option>";
        }
        //aqui concadenamos al id del select
        $("#empleado_hoja").html(cadena);
      } else {
        cadena += "<option value=''>No hay datos</option>";
        $("#empleado_hoja").html(cadena);
      }
    });
  }
