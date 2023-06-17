var funcion, tabla_permiso;

function listar_tipo_permiso() {
    funcion = "listar_tipo_permiso";
    $.ajax({
        url: "../ADMIN/controlador/permiso/permiso.php",
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
            $("#tip_permiso").html(cadena);
        } else {
            cadena += "<option value=''>No hay datos</option>";
            $("#tip_permiso").html(cadena);
        }
    });
}

function registrar_permiso() {

    var id_empleado = document.getElementById("id_empleado").value;
    var nombres = document.getElementById("nombres").value;
    var apellidos = document.getElementById("apellidos").value;

    var Fecha_i = document.getElementById("Fecha_i").value;
    var Fecha_f = document.getElementById("Fecha_f").value;

    var tip_permiso = document.getElementById("tip_permiso").value;
    var observacion = document.getElementById("observacion").value;

    if (
        nombres.length == 0 ||
        apellidos.length == 0 ||
        Fecha_i.length == 0 ||
        Fecha_f.length == 0 ||
        tip_permiso.length == 0 ||
        observacion.length == 0
    ) {
        validar_registro(
            nombres,
            apellidos,
            Fecha_i,
            Fecha_f,
            tip_permiso,
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
        $("#fecha_i_oblig").html("");
        $("#fecha_f_oblig").html("");
        $("#tipoo_obliga").html("");
        $("#obsrvacion_obliga").html("");
    }

    if (Fecha_i > Fecha_f) {
        return Swal.fire(
            "Mensaje de advertencia",
            "La fecha inicio '" +
            Fecha_i +
            "' es mayor a la fecha final '" +
            Fecha_f +
            "'",
            "warning"
        );
    }

    funcion = "registrr_permisos";
    alerta = [
        "datos",
        "Se esta creando la sancion",
        "Creando sancion",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/permiso/permiso.php",
        type: "POST",
        data: {
            funcion: funcion,
            id_empleado: id_empleado,
            Fecha_i: Fecha_i,
            Fecha_f: Fecha_f,
            tip_permiso: tip_permiso,
            observacion: observacion
        },
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {
                alerta = ["exito", "success", "El permiso se creo con exito"];
                cerrar_loader_datos(alerta);
                cargar_contenido('contenido_principal', 'vista/permisos/mueva_permisos.php');
            }
        } else {
            alerta = [
                "error",
                "error",
                "Error al crear el permiso",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function validar_registro(
    nombres,
    apellidos,
    Fecha_i,
    Fecha_f,
    tip_permiso,
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
        $("#fecha_i_oblig").html("Ingrese fecha");
    } else {
        $("#fecha_i_oblig").html("");
    }

    if (Fecha_f.length == 0) {
        $("#fecha_f_oblig").html("Ingrese fecha");
    } else {
        $("#fecha_f_oblig").html("");
    }

    if (tip_permiso.length == 0) {
        $("#tipoo_obliga").html("Ingrese tipo");
    } else {
        $("#tipoo_obliga").html("");
    }

    if (observacion.length == 0) {
        $("#obsrvacion_obliga").html("Ingrese observacion");
    } else {
        $("#obsrvacion_obliga").html("");
    }
}

function listar_permisos_empleado() {
    funcion = "listar_permisos_empleado";
    tabla_permiso = $("#tabla_permisos_").DataTable({
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
                render: function () {
                    return `<button style='font-size:13px;' type='button' class='eliminar btn btn-danger' title='eliminar el permiso'><i class='fa fa-times'></i></button>`;
                },
            },
            { data: "empleado" },
            { data: "fecha_inicio" },
            { data: "fecha_fin" },
            { data: "tipo_permiso" },
            { data: "obsservacion" },
            { data: "fecha_registro" },
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
    tabla_permiso.on("draw.dt", function () {
        var pageinfo = $("#tabla_permisos_").DataTable().page.info();
        tabla_permiso
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_permisos_").on("click", ".eliminar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_permiso.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_permiso.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_permiso.row(this).data();
    }
    var id = data.id_permisos;

    Swal.fire({
        title: "Eliminar el permiso?",
        text: "El permiso se eliminara!!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar!",
    }).then((result) => {
        if (result.isConfirmed) {
            eliminar_permiso(id);
        }
    });
});

function eliminar_permiso(id) {

    funcion = "elimianr_permiso";
    alerta = [
        "datos",
        "Se esta eliminado el permiso",
        "Elimando",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/permiso/permiso.php",
        type: "POST",
        data: { id: id, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL permiso se elimino con extio"];
                cerrar_loader_datos(alerta);
                tabla_permiso.ajax.reload();
            }
        } else {
            alerta = [
                "error",
                "error",
                "No se pudo eliminar el permiso",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

////////////////////////
