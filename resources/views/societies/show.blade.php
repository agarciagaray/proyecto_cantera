<div class="row">
    <div class="col-12 col-sm-4 pt-4 pb-4 pl-4">
        @if ($society->soci_nombrelogo)
            <img src="{{ asset($society->soci_nombrelogo) }}" class="img-sm img-rounded img" width="400px"
                height="200px">
        @else
            <img src="{{ asset('img/defualtSociety.png') }}" class="img-sm img-rounded img" width="400px"
                height="200px">
        @endif

    </div>
    <div class="col-12 col-sm-8">
        <b>Identificación</b>: {{ $society->Person->pers_identif ?? '' }}
        <br>
        <b>Razón Social</b>: {{ $society->Person->pers_razonsocial ?? '' }}<br>
        <b>Estado</b>: {{ isset($society->soci_estado) ? ($society->soci_estado == 'A' ? 'ACTIVO':'INACTIVO') : '' }}
        {{-- <hr> --}}

        {{-- {{  $society->Person->pers_razonsocial ?? ''  }} --}}
        <b>Número de identificación</b>: {{ $society->Person->pers_identif ?? '' }}<br>
        <b>Tipo de documento</b>: {{ $society->Person->pers_tipoid ?? '' }}<br>
        <b>Primer nombre</b>: {{ $society->Person->pers_primernombre ?? '' }}<br>
        <b>Segundo nombre</b>:{{ $society->Person->pers_segnombre ?? '' }}<br>
        <b>Primer apelllido</b>: {{ $society->Person->pers_primerapell ?? '' }}<br>
        <b>Segundo apelllido</b>: {{ $society->Person->pers_segapell ?? '' }} <br>
        <b>Dirección</b>: {{ $society->Person->pers_direccion ?? '' }} <br>
        <b>Teléfono</b>: {{ $society->Person->pers_telefono ?? '' }} <br>
        <b>Ciudad</b>:{{ $society->Person->pers_ciudad ?? '' }} <br>
        <b>Departamento</b>:{{ $society->Person->pers_dpto ?? '' }} <br>
        <b>Email</b>: {{ $society->Person->pers_email ?? '' }} <br>
        <b>Estado</b>:
        {{ isset($society->Person->pers_estado) ? ($society->Person->pers_estado == 'A' ? 'ACITVO' : 'INACTIVO') : '' }} <br>
    </div>
</div>
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
