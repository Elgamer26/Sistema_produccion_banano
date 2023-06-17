var funcion, tabla_novedad, tabla_produccion_noovedad;

function modal_tipo_novedades() {
    $("#tipo_novedades").val("");
    $("#descripcion").val("");
    $("#modal_nuva_novedades").modal({ backdrop: "static", keyboard: false });
    $("#modal_nuva_novedades").modal("show");
}

function nueva_novedades() {
    var nombre = $("#tipo_novedades").val();
    var descripcion = $("#descripcion").val();

    if (nombre.length == 0 || nombre.length < 0 || nombre == "" ||
        descripcion.length == 0 || descripcion.length < 0 || descripcion == "") {
        return Swal.fire({
            icon: "warning",
            title: "No hay datos de la novedad",
            text: "Ingrese datos de novedad!!",
        });
    }

    funcion = "registrar_novedad";
    alerta = ["datos", "Se esta creando el tipo de actividad", "Creando novedad."];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/novedad/novedad.php",
        type: "POST",
        data: {
            funcion: funcion,
            nombre: nombre,
            descripcion: descripcion
        },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = [
                    "exito",
                    "success",
                    "Se creo la novedad con exito",
                ];
                cerrar_loader_datos(alerta);

                $("#tipo_novedades").val("");
                $("#descripcion").val("");
                tabla_novedad.ajax.reload();

                $("#modal_nuva_novedades").modal("hide");
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "La novedad " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo crear la novedad"];
            cerrar_loader_datos(alerta);
        }
    });
}

function listar_novedad() {
    funcion = "listar_novedad";
    tabla_novedad = $("#tabla_tipo_novedades_").DataTable({
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
            url: "../ADMIN/controlador/novedad/novedad.php",
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
                        return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el Oftalmólogo'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button>`;
                    } else {
                        return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el Oftalmólogo'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button>`;
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
            { data: "nombre" },
            { data: "descipcion" },
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
    tabla_novedad.on("draw.dt", function () {
        var pageinfo = $("#tabla_tipo_novedades_").DataTable().page.info();
        tabla_novedad
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_tipo_novedades_").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_novedad.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_novedad.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_novedad.row(this).data();
    }
    var dato = 0;
    var id = data.id_novedad;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado de la novedad se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_novedad(id, dato);
        }
    });
});

$("#tabla_tipo_novedades_").on("click", ".activar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_novedad.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_novedad.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_novedad.row(this).data();
    }
    var dato = 1;
    var id = data.id_novedad;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado de la novedad se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_novedad(id, dato);
        }
    });
});

function cambiar_estado_novedad(id, dato) {
    var res = "";
    if (dato == 1) {
        res = "activo";
    } else {
        res = "inactivo";
    }

    funcion = "cambiar_estado_novedad";
    alerta = [
        "datos",
        "Se esta cambiando el estado a " + res + "",
        "Cambiando estado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/novedad/novedad.php",
        type: "POST",
        data: { id: id, dato: dato, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                cerrar_loader_datos(alerta);
                tabla_novedad.ajax.reload();
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

$("#tabla_tipo_novedades_").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_novedad.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_novedad.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_novedad.row(this).data();
    }

    $("#id_tipo_novedades_edit").val(data.id_novedad);
    $("#tipo_novedades_edit").val(data.nombre);
    $("#descripcion_edit").val(data.descipcion);

    $("#modal_edit_tipo_novedades").modal({
        backdrop: "static",
        keyboard: false,
    });
    $("#modal_edit_tipo_novedades").modal("show");
});

function editar_tipo_novedades() {
    var id = $("#id_tipo_novedades_edit").val();
    var nombre = $("#tipo_novedades_edit").val();
    var descripcion = $("#descripcion_edit").val();

    if (nombre.length == 0 || nombre.length < 0 || nombre == "" ||
        descripcion.length == 0 || descripcion.length < 0 || descripcion == "") {
        return Swal.fire({
            icon: "warning",
            title: "No hay datos de novedad comletos",
            text: "Ingrese datos de novedad!!",
        });
    }

    funcion = "editar_tipo_novedades";
    alerta = ["datos", "Se esta editando el tipo de actividad", "Editando tipo de actividad"];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/novedad/novedad.php",
        type: "POST",
        data: {
            funcion: funcion,
            nombre: nombre,
            id: id,
            descripcion: descripcion
        },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = [
                    "exito",
                    "success",
                    "Se edito la novedad con existe",
                ];
                cerrar_loader_datos(alerta);
                tabla_novedad.ajax.reload();
                $("#modal_edit_tipo_novedades").modal("hide");
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "La novedad " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo editar la novedad"];
            cerrar_loader_datos(alerta);
        }
    });
}

////////////////////////
function traer_novedades_tipo() {
    funcion = "traer_novedades_tipo";
    $.ajax({
        url: "../ADMIN/controlador/novedad/novedad.php",
        type: "POST",
        data: { funcion: funcion },
    }).done(function (response) {
        var data = JSON.parse(response);
        var cadena = "";
        if (data.length > 0) {
            //bucle para extraer los datos del rol
            for (var i = 0; i < data.length; i++) {
                cadena +=
                    "<option value='" + data[i][0] + "'>Tipo de novedad: " + data[i][1] + "</option>";
            }
            //aqui concadenamos al id del select
            $("#novedad_ses").html(cadena);
        } else {
            cadena += "<option value=''>No hay datos de novedad</option>";
            $("#novedad_ses").html(cadena);
        }
    });
}

function registrar_noveda_produccion() {
    var prodcuciion_id = $("#prodcuciion_id").val();
    var fecha_ras_des = $("#fecha_ras_des").val();
    var numero_ra = $("#costo_novedad").val();
    var tipo_ses = $("#novedad_ses").val();
    var detalle_novedad = $("#detalle_novedad").val();

    if (prodcuciion_id.length == 0 || fecha_ras_des.length == 0 || numero_ra.length == 0 || tipo_ses.length == 0 || tipo_ses == '-----------' || detalle_novedad.length == 0) {
        validar_registro_novedad(prodcuciion_id, fecha_ras_des, numero_ra, tipo_ses, detalle_novedad);
        return Swal.fire({
            icon: "warning",
            title: "No hay datos completos",
            text: "Ingrese un datos completos!!",
        });
    } else {
        $("#prodcuciion_id_oblig").html("");
        $("#fecha_ras_des_oblig").html("");
        $("#costo_oblig").html("");
        $("#novedad_ses_oblig").html("");
        $("#detalle_obligg").html("");
    }

    funcion = "registrar_noveda_produccion";
    alerta = ["datos", "Se esta creando la novedad de produccion", "Creando la novedad de produccion."];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/novedad/novedad.php",
        type: "POST",
        data: {
            funcion: funcion,
            prodcuciion_id: prodcuciion_id,
            fecha_ras_des: fecha_ras_des,
            numero_ra: numero_ra,
            tipo_ses: tipo_ses,
            detalle_novedad:detalle_novedad
        },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "Se creo ela novedad de produccion"];
                cerrar_loader_datos(alerta);
                cargar_contenido('contenido_principal', 'vista/produccion/novedad_produccion.php');
            }
        } else {
            alerta = ["error", "error", "No se pudo crear el registro"];
            cerrar_loader_datos(alerta);
        }
    });
}

function validar_registro_novedad(prodcuciion_id, fecha_ras_des, numero_ra, tipo_ses, detalle_novedad) {
    if (prodcuciion_id.length == 0) {
        $("#prodcuciion_id_oblig").html("Ingrese produccion");
    } else {
        $("#prodcuciion_id_oblig").html("");
    }

    if (fecha_ras_des.length == 0) {
        $("#fecha_ras_des_oblig").html("Ingrese fecha");
    } else {
        $("#fecha_ras_des_oblig").html("");
    }

    if (numero_ra.length == 0) {
        $("#costo_oblig").html("Ingrese costo novedad");
    } else {
        $("#costo_oblig").html("");
    }

    if (tipo_ses.length == 0) {
        $("#novedad_ses_oblig").html("Ingrese tipo novedad");
    } else {
        $("#novedad_ses_oblig").html("");
    }

    if (detalle_novedad.length == 0) {
        $("#detalle_obligg").html("Ingrese detalle novedad");
    } else {
        $("#detalle_obligg").html("");
    }
}

function listar_novedad_produccion() {
    funcion = "listar_novedad_produccion";
    tabla_produccion_noovedad = $("#tbala_novedad").DataTable({
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
            url: "../ADMIN/controlador/novedad/novedad.php",
            type: "POST",
            data: { funcion: funcion },
        },
        //hay que poner la misma cantidad de columnas y tambien en el html
        columns: [
            { defaultContent: "" },
            {
                render: function (data, type, row) {
                    return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el Oftalmólogo'><i class='fa fa-times'></i></button>`;
                },
            },
            { data: "produccion" },
            { data: "nombre" },
            { data: "fecha" },
            { data: "costo" }, 
            { data: "detalle" }, 
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
    tabla_produccion_noovedad.on("draw.dt", function () {
        var pageinfo = $("#tbala_novedad").DataTable().page.info();
        tabla_produccion_noovedad
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tbala_novedad").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_produccion_noovedad.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_produccion_noovedad.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_produccion_noovedad.row(this).data();
    }

    var id = data.id_novedad_produccion;

    Swal.fire({
        title: "Eliminar la novedad?",
        text: "La novedad se eliminara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar!",
    }).then((result) => {
        if (result.isConfirmed) {
            eliminar_la_novedad(id);
        }
    });
});

function eliminar_la_novedad(id) {
    funcion = "eliminar_la_novedad";
    alerta = [
        "datos",
        "Eliminado la novedad",
        "Eliminando",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/novedad/novedad.php",
        type: "POST",
        data: { id: id, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "La novedad se elimino con extio"];
                cerrar_loader_datos(alerta);
                tabla_produccion_noovedad.ajax.reload();
            }
        } else {
            alerta = [
                "error",
                "error",
                "No se pudo eliminar la novedad",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}