
$(document).ready(function () {

    $("#table-machinesobs").DataTable({
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

function createMachinesObs(id_maquine_obs = null, show = null){

    if (id_maquine_obs == null && show == null) {

        openModal("Crear observación de maquina.")
    }
    if (show ==true) {

        openModal("Ver observación de maquina.")
    }
    if (show ==false) {

        openModal("Editar observación de maquina.")
    }
    url = id_maquine_obs == null ? 'formMachineObs' : 'formMachineObs/' + id_maquine_obs + '/' + show;

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

function sendMachineObs(){
    let id = document.getElementById('id').value;
    var data = $('.form-send-machine-obs').serialize();
    url = 'saveMachineObs';

    $.ajax({
        type: 'post',
        url: url,
        data:data,
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        success: (data) => {
            hideModal();
            // Llega aca y la pego
            $('#tbody_machines-obs').html('');
            $('#tbody_machines-obs').html(data);

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
function deleteMachineObs(id_machine_obs){
    swal({
        title: '¿Estás seguro',
        text: "¡Se le cambiara el estado de la observación de maquinaria!",
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
                url: 'deleteMaquineObs/'+id_machine_obs,
                success: (data) => {
                    $('#tbody_machines-obs').html('');
                    $('#tbody_machines-obs').html(data);
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

