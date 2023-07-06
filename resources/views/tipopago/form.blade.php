{{-- @extends('layouts.modal')
@section('form') --}}
<form class="form-send-conceptsnovelties">
    @csrf
    <input type="hidden" class="form-control" name="id" id="id" value="{{  $remissionconcnovelty->id ?? '' }}">
    <div class="row">
        <div class="col-12 col-sm-12 mb-3">
            <label for="Nombre" style="font-size: 9pt">Nombre</label>
            <input type="text" class="form-control" placeholder="Nombre" name="cncn_nombre" id="cncn_nombre" required
                tabindex="1" value="{{ $remissionconcnovelty->cncn_nombre ?? '' }}">
        </div>
        @can('Cambio de estado')
            <div class="col-12 col-sm-4 mb-3">
                <label for="estado" style="font-size: 9pt">Estado</label>
                @php
                    
                    $selectState = $remissionconcnovelty->cncn_estado ?? '';
                @endphp
                <select class="form-control select2" name="cncn_estado" id="cncn_estado" required>
                    <option value="A" {{ $selectState == 'A' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="I" {{ $selectState == 'I' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>
        @endcan
    </div>

    <div class="row">
        <div class="col-6 col-sm-6">
            <button class="btn btn-success" onclick="sendConceptNovelty()" type="button"
                id="sendConceptNoveltyButton">Guardar</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Cerrar</button>
        </div>
    </div>
</form>
{{-- @endsection --}}
