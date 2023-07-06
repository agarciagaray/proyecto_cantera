$(document).ready(function () {


    $("#table-machineryNov").DataTable({
        "language": {
            "url":BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json"
        },
        "dom": 'Bfrtip',
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true,
        //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
       //  "iDisplayLength": 7,
       "scrollY": 450,
        "bSort" : false
    }).buttons().container().appendTo('#table-machineryNov_wrapper .col-md-6:eq(0)');


});


function createMachineNovelty(mqdt_id = null, show = null){

    if (show == true) {
        openModal("Ver novedades de maquina.")
    }

    if (mqdt_id == null && show == null) {
        openModal("Crear un novedades de maquina.")
    }

    if (show == false) {
        openModal("Editar un novedades de maquina.")

    }
//En esta funcion traigo la vista del show o el formulario
    url = mqdt_id == null ? 'formMachineryNovelty' : 'formMachineryNovelty/' + mqdt_id + '/' + show;
    $.ajax({
        type: 'get',
        url: url,
        success: (data) => {
//Aqui pego la vista
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
// Metodo para guardar
function saveMachineOb(){

    var data = $('#form-machineOb').serialize();
    $.ajax({
        type: 'post',
        url: 'saveMachineryNovelty',
        data:data,
        success: (data) => {
            hideModal();
            // Lllega aca y la pego
            $('#tbody_machineOb').html('');
            $('#tbody_machineOb').html(data);

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

//Metodo de eliminar
function deleteMochineNovely(){
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
                url: 'deleteMachineryNovelty/'+id,
                success: (data) => {

                    $('#tbody_machineOb').html('');
                    $('#tbody_machineOb').html(data);
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
