var funcion, tabla_material, tabla_insumo, tabla_medida, tabal_b_material, tabla_b_insumo;

function registrar_tipo_material() {
    var nombre = $("#tipo_material").val();

    if (nombre.length == 0 || nombre.length < 0 || nombre == "") {
        return Swal.fire({
            icon: "warning",
            title: "No hay nombre de material",
            text: "Ingrese un nombre de material!!",
        });
    }

    funcion = "registrar_tipo_material";
    alerta = ["datos", "Se esta creando el tipo material", "Creando tipo."];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
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
                    "El tipo de material fue ingresado con exito",
                ];
                cerrar_loader_datos(alerta);
                cargar_contenido('contenido_principal', 'vista/bodega/tipo_material.php');
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El tipo material " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo crear el tipo material"];
            cerrar_loader_datos(alerta);
        }
    });
}

function registrar_tipo_insumo() {
    var nombre = $("#tipo_insumo").val();

    if (nombre.length == 0 || nombre.length < 0 || nombre == "") {
        return Swal.fire({
            icon: "warning",
            title: "No hay nombre de insumo",
            text: "Ingrese un nombre de insumo!!",
        });
    }

    funcion = "registrar_tipo_insumo";
    alerta = ["datos", "Se esta creando el tipo insumo", "Creando tipo."];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
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
                    "El tipo de insumo fue ingresado con exito",
                ];
                cerrar_loader_datos(alerta);
                cargar_contenido('contenido_principal', 'vista/bodega/tipo_insumo.php');
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El tipo insumo " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo crear el tipo insumo"];
            cerrar_loader_datos(alerta);
        }
    });
}

function listar_tipo_material() {
    funcion = "listar_tipo_material";
    tabla_material = $("#tabla_material_").DataTable({
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
            url: "../ADMIN/controlador/bodega/bodega.php",
            type: "POST",
            data: { funcion: funcion },
        },
        //hay que poner la misma cantidad de columnas y tambien en el html
        columns: [
            { defaultContent: "" },
            {
                data: "estado_tipo_m",
                render: function (data, type, row) {
                    if (data == 1) {
                        return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el Oftalmólogo'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button>`;
                    } else {
                        return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el Oftalmólogo'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button>`;
                    }
                },
            },
            {
                data: "estado_tipo_m",
                render: function (data, type, row) {
                    if (data == 1) {
                        return "<span class='label label-success'>ACTIVO</span>";
                    } else {
                        return "<span class='label label-danger'>INACTIVO</span>";
                    }
                },
            },
            { data: "tipo_material" },
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
    tabla_material.on("draw.dt", function () {
        var pageinfo = $("#tabla_material_").DataTable().page.info();
        tabla_material
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_material_").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_material.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_material.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_material.row(this).data();
    }
    var dato = 0;
    var id = data.id_tipo_material;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del tipo de material se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_tipo__material(id, dato);
        }
    });
});

$("#tabla_material_").on("click", ".activar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_material.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_material.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_material.row(this).data();
    }
    var dato = 1;
    var id = data.id_tipo_material;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del tipo de material se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_tipo__material(id, dato);
        }
    });
});

function cambiar_estado_tipo__material(id, dato) {
    var res = "";
    if (dato == 1) {
        res = "activo";
    } else {
        res = "inactivo";
    }

    funcion = "estado_tipo_material";
    alerta = [
        "datos",
        "Se esta cambiando el estado a " + res + "",
        "Cambiando estado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        data: { id: id, dato: dato, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                cerrar_loader_datos(alerta);
                tabla_material.ajax.reload();
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

$("#tabla_material_").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_material.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_material.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_material.row(this).data();
    }

    $("#id_tipo_material").val(data.id_tipo_material);
    $("#tipo_material_dit").val(data.tipo_material);

    $("#modal_edit_tipo_material").modal({
        backdrop: "static",
        keyboard: false,
    });
    $("#modal_edit_tipo_material").modal("show");
});

function editar_tipo_material() {
    var id = $("#id_tipo_material").val();
    var nombre = $("#tipo_material_dit").val();

    if (nombre.length == 0 || nombre.length < 0 || nombre == "") {
        return Swal.fire({
            icon: "warning",
            title: "No hay nombre de material",
            text: "Ingrese un nombre de material!!",
        });
    }

    funcion = "editar_tipo_material_";

    alerta = ["datos", "Se esta editando el tipo material", "Editando tipo."];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id,
            nombre: nombre,
        },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = [
                    "exito",
                    "success",
                    "El tipo de material fue editado con exito",
                ];
                cerrar_loader_datos(alerta);
                tabla_material.ajax.reload();
                $("#modal_edit_tipo_material").modal("hide");
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El tipo material " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo editar el tipo material"];
            cerrar_loader_datos(alerta);
        }
    });
}

//////////////////////////////////////////////
function listar_tipo_insumo() {
    funcion = "listar_tipo_insumo";
    tabla_insumo = $("#tabla_insumo_").DataTable({
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
            url: "../ADMIN/controlador/bodega/bodega.php",
            type: "POST",
            data: { funcion: funcion },
        },
        //hay que poner la misma cantidad de columnas y tambien en el html
        columns: [
            { defaultContent: "" },
            {
                data: "estado_tipo_i",
                render: function (data, type, row) {
                    if (data == 1) {
                        return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el Oftalmólogo'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button>`;
                    } else {
                        return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el Oftalmólogo'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button>`;
                    }
                },
            },
            {
                data: "estado_tipo_i",
                render: function (data, type, row) {
                    if (data == 1) {
                        return "<span class='label label-success'>ACTIVO</span>";
                    } else {
                        return "<span class='label label-danger'>INACTIVO</span>";
                    }
                },
            },
            { data: "tipo_insumo" },
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
    tabla_insumo.on("draw.dt", function () {
        var pageinfo = $("#tabla_insumo_").DataTable().page.info();
        tabla_insumo
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_insumo_").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_insumo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_insumo.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_insumo.row(this).data();
    }
    var dato = 0;
    var id = data.id_tipo_insumo;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del tipo de insumo se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_tipo__insumo(id, dato);
        }
    });
});

$("#tabla_insumo_").on("click", ".activar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_insumo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_insumo.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_insumo.row(this).data();
    }
    var dato = 1;
    var id = data.id_tipo_insumo;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del tipo de insumo se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_tipo__insumo(id, dato);
        }
    });
});

function cambiar_estado_tipo__insumo(id, dato) {
    var res = "";
    if (dato == 1) {
        res = "activo";
    } else {
        res = "inactivo";
    }

    funcion = "estado_tipo_insumo";
    alerta = [
        "datos",
        "Se esta cambiando el estado a " + res + "",
        "Cambiando estado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        data: { id: id, dato: dato, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                cerrar_loader_datos(alerta);
                tabla_insumo.ajax.reload();
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

$("#tabla_insumo_").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_insumo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_insumo.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_insumo.row(this).data();
    }

    $("#id_tipo_insumo").val(data.id_tipo_insumo);
    $("#tipo_insumo_dit").val(data.tipo_insumo);

    $("#modal_edit_tipo_insumo").modal({
        backdrop: "static",
        keyboard: false,
    });
    $("#modal_edit_tipo_insumo").modal("show");
});

function editar_tipo_insumo() {
    var id = $("#id_tipo_insumo").val();
    var nombre = $("#tipo_insumo_dit").val();

    if (nombre.length == 0 || nombre.length < 0 || nombre == "") {
        return Swal.fire({
            icon: "warning",
            title: "No hay nombre de insumo",
            text: "Ingrese un nombre de insumo!!",
        });
    }

    funcion = "editar_tipo_insumo_";

    alerta = ["datos", "Se esta editando el tipo insumo", "Editando tipo."];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id,
            nombre: nombre,
        },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = [
                    "exito",
                    "success",
                    "El tipo de insumo fue editado con exito",
                ];
                cerrar_loader_datos(alerta);
                tabla_insumo.ajax.reload();
                $("#modal_edit_tipo_insumo").modal("hide");
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El tipo insumo " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo editar el tipo insumo"];
            cerrar_loader_datos(alerta);
        }
    });
}

/////////////////////////////
function listar_tipo_material_comobo() {
    funcion = "listar_tipo_material_comobo";
    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        data: { funcion: funcion },
    }).done(function (response) {
        var data = JSON.parse(response);
        var cadena = "";
        if (data.length > 0) {
            //bucle para extraer los datos del material
            for (var i = 0; i < data.length; i++) {
                cadena +=
                    "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
            }
            //aqui concadenamos al id del select
            $("#tipo_material").html(cadena);
        } else {
            cadena += "<option value=''>No hay datos</option>";
            $("#tipo_material").html(cadena);
        }
    });
}

function guardar_material() {
    var codigos = document.getElementById("codigos").value;
    var nombres = document.getElementById("nombres").value;
    var marca = document.getElementById("marca").value;
    var tipo_material = document.getElementById("tipo_material").value;
    var color = document.getElementById("color").value;
    var precio_venta = document.getElementById("precio_venta").value;
    var observacion = document.getElementById("observacion").value;
    var decripcion_mterial = document.getElementById("decripcion_mterial").value;

    var foto = document.getElementById("foto").value;

    if (
        codigos.length == 0 ||
        nombres.length == 0 ||
        marca.length == 0 ||
        tipo_material.length == 0 ||
        color.length == 0 ||
        precio_venta.length == 0 ||
        observacion.length == 0 ||
        decripcion_mterial.length == 0
    ) {
        validar_registro(
            codigos,
            nombres,
            marca,
            tipo_material,
            color,
            precio_venta,
            observacion,
            decripcion_mterial
        );

        return swal.fire(
            "Campo vacios",
            "Debe ingresar todos los datos en los campos",
            "warning"
        );
    } else {
        $("#codigo_oblig").html("");
        $("#nombre_obliga").html("");
        $("#marca_obliga").html("");
        $("#tipo_ma_obligggq").html("");
        $("#color_obliga").html("");
        $("#precio_compra_oblig").html("");
        $("#observacion_olbigg").html("");
        $("#descripc_obliga").html("");

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
        "Se esta creando el material",
        "Creando material",
    ];
    mostar_loader_datos(alerta);

    funcion = "registra_material_insertar";

    formdata.append("funcion", funcion);
    formdata.append("codigos", codigos);
    formdata.append("nombres", nombres);
    formdata.append("marca", marca);
    formdata.append("tipo_material", tipo_material);
    formdata.append("color", color);
    formdata.append("precio_venta", precio_venta);
    formdata.append("observacion", observacion);
    formdata.append("decripcion_mterial", decripcion_mterial);

    formdata.append("foto", foto);
    formdata.append("nombrearchivo", nombrearchivo);

    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        //aqui envio toda la formdata
        data: formdata,
        contentType: false,
        processData: false,
        success: function (resp) {
            if (resp > 0) {
                if (resp == 1) {

                    alerta = ["exito", "success", "El material se registro con exito"];
                    cerrar_loader_datos(alerta);
                    cargar_contenido('contenido_principal', 'vista/bodega/registro_material.php');

                } else if (resp == 2) {
                    alerta = [
                        "existe",
                        "warning",
                        "El codigo " +
                        codigos +
                        ", ya esta registrado",
                    ];
                    cerrar_loader_datos(alerta);
                } else {
                    alerta = [
                        "existe",
                        "warning",
                        "La nombre " +
                        nombres +
                        " y el tipo de material, ya esta registrado",
                    ];
                    cerrar_loader_datos(alerta);
                }
            } else {
                alerta = [
                    "error",
                    "error",
                    "Error al registrar el material",
                ];
                cerrar_loader_datos(alerta);
            }
        },
    });
    return false;
}

function validar_registro(
    codigos,
    nombres,
    marca,
    tipo_material,
    color,
    precio_venta,
    observacion,
    decripcion_mterial
) {
    if (codigos.length == 0) {
        $("#codigo_oblig").html("Ingrese codigo");
    } else {
        $("#codigo_oblig").html("");
    }

    if (nombres.length == 0) {
        $("#nombre_obliga").html("Ingrese nombre");
    } else {
        $("#nombre_obliga").html("");
    }

    if (marca.length == 0) {
        $("#marca_obliga").html("Ingrese marca");
    } else {
        $("#marca_obliga").html("");
    }

    if (tipo_material.length == 0) {
        $("#tipo_ma_obligggq").html("Ingrese tipo marca");
    } else {
        $("#tipo_ma_obligggq").html("");
    }

    if (color.length == 0) {
        $("#color_obliga").html("Ingrese color");
    } else {
        $("#color_obliga").html("");
    }

    if (precio_venta.length == 0) {
        $("#precio_compra_oblig").html("Ingrese precio");
    } else {
        $("#precio_compra_oblig").html("");
    }

    if (observacion.length == 0) {
        $("#observacion_olbigg").html("Ingrese observacion");
    } else {
        $("#observacion_olbigg").html("");
    }

    if (decripcion_mterial.length == 0) {
        $("#descripc_obliga").html("Ingrese descripcion");
    } else {
        $("#descripc_obliga").html("");
    }
}

function listar_n_matrial() {
    funcion = "listar_n_matrial";
    tabal_b_material = $("#tabla_materiales_").DataTable({
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
            url: "../ADMIN/controlador/bodega/bodega.php",
            type: "POST",
            data: { funcion: funcion },
        },
        //hay que poner la misma cantidad de columnas y tambien en el html
        columns: [
            { defaultContent: "" },
            {
                data: "eliminado",
                render: function (data, type, row) {
                    if (data == 1) {
                        return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el usuario'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el usuario'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='photo btn btn-warning' title='Editar la foto'><i class='fa fa-photo'></i></button>`;
                    } else {
                        return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el usuario'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el usuario'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='photo btn btn-warning' title='Editar la foto'><i class='fa fa-photo'></i></button>`;
                    }
                },
            },
            {
                data: "eliminado",
                render: function (data, type, row) {
                    if (data == 1) {
                        return "<span class='label label-success'>SI</span >";
                    } else {
                        return "<span class='label label-danger'>NO</span>";
                    }
                },
            },
            {
                data: "estado",
                render: function (data, type, row) {
                    if (data == "NO STOCK") {
                        return "<span class='label label-danger'>" + data + "</span >";
                    } else if (data == "AGOTADO") {
                        return "<span class='label label-warning'>" + data + "</span>";
                    } else {
                        return "<span class='label label-success'>" + data + "</span>";
                    }
                },
            },
            { data: "stock_m" },
            {
                data: "foto",
                render: function (data, type, row) {

                    return "<img class='img-circle' src='" + data + "' width='45px' />";
                }
            },
            { data: "codigo" },
            { data: "nombre" },
            { data: "marca" },
            { data: "tipo_material" },
            { data: "color" },
            { data: "precio" },
            { data: "observacion" },
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
        order: [[0, "ASC"]],
    });

    //esto es para crearn un contador para la tabla este contador es automatico
    tabal_b_material.on("draw.dt", function () {
        var pageinfo = $("#tabla_materiales_").DataTable().page.info();
        tabal_b_material
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_materiales_").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabal_b_material.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabal_b_material.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabal_b_material.row(this).data();
    }
    var dato = 0;
    var id = data.id_material;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del material se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_material_b(id, dato);
        }
    });
});

$("#tabla_materiales_").on("click", ".activar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabal_b_material.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabal_b_material.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabal_b_material.row(this).data();
    }
    var dato = 1;
    var id = data.id_material;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del material se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_material_b(id, dato);
        }
    });
});

function cambiar_estado_material_b(id, dato) {
    var res = "";
    if (dato == 1) {
        res = "activo";
    } else {
        res = "inactivo";
    }

    funcion = "estado_material_b";
    alerta = [
        "datos",
        "Se esta cambiando el estado a " + res + "",
        "Cambiando estado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        data: { id: id, dato: dato, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                cerrar_loader_datos(alerta);
                tabal_b_material.ajax.reload();
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

$("#tabla_materiales_").on("click", ".photo", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabal_b_material.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabal_b_material.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabal_b_material.row(this).data();
    }

    var id = data.id_material;
    var foto = data.foto;

    $("#id_foto_material").val(id);
    $("#foto_actu").val(foto);
    $("#foto_materialo").attr("src", foto);

    $("#modal_editar_foto_mateial").modal({ backdrop: "static", keyboard: false });
    $("#modal_editar_foto_mateial").modal("show");
});

function editar_foto_material() {

    var id = document.getElementById("id_foto_material").value;
    var foto = document.getElementById("foto_new").value;
    var ruta_actual = document.getElementById("foto_actu").value;

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
    var foto = $("#foto_new")[0].files[0];

    //est valores son como los que van en la data del ajax
    funcion = "editar_foto_material";
    formdata.append("funcion", funcion);
    formdata.append("id", id);
    formdata.append("foto", foto);
    formdata.append("ruta_actual", ruta_actual);
    formdata.append("nombrearchivo", nombrearchivo);

    alerta = [
        "datos",
        "Se esta editando la imagen del material",
        "Editando imagen material",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        //aqui envio toda la formdata
        data: formdata,
        contentType: false,
        processData: false,
        success: function (resp) {
            if (resp > 0) {
                if (resp == 1) {
                    document.getElementById("foto_new").value = "";
                    tabal_b_material.ajax.reload();
                    alerta = [
                        "exito",
                        "success",
                        "La foto de material se edito con exito",
                    ];
                    cerrar_loader_datos(alerta);
                    $("#modal_editar_foto_mateial").modal("hide");
                }
            } else {
                alerta = [
                    "error",
                    "error",
                    "No se pudo editar la foto de material",
                ];
                cerrar_loader_datos(alerta);
            }
        },
    });
    return false;
}

function listar_tipo_material_comobo_2() {
    funcion = "listar_tipo_material_comobo";
    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        data: { funcion: funcion },
    }).done(function (response) {
        var data = JSON.parse(response);
        var cadena = "";
        if (data.length > 0) {
            //bucle para extraer los datos del material
            for (var i = 0; i < data.length; i++) {
                cadena +=
                    "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
            }
            //aqui concadenamos al id del select
            $("#tipo_material_2").html(cadena);
        } else {
            cadena += "<option value=''>No hay datos</option>";
            $("#tipo_material_2").html(cadena);
        }
    });
}

$("#tabla_materiales_").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabal_b_material.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabal_b_material.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabal_b_material.row(this).data();
    }

    document.getElementById("id_mterial_edit").value = data.id_material;
    document.getElementById("codigos").value = data.codigo;
    document.getElementById("nombres").value = data.nombre;
    document.getElementById("marca").value = data.marca;
    $("#tipo_material_2").val(data.id_tipo).trigger("change");
    document.getElementById("color").value = data.color;
    document.getElementById("precio_venta").value = data.precio;
    document.getElementById("observacion").value = data.observacion;
    document.getElementById("decripcion_mterial").value = data.descripcion;

    $("#codigo_oblig").html("");
    $("#nombre_obliga").html("");
    $("#marca_obliga").html("");
    $("#tipo_ma_obligggq").html("");
    $("#color_obliga").html("");
    $("#precio_compra_oblig").html("");
    $("#observacion_olbigg").html("");
    $("#descripc_obliga").html("");

    $("#modal_editar_mterial").modal({ backdrop: "static", keyboard: false });
    $("#modal_editar_mterial").modal("show");
});

function editar_material_b() {

    var id = document.getElementById("id_mterial_edit").value;
    var codigos = document.getElementById("codigos").value;
    var nombres = document.getElementById("nombres").value;
    var marca = document.getElementById("marca").value;
    var tipo_material = document.getElementById("tipo_material_2").value;
    var color = document.getElementById("color").value;
    var precio_venta = document.getElementById("precio_venta").value;
    var observacion = document.getElementById("observacion").value;
    var decripcion_mterial = document.getElementById("decripcion_mterial").value;

    if (
        codigos.length == 0 ||
        nombres.length == 0 ||
        marca.length == 0 ||
        tipo_material.length == 0 ||
        color.length == 0 ||
        precio_venta.length == 0 ||
        observacion.length == 0 ||
        decripcion_mterial.length == 0
    ) {
        validar_registro_edit(
            codigos,
            nombres,
            marca,
            tipo_material,
            color,
            precio_venta,
            observacion,
            decripcion_mterial
        );

        return swal.fire(
            "Campo vacios",
            "Debe ingresar todos los datos en los campos",
            "warning"
        );
    } else {
        $("#codigo_oblig").html("");
        $("#nombre_obliga").html("");
        $("#marca_obliga").html("");
        $("#tipo_ma_obligggq").html("");
        $("#color_obliga").html("");
        $("#precio_compra_oblig").html("");
        $("#observacion_olbigg").html("");
        $("#descripc_obliga").html("");

    }

    funcion = "editar_material_b";
    alerta = [
        "datos",
        "Se esta editando el material",
        "Creando usuario",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id,
            codigos: codigos,
            nombres: nombres,
            marca: marca,
            tipo_material: tipo_material,
            color: color,
            precio_venta: precio_venta,
            observacion: observacion,
            decripcion_mterial: decripcion_mterial

        },
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {

                alerta = ["exito", "success", "El material se edito con exito"];
                cerrar_loader_datos(alerta);
                tabal_b_material.ajax.reload();
                $("#modal_editar_mterial").modal("hide");

            } else if (resp == 2) {
                alerta = [
                    "existe",
                    "warning",
                    "El codigo " +
                    codigos +
                    ", ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "La nombre " +
                    nombres +
                    " y el tipo de material, ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al registrar el material",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function validar_registro_edit(
    codigos,
    nombres,
    marca,
    tipo_material,
    color,
    precio_venta,
    observacion,
    decripcion_mterial
) {
    if (codigos.length == 0) {
        $("#codigo_oblig").html("Ingrese codigo");
    } else {
        $("#codigo_oblig").html("");
    }

    if (nombres.length == 0) {
        $("#nombre_obliga").html("Ingrese nombre");
    } else {
        $("#nombre_obliga").html("");
    }

    if (marca.length == 0) {
        $("#marca_obliga").html("Ingrese marca");
    } else {
        $("#marca_obliga").html("");
    }

    if (tipo_material.length == 0) {
        $("#tipo_ma_obligggq").html("Ingrese tipo marca");
    } else {
        $("#tipo_ma_obligggq").html("");
    }

    if (color.length == 0) {
        $("#color_obliga").html("Ingrese color");
    } else {
        $("#color_obliga").html("");
    }

    if (precio_venta.length == 0) {
        $("#precio_compra_oblig").html("Ingrese precio");
    } else {
        $("#precio_compra_oblig").html("");
    }

    if (observacion.length == 0) {
        $("#observacion_olbigg").html("Ingrese observacion");
    } else {
        $("#observacion_olbigg").html("");
    }

    if (decripcion_mterial.length == 0) {
        $("#descripc_obliga").html("Ingrese descripcion");
    } else {
        $("#descripc_obliga").html("");
    }
}


///////////////////////////
function listar_medida_() {
    funcion = "listar_medida_";
    tabla_medida = $("#tabla_medida_").DataTable({
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
            url: "../ADMIN/controlador/bodega/bodega.php",
            type: "POST",
            data: { funcion: funcion },
        },
        //hay que poner la misma cantidad de columnas y tambien en el html
        columns: [
            { defaultContent: "" },
            {
                data: "estado_m",
                render: function (data, type, row) {
                    if (data == 1) {
                        return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el Oftalmólogo'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button>`;
                    } else {
                        return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el Oftalmólogo'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button>`;
                    }
                },
            },
            {
                data: "estado_m",
                render: function (data, type, row) {
                    if (data == 1) {
                        return "<span class='label label-success'>ACTIVO</span>";
                    } else {
                        return "<span class='label label-danger'>INACTIVO</span>";
                    }
                },
            },
            { data: "nombre_m" },
            { data: "simbolo_m" },
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
    tabla_medida.on("draw.dt", function () {
        var pageinfo = $("#tabla_medida_").DataTable().page.info();
        tabla_medida
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

function nueva_medida() {

    document.getElementById("nombre_medida").value = "";
    document.getElementById("simbolo_medida").value = "";

    $("#modal_nuva_medida").modal({ backdrop: "static", keyboard: false });
    $("#modal_nuva_medida").modal("show");
}

function nueva_medida_registrar() {

    var nombre_medida = document.getElementById("nombre_medida").value;
    var simbolo_medida = document.getElementById("simbolo_medida").value;

    if (
        nombre_medida.length == 0 ||
        simbolo_medida.length == 0
    ) {
        return swal.fire(
            "Campo vacios",
            "Debe ingresar todos los datos en los campos",
            "warning"
        );
    }

    funcion = "nuevo_medida";
    alerta = [
        "datos",
        "Se esta creando la medida",
        "Creando usuario",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        data: {
            funcion: funcion,
            nombre_medida: nombre_medida,
            simbolo_medida: simbolo_medida
        },
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {

                alerta = ["exito", "success", "La medida se creo con exito"];
                cerrar_loader_datos(alerta);
                tabla_medida.ajax.reload();

                document.getElementById("nombre_medida").value = "";
                document.getElementById("simbolo_medida").value = "";

                $("#modal_nuva_medida").modal("hide");

            } else {
                alerta = [
                    "existe",
                    "warning",
                    "La nombre " +
                    nombre_medida +
                    " de medida, ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al registrar la medida",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

$("#tabla_medida_").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_medida.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_medida.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_medida.row(this).data();
    }
    var dato = 0;
    var id = data.id_medida;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado de la medida se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_medida(id, dato);
        }
    });
});

$("#tabla_medida_").on("click", ".activar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_medida.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_medida.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_medida.row(this).data();
    }
    var dato = 1;
    var id = data.id_medida;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado de la medida se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_medida(id, dato);
        }
    });
});

function cambiar_estado_medida(id, dato) {
    var res = "";
    if (dato == 1) {
        res = "activo";
    } else {
        res = "inactivo";
    }

    funcion = "estado_medida";
    alerta = [
        "datos",
        "Se esta cambiando el estado a " + res + "",
        "Cambiando estado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        data: { id: id, dato: dato, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                cerrar_loader_datos(alerta);
                tabla_medida.ajax.reload();
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

$("#tabla_medida_").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_medida.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_medida.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_medida.row(this).data();
    }

    document.getElementById("id_medida").value = data.id_medida;
    document.getElementById("nombre_medida_edit").value = data.nombre_m;
    document.getElementById("simbolo_medida_edit").value = data.simbolo_m;

    $("#modal_editar_medida").modal({ backdrop: "static", keyboard: false });
    $("#modal_editar_medida").modal("show");
});

function editar_medida() {

    var id = document.getElementById("id_medida").value;
    var nombre_medida = document.getElementById("nombre_medida_edit").value;
    var simbolo_medida = document.getElementById("simbolo_medida_edit").value;

    if (
        nombre_medida.length == 0 ||
        simbolo_medida.length == 0
    ) {
        return swal.fire(
            "Campo vacios",
            "Debe ingresar todos los datos en los campos",
            "warning"
        );
    }

    funcion = "editarr_medida";
    alerta = [
        "datos",
        "Se esta editando la medida",
        "Editando usuario",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id,
            nombre_medida: nombre_medida,
            simbolo_medida: simbolo_medida
        },
    }).done(function (resp) {

        if (resp > 0) {
            if (resp == 1) {

                alerta = ["exito", "success", "La medida se edito con exito"];
                cerrar_loader_datos(alerta);
                tabla_medida.ajax.reload();

                document.getElementById("nombre_medida_edit").value = "";
                document.getElementById("simbolo_medida_edit").value = "";

                $("#modal_editar_medida").modal("hide");

            } else {
                alerta = [
                    "existe",
                    "warning",
                    "La nombre " +
                    nombre_medida +
                    " de medida, ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al editar la medida",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

////////////////////////////////////////
function listar_tipo_insumo_combo() {
    funcion = "listar_tipo_insumo_combo";
    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        data: { funcion: funcion },
    }).done(function (response) {
        var data = JSON.parse(response);
        var cadena = "";
        if (data.length > 0) {
            //bucle para extraer los datos del material
            for (var i = 0; i < data.length; i++) {
                cadena +=
                    "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
            }
            //aqui concadenamos al id del select
            $("#tipo_insumo").html(cadena);
        } else {
            cadena += "<option value=''>No hay datos</option>";
            $("#tipo_insumo").html(cadena);
        }
    });
}

function litar_medida() {
    funcion = "litar_medida";
    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        data: { funcion: funcion },
    }).done(function (response) {
        var data = JSON.parse(response);
        var cadena = "";
        if (data.length > 0) {
            //bucle para extraer los datos del material
            for (var i = 0; i < data.length; i++) {
                cadena +=
                    "<option value='" + data[i][0] + "'> " + data[i][1] + " - " + data[i][2] + " </option>";
            }
            //aqui concadenamos al id del select
            $("#tipo_medidda").html(cadena);
        } else {
            cadena += "<option value=''>No hay datos</option>";
            $("#tipo_medidda").html(cadena);
        }
    });
}

function guardar_insumo_nuevo() {
    var codigos = document.getElementById("codigos").value;
    var nombres = document.getElementById("nombre_insumo").value;
    var marca = document.getElementById("marca").value;
    var tipo_insumo = document.getElementById("tipo_insumo").value;
    var Cantidad = document.getElementById("Cantidad").value;
    var tipo_medidda = document.getElementById("tipo_medidda").value;
    var precio_venta = document.getElementById("precio_venta").value;
    var observacion = document.getElementById("observacion").value;
    var decripcion_mterial = document.getElementById("decripcion_mterial").value;

    var foto = document.getElementById("foto").value;

    if (
        codigos.length == 0 ||
        nombres.length == 0 ||
        marca.length == 0 ||
        tipo_insumo.length == 0 ||
        Cantidad.length == 0 ||
        tipo_medidda.length == 0 ||
        precio_venta.length == 0 ||
        observacion.length == 0 ||
        decripcion_mterial.length == 0
    ) {
        validar_registro_insumo(
            codigos,
            nombres,
            marca,
            tipo_insumo,
            Cantidad,
            tipo_medidda,
            precio_venta,
            observacion,
            decripcion_mterial
        );

        return swal.fire(
            "Campo vacios",
            "Debe ingresar todos los datos en los campos",
            "warning"
        );
    } else {
        $("#codigo_oblig").html("");
        $("#nombrei_obliga").html("");
        $("#marca_obliga").html("");
        $("#tipo_ma_obligggq").html("");
        $("#cantidad_obliga").html("");
        $("#tipo_medidda_obb").html("");
        $("#precio_compra_oblig").html("");
        $("#observacion_olbigg").html("");
        $("#descripc_obliga").html("");
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
        "Se esta creando el insumo",
        "Creando insumo",
    ];
    mostar_loader_datos(alerta);

    funcion = "registra_insumo_insertar";

    formdata.append("funcion", funcion);
    formdata.append("codigos", codigos);
    formdata.append("nombres", nombres);
    formdata.append("marca", marca);
    formdata.append("tipo_insumo", tipo_insumo);
    formdata.append("Cantidad", Cantidad);
    formdata.append("tipo_medidda", tipo_medidda);
    formdata.append("precio_venta", precio_venta);
    formdata.append("observacion", observacion);
    formdata.append("decripcion_mterial", decripcion_mterial);

    formdata.append("foto", foto);
    formdata.append("nombrearchivo", nombrearchivo);

    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        //aqui envio toda la formdata
        data: formdata,
        contentType: false,
        processData: false,
        success: function (resp) {
            if (resp > 0) {
                if (resp == 1) {

                    alerta = ["exito", "success", "El insumo se registro con exito"];
                    cerrar_loader_datos(alerta);
                    cargar_contenido('contenido_principal', 'vista/bodega/registro_insumo.php');

                } else if (resp == 2) {
                    alerta = [
                        "existe",
                        "warning",
                        "El codigo " +
                        codigos +
                        ", ya esta registrado",
                    ];
                    cerrar_loader_datos(alerta);
                } else {
                    alerta = [
                        "existe",
                        "warning",
                        "La nombre " +
                        nombres +
                        ", tipo de insumo y medida, ya esta registrado",
                    ];
                    cerrar_loader_datos(alerta);
                }
            } else {
                alerta = [
                    "error",
                    "error",
                    "Error al registrar el insumo",
                ];
                cerrar_loader_datos(alerta);
            }
        },
    });
    return false;
}

function validar_registro_insumo(
    codigos,
    nombres,
    marca,
    tipo_insumo,
    Cantidad,
    tipo_medidda,
    precio_venta,
    observacion,
    decripcion_mterial
) {
    if (codigos.length == 0) {
        $("#codigo_oblig").html("Ingrese codigo");
    } else {
        $("#codigo_oblig").html("");
    }

    if (nombres.length == 0) {
        $("#nombrei_obliga").html("Ingrese nombre");
    } else {
        $("#nombrei_obliga").html("");
    }

    if (marca.length == 0) {
        $("#marca_obliga").html("Ingrese marca");
    } else {
        $("#marca_obliga").html("");
    }

    if (tipo_insumo.length == 0) {
        $("#tipo_ma_obligggq").html("Ingrese tipo marca");
    } else {
        $("#tipo_ma_obligggq").html("");
    }

    if (Cantidad.length == 0) {
        $("#cantidad_obliga").html("Ingrese valor");
    } else {
        $("#cantidad_obliga").html("");
    }

    if (tipo_medidda.length == 0) {
        $("#tipo_medidda_obb").html("Ingrese medida");
    } else {
        $("#tipo_medidda_obb").html("");
    }

    if (precio_venta.length == 0) {
        $("#precio_compra_oblig").html("Ingrese precio");
    } else {
        $("#precio_compra_oblig").html("");
    }

    if (observacion.length == 0) {
        $("#observacion_olbigg").html("Ingrese observacion");
    } else {
        $("#observacion_olbigg").html("");
    }

    if (decripcion_mterial.length == 0) {
        $("#descripc_obliga").html("Ingrese descripcion");
    } else {
        $("#descripc_obliga").html("");
    }
}

function listar_b_insumo() {
    funcion = "listar_b_insumo";
    tabla_b_insumo = $("#tabla_insumos_").DataTable({
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
            url: "../ADMIN/controlador/bodega/bodega.php",
            type: "POST",
            data: { funcion: funcion },
        },
        //hay que poner la misma cantidad de columnas y tambien en el html
        columns: [
            { defaultContent: "" },
            {
                data: "eliminado",
                render: function (data, type, row) {
                    if (data == 1) {
                        return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el usuario'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el usuario'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='photo btn btn-warning' title='Editar la foto'><i class='fa fa-photo'></i></button>`;
                    } else {
                        return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el usuario'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el usuario'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='photo btn btn-warning' title='Editar la foto'><i class='fa fa-photo'></i></button>`;
                    }
                },
            },
            {
                data: "eliminado",
                render: function (data, type, row) {
                    if (data == 1) {
                        return "<span class='label label-success'>SI</span >";
                    } else {
                        return "<span class='label label-danger'>NO</span>";
                    }
                },
            },
            {
                data: "estado",
                render: function (data, type, row) {
                    if (data == "NO STOCK") {
                        return "<span class='label label-danger'>" + data + "</span >";
                    } else if (data == "AGOTADO") {
                        return "<span class='label label-warning'>" + data + "</span>";
                    } else {
                        return "<span class='label label-success'>" + data + "</span>";
                    }
                },
            },
            { data: "stock_m" },
            {
                data: "foto",
                render: function (data, type, row) {

                    return "<img class='img-circle' src='" + data + "' width='45px' />";
                }
            },

            { data: "codigo_i" },
            { data: "nombre_i" },
            { data: "marca_i" },
            { data: "tipo_insumo" },
            { data: "medida" },
            { data: "cantidad" },
            { data: "precio_c" },
            { data: "observacion_i" },
            { data: "descrpcion_i" },
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
    tabla_b_insumo.on("draw.dt", function () {
        var pageinfo = $("#tabla_insumos_").DataTable().page.info();
        tabla_b_insumo
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_insumos_").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_b_insumo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_b_insumo.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_b_insumo.row(this).data();
    }
    var dato = 0;
    var id = data.id_insumo;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del insumo se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_innsumos(id, dato);
        }
    });
});

$("#tabla_insumos_").on("click", ".activar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_b_insumo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_b_insumo.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_b_insumo.row(this).data();
    }
    var dato = 1;
    var id = data.id_insumo;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del insumo se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_innsumos(id, dato);
        }
    });
});

function cambiar_estado_innsumos(id, dato) {
    var res = "";
    if (dato == 1) {
        res = "activo";
    } else {
        res = "inactivo";
    }

    funcion = "estado_b_insumos";
    alerta = [
        "datos",
        "Se esta cambiando el estado a " + res + "",
        "Cambiando estado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        data: { id: id, dato: dato, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                cerrar_loader_datos(alerta);
                tabla_b_insumo.ajax.reload();
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

$("#tabla_insumos_").on("click", ".photo", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_b_insumo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_b_insumo.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_b_insumo.row(this).data();
    }

    var id = data.id_insumo;
    var foto = data.foto;

    $("#id_foto_insumoss").val(id);
    $("#foto_actu").val(foto);
    $("#foto_insumosso").attr("src", foto);

    $("#modal_editar_foto_insumoss").modal({ backdrop: "static", keyboard: false });
    $("#modal_editar_foto_insumoss").modal("show");
});

function editar_foto_insumoss() {

    var id = document.getElementById("id_foto_insumoss").value;
    var foto = document.getElementById("foto_new").value;
    var ruta_actual = document.getElementById("foto_actu").value;

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
    var foto = $("#foto_new")[0].files[0];

    //est valores son como los que van en la data del ajax
    funcion = "editar_foto_insumoss";

    formdata.append("funcion", funcion);
    formdata.append("id", id);
    formdata.append("foto", foto);
    formdata.append("ruta_actual", ruta_actual);
    formdata.append("nombrearchivo", nombrearchivo);

    alerta = [
        "datos",
        "Se esta editando la imagen del insumo",
        "Editando imagen insumo",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        //aqui envio toda la formdata
        data: formdata,
        contentType: false,
        processData: false,
        success: function (resp) {
            if (resp > 0) {
                if (resp == 1) {
                    document.getElementById("foto_new").value = "";
                    tabla_b_insumo.ajax.reload();
                    alerta = [
                        "exito",
                        "success",
                        "La foto de insumo se edito con exito",
                    ];
                    cerrar_loader_datos(alerta);
                    $("#modal_editar_foto_insumoss").modal("hide");
                }
            } else {
                alerta = [
                    "error",
                    "error",
                    "No se pudo editar la foto del insumo",
                ];
                cerrar_loader_datos(alerta);
            }
        },
    });
    return false;
}

$("#tabla_insumos_").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_b_insumo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_b_insumo.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_b_insumo.row(this).data();
    }

    document.getElementById("id_insumo_edit").value = data.id_insumo;
    document.getElementById("codigos").value = data.codigo_i;
    document.getElementById("nombre_insumo").value = data.nombre_i;
    document.getElementById("marca").value = data.marca_i;
    document.getElementById("Cantidad").value = data.cantidad;

    $("#tipo_insumo").val(data.id_tipo_insumo).trigger("change");
    $("#tipo_medidda").val(data.id_medida).trigger("change");

    document.getElementById("precio_venta").value = data.precio_c;
    document.getElementById("observacion").value = data.observacion_i;
    document.getElementById("decripcion_mterial").value = data.descrpcion_i;

    $("#codigo_oblig").html("");
    $("#nombrei_obliga").html("");
    $("#marca_obliga").html("");
    $("#tipo_ma_obligggq").html("");
    $("#cantidad_obliga").html("");
    $("#tipo_medidda_obb").html("");
    $("#precio_compra_oblig").html("");
    $("#observacion_olbigg").html("");
    $("#descripc_obliga").html("");

    $("#modal_editar_inumos").modal({ backdrop: "static", keyboard: false });
    $("#modal_editar_inumos").modal("show");
});

function editar_insumoos_b() {

    var id = document.getElementById("id_insumo_edit").value;

    var codigos = document.getElementById("codigos").value;
    var nombres = document.getElementById("nombre_insumo").value;
    var marca = document.getElementById("marca").value;
    var tipo_insumo = document.getElementById("tipo_insumo").value;
    var Cantidad = document.getElementById("Cantidad").value;
    var tipo_medidda = document.getElementById("tipo_medidda").value;
    var precio_venta = document.getElementById("precio_venta").value;
    var observacion = document.getElementById("observacion").value;
    var decripcion_mterial = document.getElementById("decripcion_mterial").value;

    if (
        codigos.length == 0 ||
        nombres.length == 0 ||
        marca.length == 0 ||
        tipo_insumo.length == 0 ||
        Cantidad.length == 0 ||
        tipo_medidda.length == 0 ||
        precio_venta.length == 0 ||
        observacion.length == 0 ||
        decripcion_mterial.length == 0
    ) {
        validar_registro_insumo_edit(
            codigos,
            nombres,
            marca,
            tipo_insumo,
            Cantidad,
            tipo_medidda,
            precio_venta,
            observacion,
            decripcion_mterial
        );

        return swal.fire(
            "Campo vacios",
            "Debe ingresar todos los datos en los campos",
            "warning"
        );
    } else {
        $("#codigo_oblig").html("");
        $("#nombrei_obliga").html("");
        $("#marca_obliga").html("");
        $("#tipo_ma_obligggq").html("");
        $("#cantidad_obliga").html("");
        $("#tipo_medidda_obb").html("");
        $("#precio_compra_oblig").html("");
        $("#observacion_olbigg").html("");
        $("#descripc_obliga").html("");
    }

    funcion = "editar_insumo_bb";
    alerta = [
        "datos",
        "Se esta editando el insumo",
        "Editando insumo",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/bodega/bodega.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id,
            codigos: codigos,
            nombres: nombres,
            marca: marca,
            tipo_insumo: tipo_insumo,
            Cantidad: Cantidad,
            tipo_medidda: tipo_medidda,
            precio_venta: precio_venta,
            observacion: observacion,
            decripcion_mterial: decripcion_mterial
        },
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {

                alerta = ["exito", "success", "El insumo se edito con exito"];
                cerrar_loader_datos(alerta);
                tabla_b_insumo.ajax.reload();
                $("#modal_editar_inumos").modal("hide");

            } else if (resp == 2) {
                alerta = [
                    "existe",
                    "warning",
                    "El codigo " +
                    codigos +
                    ", ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "La nombre " +
                    nombres +
                    " y el tipo de material, ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al editar el insumo",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function validar_registro_insumo_edit(
    codigos,
    nombres,
    marca,
    tipo_insumo,
    Cantidad,
    tipo_medidda,
    precio_venta,
    observacion,
    decripcion_mterial
) {
    if (codigos.length == 0) {
        $("#codigo_oblig").html("Ingrese codigo");
    } else {
        $("#codigo_oblig").html("");
    }

    if (nombres.length == 0) {
        $("#nombrei_obliga").html("Ingrese nombre");
    } else {
        $("#nombrei_obliga").html("");
    }

    if (marca.length == 0) {
        $("#marca_obliga").html("Ingrese marca");
    } else {
        $("#marca_obliga").html("");
    }

    if (tipo_insumo.length == 0) {
        $("#tipo_ma_obligggq").html("Ingrese tipo marca");
    } else {
        $("#tipo_ma_obligggq").html("");
    }

    if (Cantidad.length == 0) {
        $("#cantidad_obliga").html("Ingrese valor");
    } else {
        $("#cantidad_obliga").html("");
    }

    if (tipo_medidda.length == 0) {
        $("#tipo_medidda_obb").html("Ingrese medida");
    } else {
        $("#tipo_medidda_obb").html("");
    }

    if (precio_venta.length == 0) {
        $("#precio_compra_oblig").html("Ingrese precio");
    } else {
        $("#precio_compra_oblig").html("");
    }

    if (observacion.length == 0) {
        $("#observacion_olbigg").html("Ingrese observacion");
    } else {
        $("#observacion_olbigg").html("");
    }

    if (decripcion_mterial.length == 0) {
        $("#descripc_obliga").html("Ingrese descripcion");
    } else {
        $("#descripc_obliga").html("");
    }
}