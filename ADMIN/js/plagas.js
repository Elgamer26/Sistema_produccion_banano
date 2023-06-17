var funcion, tabla_plagas, tabla_tratamientos;

function listar_tipos_pgas() {
  funcion = "listar_tipos_pgas";
  $.ajax({
    url: "../ADMIN/controlador/plagas/plagas.php",
    type: "POST",
    data: {
      funcion: funcion,
    },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "";
    if (data.length > 0) {
      //bucle para extraer los datos del rol
      for (var i = 0; i < data.length; i++) {
        cadena +=
          "<option value='" +
          data[i][0] +
          "'>Tipo plaga: " +
          data[i][1] +
          "</option>";
      }
      //aqui concadenamos al id del select
      $("#tipo_plaga").html(cadena);
    } else {
      cadena += "<option value=''>No hay datos de plaga</option>";
      $("#tipo_plaga").html(cadena);
    }
  });
}

function nuevo_registro_plagas() {
  var prodcuciion_id = $("#prodcuciion_id").val();
  var fecha = $("#fecha_ras_des").val();
  var tipo_plaga = $("#tipo_plaga").val();
  var obsrvacion = $("#obsrvacion").val();
  var foto = $("#foto").val();

  if (
    prodcuciion_id.length == 0 ||
    fecha.length == 0 ||
    tipo_plaga.length == 0 ||
    obsrvacion.length == 0 ||
    foto.length == 0
  ) {
    validar_registro(prodcuciion_id, fecha, tipo_plaga, obsrvacion, foto);
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos",
      "warning"
    );
  } else {
    $("#prodcuciion_id_oblig").html("");
    $("#fecha_ras_des_oblig").html("");
    $("#tipo_plaga_oblig").html("");
    $("#obsrvacion_obliga").html("");
    $("#foto_oglib").html("");
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

  alerta = ["datos", "Se esta creando el registro", "Creando registro"];
  mostar_loader_datos(alerta);

  funcion = "nuevo_registro_plagas";

  formdata.append("funcion", funcion);
  formdata.append("prodcuciion_id", prodcuciion_id);
  formdata.append("fecha", fecha);
  formdata.append("tipo_plaga", tipo_plaga);
  formdata.append("obsrvacion", obsrvacion);
  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  $.ajax({
    url: "../ADMIN/controlador/plagas/plagas.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          alerta = [
            "exito",
            "success",
            "La plaga se registro con exito con exito",
          ];
          cerrar_loader_datos(alerta);
          cargar_contenido(
            "contenido_principal",
            "vista/plagas/registro_plagas.php"
          );
        } else if (resp == 2) {
          alerta = ["error", "error", "No se puedo guardar el registro"];
          cerrar_loader_datos(alerta);
        } else if (resp == 3) {
          alerta = [
            "error",
            "error",
            "No se pudo cargar la imagen de la plaga",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = [
          "existe",
          "warning",
          "No hay imagen para subir, ingrese una imagen",
        ];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function validar_registro(prodcuciion_id, fecha, tipo_plaga, obsrvacion, foto) {
  if (prodcuciion_id.length == 0) {
    $("#prodcuciion_id_oblig").html("No hay produccion");
  } else {
    $("#prodcuciion_id_oblig").html("");
  }

  if (fecha.length == 0) {
    $("#fecha_ras_des_oblig").html("No hay fecha");
  } else {
    $("#fecha_ras_des_oblig").html("");
  }

  if (tipo_plaga.length == 0) {
    $("#tipo_plaga_oblig").html("No hay tipo de plaga");
  } else {
    $("#tipo_plaga_oblig").html("");
  }

  if (obsrvacion.length == 0) {
    $("#obsrvacion_obliga").html("Ingrese la observacion");
  } else {
    $("#obsrvacion_obliga").html("");
  }

  if (foto.length == 0) {
    $("#foto_oglib").html("Ingrese la foto de la plaga");
  } else {
    $("#foto_oglib").html("");
  }
}

function listr_plagas() {
  funcion = "listr_plagas";
  tabla_plagas = $("#tabla_plagas").DataTable({
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
      url: "../ADMIN/controlador/plagas/plagas.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        data: "control_plaga",
        render: function (data, type, row) {
          if (data == 0) {
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el Oftalmólogo'><i class='fa fa-times'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='btn btn-success' title='Tratado'><i class='fa fa-check'></i> Tratado</button>`;
          }
        },
      },
      {
        data: "control_plaga",
        render: function (data, type, row) {
          if (data == 1) {
            return "<span class='label label-success'>TRATADO</span>";
          } else {
            return "<span class='label label-danger'>NO TRATADO</span>";
          }
        },
      },
      { data: "usuario" },
      { data: "produccion" },
      { data: "tipo_plaga" },
      {
        data: "foto",
        render: function (data, type, row) {
          return "<img class='img-circle' src='" + data + "' width='45px' />";
        },
      },
      { data: "fecha" },
      { data: "observacion" },
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
  tabla_plagas.on("draw.dt", function () {
    var pageinfo = $("#tabla_plagas").DataTable().page.info();
    tabla_plagas
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_plagas").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_plagas.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_plagas.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_plagas.row(this).data();
  }

  var id = data.id_control_plagas;
  var foto = data.foto;

  Swal.fire({
    title: "Eliminar el registro?",
    text: "SE eliinara el registro de plagas!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      eliinar_el_registro(id, foto);
    }
  });
});

function eliinar_el_registro(id, foto) {
  funcion = "eliinar_el_registro";
  alerta = ["datos", "Se esta eliminado el registro", "Cambiando estado"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/plagas/plagas.php",
    type: "POST",
    data: { id: id, foto: foto, funcion: funcion },
  }).done(function (response) {
    console.log(response);
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "Se elimino el registro con extio"];
        cerrar_loader_datos(alerta);
        tabla_plagas.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo eliminar el registro"];
      cerrar_loader_datos(alerta);
    }
  });
}

function listar_tratamientos_plagas() {
  funcion = "listar_tratamientos_plagas";
  tabla_tratamientos = $("#tabla_tratamiento_plagas").DataTable({
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
      url: "../ADMIN/controlador/plagas/plagas.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        data: "estado_trat",
        render: function (data, type, row) {
          if (data == 1) {
            return "<span class='label label-warning'>En tratamiento</span>";
          } else {
            return "<span class='label label-success'>Tratamiento finalizado</span>";
          }
        },
      },
      { data: "produccion" },
      { data: "tipo_plaga" },
      { data: "tipo_tratamiento" },
      { data: "tipo_quimico" },
      { data: "cantidad_litro" },
      { data: "fecha_ini" },
      { data: "fecha_fin" },
      { data: "dias_" },
      { data: "observacion" },
      {
        data: "avance",
        render: function (data, type, row) {         
            return "<span class='label label-default' style='font-size: 15px;'><b>" + data + " %</b></span>";
        },
      },
      {
        render: function (data, type, row) {
          return `<button style='font-size:13px;' type='button' class='avance btn btn-primary' title='avance de plaga'><i class='fa fa-clock-o'></i></button>`;
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
  tabla_tratamientos.on("draw.dt", function () {
    var pageinfo = $("#tabla_tratamiento_plagas").DataTable().page.info();
    tabla_tratamientos
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

/////////////
$("#tabla_tratamiento_plagas").on("click", ".avance", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_tratamientos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_tratamientos.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_tratamientos.row(this).data();
  }

  var id = data.id_traamiento;

  $("#id_tratamiento").val(id);
  $("#avance").val(data.avance);

  $("#modal_avance_tratmiento").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_avance_tratmiento").modal("show");
});

function guardar_avance() {
  var id = $("#id_tratamiento").val();
  var pocentaje_ = $("#avance").val();

  funcion = "guardar_avance";
  alerta = ["datos", "Se esta registrando el porcentaje", "Creando porcentaje"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/plagas/plagas.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      pocentaje_: pocentaje_
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        $("#modal_avance_tratmiento").modal("hide");
        alerta = [
          "exito",
          "success",
          "El porcentaje tratamiento se registro con exito",
        ];
        cerrar_loader_datos(alerta);
        tabla_tratamientos.ajax.reload();
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se puedo cambiar el porcentaje del tratamiento",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}
