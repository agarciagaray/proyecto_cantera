$(document).ready(function () {


    $("#table-concnov").DataTable({
        language: {
            url:BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json",
        },
        responsive: true,
        lengthChange: true,
        autoWidth: true,
        bSort : false

    });


});


function sendConceptNovelty(){
    let id = document.getElementById('id').value;
    var data = $('.form-send-conceptsnovelties').serialize();
    url = 'saveConceptNovelty';

    $.ajax({
        type: 'post',
        url: url,
        data:data,
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        success: (data) => {

            // Llega aca y la pego
            $('#tbody_concnov').html('');
            $('#tbody_concnov').append(data);
            hideModal();
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
function deleteConceptNovelty(id_conceptnovelty){
    swal({
        title: '¿Estás seguro',
        text: "¡Se le cambiara el estado del concepto de novedad!",
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
                url: 'deleteConceptNovelty/'+id_conceptnovelty,
                success: (data) => {

                    $('#tbody_concnov').html('');
                    $('#tbody_concnov').append(data);
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

function createConceptNovelty(id_conceptnovelty = null,show = null){

    if (id_conceptnovelty == null && show == null) {

        openModal("Crear conceptos de novedades de remisiones.")
    }
    if (show ==true) {

        openModal("Ver conceptos de novedades de remisiones.")
    }
    if (show ==false) {

        openModal("Editar conceptos de novedades de remisiones.")
    }
    url = id_conceptnovelty == null ? 'formConceptNovelty' : 'formConceptNovelty/' + id_conceptnovelty + '/' + show;

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
