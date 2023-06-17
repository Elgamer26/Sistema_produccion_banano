var funcion, tabla_tipo, tabla_tipo_tratamiento, tipo_quimico;

function nuevo_tipo_plaga() {
    $("#tipo_paga").val("");
    $("#descripcion").val("");
    $("#foto").val("");
    $("#modal_nuevo_tipo_plaga").modal({ backdrop: "static", keyboard: false });
    $("#modal_nuevo_tipo_plaga").modal("show");
}

function mueva_tipo_plaga() {
    var nombre = $("#tipo_paga").val();
    var descripcion = $("#descripcion").val();
    var foto = $("#foto").val();

    if (nombre.length == 0 || descripcion.length == 0) {
        return Swal.fire({
            icon: "warning",
            title: "No hay datos del tipo de plaga",
            text: "Ingrese un tipo de plaga!!",
        });
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


    alerta = ["datos", "Se esta creando el tipo de plaga", "Creando tipo de plaga"];
    mostar_loader_datos(alerta);

    funcion = "mueva_tipo_plaga";

    formdata.append("funcion", funcion);

    formdata.append("nombre", nombre);
    formdata.append("descripcion", descripcion);
    formdata.append("foto", foto);
    formdata.append("nombrearchivo", nombrearchivo);

    $.ajax({
        url: "../ADMIN/controlador/tipo_plaga/tipo_plaga.php",
        type: "POST",
        //aqui envio toda la formdata
        data: formdata,
        contentType: false,
        processData: false,
        success: function (resp) {
            console.log(resp);
            if (resp > 0) {
                if (resp == 1) {
                    alerta = ["exito", "success", "El tipo de plaga se registro con exito"];
                    cerrar_loader_datos(alerta);

                    $("#tipo_paga").val("");
                    $("#descripcion").val("");
                    $("#foto").val("");

                    tabla_tipo.ajax.reload();
                    $("#modal_nuevo_tipo_plaga").modal("hide");

                } else {
                    alerta = [
                        "existe",
                        "warning",
                        "El tipo de plaga " +
                        nombre +
                        " ya esta registrado",
                    ];
                    cerrar_loader_datos(alerta);
                }
            } else {
                alerta = [
                    "error",
                    "error",
                    "Error al registrar el tipo de plga",
                ];
                cerrar_loader_datos(alerta);
            }
        },
    });
    return false;
}

function listar_tipo_plagas() {
    funcion = "listar_tipo_plagas";
    tabla_tipo = $("#tabla_tipo_plagas").DataTable({
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
            url: "../ADMIN/controlador/tipo_plaga/tipo_plaga.php",
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
            { data: "tipo_plaga" },
            {
                data: "foto",
                render: function (data, type, row) {
                    return "<img class='img-circle' src='" + data + "' width='45px' />";
                }
            },

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
    tabla_tipo.on("draw.dt", function () {
        var pageinfo = $("#tabla_tipo_plagas").DataTable().page.info();
        tabla_tipo
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_tipo_plagas").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_tipo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_tipo.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_tipo.row(this).data();
    }
    var dato = 0;
    var id = data.id_tipo_plaga;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del tipo de plaga se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_tipo_plaga(id, dato);
        }
    });
});

$("#tabla_tipo_plagas").on("click", ".activar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_tipo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_tipo.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_tipo.row(this).data();
    }
    var dato = 1;
    var id = data.id_tipo_plaga;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del tipo de plaga se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_tipo_plaga(id, dato);
        }
    });
});

function cambiar_estado_tipo_plaga(id, dato) {
    var res = "";
    if (dato == 1) {
        res = "activo";
    } else {
        res = "inactivo";
    }

    funcion = "estatottipopla";
    alerta = [
        "datos",
        "Se esta cambiando el estado a " + res + "",
        "Cambiando estado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/tipo_plaga/tipo_plaga.php",
        type: "POST",
        data: { id: id, dato: dato, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                cerrar_loader_datos(alerta);
                tabla_tipo.ajax.reload();
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

$("#tabla_tipo_plagas").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_tipo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_tipo.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_tipo.row(this).data();
    }

    $("#id_edit_tipo_plaga").val(data.id_tipo_plaga);
    $("#tipo_paga_edit").val(data.tipo_plaga);
    $("#descripcion_edit").val(data.descripcion);

    $("#modal_eitra_tipo_plaga").modal({
        backdrop: "static",
        keyboard: false,
    });
    $("#modal_eitra_tipo_plaga").modal("show");
});

function editar_tipo_plaga() {
    var id = $("#id_edit_tipo_plaga").val();
    var nombre = $("#tipo_paga_edit").val();
    var descripcion = $("#descripcion_edit").val();

    if (nombre.length == 0 || descripcion.length == 0) {
        return Swal.fire({
            icon: "warning",
            title: "No hay datos del tipo de plaga",
            text: "Ingrese un datos del tipo de plaga!!",
        });
    }

    funcion = "editar_tipo_plaga";
    alerta = ["datos", "Se esta editando el tipo de plaga", "editando tipo_plaga."];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/tipo_plaga/tipo_plaga.php",
        type: "POST",
        data: {
            funcion: funcion,
            nombre: nombre,
            descripcion: descripcion,
            id: id,
        },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = [
                    "exito",
                    "success",
                    "Se edito el tipo de plaga con exito",
                ];
                cerrar_loader_datos(alerta);
                tabla_tipo.ajax.reload();
                $("#modal_eitra_tipo_plaga").modal("hide");
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El tipo de plaga " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo editar el tipo de plaga"];
            cerrar_loader_datos(alerta);
        }
    });
}

///////////////////
function nuevo_tipo_tratamiento() {
    $("#tipo_tratamiento").val("");
    $("#descripcion_trat").val("");
    $("#modal_nuevo_tipo_tratamiento").modal({ backdrop: "static", keyboard: false });
    $("#modal_nuevo_tipo_tratamiento").modal("show");
}

function mueva_tipo_tratamiento() {
    var nombre = $("#tipo_tratamiento").val();
    var descripcion = $("#descripcion_trat").val();

    if (nombre.length == 0 || descripcion.length == 0) {
        return Swal.fire({
            icon: "warning",
            title: "No hay datos del tipo de tratamiento",
            text: "Ingrese un tipo de tratamiento!!",
        });
    }

    funcion = "creando_tipo_plaga_tra";
    alerta = ["datos", "Se esta editando el tipo de plaga", "editando tipo_plaga."];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/tipo_plaga/tipo_plaga.php",
        type: "POST",
        data: {
            funcion: funcion,
            nombre: nombre,
            descripcion: descripcion
        },
    }).done(function (response) {
        console.log(response);
        if (response > 0) {
            if (response == 1) {
                alerta = [
                    "exito",
                    "success",
                    "Se registro el tipo de tratamiento con exito con existe",
                ];
                cerrar_loader_datos(alerta);
                tabla_tipo_tratamiento.ajax.reload();
                $("#modal_nuevo_tipo_tratamiento").modal("hide");
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El tipo de tratamiento " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo registrar el tipo de tratamiento"];
            cerrar_loader_datos(alerta);
        }
    });
}

function listar_tipo_tratamiento() {
    funcion = "listar_tipo_tratamiento";
    tabla_tipo_tratamiento = $("#tabla_tipo_tratamientos").DataTable({
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
            url: "../ADMIN/controlador/tipo_plaga/tipo_plaga.php",
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
            { data: "tipo_tratamiento" },
            { data: "descripion" },
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
    tabla_tipo_tratamiento.on("draw.dt", function () {
        var pageinfo = $("#tabla_tipo_tratamientos").DataTable().page.info();
        tabla_tipo_tratamiento
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_tipo_tratamientos").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_tipo_tratamiento.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_tipo_tratamiento.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_tipo_tratamiento.row(this).data();
    }
    var dato = 0;
    var id = data.id_tipo_tratamiento;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del tipo de tratamiento se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_tipo_tratamiento(id, dato);
        }
    });
});

$("#tabla_tipo_tratamientos").on("click", ".activar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_tipo_tratamiento.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_tipo_tratamiento.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_tipo_tratamiento.row(this).data();
    }
    var dato = 1;
    var id = data.id_tipo_tratamiento;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del tipo de tratamiento se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_tipo_tratamiento(id, dato);
        }
    });
});

function cambiar_estado_tipo_tratamiento(id, dato) {
    var res = "";
    if (dato == 1) {
        res = "activo";
    } else {
        res = "inactivo";
    }

    funcion = "esta_tipo_tratamiento";
    alerta = [
        "datos",
        "Se esta cambiando el estado a " + res + "",
        "Cambiando estado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/tipo_plaga/tipo_plaga.php",
        type: "POST",
        data: { id: id, dato: dato, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                cerrar_loader_datos(alerta);
                tabla_tipo_tratamiento.ajax.reload();
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

$("#tabla_tipo_tratamientos").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_tipo_tratamiento.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_tipo_tratamiento.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_tipo_tratamiento.row(this).data();
    }

    $("#id_tipo_trata").val(data.id_tipo_tratamiento);
    $("#tipo_tar_edit").val(data.tipo_tratamiento);
    $("#descripcion_edit_trata").val(data.descripion);

    $("#modal_eitra_tipo_tratamiento").modal({
        backdrop: "static",
        keyboard: false,
    });
    $("#modal_eitra_tipo_tratamiento").modal("show");
});

function editar_tipo_tratamiento() {
    var id = $("#id_tipo_trata").val();
    var nombre = $("#tipo_tar_edit").val();
    var descripcion = $("#descripcion_edit_trata").val();

    if (nombre.length == 0 || descripcion.length == 0) {
        return Swal.fire({
            icon: "warning",
            title: "No hay datos del tipo de tratamiento",
            text: "Ingrese un datos del tipo de tratamiento!!",
        });
    }

    funcion = "editar_tipo_tratamiento";
    alerta = ["datos", "Se esta editando el tipo de tratamiento", "editando tipo tratamiento."];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/tipo_plaga/tipo_plaga.php",
        type: "POST",
        data: {
            funcion: funcion,
            nombre: nombre,
            descripcion: descripcion,
            id: id,
        },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = [
                    "exito",
                    "success",
                    "Se edito el tipo de tratamiento con exito con existe",
                ];
                cerrar_loader_datos(alerta);
                tabla_tipo_tratamiento.ajax.reload();
                $("#modal_eitra_tipo_tratamiento").modal("hide");
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El tipo de tratamiento " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo editar el tipo de tratamiento"];
            cerrar_loader_datos(alerta);
        }
    });
}

function nuevo_tipo_quimico() {
    $("#tipo_quimico").val("");
    $("#descripcion").val(""); 
    $("#modal_nuevo_tipo_quimico").modal({ backdrop: "static", keyboard: false });
    $("#modal_nuevo_tipo_quimico").modal("show");
}

function listar_tipo_quimico() {
    funcion = "listar_tipo_quimico";
    tipo_quimico = $("#tabla_tipo_quimico").DataTable({
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
            url: "../ADMIN/controlador/tipo_plaga/tipo_plaga.php",
            type: "POST",
            data: { funcion: funcion },
        },
        //hay que poner la misma cantidad de columnas y tambien en el html
        columns: [
            { defaultContent: "" },
            {
                data: "estado_q",
                render: function (data, type, row) {
                    if (data == 1) {
                        return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el Oftalmólogo'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button>`;
                    } else {
                        return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el Oftalmólogo'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button>`;
                    }
                },
            },
            {
                data: "estado_q",
                render: function (data, type, row) {
                    if (data == 1) {
                        return "<span class='label label-success'>ACTIVO</span>";
                    } else {
                        return "<span class='label label-danger'>INACTIVO</span>";
                    }
                },
            },
            { data: "tipo_quimico" },
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
    tipo_quimico.on("draw.dt", function () {
        var pageinfo = $("#tabla_tipo_quimico").DataTable().page.info();
        tipo_quimico
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

function mueva_tipo_quimico() { 

    var nombre = $("#tipo_quimico").val();
    var descripcion = $("#descripcion").val();

    if (nombre.length == 0 || descripcion.length == 0) {
        return Swal.fire({
            icon: "warning",
            title: "No hay datos del tipo de quimico",
            text: "Ingrese un datos del tipo de quimico!!",
        });
    }

    funcion = "nuevoo_tipo_quimico";
    alerta = ["datos", "Se esta creando el tipo de quimico", "creando tipo quimico."];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/tipo_plaga/tipo_plaga.php",
        type: "POST",
        data: {
            funcion: funcion,
            nombre: nombre,
            descripcion: descripcion,
        },
    }).done(function (response) {

        if (response > 0) {
            if (response == 1) {
                alerta = [
                    "exito",
                    "success",
                    "Se creo el tipo de quimico con exito",
                ];
                cerrar_loader_datos(alerta);
                tipo_quimico.ajax.reload();
                $("#modal_nuevo_tipo_quimico").modal("hide");
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El tipo de quimco " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo crear el tipo de quimico"];
            cerrar_loader_datos(alerta);
        }
    });
}

$("#tabla_tipo_quimico").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tipo_quimico.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tipo_quimico.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tipo_quimico.row(this).data();
    }
    var dato = 0;
    var id = data.id_tipo_quimico;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del tipo de quimico se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_tipo_quimico(id, dato);
        }
    });
});

$("#tabla_tipo_quimico").on("click", ".activar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tipo_quimico.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tipo_quimico.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tipo_quimico.row(this).data();
    }
    var dato = 1;
    var id = data.id_tipo_quimico;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del tipo de quimico se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_tipo_quimico(id, dato);
        }
    });
});

function cambiar_estado_tipo_quimico(id, dato) {
    var res = "";
    if (dato == 1) {
        res = "activo";
    } else {
        res = "inactivo";
    }

    funcion = "estado_tipo_quimico";
    alerta = [
        "datos",
        "Se esta cambiando el estado a " + res + "",
        "Cambiando estado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/tipo_plaga/tipo_plaga.php",
        type: "POST",
        data: { id: id, dato: dato, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                cerrar_loader_datos(alerta);
                tipo_quimico.ajax.reload();
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

$("#tabla_tipo_quimico").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tipo_quimico.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tipo_quimico.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tipo_quimico.row(this).data();
    }

    $("#id_edit_tipo_quimico").val(data.id_tipo_quimico);
    $("#tipo_quimico_edit").val(data.tipo_quimico);
    $("#descripcion_edit").val(data.descripcion);

    $("#modal_eitra_tipo_quimico").modal({
        backdrop: "static",
        keyboard: false,
    });
    $("#modal_eitra_tipo_quimico").modal("show");
});

function editar_tipo_quimico() {
    var id = $("#id_edit_tipo_quimico").val();
    var nombre = $("#tipo_quimico_edit").val();
    var descripcion = $("#descripcion_edit").val();

    if (nombre.length == 0 || descripcion.length == 0) {
        return Swal.fire({
            icon: "warning",
            title: "No hay datos del tipo de quimico",
            text: "Ingrese un datos del tipo de quimico!!",
        });
    }

    funcion = "editarr_tipo_quimico";
    alerta = ["datos", "Se esta editando el tipo de quimico", "editando tipo quimico."];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/tipo_plaga/tipo_plaga.php",
        type: "POST",
        data: {
            funcion: funcion,
            nombre: nombre,
            descripcion: descripcion,
            id: id,
        },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = [
                    "exito",
                    "success",
                    "Se edito el tipo de quimico con exito",
                ];
                cerrar_loader_datos(alerta);
                tipo_quimico.ajax.reload();
                $("#modal_eitra_tipo_quimico").modal("hide");
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El tipo de quimico " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo editar el tipo de quimico"];
            cerrar_loader_datos(alerta);
        }
    });
}
