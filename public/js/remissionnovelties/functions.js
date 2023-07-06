$(document).ready(function () {
    initDataTableRemissionNovelty()
});

var dataTableRemissionNovelty = null;
function initDataTableRemissionNovelty(){
    dataTableRemissionNovelty =$("#table-remissionNov")
        .DataTable({
            language: {
                url:BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json",
            },
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            bDestroy: true,
            processing: true,
            bSort: false,
            scrollY: 450,
            // iDisplayLength: 8,
        });

}


function sendRemissionNovelty() {
    let id = document.getElementById("id").value;
    var data = $(".form-send-remissionnovelties").serialize();
    url = "saveRemissionNovelty";

    $.ajax({
        type: "post",
        url: url,
        data: data,
        headers: {
            "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content"),
        },
        success: (data) => {
            // Llega aca y la pego
            $("#tbody_novrem").html("");
            $("#tbody_novrem").append(data);
            hideModal();
            alertSuccess();
        },
        error: (error) => {

            alertDanger();
            if (typeof error.responseJSON.errors == "object") {
                onFail(error.responseJSON.errors);
            } else {
                onDangerUniqueMessage(error.responseJSON.message);
            }
        },
    });

    return 0;
}

//Metodo de eliminar
function deleteRemissionNovelty(id_remissionnovelty) {
    swal({
        title: "¿Estás seguro",
        text: "¡Se le cambiara el estado de la novedad de remisión!",
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
                url: "deleteRemissionNovelty/" + id_remissionnovelty,
                success: (data) => {
                    $("#tbody_novrem").html("");
                    $("#tbody_novrem").append(data);
                    swal({
                        title: "¡Cambiado!",
                        text: "Se ha cambiado el estado con éxito",
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

function createRemissionNovelty(id_remissionnovelty = null, show = null) {
    if (id_remissionnovelty == null && show == null) {
        openModal("Crear novedad de remisión.");
    }
    if (show == true) {
        openModal("Ver novedad de remisión.");
    }
    if (show == false) {
        openModal("Editar novedad de remisión.");
    }
    url =
        id_remissionnovelty == null
            ? "formRemissionNovelty"
            : "formRemissionNovelty/" + id_remissionnovelty + "/" + show;

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

function fieldsConcept() {
    var rmnv_idconcepto = $("#rmnv_idconcepto").val();

    switch (rmnv_idconcepto) {
        case '1':
            $('.div_client').css('display','block');

            $('.div_fecha').css('display','none');
            $('.div_material').css('display','none');

            $(".obra_idcliente option[value='']").attr("selected", true);
            $("#rmnv_idmaterial").val('').trigger('change') ;
            $('#rmnv_fecha').val('');
            $("#rmnv_idmaterial option[value='']").attr("selected", true);
            $('#rmnv_doc_vascula').val();
            $('#rmnv_nuevovalor').val();
            $('.div_rmnv_doc_vascula').css('display','none');
            break;
        case '2':

            $('.div_rmnv_doc_vascula').css('display','block');
            $('#rmnv_fecha').val('');
            $('.div_fecha').css('display','none');
            $('.div_client').css('display','none');
            $('.div_material').css('display','none');
            $(".obra_idcliente").val('').trigger('change') ;
            $(".obra_idcliente option[value='']").attr("selected", true);
            $("#rmnv_idmaterial").val('').trigger('change') ;
            $("#rmnv_idmaterial option[value='']").attr("selected", true);
            break;
        case '3':

            $('.div_fecha').css('display','block');
            $('.div_client').css('display','none');
            $('.div_material').css('display','none');

            $('#rmnv_doc_vascula').val();
            $('#rmnv_nuevovalor').val();
            $(".obra_idcliente").val('').trigger('change') ;
            $("#rmnv_idmaterial").val('').trigger('change') ;
            $('.div_rmnv_doc_vascula').css('display','none');
            break;
        default:

            $('.div_material').css('display','block');
            $('.div_fecha').css('display','none');
            $('.div_client').css('display','none');
            $(".obra_idcliente").val('').trigger('change') ;
            $('#rmnv_doc_vascula').val();
            $('#rmnv_nuevovalor').val();
            $('.div_rmnv_doc_vascula').css('display','none');
            break;
    }


}


function filterRemissionNov(){

    var data = $(".form-list-remission-nov").serialize();
    $.ajax({
        type: "get",
        url: "filterRemissionNov",
        data: data,
        success: (data) => {
            dataTableRemissionNovelty.destroy()
            $("#tbody_novrem").html("");
            $("#tbody_novrem").html(data);
            initDataTableRemissionNovelty()
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

function exportExcelRemissionNov() {
    var data = $(".form-list-remission-nov").serialize();
    var url = BASE_URL+'/filterRemissionNov?' +data+'&export=true';

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


// function closeModal() {
//     $(".select2").select2('destroy');
//     initSelect() ;


// }
