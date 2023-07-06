<b>Placa</b>:
{{ $machine->maqn_placa }}
<br>
<b>Tipo</b>:
{{ $machine->MachineType->tmaq_nombre }}
<br>
<b>Cubicaje</b>:
{{ $machine->maqn_cubicaje }}
<br>
<b>Unit</b>:
{{ $machine->Unit->unit_sigla }}
<br>
<b>Observación</b>:
{{ $machine->maqn_obs }}
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
