var funcion, tabla_beneficio, tabla_beneficios_rol, tabla_rol_pagps;

function abrir_modal() {
    $("#nombre_beneficio").val("");
    $("#valor_beneficio").val("");
    $("#tipo_beneficio").val("");
    $("#modal_nuevo_beneficio").modal({
        backdrop: "static",
        keyboard: false,
    });
    $("#modal_nuevo_beneficio").modal("show");
}

function nuevo_beneficio() {
    var nombre = $("#nombre_beneficio").val();
    var valor = $("#valor_beneficio").val();
    var tipo = $("#tipo_beneficio").val();

    if (nombre.length == 0 || valor.length == 0) {
        return Swal.fire({
            icon: "warning",
            title: "No hay datos completos no deben quedar campos vacios",
            text: "Ingrese un datos completos no deben quedar campos vacios!!",
        });
    }

    funcion = "registrar_beneficio";
    alerta = ["datos", "Se esta creando el beneficio", "Creando beneficio."];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/beneficio/beneficio.php",
        type: "POST",
        data: {
            funcion: funcion,
            nombre: nombre,
            valor: valor,
            tipo: tipo,
        },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = [
                    "exito",
                    "success",
                    "El beneficio se creo con exito",
                ];
                cerrar_loader_datos(alerta);
                tabla_beneficio.ajax.reload();
                $("#modal_nuevo_beneficio").modal("hide");
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El beneficio " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo crear el beneficio"];
            cerrar_loader_datos(alerta);
        }
    });
}

function listra_beneficios() {
    funcion = "listra_beneficios";
    tabla_beneficio = $("#tabla_beneficios").DataTable({
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
            url: "../ADMIN/controlador/beneficio/beneficio.php",
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
            { data: "nombre" },
            { data: "valor" },
            { data: "tipo" },
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
    tabla_beneficio.on("draw.dt", function () {
        var pageinfo = $("#tabla_beneficios").DataTable().page.info();
        tabla_beneficio
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_beneficios").on("click", ".inactivar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_beneficio.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_beneficio.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_beneficio.row(this).data();
    }
    var dato = 0;
    var id = data.id_beneficios;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del beneficio se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_beneficio(id, dato);
        }
    });
});

$("#tabla_beneficios").on("click", ".activar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_beneficio.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_beneficio.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_beneficio.row(this).data();
    }
    var dato = 1;
    var id = data.id_beneficios;

    Swal.fire({
        title: "Cambiar estado?",
        text: "El estado del beneficio se cambiara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cambiar!",
    }).then((result) => {
        if (result.isConfirmed) {
            cambiar_estado_beneficio(id, dato);
        }
    });
});

function cambiar_estado_beneficio(id, dato) {
    var res = "";
    if (dato == 1) {
        res = "activo";
    } else {
        res = "inactivo";
    }

    funcion = "estado_benedifico";
    alerta = [
        "datos",
        "Se esta cambiando el estado a " + res + "",
        "Cambiando estado",
    ];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/beneficio/beneficio.php",
        type: "POST",
        data: { id: id, dato: dato, funcion: funcion },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                cerrar_loader_datos(alerta);
                tabla_beneficio.ajax.reload();
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

$("#tabla_beneficios").on("click", ".editar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_beneficio.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_beneficio.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_beneficio.row(this).data();
    }

    $("#id_edit_benefiio").val(data.id_beneficios);
    $("#nombre_beneficio_edit").val(data.nombre);
    $("#valor_beneficio_edit").val(data.valor);
    $("#tipo_beneficio_edir").val(data.tipo);

    $("#modal_editar_benificio").modal({
        backdrop: "static",
        keyboard: false,
    });
    $("#modal_editar_benificio").modal("show");
});

function editar_beneficio() {
    var id = $("#id_edit_benefiio").val();
    var nombre = $("#nombre_beneficio_edit").val();
    var valor = $("#valor_beneficio_edit").val();
    var tipo = $("#tipo_beneficio_edir").val();

    if (nombre.length == 0 || valor.length == 0) {
        return Swal.fire({
            icon: "warning",
            title: "No hay datos completos no deben quedar campos vacios",
            text: "Ingrese un datos completos no deben quedar campos vacios!!",
        });
    }

    funcion = "editr_beneficio";
    alerta = ["datos", "Se esta editando el beneficio", "Editando beneficio."];
    mostar_loader_datos(alerta);

    $.ajax({
        url: "../ADMIN/controlador/beneficio/beneficio.php",
        type: "POST",
        data: {
            funcion: funcion,
            nombre: nombre,
            valor: valor,
            tipo: tipo,
            id: id,
        },
    }).done(function (response) {
        if (response > 0) {
            if (response == 1) {
                alerta = [
                    "exito",
                    "success",
                    "El beneficio se edito con exito",
                ];
                cerrar_loader_datos(alerta);
                tabla_beneficio.ajax.reload();
                $("#modal_editar_benificio").modal("hide");
            } else {
                alerta = [
                    "existe",
                    "warning",
                    "El beneficio " + nombre + ", ingresado ya existe",
                ];
                cerrar_loader_datos(alerta);
            }
        } else {
            alerta = ["error", "error", "No se pudo editar el beneficio"];
            cerrar_loader_datos(alerta);
        }
    });
}

///////////////////
function modal_beneficios() {
    $("#modal_benficios_rol_pagoss").modal({
        backdrop: "static",
        keyboard: false,
    });
    $("#modal_benficios_rol_pagoss").modal("show");
}

function listar_bebficios_rol() {
    funcion = "listar_bebficios_rol";
    tabla_beneficios_rol = $("#tabla_beneficios_rol").DataTable({
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
            url: "../ADMIN/controlador/rol_pagos/rol_pagos.php",
            type: "POST",
            data: { funcion: funcion },
        },
        //hay que poner la misma cantidad de columnas y tambien en el html
        columns: [
            { defaultContent: "" },
            { data: "nombre" },
            { data: "valor" },
            {
                data: "tipo",
                render: function (data, type, row) {
                    if (data == 'Ingreso') {
                        return "<span class='label label-success'>" + data + "</span>";
                    } else {
                        return "<span class='label label-danger'>" + data + "</span>";
                    }
                },
            },
            {
                data: "estado",
                render: function (data, type, row) {
                    return `<button style='font-size:13px;' type='button' class='enviar btn btn-warning' title='Enviar datos'><i class='fa fa-send-o'></i></button>`;

                },
            },
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
        order: [[0, "desc"]],
    });

    //esto es para crearn un contador para la tabla este contador es automatico
    tabla_beneficios_rol.on("draw.dt", function () {
        var pageinfo = $("#tabla_beneficios_rol").DataTable().page.info();
        tabla_beneficios_rol
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_beneficios_rol").on("click", ".enviar", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_beneficios_rol.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_beneficios_rol.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_beneficios_rol.row(this).data();
    }

    var id = data.id_beneficios;
    var nombre = data.nombre;
    var cantidad = data.valor;
    var tipo = data.tipo;
    var valor = $("#monto_dra").val();
    var plata = 0;

    if (tipo == 'Ingreso') {

        if (verificar_ingreso(id)) {
            return Swal.fire(
                "Mensaje de advertencia",
                "El ingreso '" +
                nombre +
                "' , ya fue agregado al detalle de 'INGRESOS'",
                "warning"
            );
        }

        plata = parseFloat(valor * cantidad / 100).toFixed(2);

        var datos_agg_ingreso = "<tr>";
        datos_agg_ingreso += "<td for='id'>" + id + "</td>";
        datos_agg_ingreso += "<td>" + nombre + "</td>";
        datos_agg_ingreso += "<td>" + plata + "</td>";
        datos_agg_ingreso += "<td><button onclick='remove_ingreso(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
        datos_agg_ingreso += "</tr>";

        //esto me ayuda a enviar los datos a la tabla
        $("#tbody_detalle_ingreso").append(datos_agg_ingreso);
        calculat_ingreso();
    } else {

        if (verificar_egreso(id)) {
            return Swal.fire(
                "Mensaje de advertencia",
                "El egreso '" +
                nombre +
                "' , ya fue agregado al detalle 'EGRESOS'",
                "warning"
            );
        }

        plata = parseFloat(valor * cantidad / 100).toFixed(2);

        var datos_agg_egreso = "<tr>";
        datos_agg_egreso += "<td for='id'>" + id + "</td>";
        datos_agg_egreso += "<td>" + nombre + "</td>";
        datos_agg_egreso += "<td>" + plata + "</td>";
        datos_agg_egreso += "<td><button onclick='remove_egreso(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
        datos_agg_egreso += "</tr>";

        //esto me ayuda a enviar los datos a la tabla
        $("#tbody_detalle_egreso").append(datos_agg_egreso);
        calcular_egreso();
    }
    $("#modal_benficios_rol_pagoss").modal("hide");
});

function calculat_ingreso() {
    let arreglo_ingreso = new Array();
    let sub_ingreso = 0;
    var count_ingreso = 0;
    let total_ingreso = 0;

    $("#detalle_tabla_ingreso tbody#tbody_detalle_ingreso tr").each(function () {
        arreglo_ingreso.push($(this).find("td").eq(2).text());
        count_ingreso++;
    });

    for (var i = 0; i < count_ingreso; i++) {
        var suma = arreglo_ingreso[i];
        sub_ingreso = (parseFloat(sub_ingreso) + parseFloat(suma)).toFixed(2);
    }
    total_ingreso = sub_ingreso;
    $("#total_ingreso").html("Total ingreso: $/. " + parseFloat(total_ingreso).toFixed(2));
    $("#txt_total_ingreso").val(parseFloat(total_ingreso).toFixed(2));

    var bandera1 = $("#txt_total_egreso").val();
    var bandera2 = $("#txt_total_ingreso").val();
    var neto = 0;
    neto = bandera2 - bandera1;
    $("#lbl_neto_pagar").html("$/. " + parseFloat(neto).toFixed(2));
    $("#txtneto_pagar").val(parseFloat(neto).toFixed(2));
}

function calcular_egreso() {

    let arreglo_egreso = new Array();
    let sub_egreso = 0;
    var count_egreso = 0;
    let total_egreso = 0;

    $("#detalle_tabla_egreso tbody#tbody_detalle_egreso tr").each(function () {
        arreglo_egreso.push($(this).find("td").eq(2).text());
        count_egreso++;
    });

    for (var i = 0; i < count_egreso; i++) {
        var suma = arreglo_egreso[i];
        sub_egreso = (parseFloat(sub_egreso) + parseFloat(suma)).toFixed(2);
    }
    total_egreso = sub_egreso;
    $("#total_egreso").html("Total egreso: $/. " + parseFloat(total_egreso).toFixed(2));
    $("#txt_total_egreso").val(parseFloat(total_egreso).toFixed(2));

    var bandera1 = $("#txt_total_egreso").val();
    var bandera2 = $("#txt_total_ingreso").val();
    var neto = 0;
    neto = bandera2 - bandera1;
    $("#lbl_neto_pagar").html("$/. " + parseFloat(neto).toFixed(2));
    $("#txtneto_pagar").val(parseFloat(neto).toFixed(2));
}

function remove_egreso(t) {
    var td = t.parentNode;
    var tr = td.parentNode;
    var table = tr.parentNode;
    table.removeChild(tr);
    calcular_egreso();
}

function remove_ingreso(t) {
    var td = t.parentNode;
    var tr = td.parentNode;
    var table = tr.parentNode;
    table.removeChild(tr);
    calculat_ingreso();
}

function verificar_egreso(id) {
    let idverificar = document.querySelectorAll(
        "#tbody_detalle_egreso td[for='id']"
    );
    return (
        [].filter.call(idverificar, (td) => td.textContent == id).length == 1
    );
}

function verificar_ingreso(id) {
    let idverificar = document.querySelectorAll(
        "#tbody_detalle_ingreso td[for='id']"
    );
    return (
        [].filter.call(idverificar, (td) => td.textContent == id).length == 1
    );
}

/////////////////
////////////////////
function Crear_rol_pagos() {

    Swal.fire({
        title: 'Se creará un rol de pago de empleado',
        text: "Desea crear un rol de pago del empleado?",
        icon: 'warning',
        showCancelButton: true,
        showConfirmButton: true,
        allowOutsideClick: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, si crear!!'
    }).then((result) => {
        if (result.value) {


            var id_empleado = $("#id_empleado").val();

            var idd = id_empleado.split("-");
            var id_em = parseInt(idd[0]);
            var id_producion = parseInt(idd[1]);

            var actividad = $("#aci_prpdoc").val();
            var produccion_datos = $("#produccion_datos").val();
            var fecha_pago = $("#fecha_pago").val() + " " + $("#hora").val();
            var pago_ac = $("#pago_ac").val();
            var dias_prod = $("#dias_prod").val();
            var total_ingreso = $("#txt_total_ingreso").val();
            var total_egreso = $("#txt_total_egreso").val();
            var txtneto_pagar = $("#txtneto_pagar").val();
            var count_ingreso = 0;
            var count_egreso = 0;
            var count_asiste = 0;

            if (id_empleado.length == 0) {
                $("#id_empleado_obliga").html("No hay datos del empleado");
                return swal.fire(
                    "Campo vacios",
                    "Debe haber un empleado para realizar el rol de pagos",
                    "warning"
                );
            } else {
                $("#id_empleado_obliga").html("");
            }

            if (produccion_datos.length == 0 || dias_prod.length == 0) {
                return swal.fire(
                    "Campo vacios",
                    "Debe seleccionar un empleado",
                    "warning"
                );
            }

            $("#detalle_tabla_ingreso tbody#tbody_detalle_ingreso tr").each(function () {
                count_ingreso++;
            });

            $("#detalle_tabla_egreso tbody#tbody_detalle_egreso tr").each(function () {
                count_egreso++;
            });

            $("#detalle_tabla_asistencia tbody#tbody_detalle_tabla_asistencia tr").each(function () {
                count_asiste++;
            });

            if (count_ingreso == 0) {
                $("#detalle_ingreso_obligg").html("No hay ingreso en la tabla");
                return Swal.fire("Mensaje de advertencia", "No hay datos en la tabla ingreso,(TABLA INGRESO)", "warning");
            } else {
                $("#detalle_ingreso_obligg").html("");
            }

            if (count_egreso == 0) {
                $("#detalle_eggreso_obligg").html("No hay egreso en la tabla");
                return Swal.fire("Mensaje de advertencia", "No hay datos en la tabla egreso,(TABLA EGRESO)", "warning");
            } else {
                $("#detalle_eggreso_obligg").html("");
            }

            if (count_asiste == 0) {
                $("#detalle_asistencia_obligg").html("No hay datos de asistencia");
                return Swal.fire("Mensaje de advertencia", "No hay datos en la tabla asistencias,(TABLA ASISTENCIAS)", "warning");
            } else {
                $("#detalle_asistencia_obligg").html("");
            }

            funcion = "registrar_rol_de_pagos";
            alerta = [
                "datos",
                "Se esta creando el rol pagos",
                "Creando rol de pagos",
            ];
            mostar_loader_datos(alerta);

            $.ajax({
                url: "../ADMIN/controlador/rol_pagos/rol_pagos.php",
                type: "POST",
                data: {
                    funcion: funcion,
                    id_em: id_em,
                    id_producion: id_producion,
                    actividad: actividad,
                    produccion_datos: produccion_datos,
                    fecha_pago: fecha_pago,
                    pago_ac: pago_ac,
                    dias_prod: dias_prod,
                    total_ingreso: total_ingreso,
                    total_egreso: total_egreso,
                    txtneto_pagar: txtneto_pagar,
                    count_ingreso: count_ingreso,
                    count_egreso: count_egreso,
                },
            }).done(function (resp) {
                if (resp > 0) {
                    rgistrar_detalle_ingreso(parseInt(resp));
                    pagar_multas_empleado(parseInt(id_em));
                    sacar_asistencias(parseInt(id_em));
                } else {
                    alerta = [
                        "error",
                        "error",
                        "No se pudo crear el rol de pagos del empleado",
                    ];
                    cerrar_loader_datos(alerta);
                }
            });

        }
    });
}

function  sacar_asistencias(id){
    var count = 0;
    var arrego_idasistencia = new Array();

    $("#detalle_tabla_asistencia tbody#tbody_detalle_tabla_asistencia tr").each(function () {
        arrego_idasistencia.push($(this).find('td').eq(0).text());
        count++;
    })

    if (count == 0) {
        console.log("No asistencia");
        return false;
    }

    //aqui combierto el arreglo a un string
    var idasistencia = arrego_idasistencia.toString();

    funcion = "sacra_asistencias";
    //ajax para guardar detalle registros
    $.ajax({
        url: "../ADMIN/controlador/rol_pagos/rol_pagos.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id,
            idasistencia: idasistencia,
        },
    }).done(function (resp) {
        console.log(resp);
    });
}

function rgistrar_detalle_ingreso(id) {

    var count = 0;
    var arrego_nombre = new Array();
    var arreglo_cantidad = new Array();

    $("#detalle_tabla_ingreso tbody#tbody_detalle_ingreso tr").each(function () {
        arrego_nombre.push($(this).find('td').eq(1).text());
        arreglo_cantidad.push($(this).find('td').eq(2).text());
        count++;
    })

    //aqui combierto el arreglo a un string
    var nombre = arrego_nombre.toString();
    var cantidad = arreglo_cantidad.toString();

    if (count == 0) {
        return false;
    }

    funcion = "registrar_detalle_ingreso";
    //ajax para guardar detalle registros
    $.ajax({
        url: "../ADMIN/controlador/rol_pagos/rol_pagos.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id,
            nombre: nombre,
            cantidad: cantidad,
        },
    }).done(function (resp) {
        if (resp > 0) {
            rgistrar_detalle_egreso(id);
        } else {
            alerta = [
                "error",
                "error",
                "No se pudo regitrar el detalle deel ingreso",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function rgistrar_detalle_egreso(id) {

    var count = 0;
    var arrego_nombre = new Array();
    var arreglo_cantidad = new Array();

    $("#detalle_tabla_egreso tbody#tbody_detalle_egreso tr").each(function () {
        arrego_nombre.push($(this).find('td').eq(1).text());
        arreglo_cantidad.push($(this).find('td').eq(2).text());
        count++;
    })

    //aqui combierto el arreglo a un string
    var nombre = arrego_nombre.toString();
    var cantidad = arreglo_cantidad.toString();

    if (count == 0) {
        return false;
    }

    funcion = "registrar_detalle_egreso";
    //ajax para guardar detalle registros
    $.ajax({
        url: "../ADMIN/controlador/rol_pagos/rol_pagos.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id,
            nombre: nombre,
            cantidad: cantidad,
        },
    }).done(function (resp) {
        if (resp > 0) {
            alerta = ["", "", "",];
            cerrar_loader_datos(alerta);

            Swal.fire({
                title: 'Se imprimira el rol de pagos del empleado',
                text: "Desea imprimir el rol de pagos del empleado?",
                icon: 'warning',
                showCancelButton: true,
                showConfirmButton: true,
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, imprimir!!'
            }).then((result) => {
                window.open("../ADMIN/REPORTES/Pdf/rol_depagos.php?id=" + parseInt(id) + "#zoom=100%", "Rol de pagos", "scrollbards=No");
                cargar_contenido('contenido_principal', 'vista/rol_pagos/pagos_empleados.php');
            });
            enviar_rol_pagos(parseInt(id));
            cargar_contenido('contenido_principal', 'vista/rol_pagos/pagos_empleados.php');
        } else {
            alerta = [
                "error",
                "error",
                "No se pudo regitrar el detalle deel egreso",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

function enviar_rol_pagos(id) {
    if (id.length == 0 || id == "" || id == null) {
      return false;
    }
  
    $.ajax({
      url: "../ADMIN/modelo/envio_correo/enviar_rol_pagos.php",
      type: "POST",
      data: {
        id: id,
      },
    }).done(function (response) {
      console.log(response);
    });
  }

///////////7
function pagar_multas_empleado(id) {

    var count = 0;
    var arrego_id_multa = new Array();

    $("#tabla_sanciones tbody#tbody_detalle_sanciones tr").each(function () {
        arrego_id_multa.push($(this).find('td').eq(0).text());
        count++;
    })

    if (count == 0) {
        console.log("No multa");
        return false;
    }

    //aqui combierto el arreglo a un string
    var id_multa = arrego_id_multa.toString();

    funcion = "pagar_multa_sancion";
    //ajax para guardar detalle registros
    $.ajax({
        url: "../ADMIN/controlador/rol_pagos/rol_pagos.php",
        type: "POST",
        data: {
            funcion: funcion,
            id: id,
            id_multa: id_multa,
        },
    }).done(function (resp) {
        console.log("Multa:" + resp);
        if (resp > 0) {
            cargar_contenido('contenido_principal', 'vista/rol_pagos/pagos_empleados.php');
        } else {
            alerta = [
                "error",
                "error",
                "No se pudo regitrar el detalle deel egreso",
            ];
            cerrar_loader_datos(alerta);
        }
    });
}

/////////////////
function listar_rol_pagos() {
    funcion = "listar_rol_pagos";
    tabla_rol_pagps = $("#tabla_rol_pagos_").DataTable({
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
            url: "../ADMIN/controlador/rol_pagos/rol_pagos.php",
            type: "POST",
            data: { funcion: funcion },
        },
        //hay que poner la misma cantidad de columnas y tambien en el html
        columns: [
            { defaultContent: "" },
            {
                render: function (data, type, row) {
                    return `<button style='font-size:13px;' type='button' class='ver_pdf btn btn-primary' title='ver rol pagos'><i class='fa fa-eye'></i></button> `;
                },
            },
            { data: "fecha_pago" },
            { data: "empleado" },
            { data: "actividad" },
            { data: "pagos_actividad" },
            { data: "produccion_datos" },
            { data: "dias" },
            { data: "neto_pagar" },
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
    tabla_rol_pagps.on("draw.dt", function () {
        var pageinfo = $("#tabla_rol_pagos_").DataTable().page.info();
        tabla_rol_pagps
            .column(0, { page: "current" })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + pageinfo.start;
            });
    });
}

$("#tabla_rol_pagos_").on("click", ".ver_pdf", function () {
    //esto esta extrayendo los datos de la tabla el (data)
    var data = tabla_rol_pagps.row($(this).parents("tr")).data(); //a que fila deteta que doy click
    //esta condicion es importante para el responsibe porque salda un error si no lo pongo
    if (tabla_rol_pagps.row(this).child.isShown()) {
        //esto es cuando esta en tamaño responsibo
        var data = tabla_rol_pagps.row(this).data();
    }

    var id = data.id_rol_pagos;

    Swal.fire({
        title: 'Se impirmira el rol de pagos del empleado',
        text: "Desea imprimir el rol de pagos del empleado??",
        icon: 'warning',
        showCancelButton: true,
        showConfirmButton: true,
        allowOutsideClick: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, imprimir!!'
    }).then((result) => {
        window.open("../ADMIN/REPORTES/Pdf/rol_depagos.php?id=" + parseInt(id) + "#zoom=100%", "Rol de pagos", "scrollbards=No");
    });
});
