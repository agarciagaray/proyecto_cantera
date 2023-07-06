{{-- @extends('layouts.modal')
@section('form') --}}
<form class="form-send-remissionnovelties">
    @csrf
    <input type="hidden" class="form-control" name="id" id="id" value="{{ $remissionnovelty->id ?? '' }}">
    <div class="row">
        <div class="col-12 col-sm-6 col-xs-12 mb-3">
            <label for="idRemision" style="font-size: 9pt">id Remision/Obra/Sociedad </label>
            @php
                $selectedRemission = $remissionnovelty->rmnv_idremision ?? '';
            @endphp
            <select class="form-control select2" name="rmnv_idremision" id="rmnv_idremision" required>
                <option></option>
                @foreach ($remissions as $remission)
                    <option value="{{ $remission->id }}" {{ $selectedRemission == $remission->id ? 'selected' : '' }}>
                        {{ $remission->id }}-{{ $remission->Construction->obra_nombre }}-{{ $remission->Society->Person->pers_razonsocial ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-6 col-xs-12 mb-3">
            <label for="cncNov" style="font-size: 9pt">Concepto</label>
            @php
                $selectedConcepto = $remissionnovelty->rmnv_idconcepto ?? '';
            @endphp
            <select class="form-control select2" name="rmnv_idconcepto" id="rmnv_idconcepto" required
                onchange="fieldsConcept()">
                <option></option>
                @foreach ($remissionconcnovs as $remissionconcnov)
                    <option value="{{ $remissionconcnov->id }}"
                        {{ $selectedConcepto == $remissionconcnov->id ? 'selected' : '' }}>
                        {{ $remissionconcnov->cncn_nombre }} </option>
                @endforeach
            </select>
        </div>
    </div>
    @php
        $selected = $remissionnovelty->rmnv_idclient ?? '';
    @endphp
    <div class="row">
 
        <div class="col-12 col-sm-6 col-xs-12 mb-3 div_client" style="{{ $selected != '' ? 'display: block' : 'display: none' }} ">
            <label for="nombre" style="font-size: 9pt">Cliente</label>

            <select class="form-control select2 obra_idcliente" name="rmnv_idclient"
                onchange="searchContructionClient()">
                <option></option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $selected == $client->id ? 'selected' : '' }}>
                        {{ $client->Person->pers_razonsocial }} -{{ $client->Person->pers_identif }}
                    </option>
                @endforeach
            </select>

        </div>
        <div class="col-12 col-sm-6 col-xs-12 mb-3 div_client" style="{{ $selected != '' ? 'display: block' : 'display: none' }} ">
            <label for="idObra" style="font-size: 8pt">Id. Obra (NOMBRE DE LA OBRA) (*) </label>
            <select class="form-control select2 idObra" name="id_construction" id="id_construction"
                disabled>
                <option></option>
            </select>
        </div>

    </div>
    <div class="row">

        @php
            $selectedDate = $remissionnovelty->rmnv_fecha ?? '';
        @endphp
        <div class="col-12 col-sm-6 col-xs-12 mb-3 div_fecha"
            style="{{ $selectedDate != '' ? 'display: block' : 'display: none' }}">
            <label for="Fecha" style="font-size: 9pt">Fecha</label>
            @php
                $date = \Carbon\Carbon::now();
            @endphp
            {{-- <input type="text" class="form-control" value="{{ $remissionnovelty->rmnv_fecha ?? $date->format('Y-m-d') }}" disabled> --}}
            <input type="date" class="form-control" placeholder="Fecha" title="Fecha" name="rmnv_fecha"
                id="rmnv_fecha" required tabindex="6" value="{{ $selectedDate ?? $date->format('Y-m-d') }}">
        </div>
        @can('Cambio de estado')
            <div class="col-12 col-sm-6 col-xs-12 mb-3">
                <label for="estado" style="font-size: 9pt">Estado</label>
                @php
                    $selectedState = $remissionnovelty->rmnv_estado ?? '';
                @endphp
                <select class="form-control select2" name="rmnv_estado" id="rmnv_estado" required>
                    <option value="A" {{ $selectedState == 'A' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="I" {{ $selectedState == 'I' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>
        @endcan
    </div>
    <div class="row ">
        <div class="col-12 col-sm-6 col-xs-12 mb-3 div_rmnv_doc_vascula" style="display: none">
            <label for="rmnv_doc_vascula" style="font-size: 9pt">Documento de báscula</label>
            <input type="text" class="form-control" placeholder="Documento de báscula" name="rmnv_doc_vascula"
                id="rmnv_doc_vascula" required tabindex="4" value="{{ $remissionnovelty->rmnv_doc_vascula ?? '' }}"
                autocomplete="off">
        </div>
        <div class="col-12 col-sm-6 col-xs-12 mb-3 div_rmnv_doc_vascula" style="display: none">
            <label for="newVlr" style="font-size: 9pt">Nuevo valor</label>
            <input type="text" class="form-control" placeholder="Nuevo Valor" name="rmnv_nuevovalor"
                id="rmnv_nuevovalor" required tabindex="4" value="{{ $remissionnovelty->rmnv_nuevovalor ?? '' }}"
                autocomplete="off">
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-xs-12 mb-3">
            <label for="obs" style="font-size: 9pt">Observaciones</label>
            <textarea class="form-control" placeholder="Observaciones" title="Observaciones" id="rmnv_obs" name="rmnv_obs"
                rows="3" required tabindex="5">{{ $remissionnovelty->rmnv_obs ?? '' }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="sendRemissionNovelty()" type="button"
                id="sendRemissionNoveltyButton">Guardar</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Cerrar</button>
        </div>
    </div>
</form>
{{-- @endsection --}}
