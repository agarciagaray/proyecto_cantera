<p>
    <b>Estado: </b> {{  $commodity->matp_estado == 'A' ? 'ACTIVO':'INACTIVO' }}<br>
    <b>Descripción: </b> {{ $commodity->matp_descripcion }}
</p>
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>