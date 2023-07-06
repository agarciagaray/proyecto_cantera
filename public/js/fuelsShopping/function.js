$(document).ready(function () {


    $("#table-fuelsShopping").DataTable({
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
    });


});



// $(document).ready(function () {

//     initSelectTwoModal()
// })
function createFuelsShoopping(ccmb_id =null , show = null){
    if (show == true) {
        openModal("Ver descarga de carrotanque.")
    }

    if (ccmb_id == null && show == null) {
        openModal("Crear un descarga de carrotanque.")
    }

    if (show == false) {
        openModal("Editar un descarga de carrotanque.")

    }
    url = ccmb_id == null ? 'formFuelDischarge' : 'formFuelDischarge/' + ccmb_id + '/' + show;
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


function saveFuelsShopping(){

    data = $('#form-fuels-shopping').serialize();
    $.ajax({
        type: 'post',
        url: 'saveFuelDischarge',
        data:data,
        success: (data) => {
            hideModal();
            $('#tbody-fuelsShopping').html('');
            $('#tbody-fuelsShopping').html(data);

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

function deleteFuelsShoopping(ccmb_id){
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
                url: 'deleteFuelDischarge/'+ccmb_id,
                success: (data) => {

                    $('#tbody-fuelsShopping').html('');
                    $('#tbody-fuelsShopping').html(data);
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
