{{-- @extends('layouts.modal')
@section('form') --}}
<form class="form-send-commodity">
    @csrf
    <input type="hidden" class="form-control" name="id" id="id" value="{{ $commodity->id ?? '' }}">
    {{-- <div class="row justify-content-center">
        <div class="col-12 col-sm-4 mb-3">
            <img src="" alt="imágen Material" name="imgMaterial" id="imgMaterial" width="125" height="122">
        </div>
    </div> --}}
    <div class="row">
        <div class="col-12 col-sm-12 mb-3">
            <label for="matp_descripcion" style="font-size: 9pt">Descripción</label>
            <textarea class="form-control" id="matp_descripcion" name="matp_descripcion" rows="3"
                required>{{ $commodity->matp_descripcion ?? '' }}</textarea>
        </div>
    </div>
    @can('Cambio de estado')
        <div class="row">
            <div class="col-12 col-sm-12 mb-3">
                <label for="estado" style="font-size: 9pt">Estado</label>
                @php
                    $selected = $commodity->matp_estado ?? '';
                    
                @endphp
                <select class="form-control" name="matp_estado" id="matp_estado" required>
                    <option value="A" {{ $selected === 'A' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="I" {{ $selected === 'I' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="sendCommodity()" type="button"
                id="sendCommodityButton">Guardar</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Cerrar</button>
        </div>
    </div>
</form>
{{-- @endsection --}}
