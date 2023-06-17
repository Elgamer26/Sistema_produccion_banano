var funcion, tabla_tipo;

function listado_tipos_cintas() {
  funcion = "listado_tipos_cintas";
  tabla_tipo = $("#tabla_tipo_cintas").DataTable({
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
      url: "../ADMIN/controlador/tipo_cintas/tipo_cintas.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { data: "id_tipo_cinta" },
      {
        render: function (data, type, row) {
          return `<button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button>`;
        },
      },
      { data: "semana" },
      {
        data: "color",
        render: function (data, type, row) {
          return (
            "<input type='color' class='form-control' value='" +
            data +
            "' disabled>"
          );
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
    order: [[0, "asc"]],
  });
}

$("#tabla_tipo_cintas").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_tipo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_tipo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_tipo.row(this).data();
  }

  $("#id_cinta").val(data.id_tipo_cinta);
  $("#color_cinta").val(data.color);

  $("#modal_color_cinta").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_color_cinta").modal("show");
});

function editar_color() {
  var id = $("#id_cinta").val();
  var color = $("#color_cinta").val();

  funcion = "editar_color";
  alerta = ["datos", "Se esta editando color de cinta", "Color cinta"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/tipo_cintas/tipo_cintas.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      color: color,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "Se edito el color de cinta con exito"];
        cerrar_loader_datos(alerta);

        tabla_tipo.ajax.reload();

        $("#modal_color_cinta").modal("hide");
      }
    } else {
      alerta = ["error", "error", "No se pudo editar el color"];
      cerrar_loader_datos(alerta);
    }
  });
}
