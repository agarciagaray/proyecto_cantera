<tr id="remission{{ $count }}">
    {{-- <td> --}}
        {{-- <input class="form-control" value="{{ $data->id_material }}" disabled> --}}
        <input class="form-control" value="{{ $data->id_material}}" name="remissions[{{ $count }}][dtrm_idmaterial]" id="dtrm_idmaterial_{{ $count }}" type="hidden">
        <input class="form-control" value="{{ $data->id}}" name="remissions[{{ $count }}][pricelist_id]" id="pricelist_id{{ $count }}" type="hidden">
    
    {{-- </td> --}}
    <td>
        <input class="form-control" value="{{ $data->Material->mate_descripcion }}" disabled>
        <input class="form-control" value="{{ $data->Material->mate_descripcion  }}" name="remissions[{{ $count }}][nomMat]" id="nomMat_{{ $count }}" type="hidden">
    </td>
    <td>
        <input class="form-control" value="{{ $data->Unit->unit_sigla }}" disabled>
        <input class="form-control" value="{{ $data->Unit->id }}" name="remissions[{{ $count }}][unit_id]" id="dtrm_unidad_{{ $count }}" type="hidden">
    </td>
    <td>
        <input class="form-control subt"  name="remissions[{{ $count }}][dtrm_cantdespachada]" id="dtrm_cantdespachada{{ $count }}" type="number" onkeyup="calcSubt('dtrm_cantdespachada{{ $count }}','dtrm_precio{{ $count }}','subt_{{ $count }}',{{ $count }})" min="0" required pattern="[0-9]+" >
        <input class="form-control" value="{{ $data->precio }}" name="remissions[{{ $count }}][dtrm_precio]" id="dtrm_precio{{ $count }}" type="hidden">
        <input class="form-control" name="remissions[{{ $count }}][subtotal]" id="subt_{{ $count }}" type="hidden">
        <input class="form-control" value="{{ $data->Construction->obra_porcsuministro }}" id="obra_porcsuministro_{{ $count }}" type="hidden">
        <input class="form-control" value="{{ $data->Construction->obra_porctransporte }}" id="obra_porctransporte_{{ $count }}" type="hidden">
        <input class="form-control" value="{{ $data->iva }}" id="iva_{{ $count }}" type="hidden">
        <input class="form-control"  name="remissions[{{ $count }}][transporte]" id="transporte_{{ $count }}" type="hidden">
        <input class="form-control"  name="remissions[{{ $count }}][suministro]" id="suministro_{{ $count }}" type="hidden">
        <input class="form-control"  name="remissions[{{ $count }}][valor_iva]" id="valor_iva_{{ $count }}" type="hidden">
    </td>


    <td ><a class="btn btn-danger" onclick="removeRemissionItem('remission{{ $count }}')"><i class="fas fa-trash"></i></a></td>
</tr>