<form class="form-send-remission">
    @csrf
    <input type="hidden" class="form-control" name="id" id="id" value="{{ $remission->id ?? '' }}">
    <input type="hidden" class="form-control" name="data[totalRemission]" id="totalRemission" value="">
    <div class="row">
        <div class="col-12 col-sm-4 mb-3">
            <label for="nombre" style="font-size: 9pt">Cliente</label>
            <select class="form-control select2 obra_idcliente" onchange="searchContructionClient()">
                <option></option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">
                        {{ $client->Person->pers_razonsocial }} -{{ $client->Person->pers_identif }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <label for="idObra" style="font-size: 8pt">Id. Obra (NOMBRE DE LA OBRA) (*) </label>
            <select class="form-control select2 idObra" name="data[idObra]" id="idObra" onchange="getDataObra()"
                required disabled>
                <option ></option>
                {{-- @foreach ($constructions as $construction)
                    <option value="{{ $construction->id }}"> {{ $construction->obra_nombre }}</option>
                @endforeach --}}
            </select>
            {{-- <input type="text" class="form-control" placeholder="Id. Obra" name="remission[data][idObra]" id="idObra" required
                 autofocus="autofocus" value="{{ $remission->id_obra ?? '' }}"> --}}
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <label for="nombreObra" style="font-size: 8pt">Nombre Obra</label>
            <input type="text" class="form-control" placeholder="Obra" name="data[nombreObra]" id="nombreObra"
                disabled="disabled" value="{{ $remission->Construction->obra_nombre ?? '' }}">
        </div>
    </div>
    <div class="row">
        <input id="prefix" type="hidden">
        <div class="col-12 col-sm-6 mb-3">
            <label for="identCliente" style="font-size: 8pt">No. Ident. Cliente</label>
            <input type="text" class="form-control" placeholder="Id. Cliente" name="data[identCliente]"
                id="identCliente" value="{{ $remission->Society->Person->pers_identif ?? '' }}" required disabled>
        </div>
        <div class="col-12 col-sm-6 mb-3">
            <label for="nombreCliente" style="font-size: 8pt">Nombre Cliente</label>
            <input type="text" class="form-control" placeholder="Cliente" name="data[nombreCliente]"
                id="nombreCliente" value="{{ $remission->Society->Person->pers_primernombre ?? '' }}" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-4 mb-3">
            <label for="idSoc" style="font-size: 8pt">Id. Sociedad(*)</label>
            <select class="form-control select2" id="idSoc" onchange="getDataPerson()" name="data[idSoc]">
                <option></option>
                @foreach ($societies as $society)
                    <option value="{{ $society->id }}"> {{ $society->Person->pers_razonsocial }}</option>
                @endforeach
            </select>
            {{-- <input type="text" class="form-control" placeholder="Id. Sociedad" name="data[idSoc]" id="idSoc" required
                onchange="getDataPerson(this.value, 'nombreSoc')" > --}}
        </div>
        <div class="col-12 col-sm-8 mb-3">
            <label for="nombreSoc" style="font-size: 8pt">Nombre Sociedad</label>
            <input type="text" class="form-control" placeholder="Sociedad" name="data[nombreSoc]" id="nombreSoc"
                readonly>
        </div>
    </div>

    
    <div class="row">
        <div class="col-12 col-sm-5 mb-3">
            @php
                $date = \Carbon\Carbon::now();
            @endphp
            <label for="fecha" style="font-size: 8pt">Fecha</label>
            <input type="text" class="form-control" value="{{ $date->format('Y-m-d') }}" disabled>
            <input type="hidden" class="form-control" placeholder="Fecha" name="data[fecha]" id="fecha" required
                value="{{ $date->format('Y-m-d') }}">
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <label for="numFac" style="font-size: 8pt">Número de remisión</label>
            <input type="text" class="form-control numRem" placeholder="Número de remisión" required disabled>
            <input type="hidden" class="form-control numRem" name="data[numRem]" required>
        </div>

    
        <div class="col-12 col-sm-3 mb-2">
    <div class="form-group">
        <label for="pago">Tipo pago</label>
        <select class="form-control" name="data[id_tipopago]">
            @foreach($pago as $pago)
            <option value="{{ $pago['value']}}" {{isset($remission)?$remission->pago:''}}>
                {{ $pago['label']}}
            </option>
            @endforeach
        </select>
      
    </div>
   </div>
        
        

        @can('Cambio de estado')
            <div class="col-12 col-sm-3 mb-3">
                <label for="estado" style="font-size: 8pt">Estado Remisión</label>
                <select class="form-control" name="data[estado]" id="estado" required>
                    <option value="A">ACTIVO</option>
                    <option value="I">INACTIVO</option>
                </select>
            </div>
        @endcan
    </div>
    <div class="row">

        <div class="col-12 col-sm-6 mb-3">
            <label for="plate_vehicle" style="font-size: 8pt">Placa del vehiculo (*)</label>
            @php
                $selectMachine = $remission->id_maquina ?? '';
            @endphp

            <select class="form-control select2" name="data[id_machine]" id="plate_vehicleRemission" onchange="validateCubitaje()">
                <option></option>
                @foreach ($machines as $machine)
                    <option value="{{ $machine->id }}" {{ $selectMachine == $machine->id ? 'selected' : '' }}>
                        {{ $machine->maqn_placa }}</option>
                @endforeach
            </select>
            {{-- <input type="text" class="form-control" placeholder="Id. Máquina" title="Id. Máquina" name="idMaq" id="idMaq" required tabindex="1"> --}}
        </div>

      <!--//Cambiar por direccion-->
      <!-- <div class="col-12 col-sm-6 mb-3">
            <label for="destiny" style="font-size: 8pt">Destino (*)</label>
            <input name="data[destiny]" id="destinyRemission" class="form-control" autocomplete="off" />
        </div>-->
    </div>

    <div class="row">
        <div class="col-12 col-sm-12 mb-3">
            <label for="destiny" style="font-size: 8pt">Observación</label>
            <textarea class="form-control" placeholder="Observaciones" id="obs" name="data[obs]" rows="2" required></textarea>
        </div>
    </div>
    {{-- <div class="row">

    </div> --}}

    <!-- Caja de nuevo detalle --> <!-- #1 ###########-->
    <div class="div" id="detail" style="border : 1px solid #B8DAFF; margin : 4px 4px 1px 4px;">
        <div class="div" style="margin : 8px 8px 1px 8px;">
            <div class="row">
                <input type="hidden" class="form-control" id="totalAcum" value="0">
                <div class="col-9 col-sm-9 mb-3">
                    <label for="idMat" style="font-size: 8pt">Id. Material (NOMBRE DEL MATERIAL)</label>
                    {{-- onchange="getPriceList()" --}}
                    <select class="form-control select2" id="idMat" required>
                        <option value="">Seleccione...</option>
                        {{-- @foreach ($materials as $material)
                            <option value="{{ $material->id }}"> {{ $material->mate_descripcion }} </option>
                        @endforeach --}}
                    </select>
                </div>
                <div class="col-3 col-sm-3 ">
                    <label for="idMat" style="font-size: 8pt">Acción</label>
                    <button class="btn btn-primary btn-sm" onclick="addDetail()" type="button"
                        id="addDetailButton">Agregar producto</button>
                </div>
                {{-- <div class="col-12 col-sm-2 mb-3">
                    <label for="cant" style="font-size: 8pt">Cantidad</label>
                    <input type="text" class="form-control" placeholder="Cantidad" id="cant" value="0" min="0"
                        onkeyup="calcSubt()" required >
                </div>
                <div class="col-12 col-sm-3 mb-3">
                    <label for="unidad" style="font-size: 8pt">Unidad</label>
                    <select class="form-control select2" id="unidad" required >
                        <option value="">Seleccione...</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}"> {{ $unit->unit_descripcion }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-2 mb-3 pt-3">

                    <input type="text" class="form-control" placeholder="Precio Unit." id="punit" value="0" min="0"
                        onkeyup="calcSubt()" required >
                </div>
          
                    <input type="text" class="form-control" placeholder="Subtotal" id="subt" value="0" disabled>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Fin Caja de nuevo detalle --> <!--#2  #######-->
    {{-- <form method="post" id="form-remission"> --}}
    <!-- Tabla detalle remision-->
    <div class="card card-info mt-2">
        <div class="card-body p-0" style="display: block;">
            <div class="table-responsive">

                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            {{-- <th>
                                Id Mat
                            </th> --}}
                            <th>
                                Material
                            </th>
                            <th>
                                Und
                            </th>
                            <th>
                                Cant
                            </th>
                            <th>

                            </th>
                        </tr>
                    </thead>
                     <!-- Hasta aqui termina la grilla -->
                    <tbody id="tbody_remissiondet" name="tbody_remissiondet">
                    </tbody>

                    <tfoot class="table-primary" id="totalRemission">
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
    <!-- Fin tabla -->
    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="saveRemission()" type="button"
                id="sendRemissionButton">Guardar</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Cerrar</button>
        </div>
    </div>
</form>
