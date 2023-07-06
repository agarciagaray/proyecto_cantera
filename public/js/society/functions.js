$(document).ready(function () {
    $("#societyTable")
        .DataTable({
            language: {
                url:BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json",
            },
            responsive: true,
            lengthChange: true,
            autoWidth: true,
            scrollY: 580,
            bSort : false
        });
});
function sendSociety() {
    $(".rSocial").prop("disabled", false);
    var files = $('#soci_nombrelogo')[0].files[0];
    var form = $('form')[0]; // You need to use standard javascript object here
    var formData = new FormData(form);
    formData.append('file', files);

    $.ajax({
        type: "post",
        url: "saveSociety",
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: (data) => {
            hideModal();
            $("#tbody_society").html("");
            $("#tbody_society").append(data);

            alertSuccess();

            // $("#adminModalBody").modal("hide");
        },
        error: (data) => {
            $(".rSocial").prop("disabled", true);
            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                onDangerUniqueMessage(data.responseJSON.message);
            }
        },
    });
    return 0;
}

function createSociety(id_society, show = null, type = null) {
    if (id_society == null && show == null) {
        openModal("Crear sociedad.");
    }
    if (show == true) {
        openModal("Ver sociedad.");
    }
    if (show == false) {
        openModal("Editar sociedad.");
    }
    url =
        id_society == null
            ? "formSociety"
            : "formSociety/" + id_society + "/" + show;

    $.ajax({
        type: "get",
        url: url,
        success: (data) => {
            $("#adminModalBody").html("");
            $("#adminModalBody").html(data);
            typeDocument(type);
            initSelectTwoModal();
        },
        error: (data) => {
            alertDanger()
            if (typeof (data.responseJSON.errors) == 'object') {
                onFail(data.responseJSON.errors)
            } else {
                onDangerUniqueMessage(data.responseJSON.message)
            }
        },
    });
    return 0;
}

function deleteSociety(id_society) {
    swal({
        title: "¿Estás seguro?",
        text: "¡Se le cambiara el estado a sociedad!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Desea inactivarlo",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        console.log(result);
        if (result) {
            $.ajax({
                type: "get",
                url: "deleteSociety/" + id_society,
                success: (data) => {
                    $("#tr_society").remove();

                    $("#tbody_society").html("");
                    $("#tbody_society").html(data);

                    swal({
                        title: "¡Estado cambiado!",
                        text: "Ha pasado a inactivo con éxito",
                        icon: "success",
                    });
                },
                error: (data) => {
                    alertDanger()
                    if (typeof (data.responseJSON.errors) == 'object') {
                        onFail(data.responseJSON.errors)
                    } else {
                        onDangerUniqueMessage(data.responseJSON.message)
                    }
                },
            });
        }
    });

    return 0;
}

function Uploaded() {}
