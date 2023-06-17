var funcion, tabla_compra, tabla_insumos, tabla_material_envio;

function listar_proveedor() {
  funcion = "listar_proveedor";
  $.ajax({
    url: "../ADMIN/controlador/compra/compra.php",
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
          "'>Razon social: " +
          data[i][1] +
          " - Ruc: " +
          data[i][2] +
          " </option>";
      }
      //aqui concadenamos al id del select
      $("#proveedor").html(cadena);
    } else {
      cadena += "<option value=''>No hay datos</option>";
      $("#proveedor").html(cadena);
    }
  });
}

function ingresar_detalle() {
  var codigo = $("#codigi_material").val();
  var id_ma = $("#id_marca").val();
  var nombre = $("#nombre_ma").val();
  var tipo = $("#tipo_m").val();
  var stokc = $("#stock_m").val();
  var precio = $("#precio_compra").val();
  var descuento = $("#descuento").val();
  var cantiddad = $("#cantiddad").val();

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

  if (id_ma.length == 0 || nombre.length == 0 || codigo.length == 0) {
    $("#codigo_mate_obliga").html("Ingrese dato");
    $("#nombre_ma_obliga").html("Ingrese dato");

    return swal.fire(
      "Campo vacios",
      "Debe ingresar todo del material",
      "warning"
    );
  } else {
    $("#codigo_mate_obliga").html("");
    $("#nombre_ma_obliga").html("");
  }

  if (precio < 0 || precio.length == 0) {
    $("#precio_compra_obliga").html("Ingrese dato");

    return swal.fire(
      "Campo vacios",
      "Debe ingresar el precio, no debe quedar en 0, ni vacio",
      "warning"
    );
  } else {
    $("#precio_compra_obliga").html("");
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

  if (verificar_compra_mterial_id(id_ma)) {
    return Swal.fire(
      "Mensaje de advertencia",
      "El material '" +
        nombre +
        " - " +
        tipo +
        "' , ya fue agregado al detalle",
      "warning"
    );
  }

  var total = 0,
    agg = 0;
  total = cantiddad * parseFloat(precio).toFixed(2);
  agg = total - parseFloat(descuento).toFixed(2);

  //aqui agrego los labores para unir a la tabla
  var datos_agg = "<tr>";
  datos_agg += "<td for='id'>" + id_ma + "</td>";
  datos_agg += "<td>" + nombre + " - " + tipo + "</td>";
  datos_agg += "<td>" + cantiddad + "</td>";
  datos_agg += "<td>" + precio + "</td>";
  datos_agg += "<td>" + descuento + "</td>";
  datos_agg += "<td>" + parseFloat(agg).toFixed(2);
  +"</td>";
  datos_agg +=
    "<td><button onclick='remove_compra_material(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
  datos_agg += "</tr>";

  //esto me ayuda a enviar los datos a la tabla
  $("#tbody_detalle_compr_material").append(datos_agg);

  sumartotalneto();

  $("#codigi_material").val("");
  $("#id_marca").val("");
  $("#nombre_ma").val("");
  $("#tipo_m").val("");
  $("#stock_m").val("");
  $("#precio_compra").val("");
  $("#descuento").val("0.00");
  $("#cantiddad").val("0");
}

function remove_compra_material(t) {
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

  $("#detalle_compra_material tbody#tbody_detalle_compr_material tr").each(
    function () {
      arreglo_total.push($(this).find("td").eq(5).text());
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

function verificar_compra_mterial_id(id) {
  let idverificar = document.querySelectorAll(
    "#tbody_detalle_compr_material td[for='id']"
  );
  return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
}

function gardar_compra_material() {
  var proveedor = $("#proveedor").val();
  var numero_compra = $("#numero_compra").val();
  var comprobante_tipo = $("#comprobante_tipo").val();
  var impuesto = $("#impuesto").val();
  var fecha_compra = $("#fecha_compra").val();

  var txt_totalneto = $("#txt_totalneto").val();
  var txt_impuesto = $("#txt_impuesto").val();
  var txt_a_pagar = $("#txt_a_pagar").val();
  var count = 0;

  if (
    proveedor.length == 0 ||
    numero_compra.length == 0 ||
    impuesto.length == 0
  ) {
    validar_registro_compra(proveedor, numero_compra, impuesto);
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos",
      "warning"
    );
  } else {
    $("#razon_oblig").html("");
    $("#numero_obliga").html("");
    $("#Impuesto_obliga").html("");
  }

  $("#detalle_compra_material tbody#tbody_detalle_compr_material tr").each(
    function () {
      count++;
    }
  );

  if (count == 0) {
    return Swal.fire(
      "Mensaje de advertencia",
      "El detalle de compra debe tener un producto por lo menos,(TABLA MATERIAL)",
      "warning"
    );
  }

  funcion = "registrar_compra";
  alerta = ["datos", "Se esta registrando la compra", "Registrando la compra"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/compra/compra.php",
    type: "POST",
    data: {
      funcion: funcion,
      proveedor: proveedor,
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
        registrar_detalle_compra_materia(parseInt(resp));
      } else {
        alerta = [
          "existe",
          "warning",
          "El numero de compra " + numero_compra + ", ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = ["error", "error", "No se pudo regitrar la compra"];
      cerrar_loader_datos(alerta);
    }
  });
}

function registrar_detalle_compra_materia(id) {
  var count = 0;
  var arrego_idmateral = new Array();
  var arreglo_cantidad = new Array();
  var arreglo_precio = new Array();
  var arreglo_descuento_moneda = new Array();
  var arreglo_subtotal = new Array();

  $("#detalle_compra_material tbody#tbody_detalle_compr_material tr").each(
    function () {
      arrego_idmateral.push($(this).find("td").eq(0).text());
      arreglo_cantidad.push($(this).find("td").eq(2).text());
      arreglo_precio.push($(this).find("td").eq(3).text());
      arreglo_descuento_moneda.push($(this).find("td").eq(4).text());
      arreglo_subtotal.push($(this).find("td").eq(5).text());
      count++;
    }
  );

  //aqui combierto el arreglo a un string
  var idpm = arrego_idmateral.toString();
  var cantidad = arreglo_cantidad.toString();
  var precio = arreglo_precio.toString();
  var des = arreglo_descuento_moneda.toString();
  var sutotal = arreglo_subtotal.toString();

  if (count == 0) {
    return;
  }

  funcion = "registrar_detalle_ompra";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../ADMIN/controlador/compra/compra.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      idpm: idpm,
      cantidad: cantidad,
      precio: precio,
      des: des,
      sutotal: sutotal,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "La compra se realizo con exito"];
        cerrar_loader_datos(alerta);

        Swal.fire({
          title: "IMPRIMIR COMPRA MATERIAL",
          text: "Desea imprimir el reporte de compra??",
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
              "../ADMIN/REPORTES/Pdf/factura_compra_material.php?id=" +
                parseInt(id) +
                "#zoom=100%",
              "Reporte de compra",
              "scrollbards=No"
            );

            cargar_contenido(
              "contenido_principal",
              "vista/compra/nueva_compra.php"
            );
          }
        });

        cargar_contenido(
          "contenido_principal",
          "vista/compra/nueva_compra.php"
        );
      }
    } else {
      alerta = ["error", "error", "No se pudo regitrar el detalle compra"];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_registro_compra(proveedor, numero_compra, impuesto) {
  if (proveedor.length == 0) {
    $("#razon_oblig").html("NO hay proveedor");
  } else {
    $("#razon_oblig").html("");
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

////////////////
function listar_compras_material() {
  funcion = "listar_compras_material";
  tabla_compra = $("#tabla_compras_material_").DataTable({
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
      url: "../ADMIN/controlador/compra/compra.php",
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
            return "<span class='label label-success'>COMPRADO</span>";
          } else {
            return "<span class='label label-danger'>ANULADO</span>";
          }
        },
      },
      { data: "razon" },
      { data: "numero_compra" },
      { data: "tipo_comprobante" },

      {
        data: "impuesto",
        render: function (data, type, row) {
          if (data == "0.00") {
            return "0%";
          } else {
            return "12%";
          }
        },
      },

      { data: "fecha" },
      { data: "sub_total" },
      { data: "sub_iva" },
      { data: "gran_total" },
      { data: "cantidad" },
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
    // order: [[0, "desc"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  tabla_compra.on("draw.dt", function () {
    var pageinfo = $("#tabla_compras_material_").DataTable().page.info();
    tabla_compra
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_compras_material_").on("click", ".ver", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_compra.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_compra.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_compra.row(this).data();
  }

  var id = data.id_compra_material;
  var iva = data.impuesto;

  alerta = [
    "datos",
    "Se esta cargando el detalle compra",
    ".:Cargando la compra:.",
  ];
  mostar_loader_datos(alerta);
  cargar_detalle_compra(parseInt(id), iva);
});

function cargar_detalle_compra(id, iva) {
  funcion = "detalle_de_compra";
  $.ajax({
    url: "../ADMIN/controlador/compra/compra.php",
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
                            <td>${row["nombre"]} - ${row["tipo_material"]}</td>
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

      $("#tbody_detalle_compr_material").html(llenat);
    });

    $("#modal_detalle_comppra").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modal_detalle_comppra").modal("show");
  });
}

$("#tabla_compras_material_").on("click", ".pfd", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_compra.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_compra.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_compra.row(this).data();
  }

  var id = data.id_compra_material;

  Swal.fire({
    title: "IMPRIMIR COMPRA MATERIAL",
    text: "Desea imprimir el reporte de compra??",
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
        "../ADMIN/REPORTES/Pdf/factura_compra_material.php?id=" +
          parseInt(id) +
          "#zoom=100%",
        "Reporte de compra",
        "scrollbards=No"
      );
    }
  });
});

$("#tabla_compras_material_").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_compra.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_compra.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_compra.row(this).data();
  }

  var id = data.id_compra_material;

  Swal.fire({
    title: "Anular compra",
    text: "Desea anular la compra??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, anular!!",
  }).then((result) => {
    if (result.value) {
      anular_compra_material(parseInt(id));
    }
  });
});

function anular_compra_material(id) {
  alerta = ["datos", "Se esta anulando la compra", ".:Anulando compra:."];
  mostar_loader_datos(alerta);

  funcion = "anular_copra_material";
  $.ajax({
    url: "../ADMIN/controlador/compra/compra.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "Se anulo la compra con exito"];
        cerrar_loader_datos(alerta);
        tabla_compra.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo anular la compra"];
      cerrar_loader_datos(alerta);
    }
  });
}

///////////////////////////
////////////////////////////
function listar_proveedor_insumos() {
  funcion = "listar_proveedor";
  $.ajax({
    url: "../ADMIN/controlador/compra/compra.php",
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
          "'>Razon social: " +
          data[i][1] +
          " - Ruc: " +
          data[i][2] +
          " </option>";
      }
      //aqui concadenamos al id del select
      $("#proveedor").html(cadena);
    } else {
      cadena += "<option value=''>No hay datos</option>";
      $("#proveedor").html(cadena);
    }
  });
}

function ingresar_detalle_insumo() {
  var codigo = $("#codigi_insumoo").val();
  var id_ma = $("#id_insumo").val();
  var nombre = $("#nombre_ma").val();
  var tipo = $("#tipo_m").val();
  var medida_i = $("#medida_i").val();
  var stokc = $("#stock_m").val();
  var precio = $("#precio_compra").val();
  var descuento = $("#descuento").val();
  var cantiddad = $("#cantiddad").val();

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

  if (id_ma.length == 0 || nombre.length == 0 || codigo.length == 0) {
    $("#codigo_mate_obliga").html("Ingrese dato");
    $("#nombre_ma_obliga").html("Ingrese dato");

    return swal.fire(
      "Campo vacios",
      "Debe ingresar todo del material",
      "warning"
    );
  } else {
    $("#codigo_mate_obliga").html("");
    $("#nombre_ma_obliga").html("");
  }

  if (precio < 0 || precio.length == 0) {
    $("#precio_compra_obliga").html("Ingrese dato");

    return swal.fire(
      "Campo vacios",
      "Debe ingresar el precio, no debe quedar en 0, ni vacio",
      "warning"
    );
  } else {
    $("#precio_compra_obliga").html("");
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

  if (verificar_compra_insumo_id(id_ma)) {
    return Swal.fire(
      "Mensaje de advertencia",
      "El insumo '" + nombre + " - " + tipo + "' , ya fue agregado al detalle",
      "warning"
    );
  }

  var total = 0,
    agg = 0;
  total = cantiddad * parseFloat(precio).toFixed(2);
  agg = total - parseFloat(descuento).toFixed(2);

  //aqui agrego los labores para unir a la tabla
  var datos_agg = "<tr>";
  datos_agg += "<td for='id'>" + id_ma + "</td>";
  datos_agg += "<td>" + nombre + " - " + tipo + "</td>";
  datos_agg += "<td>" + medida_i + "</td>";
  datos_agg += "<td>" + cantiddad + "</td>";
  datos_agg += "<td>" + precio + "</td>";
  datos_agg += "<td>" + descuento + "</td>";
  datos_agg += "<td>" + parseFloat(agg).toFixed(2);
  +"</td>";
  datos_agg +=
    "<td><button onclick='remove_compra_insumo(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
  datos_agg += "</tr>";

  //esto me ayuda a enviar los datos a la tabla
  $("#tbody_detalle_compr_insumo").append(datos_agg);

  sumartotalnet_insumo();

  $("#codigi_insumoo").val("");
  $("#id_insumo").val("");
  $("#nombre_ma").val("");
  $("#tipo_m").val("");
  $("#medida_i").val("");
  $("#stock_m").val("");
  $("#precio_compra").val("");
  $("#descuento").val("0.00");
  $("#cantiddad").val("0");
}

function remove_compra_insumo(t) {
  var td = t.parentNode;
  var tr = td.parentNode;
  var table = tr.parentNode;
  table.removeChild(tr);
  sumartotalnet_insumo();
}

function sumartotalnet_insumo() {
  let arreglo_total = new Array();
  let count = 0;
  let total = 0;
  let impuestototal = 0;
  let subtotal = 0;
  let impuesto = document.getElementById("impuesto").value;

  let tipo_comprobante = document.getElementById("comprobante_tipo").value;

  $("#detalle_compra_insumo tbody#tbody_detalle_compr_insumo tr").each(
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

function verificar_compra_insumo_id(id) {
  let idverificar = document.querySelectorAll(
    "#tbody_detalle_compr_insumo td[for='id']"
  );
  return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
}

function gardar_compra_insumo() {
  var proveedor = $("#proveedor").val();
  var numero_compra = $("#numero_compra").val();
  var comprobante_tipo = $("#comprobante_tipo").val();
  var impuesto = $("#impuesto").val();
  var fecha_compra = $("#fecha_compra").val();

  var txt_totalneto = $("#txt_totalneto").val();
  var txt_impuesto = $("#txt_impuesto").val();
  var txt_a_pagar = $("#txt_a_pagar").val();
  var count = 0;

  if (
    proveedor.length == 0 ||
    numero_compra.length == 0 ||
    impuesto.length == 0
  ) {
    validar_registro_compra_insumo(proveedor, numero_compra, impuesto);
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos",
      "warning"
    );
  } else {
    $("#razon_oblig").html("");
    $("#numero_obliga").html("");
    $("#Impuesto_obliga").html("");
  }

  $("#detalle_compra_insumo tbody#tbody_detalle_compr_insumo tr").each(
    function () {
      count++;
    }
  );

  if (count == 0) {
    return Swal.fire(
      "Mensaje de advertencia",
      "El detalle de compra debe tener un producto por lo menos,(TABLA INSUMO)",
      "warning"
    );
  }

  funcion = "registrar_compra_insumo";
  alerta = ["datos", "Se esta registrando la compra", "Registrando la compra"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/compra/compra.php",
    type: "POST",
    data: {
      funcion: funcion,
      proveedor: proveedor,
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
        registrar_detalle_compra_insumos(parseInt(resp));
      } else {
        alerta = [
          "existe",
          "warning",
          "El numero de compra " + numero_compra + ", ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = ["error", "error", "No se pudo regitrar la compra"];
      cerrar_loader_datos(alerta);
    }
  });
}

function registrar_detalle_compra_insumos(id) {
  var count = 0;
  var arrego_insumo = new Array();
  var arreglo_cantidad = new Array();
  var arreglo_medida = new Array();
  var arreglo_precio = new Array();
  var arreglo_descuento_moneda = new Array();
  var arreglo_subtotal = new Array();

  $("#detalle_compra_insumo tbody#tbody_detalle_compr_insumo tr").each(
    function () {
      arrego_insumo.push($(this).find("td").eq(0).text());
      arreglo_medida.push($(this).find("td").eq(2).text());
      arreglo_cantidad.push($(this).find("td").eq(3).text());
      arreglo_precio.push($(this).find("td").eq(4).text());
      arreglo_descuento_moneda.push($(this).find("td").eq(5).text());
      arreglo_subtotal.push($(this).find("td").eq(6).text());
      count++;
    }
  );

  //aqui combierto el arreglo a un string
  var idpm = arrego_insumo.toString();
  var medida = arreglo_medida.toString();
  var cantidad = arreglo_cantidad.toString();
  var precio = arreglo_precio.toString();
  var des = arreglo_descuento_moneda.toString();
  var sutotal = arreglo_subtotal.toString();

  if (count == 0) {
    return;
  }

  funcion = "registrar_detalle_inumos";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../ADMIN/controlador/compra/compra.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      idpm: idpm,
      medida: medida,
      cantidad: cantidad,
      precio: precio,
      des: des,
      sutotal: sutotal,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "La compra se realizo con exito"];
        cerrar_loader_datos(alerta);

        Swal.fire({
          title: "IMPRIMIR COMPRA INSUMO",
          text: "Desea imprimir el reporte de compra??",
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
              "../ADMIN/REPORTES/Pdf/factura_compra_insumo.php?id=" +
                parseInt(id) +
                "#zoom=100%",
              "Reporte de compra",
              "scrollbards=No"
            );

            cargar_contenido(
              "contenido_principal",
              "vista/compra/nueva_compra_insumo.php"
            );
          }
        });

        cargar_contenido(
          "contenido_principal",
          "vista/compra/nueva_compra_insumo.php"
        );
      }
    } else {
      alerta = ["error", "error", "No se pudo regitrar el detalle compra"];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_registro_compra_insumo(proveedor, numero_compra, impuesto) {
  if (proveedor.length == 0) {
    $("#razon_oblig").html("NO hay proveedor");
  } else {
    $("#razon_oblig").html("");
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

////////////////
function listar_compras_insumo() {
  funcion = "listar_compras_insumo";
  tabla_insumos = $("#tabla_compras_insumo_").DataTable({
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
      url: "../ADMIN/controlador/compra/compra.php",
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
            return "<span class='label label-success'>COMPRADO</span>";
          } else {
            return "<span class='label label-danger'>ANULADO</span>";
          }
        },
      },
      { data: "razon" },
      { data: "numero_compra" },
      { data: "tipo_comprobante" },

      {
        data: "impuesto",
        render: function (data, type, row) {
          if (data == '0.00') {
            return "0%";
          } else {
            return "12%";
          }
        },
      },

      { data: "fecha" },
      { data: "sub_total" },
      { data: "sub_iva" },
      { data: "gran_total" },
      { data: "cantidad" },
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
  tabla_insumos.on("draw.dt", function () {
    var pageinfo = $("#tabla_compras_insumo_").DataTable().page.info();
    tabla_insumos
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_compras_insumo_").on("click", ".ver", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_insumos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_insumos.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_insumos.row(this).data();
  }

  var id = data.id_compra_insumo;
  var iva = data.impuesto;

  alerta = [
    "datos",
    "Se esta cargando el detalle compra",
    ".:Cargando la compra:.",
  ];
  mostar_loader_datos(alerta);
  cargar_detalle_compra_insumo(parseInt(id), iva);
});

function cargar_detalle_compra_insumo(id, iva) {
  funcion = "detalle_de_compra_insumo";
  $.ajax({
    url: "../ADMIN/controlador/compra/compra.php",
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
      llenat += `<tr>
                <td for='id'>${count}</td>
                <td>${row["nombre_i"]} - ${row["tipo_insumo"]}</td>
                <td>${row["medida"]}</td>
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

      $("#tbody_detalle_compr_insumo").html(llenat);
    });

    $("#modal_detalle_comppra_insumos").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modal_detalle_comppra_insumos").modal("show");
  });
}

$("#tabla_compras_insumo_").on("click", ".pfd", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_insumos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_insumos.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_insumos.row(this).data();
  }

  var id = data.id_compra_insumo;

  Swal.fire({
    title: "IMPRIMIR COMPRA INSUMO",
    text: "Desea imprimir el reporte de compra??",
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
        "../ADMIN/REPORTES/Pdf/factura_compra_insumo.php?id=" +
          parseInt(id) +
          "#zoom=100%",
        "Reporte de compra",
        "scrollbards=No"
      );
    }
  });
});

$("#tabla_compras_insumo_").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_insumos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_insumos.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_insumos.row(this).data();
  }

  var id = data.id_compra_insumo;

  Swal.fire({
    title: "Anular compra",
    text: "Desea anular la compra??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, anular!!",
  }).then((result) => {
    if (result.value) {
      anular_compra_isumo(parseInt(id));
    }
  });
});

function anular_compra_isumo(id) {
  alerta = ["datos", "Se esta anulando la compra", ".:Anulando compra:."];
  mostar_loader_datos(alerta);

  funcion = "anular_compra_isumo";
  $.ajax({
    url: "../ADMIN/controlador/compra/compra.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["exito", "success", "Se anulo la compra con exito"];
        cerrar_loader_datos(alerta);
        tabla_insumos.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se pudo anular la compra"];
      cerrar_loader_datos(alerta);
    }
  });
}

///////////////
function modal_poductos() {
  $("#modal_materiales_select").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_materiales_select").modal("show");
}

function listra_material_select() {
  funcion = "listra_material_select";
  tabla_material_envio = $("#detalle_material_seekct").DataTable({
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
      url: "../ADMIN/controlador/compra/compra.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        render: function (data, type, row) {
          return `<button style='font-size:13px;' type='button' class='enviar btn btn-danger' title='enviar'><i class='fa fa-send'></i></button>`;
        },
      },
      { data: "codigo" },
      { data: "nombre" },
      { data: "tipo_material" },
      { data: "stock_m" },
      { data: "precio" },
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
  tabla_material_envio.on("draw.dt", function () {
    var pageinfo = $("#detalle_material_seekct").DataTable().page.info();
    tabla_material_envio
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#detalle_material_seekct").on("click", ".enviar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_material_envio.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_material_envio.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_material_envio.row(this).data();
  }

  $("#id_marca").val(data.id_material);
  $("#nombre_ma").val(data.nombre);
  $("#tipo_m").val(data.tipo_material);
  $("#stock_m").val(data.stock_m);
  $("#precio_compra").val(data.precio);
  $("#codigi_material").val(data.codigo);
  $("#cantiddad").val("1");

  $("#modal_materiales_select").modal("hide");
});
