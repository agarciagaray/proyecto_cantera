<tr id="option{{ $count }}">
        <input class="form-control" value="{{ $data->id_material}}" name="options[{{$count}}][dtrm_idmaterial]" id="dtrm_idmaterial_{{ $count }}" type="hidden">
     
    <td>
        <input class="form-control" value="{{ $data->Material->mate_descripcion }}">
        <input class="form-control" value="{{ $data->Material->mate_descripcion  }}" name="options[{{$count}}][materials_id]" id="materials_id{{ $count }}" type="hidden">
    </td>
    <td>
        <input class="form-control" value="%" disabled>
    </td>
    <td>
        <input class="form-control subt"  name="options[{{$count}}][porcentaje]" id="porcentaje{{ $count }}" type="number" min="0" required pattern="[0-9]+" >
    </td>
    <td ><a class="btn btn-danger" onclick="removeOptionItem('{{ $count }}')"><i class="fas fa-trash"></i></a></td>
</tr>
