
<b>Tipo de documento</b>:  {{ $supplier->Person->pers_tipoid }}
<br>
<b>Nuip/Nit</b>:
    {{$supplier->Person->pers_identif}} /{{ $supplier->prov_identif }}
<br>
<b>Digito de verificación</b>:{{ $supplier->codeVerification ?? '' }}
<br>
<b>Razón social/Nombres y apellidos</b>:
    {{$supplier->Person->pers_razonsocial }} {{$supplier->Person->pers_primerapell }}
    {{$supplier->Person->pers_segapell }} {{$supplier->Person->pers_primernombre }}
    {{$supplier->Person->pers_segnombre }}
<br>
<b>Dirección</b>:
    {{$supplier->Person->pers_direccion }}
<br>
<b>Ciudad</b>:
{{$supplier->Person->City->ciud_nombre }}
<br>
<b>Departamento</b>:
{{$supplier->Person->City->State->dpto_nombre }}
<br>
<b>Teléfono</b>:
    {{$supplier->Person->pers_telefono }}
<br>
<b>Email</b>:
    {{$supplier->Person->pers_email }}
<br>
<b>Estado</b>:
    {{$supplier->Person->pers_estado == 'A' ? 'ACTIVO':'INACTIVO'}}
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
