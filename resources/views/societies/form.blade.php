{{-- @extends('layouts.modal') --}}
{{-- @section('form') --}}
<form class="form-send-society">
    @csrf
    <input autocomplete="off" type="hidden" class="form-control" name="person[id]" id="idPerson"
        value="{{ $person->id ?? '' }}">
    <input autocomplete="off" type="hidden" class="form-control" name="society[id]" id="idSociety"
        value="{{ $society->id ?? '' }}">
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="TipoId" style="font-size: 9pt">Tipo Id</label>
            <select class="form-control select2 TipoId" name="person[pers_tipoid]" id="TipoId" required tabindex="1"
                onchange="inactivateFields()">
                <option value="CC">CC</option>
                <option value="NIT">NIT</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="rSocial" style="font-size: 9pt">Razón Social</label>
            <input autocomplete="off" type="hidden" class="form-control" placeholder="Razón Social"
                name="person[pers_razonsocial]" id="pers_razonsocial" value="{{ $person->pers_razonsocial ?? '' }}"
                onkeyup="razonsocial()">
            <input autocomplete="off" type="text" class="form-control rSocial" placeholder="Razón Social" required
                tabindex="3" value="{{ $person->pers_razonsocial ?? '' }}" disabled="disabled" onkeyup="razonsocial()">
        </div>


        <div class="col-12 col-sm-6 mb-3">
            <label for="idSoc" style="font-size: 9pt">Identificación </label>
            <input autocomplete="off" type="number" min="0" class="form-control idCliente" placeholder="Identificación"
                name="person[pers_identif]" id="idSoc" required tabindex="2"
                value="{{ $person->pers_identif ?? '' }}">
        </div>

        <div class="col-12 col-sm-6 mb-3">
            <label for="Apell1" style="font-size: 9pt">Primer Apellido</label>
            <input autocomplete="off" type="text" class="form-control Apell1" placeholder="Primer Apellido"
                onkeyup="companyNameCc()" value="{{ $person->pers_primerapell ?? '' }}">

            <input autocomplete="off" type="hidden" class="form-control" name="person[pers_primerapell]" id="Apell1"
                value="{{ $person->pers_primerapell ?? '' }}">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="Apell2" style="font-size: 9pt">Segundo Apellido</label>
            <input autocomplete="off" type="text" class="form-control Apell2" placeholder="Segundo Apellido"
                onkeyup="companyNameCc()" value="{{ $person->pers_segapell ?? '' }}">

            <input autocomplete="off" type="hidden" class="form-control" placeholder="Segundo Apellido"
                name="person[pers_segapell]" id="Apell2" value="{{ $person->pers_segapell ?? '' }}">
        </div>

        <div class="col-12 col-sm-6 mb-3">
            <label for="Nom1" style="font-size: 9pt">Primer Nombre</label>
            <input autocomplete="off" type="text" class="form-control Nom1" placeholder="Primer Nombre"
                onkeyup="companyNameCc()" value="{{ $person->pers_primernombre ?? '' }}">

            <input autocomplete="off" type="hidden" class="form-control" placeholder="Primer Nombre"
                name="person[pers_primernombre]" id="Nom1" value="{{ $person->pers_primernombre ?? '' }}">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="Nom2" style="font-size: 9pt">Segundo Nombre</label>
            <input autocomplete="off" type="text" class="form-control Nom2" placeholder="Segundo Nombre"
                onkeyup="companyNameCc()" value="{{ $person->pers_segnombre ?? '' }}">

            <input autocomplete="off" type="hidden" class="form-control" name="person[pers_segnombre]" id="Nom2"
                value="{{ $person->pers_segnombre ?? '' }}">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="pais" style="font-size: 9pt">País</label>
            <select class="form-control select2" id="pais" required>
                <option value="COL">COLOMBIA</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="dpto" style="font-size: 9pt">Departamento (*)</label>

            @php
                $select = $person->dpto_id ?? '';
            @endphp
            <select class="form-control select2" name="person[dpto_id]" id="dpto" required onchange="showCities()">
                <option value="">Dpto...</option>
                @foreach ($states as $state)
                    <option value="{{ $state->id }}" {{ $select == $state->id ? 'selected' : '' }}>
                        {{ $state->dpto_nombre }} </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="ciudad" style="font-size: 9pt">Ciudad (*)</label>
            @php
                $selectCity = $person->ciud_id ?? '';
            @endphp
            <select class="form-control select2" name="person[ciud_id]" id="ciudad" required>
                <option value="">Ciudad...</option>
                @foreach ($cities as $city)
                    <option value="{{ $city['id'] }}" {{ $selectCity == $city['id'] ? 'selected' : '' }}>
                        {{ $city['ciud_nombre'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="dir" style="font-size: 9pt">Dirección</label>
            <input autocomplete="off" type="text" class="form-control" placeholder="Dirección"
                name="person[pers_direccion]" id="dir" value="{{ $person->pers_direccion ?? '' }}">
        </div>

        <div class="col-12 col-sm-6 mb-3">
            <label for="tel" style="font-size: 9pt">Teléfono(s)</label>
            <input autocomplete="off" type="text" class="form-control" placeholder="Teléfono(s)"
                name="person[pers_telefono]" id="tel" value="{{ $person->pers_telefono ?? '' }}">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="eMail" style="font-size: 9pt">Email (*)</label>
            <input autocomplete="off" type="email" class="form-control" placeholder="Email" name="person[pers_email]"
                id="eMail" value="{{ $person->pers_email ?? '' }}">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="prefix" style="font-size: 9pt">Prefijo</label>
            <input autocomplete="off" type="text" class="form-control" placeholder="prefix" name="society[prefix]"
                id="prefix" value="{{ $society->prefix ?? '' }}">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="soci_nombrelogo" style="font-size: 9pt">Logo</label>
            <input type="file" class="form-control" placeholder="soci_nombrelogo" name="society[soci_nombrelogo]"
                id="soci_nombrelogo" accept="image/*">
        </div>
    </div>
    <div class="row">
        @can('Cambio de estado')
            <div class="col-12 col-sm-3 mb-3">
                <label for="estado" style="font-size: 9pt">Estado</label>
                @php
                    $select = $person->pers_estado ?? '';
                @endphp
                <select class="form-control select2" name="estado" id="estado" required>
                    <option value="A" {{ $select == 'A' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="I" {{ $select == 'I' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>
        @endcan
    </div>

    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="sendSociety()" type="button"
                id="sendSocietyButton">Guardar</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Cerrar</button>

        </div>
    </div>
</form>
{{-- @endsection --}}
