// $(document).ready(function () {

//     initSelectTwoModal()
// })
function createCubitanksLoading(cubt_id =null , show = null){
    if (show == true) {
        openModal("Ver carga de cubitanques.")
    }

    if (cubt_id == null && show == null) {
        openModal("Crear un carga de cubitanques.")
    }

    if (show == false) {
        openModal("Editar un carga de cubitanques.")

    }
    url = cubt_id == null ? 'formCubitanksLoading' : 'formCubitanksLoading/' + cubt_id + '/' + show;
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


function saveCubitanksLoading(){

    data = $('#form-cubitanksLoading').serialize();
    $.ajax({
        type: 'post',
        url: 'saveCubitanksLoading',
        data:data,
        success: (data) => {
            hideModal();
            $('#tbody-cubitanksLoading').html('');
            $('#tbody-cubitanksLoading').html(data);
    
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

function deleteCubitanksLoading(cubt_id){
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
                url: 'deleteCubitanksLoading/'+cubt_id,
                success: (data) => {
         
                    $('#tbody-cubitanksLoading').html('');
                    $('#tbody-cubitanksLoading').html(data);
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