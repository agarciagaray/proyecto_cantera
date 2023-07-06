<b>Id</b>:
    {{ $machineType->id }}
<br>
<b>Nombre</b>:
    {{ strtoupper($machineType->tmaq_nombre) }}
<br>
<b>Estado</b>:
    {{ $machineType->tmaq_estado == 'A' ? 'ACTIVO': 'INACTIVO' }}

<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>