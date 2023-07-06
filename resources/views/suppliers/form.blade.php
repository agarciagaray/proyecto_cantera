{{-- @extends('layouts.modal')
@section('form') --}}
<form class="form-send-supplier">
    @csrf
    <input type="hidden" class="form-control" name="person[id]" id="idPerson" value="{{ $person['id'] ?? '' }}">
    <input type="hidden" class="form-control" name="supplier[id]" id="idSupplier" value="{{ $supplier->id ?? '' }}">

    <div class="row">
        <div class="col-12 col-sm-4 mb-3">
            <label for="TipoId" style="font-size: 9pt">Tipo de documento</label>
            @php
                $selected = $person->pers_tipoid ?? '';
            @endphp
            <select class="form-control select2 TipoId" name="person[pers_tipoid]" id="TipoId" required tabindex="1"
                onchange="inactivateFields()">
                <option value="CC" {{ $selected == 'CC' ? 'selected' : '' }}>CC</option>
                <option value="NIT" {{ $selected === 'NIT' ? 'selected' : '' }}>NIT</option>
            </select>
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <label for="idProv" style="font-size: 9pt">Identificación (*)</label>
            <input type="number" class="form-control idCliente" min="0" placeholder="Identificación"
                name="person[pers_identif]" id="idProv" required tabindex="2"
                value="{{ $person->pers_identif ?? '' }}" onkeyup="codeVerification()">
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <label for="idProv" style="font-size: 9pt">Codigo de verificación(*)</label>
            <input type="number" class="form-control codeVerification" placeholder="Cod. Verificación" disabled
                value="{{ $supplier->codeVerification ?? '' }}">
            <input type="hidden" class="form-control codeVerification" name="supplier[codeVerification]"
                value="{{ $supplier->codeVerification ?? '' }}">


        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="rSocial" style="font-size: 9pt">Razón Social</label>
            <input type="text" class="form-control rSocial" placeholder="Razón Social" required
                value="{{ $person->pers_razonsocial ?? '' }}" disabled onkeyup="razonsocial()">
            <input type="hidden" class="form-control" value="{{ $person->pers_razonsocial ?? '' }}"
                id="pers_razonsocial" name="person[pers_razonsocial]">
        </div>

        <div class="col-12 col-sm-6 mb-3">
            <label for="Apell1" style="font-size: 9pt">Primer Apellido</label>
            <input type="text" class="form-control  Apell1" placeholder="Primer Apellido"
                value="{{ $person->pers_primerapell ?? '' }}" onkeyup="companyNameCc()">
            <input type="hidden" class="form-control" placeholder="Primer Apellido" name="person[pers_primerapell]"
                id="Apell1" value="{{ $person->pers_primerapell ?? '' }}">
        </div>

        <div class="col-12 col-sm-6 mb-3">
            <label for="Apell2" style="font-size: 9pt">Segundo Apellido</label>
            <input type="text" class="form-control  Apell2" placeholder="Segundo Apellido"
                value="{{ $person->pers_segapell ?? '' }}" onkeyup="companyNameCc()">
            <input type="hidden" class="form-control" name="person[pers_segapell]" id="Apell2"
                value="{{ $person->pers_segapell ?? '' }}">
        </div>


        <div class="col-12 col-sm-6 mb-3">
            <label for="Nom1" style="font-size: 9pt">Primer Nombre</label>
            <input type="text" class="form-control  Nom1" placeholder="Primer Nombre" value="{{ $person->pers_primernombre ?? '' }}" onkeyup="companyNameCc()">
                <input type="hidden" class="form-control" name="person[pers_primernombre]"
                id="Nom1" value="{{ $person->pers_primernombre ?? '' }}" >
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="Nom2" style="font-size: 9pt">Segundo Nombre</label>
            <input type="text" class="form-control Nom2" placeholder="Segundo Nombre"  value="{{ $person->pers_segnombre ?? '' }}" onkeyup="companyNameCc()">
                <input type="hidden" class="form-control" placeholder="Segundo Nombre" name="person[pers_segnombre]"
                id="Nom2" value="{{ $person->pers_segnombre ?? '' }}">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="prov_codactividad" style="font-size: 9pt">Act. Económica</label>
            @php
                $selected = $supplier->prov_codactividad ?? '';
            @endphp
            <select class="form-control select2" name="supplier[prov_codactividad]" id="prov_codactividad">
                @foreach ($economicacts as $economicact)
                    <option value="{{ $economicact->id }}" {{ $selected == $economicact->id ? 'selected' : '' }}>
                        {{ $economicact->acte_nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="dpto" style="font-size: 9pt">Departamento (*)</label>
            @php
                $selected = $person->dpto_id ?? '';
            @endphp

            <select class="form-control select2" name="person[dpto_id]" id="dpto" required onchange="showCities()">
                <option value="">Seleccione Dpto...</option>
                @foreach ($states as $state)
                    <option value="{{ $state->id }}" {{ $selected == $state->id ? 'selected' : '' }}>
                        {{ $state->dpto_nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="ciudad" style="font-size: 9pt">Ciudad (*)</label>
            @php
                $selected = $person->ciud_id ?? '';
            @endphp

            <select class="form-control select2" name="person[ciud_id]" id="ciudad" required>
                <option value="">Seleccione Ciudad...</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}" {{ $selected == $city->id ? 'selected' : '' }}>
                        {{ $city->ciud_nombre }}</option>
                @endforeach

            </select>
        </div>

        <div class="col-12 col-sm-6 mb-3">
            <label for="dir" style="font-size: 9pt">Dirección</label>
            <input type="text" class="form-control" placeholder="Dirección" name="person[pers_direccion]" id="dir"
                value="{{ $person->pers_direccion ?? '' }}">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="pais" style="font-size: 9pt">País</label>
            <select class="form-control select2" name="person[country_id]" id="pais" required>
                <option value="1">COLOMBIA</option>
            </select>
        </div>
    </div>


    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="tel" style="font-size: 9pt">Teléfono(s)</label>
            <input type="text" class="form-control" placeholder="Teléfono" name="person[pers_telefono]" id="tel"
                value="{{ $person->pers_telefono ?? '' }}">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="eMail" style="font-size: 9pt">Email(*)</label>
            <input type="email" class="form-control" placeholder="Email" name="person[pers_email]" id="eMail"
                value="{{ $person->pers_email ?? '' }}">
        </div>
        @can('Cambio de estado')
            <div class="col-12 col-sm-3 mb-3">
                <label for="estado" style="font-size: 9pt">Estado</label>
                @php
                    $selected = $person->pers_estado ?? '';
                @endphp
                <select class="form-control select2" name="estado" id="estado" required>
                    <option value="A" {{ $selected == 'A' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="I" {{ $selected == 'I' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>
        @endcan
    </div>

    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="sendSupplier()" type="button"
                id="sendSupplierButton">Guardar</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Cerrar</button>
        </div>
    </div>
</form>
{{-- @endsection --}}
