<form id="form-material-movement">
    @csrf
    <input type="hidden" class="form-control" name="prod_id" id="prod_id"
        value="{{ isset($production->id) ? $production->id : '' }}">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Tipo de movimiento (*)</label>
                <select class="form-control select2" name="typeProduction" id="typeProduction"
                    onchange="disableMaquineDepositeView()">
                    @php
                        $selected = $production->typeProduction ?? '';
                    @endphp
                    <option value=""></option>
                    <option value="E" {{ $selected === 'E' ? 'selected' : '' }}>E - ENTRADA</option>
                    <option value="S" {{ $selected === 'S' ? 'selected' : '' }}>S - SALIDA</option>
                    <option value="I" {{ $selected === 'I' ? 'selected' : '' }}>I - INVENTARIO</option>
                    {{--  <option value="EM" {{ $selected === 'I' ? 'selected' : '' }}>EM - ENTRADA MANUAL</option>  --}}
                </select>
                {{-- <input type="number" min="0"  value="{{ $fuelsshopping->ccmb_unidad ?? '' }}"> --}}
            </div>
        </div>
        <div class="col-6" id="div_maquineDeposite">
            <div class="form-group">
                <label class="control-label">Maquina que deposita (*)</label>
                <select class="form-control select2" name="prod_idmaqdeposita" id="prod_idmaqdeposita"
                    onchange="maquineDeposite()">
                    @php
                        $selected = $production->prod_iddispositivo ?? '';
                    @endphp

                    <option selected value=""></option>
                    @foreach ($machines as $machine)
                        <option value="{{ $machine->id }}" {{ $selected === $machine->id ? 'selected' : '' }}>
                            {{ $machine->maqn_placa }}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="col-6" id="div_materialPrima">
            <div class="form-group">
                <label class="control-label" id="materialPrima">Materia prima (*)</label>
                @php
                    $selected = $production->prod_idmateriaprima ?? '';
                @endphp
                <select class="form-control select2" name="prod_idmateriaprima" id="prod_idmateriaprima">
                    <option selected value=""></option>
                    @foreach ($commodities as $commodity)
                        <option value="{{ $commodity->id }}" {{ $selected === $commodity->id ? 'selected' : '' }}>
                            {{ $commodity->matp_descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="col-6" id="div_material">
            <div class="form-group">
                <label class="control-label" id="material">Materiales(*)</label>
                @php
                    $selected = $production->prod_idmaterial ?? '';
                @endphp
                <select class="form-control select2" name="prod_idmaterial" id="prod_idmaterial">
                    <option selected value=""></option>
                    @foreach ($materials as $material)
                        <option value="{{ $material->id }}" {{ $selected === $material->id ? 'selected' : '' }}>
                            {{ $material->mate_descripcion }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6" id="div_prod_iddispositivo">
            <div class="form-group">
                <label class="control-label" id="salida">Disposito que recibe el material(*)</label>
                @php
                    $selected = $production->prod_iddispositivo ?? '';
                @endphp
                <select class="form-control select2" name="prod_iddispositivo" id="prod_iddispositivo">
                    <option selected value=""></option>
                    @foreach ($devices as $device)
                        <option value="{{ $device->id }}" {{ $selected === $device->id ? 'selected' : '' }}>
                            {{ $device->disp_descripcion }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fecha (*)</label>
                @php
                    $date = \Carbon\Carbon::now();
                @endphp
                <!-- Esta editable por solicitud del sr Mario Fra@y luis 17/03/2023-->
                <input type="date" class="form-control" name="prod_fecha" id="prod_fecha"
                    value="{{ $production->prod_fecha ?? $date->format('Y-m-d') }}">

            </div>
        </div>
        <div class="col-6"  id ="prod_numviajes" >
            <div class="form-group">
                <label class="control-label"  >Número de viaje (*)</label>
                <input type="number" class="form-control" name="prod_numviajes" id="prod_numviajes"
                    onkeyup="operationMaterial()" min="0" value="{{ $production->prod_numviajes ?? '' }}">

            </div>
        </div>
        <div class="col-6"  id ="prod_cubicaje" >
            <div class="form-group">
                <label class="control-label"   >Cubicaje (*)</label>
                <input type="number" class="form-control" id="prod_cubicaje" name="prod_cubicaje"
                    onkeyup="operationMaterial()" min="0" value="{{ $production->prod_cubicaje ?? '' }}">

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Volumen (*)</label>
                <input type="number" class="form-control" name="prod_volumen" id="prod_volumen" min="0"
                    value="{{ $production->prod_volumen ?? '' }}">

            </div>
        </div>
        <div class="col-6" id="div_option">


        <div class="col-6" id="div_options_id">
            <div class="form-group">
                <label class="control-label" id="options_id">Opciones de produccion</label>
             
                <select class="form-control select2" name="options_id" id="options_id">
                    <option selected value=""></option>
                    @foreach ($options as $option)
                        <option value="{{ $option->id }}" {{ $selected === $option->id ? 'selected' : '' }}>
                            {{ $option->nom_option }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        </div>
      
    </div>
  
   
    @include('layouts.button', ['function' => 'saveProduction()'])
</form>
