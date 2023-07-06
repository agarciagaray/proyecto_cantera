
$(document).ready(function () {


    $("#table-concpayment").DataTable({
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

function sendConceptPayment(){
    let id = document.getElementById('id').value;
    var data = $('.form-send-concpay').serialize();
    url ='saveConceptPayment';

    $.ajax({
        type: 'post',
        url: url,
        data:data,
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        success: (data) => {
            hideModal();
            // Llega aca y la pego
            $('#tbody_concpay').html('');
            $('#tbody_concpay').html(data);

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
function deleteConceptPayment(id_machine_mov){
    swal({
        title: '¿Estás seguro',
        text: "¡Se le cambiara el estado de concepto de pago!",
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
                url: 'deleteConceptPayment/'+id_machine_mov,
                success: (data) => {

                    $('#tbody_concpay').html('');
                    $('#tbody_concpay').html(data);
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

function createConceptPayment(id_maquine_mov = null,show = null){

    if (id_maquine_mov == null && show == null) {

        openModal("Crear concepto de pago.")
    }
    if (show ==true) {

        openModal("Ver concepto de pago.")
    }
    if (show ==false) {

        openModal("Editar concepto de pago.")
    }
    url = id_maquine_mov == null ? 'formConceptPayment' : 'formConceptPayment/' + id_maquine_mov + '/' + show;

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
