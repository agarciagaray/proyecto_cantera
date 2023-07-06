<p>
    <b>Estado: </b> {{  $device->disp_estado == 'A' ? 'ACTIVO':'INACTIVO' }}<br>
    <b>Descripción: </b> {{ $device->disp_descripcion }}
</p>
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>