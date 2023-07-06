$(document).ready(function () {


    $("#table-viaticoOther").DataTable({
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


// $(document).ready(function () {

//     initSelectTwoModal()
// })
function createMachinePayment(id = null, show=null){
    if (show == true) {
        openModal("Ver viáticos y otros valores por máquina.")
    }

    if (id == null && show == null) {
        openModal("Crear un viáticos y otros valores por máquina.")
    }

    if (show == false) {
        openModal("Editar un viáticos y otros valores por máquina.")

    }
    url = id == null ? 'formViaticoOther' : 'formViaticoOther/' + id + '/' + show;
    $.ajax({
        type: 'get',
        url: url,
        success: (data) => {

            $('#adminModalBody').html('');
            $('#adminModalBody').append(data);

             initSelectTwoModal()
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


function saveMachinePayment(){

    data = $('#form-machine-payment').serialize();
    $.ajax({
        type: 'post',
        url: 'saveViaticoOther',
        data:data,
        success: (data) => {
            hideModal();
            $('#tbody_viaticoOther').html('');
            $('#tbody_viaticoOther').html(data);

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
function deleteMachinePayment(id) {

    swal({
        title: '¿Estás seguro',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Desea eliminarlo',
        cancelButtonText: "Cancelar",
      }).then((result) => {
          console.log(result);
        if (result) {

            $.ajax({
                type: 'get',
                url: 'deleteViaticoOther/'+id,
                success: (data) => {

                    $('#tbody_viaticoOther').html('');
                    $('#tbody_viaticoOther').html(data);
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
