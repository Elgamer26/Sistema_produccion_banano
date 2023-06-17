var funcion, tabla_proveedor;

function nuevo_proveedor() {

    var razons = document.getElementById("razons").value;
    var rucs = document.getElementById("rucs").value;
    var telefono_p = document.getElementById("telefono_p").value;
    var correo_p = document.getElementById("correo_p").value;
    var direccions = document.getElementById("direccions").value;
    var descripcions = document.getElementById("descripcions").value;
    var encargados = document.getElementById("encargados").value;
    var sexo = document.getElementById("sexo").value;

    if (
        razons.length == 0 ||
        rucs.length == 0 ||
        telefono_p.length == 0 ||
        correo_p.length == 0 ||
        direccions.length == 0 ||
        descripcions.length == 0 ||
        encargados.length == 0
    ) {
        validar_registro(
            razons,
            rucs,
            telefono_p,
            correo_p,
            direccions,
            descripcions,
            encargados
        );

        return swal.fire(
            "Campo vacios",
            "Debe ingresar todos los datos en los campos",
            "warning"
        );
    } else {
        $("#razon_oblig").html("");
        $("#ruc_obliga").html("");
        $("#telefono_obliga").html("");
        $("#correo_obliga").html("");
        $("#direccion_obliga").html("");
        $("#descripcion_obliga").html("");
        $("#encargado_obliga").html("");
    }

    funcion = "nuevo_proveedor";
    alerta = [
        "datos",
        "Se esta creando el proveedor",
        "Creando proveedor",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/proveedor/proveedor.php",
        type: "POST",
        data: {
            funcion: funcion,
            razons: razons,
            rucs: rucs,
            telefono_p: telefono_p,
            correo_p: correo_p,
            direccions: direccions,
            descripcions: descripcions,
            encargados: encargados,
            sexo: sexo
        },
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {

                alerta = ["exito", "success", "El proveedor se creo con exito"];
                cerrar_loader_datos(alerta);
                cargar_contenido('contenido_principal', 'vista/proveedor/nuevo_proveedor.php');

            } else if (resp == 2) {
                alerta = [
                    "existe",
                    "warning",
                    "La razin social " +
                    razons +
                    ", ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            } else if (resp == 3) {
                alerta = [
                    "existe",
                    "warning",
                    "El ruc " +
                    rucs +
                    ", ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El correo " +
                    correo_p +
                    ", ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al crear el porveedor",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function validar_registro(
    razons,
    rucs,
    telefono_p,
    correo_p,
    direccions,
    descripcions,
    encargados
) {
    if (razons.length == 0) {
        $("#razon_oblig").html("Ingrese razon social");
    } else {
        $("#razon_oblig").html("");
    }

    if (rucs.length == 0) {
        $("#ruc_obliga").html("Ingrese ruc");
    } else {
        $("#ruc_obliga").html("");
    }

    if (telefono_p.length == 0) {
        $("#telefono_obliga").html("Ingrese telefono");
    } else {
        $("#telefono_obliga").html("");
    }

    if (correo_p.length == 0) {
        $("#correo_obliga").html("Ingrese correo");
    } else {
        $("#correo_obliga").html("");
    }

    if (direccions.length == 0) {
        $("#direccion_obliga").html("Ingrese direccion");
    } else {
        $("#direccion_obliga").html("");
    }

    if (descripcions.length == 0) {
        $("#descripcion_obliga").html("Ingrese descripcion");
    } else {
        $("#descripcion_obliga").html("");
    }

    if (encargados.length == 0) {
        $("#encargado_obliga").html("Ingrese encargado");
    } else {
        $("#encargado_obliga").html("");
    }
}

function listardo_proveedores() {
    funcion = "listardo_proveedores";
    tabla_proveedor = $("#tabla_proveedor_").DataTable({
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
            url: "../ADMIN/controlador/proveedor/proveedor.php",
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
                        return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el usuario'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el usuario'><i class='fa fa-edit'></i></button>`;
                    } else {
                        return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el usuario'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el usuario'><i class='fa fa-edit'></i></button>`;
                    }
                },
            },
            {
                data: "estado",
                render: function (data, type, row) {
                    if (data == 1) {
                        return "<span class='label label-success'>ACTIVO</span >";
                    } else {
                        return "<span class='label label-danger'>INACTIVO</span>";
                    }
                },
            },

            { data: "razon" },
            { data: "rucs" },
            { data: "telefono_p" },
            { data: "correo_p" },
            { data: "direccions" },
            { data: "descripcions" },
            { data: "encargados" },
            { data: "sexo" },
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
    tabla_proveedor.on("draw.dt", function () {
        var pageinfo = $("#tabla_proveedor_").DataTable().page.info();
        tabla_proveedor
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_proveedor_").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_proveedor.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_proveedor.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_proveedor.row(this).data();
    }
    var dato = 0;
    var id = data.id_proveedor;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del proveedor se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_proveedor(id, dato);
        }
    });
});

$("#tabla_proveedor_").on("click", ".activar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_proveedor.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_proveedor.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_proveedor.row(this).data();
    }
    var dato = 1;
    var id = data.id_proveedor;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del proveedor se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_proveedor(id, dato);
        }
    });
});

function cambiar_estado_proveedor(id, dato) {
    var res = "";
    if (dato == 1) {
        res = "activo";
    } else {
        res = "inactivo";
    }

    funcion = "estado_proveedor";
    alerta = [
        "datos",
        "Se esta cambiando el estado a " + res + "",
        "Cambiando estado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/proveedor/proveedor.php",
        type: "POST",
        data: { id: id, dato: dato, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                cerrar_loader_datos(alerta);
                tabla_proveedor.ajax.reload();
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

$("#tabla_proveedor_").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_proveedor.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_proveedor.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_proveedor.row(this).data();
    }

    document.getElementById("id_proveedor").value = data.id_proveedor;
    document.getElementById("razons").value = data.razon;
    document.getElementById("rucs").value = data.rucs;
    document.getElementById("telefono_p").value = data.telefono_p;
    document.getElementById("correo_p").value = data.correo_p;
    document.getElementById("direccions").value = data.direccions;
    document.getElementById("descripcions").value = data.descripcions;
    document.getElementById("encargados").value = data.encargados;
    document.getElementById("sexo").value = data.sexo;

    $("#razon_oblig").html("");
    $("#ruc_obliga").html("");
    $("#telefono_obliga").html("");
    $("#correo_obliga").html("");
    $("#direccion_obliga").html("");
    $("#descripcion_obliga").html("");
    $("#encargado_obliga").html("");

    $("#correo_p").css("border", "1px solid green");
    $("#email_correcto").html("");

    $("#modal_editar_proveedor").modal({ backdrop: "static", keyboard: false });
    $("#modal_editar_proveedor").modal("show");
});

function editar_proveedor() {

    var id = document.getElementById("id_proveedor").value;

    var razons = document.getElementById("razons").value;
    var rucs = document.getElementById("rucs").value;
    var telefono_p = document.getElementById("telefono_p").value;
    var correo_p = document.getElementById("correo_p").value;
    var direccions = document.getElementById("direccions").value;
    var descripcions = document.getElementById("descripcions").value;
    var encargados = document.getElementById("encargados").value;
    var sexo = document.getElementById("sexo").value;

    if (
        razons.length == 0 ||
        rucs.length == 0 ||
        telefono_p.length == 0 ||
        correo_p.length == 0 ||
        direccions.length == 0 ||
        descripcions.length == 0 ||
        encargados.length == 0
    ) {
        validar_registro_edit(
            razons,
            rucs,
            telefono_p,
            correo_p,
            direccions,
            descripcions,
            encargados
        );

        return swal.fire(
            "Campo vacios",
            "Debe ingresar todos los datos en los campos",
            "warning"
        );
    } else {
        $("#razon_oblig").html("");
        $("#ruc_obliga").html("");
        $("#telefono_obliga").html("");
        $("#correo_obliga").html("");
        $("#direccion_obliga").html("");
        $("#descripcion_obliga").html("");
        $("#encargado_obliga").html("");
    }

    funcion = "editar_proveedor";
    alerta = [
        "datos",
        "Se esta editando el insumo",
        "Editando insumo",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/proveedor/proveedor.php",
        type: "POST",
        data: {
            funcion: funcion,
            id:id,
            razons: razons,
            rucs: rucs,
            telefono_p: telefono_p,
            correo_p: correo_p,
            direccions: direccions,
            descripcions: descripcions,
            encargados: encargados,
            sexo: sexo
        },
    }).done(function (resp) {
        console.log(resp);
        if (resp > 0) {
            if (resp == 1) {

                alerta = ["exito", "success", "El proveedor se creo con exito"];
                cerrar_loader_datos(alerta);
                tabla_proveedor.ajax.reload();
                $("#modal_editar_proveedor").modal("hide");

            } else if (resp == 2) {
                alerta = [
                    "existe",
                    "warning",
                    "La razin social " +
                    razons +
                    ", ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            } else if (resp == 3) {
                alerta = [
                    "existe",
                    "warning",
                    "El ruc " +
                    rucs +
                    ", ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El correo " +
                    correo_p +
                    ", ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al crear el porveedor",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function validar_registro_edit(
    razons,
    rucs,
    telefono_p,
    correo_p,
    direccions,
    descripcions,
    encargados
) {
    if (razons.length == 0) {
        $("#razon_oblig").html("Ingrese razon social");
    } else {
        $("#razon_oblig").html("");
    }

    if (rucs.length == 0) {
        $("#ruc_obliga").html("Ingrese ruc");
    } else {
        $("#ruc_obliga").html("");
    }

    if (telefono_p.length == 0) {
        $("#telefono_obliga").html("Ingrese telefono");
    } else {
        $("#telefono_obliga").html("");
    }

    if (correo_p.length == 0) {
        $("#correo_obliga").html("Ingrese correo");
    } else {
        $("#correo_obliga").html("");
    }

    if (direccions.length == 0) {
        $("#direccion_obliga").html("Ingrese direccion");
    } else {
        $("#direccion_obliga").html("");
    }

    if (descripcions.length == 0) {
        $("#descripcion_obliga").html("Ingrese descripcion");
    } else {
        $("#descripcion_obliga").html("");
    }

    if (encargados.length == 0) {
        $("#encargado_obliga").html("Ingrese encargado");
    } else {
        $("#encargado_obliga").html("");
    }
}
