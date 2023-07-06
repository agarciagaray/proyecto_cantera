<b>Id</b>:
{{ $machineMov->id }}<br>
<b>Placa</b>:
{{ $machineMov->Machine->maqn_placa}}<br>
<b>Fecha</b>:
{{ $machineMov->mqmv_fecha ?? 0}}
<br>
<b>Hora de inicio</b>:
{{ $machineMov->mqmv_hinicio ?? 0}}
<br>
<b>Hora final</b>:
{{ $machineMov->mqmv_hfin ?? 0}}<br>
<b>Horometro inicial</b>:
 {{   $machineMov->horometro_hinicio ?? 0}}<br>
<b>Horometro final</b>:
{{  $machineMov->horometro_hfinal ?? 0}}<br>
<b>Cantidad</b>:
@if($machineMov->mqmv_hinicio && $machineMov->mqmv_hfin )
   {{ $machineMov->hourDiff($machineMov->mqmv_hinicio ?? 0,$machineMov->mqmv_hfin ?? 0)}}
@else
   {{ $machineMov->rest(doubleval($machineMov->horometro_hinicio)??00.00 ,doubleval($machineMov->horometro_hfinal)??00.00 ) }}
@endif
<br>
<b>Valor por hora</b>:
{{ $machineMov->mqmv_vlrhora ?? 0 }}<br>
<b>Conductor</b>:
{{ $machineMov->id_conductor }}<br>
<b>Observación</b>:
{{ $machineMov->mqmv_obs }}<br>
<b>Estado</b>:
{{ $machineMov->mqmv_estado == 'A' ? 'ACTIVO':'INACTIVO' }}
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>