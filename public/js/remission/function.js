$(document).ready(function () {
    initDataTableRemission();
});

var dataTableRemission = null;
function initDataTableRemission() {
    dataTableRemission = $("#table-remission").DataTable({
        language: {
            url:BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json",
        },
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        bDestroy: true,
        processing: true,
        bSort: true,
        scrollY: 450,
        order: [[0, "desc"]],
        // iDisplayLength: 8,
    });
}

// Metodo para guardar remision y su detalle
function saveRemission() {
    let id = document.getElementById("id").value;
    var data = $(".form-send-remission").serialize();
    url = id == 0 ? "saveRemission" : "updateRemission/" + id;
    var idObra = $("#idObra").val();
    var idSoc = $("#idSoc").val();

    if (count == 0) {
        console.log("ingreso");
        swal({
            title: "Aviso!",
            text: "La remisión debe tener un material agregado, para poderse guardarse.",
            icon: "info",
        });

        return 0;
    }

    if (idObra != 0 && idSoc != 0) {
        console.log("i_obra, idsoc");
        $.ajax({
            type: "post",
            url: url,
            data: data,
            headers: {
                "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content"),
            },
            success: (data) => {
                hideModal();
                // Llega aca y la pego
                $("#tbody_remission").html("");
                $("#tbody_remission").html(data);

                alertSuccess();
                cubitaje = 0;
                count = 0;
                $(".selection").remove();
                initSelect();
            },
            error: (data) => {
                console.log("Hubo error");
                if (typeof data.responseJSON.errors == "object") {
                    onFail(data.responseJSON.errors);
                } else {
                    alertDanger(data.responseJSON.message);
                    // onDangerUniqueMessage(data.responseJSON.message)
                }
            },
        });
    } else {
        alertDanger("Recuerda diligenciar los campos de obra y sociedad");
    }

    return 0;
}

//Metodo de eliminar
function deleteRemission(id) {
    swal({
        title: "¿Estás seguro?",
        text: "¡Se cambiará el estado de la remisión!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sí Anular!",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        console.log(result);
        if (result) {
            $.ajax({
                type: "get",
                url: "deleteRemission/" + id,
                success: (data) => {
                    $("#tbody_remission").html("");
                    $("#tbody_remission").html(data);
                    swal({
                        title: "Anulado!",
                        text: "Se ha anulado con éxito",
                        icon: "success",
                    });
                },
                error: (data) => {
                    alertDanger();
                    if (typeof data.responseJSON.errors == "object") {
                        onFail(data.responseJSON.errors);
                    } else {
                        onDangerUniqueMessage(data.responseJSON.message);
                    }
                },
            });
            return 0;
        }
    });
}

function createRemission(id_remission = null, show = null) {
    if (id_remission == null && show == null) {
        openModal("Crear remisión.");
    }
    if (show == true) {
        openModal("Ver remisión.");
    }
    if (show == false) {
        openModal("Editar remisión.");
    }
    url =
        id_remission == null
            ? "formRemission"
            : "formRemission/" + id_remission + "/" + show;

    $.ajax({
        type: "get",
        url: url,
        success: (data) => {
            $("#adminModalBody").html("");
            $("#adminModalBody").html(data);

            initSelectTwoModal();
        },
        error: (data) => {
            alertDanger();
            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                onDangerUniqueMessage(data.responseJSON.message);
            }
        },
    });
    return 0;
}

function cancelRemission(idRemission) {
    var url = BASE_URL + "/cancelRemission/" + idRemission;
    swal({
        title: "¿Estás seguro?",
        text: "¡Se cambiará el estado de la remisión!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sí Anular!",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        console.log(result);
        if (result) {
            $.ajax({
                type: "get",
                url: url,
                success: (data) => {
                    $("#tbody_remission").html("");
                    $("#tbody_remission").html(data);
                },
                error: (data) => {
                    console.log("data", data.responseJSON.message);
                    // alertDanger();
                    if (typeof data.responseJSON.errors == "object") {
                        onFail(data.responseJSON.errors);
                    } else {
                        alertDanger(data.responseJSON.message);
                    }
                },
            });
            return 0;
        }
    });
}

var cubitaje = 0;
function validateCubitaje() {
    var plate_vehicleRemission = $("#plate_vehicleRemission").val();
    $.ajax({
        type: "post",
        url: "getCubitajeMachine",
        headers: {
            "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            id_machine: plate_vehicleRemission,
        },
        success: (data) => {
            cubitaje = data.cubitaje.maqn_cubicaje;
        },
        error: (data) => {
            console.log("data", data.responseJSON.message);
            // alertDanger();
            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                alertDanger(data.responseJSON.message);
            }
        },
    });
    return 0;
}

function filterRemission() {
    var data = $(".form-list-remission").serialize();
    $.ajax({
        type: "get",
        url: "filterRemission",
        data: data,
        success: (data) => {
            dataTableRemission.destroy();
            $("#tbody_remission").html("");
            $("#tbody_remission").html(data);
            initDataTableRemission();
            swal({
                title: "Éxito!",
                text: "Se ha filtrado con éxito",
                icon: "success",
            });
        },
        error: (data) => {
            alertDanger();
            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                onDangerUniqueMessage(data.responseJSON.message);
            }
        },
    });
    return 0;
}

function exportExcelRemission() {
    var data = $(".form-list-remission").serialize();
    var url = BASE_URL + "/filterRemission?" + data + "&export=true";

    swal({
        title: "¿Estás seguro?",
        text: "¡De exportar el excel con las caracteristicas dadas?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Descargar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result) {
            window.location = url;
            // clearFilter() ;
        }
    });
}
