
$(document).ready(function () {


    $("#table-typemachine").DataTable({
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

function createMachineType(id_maquine_type = null, show = null){

    if (id_maquine_type == null && show == null) {

        openModal("Crear tipo de maquina.")
    }
    if (show ==true) {

        openModal("Ver tipo de maquina.")
    }
    if (show ==false) {

        openModal("Editar tipo de maquina.")
    }
    url = id_maquine_type == null ? 'formMachineType' : 'formMachineType/' + id_maquine_type + '/' + show;

    $.ajax({
        type: 'get',
        url: url,
        success: (data) => {

            $('#adminModalBody').html('');
            $('#adminModalBody').html(data);

            initSelectTwoModal()

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

function sendMachineType(){
    let id = document.getElementById('id').value;
    var data = $('.form-send-machine-type').serialize();
    url = 'saveMachineType';

    $.ajax({
        type: 'post',
        url: url,
        data:data,
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        success: (data) => {
            hideModal();
            // Llega aca y la pego
            $('#tbody_machinestype').html('');
            $('#tbody_machinestype').html(data);

            alertSuccess()
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


//Metodo de eliminar
function deleteMachineType(id_machine_type){
    swal({
        title: '¿Estás seguro',
        text: "¡Se le cambiara el estado del tipo de maquinaria!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Desea inactivarlo',
        cancelButtonText: "Cancelar",
      }).then((result) => {
          console.log(result);
        if (result) {

            $.ajax({
                type: 'get',
                url: 'deleteMaquineType/'+id_machine_type,
                success: (data) => {

                    $('#tbody_machinestype').html('');
                    $('#tbody_machinestype').html(data);
                    swal({

                        title: '¡Cambiado!',
                        text: 'Se ha cambiado el estado con éxito',
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
            return 0;

        }
      })
}

