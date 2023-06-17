var funcion, tabla_asistencia;

function marcar_entrada() {

    var nombres = document.getElementById("nombres").value;
    var apellidos = document.getElementById("apellidos").value;
    var id_empleado = document.getElementById("id_empleado").value;
    var Fecha_i = document.getElementById("Fecha_i").value;
    var hora_i = document.getElementById("hora_i").value;

    var fe_ho = $("#Fecha_i").val() + " " + $("#hora_i").val();

    if (
        nombres.length == 0 ||
        apellidos.length == 0 ||
        Fecha_i.length == 0 ||
        hora_i.length == 0
    ) {
        validar_registro(
            nombres,
            apellidos,
            Fecha_i,
            hora_i
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
    }

    funcion = "marcar_entrada";
    alerta = [
        "datos",
        "Se esta marcando la entrada",
        "Marcando entrada",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/asistencias/asistencias.php",
        type: "POST",
        data: {
            funcion: funcion,
            id_empleado: id_empleado,
            fe_ho: fe_ho
        },
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {
                alerta = ["exito", "success", "La asistencia se creo con exito"];
                cerrar_loader_datos(alerta);
                cargar_contenido('contenido_principal', 'vista/asistencia/marcar_entrada.php');
            } else {
                alerta = ["existe", "warning", "El empleado " + nombres + " " + apellidos + ", ya tiene una asistencia de entrada marcada, no puede marcar la entrada 2 veces"];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al crear la asistencia",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function validar_registro(
    nombres,
    apellidos,
    Fecha_i,
    hora_i
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
}

function marcar_salida() {

    var id_empleado = document.getElementById("id_empleado").value;
    var id_asistencia = document.getElementById("id_asistencia").value;
    var nombres = document.getElementById("nombres").value;
    var apellidos = document.getElementById("apellidos").value;

    var Fecha_i = document.getElementById("Fecha_s").value;
    var hora_i = document.getElementById("hora_s").value;

    var fe_ho = $("#Fecha_s").val() + " " + $("#hora_s").val();

    if (
        nombres.length == 0 ||
        apellidos.length == 0 ||
        Fecha_i.length == 0 ||
        hora_i.length == 0
    ) {
        validar_registro_salida(
            nombres,
            apellidos,
            Fecha_i,
            hora_i
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
    }

    funcion = "marcar_salida";
    alerta = [
        "datos",
        "Se esta marcando la salida",
        "Marcando salida",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/asistencias/asistencias.php",
        type: "POST",
        data: {
            funcion: funcion,
            id_asistencia: id_asistencia,
            id_empleado: id_empleado,
            fe_ho: fe_ho
        },
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {
                alerta = ["exito", "success", "La asistencia de salida se marco con exito"];
                cerrar_loader_datos(alerta);
                cargar_contenido('contenido_principal', 'vista/asistencia/marcar_salida.php');
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al crear la asistencia",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function validar_registro_salida(
    nombres,
    apellidos,
    Fecha_i,
    hora_i
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
}

function listar_asistencias() {
    funcion = "listar_asistencias";
    tabla_asistencia = $("#tabla_asistencias_").DataTable({
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
            url: "../ADMIN/controlador/asistencias/asistencias.php",
            type: "POST",
            data: { funcion: funcion },
        },
        //hay que poner la misma cantidad de columnas y tambien en el html
        columns: [
            { defaultContent: "" },
            {
                data: "estado_asistencia",
                render: function (data, type, row) {
                    if (data == 0) {
                        return "<span class='label label-success'>ENTRADA Y SALIDA MARCADA</span>";
                    } else {
                        return "<span class='label label-warning'>ENTRADA MARCADA</span>";
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

            { data: "empleado" },

            {
                data: "foto",
                render: function (data, type, row) {
        
                  return "<img class='img-circle' src='" + data + "' width='45px' />";
                }
              },

            { data: "fecha_hora_ingreso" },
            { data: "fecha_hora_salida" }, 
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
    tabla_asistencia.on("draw.dt", function () {
        var pageinfo = $("#tabla_asistencias_").DataTable().page.info();
        tabla_asistencia
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}