{{-- @extends('layouts.modal')
@section('form') --}}
<form class="form-send-machine-obs">
    @csrf
    <input type="hidden" class="form-control" name="id" id="id" value="{{ $machineOb->id ?? '' }}">
    <div class="row">
        <div class="col-12 col-sm-6 mb-4">
            <label for="IdMaq" style="font-size: 8pt">Id. Maquinaria (PLACA) (*)</label>
            @php
                $selected = $machineOb->mqdt_idmaquina ?? '';
            @endphp
            <select class="form-control select2" name="mqdt_idmaquina" id="mqdt_idmaquina">
                @foreach ($machines as $machine)
                    <option value="{{ $machine->id }}" {{ $selected === $machine->id ? 'selected' : '' }}>
                        {{ $machine->maqn_placa }}</option>
                @endforeach
            </select>
            {{-- <input type="text" class="form-control" placeholder="Id. Maquinaria" name="IdMaq" id="IdMaq" required tabindex="1" value="{{  $machineOb->mqdt_idmaquina }}"> --}}
        </div>
        {{-- <div class="col-12 col-sm-4 mb-3">
                <label for="IdMaq" style="font-size: 8pt">Placa</label>
                <input type="text" class="form-control" placeholder="Placa" name="placa" id="placa" required tabindex="2" value="{{  }}">
            </div> --}}
        <div class="col-12 col-sm-6 mb-3">
            <label for="placa" style="font-size: 8pt">Fecha (*)</label>
            @php
                $date = \Carbon\Carbon::now();
            @endphp
            <input type="text" class="form-control"  value="{{ $machineOb->mqdt_fecha ?? $date->format('Y-m-d')}}" disabled>
            <input type="hidden" class="form-control" placeholder="Fecha" name="mqdt_fecha" id="mqdt_fecha" required tabindex="3" value="{{ $machineOb->mqdt_fecha ?? $date->format('Y-m-d') }}">
        </div>
        @can('Cambio de estado')
        <div class="col-12 col-sm-6 mb-3">
            <label for="estado" style="font-size: 8pt">Estado</label>
            @php
                $selectedState = $machineOb->mqdt_estado ?? '';
            @endphp
            <select class="form-control" name="mqdt_estado" id="mqdt_estado" required>
                <option value="A" {{ $selectedState == 'A' ? 'selected' : '' }}>ACTIVO</option>
                <option value="I" {{ $selectedState == 'I' ? 'selected' : '' }}>INACTIVO</option>
            </select>
        </div>
        @endcan
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 mb-3">
            <label for="obs" style="font-size: 8pt">Observaciones (*)</label>
            <textarea class="form-control" id="mqdt_obs" name="mqdt_obs" rows="3" required> {{ $machineOb->mqdt_obs ?? '' }}</textarea>
        </div>
    </div>


    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="sendMachineObs()" type="button"
                id="sendMachineObsButton">Guardar</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Cerrar</button>
        </div>
    </div>
</form>
{{-- @endsection --}}
