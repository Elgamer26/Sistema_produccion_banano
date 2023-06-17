var funcion, tabla_lotes;

function guardar_lotes() {
  var nombre_lote = $("#nombre_lote").val();
  var direccion = $("#direccion").val();
  var Longitud = $("#Longitud").val();
  var Latitud = $("#Latitud").val();
  var hectarea = 0;

  $("#taba_hectareas tbody#tbody_taba_hectareasl tr").each(function () {
    hectarea++;
  });

  if (hectarea == 0) {
    return Swal.fire(
      "Mensaje de advertencia",
      "NO hay hectareas en detalle",
      "warning"
    );
  }

  if (
    nombre_lote.length == 0 ||
    direccion.length == 0 ||
    Longitud.length == 0 ||
    Latitud.length == 0
  ) {
    validar_registro(nombre_lote, direccion, Longitud, Latitud);
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos",
      "warning"
    );
  } else {
    $("#nombre_oblig").html("");
    $("#direccion_obliga").html("");
    $("#Longitud_obliga").html("");
    $("#Latituds_obliga").html("");
  }

  funcion = "registrar_lotes";
  alerta = ["datos", "Se esta creando el lote", "Creando lote."];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/lote/lote.php",
    type: "POST",
    data: {
      funcion: funcion,
      nombre_lote: nombre_lote,
      direccion: direccion,
      Longitud: Longitud,
      Latitud: Latitud,
      hectarea: hectarea,
    },
  }).done(function (response) {
    console.log(response);
    if (response > 0) {
      registrar_detalle_hectreas(parseInt(response));
      //   if (response == 1) {
      //     alerta = ["exito", "success", "El lote se creo con exito"];
      //     cerrar_loader_datos(alerta);
      //     cargar_contenido("contenido_principal", "vista/lotes/nuevo_lote.php");
      //   } else {
      //     alerta = [
      //       "existe",
      //       "warning",
      //       "El nombre del lote " + nombre_lote + ", ingresado ya existe",
      //     ];
      //     cerrar_loader_datos(alerta);
      //   }
    } else {
      alerta = ["error", "error", "No se pudo crear el lote"];
      cerrar_loader_datos(alerta);
    }
  });
}

function registrar_detalle_hectreas(id) {
  var count = 0;
  var arrego_hectarea = new Array();

  $("#taba_hectareas tbody#tbody_taba_hectareasl tr").each(function () {
    arrego_hectarea.push($(this).find("td").eq(0).text());
    count++;
  });

  var hectarea = arrego_hectarea.toString();

  if (count == 0) {
    return false;
  }

  funcion = "registrar_detalle_hectarea";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../ADMIN/controlador/lote/lote.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      hectarea: hectarea,
    },
  }).done(function (resp) {
    console.log(resp);
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "El lote se creo con exito"];
        cerrar_loader_datos(alerta);
        cargar_contenido("contenido_principal", "vista/lotes/nuevo_lote.php");
      }
    } else {
      alerta = ["error", "error", "No se pudo crear el detalle de lote"];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_registro(nombre_lote, direccion, Longitud, Latitud) {
  if (nombre_lote.length == 0) {
    $("#nombre_oblig").html("Ingrese nombre lote");
  } else {
    $("#nombre_oblig").html("");
  }

  if (direccion.length == 0) {
    $("#direccion_obliga").html("Ingrese direccion lote");
  } else {
    $("#direccion_obliga").html("");
  }

  if (Longitud.length == 0) {
    $("#Longitud_obliga").html("Ingrese Longitud");
  } else {
    $("#Longitud_obliga").html("");
  }

  if (Latitud.length == 0) {
    $("#Latituds_obliga").html("Ingrese Latitud");
  } else {
    $("#Latituds_obliga").html("");
  }
}

function listar_lotes() {
  funcion = "listar_lotes";
  tabla_lotes = $("#tabla_lotes_").DataTable({
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
      url: "../ADMIN/controlador/lote/lote.php",
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
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el Oftalmólogo'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='hectarea btn btn-warning' title='ver hectareas'><i class='fa fa-h-square'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el Oftalmólogo'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='hectarea btn btn-warning' title='ver hectareas'><i class='fa fa-h-square'></i></button>`;
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
      { data: "nombre_l" },
      { data: "direccion" },
      { data: "hectarea" },
      { data: "logintud" },
      { data: "latitud" },
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
  tabla_lotes.on("draw.dt", function () {
    var pageinfo = $("#tabla_lotes_").DataTable().page.info();
    tabla_lotes
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_lotes_").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_lotes.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_lotes.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_lotes.row(this).data();
  }
  var dato = 0;
  var id = data.id_lote;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del lote se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_lote(id, dato);
    }
  });
});

$("#tabla_lotes_").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_lotes.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_lotes.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_lotes.row(this).data();
  }
  var dato = 1;
  var id = data.id_lote;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del lote se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_lote(id, dato);
    }
  });
});

function cambiar_estado_lote(id, dato) {
  var res = "";
  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "estado_lote";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + "",
    "Cambiando estado",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/lote/lote.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio"];
        cerrar_loader_datos(alerta);
        tabla_lotes.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo cambiar el estado"];
      cerrar_loader_datos(alerta);
    }
  });
}

////
$("#tabla_lotes_").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_lotes.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_lotes.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_lotes.row(this).data();
  }

  $("#id_lotess").val(data.id_lote);
  $("#nombre_lote").val(data.nombre_l);
  $("#direccion").val(data.direccion);
  $("#Longitud").val(data.logintud);
  $("#Latitud").val(data.latitud);
  $("#hectarea").val(data.hectarea);

  $("#modaleditar_lotes").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modaleditar_lotes").modal("show");
});

function editar_lotes() {
  var id = $("#id_lotess").val();
  var nombre_lote = $("#nombre_lote").val();
  var direccion = $("#direccion").val();
  var Longitud = $("#Longitud").val();
  var Latitud = $("#Latitud").val();
  var hectarea = $("#hectarea").val();

  if (
    nombre_lote.length == 0 ||
    direccion.length == 0 ||
    Longitud.length == 0 ||
    Latitud.length == 0 ||
    hectarea.length == 0
  ) {
    validar_registro(nombre_lote, direccion, Longitud, Latitud, hectarea);

    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos",
      "warning"
    );
  } else {
    $("#nombre_oblig").html("");
    $("#direccion_obliga").html("");
    $("#Longitud_obliga").html("");
    $("#Latituds_obliga").html("");
    $("#hectárea_obliga").html("");
  }

  funcion = "editar_lotess";
  alerta = ["datos", "Se esta editando el lote", "editando lote."];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/lote/lote.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      nombre_lote: nombre_lote,
      direccion: direccion,
      Longitud: Longitud,
      Latitud: Latitud,
      hectarea: hectarea,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "Se edito el lote con existe"];
        cerrar_loader_datos(alerta);
        tabla_lotes.ajax.reload();
        $("#modaleditar_lotes").modal("hide");
      } else {
        alerta = [
          "existe",
          "warning",
          "El lote " + nombre + ", ingresado ya existe",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = ["error", "error", "No se pudo editar el lote"];
      cerrar_loader_datos(alerta);
    }
  });
}

/////////////////
$("#tabla_lotes_").on("click", ".hectarea", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_lotes.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_lotes.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_lotes.row(this).data();
  }

  var id = data.id_lote;

  funcion = "cargra_detalle_lote";
  $.ajax({
    url: "../ADMIN/controlador/lote/lote.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    console.log(resp);

    alerta = ["", "", ""];
    cerrar_loader_datos(alerta);

    var data = JSON.parse(resp);
    var llenat = "";
    var count = 0;
    var estado = "";
    data["data"].forEach((row) => {
      if (row["ocupado"] == 1) {
        estado = "<button class='btn btn-success'>Disponible</button>";
      } else {
        estado =
          "<button class='btn btn-danger'>Ocupado</button> - <a class='btn btn-default' onclick=ver_produccion(" +
          row["id_produccion"] +
          ")><i class='fa fa-eye'></i></a>";
      }

      count++;
      llenat += `<tr>
                <td>${count}</td> 
                <td>${row["hectarea"]}</td>  
                <td>${estado}</td>   
                </tr>`;

      $("#tbody_taba_hectareasl").html(llenat);
    });
  });

  $("#modal_detalle_lote").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_detalle_lote").modal("show");
});

function ver_produccion(id) {

  funcion = "ver_produccion";
  $.ajax({
    url: "../ADMIN/controlador/lote/lote.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    console.log(resp);
    var data = JSON.parse(resp);

    $("#nombre_producion").val(data[0][4]);
    $("#fecha_ini").val(data[0][1]);
    $("#fecha_fin").val(data[0][2]);
    $("#dias_pro").val(data[0][3]); 

  });

  $("#modal_produccion").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_produccion").modal("show");
}
