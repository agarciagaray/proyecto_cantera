$(document).ready(function () {
    $("#table-commodity")
        .DataTable({
            language: { url:BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json" },
            responsive: true,
            lengthChange: true,
            autoWidth: true,
            scrollY: 580,
            bSort : false
        });
});

function createMateriaPrima(id_commodity, show = null) {
    if (id_commodity == null && show == null) {
        openModal("Crear materia prima.");
    }
    if (show == true) {
        openModal("Ver materia prima.");
    }
    if (show == false) {
        openModal("Editar materia prima.");
    }
    url =
        id_commodity == null
            ? "formCommodity"
            : "formCommodity/" + id_commodity + "/" + show;

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

function sendCommodity() {
    var data = $(".form-send-commodity").serialize();
    $.ajax({
        type: "post",
        url: "saveCommodity",
        data: data,

        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: (data) => {
            hideModal();
            $("#tbody_commodity").html("");
            $("#tbody_commodity").append(data);

            alertSuccess();

            // $("#adminModalBody").modal("hide");
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

function deleteCommodity(id_commodity, matp_estado) {
    swal({
        title: "¿Estás seguro?",
        text: "¡Se le cambiara el estado de la materia prima!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Desea inactivarlo",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result) {
            $.ajax({
                type: "get",
                url: "deleteCommodity/" + id_commodity,
                data: { matp_estado: matp_estado },
                success: (data) => {
                    $("#tbody_commodity").html("");
                    $("#tbody_commodity").html(data);

                    swal({
                        title: "¡Estado cambiado!",
                        text: "Ha pasado a inactivo con éxito",
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
        }
    });

    return 0;
}
