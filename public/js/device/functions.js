$(document).ready(function () {

    $("#table-device").DataTable({
        language: {
            "url":BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json"
        },
        responsive: true,
        lengthChange: true,
        autoWidth: true,
        scrollY: 580,
        bSort : false
    });


});


function  createDevice(id_device,show=null){

    if (id_device == null && show == null) {

        openModal("Crear de dispositivos.")
    }
    if (show == true) {

        openModal("Ver de dispositivo.")
    }
    if (show == false) {

        openModal("Editar de dispositivo.")
    }
    url = id_device == null  ? 'formDevice' : 'formDevice/' + id_device + '/' + show;

    $.ajax({
        type: 'get',
        url: url,
        success: (data) => {

            $('#adminModalBody').html('');
            $('#adminModalBody').html(data);
            if (show) {

                $("#sendRolePermissionButton").remove();
            } else {
                initSelectTwoModal()
            }
        },
        error: (data) => {
            alertDanger()
            if (typeof (data.responseJSON.errors) == 'object') {
                onFail(data.responseJSON.errors)
            } else {
                onDangerUniqueMessage(data.responseJSON.message)
            }
        }
    });
    return 0;
}


function sendDevice(){

    var data = $('.form-send-device').serialize()
    $.ajax({
        type: 'post',
        url: 'saveDevice',
        data: data,

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {

            hideModal();
            $('#tbody_device').html('');
            $('#tbody_device').append(data);

            alertSuccess()

            // $("#adminModalBody").modal("hide");
        },
        error: (data) => {
            alertDanger()
            if (typeof (data.responseJSON.errors) == 'object') {
                onFail(data.responseJSON.errors)
            } else {
                onDangerUniqueMessage(data.responseJSON.message)
            }


        }
    });
    return 0;



}

function deleteDevice(id_device){
    swal({
        title: '¿Estás seguro?',
        text: "¡Se le cambiara el estado del dispositivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Desea inactivarlo',
        cancelButtonText: "Cancelar",
    }).then((result) => {

        if (result) {


            $.ajax({
                type: 'get',
                url: 'deleteDevice/' + id_device,
                success: (data) => {

                    $('#tbody_device').html('');
                    $('#tbody_device').html(data);

                    swal({

                        title: '¡Estado cambiado!',
                        text: 'Ha pasado a inactivo con éxito',
                        icon: "success",
                    })

                },
                error: (data) => {
                    alertDanger()
                    if (typeof (data.responseJSON.errors) == 'object') {
                        onFail(data.responseJSON.errors)
                    } else {
                        onDangerUniqueMessage(data.responseJSON.message)
                    }
                }
            });


        }
    })

    return 0;
}
