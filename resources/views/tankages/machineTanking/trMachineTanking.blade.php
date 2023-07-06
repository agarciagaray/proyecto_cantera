@foreach ($machineTankings as $machineTanking)
    <tr id="tr_{{ $machineTanking->id }}" style="text-align:center">
        <td> {{ $machineTanking->Fuelsshopping->ccmb_numremision ?? '' }}</td>
        <td> {{ $machineTanking->Machine->maqn_placa ?? '' }} - {{  isset($machineTanking->Machine->MachineType) ? $machineTanking->Machine->MachineType->tmaq_nombre:'' }}
        </td>
        <td>{{ $machineTanking->tanq_origen }}</td>
        <td>{{ $machineTanking->tanq_fecha }}</td>
        <td>{{ $machineTanking->tanq_volumen }}</td>
        <td>{{ $machineTanking->tanq_unidad }}</td>

        {{-- {{ asset('files\MachineTanking\profile-1647209289.pdf') }} --}}

        {{-- <td><a class="btn btn-danger" href="{{ asset($machineTanking->tanq_docsoporte )}}" target="_blank"><i class="fa fa-file-pdf" aria-hidden="true"></i></a></td> --}}
        <td>{{ $machineTanking->tanq_observaciones }}</td>
        <td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
                @can('Formulario de máquinas de tanqueo')
                    <button class="btn btn-info mr-1" onclick="createMachineTanking({{ $machineTanking->id }},true)"><i
                            class="fa fa-eye" aria-hidden="true"></i></button>
                @endcan
                @can('Formulario de máquinas de tanqueo')
                    <button class="btn btn-primary mr-1" onclick="createMachineTanking({{ $machineTanking->id }},false)"><i
                            class="fas fa-edit"></i></button>
                @endcan
                @can('Eliminar de máquinas de tanqueo')
                    <button class="btn btn-danger" onclick="deleteMachineTanking({{ $machineTanking->id }})"><i
                            class="fa fa-trash" aria-hidden="true"></i></button>
                @endcan
            </div>
        </td>
    </tr>
@endforeach
