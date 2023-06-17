var funcion, tabla_cliente;

function nuevo_cliente() {
    var nombress = document.getElementById("nombress").value;
    var apellidoss = document.getElementById("apellidoss").value;
    var numero_docu = document.getElementById("numero_docu").value;
    var telefono_p = document.getElementById("telefono_p").value;
    var correo_p = document.getElementById("correo_p").value;
    var direccions = document.getElementById("direccions").value;
    var sexo = document.getElementById("sexo").value;

    if (
        nombress.length == 0 ||
        apellidoss.length == 0 ||
        numero_docu.length == 0 ||
        telefono_p.length == 0 ||
        correo_p.length == 0 ||
        direccions.length == 0
    ) {
        validar_registro(
            nombress,
            apellidoss,
            numero_docu,
            telefono_p,
            correo_p,
            direccions
        );

        return swal.fire(
            "Campo vacios",
            "Debe ingresar todos los datos en los campos",
            "warning"
        );
    } else {
        $("#nombres_oblig").html("");
        $("#apellidos_oblig").html("");
        $("#cedula_obliga").html("");
        $("#telefono_obliga").html("");
        $("#correo_obliga").html("");
        $("#direccion_obliga").html("");
    }

    funcion = "registrar_clientes";
    alerta = [
        "datos",
        "Se esta creando el cliente",
        "creando cliente",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/cliente/cliente.php",
        type: "POST",
        data: {
            funcion: funcion,
            nombress: nombress,
            apellidoss: apellidoss,
            numero_docu: numero_docu,
            telefono_p: telefono_p,
            correo_p: correo_p,
            direccions: direccions,
            sexo: sexo,
        },
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {
                alerta = ["exito", "success", "El cliente se registro con exito"];
                cerrar_loader_datos(alerta);
                cargar_contenido('contenido_principal', 'vista/clientes/nuevo_clientes.php');
            } else if (resp == 2) {
                alerta = [
                    "existe",
                    "warning",
                    "La cedula " +
                    cedula + ", ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            } else if (resp == 3) {
                alerta = [
                    "existe",
                    "warning",
                    "El correo " +
                    correo + ", ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al registrar el cliente",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function validar_registro(
    nombress,
    apellidoss,
    numero_docu,
    telefono_p,
    correo_p,
    direccions
) {
    if (nombress.length == 0) {
        $("#nombres_oblig").html("Ingrese nombres");
    } else {
        $("#nombres_oblig").html("");
    }

    if (apellidoss.length == 0) {
        $("#apellidos_oblig").html("Ingrese apellidos");
    } else {
        $("#apellidos_oblig").html("");
    }

    if (numero_docu.length == 0) {
        $("#cedula_obliga").html("Ingrese cedula");
    } else {
        $("#cedula_obliga").html("");
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
}

function listar_clientes() {
    funcion = "listar_clientes";
    tabla_cliente = $("#tabla_clientes_").DataTable({
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
            url: "../ADMIN/controlador/cliente/cliente.php",
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
                        return "<span class='label label-success'>ACTIVO</span>";
                    } else {
                        return "<span class='label label-danger'>INACTIVO</span>";
                    }
                },
            },
            { data: "nombres" },
            { data: "apellidos" },
            { data: "sexo" },
            { data: "cedula" },
            { data: "telefono" },
            { data: "correo" },
            { data: "direccion" },
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
    tabla_cliente.on("draw.dt", function () {
        var pageinfo = $("#tabla_clientes_").DataTable().page.info();
        tabla_cliente
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_clientes_").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_cliente.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_cliente.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_cliente.row(this).data();
    }
    var dato = 0;
    var id = data.id_cliente;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del cliente se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_cliente(id, dato);
        }
    });
});

$("#tabla_clientes_").on("click", ".activar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_cliente.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_cliente.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_cliente.row(this).data();
    }
    var dato = 1;
    var id = data.id_cliente;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del cliente se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_cliente(id, dato);
        }
    });
});

function cambiar_estado_cliente(id, dato) {
    var res = "";
    if (dato == 1) {
        res = "activo";
    } else {
        res = "inactivo";
    }

    funcion = "estado_cliente";
    alerta = [
        "datos",
        "Se esta cambiando el estado a " + res + "",
        "Cambiando estado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/cliente/cliente.php",
        type: "POST",
        data: { id: id, dato: dato, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                cerrar_loader_datos(alerta);
                tabla_cliente.ajax.reload();
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

$("#tabla_clientes_").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_cliente.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_cliente.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_cliente.row(this).data();
    }

    document.getElementById("id_cliente").value = data.id_cliente;
    document.getElementById("nombress").value = data.nombres;
    document.getElementById("apellidoss").value = data.apellidos;
    document.getElementById("numero_docu").value = data.cedula;
    document.getElementById("telefono_p").value = data.telefono;
    document.getElementById("correo_p").value = data.correo;
    document.getElementById("direccions").value = data.direccion;
    document.getElementById("sexo").value = data.sexo;


    $("#numero_docu").css("border", "1px solid green");
    $("#cedula_empleado").html("");

    $("#correo_p").css("border", "1px solid green");
    $("#email_correcto").html("");

    $("#nombres_oblig").html("");
    $("#apellidos_oblig").html("");
    $("#cedula_obliga").html("");
    $("#telefono_obliga").html("");
    $("#correo_obliga").html("");
    $("#direccion_obliga").html("");

    $("#modal_editar_cliente").modal({ backdrop: "static", keyboard: false });
    $("#modal_editar_cliente").modal("show");
});

function editar_clientes() {
    var id = document.getElementById("id_cliente").value;

    var nombress = document.getElementById("nombress").value;
    var apellidoss = document.getElementById("apellidoss").value;
    var numero_docu = document.getElementById("numero_docu").value;
    var telefono_p = document.getElementById("telefono_p").value;
    var correo_p = document.getElementById("correo_p").value;
    var direccions = document.getElementById("direccions").value;
    var sexo = document.getElementById("sexo").value;

    if (
        nombress.length == 0 ||
        apellidoss.length == 0 ||
        numero_docu.length == 0 ||
        telefono_p.length == 0 ||
        correo_p.length == 0 ||
        direccions.length == 0
    ) {
        validar_editar(
            nombress,
            apellidoss,
            numero_docu,
            telefono_p,
            correo_p,
            direccions
        );

        return swal.fire(
            "Campo vacios",
            "Debe ingresar todos los datos en los campos",
            "warning"
        );
    } else {
        $("#nombres_oblig").html("");
        $("#apellidos_oblig").html("");
        $("#cedula_obliga").html("");
        $("#telefono_obliga").html("");
        $("#correo_obliga").html("");
        $("#direccion_obliga").html("");
    }

    funcion = "editando_cliente_clientes";
    alerta = [
        "datos",
        "Se esta editando el cliente",
        "Editando cliente",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/cliente/cliente.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id,
            nombress: nombress,
            apellidoss: apellidoss,
            numero_docu: numero_docu,
            telefono_p: telefono_p,
            correo_p: correo_p,
            direccions: direccions,
            sexo: sexo,
        },
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {
                $("#modal_editar_cliente").modal("hide");
                alerta = ["exito", "success", "El cliente se edito con exito"];
                cerrar_loader_datos(alerta);
                tabla_cliente.ajax.reload();
            } else if (resp == 2) {
                alerta = [
                    "existe",
                    "warning",
                    "La cedula " +
                    cedula + ", ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            } else if (resp == 3) {
                alerta = [
                    "existe",
                    "warning",
                    "El correo " +
                    correo + ", ya esta registrado",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al editar el cliente",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function validar_editar(
    nombress,
    apellidoss,
    numero_docu,
    telefono_p,
    correo_p,
    direccions
) {
    if (nombress.length == 0) {
        $("#nombres_oblig").html("Ingrese nombres");
    } else {
        $("#nombres_oblig").html("");
    }

    if (apellidoss.length == 0) {
        $("#apellidos_oblig").html("Ingrese apellidos");
    } else {
        $("#apellidos_oblig").html("");
    }

    if (numero_docu.length == 0) {
        $("#cedula_obliga").html("Ingrese cedula");
    } else {
        $("#cedula_obliga").html("");
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
}