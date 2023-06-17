var funcion, tabla_usuario;

$(document).ready(function () {

});

$(document).on("click", "#ingresar", function () {
  var usuario = $("#usuario").val();
  var password = $("#password").val();

  if (parseInt(usuario.length) <= 0 || usuario == "") {
    $("#none_pass").hide();
    $("#none_usu").hide();
    $("#error_logeo").hide();
    $("#none_usu").show(2000);
  } else if (parseInt(password.length) <= 0 || password == "") {
    $("#none_usu").hide();
    $("#none_pass").hide();
    $("#error_logeo").hide();
    $("#none_pass").show(2000);
  } else {
    $("#none_usu").hide();
    $("#none_pass").hide();
    $("#error_logeo").hide();

    funcion = "logeo";
    $.ajax({
      url: "../ADMIN/controlador/usuarios/usuarios.php",
      type: "POST",
      data: { usuario: usuario, password: password, funcion: funcion },
    }).done(function (responce) {

      if (responce == 0) {
        $("#none_usu").hide();
        $("#none_pass").hide();
        $("#error_logeo").hide();
        $("#error_logeo").show(2000);
        return false;
      } else {
        var data = JSON.parse(responce);
        if (data[0][3] == 0) {
          Swal.fire({
            icon: "error",
            title: "Usuario inactivo",
            text: "El usuario se encuentra inactivo!",
          });
        } else {
          funcion = "session";
          $.ajax({
            url: "../ADMIN/controlador/usuarios/usuarios.php",
            type: "POST",
            data: {
              id_usu: data[0][0],
              rol: data[0][4],
              funcion: funcion,
            },
          }).done(function (res) {
            if (res == 1) {
              let timerInterval;
              Swal.fire({
                title: "Bienvenido al sistema!",
                html: "Usted sera redireccionado en <b></b> mi.",
                allowOutsideClick: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading();
                  const b = Swal.getHtmlContainer().querySelector("b");
                  timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft();
                  }, 100);
                },
                willClose: () => {
                  clearInterval(timerInterval);
                },
              }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                  location.reload();
                }
              });
            }
          });
        }
      }
    });
  }
});

function traer_datos_usuario() {
  funcion = "traer_usuario";
  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (responce) {
    if (responce != 0) {
      var data = JSON.parse(responce);
      $("#datos_nombres_empleado").html(
        data[0][1] + " " + data[0][2]
      );
      $("#cargo_empreado").html(data[0][5]);
      $("#datos_nombres_empleado_2").html(data[0][1]);
      $("#tipo_usuario_centrad").html(data[0]["tipo_usuario"]);

      $("#foto_user_uno").attr("src", data[0][4]);
      $("#foto_user_dos").attr("src", data[0][4]);
    }
  });
}

function editar_usuario_legeado() {
  funcion = "traer_usuario";
  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (responce) {
    if (responce != 0) {
      var data = JSON.parse(responce);
      $("#nombre_usuaio_edit").html(data[0][1]);
      $("#foto_user_tres").attr("src", data[0][4]);
      $("#foto_delte").val(data[0][4]);

      $("#nombre_edit").val(data[0][1]);
      $("#apellido_edit").val(data[0][2]);
      $("#usuario_edit").val(data[0][3]);
      $("#documento_edit").val(data[0][6]);

      $("#pass_base_oculto").val(data[0][7]);
    }

    $("#modal_ediat_contra").modal({ backdrop: "static", keyboard: false });
    $("#modal_ediat_contra").modal("show");

  });
}

function cambiar_foto_perfil_user() {

  var foto = document.getElementById("foto_perfoil").value;
  var ruta_actual = document.getElementById("foto_delte").value;

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

  if (foto == "" || ruta_actual.length == 0 || ruta_actual == "") {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese una imagen para actualizar",
      "warning"
    );
  }

  var formdata = new FormData();
  var foto = $("#foto_perfoil")[0].files[0];

  //est valores son como los que van en la data del ajax
  funcion = "cambiar_foto_perfil_user";
  formdata.append("funcion", funcion);
  formdata.append("foto", foto);
  formdata.append("ruta_actual", ruta_actual);
  formdata.append("nombrearchivo", nombrearchivo);

  alerta = [
    "datos",
    "Se esta editando la imagen del usuario",
    "Editando imagen usuario",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          document.getElementById("foto_perfoil").value = "";
          editar_usuario_legeado();
          traer_datos_usuario();
          alerta = [
            "exito",
            "success",
            "La foto de usuario se edito con exito",
          ];
          cerrar_loader_datos(alerta);

          $("#modal_ediat_contra").modal("hide");
        }
      } else {
        alerta = [
          "error",
          "error",
          "No se pudo editar la foto de perfil",
        ];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function editar_contra() {
  var db = document.getElementById("pass_base_oculto").value;
  var actual = document.getElementById("pass_base").value;
  var nueva = document.getElementById("pass_edit").value;


  if (
    db.length == 0 ||
    actual.length == 0 ||
    nueva.length == 0
  ) {
    return swal.fire(
      "Mensaje de alerta",
      "Ingrese los password para editarlos",
      "warning"
    );
  }

  if (db != actual) {
    return swal.fire(
      "Mensaje de alerta",
      "La clave actual es incorrecta",
      "warning"
    );
  }

  funcion = "cambiar_pass";
  alerta = [
    "datos",
    "Se esta modificando el password",
    "Cambiando password",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: { nueva: nueva, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        editar_usuario_legeado();

        document.getElementById("pass_base").value = "";
        document.getElementById("pass_edit").value = "";

        alerta = [
          "exito",
          "success",
          "La clave del usuario se actualizo correctamente :)",
        ];
        cerrar_loader_datos(alerta);

        $("#modal_ediat_contra").modal("hide");
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se puede cambiar el password",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function editar_usuario_perfil() {
  var nomber = document.getElementById("nombre_edit").value;
  var apellido = document.getElementById("apellido_edit").value;
  var usurio = document.getElementById("usuario_edit").value;

  if (
    nomber.length == 0 ||
    apellido.length == 0 ||
    usurio.length == 0
  ) {
    return swal.fire(
      "Mensaje de alerta",
      "Ingrese todo los datos, no debe quedar ningun dato vacio",
      "warning"
    );
  }

  funcion = "cambiar_datos_perfil";
  alerta = [
    "datos",
    "Se esta modificando los datos de perfil",
    "Cambiando datos del usuario",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: {
      funcion: funcion,
      nomber: nomber,
      apellido: apellido,
      usurio: usurio
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {

        editar_usuario_legeado();
        traer_datos_usuario();

        alerta = [
          "exito",
          "success",
          "Los datos de perfil se actualizo con exito :)",
        ];
        cerrar_loader_datos(alerta);

        $("#modal_ediat_contra").modal("hide");

      } else {
        alerta = [
          "existe",
          "warning",
          "El usuario " + usuario + " ya se encuentra registrado :(",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo actualizar el registro",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function listar_rol_usu() {
  funcion = "listar_rl_usu";
  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
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
      $("#tipo_rol_usu").html(cadena);
    } else {
      cadena += "<option value=''>No hay datos de rol</option>";
      $("#tipo_rol_usu").html(cadena);
    }
  });
}

function guardar_usuaio() {
  var nombre = document.getElementById("nombres").value;
  var apellidos = document.getElementById("apellidos").value;
  var usuario = document.getElementById("usuario").value;
  var password = document.getElementById("password").value;
  var tipo_rol_usu = document.getElementById("tipo_rol_usu").value;
  var numero_docu = document.getElementById("numero_docu").value;

  var foto = document.getElementById("foto").value;

  if (
    nombre.length == 0 ||
    apellidos.length == 0 ||
    usuario.length == 0 ||
    password.length == 0 ||
    tipo_rol_usu.length == 0 ||
    numero_docu.length == 0
  ) {
    validar_registro_usuario(
      nombre,
      apellidos,
      usuario,
      password,
      tipo_rol_usu,
      numero_docu
    );

    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos",
      "warning"
    );
  } else {
    $("#nombre_oblig").html("");
    $("#apellido_obliga").html("");
    $("#usuario_obliga").html("");
    $("#pass_obliga").html("");
    $("#dcoumento_obliga").html("");
    $("#rol_obliga").html("");
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

  alerta = [
    "datos",
    "Se esta creando el usuario",
    "Creando usuario",
  ];
  mostar_loader_datos(alerta);

  funcion = "registra_usuario";
  formdata.append("funcion", funcion);

  formdata.append("nombre", nombre);
  formdata.append("usuario", usuario);
  formdata.append("password", password);
  formdata.append("apellidos", apellidos);
  formdata.append("tipo_rol_usu", tipo_rol_usu);
  formdata.append("numero_docu", numero_docu);

  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          alerta = ["exito", "success", "El usuario se registro con exito"];
          cerrar_loader_datos(alerta);
          cargar_contenido('contenido_principal', 'vista/usuario/nuevo_usuario.php');
        } else if (resp == 2) {
          alerta = [
            "existe",
            "warning",
            "El usuario " +
            usuario +
            " ya esta registrado",
          ];
          cerrar_loader_datos(alerta);
        } else {
          alerta = [
            "existe",
            "warning",
            "El nombre " + nombre + " y el apellido " + apellidos + ", ya estan registrados",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = [
          "error",
          "error",
          "Error al registrar el usuario",
        ];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function listar_usuarios() {
  funcion = "listar_usuarios";
  tabla_usuario = $("#tabla_usuarios_").DataTable({
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
      url: "../ADMIN/controlador/usuarios/usuarios.php",
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
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el usuario'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el usuario'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='key btn btn-warning' title='Editar el permiso'><i class='fa fa-key'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el usuario'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el usuario'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='key btn btn-warning' title='Editar el permiso'><i class='fa fa-key'></i></button>`;
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
      { data: "nombres" },
      { data: "apellidos" },
      { data: "usuario" },
      {
        data: "foto",
        render: function (data, type, row) {

          return "<img class='img-circle' src='" + data + "' width='45px' />";
        }
      },
      { data: "fecha" },
      { data: "nombre" },
      { data: "numero_documento" },
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
  tabla_usuario.on("draw.dt", function () {
    var pageinfo = $("#tabla_usuarios_").DataTable().page.info();
    tabla_usuario
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_usuarios_").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_usuario.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_usuario.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_usuario.row(this).data();
  }
  var dato = 0;
  var id = data.id_usuario;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del rol se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_usuario(id, dato);
    }
  });
});

$("#tabla_usuarios_").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_usuario.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_usuario.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_usuario.row(this).data();
  }
  var dato = 1;
  var id = data.id_usuario;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del rol se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_usuario(id, dato);
    }
  });
});

function cambiar_estado_usuario(id, dato) {
  var res = "";
  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "estado_usuario";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + "",
    "Cambiando estado",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio"];
        cerrar_loader_datos(alerta);
        tabla_usuario.ajax.reload();
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

$("#tabla_usuarios_").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_usuario.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_usuario.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_usuario.row(this).data();
  }

  $("#id_usuario_edit").val(data.id_usuario);
  $("#nombres").val(data.nombres);
  $("#apellidos").val(data.apellidos);
  $("#usuario").val(data.usuario);
  $("#tipo_rol_usu").val(data.id_rol).trigger("change");
  $("#numero_docu").val(data.numero_documento);
  $("#password").val("");

  $("#nombre_oblig").html("");
  $("#apellido_obliga").html("");
  $("#usuario_obliga").html("");
  $("#pass_obliga").html("");
  $("#dcoumento_obliga").html("");
  $("#rol_obliga").html("");

  $("#numero_docu").css("border", "1px solid green");
  $("#cedula_empleado").html("");

  $("#modal_edit_usuario").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_edit_usuario").modal("show");
});

function editar_usuario() {
  var id = document.getElementById("id_usuario_edit").value;
  var nombre = document.getElementById("nombres").value;
  var apellidos = document.getElementById("apellidos").value;
  var usuario = document.getElementById("usuario").value;
  var tipo_rol_usu = document.getElementById("tipo_rol_usu").value;
  var numero_docu = document.getElementById("numero_docu").value;

  if (
    nombre.length == 0 ||
    apellidos.length == 0 ||
    usuario.length == 0 ||
    numero_docu.length == 0 ||
    tipo_rol_usu.length == 0
  ) {
    validar_registro_usuario_edit(
      nombre,
      apellidos,
      usuario,
      numero_docu,
      tipo_rol_usu
    );

    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos",
      "warning"
    );
  } else {
    $("#nombre_oblig").html("");
    $("#apellido_obliga").html("");
    $("#usuario_obliga").html("");
    $("#dcoumento_obliga").html("");
    $("#rol_obliga").html("");
  }

  funcion = "editar_usuario";
  alerta = [
    "datos",
    "Se esta editando el usuario",
    "Creando usuario",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      nombre: nombre,
      usuario: usuario,
      apellidos: apellidos,
      tipo_rol_usu: tipo_rol_usu,
      numero_docu: numero_docu,

    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El usuario se edito con exito"];
        cerrar_loader_datos(alerta);
        tabla_usuario.ajax.reload();
        $("#modal_edit_usuario").modal("hide");
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "El usuario " +
          usuario +
          " ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      } else {
        alerta = [
          "existe",
          "warning",
          "El nombre " + nombre + " y el apellido " + apellidos + ", ya estan registrados",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al editar el usuario",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_registro_usuario(
  nombre,
  apellidos,
  usuario,
  password,
  tipo_rol_usu,
  numero_docu
) {
  if (nombre.length == 0) {
    $("#nombre_oblig").html("Ingrese nombres");
  } else {
    $("#nombre_oblig").html("");
  }

  if (apellidos.length == 0) {
    $("#apellido_obliga").html("Ingrese apellidos");
  } else {
    $("#apellido_obliga").html("");
  }

  if (usuario.length == 0) {
    $("#usuario_obliga").html("Ingrese usuario");
  } else {
    $("#usuario_obliga").html("");
  }

  if (password.length == 0) {
    $("#pass_obliga").html("Ingrese password");
  } else {
    $("#pass_obliga").html("");
  }

  if (numero_docu.length == 0) {
    $("#dcoumento_obliga").html("Ingrese numero documento");
  } else {
    $("#dcoumento_obliga").html("");
  }

  if (tipo_rol_usu.length == 0) {
    $("#rol_obliga").html("No hay tipo de rol");
  } else {
    $("#rol_obliga").html("");
  }
}

function validar_registro_usuario_edit(
  nombre,
  apellidos,
  usuario,
  numero_docu,
  tipo_rol_usu
) {
  if (nombre.length == 0) {
    $("#nombre_oblig").html("Ingrese nombres");
  } else {
    $("#nombre_oblig").html("");
  }

  if (apellidos.length == 0) {
    $("#apellido_obliga").html("Ingrese apellidos");
  } else {
    $("#apellido_obliga").html("");
  }

  if (usuario.length == 0) {
    $("#usuario_obliga").html("Ingrese usuario");
  } else {
    $("#usuario_obliga").html("");
  }

  if (numero_docu.length == 0) {
    $("#dcoumento_obliga").html("Ingrese numero documento");
  } else {
    $("#dcoumento_obliga").html("");
  }

  if (tipo_rol_usu.length == 0) {
    $("#rol_obliga").html("No hay tipo de rol");
  } else {
    $("#rol_obliga").html("");
  }
}

$("#tabla_usuarios_").on("click", ".key", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_usuario.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_usuario.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_usuario.row(this).data();
  }

  $("#id_usuario_edit_c").val(data.id_usuario);

  $("#modal_edit__pasword").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_edit__pasword").modal("show");
});

function editar_password() {
  var id = document.getElementById("id_usuario_edit_c").value;
  var nombre = document.getElementById("password_edit_usu").value;

  if (nombre.length == 0) {
    return swal.fire(
      "Campo vacios",
      "Debe ingresar un password",
      "warning"
    );
  }

  funcion = "editar_password_usuario";
  alerta = [
    "datos",
    "Se esta editando el password",
    "Editando password",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      nombre: nombre,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El password se edito con exito"];
        cerrar_loader_datos(alerta);

        tabla_usuario.ajax.reload();
        $("#modal_edit__pasword").modal("hide");
      }

    } else {
      alerta = [
        "error",
        "error",
        "Error al editar el password",
      ];
      cerrar_loader_datos(alerta);
    }
  });;
}