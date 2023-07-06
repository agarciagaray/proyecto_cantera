{{-- @extends('layouts.modal')
@section('form') --}}
<form class="form-send-machine">
    @csrf
    <input type="hidden" class="form-control" name="id" id="id" value="{{ $machine->id ?? '' }}">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-4 mb-3">
            
            {{-- <img src="" alt="imágen Máquina" name="imgMachine" id="imgMachine" width="125" height="122"> --}}
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-4 mb-3">
            <label for="placa" style="font-size: 9pt">Placa(*)</label>
            <input type="text" class="form-control" placeholder="Placa" name="placa" id="placa" required tabindex="1" value="{{ $machine->maqn_placa ?? ''}}"
                autofocus autocomplete="off">
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <label for="cubicaje" style="font-size: 9pt">modificar Cubicaje(*)</label>
            <input type="text" class="form-control" placeholder="Cubicaje" name="cubicaje" id="cubicaje" required  value="{{ $machine->maqn_cubicaje ?? ''}}"
                tabindex="3" autocomplete="off">
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <label for="unidad" style="font-size: 9pt">Unidad de medida(*)</label>
            @php
            $selectedUnit = $machine->maqn_idunidad ?? '';
            @endphp
            <select class="form-control select2" name="unidad" id="unidad" required>
                {{-- <option value="U">SELECCIONE UNIDAD</option> --}}
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}" {{  $selectedUnit == $unit->id ? ' selected' : '' }}> {{ $unit->unit_sigla }} </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 mb-3">
            <label for="obs" style="font-size: 9pt">Observaciones</label>
            <textarea class="form-control" id="obs" name="obs" rows="3" required>{{ $machine->maqn_obs ?? '' }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-4 mb-3">
            <label for="tipo" style="font-size: 9pt">Tipo de Máquina(*)</label>
            @php
            $selectedMachine = $machine->maqn_tipo ?? '';
            @endphp
            <select class="form-control select2" name="tipo" id="tipo" required>
                {{-- <option >TIPO MAQUINA</option> --}}
                @foreach ($machinestypes as $machinestype)
                    <option value="{{ $machinestype->id }}" {{ $selectedMachine === $machinestype->id ? 'selected' : ''}}> {{ $machinestype->tmaq_nombre }} </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <label for="tipo" style="font-size: 9pt">Número de documento(*) </label>
            <input name="nuip" class="form-control" min="0" type="number"  autocomplete="off" value="{{ $machine->nuip ?? '' }}">
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <label for="tipo" style="font-size: 9pt">Nombres y apellidos(*)</label>
            <input name="name_complete" class="form-control" type="text"  autocomplete="off" value="{{ $machine->name_complete ?? '' }}">
        </div>
        @can('Cambio de estado')
        <div class="col-12 col-sm-4 mb-3">
            <label for="estado" style="font-size: 9pt">Estado</label>
            @php
            $selectedEstado = $machine->maqn_estado ?? '';
            @endphp
            <select class="form-control select2" name="estado" id="estado" required>
                <option value="A" {{  $selectedEstado === 'A' ? 'selected' : ''}}>ACTIVO</option>
                <option value="I" {{  $selectedEstado === 'I' ? 'selected' : ''}}>INACTIVO</option>
            </select>
        </div>
        @endcan
    </div>

    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="saveMachine()" type="button"
                id="sendMachineButton">Guardar</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Cerrar</button>
        </div>
    </div>
</form>
{{-- @endsection --}}
