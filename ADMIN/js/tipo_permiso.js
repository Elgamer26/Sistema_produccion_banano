var funcion, tabla_tipo_permisos;

function modal_tipo_permiso() {
    $("#tipo_permiso").val("");
    $("#modal_nuva_permiso").modal({ backdrop: "static", keyboard: false });
    $("#modal_nuva_permiso").modal("show");
}

function nueva_permiso() {
    var nombre = $("#tipo_permiso").val();

    if (nombre.length == 0 || nombre.length < 0 || nombre == "") {
        return Swal.fire({
            icon: "warning",
            title: "No hay nombre de tipo permiso",
            text: "Ingrese un nombre de tipo permiso!!",
        });
    }

    funcion = "registrar_permiso";
    alerta = ["datos", "Se esta creando la permiso", "Creando permiso."];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/permiso/permiso.php",
        type: "POST",
        data: {
            funcion: funcion,
            nombre: nombre
        },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = [
                    "exito",
                    "success",
                    "Se creo el tipo de permiso con exito",
                ];
                cerrar_loader_datos(alerta);
                $("#tipo_permiso").val("");
                tabla_tipo_permisos.ajax.reload();
                $("#modal_nuva_permiso").modal("hide");
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El tipo de permiso " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo crear el tipo"];
            cerrar_loader_datos(alerta);
        }
    });
}

function listar_tipo_permisos() {
    funcion = "listar_tipo_permisos";
    tabla_tipo_permisos = $("#tabla_tipo_permiso_").DataTable({
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
            url: "../ADMIN/controlador/permiso/permiso.php",
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
            { data: "tipo_permiso" },
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
    tabla_tipo_permisos.on("draw.dt", function () {
        var pageinfo = $("#tabla_tipo_permiso_").DataTable().page.info();
        tabla_tipo_permisos
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_tipo_permiso_").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_tipo_permisos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_tipo_permisos.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_tipo_permisos.row(this).data();
    }
    var dato = 0;
    var id = data.id_tipo_permiso;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del tipo de permiso se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_tipo_permiso(id, dato);
        }
    });
});

$("#tabla_tipo_permiso_").on("click", ".activar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_tipo_permisos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_tipo_permisos.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_tipo_permisos.row(this).data();
    }
    var dato = 1;
    var id = data.id_tipo_permiso;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del tipo de permiso se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_tipo_permiso(id, dato);
        }
    });
});

function cambiar_estado_tipo_permiso(id, dato) {
    var res = "";
    if (dato == 1) {
        res = "activo";
    } else {
        res = "inactivo";
    }

    funcion = "estado_tipo_permiso";
    alerta = [
        "datos",
        "Se esta cambiando el estado a " + res + "",
        "Cambiando estado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/permiso/permiso.php",
        type: "POST",
        data: { id: id, dato: dato, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                cerrar_loader_datos(alerta);
                tabla_tipo_permisos.ajax.reload();
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

$("#tabla_tipo_permiso_").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_tipo_permisos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_tipo_permisos.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_tipo_permisos.row(this).data();
    }

    $("#id_tipo_permiso").val(data.id_tipo_permiso);
    $("#tipo_permiso_edit").val(data.tipo_permiso);

    $("#modal_edit_tipo_permiso").modal({
        backdrop: "static",
        keyboard: false,
    });
    $("#modal_edit_tipo_permiso").modal("show");
});

function editar_tipo_permiso() {
    var id = $("#id_tipo_permiso").val();
    var nombre = $("#tipo_permiso_edit").val();

    if (nombre.length == 0 || nombre.length < 0 || nombre == "") {
        return Swal.fire({
            icon: "warning",
            title: "No hay nombre de tipo de permiso",
            text: "Ingrese un nombre de tipo de permiso!!",
        });
    }

    funcion = "editar_tipo_permiso";
    alerta = ["datos", "Se esta editando el tipo de permiso", "editando tipo de permiso"];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/permiso/permiso.php",
        type: "POST",
        data: {
            funcion: funcion,
            nombre: nombre,
            id: id,
        },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = [
                    "exito",
                    "success",
                    "Se edito el tipo de permiso con existe",
                ];
                cerrar_loader_datos(alerta);
                tabla_tipo_permisos.ajax.reload();
                $("#modal_edit_tipo_permiso").modal("hide");
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El tipo de permiso " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo editar el tipo de permiso"];
            cerrar_loader_datos(alerta);
        }
    });
}
