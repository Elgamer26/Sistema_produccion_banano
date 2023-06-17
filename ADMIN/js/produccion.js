var funcion, tabla_produccion;

function listar_lotes_select() {
  funcion = "listar_lotes_select";
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
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
          "'>Nombre lote: " +
          data[i][1] +
          " - Longitud: " +
          data[i][3] +
          " - Latitud: " +
          data[i][4] +
          " - Hectarea: " +
          data[i][6] +
          " </option>";
      }
      //aqui concadenamos al id del select
      $("#lote_id").html(cadena);
      var id = $("#lote_id").val();
      listar_hectarea(id);
    } else {
      cadena += "<option value=''>No hay datos de lote</option>";
      $("#lote_id").html(cadena);
    }
  });
}

function listar_hectarea(id) {
  funcion = "listar_hectarea";
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: { funcion: funcion, id: id },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "";
    if (data.length > 0) {
      //bucle para extraer los datos del rol
      for (var i = 0; i < data.length; i++) {
        cadena +=
          "<option value='" + data[i][0] + "'>" + data[i][2] + "  </option>";
      }
      //aqui concadenamos al id del select
      $("#hectarea_id").html(cadena);
    } else {
      cadena += "<option value=''>No hay datos de hectarea</option>";
      $("#hectarea_id").html(cadena);
    }
  });
}

function listar_tipo_ctividad() {
  funcion = "listar_tipo_ctividad";
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "";
    if (data.length > 0) {
      //bucle para extraer los datos del rol
      for (var i = 0; i < data.length; i++) {
        cadena +=
          "<option value='" + data[i][0] + "'>" + data[i][1] + " </option>";
      }
      //aqui concadenamos al id del select
      $("#tipo_actividad").html(cadena);
      var id = $("#tipo_actividad").val();
      listar_empleado(parseInt(id));
    } else {
      cadena += "<option value=''>No hay datos de actividad</option>";
      $("#tipo_actividad").html(cadena);
    }
  });
}

function listar_empleado(id) {
  funcion = "listar_empleado";
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: { funcion: funcion, id: id },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "";
    if (data.length > 0) {
      //bucle para extraer los datos del rol
      for (var i = 0; i < data.length; i++) {
        cadena +=
          "<option value='" + data[i][0] + "'>" + data[i][1] + " </option>";
      }
      //aqui concadenamos al id del select
      $("#empleado_id").html(cadena);
      var id = $("#empleado_id").val();
      costro_actividad(id);
    } else {
      cadena += "<option value=''>No hay datos de empleado</option>";
      $("#empleado_id").html(cadena);
      $("#costo_act").val("0.00");
    }
  });
}

function costro_actividad(id) {
  funcion = "costro_actividad";
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: { funcion: funcion, id: id },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "";
    if (data.length > 0) {
      $("#costo_act").val(data[0][0]);
    } else {
      cadena = "0.00";
      $("#costo_act").val(cadena);
    }
  });
}

////////////////
function listar_material() {
  funcion = "listar_material";
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
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
          "'>Nombre: " +
          data[i][1] +
          " - Marca: " +
          data[i][2] +
          " - Tipo: " +
          data[i][3] +
          "</option>";
      }
      //aqui concadenamos al id del select
      $("#material_id").html(cadena);
      var id = $("#material_id").val();
      dato_material(parseInt(id));
    } else {
      cadena += "<option value=''>No hay datos de material</option>";
      $("#material_id").html(cadena);
    }
  });
}

function dato_material(id) {
  funcion = "dato_material";
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: { funcion: funcion, id: id },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "";
    if (data.length > 0) {
      $("#costo_materila").val(data[0][1]);
      $("#disponibe_material").val(data[0][0]);
    } else {
      cadena = "0.00";
      $("#costo_materila").val(cadena);
      $("#disponibe_material").val("");
    }
  });
}

////////////////
function listar_insumos() {
  funcion = "listar_insumos";
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
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
          "'>Nombre: " +
          data[i][1] +
          " - Marca: " +
          data[i][2] +
          " - Tipo: " +
          data[i][3] +
          "</option>";
      }
      //aqui concadenamos al id del select
      $("#insumo_id").html(cadena);
      var id = $("#insumo_id").val();
      dato_insumos(parseInt(id));
    } else {
      cadena += "<option value=''>No hay datos de insumos</option>";
      $("#insumo_id").html(cadena);
    }
  });
}

function dato_insumos(id) {
  funcion = "dato_insumos";
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: { funcion: funcion, id: id },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "";
    if (data.length > 0) {
      $("#costo_insumo").val(data[0][0]);
      $("#canti_medida").val(data[0][1]);
      $("#medida_insumo").val(data[0][2] + " - " + data[0][3]);
      $("#disponibe_insumo").val(data[0][4]);
    } else {
      cadena = "0.00";
      $("#costo_insumo").val(cadena);
      $("#canti_medida").val("");
      $("#medida_insumo").val("");
      $("#disponibe_insumo").val("");
    }
  });
}

/////////////////////
//////////////
function ingresar_detalle_actividad() {
  var tipo_actividad_nombre = $("#tipo_actividad option:selected").text();
  var empleado_nombr = $("#empleado_id option:selected").text();
  var costo_act = $("#costo_act").val();
  var horas = $("#horas").val();

  var dias_dias = $("#dias_dias").val();
  var asignado_id = $("#empleado_id").val();
  var tipo_actividad = $("#tipo_actividad").val();

  if (dias_dias.length == 0) {
    $("#dias_pbñigg").html("XXX");
    return Swal.fire(
      "Mensaje de advertencia",
      "Ingrese los dias de la produccion",
      "warning"
    );
  } else {
    $("#dias_pbñigg").html("");
  }

  if (tipo_actividad.length == 0) {
    $("#tipo_ac_pbligg").html("Ingrese actividad");
    return false;
  } else {
    $("#tipo_ac_pbligg").html("");
  }

  if (asignado_id.length == 0) {
    $("#ctividad_pbligg").html("Ingrese empleado");
    return false;
  } else {
    $("#ctividad_pbligg").html("");
  }

  if (costo_act.length == 0) {
    $("#costoo_pbligg").html("Ingrese costo");
    return false;
  } else {
    $("#costoo_pbligg").html("");
  }

  if (horas.length == 0) {
    $("#hora_obliggg").html("XXX");
    return Swal.fire(
      "Mensaje de advertencia",
      "Ingrese la hora de trabajo del empleado",
      "warning"
    );
  } else {
    $("#hora_obliggg").html("");
  }

  if (verificar_compra_actividad_id(asignado_id)) {
    return Swal.fire(
      "Mensaje de advertencia",
      "El empleado '" + empleado_nombr + "' , ya fue agregado al detalle",
      "warning"
    );
  }

  // var aaa =  / dias_dias;
  // var diaa = dias_dias * horas / costo_act;
  var diaa = costo_act / horas;

  var datos_agg = "<tr>";
  datos_agg += "<td for='id'>" + asignado_id + "</td>";
  datos_agg += "<td>" + empleado_nombr + "</td>";
  datos_agg += "<td>" + tipo_actividad_nombre + "</td>";
  datos_agg += "<td>" + costo_act + "</td>";
  datos_agg += "<td>" + horas + "</td>";
  datos_agg += "<td>" + parseFloat(diaa).toFixed(2);
  +"</td>";
  datos_agg +=
    "<td><button onclick='remove_compra_actividad(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
  datos_agg += "</tr>";

  //esto me ayuda a enviar los datos a la tabla
  $("#tbody_detalle_atividad").append(datos_agg);
}

function verificar_compra_actividad_id(id) {
  let idverificar = document.querySelectorAll(
    "#tabla_detalle_atividad td[for='id']"
  );
  return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
}

//esta funcion elimina el dato de la tabla seleccionado
function remove_compra_actividad(t) {
  var td = t.parentNode;
  var tr = td.parentNode;
  var table = tr.parentNode;
  table.removeChild(tr);
}

////////////////
//////////////
function ingresar_detalle_material() {
  var tipo_material_nombre = $("#material_id option:selected").text();
  var id_materila = $("#material_id").val();
  var costo_materila = $("#costo_materila").val();
  var disponibe_material = $("#disponibe_material").val();
  var canti_materal = $("#canti_materal").val();

  if (id_materila.length == 0) {
    $("#material_pbligg").html("No hay material");
    return false;
  } else {
    $("#material_pbligg").html("");
  }

  if (
    disponibe_material.length == 0 ||
    disponibe_material == 0 ||
    disponibe_material == "0"
  ) {
    $("#dispni_obligg").html("No hay material");
    return false;
  } else {
    $("#dispni_obligg").html("");
  }

  if (canti_materal.length == 0 || canti_materal == 0 || canti_materal == "0") {
    $("#canti_ma_pbligg").html("Ingrese cantidad");
    return false;
  } else {
    $("#canti_ma_pbligg").html("");
  }

  if (parseInt(canti_materal) > parseInt(disponibe_material)) {
    $("#canti_ma_pbligg").html("XXX");
    $("#dispni_obligg").html("XXX");
    return Swal.fire(
      "Mensaje de advertencia",
      "La cantidad no puede superar el stock disponible",
      "warning"
    );
  } else {
    $("#canti_ma_pbligg").html("");
    $("#dispni_obligg").html("");
  }

  if (verificar_material_detalle_id(id_materila)) {
    return Swal.fire(
      "Mensaje de advertencia",
      "El material '" + tipo_material_nombre + "' , ya fue agregado al detalle",
      "warning"
    );
  }

  var datos_agg = "<tr>";
  datos_agg += "<td for='id'>" + id_materila + "</td>";
  datos_agg += "<td>" + tipo_material_nombre + "</td>";
  datos_agg += "<td>" + costo_materila + "</td>";
  datos_agg += "<td>" + canti_materal + "</td>";
  datos_agg +=
    "<td><button onclick='remove_material_id(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
  datos_agg += "</tr>";

  //esto me ayuda a enviar los datos a la tabla
  $("#tbody_detalle_material").append(datos_agg);
  $("#canti_materal").val("0");
}

function verificar_material_detalle_id(id) {
  let idverificar = document.querySelectorAll(
    "#tabla_detalle_material td[for='id']"
  );
  return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
}

//esta funcion elimina el dato de la tabla seleccionado
function remove_material_id(t) {
  var td = t.parentNode;
  var tr = td.parentNode;
  var table = tr.parentNode;
  table.removeChild(tr);
}

////////////////
//////////////
function ingresar_detalle_insumo() {
  var tipo_insumo = $("#insumo_id option:selected").text();
  var insumo_id = $("#insumo_id").val();
  var costo_insumo = $("#costo_insumo").val();

  var canti_medida = $("#canti_medida").val();
  var medida_insumo = $("#medida_insumo").val();

  var disponibe_insumo = $("#disponibe_insumo").val();
  var canti_insumo = $("#canti_insumo").val();

  if (insumo_id.length == 0) {
    $("#insumo_pbligg").html("No hay insumo");
    return false;
  } else {
    $("#insumo_pbligg").html("");
  }

  if (
    disponibe_insumo.length == 0 ||
    disponibe_insumo == 0 ||
    disponibe_insumo == "0"
  ) {
    $("#dispni_insumo_obligg").html("No hay insumo");
    return false;
  } else {
    $("#dispni_insumo_obligg").html("");
  }

  if (canti_insumo.length == 0 || canti_insumo == 0 || canti_insumo == "0") {
    $("#canti_insumo_pbligg").html("Ingrese cantidad");
    return false;
  } else {
    $("#canti_insumo_pbligg").html("");
  }

  if (parseInt(canti_insumo) > parseInt(disponibe_insumo)) {
    $("#canti_insumo_pbligg").html("XXX");
    $("#dispni_insumo_obligg").html("XXX");
    return Swal.fire(
      "Mensaje de advertencia",
      "La cantidad no puede superar el stock disponible",
      "warning"
    );
  } else {
    $("#canti_insumo_pbligg").html("");
    $("#dispni_insumo_obligg").html("");
  }

  if (verificar_insumos_detalle_id(insumo_id)) {
    return Swal.fire(
      "Mensaje de advertencia",
      "El insumo '" + tipo_insumo + "' , ya fue agregado al detalle",
      "warning"
    );
  }

  var datos_agg = "<tr>";
  datos_agg += "<td for='id'>" + insumo_id + "</td>";
  datos_agg += "<td>" + tipo_insumo + "</td>";
  datos_agg += "<td>" + costo_insumo + "</td>";
  datos_agg += "<td>" + canti_medida + "</td>";
  datos_agg += "<td>" + medida_insumo + "</td>";
  datos_agg += "<td>" + canti_insumo + "</td>";
  datos_agg +=
    "<td><button onclick='remove_insumos_id(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
  datos_agg += "</tr>";

  //esto me ayuda a enviar los datos a la tabla
  $("#tbody_detalle_insumo").append(datos_agg);
  $("#canti_insumo").val("0");
}

function verificar_insumos_detalle_id(id) {
  let idverificar = document.querySelectorAll(
    "#tabla_detalle_insumo td[for='id']"
  );
  return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
}

//esta funcion elimina el dato de la tabla seleccionado
function remove_insumos_id(t) {
  var td = t.parentNode;
  var tr = td.parentNode;
  var table = tr.parentNode;
  table.removeChild(tr);
}

////////////////////////////
/////////////////////////
function guardar_produccion() {
  var fecha_inicio = $("#fecha_inicio").val();
  var fecha_fin = $("#fecha_fin").val();
  var dias_dias = $("#dias_dias").val();
  var lote_id = $("#lote_id").val();
  var nombre_produccion = $("#nombre_produccion").val();
  var hectarea_id = $("#hectarea_id").val();

  var hectarea_no = $("#hectarea_id option:selected").text();

  var count_ac = 0;
  var count_mat = 0;
  var count_ins = 0;

  if (hectarea_id.length == 0) {
    $("#hectrea_olbigg").html("No hay hectarea");
    return false;
  } else {
    $("#hectrea_olbigg").html("");
  }

  if (nombre_produccion.length == 0) {
    $("#nombre_pro_obliig").html("Ingrese nombre de produccion");
    return false;
  } else {
    $("#nombre_pro_obliig").html("");
  }

  if (fecha_inicio > fecha_fin) {
    return Swal.fire(
      "Mensaje de advertencia",
      "La fecha inicio '" +
        fecha_inicio +
        "' es mayor a la fecha final '" +
        fecha_fin +
        "'",
      "warning"
    );
  }

  if (dias_dias.length == 0) {
    $("#dias_pbñigg").html("Dias");
    return false;
  } else {
    $("#dias_pbñigg").html("");
  }

  if (lote_id.length == 0) {
    $("#lotes_obligg").html("No hay lotes disponibles");
    return false;
  } else {
    $("#lotes_obligg").html("");
  }

  $("#tabla_detalle_atividad tbody#tbody_detalle_atividad tr").each(
    function () {
      count_ac++;
    }
  );

  if (count_ac == 0) {
    return Swal.fire(
      "Mensaje de advertencia (TABLA ACTIVIDADES)",
      "Ingrese datos en la tabla detalle de actividades",
      "warning"
    );
  }

  $("#tabla_detalle_material tbody#tbody_detalle_material tr").each(
    function () {
      count_mat++;
    }
  );

  if (count_mat == 0) {
    return Swal.fire(
      "Mensaje de advertencia (TABLA MATERIAL)",
      "Ingrese datos en la tabla detalle de material",
      "warning"
    );
  }

  $("#tabla_detalle_insumo tbody#tbody_detalle_insumo tr").each(function () {
    count_ins++;
  });

  if (count_ins == 0) {
    return Swal.fire(
      "Mensaje de advertencia (TABLA INSUMOS)",
      "Ingrese datos en la tabla detalle de insumos",
      "warning"
    );
  }

  funcion = "registrar_produccion";
  alerta = ["datos", "Se esta creando la produccion", "Creando produccion"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      fecha_inicio: fecha_inicio,
      fecha_fin: fecha_fin,
      dias_dias: dias_dias,
      lote_id: lote_id,
      nombre_produccion: nombre_produccion,
      hectarea_id: hectarea_id,
      hectarea_no: hectarea_no,
    },
  }).done(function (response) {
    if (response > 0) {
      registrar_detalle_actividad(parseInt(response));
    } else {
      alerta = ["error", "error", "No se pudo crear la produccion"];
      cerrar_loader_datos(alerta);
    }
  });
}

function registrar_detalle_actividad(id) {
  var count = 0;
  var arrego_actividad = new Array();
  var arreglo_actividad = new Array();
  var arreglo_costo = new Array();

  var arreglo_hora = new Array();
  var arreglo_costo_hora = new Array();

  $("#tabla_detalle_atividad tbody#tbody_detalle_atividad tr").each(
    function () {
      arrego_actividad.push($(this).find("td").eq(0).text());
      arreglo_actividad.push($(this).find("td").eq(2).text());
      arreglo_costo.push($(this).find("td").eq(3).text());
      arreglo_hora.push($(this).find("td").eq(4).text());
      arreglo_costo_hora.push($(this).find("td").eq(5).text());

      count++;
    }
  );

  //aqui combierto el arreglo a un string
  var id_act = arrego_actividad.toString();
  var actividad = arreglo_actividad.toString();
  var costo = arreglo_costo.toString();
  var hora = arreglo_hora.toString();
  var costo_hora = arreglo_costo_hora.toString();

  if (count == 0) {
    return;
  }

  funcion = "registrar_detalle_actividad";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      id_act: id_act,
      actividad: actividad,
      costo: costo,
      hora: hora,
      costo_hora: costo_hora,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        registrar_detalle_material(parseInt(id));
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo regitrar el detalle de actividad",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function registrar_detalle_material(id) {
  var count = 0;
  var arrego_material_id = new Array();
  var arreglo_costo = new Array();
  var arreglo_cantidad = new Array();

  $("#tabla_detalle_material tbody#tbody_detalle_material tr").each(
    function () {
      arrego_material_id.push($(this).find("td").eq(0).text());
      arreglo_costo.push($(this).find("td").eq(2).text());
      arreglo_cantidad.push($(this).find("td").eq(3).text());
      count++;
    }
  );

  //aqui combierto el arreglo a un string
  var id_materila = arrego_material_id.toString();
  var costo = arreglo_costo.toString();
  var cantidad = arreglo_cantidad.toString();

  if (count == 0) {
    return;
  }

  funcion = "registrar_detalle_material";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      id_materila: id_materila,
      costo: costo,
      cantidad: cantidad,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        registrar_detalle_insumos(parseInt(id));
      }
    } else {
      alerta = ["error", "error", "No se pudo regitrar el detalle de material"];
      cerrar_loader_datos(alerta);
    }
  });
}

function registrar_detalle_insumos(id) {
  var count = 0;
  var arrego_insumo_id = new Array();
  var arreglo_costo = new Array();
  var arreglo_can_medida = new Array();
  var arrego_medida = new Array();
  var arreglo_cantidad = new Array();

  $("#tabla_detalle_insumo tbody#tbody_detalle_insumo tr").each(function () {
    arrego_insumo_id.push($(this).find("td").eq(0).text());
    arreglo_costo.push($(this).find("td").eq(2).text());
    arreglo_can_medida.push($(this).find("td").eq(3).text());
    arrego_medida.push($(this).find("td").eq(4).text());
    arreglo_cantidad.push($(this).find("td").eq(5).text());
    count++;
  });

  //aqui combierto el arreglo a un string
  var id_insumo = arrego_insumo_id.toString();
  var costo = arreglo_costo.toString();
  var medi_cant = arreglo_can_medida.toString();
  var medida = arrego_medida.toString();
  var cantidad = arreglo_cantidad.toString();

  if (count == 0) {
    return;
  }

  funcion = "registrar_detalle_insumo";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      id_insumo: id_insumo,
      costo: costo,
      medi_cant: medi_cant,
      medida: medida,
      cantidad: cantidad,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = [
          "exito",
          "success",
          "Se creo correctamente la nueva produccion",
        ];
        cerrar_loader_datos(alerta);

        Swal.fire({
          title: "Imprimir reporte de produccion?",
          text: "Se imprimira el reporte de produccion!!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, imprimir!",
        }).then((result) => {
          if (result.isConfirmed) {
            window.open(
              "../ADMIN/REPORTES/Pdf/reporte_produccion.php?id=" +
                parseInt(id) +
                "#zoom=100%",
              "Reporte de venta",
              "scrollbards=No"
            );
            cargar_contenido(
              "contenido_principal",
              "vista/produccion/nueva_produccion.php"
            );
          }
        });
        cargar_contenido(
          "contenido_principal",
          "vista/produccion/nueva_produccion.php"
        );
      }
    } else {
      alerta = ["error", "error", "No se pudo regitrar el detalle de insumos"];
      cerrar_loader_datos(alerta);
    }
  });
}

/////////////////
function lisrado_produccion() {
  funcion = "lisrado_produccion";
  tabla_produccion = $("#tabla_produccion_").DataTable({
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
      url: "../ADMIN/controlador/produccion/produccion.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      // {
      //   data: "estado",
      //   render: function (data, type, row) {
      //     if (data == "INICIADO") {
      //       return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el Oftalmólogo'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='ver btn btn-warning' title='ver detalle'><i class='fa fa-eye'></i></button> - <button style='font-size:13px;' type='button' class='finalizar btn btn-success' title='Fin de produccion'><i class='fa fa-clock-o'></i></button> - <button style='font-size:13px;' type='button' class='pfd btn btn-primary' title='ver reporte'><i class='fa fa-file'></i></button>`;
      //     } else if (data == "FINALIZADO") {
      //       return `<button style='font-size:13px;' type='button' class='ver btn btn-warning' title='ver detalle'><i class='fa fa-eye'></i></button> - <button style='font-size:13px;' type='button' class='pfd btn btn-primary' title='ver reporte'><i class='fa fa-file'></i></button>`;
      //     } else {
      //       return `<button style='font-size:13px;' type='button' class='btn btn-danger' title='caneclado'><i class='fa fa-times'></i> Produccion cancelada</button>`;
      //     }
      //   },
      // },

      {
        data: "estado",
        render: function (data, type, row) {
          if (data == "INICIADO") {
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el Oftalmólogo'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='ver btn btn-warning' title='ver detalle'><i class='fa fa-eye'></i></button> - <button style='font-size:13px;' type='button' class='pfd btn btn-primary' title='ver reporte'><i class='fa fa-file'></i></button>`;
          } else if (data == "FINALIZADO") {
            return `<button style='font-size:13px;' type='button' class='ver btn btn-warning' title='ver detalle'><i class='fa fa-eye'></i></button> - <button style='font-size:13px;' type='button' class='pfd btn btn-primary' title='ver reporte'><i class='fa fa-file'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='btn btn-danger' title='caneclado'><i class='fa fa-times'></i> Produccion cancelada</button>`;
          }
        },
      },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == "INICIADO") {
            return "<span class='label label-primary'>" + data + "</span>";
          } else if (data == "FINALIZADO") {
            return "<span class='label label-success'>" + data + "</span>";
          } else {
            return "<span class='label label-danger'>" + data + "</span>";
          }
        },
      },
      { data: "nombre_prod" },
      { data: "nombre_l" },
      { data: "hectarea" },
      { data: "fecha_inicio" },
      { data: "fecha_fin" },
      { data: "dias" },
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
  tabla_produccion.on("draw.dt", function () {
    var pageinfo = $("#tabla_produccion_").DataTable().page.info();
    tabla_produccion
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_produccion_").on("click", ".pfd", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_produccion.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_produccion.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_produccion.row(this).data();
  }

  var id = data.id_produccion;

  Swal.fire({
    title: "Imprimir reporte de produccion?",
    text: "Se imprimira el reporte de produccion!!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, imprimir!",
  }).then((result) => {
    if (result.isConfirmed) {
      window.open(
        "../ADMIN/REPORTES/Pdf/reporte_produccion.php?id=" +
          parseInt(id) +
          "#zoom=100%",
        "Reporte de venta",
        "scrollbards=No"
      );
    }
  });
});

$("#tabla_produccion_").on("click", ".finalizar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_produccion.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_produccion.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_produccion.row(this).data();
  }

  var id = data.id_produccion;
  var id_h = data.id_hectarea;
  var pocentaje = data.porcentaje;

  $("#id_produccion_").val(id);
  $("#pocentaje_").val(pocentaje);
  $("#id_h_").val(id_h);

  $("#modal_avance_produccion").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_avance_produccion").modal("show");

  //   Swal.fire({
  //     title: "Finalizar la produccion?",
  //     text: "Se finalizara la produccion!!",
  //     icon: "warning",
  //     showCancelButton: true,
  //     confirmButtonColor: "#3085d6",
  //     cancelButtonColor: "#d33",
  //     confirmButtonText: "Si, finalizar!",
  //   }).then((result) => {
  //     if (result.isConfirmed) {
  //       finalizar_produccion_(id);
  //     }
  //   });
});

function finalizar_produccion_(id) {
  funcion = "finalizar_produccion_";
  alerta = ["datos", "Se esta finalizando la produccion", "Finalizando"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: { id: id, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "La produccion se finalizo con exito"];
        cerrar_loader_datos(alerta);
        tabla_produccion.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se puedo finalizar la produccion"];
      cerrar_loader_datos(alerta);
    }
  });
}

$("#tabla_produccion_").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_produccion.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_produccion.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_produccion.row(this).data();
  }

  var id = data.id_produccion;
  var id_hec = data.id_hectarea;

  //   return alert(id_hec);

  Swal.fire({
    title: "Cancelar produccion?",
    text: "Se cancelara la produccion!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cancelar_produccion(id, id_hec);
    }
  });
});

function cancelar_produccion(id, id_hec) {
  funcion = "cancelar_produccion";
  alerta = ["datos", "Se cancelara la produccion", "Cancelando"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: { id: id, funcion: funcion, id_hec: id_hec },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "La produccion se cancelo con exito"];
        cerrar_loader_datos(alerta);
        tabla_produccion.ajax.reload();
      }
    } else {
      alerta = ["error", "error", "No se puedo cancelar la produccion"];
      cerrar_loader_datos(alerta);
    }
  });
}

$("#tabla_produccion_").on("click", ".ver", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_produccion.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_produccion.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_produccion.row(this).data();
  }
  var id = data.id_produccion;

  alerta = [
    "datos",
    "Se esta cargando el detalle produccion",
    ".:Cargando la produccion:.",
  ];
  mostar_loader_datos(alerta);

  cargar_detalle_acntividades(parseInt(id));
  $("#modal_detalle_produccion").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_detalle_produccion").modal("show");
});

function cargar_detalle_acntividades(id) {
  funcion = "cargar_detalle_acntividades";
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    alerta = ["", "", ""];
    cerrar_loader_datos(alerta);
    let count = 0;
    var data = JSON.parse(resp);
    var llenat = "";
    data["data"].forEach((row) => {
      count++;
      llenat += `<tr>
                <td for='id'>${count}</td>
                <td>${row["empleado"]}</td>
                <td>${row["actividad"]}</td>
                <td>${row["costo"]}</td>                           
                </tr>`;

      $("#tbody_detalle_atividad").html(llenat);
    });

    cargar_detalle_material(id);
  });
}

function cargar_detalle_material(id) {
  funcion = "cargar_detalle_material";
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    alerta = ["", "", ""];
    cerrar_loader_datos(alerta);
    let count = 0;
    var data = JSON.parse(resp);
    var llenat = "";
    data["data"].forEach((row) => {
      count++;
      llenat += `<tr>
                <td for='id'>${count}</td>
                <td>${row["material"]}</td>
                <td>${row["costo"]}</td> 
                <td>${row["cantidad"]}</td>
                </tr>`;

      $("#tbody_detalle_material").html(llenat);
    });
    cargar_detalle_insumoos(id);
  });
}

function cargar_detalle_insumoos(id) {
  funcion = "cargar_detalle_insumoos";
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    alerta = ["", "", ""];
    cerrar_loader_datos(alerta);
    let count = 0;
    var data = JSON.parse(resp);
    var llenat = "";
    data["data"].forEach((row) => {
      count++;
      llenat += `<tr>
                <td for='id'>${count}</td>
                <td>${row["insumo"]}</td>
                <td>${row["costo"]}</td> 
                <td>${row["medida_cantida"]}</td>
                <td>${row["medida"]}</td> 
                <td>${row["cantidad"]}</td>
                </tr>`;

      $("#tbody_detalle_insumo").html(llenat);
    });
    cargar_detalle_racimos(id);
    cargar_detalle_rechasos(id);
    cargar_detalle_novedad(id);
    traer_detalle_cintas(id);
  });
}

function cargar_detalle_racimos(id) {
  funcion = "cargar_detalle_racimos";
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    alerta = ["", "", ""];
    cerrar_loader_datos(alerta);
    var data = JSON.parse(resp);
    if (data == "") {
      $("#tbody_detalle_racimos").empty();
    } else {
      var llenat = "";
      let count = 0;
      data["data"].forEach((row) => {
        count++;
        llenat += `<tr>
                    <td for='id'>${count}</td>
                    <td>${row["fecha_ra"]}</td>
                    <td>${row["cantidad"]}</td> 
                    <td style="background: orange; color: black;">${row["tipo"]}</td> 
                    </tr>`;
        $("#tbody_detalle_racimos").html(llenat);
      });
    }
  });
}

function cargar_detalle_rechasos(id) {
  funcion = "cargar_detalle_rechasos";
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    alerta = ["", "", ""];
    cerrar_loader_datos(alerta);
    var data = JSON.parse(resp);
    if (data == "") {
      $("#tbody_detalle_desechos").empty();
    } else {
      var llenat = "";
      let count = 0;
      data["data"].forEach((row) => {
        count++;
        llenat += `<tr>
                    <td for='id'>${count}</td>
                    <td>${row["fecha_re"]}</td>
                    <td>${row["cantidad_re"]}</td> 
                    <td style="background: red; color: white;">${row["tipo_re"]}</td> 
                    </tr>`;
        $("#tbody_detalle_desechos").html(llenat);
      });
    }
  });
}

function cargar_detalle_novedad(id) {
  funcion = "cargar_detalle_novedad";
  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    alerta = ["", "", ""];
    cerrar_loader_datos(alerta);
    var data = JSON.parse(resp);
    if (data == "") {
      $("#tbody_detalle_novedad").empty();
    } else {
      var llenat = "";
      let count = 0;
      data["data"].forEach((row) => {
        count++;
        llenat += `<tr>
                    <td for='id'>${count}</td>
                    <td>${row["fecha"]}</td>
                    <td>${row["nombre"]}</td> 
                    <td>${row["descipcion"]}</td> 
                    <td>${row["costo"]}</td> 
                    </tr>`;
        $("#tbody_detalle_novedad").html(llenat);
      });
    }
  });
}

function traer_detalle_cintas(id) {
  funcion = "traer_detalle_cintas";
  $.ajax({
    url: "../ADMIN/controlador/tipo_cintas/tipo_cintas.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (response) {
    if (response != 0) {
      var data = JSON.parse(response);
      var llenat = "";
      var count = 0;
      data.forEach((row) => {
        count++;
        llenat += `     <tr>
                      <td>${count}</td>
                      <td>${row["semana"]}</td>
                      <td style="text-align: center;"><input type='color' value='${row["color"]}' disabled></td>
                      <td>${row["fecha"]}</td>
                      <td>${row["detalle"]}</td>                     
                      </tr>`;

        $("#tbody_tabala_semanas").html(llenat);
      });
    } else {
      $("#tbody_tabala_semanas").empty();
    }
  });
}

function guardar_pocetaje() {
  var id = $("#id_produccion_").val();
  var pocentaje_ = $("#pocentaje_").val();
  var id_h_ = $("#id_h_").val();

  funcion = "guardar_pocetaje";
  alerta = ["datos", "Se esta registrando el porcentaje", "Creando porcentaje"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/produccion/produccion.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      pocentaje_: pocentaje_,
      id_h_: id_h_,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        $("#modal_avance_produccion").modal("hide");
        alerta = [
          "exito",
          "success",
          "El porcentaje produccion se registro con exito",
        ];
        cerrar_loader_datos(alerta);
        tabla_produccion.ajax.reload();
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se puedo cambiar el porcentaje de la produccion",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}
