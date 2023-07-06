
<b>Tipo de documento</b>:
    {{ $driver->Person->pers_tipoid }}
<br>
<b>Identificación</b>:
    {{ $driver->Person->pers_identif }}
<br>
<b>Nombres y apellidos/Conductor</b>:
    {{ $driver->Person->pers_primerapell }}
    {{ $driver->Person->pers_segapell }} {{ $driver->Person->pers_primernombre }}
    {{ $driver->Person->pers_segnombre }}
<br>
<b>Dirección</b>:
    {{ $driver->Person->pers_direccion }}
<br>
<b>Ciudad</b>:
    {{ $driver->Person->City->ciud_nombre }}
<br>
<b>Departamento</b>:
    {{ $driver->Person->State->dpto_nombre }}
<br>
<b>Teléfono</b>:
    {{ $driver->Person->pers_telefono }}
<br>
<b>Email</b>:
    {{ $driver->Person->pers_email }}
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>