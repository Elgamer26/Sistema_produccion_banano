var funcion, tabla_rol;

function registrar_rol() {
    var nombre = $("#tipo_rol_").val();
    var estado = $("#estado_rol").val();

    if (nombre.length == 0 || nombre.length < 0 || nombre == "") {
        return Swal.fire({
            icon: "warning",
            title: "No hay nombre de rol",
            text: "Ingrese un nombre de rol!!",
        });
    }

    funcion = "registrar_rol";
    alerta = ["datos", "Se esta creando el rol", "Creando rol."];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/rol/rol.php",
        type: "POST",
        data: {
            funcion: funcion,
            nombre: nombre,
            estado: estado,
        },
    }).done(function (response) {
        if (response > 0) {
            if (response != 2) {
                registra_permiso(parseInt(response));
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El rol " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo crear el rol"];
            cerrar_loader_datos(alerta);
        }
    });
}

function registra_permiso(id) {
    var config = document.getElementById("configuraciones").checked;
    var respaldos = document.getElementById("respaldos").checked;
    var empleados = document.getElementById("empleados").checked;
    var multas = document.getElementById("multas").checked;
    var asistecias = document.getElementById("asistecias").checked;
    var permisos = document.getElementById("permisos").checked;
    var rol_pagos = document.getElementById("rol_pagos").checked;
    var bodega = document.getElementById("bodega").checked;
    var compras = document.getElementById("compras").checked;
    var produccion = document.getElementById("produccion").checked;
    var ventas = document.getElementById("ventas").checked;
    var control_plagas = document.getElementById("control_plagas").checked;
    var reportes = document.getElementById("reportes").checked;

    funcion = "registrar_permiso_rol";
    $.ajax({
        url: "../ADMIN/controlador/rol/rol.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id,
            config: config,

            respaldos: respaldos,
            empleados: empleados,
            multas: multas,
            asistecias: asistecias,
            permisos: permisos,
            rol_pagos: rol_pagos,
            bodega: bodega,
            compras: compras,
            produccion: produccion,
            ventas: ventas,
            control_plagas: control_plagas,
            reportes: reportes,
        },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "El rol se creo con exito"];
                cerrar_loader_datos(alerta);
                cargar_contenido("contenido_principal", "vista/roles/nuevo_rol.php");
            }
        } else {
            alerta = ["error", "error", "No se pudo crear el permiso"];
            cerrar_loader_datos(alerta);
        }
    });
}

function listar_roles() {
    funcion = "listar_roles";
    tabla_rol = $("#tabla_roles_").DataTable({
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
            url: "../ADMIN/controlador/rol/rol.php",
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
                        return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el Oftalmólogo'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='key btn btn-warning' title='Editar el permiso'><i class='fa fa-key'></i></button>`;
                    } else {
                        return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el Oftalmólogo'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='key btn btn-warning' title='Editar el permiso'><i class='fa fa-key'></i></button>`;
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
    tabla_rol.on("draw.dt", function () {
        var pageinfo = $("#tabla_roles_").DataTable().page.info();
        tabla_rol
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_roles_").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_rol.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_rol.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_rol.row(this).data();
    }
    var dato = 0;
    var id = data.id_rol;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del rol se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_rol(id, dato);
        }
    });
});

$("#tabla_roles_").on("click", ".activar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_rol.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_rol.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_rol.row(this).data();
    }
    var dato = 1;
    var id = data.id_rol;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del rol se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_rol(id, dato);
        }
    });
});

function cambiar_estado_rol(id, dato) {
    var res = "";
    if (dato == 1) {
        res = "activo";
    } else {
        res = "inactivo";
    }

    funcion = "estado_rol";
    alerta = [
        "datos",
        "Se esta cambiando el estado a " + res + "",
        "Cambiando estado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/rol/rol.php",
        type: "POST",
        data: { id: id, dato: dato, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                cerrar_loader_datos(alerta);
                tabla_rol.ajax.reload();
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

$("#tabla_roles_").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_rol.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_rol.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_rol.row(this).data();
    }

    $("#id_rol_edit").val(data.id_rol);
    $("#edit_nombre_rol").val(data.nombre);

    $("#modal_edit_rol").modal({
        backdrop: "static",
        keyboard: false,
    });
    $("#modal_edit_rol").modal("show");
});

function editar_rol() {
    var id = $("#id_rol_edit").val();
    var nombre = $("#edit_nombre_rol").val();

    if (nombre.length == 0 || nombre.length < 0 || nombre == "") {
        return Swal.fire({
            icon: "warning",
            title: "No hay nombre de rol",
            text: "Ingrese un nombre de rol!!",
        });
    }

    funcion = "editar_rol";
    alerta = ["datos", "Se esta editando el rol", "editando rol."];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/rol/rol.php",
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
                    "Se edito el rol con existe",
                ];
                cerrar_loader_datos(alerta);
                tabla_rol.ajax.reload();
                $("#modal_edit_rol").modal("hide");
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El rol " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo editar el rol"];
            cerrar_loader_datos(alerta);
        }
    });
}

$("#tabla_roles_").on("click", ".key", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_rol.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_rol.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_rol.row(this).data();
    }

    var id = data.id_rol;
    alerta = [
        "datos",
        "Se estan obteniendo los permisos actuales del rol",
        "Obteniendo permisos de rol",
    ];
    mostar_loader_datos(alerta);
    obtener_permisos_rol(parseInt(id));
});

function obtener_permisos_rol(id) {
    funcion = "obtener_permisos";
    $.ajax({
        url: "../ADMIN/controlador/rol/rol.php",
        type: "POST",
        data: { funcion: funcion, id: id },
    }).done(function (response) {
        var data = JSON.parse(response);
        $("#id_rol_permiso").val(id);
        $("#id_permiso").val(data[0][0]);

        data[0]["configuracion"].toString() == "true" ? ($("#configuraciones_edit")[0].checked = true) : $("#configuraciones_edit")[0].checked = false;
        data[0]["respaldos"].toString() == "true" ? ($("#respaldos")[0].checked = true) : $("#respaldos")[0].checked = false;
        data[0]["empleados"].toString() == "true" ? ($("#empleados")[0].checked = true) : $("#empleados")[0].checked = false;
        data[0]["multas"].toString() == "true" ? ($("#multas")[0].checked = true) : $("#multas")[0].checked = false;
        data[0]["asistecias"].toString() == "true" ? ($("#asistecias")[0].checked = true) : $("#asistecias")[0].checked = false;
        data[0]["permisos"].toString() == "true" ? ($("#permisos")[0].checked = true) : $("#permisos")[0].checked = false;
        data[0]["rol_pagos"].toString() == "true" ? ($("#rol_pagos")[0].checked = true) : $("#rol_pagos")[0].checked = false;
        data[0]["bodega"].toString() == "true" ? ($("#bodega")[0].checked = true) : $("#bodega")[0].checked = false;
        data[0]["compras"].toString() == "true" ? ($("#compras")[0].checked = true) : $("#compras")[0].checked = false;
        data[0]["produccion"].toString() == "true" ? ($("#produccion")[0].checked = true) : $("#produccion")[0].checked = false;
        data[0]["ventas"].toString() == "true" ? ($("#ventas")[0].checked = true) : $("#ventas")[0].checked = false;
        data[0]["control_plagas"].toString() == "true" ? ($("#control_plagas")[0].checked = true) : $("#control_plagas")[0].checked = false;
        data[0]["reportes"].toString() == "true" ? ($("#reportes")[0].checked = true) : $("#reportes")[0].checked = false;

        alerta = ["none", "", ""];
        cerrar_loader_datos(alerta);

        $("#modal_edit_rol_permiso").modal({
            backdrop: "static",
            keyboard: false,
        });
        $("#modal_edit_rol_permiso").modal("show");
    });
}

function editar_permiso() {
    var id_rol = document.getElementById("id_rol_permiso").value;
    var id_permiso = document.getElementById("id_permiso").value;
    var conf = document.getElementById("configuraciones_edit").checked;

    var respaldos = document.getElementById("respaldos").checked;
    var empleados = document.getElementById("empleados").checked;
    var multas = document.getElementById("multas").checked;
    var asistecias = document.getElementById("asistecias").checked;
    var permisos = document.getElementById("permisos").checked;
    var rol_pagos = document.getElementById("rol_pagos").checked;
    var bodega = document.getElementById("bodega").checked;
    var compras = document.getElementById("compras").checked;
    var produccion = document.getElementById("produccion").checked;
    var ventas = document.getElementById("ventas").checked;
    var control_plagas = document.getElementById("control_plagas").checked;
    var reportes = document.getElementById("reportes").checked;

    var frm = document.getElementById("frm_edit_permiso");

    funcion = "editar_permisos";
    alerta = [
        "datos",
        "Se esta cambiano los permisos rol",
        "Cambiando permisos del rol",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/rol/rol.php",
        type: "POST",
        data: {
            funcion: funcion,
            id_rol: id_rol,
            id_permiso: id_permiso,
            conf: conf,

            respaldos: respaldos,
            empleados: empleados,
            multas: multas,
            asistecias: asistecias,
            permisos: permisos,
            rol_pagos: rol_pagos,
            bodega: bodega,
            compras: compras,
            produccion: produccion,
            ventas: ventas,
            control_plagas: control_plagas,
            reportes: reportes,
        },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                frm.reset();
                alerta = [
                    "existe",
                    "success",
                    "Los permisos del rol se editaron correctamente :)",
                ];
                cerrar_loader_datos(alerta);
                $("#modal_edit_rol_permiso").modal("hide");
            }
        } else {
            alerta = [
                "error",
                "error",
                "No se pudo editar los permisos del rol",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}
