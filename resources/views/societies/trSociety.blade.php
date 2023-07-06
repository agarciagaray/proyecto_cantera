@foreach ($societies as $society)
<tr id="tr_society{{ $society->id }}"  @if ($society->soci_estado== 'I') style="color:#e3342f" @endif>
     <td>
        {{ $society->id }}
    </td>  
    <td >
        @if ($society->soci_nombrelogo)
        <img src="{{ asset($society->soci_nombrelogo)}}" class="img-xs">
        @else
        <img src="{{ asset('img/defualtSociety.png')}}" class="img-xs">
        @endif
     
    </td>  
    <td>
        {{ $society->Person->pers_razonsocial ?? '' }}<br>
        {{ $society->Person->pers_tipoid ?? '' }}: {{ $society->Person->pers_identif ?? '' }} 
    </td>
    <td>
        {{ $society->Person->State->dpto_nombre ?? '' }} - 
        {{ $society->Person->City->ciud_nombre ?? '' }}<br>
        {{ $society->Person->pers_direccion ?? '' }}
    </td>
    <td>
        {{ $society->Person->pers_primernombre .' '. $society->Person->pers_segnombre.' '.$society->Person->pers_primerapell .' '.$society->Person->pers_segapell  ?? '' }}<br>
        Tel : {{ $society->Person->pers_telefono ?? '' }}
    {{--  </td>
    <td>  --}}
        {{ $society->Person->pers_email ?? '' }}
    </td>
    {{-- <td>
        {{ $society->soci_estado ?? '' }}
    </td> --}}

    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-info mr-1"
                onclick="createSociety({{ $society->id }},true)" type="button">
                <i class="fas fa-eye">
                </i>
            </button>
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            @if ($society->soci_estado== 'A')
            <button class="btn btn-primary mr-1"
                onclick="createSociety({{ $society->id }},false,'{{ $society->Person->pers_tipoid }}')"
                type="button">
                <i class="fas fa-edit">
                </i>
            </button>
     
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            <button class="btn btn-danger"
                onclick="deleteSociety({{ $society->id }},'tr_{{ $society->id }}')"
                type="button">
                <i class="fas fa-trash">
                </i>
            </button>
            @endif
        </div>
    </td>
</tr>
@endforeach