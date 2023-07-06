<b>Id</b>:
{{ $machineOb->id }}
<br>
<b>Placa</b>:
{{ $machineOb->Machine->maqn_placa }}
<br>
<b>Fecha</b>:
{{ $machineOb->mqdt_fecha }}
<br>
<b>Observación</b>:
{{ $machineOb->mqdt_obs }}
<br>
<b>Estado</b>:
{{ $machineOb->mqdt_estado == 'A' ? 'ACTIVO':'INACTIVO' }}
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
