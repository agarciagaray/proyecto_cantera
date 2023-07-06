<b>Id</b>:
    {{ $conceptPayment->id }}
<br>
<b>Nombre</b>:
    {{ $conceptPayment->cncp_nombre }}
<br>
<b>Estado</b>:
{{ $conceptPayment->cncp_estado == 'A' ? 'ACTIVO':'INACTIVO' }}
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>