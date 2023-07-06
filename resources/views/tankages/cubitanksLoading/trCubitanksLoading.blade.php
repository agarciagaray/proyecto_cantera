@foreach ($cubitanksLoadings as $cubitanksLoading)
<tr>
    <td>{{ $cubitanksLoading->Fuelsshopping->ccmb_numremision }}</td>
    <td>{{ $cubitanksLoading->cubt_volumen }}</td>
    <td>{{ $cubitanksLoading->cubt_unidad }}</td>
    <td>{{ $cubitanksLoading->cubt_observaciones }}</td>
    <td>
        <button class="btn btn-primary btn-sm"
            onclick="createCubitanksLoading({{$cubitanksLoading->cubt_id }},false)"><i
                class="fas fa-edit"></i></button>
        <button class="btn btn-secondary btn-sm"
            onclick="createCubitanksLoading({{$cubitanksLoading->cubt_id }},true)"><i
                class="fa fa-eye" aria-hidden="true"></i></button>
        <button class="btn btn-danger btn-sm"
            onclick="deleteCubitanksLoading({{$cubitanksLoading->cubt_id }})"><i
                class="fa fa-trash" aria-hidden="true"></i></button>
    </td>
</tr>
@endforeach