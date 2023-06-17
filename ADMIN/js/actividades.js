var funcion, tabla_actividad, tabla_asignacion_empleado;

function listar_trabajador_ac() {
    funcion = "listar_trabajador_ac";
    $.ajax({
        url: "../ADMIN/controlador/actividad/actividad.php",
        type: "POST",
        data: { funcion: funcion },
    }).done(function (response) {
        var data = JSON.parse(response);
        var cadena = "";
        if (data.length > 0) {
            //bucle para extraer los datos del rol
            for (var i = 0; i < data.length; i++) {
                cadena +=
                    "<option value='" + data[i][0] + "'> " + data[i][3] + " - " + data[i][1] + " - " + data[i][2] + " </option>";
            }
            //aqui concadenamos al id del select
            $("#datos_empleado").html(cadena);
            var id = $("#datos_empleado").val();
            traer_datos_emplead(parseInt(id));
        } else {
            cadena += "<option value=''>No hay datos</option>";
            $("#datos_empleado").html(cadena);

            $("#nombres").val("");
            $("#apellidos").val("");
            $("#sexo_e").val("");
            $("#telefono_empleado").val("");
            $("#foto_empleado").attr("src", "img/empleado/empleado.jpg");
            $("#estado_empleado").html("");
        }
    });
}

function traer_datos_emplead(id) {
    funcion = "traer_datos_emplead";
    $.ajax({
        url: "../ADMIN/controlador/actividad/actividad.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id
        },
    }).done(function (resp) {
        if (resp != 0) {
            var data = JSON.parse(resp);
            $("#nombres").val(data[0][1]);
            $("#apellidos").val(data[0][2]);
            $("#sexo_e").val(data[0][5]);
            $("#telefono_empleado").val(data[0][6]);
            $("#foto_empleado").attr("src", data[0][4]);
        } else {
            $("#nombres").val("");
            $("#apellidos").val("");
            $("#sexo_e").val("");
            $("#telefono_empleado").val("");
            $("#foto_empleado").attr("src", "img/empleado/empleado.jpg");
        }
    });

}

function listar_actividades() {
    funcion = "listar_actividades";
    $.ajax({
        url: "../ADMIN/controlador/actividad/actividad.php",
        type: "POST",
        data: { funcion: funcion },
    }).done(function (response) {
        var data = JSON.parse(response);
        var cadena = "";
        if (data.length > 0) {
            //bucle para extraer los datos del rol
            for (var i = 0; i < data.length; i++) {
                cadena +=
                    "<option value='" + data[i][0] + "'> " + data[i][1] + "  </option>";
            }
            //aqui concadenamos al id del select
            $("#tipo_actividad").html(cadena);
        } else {
            cadena += "<option value=''>No hay datos</option>";
            $("#tipo_actividad").html(cadena);
        }
    });
}

function registrar_actividdes() {

    var id_empleado = document.getElementById("datos_empleado").value;
    var tipo_actividad = document.getElementById("tipo_actividad").value;
    var costo_acivdad = document.getElementById("costo_acivdad").value;
    var fecha_asiga = document.getElementById("fecha_asiga").value;

    if (
        id_empleado.length == 0 ||
        tipo_actividad.length == 0 ||
        costo_acivdad.length == 0 ||
        fecha_asiga.length == 0 || costo_acivdad == "0.00" || costo_acivdad == "0"
    ) {
        validar_registro(
            id_empleado,
            tipo_actividad,
            costo_acivdad,
            fecha_asiga
        );

        return swal.fire(
            "Campo vacios",
            "Debe ingresar todos los datos en los campos",
            "warning"
        );
    } else {
        $("#empleado_obliga").html("");
        $("#tipoo_obliga").html("");
        $("#costo_obliga").html("");
        $("#fecha_obliga").html("");
    }

    funcion = "registrar_actividad";
    alerta = [
        "datos",
        "Se esta asignado una actividad al empleado",
        "Asignando actividad",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/actividad/actividad.php",
        type: "POST",
        data: {
            funcion: funcion,
            id_empleado: id_empleado,
            tipo_actividad: tipo_actividad,
            costo_acivdad: costo_acivdad,
            fecha_asiga: fecha_asiga,
        },
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {
                alerta = ["exito", "success", "Se asigno la actividad con exito"];
                cerrar_loader_datos(alerta);
                cargar_contenido('contenido_principal', 'vista/actividades/nuva_asignacion.php');
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al crear la asignacion de actividad",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function validar_registro(
    id_empleado,
    tipo_actividad,
    costo_acivdad,
    fecha_asiga
) {
    if (id_empleado.length == 0) {
        $("#empleado_obliga").html("No hay datos del empleado");
    } else {
        $("#empleado_obliga").html("");
    }

    if (tipo_actividad.length == 0) {
        $("#tipoo_obliga").html("No hay tipo de actividades");
    } else {
        $("#tipoo_obliga").html("");
    }

    if (costo_acivdad.length == 0 || costo_acivdad == "0.00" || costo_acivdad == "0") {
        $("#costo_obliga").html("Ingrese costo");
    } else {
        $("#costo_obliga").html("");
    }

    if (fecha_asiga.length == 0) {
        $("#fecha_obliga").html("Ingrese fecha");
    } else {
        $("#fecha_obliga").html("");
    }
}

//////////////////////////////
function listar_asignacion_actividad() {
    funcion = "listar_asignacion_actividad";
    tabla_asignacion_empleado = $("#tabla_actividades_").DataTable({
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
            url: "../ADMIN/controlador/actividad/actividad.php",
            type: "POST",
            data: { funcion: funcion },
        },
        //hay que poner la misma cantidad de columnas y tambien en el html
        columns: [
            { defaultContent: "" },
            {
                data: "estado_ac",
                render: function (data, type, row) {
                    if (data == 1) {
                        return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el usuario'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el usuario'><i class='fa fa-edit'></i></button>`;
                    } else {
                        return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el Oftalmólogo'><i class='fa fa-check'></i></button>`;
                    }
                },
            },
            {
                data: "estado_ac",
                render: function (data, type, row) {
                    if (data == 1) {
                        return "<span class='label label-success'>ACTIVIDAD ACTIVO</span>";
                    } else {
                        return "<span class='label label-danger'>ACTIVIDAD INACTIVO</span>";
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

            { data: "empeado" },

            {
                data: "actividad",
                render: function (data, type, row) {
                    if (data == 1) {
                        return "<span class='label label-primary'>Desocupado</span>";
                    } else {
                        return "<span class='label label-danger'>En produccion</span>";
                    }
                },
            },

            {
                data: "tipo_actividad",
                render: function (data, type, row) {

                    return "<span class='label label-warning'>" + data + "</span>";

                },
            },

            { data: "costo_actividad" },
            { data: "fecha" },
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
    tabla_asignacion_empleado.on("draw.dt", function () {
        var pageinfo = $("#tabla_actividades_").DataTable().page.info();
        tabla_asignacion_empleado
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_actividades_").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_asignacion_empleado.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_asignacion_empleado.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_asignacion_empleado.row(this).data();
    }
    var dato = 0;
    var id = data.id_asignacion_actividad;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado de la actividad se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_actividades(id, dato);
        }
    });
});

$("#tabla_actividades_").on("click", ".activar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_asignacion_empleado.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_asignacion_empleado.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_asignacion_empleado.row(this).data();
    }
    var dato = 1;
    var id = data.id_asignacion_actividad;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado de la actividad se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_actividades(id, dato);
        }
    });
});

function cambiar_estado_actividades(id, dato) {
    var res = "";
    if (dato == 1) {
        res = "activo";
    } else {
        res = "inactivo";
    }

    funcion = "cambiar_estado_actividades";
    alerta = [
        "datos",
        "Se esta cambiando el estado a " + res + "",
        "Cambiando estado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/actividad/actividad.php",
        type: "POST",
        data: { id: id, dato: dato, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                cerrar_loader_datos(alerta);
                tabla_asignacion_empleado.ajax.reload();
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

$("#tabla_actividades_").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_asignacion_empleado.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_asignacion_empleado.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_asignacion_empleado.row(this).data();
    }

    if (data.estado == 0) {
        return swal.fire(
            "El empleado se encuentra inactivo",
            "El empleado inacivo no puede ser editada su actividad",
            "error"
        );
    }

    $("#id_acitivdad_asig").val(data.id_asignacion_actividad);
    $("#tipo_actividad").val(data.id_tipo_actividad).trigger("change");
    $("#costo_acivdad").val(data.costo_actividad);

    $("#modal_editar_actividafd").modal({
        backdrop: "static",
        keyboard: false,
    });
    $("#modal_editar_actividafd").modal("show");
});

function editar_actividad() {

    var id = document.getElementById("id_acitivdad_asig").value;
    var tipo_actividad = document.getElementById("tipo_actividad").value;
    var costo_acivdad = document.getElementById("costo_acivdad").value;

    if (
        id.length == 0 ||
        tipo_actividad.length == 0 ||
        costo_acivdad.length == 0
    ) {
        return swal.fire(
            "Campo vacios",
            "Debe ingresar todos los datos en los campos",
            "warning"
        );
    }

    funcion = "editar_actividad";
    alerta = [
        "datos",
        "Se esta editando una actividad al empleado",
        "Editando actividad",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/actividad/actividad.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id,
            tipo_actividad: tipo_actividad,
            costo_acivdad: costo_acivdad
        },
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {
                alerta = ["exito", "success", "Se edito la actividad con exito"];
                cerrar_loader_datos(alerta);
                tabla_asignacion_empleado.ajax.reload();
                $("#modal_editar_actividafd").modal("hide");
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al edito la asignacion de actividad",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}


