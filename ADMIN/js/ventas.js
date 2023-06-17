var funcion, tabla_venta_racimos, tabla_ventas_desechos;

function listar_clientes() {
  funcion = "listar_clientes";
  $.ajax({
    url: "../ADMIN/controlador/ventas/ventas.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "";
    if (data.length > 0) {
      //bucle para extraer los datos del material
      for (var i = 0; i < data.length; i++) {
        cadena +=
          "<option value='" +
          data[i][0] +
          "'>" +
          data[i][1] +
          " - " +
          data[i][2] +
          " - " +
          data[i][3] +
          " </option>";
      }
      //aqui concadenamos al id del select
      $("#clientes").html(cadena);
    } else {
      cadena += "<option value=''>No hay datos</option>";
      $("#clientes").html(cadena);
    }
  });
}

function listar_racimos() {
  funcion = "listar_racimos";
  $.ajax({
    url: "../ADMIN/controlador/ventas/ventas.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "";
    if (data.length > 0) {
      //bucle para extraer los datos del material
      for (var i = 0; i < data.length; i++) {
        cadena +=
          "<option value='" +
          data[i][0] +
          "'>Nombre produccion: " +
          data[i][7] +
          " - Lote: " +
          data[i][1] +
          " - fecha cajas: [" +
          data[i][2] +
          "] </option>";
      }
      //aqui concadenamos al id del select
      $("#racimos").html(cadena);
      var id = $("#racimos").val();
      traer_datos_racimos(parseInt(id));
    } else {
      cadena += "<option value=''>No hay datos</option>";
      $("#racimos").html(cadena);
    }
  });
}

function traer_datos_racimos(id) {
  funcion = "traer_datos_racimos";
  $.ajax({
    url: "../ADMIN/controlador/ventas/ventas.php",
    type: "POST",
    data: { funcion: funcion, id: id },
  }).done(function (response) {
    var data = JSON.parse(response);
    if (data.length > 0) {
      $("#disponible").val(data[0][2]);
      $("#peso_kg").val(data[0][3]);
      // $("#tipo").val(data[0][1]);
    } else {
      $("#disponible").val("");
      $("#peso_kg").val("");
      // $("#tipo").val("");
    }
  });
}

/////////////////
function ingresar_detalle_racimos() {
  var racimos = $("#racimos").val();
  var racimos_text = $("#racimos option:selected").text();
  var disponible = $("#disponible").val();
  var tipo = $("#tipo").val();
  var cantiddad = $("#cantiddad").val();
  var precio = $("#precio").val();
  var descuento = $("#descuento").val();

  var peso_kg = $("#peso_kg").val();

  var impuesto = $("#impuesto").val();
  var comprobante_tipo = $("#comprobante_tipo").val();

  if (comprobante_tipo == "Factura") {
    if (impuesto.length == 0 || impuesto == "") {
      $("#Impuesto_obliga").html("Ingrese valor");

      return swal.fire("Campo vacios", "Debe ingresar el impuesto", "warning");
    } else {
      $("#Impuesto_obliga").html("");
    }
  } else {
    $("#Impuesto_obliga").html("");
  }

  if (racimos.length == 0) {
    $("#racimos_oblig").html("No hay racimos");

    return swal.fire(
      "Campo vacios",
      "Debe ingresar datos del racimos",
      "warning"
    );
  } else {
    $("#racimos_oblig").html("");
  }

  if (disponible.length == 0) {
    $("#disponible_obliga").html("No disponible");

    return swal.fire("Campo vacios", "No hay reacimos disponibles", "warning");
  } else {
    $("#disponible_obliga").html("");
  }

  if (precio < 0 || precio.length == 0 || precio == "0" || precio == "0.00") {
    $("#precio_obliga").html("Ingrese precio");

    return swal.fire(
      "Campo vacios",
      "Debe ingresar el precio, no debe quedar en 0, ni vacio",
      "warning"
    );
  } else {
    $("#precio_obliga").html("");
  }

  if (descuento < 0 || descuento.length == 0) {
    $("#descuento_obliga").html("Ingrese dato");

    return swal.fire(
      "Campo vacios",
      "Debe ingresar el descuento, o deje en valor 0",
      "warning"
    );
  } else {
    $("#descuento_obliga").html("");
  }

  if (cantiddad <= 0 || cantiddad.length == 0) {
    $("#cantiddad_obliga").html("Ingrese cantidad");

    return swal.fire(
      "Campo vacios",
      "Debe ingresar la cantidad, no deje el valor 0",
      "warning"
    );
  } else {
    $("#cantiddad_obliga").html("");
  }

  if (parseInt(cantiddad) > parseInt(disponible)) {
    $("#disponible_obliga").html("XXX");
    $("#cantiddad_obliga").html("XXX");

    return swal.fire(
      "Campo",
      "La cantidad no debe superar lo disponible",
      "warning"
    );
  } else {
    $("#cantiddad_obliga").html("");
    $("#disponible_obliga").html("");
  }

  if (verificar_venta_racimos(racimos)) {
    return Swal.fire(
      "Mensaje de advertencia",
      "El racimo '" + racimos_text + "', ya fue agregado al detalle",
      "warning"
    );
  }

  var total = 0,
    agg = 0;
  total = cantiddad * parseFloat(precio).toFixed(2);
  agg = total - parseFloat(descuento).toFixed(2);

  //aqui agrego los labores para unir a la tabla
  var datos_agg = "<tr>";
  datos_agg += "<td for='id'>" + racimos + "</td>";
  datos_agg += "<td>" + racimos_text + "</td>";
  datos_agg += "<td>" + tipo + "</td>";
  datos_agg += "<td>" + cantiddad + "</td>";
  datos_agg += "<td>" + peso_kg + "</td>";
  datos_agg += "<td>" + precio + "</td>";
  datos_agg += "<td>" + descuento + "</td>";
  datos_agg += "<td>" + parseFloat(agg).toFixed(2);
  +"</td>";
  datos_agg +=
    "<td><button onclick='remove_compra_racimos(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
  datos_agg += "</tr>";

  //esto me ayuda a enviar los datos a la tabla
  $("#tbody_detalle_venta_racimos").append(datos_agg);

  sumartotalneto();

  $("#precio").val("0");
  $("#descuento").val("0.00");
  $("#cantiddad").val("0");
}

function remove_compra_racimos(t) {
  var td = t.parentNode;
  var tr = td.parentNode;
  var table = tr.parentNode;
  table.removeChild(tr);
  sumartotalneto();
}

function sumartotalneto() {
  let arreglo_total = new Array();
  let count = 0;
  let total = 0;
  let impuestototal = 0;
  let subtotal = 0;
  let impuesto = document.getElementById("impuesto").value;

  let tipo_comprobante = document.getElementById("comprobante_tipo").value;

  $("#detalle_venta_racimos tbody#tbody_detalle_venta_racimos tr").each(
    function () {
      arreglo_total.push($(this).find("td").eq(7).text());
      count++;
    }
  );

  for (var i = 0; i < count; i++) {
    var suma = arreglo_total[i];
    subtotal = (parseFloat(subtotal) + parseFloat(suma)).toFixed(2);
    impuestototal = parseFloat(subtotal * impuesto).toFixed(2);
  }
  total = (parseFloat(subtotal) + parseFloat(impuestototal)).toFixed(2);

  if (tipo_comprobante == "Factura") {
    $("#lbl_totalneto").html("<b>Total neto: </b> $/." + subtotal);
    $("#lbl_impuesto").html(
      "<b>inpuesto: % " + impuesto + " </b> $/." + impuestototal
    );
    $("#lbl_a_pagar").html("<b>Total a pagar: </b> $/." + total);

    $("#txt_totalneto").val(subtotal);
    $("#txt_impuesto").val(impuestototal);
    $("#txt_a_pagar").val(total);
  } else {
    $("#lbl_totalneto").html("<b>Total neto: </b> $/." + subtotal);
    $("#txt_totalneto").val(subtotal);
    $("#txt_impuesto").val("0.00");
    $("#txt_a_pagar").val("0.00");
  }
}

function verificar_venta_racimos(id) {
  let idverificar = document.querySelectorAll(
    "#tbody_detalle_venta_racimos td[for='id']"
  );
  return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
}

////////////
function guardar_venta_racimos() {
  var clientes = $("#clientes").val();
  var numero_compra = $("#numero_compra").val();
  var comprobante_tipo = $("#comprobante_tipo").val();
  var impuesto = $("#impuesto").val();
  var fecha_compra = $("#fecha_compra").val();

  var txt_totalneto = $("#txt_totalneto").val();
  var txt_impuesto = $("#txt_impuesto").val();
  var txt_a_pagar = $("#txt_a_pagar").val();
  var count = 0;

  if (
    clientes.length == 0 ||
    numero_compra.length == 0 ||
    impuesto.length == 0
  ) {
    validar_registro_venta_racimos(clientes, numero_compra, impuesto);
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos",
      "warning"
    );
  } else {
    $("#cliente_oblig").html("");
    $("#numero_obliga").html("");
    $("#Impuesto_obliga").html("");
  }

  $("#detalle_venta_racimos tbody#tbody_detalle_venta_racimos tr").each(
    function () {
      count++;
    }
  );

  if (count == 0) {
    return Swal.fire(
      "Mensaje de advertencia",
      "El detalle de venta debe tener un producto por lo menos,(TABLA RACIMOS)",
      "warning"
    );
  }

  funcion = "registrar_venta";
  alerta = ["datos", "Se esta registrando la venta", "Registrando la venta"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/ventas/ventas.php",
    type: "POST",
    data: {
      funcion: funcion,
      clientes: clientes,
      numero_compra: numero_compra,
      comprobante_tipo: comprobante_tipo,
      impuesto: impuesto,
      fecha_compra: fecha_compra,
      txt_totalneto: txt_totalneto,
      txt_impuesto: txt_impuesto,
      txt_a_pagar: txt_a_pagar,
      count: count,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp != 2) {
        registrar_detalle_venta_recimos(parseInt(resp));
      } else {
        alerta = [
          "existe",
          "warning",
          "El numero de venta " + numero_compra + ", ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = ["error", "error", "No se pudo regitrar la venta"];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_registro_venta_racimos(clientes, numero_compra, impuesto) {
  if (clientes.length == 0) {
    $("#cliente_oblig").html("No hay cliente");
  } else {
    $("#cliente_oblig").html("");
  }

  if (numero_compra.length == 0) {
    $("#numero_obliga").html("Ingrese N° compra");
  } else {
    $("#numero_obliga").html("");
  }

  if (impuesto.length == 0) {
    $("#Impuesto_obliga").html("Ingrese dato");
  } else {
    $("#Impuesto_obliga").html("");
  }
}

function registrar_detalle_venta_recimos(id) {
  var count = 0;
  var arrego_idracimos = new Array();
  var arrego_tipo = new Array();
  var arreglo_cantidad = new Array();
  var arreglo_precio = new Array();
  var arreglo_descuento_moneda = new Array();
  var arreglo_subtotal = new Array();

  var arreglo_peso = new Array();

  $("#detalle_venta_racimos tbody#tbody_detalle_venta_racimos tr").each(
    function () {
      arrego_idracimos.push($(this).find("td").eq(0).text());
      arrego_tipo.push($(this).find("td").eq(2).text());
      arreglo_cantidad.push($(this).find("td").eq(3).text());
      arreglo_peso.push($(this).find("td").eq(4).text());
      arreglo_precio.push($(this).find("td").eq(5).text());
      arreglo_descuento_moneda.push($(this).find("td").eq(6).text());
      arreglo_subtotal.push($(this).find("td").eq(7).text());
      count++;
    }
  );

  //aqui combierto el arreglo a un string
  var idpr = arrego_idracimos.toString();
  var tipo = arrego_tipo.toString();
  var cantidad = arreglo_cantidad.toString();
  var precio = arreglo_precio.toString();
  var des = arreglo_descuento_moneda.toString();
  var sutotal = arreglo_subtotal.toString();
  var peso = arreglo_peso.toString();

  if (count == 0) {
    return;
  }

  funcion = "registrar_detalle_venta_racimos";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../ADMIN/controlador/ventas/ventas.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      idpr: idpr,
      tipo: tipo,
      cantidad: cantidad,
      precio: precio,
      des: des,
      sutotal: sutotal,
      peso: peso,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "La venta se realizo con exito"];
        cerrar_loader_datos(alerta);
        Swal.fire({
          title: "IMPRIMIR VENTA RACIMOS",
          text: "Desea imprimir el reporte de venta??",
          icon: "warning",
          showCancelButton: true,
          showConfirmButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, Imprimir!!",
        }).then((result) => {
          if (result.value) {
            window.open(
              "../ADMIN/REPORTES/Pdf/factura_venta_racimos.php?id=" +
                parseInt(id) +
                "#zoom=100%",
              "Reporte de venta",
              "scrollbards=No"
            );
            envio_correo_venta_racimos(parseInt(id));
            cargar_contenido(
              "contenido_principal",
              "vista/ventas/ventas_racimos.php"
            );
          } else {
            envio_correo_venta_racimos(parseInt(id));
            cargar_contenido(
              "contenido_principal",
              "vista/ventas/ventas_racimos.php"
            );
          }
        });
      }
    } else {
      alerta = ["error", "error", "No se pudo regitrar el detalle venta"];
      cerrar_loader_datos(alerta);
    }
  });
}

function envio_correo_venta_racimos(id) {
  if (id.length == 0 || id == "" || id == null) {
    return false;
  }

  $.ajax({
    url: "../ADMIN/modelo/envio_correo/envio_venta_racimos.php",
    type: "POST",
    data: {
      id: id,
    },
  }).done(function (response) {
    console.log(response);
  });
}

////////////////
function listar_ventas_racimos() {
  funcion = "listar_ventas_racimos";
  tabla_venta_racimos = $("#tabla_ventas_racimos").DataTable({
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
      url: "../ADMIN/controlador/ventas/ventas.php",
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
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el Oftalmólogo'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='ver btn btn-warning' title='ver detalle'><i class='fa fa-eye'></i></button> - <button style='font-size:13px;' type='button' class='pfd btn btn-primary' title='ver reporte'><i class='fa fa-file'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='ver btn btn-warning' title='ver detalle'><i class='fa fa-eye'></i></button> - <button style='font-size:13px;' type='button' class='pfd btn btn-primary' title='ver reporte'><i class='fa fa-file'></i></button>`;
          }
        },
      },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return "<span class='label label-success'>VENDIDO</span>";
          } else {
            return "<span class='label label-danger'>ANULADO</span>";
          }
        },
      },
      { data: "cliente" },
      { data: "num_venta" },
      { data: "tipo_comprobante" },
      { data: "impuesto" },
      { data: "fecha_venta" },
      { data: "sub_total" },
      { data: "sub_iva" },
      { data: "total" },
      { data: "countt" },
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
  tabla_venta_racimos.on("draw.dt", function () {
    var pageinfo = $("#tabla_ventas_racimos").DataTable().page.info();
    tabla_venta_racimos
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_ventas_racimos").on("click", ".pfd", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_venta_racimos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_venta_racimos.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_venta_racimos.row(this).data();
  }

  var id = data.id_venta_racimos;

  Swal.fire({
    title: "IMPRIMIR VENTA RACIMOS",
    text: "Desea imprimir el reporte de venta??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Imprimir!!",
  }).then((result) => {
    if (result.value) {
      window.open(
        "../ADMIN/REPORTES/Pdf/factura_venta_racimos.php?id=" +
          parseInt(id) +
          "#zoom=100%",
        "Reporte de venta",
        "scrollbards=No"
      );
    }
  });
});

$("#tabla_ventas_racimos").on("click", ".ver", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_venta_racimos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_venta_racimos.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_venta_racimos.row(this).data();
  }

  var id = data.id_venta_racimos;
  var iva = data.impuesto;

  alerta = [
    "datos",
    "Se esta cargando el detalle venta",
    ".:Cargando la venta:.",
  ];
  mostar_loader_datos(alerta);
  cargar_detalle_venta(parseInt(id), iva);
});

function cargar_detalle_venta(id, iva) {
  funcion = "detalle_de_venta_racimos";
  $.ajax({
    url: "../ADMIN/controlador/ventas/ventas.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    alerta = ["", "", ""];
    cerrar_loader_datos(alerta);

    let arreglo_total = new Array();
    let total = 0;
    let impuestototal = 0;
    let subtotal = 0;
    let impuesto = iva;
    let count = 0;

    var data = JSON.parse(resp);
    var llenat = "";
    data["data"].forEach((row) => {
      count++;
      llenat += `     <tr>
                            <td for='id'>${count}</td>
                            <td>${row["nombre_prod"]} - ${row["nombre_l"]} - [${row["fecha_ra"]}]</td>
                            <td>${row["tipo"]}</td>
                            <td>${row["cantidad"]}</td>
                            <td>${row["precio"]}</td>
                            <td>${row["descuento"]}</td>                              
                            <td>${row["subtotal"]}</td>   
                            </tr>`;

      arreglo_total = row["subtotal"];

      subtotal = (parseFloat(subtotal) + parseFloat(arreglo_total)).toFixed(2);
      impuestototal = parseFloat(subtotal * impuesto).toFixed(2);
      total = (parseFloat(subtotal) + parseFloat(impuestototal)).toFixed(2);

      $("#lbl_totalneto").html("<b>Total neto: </b> $/." + subtotal);
      $("#lbl_impuesto").html(
        "<b>inpuesto: % " + impuesto + " </b> $/." + impuestototal
      );
      $("#lbl_a_pagar").html("<b>Total a pagar: </b> $/." + total);

      $("#tbody_detalle_venta_racimos").html(llenat);
    });
    $("#modal_detalle_venta_rasimos").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modal_detalle_venta_rasimos").modal("show");
  });
}

$("#tabla_ventas_racimos").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_venta_racimos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_venta_racimos.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_venta_racimos.row(this).data();
  }

  var id = data.id_venta_racimos;

  Swal.fire({
    title: "Anular venta",
    text: "Desea anular la venta??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, anular!!",
  }).then((result) => {
    if (result.value) {
      anular_venta_racimos(parseInt(id));
    }
  });
});

function anular_venta_racimos(id) {
  alerta = ["datos", "Se esta anulando la venta", ".:Anulando venta:."];
  mostar_loader_datos(alerta);

  funcion = "anular_venta_racimos";
  $.ajax({
    url: "../ADMIN/controlador/ventas/ventas.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "Se anulo la venta con exito"];
        cerrar_loader_datos(alerta);
        tabla_venta_racimos.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo anular la venta"];
      cerrar_loader_datos(alerta);
    }
  });
}

///////////////////////
/////////////////////VENTAS DESECHOS
///////////////////////////
function listar_desechos() {
  funcion = "listar_desechos";
  $.ajax({
    url: "../ADMIN/controlador/ventas/ventas.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "";
    if (data.length > 0) {
      //bucle para extraer los datos del material
      for (var i = 0; i < data.length; i++) {
        cadena +=
          "<option value='" +
          data[i][0] +
          "'>Nombre produccion: " +
          data[i][5] +
          " - Lote: " +
          data[i][1] +
          " - fecha descho: [" +
          data[i][2] +
          "] </option>";
      }
      //aqui concadenamos al id del select
      $("#desechos").html(cadena);
      var id = $("#desechos").val();
      traer_datos_desechos(parseInt(id));
    } else {
      cadena += "<option value=''>No hay datos</option>";
      $("#desechos").html(cadena);
    }
  });
}

function traer_datos_desechos(id) {
  funcion = "traer_datos_desechos";
  $.ajax({
    url: "../ADMIN/controlador/ventas/ventas.php",
    type: "POST",
    data: { funcion: funcion, id: id },
  }).done(function (response) {
    var data = JSON.parse(response);
    if (data.length > 0) {
      $("#disponible").val(data[0][0]);
      $("#tipo").val(data[0][1]);
    } else {
      $("#disponible").val("");
      $("#tipo").val("");
    }
  });
}

/////////////////
function ingresar_detalle_desechos() {
  var desechos = $("#desechos").val();
  var desechos_text = $("#desechos option:selected").text();
  var disponible = $("#disponible").val();
  var tipo = $("#tipo").val();
  var cantiddad = $("#cantiddad").val();
  var precio = $("#precio").val();
  var descuento = $("#descuento").val();

  var impuesto = $("#impuesto").val();
  var comprobante_tipo = $("#comprobante_tipo").val();

  if (comprobante_tipo == "Factura") {
    if (impuesto.length == 0 || impuesto == "") {
      $("#Impuesto_obliga").html("Ingrese valor");

      return swal.fire("Campo vacios", "Debe ingresar el impuesto", "warning");
    } else {
      $("#Impuesto_obliga").html("");
    }
  } else {
    $("#Impuesto_obliga").html("");
  }

  if (desechos.length == 0) {
    $("#desechos_oblig").html("No hay desechos");

    return swal.fire(
      "Campo vacios",
      "Debe ingresar datos del desechos",
      "warning"
    );
  } else {
    $("#desechos_oblig").html("");
  }

  if (disponible.length == 0) {
    $("#disponible_obliga").html("No disponible");

    return swal.fire("Campo vacios", "No hay reacimos disponibles", "warning");
  } else {
    $("#disponible_obliga").html("");
  }

  if (precio < 0 || precio.length == 0 || precio == "0" || precio == "0.00") {
    $("#precio_obliga").html("Ingrese precio");

    return swal.fire(
      "Campo vacios",
      "Debe ingresar el precio, no debe quedar en 0, ni vacio",
      "warning"
    );
  } else {
    $("#precio_obliga").html("");
  }

  if (descuento < 0 || descuento.length == 0) {
    $("#descuento_obliga").html("Ingrese dato");

    return swal.fire(
      "Campo vacios",
      "Debe ingresar el descuento, o deje en valor 0",
      "warning"
    );
  } else {
    $("#descuento_obliga").html("");
  }

  if (cantiddad <= 0 || cantiddad.length == 0) {
    $("#cantiddad_obliga").html("Ingrese cantidad");

    return swal.fire(
      "Campo vacios",
      "Debe ingresar la cantidad, no deje el valor 0",
      "warning"
    );
  } else {
    $("#cantiddad_obliga").html("");
  }

  if (parseInt(cantiddad) > parseInt(disponible)) {
    $("#disponible_obliga").html("XXX");
    $("#cantiddad_obliga").html("XXX");

    return swal.fire(
      "Campo",
      "La cantidad no debe superar lo disponible",
      "warning"
    );
  } else {
    $("#cantiddad_obliga").html("");
    $("#disponible_obliga").html("");
  }

  if (verificar_venta_deschos(desechos)) {
    return Swal.fire(
      "Mensaje de advertencia",
      "El desecho '" + desechos_text + "', ya fue agregado al detalle",
      "warning"
    );
  }

  var total = 0,
    agg = 0;
  total = cantiddad * parseFloat(precio).toFixed(2);
  agg = total - parseFloat(descuento).toFixed(2);

  //aqui agrego los labores para unir a la tabla
  var datos_agg = "<tr>";
  datos_agg += "<td for='id'>" + desechos + "</td>";
  datos_agg += "<td>" + desechos_text + "</td>";
  datos_agg += "<td>" + tipo + "</td>";
  datos_agg += "<td>" + cantiddad + "</td>";
  datos_agg += "<td>" + precio + "</td>";
  datos_agg += "<td>" + descuento + "</td>";
  datos_agg += "<td>" + parseFloat(agg).toFixed(2);
  +"</td>";
  datos_agg +=
    "<td><button onclick='remove_compra_deschos(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
  datos_agg += "</tr>";

  //esto me ayuda a enviar los datos a la tabla
  $("#tbody_detalle_venta_desechos").append(datos_agg);

  sumarto_desechos();

  $("#precio").val("0");
  $("#descuento").val("0.00");
  $("#cantiddad").val("0");
}

function remove_compra_deschos(t) {
  var td = t.parentNode;
  var tr = td.parentNode;
  var table = tr.parentNode;
  table.removeChild(tr);
  sumarto_desechos();
}

function sumarto_desechos() {
  let arreglo_total = new Array();
  let count = 0;
  let total = 0;
  let impuestototal = 0;
  let subtotal = 0;
  let impuesto = document.getElementById("impuesto").value;

  let tipo_comprobante = document.getElementById("comprobante_tipo").value;

  $("#detalle_venta_desechos tbody#tbody_detalle_venta_desechos tr").each(
    function () {
      arreglo_total.push($(this).find("td").eq(6).text());
      count++;
    }
  );

  for (var i = 0; i < count; i++) {
    var suma = arreglo_total[i];
    subtotal = (parseFloat(subtotal) + parseFloat(suma)).toFixed(2);
    impuestototal = parseFloat(subtotal * impuesto).toFixed(2);
  }

  total = (parseFloat(subtotal) + parseFloat(impuestototal)).toFixed(2);

  if (tipo_comprobante == "Factura") {
    $("#lbl_totalneto").html("<b>Total neto: </b> $/." + subtotal);
    $("#lbl_impuesto").html(
      "<b>inpuesto: % " + impuesto + " </b> $/." + impuestototal
    );
    $("#lbl_a_pagar").html("<b>Total a pagar: </b> $/." + total);

    $("#txt_totalneto").val(subtotal);
    $("#txt_impuesto").val(impuestototal);
    $("#txt_a_pagar").val(total);
  } else {
    $("#lbl_totalneto").html("<b>Total neto: </b> $/." + subtotal);
    $("#txt_totalneto").val(subtotal);
    $("#txt_impuesto").val("0.00");
    $("#txt_a_pagar").val("0.00");
  }
}

function verificar_venta_deschos(id) {
  let idverificar = document.querySelectorAll(
    "#tbody_detalle_venta_desechos td[for='id']"
  );
  return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
}

////////////
function guardar_venta_desechos() {
  var clientes = $("#clientes").val();
  var numero_compra = $("#numero_compra").val();
  var comprobante_tipo = $("#comprobante_tipo").val();
  var impuesto = $("#impuesto").val();
  var fecha_compra = $("#fecha_compra").val();

  var txt_totalneto = $("#txt_totalneto").val();
  var txt_impuesto = $("#txt_impuesto").val();
  var txt_a_pagar = $("#txt_a_pagar").val();
  var count = 0;

  if (
    clientes.length == 0 ||
    numero_compra.length == 0 ||
    impuesto.length == 0
  ) {
    validar_registro_venta_desehos(clientes, numero_compra, impuesto);
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos",
      "warning"
    );
  } else {
    $("#cliente_oblig").html("");
    $("#numero_obliga").html("");
    $("#Impuesto_obliga").html("");
  }

  $("#detalle_venta_desechos tbody#tbody_detalle_venta_desechos tr").each(
    function () {
      count++;
    }
  );

  if (count == 0) {
    return Swal.fire(
      "Mensaje de advertencia",
      "El detalle de venta debe tener un producto por lo menos,(TABLA DESECHOS)",
      "warning"
    );
  }

  funcion = "registrar_venta_desechos";
  alerta = ["datos", "Se esta registrando la venta", "Registrando la venta"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/ventas/ventas.php",
    type: "POST",
    data: {
      funcion: funcion,
      clientes: clientes,
      numero_compra: numero_compra,
      comprobante_tipo: comprobante_tipo,
      impuesto: impuesto,
      fecha_compra: fecha_compra,
      txt_totalneto: txt_totalneto,
      txt_impuesto: txt_impuesto,
      txt_a_pagar: txt_a_pagar,
      count: count,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp != 2) {
        registrar_detalle_venta_deechos(parseInt(resp));
      } else {
        alerta = [
          "existe",
          "warning",
          "El numero de venta " + numero_compra + ", ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = ["error", "error", "No se pudo regitrar la venta"];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_registro_venta_desehos(clientes, numero_compra, impuesto) {
  if (clientes.length == 0) {
    $("#cliente_oblig").html("No hay cliente");
  } else {
    $("#cliente_oblig").html("");
  }

  if (numero_compra.length == 0) {
    $("#numero_obliga").html("Ingrese N° compra");
  } else {
    $("#numero_obliga").html("");
  }

  if (impuesto.length == 0) {
    $("#Impuesto_obliga").html("Ingrese dato");
  } else {
    $("#Impuesto_obliga").html("");
  }
}

function registrar_detalle_venta_deechos(id) {
  var count = 0;
  var arrego_iddesehos = new Array();
  var arrego_tipo = new Array();
  var arreglo_cantidad = new Array();
  var arreglo_precio = new Array();
  var arreglo_descuento_moneda = new Array();
  var arreglo_subtotal = new Array();

  $("#detalle_venta_desechos tbody#tbody_detalle_venta_desechos tr").each(
    function () {
      arrego_iddesehos.push($(this).find("td").eq(0).text());
      arrego_tipo.push($(this).find("td").eq(2).text());
      arreglo_cantidad.push($(this).find("td").eq(3).text());
      arreglo_precio.push($(this).find("td").eq(4).text());
      arreglo_descuento_moneda.push($(this).find("td").eq(5).text());
      arreglo_subtotal.push($(this).find("td").eq(6).text());
      count++;
    }
  );

  //aqui combierto el arreglo a un string
  var idde = arrego_iddesehos.toString();
  var tipo = arrego_tipo.toString();
  var cantidad = arreglo_cantidad.toString();
  var precio = arreglo_precio.toString();
  var des = arreglo_descuento_moneda.toString();
  var sutotal = arreglo_subtotal.toString();

  if (count == 0) {
    return;
  }

  funcion = "registrar_detalle_venta_desechos";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../ADMIN/controlador/ventas/ventas.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      idde: idde,
      tipo: tipo,
      cantidad: cantidad,
      precio: precio,
      des: des,
      sutotal: sutotal,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "La venta se realizo con exito"];
        cerrar_loader_datos(alerta);
        Swal.fire({
          title: "IMPRIMIR VENTA DESECHOS",
          text: "Desea imprimir el reporte de venta??",
          icon: "warning",
          showCancelButton: true,
          showConfirmButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, Imprimir!!",
        }).then((result) => {
          if (result.value) {
            window.open(
              "../ADMIN/REPORTES/Pdf/factura_venta_deschoss.php?id=" +
                parseInt(id) +
                "#zoom=100%",
              "Reporte de venta",
              "scrollbards=No"
            );
            envio_correo_venta_desechos(parseInt(id));
            cargar_contenido(
              "contenido_principal",
              "vista/ventas/ventas_desechos.php"
            );
          } else {
            envio_correo_venta_desechos(parseInt(id));
            cargar_contenido(
              "contenido_principal",
              "vista/ventas/ventas_desechos.php"
            );
          }
        });
      }
    } else {
      alerta = ["error", "error", "No se pudo regitrar el detalle venta"];
      cerrar_loader_datos(alerta);
    }
  });
}

function envio_correo_venta_desechos(id) {
  if (id.length == 0 || id == "" || id == null) {
    return false;
  }

  $.ajax({
    url: "../ADMIN/modelo/envio_correo/envio_venta_desechos.php",
    type: "POST",
    data: {
      id: id,
    },
  }).done(function (response) {
    console.log(response);
  });
}

////////////////
function listar_ventas_desechos() {
  funcion = "listar_ventas_desechos";
  tabla_ventas_desechos = $("#tabla_ventas_desechos").DataTable({
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
      url: "../ADMIN/controlador/ventas/ventas.php",
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
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el Oftalmólogo'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='ver btn btn-warning' title='ver detalle'><i class='fa fa-eye'></i></button> - <button style='font-size:13px;' type='button' class='pfd btn btn-primary' title='ver reporte'><i class='fa fa-file'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='ver btn btn-warning' title='ver detalle'><i class='fa fa-eye'></i></button> - <button style='font-size:13px;' type='button' class='pfd btn btn-primary' title='ver reporte'><i class='fa fa-file'></i></button>`;
          }
        },
      },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return "<span class='label label-success'>VENDIDO</span>";
          } else {
            return "<span class='label label-danger'>ANULADO</span>";
          }
        },
      },
      { data: "cliente" },
      { data: "num_venta" },
      { data: "tipo_comprobante" },
      { data: "impuesto" },
      { data: "fecha_venta" },
      { data: "sub_total" },
      { data: "sub_iva" },
      { data: "total" },
      { data: "countt" },
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
  tabla_ventas_desechos.on("draw.dt", function () {
    var pageinfo = $("#tabla_ventas_desechos").DataTable().page.info();
    tabla_ventas_desechos
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_ventas_desechos").on("click", ".pfd", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_ventas_desechos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_ventas_desechos.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_ventas_desechos.row(this).data();
  }

  var id = data.id_venta_desechos;

  Swal.fire({
    title: "IMPRIMIR VENTA DESECHOS",
    text: "Desea imprimir el reporte de venta??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Imprimir!!",
  }).then((result) => {
    if (result.value) {
      window.open(
        "../ADMIN/REPORTES/Pdf/factura_venta_deschoss.php?id=" +
          parseInt(id) +
          "#zoom=100%",
        "Reporte de venta",
        "scrollbards=No"
      );
    }
  });
});

$("#tabla_ventas_desechos").on("click", ".ver", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_ventas_desechos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_ventas_desechos.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_ventas_desechos.row(this).data();
  }

  var id = data.id_venta_desechos;
  var iva = data.impuesto;

  alerta = [
    "datos",
    "Se esta cargando el detalle venta",
    ".:Cargando la venta:.",
  ];
  mostar_loader_datos(alerta);
  cargar_detalle_venta_deschos(parseInt(id), iva);
});

function cargar_detalle_venta_deschos(id, iva) {
  funcion = "cargar_detalle_venta_deschos";
  $.ajax({
    url: "../ADMIN/controlador/ventas/ventas.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    alerta = ["", "", ""];
    cerrar_loader_datos(alerta);

    let arreglo_total = new Array();
    let total = 0;
    let impuestototal = 0;
    let subtotal = 0;
    let impuesto = iva;
    let count = 0;

    var data = JSON.parse(resp);
    var llenat = "";
    data["data"].forEach((row) => {
      count++;
      llenat += `     <tr>
                            <td for='id'>${count}</td>
                            <td>${row["nombre_prod"]} - ${row["nombre_l"]} - [${row["fecha_re"]}]</td>
                            <td>${row["tipo"]}</td>
                            <td>${row["cantidad"]}</td>
                            <td>${row["precio"]}</td>
                            <td>${row["descuento"]}</td>                              
                            <td>${row["subtotal"]}</td>   
                            </tr>`;

      arreglo_total = row["subtotal"];

      subtotal = (parseFloat(subtotal) + parseFloat(arreglo_total)).toFixed(2);
      impuestototal = parseFloat(subtotal * impuesto).toFixed(2);
      total = (parseFloat(subtotal) + parseFloat(impuestototal)).toFixed(2);

      $("#lbl_totalneto").html("<b>Total neto: </b> $/." + subtotal);
      $("#lbl_impuesto").html(
        "<b>inpuesto: % " + impuesto + " </b> $/." + impuestototal
      );
      $("#lbl_a_pagar").html("<b>Total a pagar: </b> $/." + total);

      $("#tbody_detalle_venta_desechos").html(llenat);
    });
    $("#modal_detalle_venta_rasimos").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modal_detalle_venta_rasimos").modal("show");
  });
}

$("#tabla_ventas_desechos").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_ventas_desechos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_ventas_desechos.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_ventas_desechos.row(this).data();
  }

  var id = data.id_venta_desechos;

  Swal.fire({
    title: "Anular venta",
    text: "Desea anular la venta??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, anular!!",
  }).then((result) => {
    if (result.value) {
      anular_venta_desechos(parseInt(id));
    }
  });
});

function anular_venta_desechos(id) {
  alerta = ["datos", "Se esta anulando la venta", ".:Anulando venta:."];
  mostar_loader_datos(alerta);

  funcion = "anular_venta_desechos";
  $.ajax({
    url: "../ADMIN/controlador/ventas/ventas.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    console.log(resp);
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "Se anulo la venta con exito"];
        cerrar_loader_datos(alerta);
        tabla_ventas_desechos.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo anular la venta"];
      cerrar_loader_datos(alerta);
    }
  });
}
