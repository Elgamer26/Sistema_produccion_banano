var funcion, fecha_i, fecha_f, tabla_racimos, tabla_desechos;

function listas_lotes_cosechas() {
  funcion = "listas_lotes_cosechas";
  $.ajax({
    url: "../ADMIN/controlador/desechos_racimos/desechos_racimos.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "";
    if (data.length > 0) {
      //bucle para extraer los datos del rol
      for (var i = 0; i < data.length; i++) {
        cadena +=
          "<option value='" +
          data[i][0] +
          "'>Nombre de produccion: " +
          data[i][7] +
          " - Lote: " +
          data[i][1] +
          " - Hectareas: " +
          data[i][9] +
          " - Estado: " +
          data[i][5] +
          "</option>";
      }
      //aqui concadenamos al id del select
      $("#prodcuciion_id").html(cadena);
      var id = $("#prodcuciion_id").val();
      traer_fechas(parseInt(id));
    } else {
      cadena += "<option value=''>No hay datos de lote</option>";
      $("#prodcuciion_id").html(cadena);
    }
  });
}

function traer_fechas(id) {
  funcion = "traer_fechas";
  $.ajax({
    url: "../ADMIN/controlador/desechos_racimos/desechos_racimos.php",
    type: "POST",
    data: { funcion: funcion, id: id },
  }).done(function (response) {
    var data = JSON.parse(response);
    fecha_i = data[0][0];
    fecha_f = data[0][1];
    mostar_fecha(fecha_i, fecha_f);
  });
}

function mostar_fecha(fecha_i, fecha_f) {
  $(".calendario").flatpickr({
    minDate: fecha_i,
    maxDate: fecha_f,
    locale: {
      firstDayOfWeek: 1,
      weekdays: {
        shorthand: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        longhand: [
          "Domingo",
          "Lunes",
          "Martes",
          "Miércoles",
          "Jueves",
          "Viernes",
          "Sábado",
        ],
      },
      months: {
        shorthand: [
          "Ene",
          "Feb",
          "Mar",
          "Abr",
          "May",
          "Jun",
          "Jul",
          "Ago",
          "Sep",
          "Оct",
          "Nov",
          "Dic",
        ],
        longhand: [
          "Enero",
          "Febreo",
          "Мarzo",
          "Abril",
          "Mayo",
          "Junio",
          "Julio",
          "Agosto",
          "Septiembre",
          "Octubre",
          "Noviembre",
          "Diciembre",
        ],
      },
    },
  });
}

function registrar_deschos_csechas() {
  var prodcuciion_id = $("#prodcuciion_id").val();
  var fecha_ras_des = $("#fecha_ras_des").val();
  var numero_ra = $("#numero_ra").val();
  var tipo_ses = $("#tipo_ses").val();

  var cjas_oblig = $("#cajas_n").val();
  var peso_cajas = $("#peso_cajas").val();

  if (
    prodcuciion_id.length == 0 ||
    fecha_ras_des.length == 0 ||
    numero_ra.length == 0 ||
    tipo_ses.length == 0 ||
    tipo_ses == "-----------" ||
    cjas_oblig.length == 0 ||
    peso_cajas.length == 0
  ) {
    validar_registro(
      prodcuciion_id,
      fecha_ras_des,
      numero_ra,
      tipo_ses,
      cjas_oblig,
      peso_cajas
    );
    return Swal.fire({
      icon: "warning",
      title: "No hay datos completos",
      text: "Ingrese un datos completos!!",
    });
  } else {
    $("#prodcuciion_id_oblig").html("");
    $("#fecha_ras_des_oblig").html("");
    $("#cantidad_oblig").html("");
    $("#tipo_ses_oblig").html("");
    $("#cjas_oblig").html("");
    $("#peso_cja_oblig").html("");
  }

  funcion = "registrar_deschos_csechas";
  alerta = ["datos", "Se esta creando el registro", "Creando el registro."];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/desechos_racimos/desechos_racimos.php",
    type: "POST",
    data: {
      funcion: funcion,
      prodcuciion_id: prodcuciion_id,
      fecha_ras_des: fecha_ras_des,
      numero_ra: numero_ra,
      tipo_ses: tipo_ses,
      cjas_oblig: cjas_oblig,
      peso_cajas: peso_cajas,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = [
          "exito",
          "success",
          "Se ingreso el datos exitosamente de " + tipo_ses,
        ];
        cerrar_loader_datos(alerta);
        cargar_contenido(
          "contenido_principal",
          "vista/desecho/nueva_desecho.php"
        );
      }
    } else {
      alerta = ["error", "error", "No se pudo guardar el registro"];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_registro(
  prodcuciion_id,
  fecha_ras_des,
  numero_ra,
  tipo_ses,
  cjas_oblig,
  peso_cajas
) {
  if (prodcuciion_id.length == 0) {
    $("#prodcuciion_id_oblig").html("Ingrese produccion");
  } else {
    $("#prodcuciion_id_oblig").html("");
  }

  if (fecha_ras_des.length == 0) {
    $("#fecha_ras_des_oblig").html("Ingrese fecha");
  } else {
    $("#fecha_ras_des_oblig").html("");
  }

  if (numero_ra.length == 0) {
    $("#cantidad_oblig").html("Ingrese numero de ingreso");
  } else {
    $("#cantidad_oblig").html("");
  }

  if (tipo_ses.length == 0) {
    $("#tipo_ses_oblig").html("Ingrese tipo");
  } else {
    $("#tipo_ses_oblig").html("");
  }

  if (tipo_ses == "-----------") {
    $("#tipo_ses_oblig").html("Ingrese tipo");
  } else {
    $("#tipo_ses_oblig").html("");
  }

  if (cjas_oblig.length == 0) {
    $("#cjas_oblig").html("Ingrese dato");
  } else {
    $("#cjas_oblig").html("");
  }

  if (peso_cajas.length == 0) {
    $("#peso_cja_oblig").html("Ingrese dato");
  } else {
    $("#peso_cja_oblig").html("");
  }
}

////////////////
function listar_racimos() {
  funcion = "listar_racimos";
  tabla_racimos = $("#tabla_racimos_").DataTable({
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
      url: "../ADMIN/controlador/desechos_racimos/desechos_racimos.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        render: function () {
          return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el Oftalmólogo'><i class='fa fa-times'></i></button>`;
        },
      },
      { data: "produccion" },
      { data: "fecha_ra" },
      { data: "cantidad" },
      { data: "cajas" },
      { data: "peso" },
      {
        data: "tipo",
        render: function (data, type, row) {
          return "<span class='label label-warning'>" + data + "</span>";
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
  tabla_racimos.on("draw.dt", function () {
    var pageinfo = $("#tabla_racimos_").DataTable().page.info();
    tabla_racimos
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_racimos_").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_racimos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_racimos.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_racimos.row(this).data();
  }
  var dato = 0;
  var id = data.id_detalle_produccion_racimos;

  Swal.fire({
    title: "Eliminar racimos?",
    text: "Se eliminaran los racimos!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_racimos(id, dato);
    }
  });
});

function cambiar_estado_racimos(id, dato) {
  funcion = "cambiar_estado_racimos";
  alerta = ["datos", "Se esta elimnado los racimos", "Eliminado racimos"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/desechos_racimos/desechos_racimos.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "Los racimos se eliminaron con extio"];
        cerrar_loader_datos(alerta);
        tabla_racimos.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo eliminar los racimos"];
      cerrar_loader_datos(alerta);
    }
  });
}

////////////////
function listar_deschos() {
  funcion = "listar_deschos";
  tabla_desechos = $("#tabla_desechos_").DataTable({
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
      url: "../ADMIN/controlador/desechos_racimos/desechos_racimos.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        render: function () {
          return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el Oftalmólogo'><i class='fa fa-times'></i></button>`;
        },
      },
      { data: "produccion" },
      { data: "fecha_re" },
      { data: "cantidad_re" },
      {
        data: "tipo_re",
        render: function (data, type, row) {
          return "<span class='label label-danger'>" + data + "</span>";
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
  tabla_desechos.on("draw.dt", function () {
    var pageinfo = $("#tabla_desechos_").DataTable().page.info();
    tabla_desechos
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_desechos_").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_desechos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_desechos.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_desechos.row(this).data();
  }
  var dato = 0;
  var id = data.id_detalle_produccion_rechasos;

  Swal.fire({
    title: "Eliminar desechos?",
    text: "Se eliminaran los desechos!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_desechos(id, dato);
    }
  });
});

function cambiar_estado_desechos(id, dato) {
  funcion = "cambiar_estado_desechos";
  alerta = ["datos", "Se esta elimnado los desechos", "Eliminado desechos"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/desechos_racimos/desechos_racimos.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "Los desechos se eliminaron con extio"];
        cerrar_loader_datos(alerta);
        tabla_desechos.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo eliminar los desechos"];
      cerrar_loader_datos(alerta);
    }
  });
}
