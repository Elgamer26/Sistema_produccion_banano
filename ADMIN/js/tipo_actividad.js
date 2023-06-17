var funcion, tabla_tipo_actividad;

function modal_tipo_actividad() {
    $("#tipo_actividad").val("");
    $("#descripcion").val("");
    $("#modal_nuva_actividad").modal({ backdrop: "static", keyboard: false });
    $("#modal_nuva_actividad").modal("show");
}

function nueva_actividad() {
    var nombre = $("#tipo_actividad").val();
    var descripcion = $("#descripcion").val();

    if (nombre.length == 0 || nombre.length < 0 || nombre == "" ||
        descripcion.length == 0 || descripcion.length < 0 || descripcion == "") {
        return Swal.fire({
            icon: "warning",
            title: "No hay datos de tipo actividad comletos",
            text: "Ingrese datos de tipo actividad!!",
        });
    }

    funcion = "registrar_tipo_actividad";
    alerta = ["datos", "Se esta creando el tipo de actividad", "Creando tipo actividad."];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/tipo_actividad/tipo_actividad.php",
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
                    "Se creo el tipo de actividad con exito",
                ];
                cerrar_loader_datos(alerta);

                $("#tipo_actividad").val("");
                $("#descripcion").val("");
                tabla_tipo_actividad.ajax.reload();

                $("#modal_nuva_actividad").modal("hide");
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El tipo de actividad " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo crear el tipo atividad"];
            cerrar_loader_datos(alerta);
        }
    });
}

function listar_tipo_actividads() {
    funcion = "listar_tipo_actividads";
    tabla_tipo_actividad = $("#tabla_tipo_actividad_").DataTable({
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
            url: "../ADMIN/controlador/tipo_actividad/tipo_actividad.php",
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
            { data: "tipo_actividad" },
            { data: "descripcion" },
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
    tabla_tipo_actividad.on("draw.dt", function () {
        var pageinfo = $("#tabla_tipo_actividad_").DataTable().page.info();
        tabla_tipo_actividad
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_tipo_actividad_").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_tipo_actividad.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_tipo_actividad.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_tipo_actividad.row(this).data();
    }
    var dato = 0;
    var id = data.id_tipo_actividad;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del tipo de actividad se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_tipo_actividad(id, dato);
        }
    });
});

$("#tabla_tipo_actividad_").on("click", ".activar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_tipo_actividad.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_tipo_actividad.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_tipo_actividad.row(this).data();
    }
    var dato = 1;
    var id = data.id_tipo_actividad;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del tipo de actividad se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_tipo_actividad(id, dato);
        }
    });
});

function cambiar_estado_tipo_actividad(id, dato) {
    var res = "";
    if (dato == 1) {
        res = "activo";
    } else {
        res = "inactivo";
    }

    funcion = "estado_tipo_actividad";
    alerta = [
        "datos",
        "Se esta cambiando el estado a " + res + "",
        "Cambiando estado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/tipo_actividad/tipo_actividad.php",
        type: "POST",
        data: { id: id, dato: dato, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                cerrar_loader_datos(alerta);
                tabla_tipo_actividad.ajax.reload();
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

$("#tabla_tipo_actividad_").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_tipo_actividad.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_tipo_actividad.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_tipo_actividad.row(this).data();
    }

    $("#id_tipo_actividad_edit").val(data.id_tipo_actividad);
    $("#tipo_actividad_edit").val(data.tipo_actividad);
    $("#descripcion_edit").val(data.descripcion);

    $("#modal_edit_tipo_actividad").modal({
        backdrop: "static",
        keyboard: false,
    });
    $("#modal_edit_tipo_actividad").modal("show");
});

function editar_tipo_actividad() {
    var id = $("#id_tipo_actividad_edit").val();
    var nombre = $("#tipo_actividad_edit").val();
    var descripcion = $("#descripcion_edit").val();

    if (nombre.length == 0 || nombre.length < 0 || nombre == "" ||
        descripcion.length == 0 || descripcion.length < 0 || descripcion == "") {
        return Swal.fire({
            icon: "warning",
            title: "No hay datos de tipo actividad comletos",
            text: "Ingrese datos de tipo actividad!!",
        });
    }

    funcion = "editar_tipo_actividad";
    alerta = ["datos", "Se esta editando el tipo de actividad", "Editando tipo de actividad"];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/tipo_actividad/tipo_actividad.php",
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
                    "Se edito el tipo de actividad con existe",
                ];
                cerrar_loader_datos(alerta);
                tabla_tipo_actividad.ajax.reload();
                $("#modal_edit_tipo_actividad").modal("hide");
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El tipo de actividad " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo editar el tipo de actividad"];
            cerrar_loader_datos(alerta);
        }
    });
}
