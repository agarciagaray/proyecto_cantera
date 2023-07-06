$(document).ready(function () {

    $("#table-machine").DataTable({
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


function saveMachine(){
    let id = document.getElementById('id').value;
    var data = $('.form-send-machine').serialize();
    url = id == 0 ? 'saveMachine' : 'updateMachine/' + id;

    $.ajax({
        type: 'post',
        url: url,
        data:data,
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        success: (data) => {
            hideModal();
            // Llega aca y la pego
            $('#tbody_machine').html('');
            $('#tbody_machine').html(data);

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
function deleteMachine(id_machine){
    swal({
        title: '¿Estás seguro',
        text: "¡Se le cambiara el estado de la maquina!",
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
                url: 'deleteMachine/'+id_machine,
                success: (data) => {

                    $('#tbody_machine').html('');
                    $('#tbody_machine').html(data);
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

function createMachine(id_maquine = null,show = null){

    if (id_maquine == null && show == null) {

        openModal("Crear maquina.")
    }
    if (show ==true) {

        openModal("Ver maquina.")
    }
    if (show ==false) {

        openModal("Editar maquina.")
    }
    url = id_maquine == null ? 'formMachine' : 'formMachine/' + id_maquine + '/' + show;

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
