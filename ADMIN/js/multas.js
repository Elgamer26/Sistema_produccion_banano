var funcion, tabla_multas;

function listar_tio_sancion() {
    funcion = "listar_tio_sancion";
    $.ajax({
        url: "../ADMIN/controlador/multas/multas.php",
        type: "POST",
        data: { funcion: funcion },
    }).done(function (response) {
        var data = JSON.parse(response);
        var cadena = "";
        if (data.length > 0) {
            //bucle para extraer los datos del rol
            for (var i = 0; i < data.length; i++) {
                cadena +=
                    "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
            }
            //aqui concadenamos al id del select
            $("#tipo_sancin").html(cadena);
        } else {
            cadena += "<option value=''>No hay datos</option>";
            $("#tipo_sancin").html(cadena);
        }
    });
}

function registrar_sancion() {

    var nombres = document.getElementById("nombres").value;
    var apellidos = document.getElementById("apellidos").value;

    var id_empleado = document.getElementById("id_empleado").value;
    var Fecha_i = document.getElementById("Fecha_i").value;
    var hora_i = document.getElementById("hora_i").value;
    var tipo_sancin = document.getElementById("tipo_sancin").value;
    var motivo_i = document.getElementById("motivo_i").value;
    var multa_dolra = document.getElementById("multa_dolra").value;
    var observacion = document.getElementById("observacion").value;

    var fe_ho = $("#Fecha_i").val() + " " + $("#hora_i").val();

    if (
        nombres.length == 0 ||
        apellidos.length == 0 ||
        Fecha_i.length == 0 ||
        hora_i.length == 0 ||
        tipo_sancin.length == 0 ||
        motivo_i.length == 0 ||
        multa_dolra.length == 0 ||
        observacion.length == 0
    ) {
        validar_registro(
            nombres,
            apellidos,
            Fecha_i,
            hora_i,
            tipo_sancin,
            motivo_i,
            multa_dolra,
            observacion
        );

        return swal.fire(
            "Campo vacios",
            "Debe ingresar todos los datos en los campos",
            "warning"
        );
    } else {
        $("#dcoumento_obliga").html("");
        $("#nombre_oblig").html("");
        $("#apellido_obliga").html("");
        $("#fecha_oblig").html("");
        $("#hora_obliga").html("");
        $("#tipoo_obliga").html("");
        $("#motivoo_obliga").html("");
        $("#multa_obliga").html("");
        $("#obsrvacion_obliga").html("");
    }

    funcion = "guadar_sancion";
    alerta = [
        "datos",
        "Se esta creando la sancion",
        "Creando sancion",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/multas/multas.php",
        type: "POST",
        data: {
            funcion: funcion,
            id_empleado: id_empleado,
            fe_ho: fe_ho,
            tipo_sancin: tipo_sancin,
            motivo_i: motivo_i,
            multa_dolra: multa_dolra,
            observacion: observacion
        },
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {
                alerta = ["exito", "success", "La multa se creo con exito"];
                cerrar_loader_datos(alerta);
                cargar_contenido('contenido_principal', 'vista/sanciones/nueva_sancion.php');
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al crear la multa",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function validar_registro(
    nombres,
    apellidos,
    Fecha_i,
    hora_i,
    tipo_sancin,
    motivo_i,
    multa_dolra,
    observacion
) {
    if (nombres.length == 0) {
        $("#nombre_oblig").html("Ingrese dato");
        $("#dcoumento_obliga").html("Ingrese cedula correcta");
    } else {
        $("#dcoumento_obliga").html("");
        $("#nombre_oblig").html("");
    }

    if (apellidos.length == 0) {
        $("#apellido_obliga").html("Ingrese dato");
    } else {
        $("#apellido_obliga").html("");
    }

    if (Fecha_i.length == 0) {
        $("#fecha_oblig").html("Ingrese fecha");
    } else {
        $("#fecha_oblig").html("");
    }

    if (hora_i.length == 0) {
        $("#hora_obliga").html("Ingrese hora");
    } else {
        $("#hora_obliga").html("");
    }

    if (tipo_sancin.length == 0) {
        $("#tipoo_obliga").html("Ingrese tipo");
    } else {
        $("#tipoo_obliga").html("");
    }

    if (motivo_i.length == 0) {
        $("#motivoo_obliga").html("Ingrese motivo");
    } else {
        $("#motivoo_obliga").html("");
    }

    if (multa_dolra.length == 0) {
        $("#multa_obliga").html("Ingrese valor");
    } else {
        $("#multa_obliga").html("");
    }

    if (observacion.length == 0) {
        $("#obsrvacion_obliga").html("Ingrese observacion");
    } else {
        $("#obsrvacion_obliga").html("");
    }
}

///////////////
function listar_tio_sancion_lis() {
    funcion = "listar_tio_sancion";
    $.ajax({
        url: "../ADMIN/controlador/multas/multas.php",
        type: "POST",
        data: { funcion: funcion },
    }).done(function (response) {
        var data = JSON.parse(response);
        var cadena = "";
        if (data.length > 0) {
            //bucle para extraer los datos del rol
            for (var i = 0; i < data.length; i++) {
                cadena +=
                    "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
            }
            //aqui concadenamos al id del select
            $("#tipo_sancin").html(cadena);
        } else {
            cadena += "<option value=''>No hay datos</option>";
            $("#tipo_sancin").html(cadena);
        }
    });
}

function listar_multass() {
    funcion = "listar_multass";
    tabla_multas = $("#tabla_multas_").DataTable({
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
            url: "../ADMIN/controlador/sancion/sancion.php",
            type: "POST",
            data: { funcion: funcion },
        },
        //hay que poner la misma cantidad de columnas y tambien en el html
        columns: [
            { defaultContent: "" },
            {
                data: "estado_pago",
                render: function (data, type, row) {
                    if (data == 0) {
                        return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el usuario'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el usuario'><i class='fa fa-edit'></i></button>`;
                    } else {
                        return `<button style='font-size:13px;' type='button' class='btn btn-success'><i class='fa fa-check'></i> Multa pagado</button>`;
                    }
                },
            },
            {
                data: "estado_pago",
                render: function (data, type, row) {
                    if (data == 0) {
                        return "<span class='label label-danger'>DEUDA MULTA</span>";
                    } else {
                        return "<span class='label label-success'>SIN DEUDA MULTA</span>";
                    }
                },
            },
            { data: "empleado" },
            { data: "tipo_sancion" },
            { data: "multa" },
            { data: "fecha_infraccion" },
            { data: "fecha_registro" },
            { data: "motivo" },
            { data: "observacion" },
            { data: "fecha_paga_multa" },
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
    tabla_multas.on("draw.dt", function () {
        var pageinfo = $("#tabla_multas_").DataTable().page.info();
        tabla_multas
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_multas_").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_multas.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_multas.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_multas.row(this).data();
    }

    document.getElementById("id_multa_edit").value = data.id_multa;

    document.getElementById("nombres").value = data.empleado;
    document.getElementById("Fecha_i").value = data.fecha_i;
    document.getElementById("hora_i").value = data.hora_i;
    $("#tipo_sancin").val(data.id_tipo_sancion).trigger("change");
    document.getElementById("motivo_i").value = data.motivo;
    document.getElementById("multa_dolra").value = data.multa;
    document.getElementById("observacion").value = data.observacion;

    $("#fecha_oblig").html("");
    $("#hora_obliga").html("");
    $("#tipoo_obliga").html("");
    $("#motivoo_obliga").html("");
    $("#multa_obliga").html("");
    $("#obsrvacion_obliga").html("");

    $("#modal_editar_multa").modal({ backdrop: "static", keyboard: false });
    $("#modal_editar_multa").modal("show");
});

function editar_sancion() {

    var id = document.getElementById("id_multa_edit").value;

    var Fecha_i = document.getElementById("Fecha_i").value;
    var hora_i = document.getElementById("hora_i").value;
    var tipo_sancin = document.getElementById("tipo_sancin").value;
    var motivo_i = document.getElementById("motivo_i").value;
    var multa_dolra = document.getElementById("multa_dolra").value;
    var observacion = document.getElementById("observacion").value;

    var fe_ho = $("#Fecha_i").val() + " " + $("#hora_i").val();

    if (
        Fecha_i.length == 0 ||
        hora_i.length == 0 ||
        tipo_sancin.length == 0 ||
        motivo_i.length == 0 ||
        multa_dolra.length == 0 ||
        observacion.length == 0
    ) {
        validar_registro_editar(
            Fecha_i,
            hora_i,
            tipo_sancin,
            motivo_i,
            multa_dolra,
            observacion
        );

        return swal.fire(
            "Campo vacios",
            "Debe ingresar todos los datos en los campos",
            "warning"
        );
    } else {
        $("#fecha_oblig").html("");
        $("#hora_obliga").html("");
        $("#tipoo_obliga").html("");
        $("#motivoo_obliga").html("");
        $("#multa_obliga").html("");
        $("#obsrvacion_obliga").html("");
    }

    funcion = "editar_sancion";
    alerta = [
        "datos",
        "Se esta editando la sancion",
        "Editando sancion",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/multas/multas.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id,
            fe_ho: fe_ho,
            tipo_sancin: tipo_sancin,
            motivo_i: motivo_i,
            multa_dolra: multa_dolra,
            observacion: observacion
        },
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {
                alerta = ["exito", "success", "La multa se edito con exito"];
                cerrar_loader_datos(alerta);
                tabla_multas.ajax.reload();
                $("#modal_editar_multa").modal("hide");
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al editar la multa",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function validar_registro_editar(
    Fecha_i,
    hora_i,
    tipo_sancin,
    motivo_i,
    multa_dolra,
    observacion
) {
    if (Fecha_i.length == 0) {
        $("#fecha_oblig").html("Ingrese fecha");
    } else {
        $("#fecha_oblig").html("");
    }

    if (hora_i.length == 0) {
        $("#hora_obliga").html("Ingrese hora");
    } else {
        $("#hora_obliga").html("");
    }

    if (tipo_sancin.length == 0) {
        $("#tipoo_obliga").html("Ingrese tipo");
    } else {
        $("#tipoo_obliga").html("");
    }

    if (motivo_i.length == 0) {
        $("#motivoo_obliga").html("Ingrese motivo");
    } else {
        $("#motivoo_obliga").html("");
    }

    if (multa_dolra.length == 0) {
        $("#multa_obliga").html("Ingrese valor");
    } else {
        $("#multa_obliga").html("");
    }

    if (observacion.length == 0) {
        $("#obsrvacion_obliga").html("Ingrese observacion");
    } else {
        $("#obsrvacion_obliga").html("");
    }
}

$("#tabla_multas_").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_multas.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_multas.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_multas.row(this).data();
    }

    var id = data.id_multa;

    Swal.fire({
        title: "Eliminar multa?",
        text: "La multa se eliminara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar!",
    }).then((result) => {
        if (result.isConfirmed) {
            eliminar_multa(id);
        }
    });
});

function eliminar_multa(id) {
    funcion = "eliminar_multa";
    alerta = [
        "datos",
        "Eliminado multa de empleado",
        "Elinando espere",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/multas/multas.php",
        type: "POST",
        data: { id: id, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "La multa se elimino con extio"];
                cerrar_loader_datos(alerta);
                tabla_multas.ajax.reload();
            }
        } else {
            alerta = [
                "error",
                "error",
                "No se pudo eliminar la multa",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}