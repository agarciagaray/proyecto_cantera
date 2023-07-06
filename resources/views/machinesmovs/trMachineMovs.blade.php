@foreach ($machinesmovs as $machinemov)
<tr id="tr_{{ $machinemov->id }}"
    @if ($machinemov->mqmv_estado == 'I') style="color:#e3342f" @endif>
    {{--  --}}
    <td>{{ $machinemov->id }}</td>

    <td>{{ $machinemov->Machine->maqn_placa }}</td>
    <td>{{ $machinemov->mqmv_fecha ?? '' }}</td>
    <td>{{ $machinemov->horometro_hinicio }} - {{  $machinemov->horometro_hfinal }}
    </td>
    <td>{{ $machinemov->mqmv_hinicio }} - {{ $machinemov->mqmv_hfin }}</td>
    <td>
        @if($machinemov->mqmv_hinicio && $machinemov->mqmv_hfin )

       {{ $machinemov->hourDiff($machinemov->mqmv_hinicio ?? 0,$machinemov->mqmv_hfin ?? 0)}}

       @else
       {{  $machinemov->rest(doubleval($machinemov->horometro_hinicio)??00.00 ,doubleval($machinemov->horometro_hfinal)??00.00 ) }}
       @endif
      
    </td>
  

    <td>{{ $machinemov->mqmv_vlrhora }}</td>
    <td>{{ $machinemov->mqmv_obs }}</td>
    <td>{{ $machinemov->id_conductor }}</td>

    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-info mr-1"
                onclick="createMachineMov({{ $machinemov->id }},true)"
                type="button">
                <i class="fas fa-eye">
                </i>
            </button>
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            @if ($machinemov->mqmv_estado == 'A')
                <button class="btn btn-primary mr-1"
                    onclick="createMachineMov({{ $machinemov->id }},false)"
                    type="button">
                    <i class="fas fa-edit">
                    </i>
                </button>
      
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            <button class="btn btn-danger"
                onclick="deleteMachineMov({{ $machinemov->id }},'tr_{{ $machinemov->id }}')"
                type="button">
                <i class="fas fa-trash">
                </i>
            </button>
            @endif

        </div>
    </td>
</tr>
@endforeach