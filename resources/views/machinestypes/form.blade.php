{{-- @extends('layouts.modal')
@section('form') --}}
    <form class="form-send-machine-type">
        @csrf
        <input type="hidden" class="form-control" name="id" id="id" value="{{ $machineType->id ?? '' }}">
        <div class="row">
            <div class="col-12 col-sm-12 mb-3">
                <label for="nombre" style="font-size: 9pt">Nombre (*)</label>
                <input type="text" class="form-control" placeholder="Nombre" name="tmaq_nombre" id="tmaq_nombre" required tabindex="1" value="{{  $machineType->tmaq_nombre ?? '' }}" autocomplete="off">
            </div>
            @can('Cambio de estado')
            <div class="col-12 col-sm-4 mb-3">
                <label for="estado" style="font-size: 9pt">Estado</label>
                @php
                $selected =  $machineType->tmaq_estado ?? '';
                @endphp
                <select class="form-control" name="tmaq_estado" id="tmaq_estado" required>
                    <option value="A" {{ $selected == 'A' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="I" {{ $selected == 'I' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>
            @endcan
        </div>

        <div class="row">
            <div class="col-6">
                <button class="btn btn-success" onclick="sendMachineType()" type="button" id="sendMachineTypeButton">Guardar</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Cerrar</button>
            </div>
        </div>
    </form>
{{-- @endsection --}}