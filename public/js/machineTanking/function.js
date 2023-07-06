$(document).ready(function () {


    $("#table-MachineTanking").DataTable({
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
function fuelsshoppingView() {

    var origen = $('#tanq_origen').val();

    // alert(origen);
    if (origen == 'CT') {

        $('#fuelsshopping').show();
        $('#cubitanque').hide();
        $('#div_tanq_valor_tanqueo_ext').css("display", "none");
        $('#tanq_valor_tanqueo_ext').val('');
        $('#cub_id').val('');
    }else if(origen == 'EX'){
        $('#cub_id').val('');
        $('#cubitanque').hide();
        $('#fuelsshopping').hide();
        $('#div_tanq_valor_tanqueo_ext').css("display", "block");
        $('#tanq_idmaquina').val(null).trigger('change');
        $('#cubt_idcompra').val(null).trigger('change');
    }
    else{
        $('#div_tanq_valor_tanqueo_ext').css("display", "none");
        $('#tanq_valor_tanqueo_ext').val('');
        $('#cubt_idcompra').val('');
        $('#cubitanque').show();
        $('#fuelsshopping').hide();
    }

    //
}

function createMachineTanking(cubt_id = null, show = null) {

    if (show == true) {
        openModal("Ver tanqueo de maquinas.")
    }

    if (cubt_id == null && show == null) {
        openModal("Crear un tanqueo de maquinas.")
    }

    if (show == false) {
        openModal("Editar un tanqueo de maquinas.")

    }
    url = cubt_id == null ? 'formMachineTanking' : 'formMachineTanking/' + cubt_id + '/' + show;
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


function saveMachineTanking() {

    data = $('#form-tankmachines').serialize();
    // var formData = new FormData();
    // var files = $('#image')[0].files[0];

    // var tanq_id = $('#tanq_id').val();
    // var tanq_fecha = $('#tanq_fecha').val();
    // var tanq_idmaquina = $('#tanq_idmaquina').val();
    // var tanq_volumen = $('#tanq_volumen').val();
    // var tanq_unidad = $('#tanq_unidad').val();
    // var tanq_origen = $('#tanq_origen').val();
    // var tanq_observaciones = $('#tanq_observaciones').val();
    // var cubt_idcompra = $('#cubt_idcompra').val();
    // var cub_id = $('#cub_id').val();

    // formData.append('tanq_id', tanq_id);
    // // formData.append('file', files);
    // formData.append('tanq_idmaquina', tanq_idmaquina);
    // formData.append('tanq_fecha', tanq_fecha);
    // formData.append('tanq_volumen', tanq_volumen);
    // formData.append('tanq_unidad', tanq_unidad);
    // formData.append('tanq_origen', tanq_origen);
    // formData.append('tanq_observaciones', tanq_observaciones);
    // formData.append('cubt_idcompra',  cubt_idcompra);
    // formData.append('cub_id', cub_id);


    $.ajax({
        type: 'post',
        url: 'saveMachineTanking',
        data: data,
        // contentType: false,
        // processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {

            hideModal();
            $('#tbody-MachineTanking').html('');
            $('#tbody-MachineTanking').append(data);

            alertSuccess()

            // $("#adminModalBody").modal("hide");
        },
        error: (errors) => {

            console.log('hola',errors)
            alertDanger()
            if (typeof (errors.responseJSON.errors) == 'object') {
                onFail(errors.responseJSON.errors)
            } else {
                onDangerUniqueMessage(errors.responseJSON.message)
            }

        }
    });
    return 0;

}

function deleteMachineTanking(cubt_id) {
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
                url: 'deleteMachineTanking/' + cubt_id,
                success: (data) => {

                    $('#tbody-MachineTanking').html('');
                    $('#tbody-MachineTanking').html(data);
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
function readURL(input, id) {
    id = id || '#modal-preview';
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(id).attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
        $('#modal-preview').removeClass('hidden');
        $('#start').hide();
    }
}
function price_galon() {

    var cub_id =$('#cub_id');

}
