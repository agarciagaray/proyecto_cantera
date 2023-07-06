<form id="form-tankmachines">
    {{-- enctype="multipart/form-data" --}}
    @csrf
    <input type="hidden" class="form-control" name="id" id="id" value="{{ $machineTanking->id ?? '' }}">
    <div class="row">
        <div class="col-6" id="fuelsshopping">
            <div class="form-group">
                <label class="control-label">Remisión (*)</label>
                <select class="form-control select2" name="cubt_idcompra" id="cubt_idcompra" >
                    @php
                        $selected = $cubitanksLoading->cubt_idcompra ?? '';
                    @endphp

                    @foreach ($fuelsshoppings as $fuelsshopping)
                        <option value="{{ $fuelsshopping->id }}"
                            {{ $selected === $fuelsshopping->id ? 'selected' : '' }}>
                            {{ $fuelsshopping->ccmb_numremision }}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Origen (*)</label>
                <select class="form-control select2" name="tanq_origen" id="tanq_origen" onchange="fuelsshoppingView()">
                    @php
                        $selectedTanking = $machineTanking->tanq_origen ?? '';
                    @endphp
                    <option value="CT" {{ $selectedTanking === 'CT' ? 'selected' : '' }}>CT - CARROTANQUE</option>
                    <option value="CB" {{ $selectedTanking === 'CB' ? 'selected' : '' }}>CB - CUBITANQUE</option>
                    <option value="EX" {{ $selectedTanking === 'EX' ? 'selected' : '' }}>EX - EXTERNO</option>
                </select>
            </div>
        </div>
        <div class="col-6" style="display:none" id="cubitanque">
            <div class="form-group">
                <label class="control-label">Cubitanque</label>
                <select class="form-control select2" name="cub_id" id="cub_id" onclick="price_galon()">
                    @php
                        $selectedMachine = $machineTanking->cub_id ?? '';
                    @endphp

                    @foreach ($tankings as $machine)
                        <option value="{{ $machine->id }}" {{ $selectedMachine === $machine->id ? 'selected' : '' }}>
                            {{ $machine->maqn_placa }}
                        </option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Máquina (*)</label>
                <select class="form-control select2" name="tanq_idmaquina" id="tanq_idmaquina">
                    @php
                        $selectedMachineTanq = $machineTanking->tanq_idmaquina ?? '';
                    @endphp

                    @foreach ($machines as $machine)
                        <option value="{{ $machine->id }}"
                            {{ $selectedMachineTanq === $machine->id ? 'selected' : '' }}>{{ $machine->maqn_placa }} -
                            {{ $machine->MachineType->tmaq_nombre }}
                        </option>
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
                <input type="text" class="form-control" disabled
                    value="{{ $machineTanking->tanq_fecha ?? $date->format('Y-m-d') }}">
                <input type="hidden" class="form-control" name="tanq_fecha" id="tanq_fecha"
                    value="{{ $machineTanking->tanq_fecha ?? $date->format('Y-m-d') }}">

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Volumén (*)</label>
                <input type="number" min="0" class="form-control" name="tanq_volumen" id="tanq_volumen"
                    autocomplete="off" value="{{ $machineTanking->tanq_volumen ?? '' }}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Unidad</label>
                <select class="form-control select2" name="tanq_unidad" id="tanq_unidad">
                    @php
                        $selectedUnidad = $machineTanking->tanq_unidad ?? '';
                    @endphp
                    {{-- <option value="LT" {{ $selectedUnidad=== 'LT' ? 'selected' : '' }}>LT - LITRO</option> --}}
                    <option value="MC" {{ $selectedUnidad === 'MC' ? 'selected' : '' }}>MC - METRO CUBICO</option>
                    <option value="GL" {{ $selectedUnidad === 'GL' ? 'selected' : '' }}>GL - GALONES</option>
                </select>
            </div>
        </div>
        <div class="col-6" style="display: none" id="div_tanq_valor_tanqueo_ext">
            <div class="form-group">
                <label class="control-label">Valor</label>
                <input class="form-control" id="tanq_valor_tanqueo_ext" name="tanq_valor_tanqueo" type="number" min="0">
            </div>
        </div>
        <div class="col-12" >
            <div class="form-group">
                <label class="control-label">Observación</label>
                <textarea class="form-control" name="tanq_observaciones" id="tanq_observaciones" autocomplete="off">{{ $machineTanking->tanq_observaciones ?? '' }}</textarea>
    
            </div>
        </div>
    
    </div>


    @include('layouts.button', ['function' => 'saveMachineTanking()'])
</form>
