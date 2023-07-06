{{-- @extends('layouts.modal')
@section('form') --}}
<form class="form-send-constr">
    @csrf
    <input type="hidden" class="form-control" name="id" id="id" value="{{ $construction->id ?? '' }}">
    <div class="row">
        <div class="col-12 col-sm-4 mb-3">
            <label for="idCliente" style="font-size: 9pt">Cliente</label>
            @php
                $selected = $construction->obra_idcliente ?? '';
            @endphp
            <select class="form-control select2" onchange="getNameClient()" name="idCliente" id="idCliente">
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $selected == $client->id ? 'selected' : '' }}>
                        {{ $client->Person->pers_identif }} - {{ $client->Person->pers_razonsocial }}</option>
                @endforeach
            </select>
            {{-- <input type="text" class="form-control" placeholder="Id. Cliente"  required tabindex="2" > --}}
        </div>
        <div class="col-12 col-sm-8 mb-3">
            <label for="rSocial" style="font-size: 9pt">Razón Social ó Nombre</label>
            @php
            $nameLastname = '';
                if (is_null($client->Person->pers_razonsocial) && !is_null($construction)) {
                    $nameLastname = $client->Person->pers_primernombre .' ' .$client->Person->pers_segnombre .' ' .$client->Person->pers_primerapell .' ' .$client->Person->pers_segapell;
                }
                
            @endphp
            <input type="text" class="form-control" placeholder="Razón Social/Nombre" name="rSocial" id="rSocial"
                required tabindex="3" disabled value="{{ $client->Person->pers_razonsocial ?? $nameLastname }}">
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 mb-3">
            <label for="nombreObra" style="font-size: 9pt">Nombre de obra(*)</label>
            <input type="text" class="form-control" placeholder="Nombre de Obra" name="nombreObra" id="nombreObra"
                required tabindex="3" value="{{ $construction->obra_nombre ?? '' }}">
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 mb-3">
            <label for="dir" style="font-size: 9pt">Dirección (*)</label>
            <input type="text" class="form-control" placeholder="Dirección" name="dir" id="dir"
                value="{{ $construction->obra_direccion ?? '' }}">
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-12 col-sm-4 mb-3">
            <label for="pais" style="font-size: 9pt">País</label>
            <select class="form-control select2" name="pais" id="pais" required>
                <option value="COL">COLOMBIA</option>
            </select>
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <label for="dpto" style="font-size: 9pt">Departamento</label>
            @php
                $selectedDpto = $construction->obra_dpto ?? '';
            @endphp
            <select class="form-control select2" name="dpto" id="dpto" required onchange="showCities()">
                <option value="">Dpto...</option>
                @foreach ($states as $state)
                    <option value="{{ $state->id }}"
                        {{ $selectedDpto == $state->id ? 'selected' : '' }}> {{ $state->dpto_nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <label for="ciudad" style="font-size: 9pt">Ciudad</label>
            @php
                $selected = $construction->obra_ciudad ?? '';
            @endphp
            <select class="form-control select2" name="ciudad" id="ciudad" required>
                <option value="">Ciudad...</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->ciud_codigo }}"
                        {{ $selected == $city->ciud_codigo ? 'selected' : '' }}>{{ $city->ciud_nombre }}</option>
                @endforeach
            </select>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-12 col-sm-12 mb-3">
            <label for="obs" style="font-size: 9pt">Observaciones</label>
            <textarea class="form-control" id="obs" name="obs" placeholder="Observaciones" rows="3"
                required>{{ $construction->obra_obs ?? '' }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 mb-3" id="messageValidatePorc">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="porcSuministro" style="font-size: 9pt">% Suministro (*)</label>
            <input type="number" class="form-control" placeholder="% Suministro" name="porcSuministro"
                id="porcSuministro" value="{{ $construction->obra_porcsuministro ?? '' }}" min="0" max="100"  onkeyup="totalPercentage()">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="porcTransporte" style="font-size: 9pt">% Transporte (*)</label>
            <input type="number" class="form-control" placeholder="% Transporte" name="porcTransporte"
                id="porcTransporte" value="{{ $construction->obra_porctransporte ?? '' }}" onkeyup="totalPercentage()" min="0" max="100">
        </div>
        @can('Cambio de estado')
        <div class="col-12 col-sm-4 mb-3">
            <label for="estado" style="font-size: 9pt">Estado</label>
            @php
                $selectedEstado = $construction->obra_ciudad ?? '';
            @endphp
            <select class="form-control select2" name="estado" id="estado" required>
                <option value="A" {{ $selectedEstado == 'A' ? 'selected' : '' }}>ACTIVO</option>
                <option value="I" {{ $selectedEstado == 'I' ? 'selected' : '' }}>INACTIVO</option>
            </select>
        </div>
        @endcan
    </div>


    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="saveConstruction()" type="button"
                id="sendConstructionButton">Guardar</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Cerrar</button>
        </div>
    </div>

</form>
{{-- @endsection --}}
