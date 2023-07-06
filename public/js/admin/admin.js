$(document).ready(function () {
    // initSelectTwoModal();
    $("#table-permission")
        .DataTable({
            language: {
                url:BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json",
            },
            dom: "Bfrtip",
            responsive: true,
            lengthChange: true,
            autoWidth: true,
           //buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
            // "pagingType":"full_numbers",
        //    iDisplayLength: 7,
            scrollY: 440,
            bSort: false,
        })
        .buttons()
        .container()
        .appendTo("#table-permission_wrapper .col-md-6:eq(0)");

    $("#table-rols")
        .DataTable({
            language: {
                url:BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json",
            },
            dom: "Bfrtip",
            responsive: true,
lengthChange:true,
            autoWidth: true,
           //buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
        //    iDisplayLength: 7,
           scrollY: 440,
            bSort: false,
        })
        .buttons()
        .container()
        .appendTo("#table-rols_wrapper .col-md-6:eq(0)");

    $("#table-user-admin")
        .DataTable({
            language: {
                url:BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json",
            },
            dom: "Bfrtip",
            responsive: true,
lengthChange:true,
            autoWidth: true,
           //buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
            // iDisplayLength: 7,
            scrollY: 440,
            bSort: false,
        })
        .buttons()
        .container()
        .appendTo("#table-user-admin_wrapper .col-md-6:eq(0)");
});
// User
// function showUser(data) {
//     openModal("Ver Usuario")
//     $('#sendUserButton').hide();
//     $('#name').val(data.name);
//     $('#email').val(data.email);
//     $("#name").prop("disabled", true);
//     $("#email").prop("disabled", true);
//     $("#password").prop("disabled", true);
//     $("#password_confirmed").prop("disabled", true);
//     $('#password').hide();
//     $('#password_confirmed').hide();
// }

// function editUser(data) {
//     openModal("Editar Usuario")
//     $("#name").prop("disabled", false);
//     $("#email").prop("disabled", false);
//     $("#password").prop("disabled", false);
//     $("#password_confirmed").prop("disabled", false);
//     $('#name').val(data.name);
//     $('#email').val(data.email);
//     $('#id').val(data.id);
//     $('#sendUserButton').show();
//     $('#password').show();
//     $('#password_confirmed').show();
// }

function createUser(id = null, show = null) {
    if (id == null && show == null) {
        openModal("Crear usuario.");
    }
    if (show == "true") {
        openModal("Ver usuario.");
    }
    if (show == "false") {
        openModal("Editar usuario.");
    }
    url = id == null ? "formUser" : "formUser/" + id + "/" + show;

    $.ajax({
        type: "get",
        url: url,
        success: (data) => {
            $("#adminModalBody").html("");
            $("#adminModalBody").html(data);

            initSelectTwoModal();
        },
        error: (data) => {
            $("#adminModalBody").html("");
            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                onDangerUniqueMessage(data.responseJSON.message);
            }
        },
    });
    return 0;
    // $('#id').val(0);
    // $("#name").prop("disabled", false);
    // $("#email").prop("disabled", false);
    // $("#password").prop("disabled", false);
    // $("#password_confirmed").prop("disabled", false);
    // $('#sendUserButton').show();
}

function deleteUser(id, usua_estado) {
    // $("#" + tr).remove();
    var url = "deleteUser/" + id;
    deleteData(url, "#tbody_user", usua_estado);
}

function sendUser() {
    var id = $("#id").val();

    if (id == "") {
        var validate = $(".form-send-admin-user").valid();
        if (!validate) {
            $(".form-send-admin-user").validate();
            return 0;
        } else {
            var data = $(".form-send-admin-user").serialize();
            $.ajax({
                type: "post",
                url: "saveUser",
                data: data,
                success: (data) => {
                    $("#tbody_user").html("");
                    $("#tbody_user").html(data);
                    resetform();
                    hideModal();
                },
                error: (data) => {
                    if (typeof data.responseJSON.errors == "object") {
                        onFail(data.responseJSON.errors);
                    } else {
                        onDangerUniqueMessage(data.responseJSON.message);
                    }
                },
            });
            return 0;
        }
    } else {
        var data = $(".form-send-admin-user").serialize();
        $.ajax({
            type: "post",
            url: "saveUser",
            data: data,
            success: (data) => {
                $("#tbody_user").html("");
                $("#tbody_user").html(data);
                resetform();
                hideModal();
            },
            error: (data) => {
                if (typeof data.responseJSON.errors == "object") {
                    onFail(data.responseJSON.errors);
                } else {
                    onDangerUniqueMessage(data.responseJSON.message);
                }
            },
        });
        return 0;
    }
    // $(".form-send-admin-user")[0].reset();
}

//------------------------------------CRUD ROLES-----------------------------------------------//
// function showRole(role) {
//     openModal("Ver Role")
//     $('#sendRoleButton').hide();
//     $('#name').val(role.name);
//     $('#guard_name').val(role.guard_name);
//     $("#name").prop("disabled", true);
//     $("#guard_name").prop("disabled", true);
// }

// function editRole(role) {
//     openModal("Editar Role")
//     $("#name").prop("disabled", false);
//     $("#guard_name").prop("disabled", false);
//     $('#name').val(role.name);
//     $('#guard_name').val(role.guard_name);
//     $('#id').val(role.id);
//     $('#sendRoleButton').show();
// }

function createRole(id = null, show = null) {
    if (id == null && show == null) {
        openModal("Crear rol.");
    }
    if (show == "true") {
        openModal("Ver rol.");
    }
    if (show == "false") {
        openModal("Editar rol.");
    }
    url = id == null ? "formRole" : "formRole/" + id + "/" + show;

    $.ajax({
        type: "get",
        url: url,
        success: (data) => {
            $("#adminModalBody").html("");
            $("#adminModalBody").html(data);
            initSelectTwoModal();
        },
        error: (data) => {
            $("#adminModalBody").html("");
            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                onDangerUniqueMessage(data.responseJSON.message);
            }
        },
    });
    return 0;
}

function deleteRole(id, tr) {
    // $("#" + tr).remove();
    var url = "deleteRole/" + id;
    deleteData(url, "#tbody_role");
}

function sendRole() {
    var validate = $(".form-send-admin-role").valid();
    var id = $("#id").val();

    if (id == "") {
        if (!validate) {
            $(".form-send-admin-role").validate();
        } else {
            var data = $(".form-send-admin-role").serialize();
            $.ajax({
                type: "post",
                url: "saveRole",
                data: data,
                success: (data) => {
                    $("#tbody_role").html("");
                    $("#tbody_role").html(data);
                    resetform();
                    hideModal();
                },
                error: (data) => {
                    if (typeof data.responseJSON.errors == "object") {
                        onFail(data.responseJSON.errors);
                    } else {
                        onDangerUniqueMessage(data.responseJSON.message);
                    }
                },
            });
            return 0;
        }
    } else {
        var data = $(".form-send-admin-role").serialize();
        $.ajax({
            type: "post",
            url: "saveRole",
            data: data,
            success: (data) => {
                $("#tbody_role").html("");
                $("#tbody_role").html(data);
                resetform();
                hideModal();
            },
            error: (data) => {
                if (typeof data.responseJSON.errors == "object") {
                    onFail(data.responseJSON.errors);
                } else {
                    onDangerUniqueMessage(data.responseJSON.message);
                }
            },
        });
        return 0;
    }
    // $(".form-send-admin-user")[0].reset();
}
//------------------------------------CRUD PERMISSIONS-------------------------------------------//
// function showPermission(permission) {
//     openModal("Ver Permiso")
//     $('#sendPermissionButton').hide();
//     $('#name').val(permission.name);
//     $('#guard_name').val(permission.guard_name);
//     $("#name").prop("disabled", true);
//     $("#guard_name").prop("disabled", true);
// }

// function editPermission(permission) {
//     openModal("Editar Permiso")
//     console.log('permission', permission);
//     $("#name").prop("disabled", false);
//     $("#guard_name").prop("disabled", false);
//     $('#name').val(permission.name);
//     $('#guard_name').val(permission.guard_name);
//     $('#id').val(permission.id);
//     $('#sendPermissionButton').show();
// }

function createPermission(id = null, show = null) {
    if (id == null && show == null) {
        openModal("Crear permiso.");
    }
    if (show == "true") {
        openModal("Ver permiso.");
    }
    if (show == "false") {
        openModal("Editar permiso.");
    }
    url = id == null ? "formPermission" : "formPermission/" + id + "/" + show;

    $.ajax({
        type: "get",
        url: url,
        success: (data) => {
            $("#adminModalBody").html("");
            $("#adminModalBody").html(data);

            initSelectTwoModal();
        },
        error: (data) => {
            $("#adminModalBody").html("");
            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                onDangerUniqueMessage(data.responseJSON.message);
            }
        },
    });
    return 0;
    // $('#id').val(0);
    // $("#name").prop("disabled", false);
    // $("#guard_name").prop("disabled", false);
    // $('#sendPermissionButton').show();
}

function deletePermission(id, tr) {
    // $("#" + tr).remove();
    var url = "deletePermission/" + id;
    deleteData(url, "#tbody_permission");
}

function sendPermission() {
    var validate = $(".form-send-admin-permission").valid();
    var id = $("#id").val();
    if (id == "") {
        if (!validate) {
            $(".form-send-admin-permission").validate();
        } else {
            var data = $(".form-send-admin-permission").serialize();
            $.ajax({
                type: "post",
                url: "savePermission",
                data: data,
                success: (data) => {
                    {
                        $("#tbody_permission").html("");
                        $("#tbody_permission").html(data);
                        resetform();
                        hideModal();
                    }
                },
                error: (data) => {
                    if (typeof data.responseJSON.errors == "object") {
                        onFail(data.responseJSON.errors);
                    } else {
                        onDangerUniqueMessage(data.responseJSON.message);
                    }
                },
            });
            return 0;
        }
    } else {
        var data = $(".form-send-admin-permission").serialize();
        $.ajax({
            type: "post",
            url: "savePermission",
            data: data,
            success: (data) => {
                {
                    $("#tbody_permission").html("");
                    $("#tbody_permission").html(data);
                    resetform();
                    hideModal();
                }
            },
            error: (data) => {
                if (typeof data.responseJSON.errors == "object") {
                    onFail(data.responseJSON.errors);
                } else {
                    onDangerUniqueMessage(data.responseJSON.message);
                }
            },
        });
        return 0;
    }
    // $(".form-send-admin-user")[0].reset();
}

//---------------------------------CRUD CLIENTES--------------------------------------------------//
function Client(typeProcess, client) {
    var FieldIsDisabled = true;
    //console.log(client);
    if (typeProcess == "Show") {
        $("#sendClientButton").hide();
        openModal("Ver Cliente");
    }
    if (typeProcess == "Edit") {
        $("#sendClientButton").show();
        openModal("Editar Cliente");
        FieldIsDisabled = false;
    }
    if (typeProcess == "Create") {
        $("#sendClientButton").show();
        openModal("Crear Nuevo Cliente");
        FieldIsDisabled = false;
    }

    if (typeProcess == "Create") {
        $("#idPerson").val(0);
        $("#idClient").val(0);
    } else {
        $("#idPerson").val(client.id);
        $("#idClient").val(client.id);
        $("#TipoId").val(client.pers_tipoid);
        $("#idCliente").val(client.id_person);
        $("#rSocial").val(client.pers_razonsocial);
        $("#Apell1").val(client.pers_primerapell);
        $("#Apell2").val(client.pers_segapell);
        $("#Nom1").val(client.pers_primernombre);
        $("#Nom2").val(client.pers_segnombre);
        $("#dir").val(client.pers_direccion);
        $("#tel").val(client.pers_telefono);
        //$('#pais').val(client.pers_pais); no existe aun
        $("#dpto").val(client.pers_dpto);
        showCities();
        $("#ciudad").val(client.pers_ciudad);
        $("#eMail").val(client.pers_email);
        $("#dirCorresp").val(client.clie_dircorresp);
        $("#estado").val(client.pers_estado);
    }

    // Deshabilito los campos
    $("#TipoId").prop("disabled", FieldIsDisabled);
    $("#idCliente").prop("disabled", FieldIsDisabled);
    $("#rSocial").prop("disabled", !FieldIsDisabled);
    $("#Apell1").prop("disabled", FieldIsDisabled);
    $("#Apell2").prop("disabled", FieldIsDisabled);
    $("#Nom1").prop("disabled", FieldIsDisabled);
    $("#Nom2").prop("disabled", FieldIsDisabled);
    $("#dir").prop("disabled", FieldIsDisabled);
    $("#tel").prop("disabled", FieldIsDisabled);
    $("#pais").prop("disabled", FieldIsDisabled);
    $("#dpto").prop("disabled", FieldIsDisabled);
    $("#ciudad").prop("disabled", FieldIsDisabled);
    $("#eMail").prop("disabled", FieldIsDisabled);
    $("#dirCorresp").prop("disabled", FieldIsDisabled);
    $("#estado").prop("disabled", FieldIsDisabled);
}

function showCities() {
    $("#ciudad").html("");
    var stateID = $("#dpto").val();
    if (stateID) {
        $.ajax({
            url: "getCities/" + stateID,
            type: "GET",
            dataType: "json",
            success: function (dataJson) {
                var option = "";
                $.each(dataJson, function (k, v) {
                    option +=
                        "<option value=" +
                        parseInt(v.id) +
                        ">" +
                        v.ciud_nombre +
                        "</option>";
                });
                $("#ciudad").html("");
                $("#ciudad").html(option);
            },
        });
    } else {
        $("#ciudad").html('<option value="">Seleccione Ciudad...</option>');
    }
}

function getNameClient() {
    let idCliente = $("#idCliente").val(); // Obtengo la id del cliente

    if (idCliente) {
        $.ajax({
            url: "showClient/" + idCliente,
            type: "GET",
            dataType: "json",
            success: function (dataJson) {
                if (dataJson.data.length != 0) {
                    $.each(dataJson.data, function (k, v) {
                        $("#rSocial").val(
                            (v.pers_razonsocial || "") +
                                v.pers_primerapell +
                                " " +
                                (v.pers_segapell || "") +
                                " " +
                                v.pers_primernombre +
                                " " +
                                (v.pers_segnombre || "")
                        );
                    });
                } else {
                    $("#rSocial").val("");
                    onDangerUniqueMessage(
                        "Esta identificación no existe en la base de datos"
                    );
                }
            },
            error: (error) => {
                console.log("error", error);
            },
        });
    }
}


//-------------------------------CRUD CONDUCTORES-----------------------------------------------


function Driver(typeProcess, drivers) {
    var FieldIsDisabled = true;
    //console.log(driver);
    if (typeProcess == "Show") {
        $("#sendDriverButton").hide();
        openModal("Ver Driver");
    }
    if (typeProcess == "Edit") {
        $("#sendDriverButton").show();
        openModal("Editar Driver");
        FieldIsDisabled = false;
    }
    if (typeProcess == "Create") {
        $("#sendDriverButton").show();
        openModal("Crear Nuevo Driver");
        FieldIsDisabled = false;
    }

    if (typeProcess == "Create") {
        $("#idPerson").val(0);
        $("#idDriver").val(0);
    } else {
        $("#idPerson").val(drivers.id);
        $("#idDriver").val(drivers.id);
        $("#TipoId").val(drivers.pers_tipoid);
        $("#idDrivers").val(drivers.id_person);
        $("#rSocial").val(drivers.pers_razonsocial);
        $("#Apell1").val(drivers.pers_primerapell);
        $("#Apell2").val(drivers.pers_segapell);
        $("#Nom1").val(drivers.pers_primernombre);
        $("#Nom2").val(drivers.pers_segnombre);
        $("#dir").val(drivers.pers_direccion);
        $("#tel").val(drivers.pers_telefono);
        //$('#pais').val(client.pers_pais); no existe aun
        $("#dpto").val(drivers.pers_dpto);
        showCities();
        $("#ciudad").val(drivers.pers_ciudad);
        $("#eMail").val(drivers.pers_email);
        $("#dirCorresp").val(drivers.driver_dircorresp);
        $("#estado").val(drivers.pers_estado);
    }

    // Deshabilito los campos
    $("#TipoId").prop("disabled", FieldIsDisabled);
    $("#idDrivers").prop("disabled", FieldIsDisabled);
    $("#rSocial").prop("disabled", !FieldIsDisabled);
    $("#Apell1").prop("disabled", FieldIsDisabled);
    $("#Apell2").prop("disabled", FieldIsDisabled);
    $("#Nom1").prop("disabled", FieldIsDisabled);
    $("#Nom2").prop("disabled", FieldIsDisabled);
    $("#dir").prop("disabled", FieldIsDisabled);
    $("#tel").prop("disabled", FieldIsDisabled);
    $("#pais").prop("disabled", FieldIsDisabled);
    $("#dpto").prop("disabled", FieldIsDisabled);
    $("#ciudad").prop("disabled", FieldIsDisabled);
    $("#eMail").prop("disabled", FieldIsDisabled);
    $("#dirCorresp").prop("disabled", FieldIsDisabled);
    $("#estado").prop("disabled", FieldIsDisabled);
}

function showCities() {
    $("#ciudad").html("");
    var stateID = $("#dpto").val();
    if (stateID) {
        $.ajax({
            url: "getCities/" + stateID,
            type: "GET",
            dataType: "json",
            success: function (dataJson) {
                var option = "";
                $.each(dataJson, function (k, v) {
                    option +=
                        "<option value=" +
                        parseInt(v.id) +
                        ">" +
                        v.ciud_nombre +
                        "</option>";
                });
                $("#ciudad").html("");
                $("#ciudad").html(option);
            },
        });
    } else {
        $("#ciudad").html('<option value="">Seleccione Ciudad...</option>');
    }
}
/*
function getNameClient() {
    let idDrivers = $("#idDrivers").val(); // Obtengo la id del conductor

    if (idDrivers) {
        $.ajax({
            url: "showDriver/" + idDrivers,
            type: "GET",
            dataType: "json",
            success: function (dataJson) {
                if (dataJson.data.length != 0) {
                    $.each(dataJson.data, function (k, v) {
                        $("#rSocial").val(
                            (v.pers_razonsocial || "") +
                                v.pers_primerapell +
                                " " +
                                (v.pers_segapell || "") +
                                " " +
                                v.pers_primernombre +
                                " " +
                                (v.pers_segnombre || "")
                        );
                    });
                } else {
                    $("#rSocial").val("");
                    onDangerUniqueMessage(
                        "Esta identificación no existe en la base de datos"
                    );
                }
            },
            error: (error) => {
                console.log("error", error);
            },
        });
    }
}
*/


//---------------------------------CRUD PROVEEDORES----------------------------------------------//
function Supplier(typeProcess, data) {
    var FieldIsDisabled = true;

    if (typeProcess == "Show") {
        $("#sendSupplierButton").hide();
        openModal("Ver Proveedor");
    }
    if (typeProcess == "Edit") {
        $("#sendSupplierButton").show();
        openModal("Editar Proveedor");
        FieldIsDisabled = false;
    }
    if (typeProcess == "Create") {
        $("#sendSupplierButton").show();
        openModal("Crear Nuevo Proveedor");
        FieldIsDisabled = false;
    }

    if (typeProcess == "Create") {
        $("#id").val(0);
    } else {
        $("#id").val(data.id);
        $("#idPerson").val(data.idPerson);
        $("#TipoId").val(data.pers_tipoid);
        $("#idProv").val(data.prov_identif);
        $("#rSocial").val(data.pers_razonsocial);
        $("#Apell1").val(data.pers_primerapell);
        $("#Apell2").val(data.pers_segapell);
        $("#Nom1").val(data.pers_primernombre);
        $("#Nom2").val(data.pers_segnombre);
        $("#dir").val(data.pers_direccion);
        $("#tel").val(data.pers_telefono);
        //$('#pais').val(client.pers_pais); no existe aun
        $("#dpto").val(data.pers_dpto);
        showCities();
        $("#ciudad").val(data.pers_ciudad);
        $("#eMail").val(data.pers_email);
        $("#codActEcon").val(data.prov_codactividad);
        $("#estado").val(data.prov_estado);
    }

    // Deshabilito los campos
    $("#TipoId").prop("disabled", FieldIsDisabled);
    $("#idProv").prop("disabled", FieldIsDisabled);
    $("#rSocial").prop("disabled", true);
    $("#Apell1").prop("disabled", FieldIsDisabled);
    $("#Apell2").prop("disabled", FieldIsDisabled);
    $("#Nom1").prop("disabled", FieldIsDisabled);
    $("#Nom2").prop("disabled", FieldIsDisabled);
    $("#dir").prop("disabled", FieldIsDisabled);
    $("#tel").prop("disabled", FieldIsDisabled);
    $("#pais").prop("disabled", FieldIsDisabled);
    $("#dpto").prop("disabled", FieldIsDisabled);
    $("#ciudad").prop("disabled", FieldIsDisabled);
    $("#eMail").prop("disabled", FieldIsDisabled);
    $("#codActEcon").prop("disabled", FieldIsDisabled);
    $("#estado").prop("disabled", FieldIsDisabled);
}

//---------------------------------CRUD SOCIEDADES----------------------------------------------//
function showSociety(data) {
    openModal("Ver Sociedad");
    $("#sendSocietyButton").hide();
    $("#id").val(data.soci_id);
    $("#TipoId").val(data.pers_tipoid);
    $("#idSoc").val(data.soci_identif);
    $("#rSocial").val(data.pers_razonsocial);
    $("#Apell1").val(data.pers_primerapell);
    $("#Apell2").val(data.pers_segapell);
    $("#Nom1").val(data.pers_primernombre);
    $("#Nom2").val(data.pers_segnombre);
    $("#dir").val(data.pers_direccion);
    $("#tel").val(data.pers_telefono);
    $("#logoSociety").val(data.soci_nombrelogo);
    //$('#pais').val(client.pers_pais); no existe aun
    $("#dpto").val(data.pers_dpto);
    showCities();
    $("#ciudad").val(data.pers_ciudad);
    $("#eMail").val(data.pers_email);
    $("#estado").val(data.soci_estado);
    // Deshabilito los campos
    $("#TipoId").prop("disabled", true);
    $("#idSoc").prop("disabled", true);
    $("#rSocial").prop("disabled", true);
    $("#Apell1").prop("disabled", true);
    $("#Apell2").prop("disabled", true);
    $("#Nom1").prop("disabled", true);
    $("#Nom2").prop("disabled", true);
    $("#dir").prop("disabled", true);
    $("#tel").prop("disabled", true);
    $("#logoSociety").prop("disabled", true);
    $("#pais").prop("disabled", true);
    $("#dpto").prop("disabled", true);
    $("#ciudad").prop("disabled", true);
    $("#eMail").prop("disabled", true);
    $("#estado").prop("disabled", true);
}

function editSociety(data) {
    openModal("Editar Sociedad");
    $("#sendSocietyButton").hide();
    $("#id").val(data.soci_id);
    $("#TipoId").val(data.pers_tipoid);
    $("#idSoc").val(data.soci_identif);
    $("#rSocial").val(data.pers_razonsocial);
    $("#Apell1").val(data.pers_primerapell);
    $("#Apell2").val(data.pers_segapell);
    $("#Nom1").val(data.pers_primernombre);
    $("#Nom2").val(data.pers_segnombre);
    $("#dir").val(data.pers_direccion);
    $("#tel").val(data.pers_telefono);
    $("#logoSociety").val(data.soci_nombrelogo);
    //$('#pais').val(client.pers_pais); no existe aun
    $("#dpto").val(data.pers_dpto);
    showCities();
    $("#ciudad").val(data.pers_ciudad);
    $("#eMail").val(data.pers_email);
    $("#estado").val(data.soci_estado);
    // Deshabilito los campos
    $("#TipoId").prop("disabled", false);
    $("#idSoc").prop("disabled", false);
    $("#rSocial").prop("disabled", false);
    $("#Apell1").prop("disabled", false);
    $("#Apell2").prop("disabled", false);
    $("#Nom1").prop("disabled", false);
    $("#Nom2").prop("disabled", false);
    $("#dir").prop("disabled", false);
    $("#tel").prop("disabled", false);
    $("#logoSociety").prop("disabled", false);
    $("#pais").prop("disabled", false);
    $("#dpto").prop("disabled", false);
    $("#ciudad").prop("disabled", false);
    $("#eMail").prop("disabled", false);
    $("#estado").prop("disabled", false);
}

//---------------------------------CRUD OBRAS----------------------------------------------//
function Construction(typeProcess, data) {
    var FieldIsDisabled = true;

    if (typeProcess == "Show") {
        $("#sendConstructionButton").hide();
        openModal("Ver Obra");
    }
    if (typeProcess == "Edit") {
        $("#sendConstructionButton").show();
        openModal("Editar Obra");
        FieldIsDisabled = false;
    }
    if (typeProcess == "Create") {
        $("#sendConstructionButton").show();
        openModal("Crear Obra");
        FieldIsDisabled = false;
    }

    if (typeProcess == "Create") {
        $("#id").val(0);
    } else {
        $("#id").val(data.id);
        $("#idCliente").val(data.obra_idcliente);
        $("#rSocial").val(
            (data.pers_razonsocial || "") +
                data.pers_primerapell +
                " " +
                (data.pers_segapell || "") +
                " " +
                data.pers_primernombre +
                " " +
                (data.pers_segnombre || "")
        );
        $("#nombreObra").val(data.obra_nombre);
        $("#dir").val(data.obra_direccion);
        //$('#pais').val(client.pers_pais); no existe aun
        $("#dpto").val(data.obra_dpto);
        showCities();
        $("#ciudad").val(data.obra_ciudad);
        $("#porcSuministro").val(data.obra_porcsuministro);
        $("#porcTransporte").val(data.obra_porctransporte);
        $("#obs").val(data.obra_obs);
        $("#estado").val(data.obra_estado);
    }
    // Deshabilito los campos
    $("#idCliente").prop("disabled", FieldIsDisabled);
    $("#nombreObra").prop("disabled", FieldIsDisabled);
    $("#dir").prop("disabled", FieldIsDisabled);
    $("#pais").prop("disabled", FieldIsDisabled);
    $("#dpto").prop("disabled", FieldIsDisabled);
    $("#ciudad").prop("disabled", FieldIsDisabled);
    $("#porcSuministro").prop("disabled", FieldIsDisabled);
    $("#porcTransporte").prop("disabled", FieldIsDisabled);
    $("#obs").prop("disabled", FieldIsDisabled);
    $("#estado").prop("disabled", FieldIsDisabled);
}

function getDataObra() {
    let idObra = $("#idObra").val(); // Obtengo la id de obra

    if (idObra != 0) {
        $.ajax({
            url: "showConstruction/" + idObra,
            type: "GET",
            dataType: "json",
            success: function (dataJson) {
                if (dataJson.data) {
                    var option = "";

                    if (dataJson.materials.length > 0) {
                        $.each(dataJson.materials, function (k, v) {
                            // console.log(v.material.mate_descripcion)
                            option +=
                                '<option value="' +
                                v.id_material +
                                '">' +
                                v.material.mate_descripcion +
                                "</option>";
                        });
                        $("#idMat").html("");
                        $("#idMat").append(option);
                    } else {
                        onDangerUniqueMessage(
                            "La obra seleccionada, no poseé productos asociados a ella, por favor ingresarlos en la lista de precios"
                        );
                    }

                    $.each(dataJson.data, function (k, v) {
                        $("#nombreObra").val(v.obra_nombre ?? "");
                        $("#idCliente").val(v.obra_idcliente ?? "");
                        $("#identCliente").val(v.pers_identif ?? "");
                        // v.pers_razonsocial
                        $("#nombreCliente").val(
                            v.pers_primerapell ??
                                "" +
                                    " " +
                                    (v.pers_segapell || "") +
                                    " " +
                                    v.pers_primernombre ??
                                "" + " " + (v.pers_segnombre || "")
                        );
                    });
                } else {
                    $("#nombreObra").val("");
                    $("#idCliente").val("");
                    $("#identCliente").val("");
                    $("#nombreCliente").val("");
                    onDangerUniqueMessage(
                        "Esta id. de obra no existe en la base de datos"
                    );
                }
            },
            error: (error) => {
                console.log("error", error);
            },
        });
    }
}

//--------------------------------------CRUD MATERIALES----------------------------------------------//
function Material(typeProcess, data) {
    var FieldIsDisabled = true;

    if (typeProcess == "Show") {
        $("#sendMaterialButton").hide();
        openModal("Ver Material");
    }
    if (typeProcess == "Edit") {
        $("#sendMaterialButton").show();
        openModal("Editar Material");
        FieldIsDisabled = false;
    }
    if (typeProcess == "Create") {
        $("#sendMaterialButton").show();
        openModal("Crear Material");
        FieldIsDisabled = false;
    }

    if (typeProcess == "Create") {
        $("#id").val(0);
    } else {
        $("#id").val(data.id);
        $("#cod").val(data.mate_codigo);
        // $("#clasif").val(data.mate_clasificacion);
        $("#descr").val(data.mate_descripcion);
    }

    // Deshabilito los campos
    $("#cod").prop("disabled", FieldIsDisabled);
    $("#clasif").prop("disabled", FieldIsDisabled);
    $("#descr").prop("disabled", FieldIsDisabled);
    $("#estado").prop("disabled", FieldIsDisabled);
}

//--------------------------------------CRUD MATERIAS PRIMAS----------------------------------------------//
function showCommodity(data) {
    openModal("Ver Materia Prima");
    $("#sendCommodityButton").hide();
    $("#id").val(data.matp_id);
    $("#descr").val(data.matp_descripcion);
    $("#estado").val(data.matp_estado);
    // Deshabilito los campos
    $("#descr").prop("disabled", true);
    $("#estado").prop("disabled", true);
}

//--------------------------------------CRUD DISPOSITIVOS----------------------------------------------//
function showDevice(data) {
    openModal("Ver Dispositivo");
    $("#sendDeviceButton").hide();
    $("#id").val(data.disp_id);
    $("#descr").val(data.disp_descripcion);
    $("#estado").val(data.disp_estado);
    // Deshabilito los campos
    $("#descr").prop("disabled", true);
    $("#estado").prop("disabled", true);
}

//Roles permisos.

function createRolePermission(
    permission_id = null,
    role_id = null,
    show = null
) {
    if (role_id == null && permission_id == null && show == null) {
        openModal("Asociar de usuario con rol.");
    }
    if (show == "true") {
        openModal("Ver Asociación de usuario con rol.");
    }
    if (show == "false") {
        openModal("Editar Asociación de usuario con rol.");
    }
    url =
        role_id == null && permission_id == null
            ? "formRolPermission"
            : "formRolPermission/" + permission_id + "/" + role_id + "/" + show;

    $.ajax({
        type: "get",
        url: url,
        success: (data) => {
            $("#adminModalBody").html("");
            $("#adminModalBody").html(data);
            if (show) {
                $("#sendRolePermissionButton").remove();
            } else {
                initSelectTwoModal();
            }
        },
        error: (data) => {
            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                onDangerUniqueMessage(data.responseJSON.message);
            }
        },
    });
    return 0;
}

function sendRolePermission() {
    var data = $(".form-send-role-permission").serialize();
    $.ajax({
        type: "post",
        url: "saveRolPermission",
        data: data,
        success: (data) => {
            $("#tbody_rolePermisions").html("");
            $("#tbody_rolePermisions").html(data);
            // $("#adminModal").modal("hide");
            hideModal();
        },
        error: (data) => {
            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                onDangerUniqueMessage(data.responseJSON.message);
            }
        },
    });
    return 0;
}
function deleteRolePermission(id_role, id_permission, idTr) {
    // $("#" + idTr).remove();
    var url = "deleteRolPermission/" + id_role + "/" + id_permission;
    deleteData(url);
}
// Usuario rol
function createUserRole(role_id = null, model_id = null, show = null) {
    if (show == true) {
        openModal("Ver Asociación de usuario con rol.");
    }

    if (role_id == null && model_id == null && show == null) {
        openModal("Asociar de usuario con rol.");
    }

    if (show == false) {
        openModal("Editar Asociación de usuario con rol.");
    }
    url =
        role_id == null && model_id == null
            ? "formUserRol"
            : "formUserRol/" + role_id + "/" + model_id + "/" + show;
    console.log("url", url);
    $.ajax({
        type: "get",
        url: url,
        success: (data) => {
            $("#adminModalBody").html("");
            $("#adminModalBody").html(data);
            if (show) {
                $("#sendUserRoleButton").remove();
                openModal("Ver Asociación de usuario con rol.");
                $("#id_user_asoc").prop("disabled", true);
                $("#id_role_asoc").prop("disabled", true);
            } else {
                initSelectTwoModal();
            }

            // $("#adminModalBody").modal("hide");
        },
        error: (data) => {
            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                onDangerUniqueMessage(data.responseJSON.message);
            }
        },
    });
    return 0;
}
function sendUserRole() {
    var data = $(".form-send-user-rol").serialize();
    $.ajax({
        type: "post",
        url: "saveUserRol",
        data: data,
        success: (data) => {
            $("#tbody_userRole").html("");
            $("#tbody_userRole").html(data);
            $("#adminModal").modal("hide");
            hideModal();
        },
        error: (data) => {
            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                onDangerUniqueMessage(data.responseJSON.message);
            }
        },
    });
    return 0;
}

function deleteUserRole(id_user, id_rol, idTr) {
    // $("#" + idTr).remove();
    var url = "deleteUserRol/" + id_user + "/" + id_rol;
    deleteData(url);
}

//--------------------------------------CRUD MAQUINAS----------------------------------------------//
function Machine(typeProcess, data) {
    var FieldIsDisabled = true;

    if (typeProcess == "Show") {
        $("#sendMachineButton").hide();
        openModal("Ver Máquina");
    }
    if (typeProcess == "Edit") {
        $("#sendMachineButton").show();
        openModal("Editar Máquina");
        FieldIsDisabled = false;
    }
    if (typeProcess == "Create") {
        $("#sendMachineButton").show();
        openModal("Crear Máquina");
        FieldIsDisabled = false;
    }

    if (typeProcess == "Create") {
        $("#id").val(0);
    } else {
        $("#id").val(data.id);
        $("#placa").val(data.maqn_placa);
        $("#tipo").val(data.maqn_tipo);
        $("#cubicaje").val(data.maqn_cubicaje);
        $("#unidad").val(data.maqn_idunidad);
        $("#obs").val(data.maqn_obs);
        $("#estado").val(data.maqn_estado);
    }

    // Deshabilito los campos
    $("#placa").prop("disabled", FieldIsDisabled);
    $("#tipo").prop("disabled", FieldIsDisabled);
    $("#cubicaje").prop("disabled", FieldIsDisabled);
    $("#unidad").prop("disabled", FieldIsDisabled);
    $("#obs").prop("disabled", FieldIsDisabled);
    $("#estado").prop("disabled", FieldIsDisabled);
}

//--------------------------------------CRUD TIPOS DE MAQUINAS----------------------------------------------//
function showMachineType(data) {
    openModal("Ver Tipo de Máquina");
    $("#sendMachineTypeButton").hide();
    $("#id").val(data.tmaq_id);
    $("#nombre").val(data.tmaq_nombre);
    $("#estado").val(data.tmaq_estado);
    // Deshabilito los campos
    $("#nombre").prop("disabled", true);
    $("#estado").prop("disabled", true);
}

//--------------------------------------CRUD OBS DE MAQUINAS----------------------------------------//
function showMachineObs(data) {
    openModal("Ver Observación");
    $("#sendMachineObsButton").hide();
    $("#id").val(data.id);
    $("#IdMaq").val(data.mqdt_idmaquina);
    $("#placa").val(data.maqn_placa);
    $("#fecha").val(data.mqdt_fecha);
    $("#obs").val(data.mqdt_obs);
    $("#estado").val(data.mqdt_estado);
    // Deshabilito los campos
    $("#IdMaq").prop("disabled", true);
    $("#placa").prop("disabled", true);
    $("#fecha").prop("disabled", true);
    $("#obs").prop("disabled", true);
    $("#estado").prop("disabled", true);
}

//--------------------------------------CRUD CONC DE PAGOS----------------------------------------//
function showConceptPayment(data) {
    openModal("Ver Concepto de Pago");
    $("#sendConceptPaymentButton").hide();
    $("#id").val(data.cncp_id);
    $("#nombre").val(data.cncp_nombre);
    $("#estado").val(data.cncp_estado);
    // Deshabilito los campos
    $("#nombre").prop("disabled", true);
    $("#estado").prop("disabled", true);
}

//--------------------------------------CRUD MOV. DE MAQUINAS----------------------------------------//
function showMachineMov(data) {
    openModal("Ver Movimiento de Máquina");
    // $('#sendMachineMovButton').hide();
    $("#id").val(data.mqmv_id);
    $("#idMaq").val(data.mqmv_idmaquina);
    $("#fInicio").val(data.mqmv_finicio);
    $("#fFin").val(data.mqmv_ffin);
    $("#obs").val(data.mqmv_obs);
    $("#vlrHora").val(new Intl.NumberFormat("es-MX").format(data.mqmv_vlrhora)); // Doy formato al numero
    $("#estado").val(data.mqmv_estado);
    openModal("Ver Movimiento de Máquina");
    // $('#sendMachineMovButton').hide();
    $("#id").val(data.mqmv_id);
    $("#idMaq").val(data.mqmv_idmaquina);
    $("#fInicio").val(data.mqmv_finicio);
    $("#fFin").val(data.mqmv_ffin);
    $("#obs").val(data.mqmv_obs);
    $("#vlrHora").val(new Intl.NumberFormat("es-MX").format(data.mqmv_vlrhora)); // Doy formato al numero
    $("#estado").val(data.mqmv_estado);
    // Deshabilito los campos
    $("#idMaq").prop("disabled", true);
    $("#fInicio").prop("disabled", true);
    $("#fFin").prop("disabled", true);
    $("#obs").prop("disabled", true);
    $("#vlrHora").prop("disabled", true);
    $("#estado").prop("disabled", true);
}

//--------------------------------------CRUD REMISIONES----------------------------------------//
function Remission(typeProcess, remission, detail) {
    var FieldIsDisabled = true;

    if (typeProcess == "Show") {
        $("#sendRemissionButton").hide();
        openModal("Ver Detalle de Remisión No. " + remission.id);
        $("#id").val(remission.id);
        $("#detail").hide();
        $("#addDetailButton").hide();
    }
    if (typeProcess == "Edit") {
        $("#sendRemissionButton").show();
        openModal("Editar Remisión No. " + remission.id);
        FieldIsDisabled = false;
        $("#id").val(remission.id);
        $("#detail").hide();
        $("#addDetailButton").hide();
    }
    if (typeProcess == "Create") {
        $("#sendRemissionButton").show();
        openModal("Crear Remisión");
        FieldIsDisabled = false;
        $("#id").val(0);
        $("#detail").show();
        $("#addDetailButton").show();

        //let detRemission = []; // Arreglo para el detalle de remision
    }
    if (typeProcess != "Create") {
        $("#idObra").val(remission.id_obra);
        $("#nombreObra").val(remission.obra_nombre);
        $("#idSoc").val(remission.id_society);
        $("#nombrePers").val(
            (remission.rsoc || "") +
                remission.ap1 +
                " " +
                (remission.ap2 || "") +
                " " +
                remission.nom1 +
                " " +
                (remission.nom2 || "")
        );
        $("#idCliente").val(remission.obra_idcliente);
        $("#nombreCliente").val(
            (remission.pers_razonsocial || "") +
                (remission.pers_primerapell || "") +
                " " +
                (remission.pers_segapell || "") +
                " " +
                (remission.pers_primernombre || "") +
                " " +
                (remission.pers_segnombre || "")
        );
        $("#fecha").val(remission.remi_fecha);
        $("#numFac").val(remission.remi_numfactura);
        $("#obs").val(remission.remi_obs);
        $("#estado").val(remission.remi_estado);
    }

    // Lleno la tabla detalle
    const CONTENEDOR = document.querySelector("tbody");
    const FOOT = document.querySelector("tfoot");
    CONTENEDOR.innerHTML = "";
    if (typeProcess != "Create") {
        let result = "";
        let SumaPrecio = 0;
        CONTENEDOR.innerHTML = "";

        $(detail).each(function (index, el) {
            SumaPrecio = SumaPrecio + el.dtrm_precio * el.dtrm_cantdespachada;
            result += `<tr>
                            <td>${el.dtrm_idmaterial}</td>
                            <td>${el.mate_descripcion}</td>
                            <td>${new Intl.NumberFormat("es-MX").format(
                                el.dtrm_cantdespachada
                            )}</td>
                            <td>${el.unit_sigla}</td>
                            <td>${new Intl.NumberFormat("es-MX").format(
                                el.dtrm_precio
                            )}</td>
                            <td>${new Intl.NumberFormat("es-MX").format(
                                el.dtrm_precio * el.dtrm_cantdespachada
                            )}</td>
                            <td class="text-danger"><i class="fas fa-trash"></i></td>
                        </tr>`;
        });

        let resumen = `<tr>
                            <td colspan="5"><strong>Total Remisión</strong></td>
                            <td colspan="1"><strong>${new Intl.NumberFormat(
                                "es-MX"
                            ).format(SumaPrecio)}</strong></td>
                            <td colspan="1"><strong> </strong></td>
                        </tr>`;

        CONTENEDOR.innerHTML = result;
        FOOT.innerHTML = resumen;
    } else {
        CONTENEDOR.innerHTML = "";
        let SumaPrecio = 0;
        let resumen = `<tr>
                            <td colspan="5"><strong>Total Remisión</strong></td>
                            <td colspan="1" id="summary"><strong>${new Intl.NumberFormat(
                                "es-MX"
                            ).format(SumaPrecio)}</strong></td>
                            <td colspan="1"><strong> </strong></td>
                        </tr>`;
        FOOT.innerHTML = resumen;
    }

    // Des/habilito los campos
    $("#idObra").prop("disabled", FieldIsDisabled);
    $("#nombreObra").prop("disabled", true);
    $("#idSoc").prop("disabled", FieldIsDisabled);
    $("#nombreSoc").prop("disabled", true);
    $("#idCliente").prop("disabled", true);
    $("#nombreCliente").prop("disabled", true);
    $("#fecha").prop("disabled", FieldIsDisabled);
    $("#numFac").prop("disabled", true);
    $("#obs").prop("disabled", FieldIsDisabled);
    $("#estado").prop("disabled", FieldIsDisabled);
}

var count = 0;

function addDetail() {
    var idObra = $("#idObra").val();
    var idMat = $("#idMat").val();

    var lengthTr =$("#tbody_remissiondet tbody tr").length

    if (count == 1 && lengthTr ==1) {
        alertDanger("Solo se puede agregar un producto");
        return 0;
    }
    var data = {
        id_obra: idObra,
        id_material: idMat,
        count: count++,
    };

    $.ajax({
        type: "get",
        url: "remission",
        data: data,
        success: (data) => {
            $("#tbody_remissiondet").append(data);
        },
        error: (data) => {
            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                onDangerUniqueMessage(data.responseJSON.message);
            }
        },
    }).done(function (data) {
        // var cont_fila = ($('#tbody_remissiondet').find('tr').length);
        // var total_general = 0;
        // for (var i = 0; i < cont_fila + 1; i++) {
        //     var subtotal = $('#subt_' + i).val();
        //     if (subtotal != undefined) {
        //         total_general = parseFloat(total_general) + parseFloat(subtotal);
        //     }
        // }
        // $('#totalRemission').val((total_general * 1).toFixed(2));
        // $("#summary").text((total_general * 1).toFixed(2));
    });

    // count ++;
    return 0;
    // }
}

// function calcSubt(quantity, price, subtotal) {

//     alert();
//     $.ajax({
//         type: "get",
//         url: "remission",
//         data: data,
//         success: (data) => {
//             $("#tbody_remissiondet").append(data);
//         },
//         error: (data) => {
//             if (typeof data.responseJSON.errors == "object") {
//                 onFail(data.responseJSON.errors);
//             } else {
//                 onDangerUniqueMessage(data.responseJSON.message);
//             }
//         },
//     }).done(function (data) {});

//     $count = count + 1;
//     return 0;
//     // }
// }

function calcSubt(quantity, price, subtotal, count) {

    let subTotal = 0;
    var porcTrans = $("#obra_porctransporte_" + count).val();
    var porcSum = $("#obra_porcsuministro_" + count).val();

    m1 = $("#" + quantity).val();
    m1 =  m1<0? m1 *-1: m1;
    $("#" + quantity).val(m1);

    var quantityValidate = parseInt(m1);

    if(cubitaje < quantityValidate){
        alertDanger("El cubitaje permitido para este vehiculo es de "+cubitaje+" mc y se está ingresando "+ quantityValidate +" mc");
    }

    m2 = $("#" + price).val();
    m1 = $("#" + quantity).val();
    subTotal = m1 * m2;
    $("#" + subtotal).val(subTotal);
    // m2 = $("#" + price).val();

    var transporte = (m2 * porcTrans) / 100;
    $("#transporte_" + count).val(transporte);

    var suministro = (m2 * porcSum) / 100;
    $("#suministro_" + count).val(suministro);

    var iva = $("#iva_" + count).val();

    var valor_iva = (m2  * iva) / 100;
    $("#valor_iva_" + count).val(valor_iva);



    subTotal = parseInt(m1) * (parseInt(m2) + parseInt(valor_iva));
    $("#" + subtotal).val(subTotal);

    // var cont_fila = $("#tbody_remissiondet").find("tr").length;

    var total_general = 0;
    for (var i = 0; i < count + 1; i++) {
        var subtotal = $("#subt_" + i).val();

        if (subtotal != undefined) {
            total_general = parseFloat(total_general) + parseFloat(subtotal);
        }
    }
    $("#totalRemission").val(total_general * 1);
    // $("#summary").text((total_general * 1));
}

//-------------------CRUD CONC. NOVEDADES DE REMISIONES----------------------//
function showConceptNovelty(data) {
    openModal("Ver Concepto");
    $("#sendConceptNoveltyButton").hide();
    $("#id").val(data.id);
    $("#nombre").val(data.cncn_nombre);
    $("#estado").val(data.cncn_estado);
    // Deshabilito los campos
    $("#nombre").prop("disabled", true);
    $("#estado").prop("disabled", true);
}

//-------------------CRUD NOVEDADES DE REMISIONES----------------------//
function showRemissionNovelty(data) {
    openModal("Ver Novedad");
    $("#sendRemissionNoveltyButton").hide();
    $("#id").val(data.id);
    $("#idRemision").val(data.rmnv_idremision);
    $("#cncNov").val(data.rmnv_idconcepto);
    $("#material").val(data.rmnv_idmaterial);
    $("#newVlr").val(data.rmnv_nuevovalor);
    $("#obs").val(data.rmnv_obs);
    $("#fecha").val(data.rmnv_fecha);
    $("#estado").val(data.rmnv_estado);
    // Deshabilito los campos
    $("#idRemision").prop("disabled", true);
    $("#cncNov").prop("disabled", true);
    $("#material").prop("disabled", true);
    $("#newVlr").prop("disabled", true);
    $("#obs").prop("disabled", true);
    $("#fecha").prop("disabled", true);
    $("#estado").prop("disabled", true);
}

// Obtener los datos de una persona mediante su identif.
function getDataPerson() {
    var idSociety = $("#idSoc").val();

    if (idSociety != 0) {
        $.ajax({
            url: "showPerson/" + idSociety,
            type: "GET",
            dataType: "json",
            success: function (dataJson) {
                if (dataJson.data) {
                    if (dataJson.data.person.pers_razonsocial != null) {
                        $("#nombreSoc").val(
                            dataJson.data.person.pers_razonsocial
                        );
                        $(".numRem").val(
                            dataJson.data.society.prefix ?? ""
                        );
                        // $("#prefix").val(dataJson.data.society.prefix ?? "");
                    } else {
                        console.log("2");
                        var razon =
                            dataJson.data.person.pers_primerapell ??
                            "" +
                                " " +
                                (dataJson.data.person.pers_segapell || "") +
                                " " +
                                dataJson.data.person.pers_primernombre ??
                            "" +
                                " " +
                                (dataJson.data.person.pers_segnombre || "");
                        $("#nombreSoc").val(razon);
                        $(".numRem").val(
                            dataJson.data.society.prefix ?? ""
                        );
                    }
                } else {
                    $("#nombrePers").val("");

                    onDangerUniqueMessage(
                        "Esta identificación no existe en la base de datos"
                    );
                }
            },
            error: (error) => {
                $("#nombreSoc").val('');
                $(".numRem").val('' );
                $(".numRem").val('');
                swal({
                    title: "Aviso!",
                    text: "Está sociedad no está relacionada a una persona, por lo cual no poseé información.",
                    icon: "info",
                });

            },
        });
    } else {
        $(".numRem").val("");
    }
}

function sendRemission() {
    data = $(".form-send-remission").serialize();
    $.ajax({
        type: "post",
        url: "saveRemission",
        data: data,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: (data) => {
            console.log("post", data);
        },
        error: (data) => {
            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                onDangerUniqueMessage(data.responseJSON.message);
            }
        },
    });
    return 0;
}

function removeRemissionItem(trRemission) {
    count = 0;
    $("#" + trRemission).remove();
    var cont_fila = $("#tbody_remissiondet").find("tr").length;
    var total_general = 0;
    for (var i = 0; i < cont_fila + 1; i++) {
        var subtotal = $("#subt_" + i).val();

        if (subtotal != undefined) {
            total_general = parseFloat(total_general) + parseFloat(subtotal);
        }
    }

    $("#summary").text((total_general * 1).toFixed(2));
}

function getPriceList() {
    let idObra = $("#idObra").val(); // Obtengo la id de la obra
    let idMaterial = $("#idMat").val(); // Obtengo la id del material seleccionado

    if (idObra) {
        $.ajax({
            url: "getPriceList/" + idObra + "/" + idMaterial,
            type: "GET",
            dataType: "json",
            success: function (dataJson) {
                //if (dataJson.data.length != 0) {

                $("#punit").val(dataJson.precio || 0); // Muestro el valor unitario del material
                $("#unidad").val(dataJson.id_unmedida || 0); // Muestro la unidad de medida

                /*} else {
                    $('#rSocial').val('');
                    onDangerUniqueMessage('Esta identificación no existe en la base de datos')
                }*/
            },
            error: (error) => {
                console.log("error", error);
            },
        });
    }
}
function modalPermission(permissions, titulo) {
    $("#adminModal").modal("show");
    $("#btnModalGeneral").remove();
    var span = "";
    console.log("permissions", permissions);
    $.each(permissions, function (index, value) {
        span +=
            ' <span class="right badge badge-primary mt-2">' +
            value.name +
            "</span>";
    });
    var spanEnd =
        span +
        "<br><br><button type='button' class='btn btn-danger text-white' data-dismiss='modal' id='closeModalGeneral' onclick='closeodalGeneral()'>Cerrar</button>";
    $("#modalTitle").html(titulo);
    $("#adminModalBody").html("");
    $("#adminModalBody").append(spanEnd);
}

function closeodalGeneral() {
    $("#adminModal").modal("hide");
}
