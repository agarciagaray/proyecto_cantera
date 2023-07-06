
{{-- @extends('layouts.modal')<!-- Nota: En esta ruta esta el contenido del marco del los fomularios para el estido de ellos  07/05/2023-->
@section('form') --}}
<form class="form-send-drivers">
    @csrf
    <input type="hidden" class="form-control" name="idDriver" id="idDriver" value="{{ $driver->id ?? '' }}">
    <input type="hidden" class="form-control" name="idPerson" id="idPerson" value="{{ $person->id ?? '' }}">
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="TipoId" style="font-size: 9pt">Tipo Id (*)</label>
            @php
                $selected = $person->pers_tipoid ?? '';
            @endphp
            <select class="form-control select2 TipoId" name="TipoId" id="TipoId" required
                onchange="inactivateFields()" tabindex="1">
                <option value="CC" {{ $selected == 'CC' ? 'selected' : '' }}>CC</option>
              
                
            </select>
        </div>


        <div class="col-12 col-sm-6 mb-3">
            <label for="idDriver" style="font-size: 9pt">Id. Conductor(*)</label>
            <input type="number" min="0" class="form-control idDriver" placeholder="Identificación"
                name="idDriver" id="idDriver" required tabindex="2" value="{{ $person->pers_identif ?? '' }}">
        </div>
    </div>
   
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="rSocial" style="font-size: 9pt">Razón Social</label>
            <input type="text" class="form-control rSocial" placeholder="Razón Social" name="pers_razonsocial"
                value="{{ $person->pers_razonsocial ?? '' }}">
            <input type="hidden" class="form-control" placeholder="Razón Social" id="pers_razonsocial" required
                tabindex="3" value="{{ $person->pers_razonsocial ?? '' }}">
        </div>

    </div>
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="Apell1" style="font-size: 9pt">Primer Apellido</label>
            <input type="text" class="form-control Apell1" placeholder="Primer Apellido"
                value="{{ $person->pers_primerapell ?? '' }}" onkeyup="companyNameCc()">
            <input type="hidden" class="form-control" name="Apell1" id="Apell1"
                value="{{ $person->pers_primerapell ?? '' }}">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="Apell2" style="font-size: 9pt">Segundo Apellido</label>
            <input type="text" class="form-control Apell2" placeholder="Segundo Apellido" onkeyup="companyNameCc()"
                value="{{ $person->pers_segapell ?? '' }}">
            <input type="hidden" class="form-control" name="Apell2" id="Apell2"
                value="{{ $person->pers_segapell ?? '' }}">
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="Nom1" style="font-size: 9pt">Primer Nombre</label>
            <input type="text" class="form-control Nom1" placeholder="Primer Nombre" onkeyup="companyNameCc()"
                value="{{ $person->pers_primernombre ?? '' }}">

            <input type="hidden" class="form-control" placeholder="Primer Nombre" name="Nom1" id="Nom1"
                value="{{ $person->pers_primernombre ?? '' }}">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="Nom2" style="font-size: 9pt">Segundo Nombre</label>
            <input type="text" class="form-control Nom2" placeholder="Segundo Nombre" onkeyup="companyNameCc()"
                value="{{ $person->pers_segnombre ?? '' }}">
            <input type="hidden" class="form-control" placeholder="Segundo Nombre" name="Nom2" id="Nom2"
                value="{{ $person->pers_segnombre ?? '' }}">
        </div>
    </div>
    <div class="row">

        <div class="col-12 col-sm-6 mb-3">
            <label for="ciudad" style="font-size: 9pt">Ciudad</label>
            @php
                $selectCity = $person->ciud_id ?? '';
            @endphp
            <select class="form-control select2" name="ciudad" id="ciudad" required>

                @foreach ($cities as $city)
                    <option value="{{ $city['id'] }}" {{ $selectCity == $city['id'] ? 'selected' : '' }}>
                        {{ $city['ciud_nombre'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="dpto" style="font-size: 9pt">Departamento</label>

            @php
                
                $selected = $person->dpto_id ?? '';
            @endphp
            <select class="form-control select2" name="dpto" id="dpto" required onchange="showCities()">

                @foreach ($states as $state)
                    <option value="{{ $state->id }}" {{ $selected == $state->id ? 'selected' : '' }}>
                        {{ $state->dpto_nombre }} </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="pais" style="font-size: 9pt">País</label>
            <select class="form-control select2" name="pais" id="pais" required>
                <option value="COL">COLOMBIA</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="eMail" style="font-size: 9pt">Email</label>
            <input type="email" class="form-control" placeholder="Email" name="eMail" id="eMail"
                value="{{ $person->pers_email ?? '' }}">
        </div>

    </div>
    <div class="row">

        <div class="col-12 col-sm-6 mb-3">
            <label for="dir" style="font-size: 9pt">Direccion</label>
            <input type="text" class="form-control" placeholder="Dirección" name="dir" id="dir"
                value="{{ $person->pers_direccion ?? '' }}">
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="tel" style="font-size: 9pt">Teléfono(s)</label>
            <input type="text" class="form-control" placeholder="Teléfono" name="tel" id="tel"
                value="{{ $person->pers_telefono ?? '' }}">
        </div>
        @can('Cambio de estado')
            <div class="col-12 col-sm-6 mb-3">
                <label for="estado" style="font-size: 9pt">Estado</label>
                <select class="form-control" name="estado" id="estado" required>
                    <option value="A">ACTIVO</option>
                    <option value="I">INACTIVO</option>
                </select>
            </div>
        @endcan


    </div>

    <div class="row">
        <div class="col-6">
            <!--tIENES QUE MIRARA COMO HACER QUE CUANDO ACTUALICE NO SE VAYA A GUARDAR SI NO A ACTUALIZAR, DEBES CAMBIAR EL METODO updateClient
TE LA DEBES ingeniar dale dejame trabajarlo-->
            <button class="btn btn-success" onclick="saveDriver()" type="button"
                id="sendDriverButton">Guardar</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()" >Cerrar</button>
        </div>
    </div>

</form>
{{-- @endsection --}}