$(document).ready(function () {
    $("#clientTable").DataTable({
        language: {
            "url":BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json"
        },
        responsive: true,
        lengthChange: true,
        autoWidth: true,
        bSort : false
    });
});

function createClient(clie_id = null, show = null,type = null){

    if (show == true) {
        openModal("Ver Cliente.")
    }

    if (clie_id == null && show == null) {
        openModal("Crear Nuevo Cliente.")
    }

    if (show == false) {
        openModal("Editar Cliente.")

    }
    url = clie_id == null ? 'formClient' : 'formClient/' + clie_id + '/' + show;
    //En esta funcion traigo la vista del show o el formulario
  
  // alert(url);
    $.ajax({
        type: 'get',
        url: url,
        success: (data) => {
            //Aqui pego la vista

            // console.log(data)

            $('#adminModalBody').html('');
            $('#adminModalBody').html(data);
            typeDocument(type);
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

// Metodo para guardar cliente
function saveClient(){
    let idPers = document.getElementById('idPerson').value;
  //  $(".rSocial").prop("disabled", false);
    var data = $('.form-send-client').serialize();

    url = idPers == 0 ? 'saveClient' : 'updateClient/' + idPers;

    $.ajax({
        type: 'post',
        url: url,
        data:data,
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        success: (data) => {
            hideModal();
            // Lllega aca y la pego
            $('#tbody_client').html('');
            $('#tbody_client').html(data);

            alertSuccess()
        },
        error: (data) => {
            alertDanger();
            $(".rSocial").prop("disabled", true);
            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                onDangerUniqueMessage(data.responseJSON.message);
            }
        }
    });

    return 0;
}


//Metodo de eliminar
function deleteClient(client_id){
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
                url: 'deleteClient/'+client_id,
                success: (data) => {

                    $('#tbody_client').html('');
                    $('#tbody_client').html(data);
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
