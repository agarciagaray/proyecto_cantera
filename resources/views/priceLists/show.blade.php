<b>Id</b>:
{{ $priceList->id }}
<br>
<b>Material</b>:
{{ $priceList->Material->mate_descripcion }}
<br>
<b>Razón social</b>:
{{ $priceList->Construction->Client->Person->pers_razonsocial }}
<br>
<b>Obra</b>:
{{ $priceList->Construction->obra_nombre }}
<br>
<b>Precio</b>:
{{ number_format($priceList->precio,2) }}
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
