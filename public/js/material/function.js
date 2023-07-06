$(document).ready(function () {


    $("#table-material").DataTable({
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


// Metodo para guardar material
function saveMaterial(){
    let id = document.getElementById('id').value;
    var data = $('.form-send-material').serialize();

    url = id == 0 ? 'saveMaterial' : 'updateMaterial/' + id;

    $.ajax({
        type: 'post',
        url: url,
        data:data,
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        success: (data) => {
            hideModal();
            // Lllega aca y la pego
            $('#tbody_material').html('');
            $('#tbody_material').append(data);

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
function deleteMaterial(material_id,mate_estado){
    swal({
        title: '¿Estás seguro',
        text: "¡Se le cambiara el estado del material!",
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
                url: 'deleteMaterial/'+material_id,
                data:{
                    'mate_estado':mate_estado
                },
                success: (data) => {

                    $('#tbody_material').html('');
                    $('#tbody_material').html(data);
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

function createMaterial(id_material = null, show = null) {


    if (id_material == null && show == null) {

        openModal("Crear de material.")
    }
    if (show == true) {

        openModal("Ver de material.")
    }
    if (show == false) {

        openModal("Editar de material.")
    }
    url = id_material = null ? 'formMaterial' : 'formMaterial/' + id_material + '/' + show;

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
