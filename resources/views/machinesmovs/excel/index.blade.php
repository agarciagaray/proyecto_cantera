<div class="card card-info">
    <div class="card-header">
        <h1 class="card-title"><b>LISTADO DE MOVIMIENTOS DE MAQUINAS</b></h1>
    </div>


<table class="table" id="table-machineMov">



    <thead class="table-primary">


   
 
        <tr>

   
            <th style="width: 100px;text-align:center"><b>Id</b></th>
            <th style="width: 100px;text-align:center"><b>Fecha</b></th>
            <th style="width: 100px;text-align:center"><b>Maquina placa</b></th>
            <th style="width: 300px;text-align:center"><b>Conductor</b></th> 
            <th style="width: 100px;text-align:center"><b>Hora inicial</b></th>
            <th style="width: 100px;text-align:center"><b>Hora final</b></th>
            <th style="width: 150px;text-align:center"><b>Horometro inicial</b></th>
            <th style="width: 150px;text-align:center"><b>Horometro final</b></th>
             <th style="width: 100px;text-align:center"><b>Horas</b></th>
            <th style="width: 100px;text-align:center"><b>Valor hora</b></th>
            <th style="width: 100px;text-align:center"><b>Total dia</b></th>
            <th style="width: 100px;text-align:center"><b>ACPM</b></th> <!--Este es volumen en la parte de tanqueo de mauinas -->
            <th style="width: 100px;text-align:center"><b>Valor galón</b></th>
            <th style="width: 100px;text-align:center"><b>Total</b></th> <!--Este es el valor del  volumen por defecto -->
            <th style="width: 300px;text-align:center"><b>Observación</b></th> 
           
            <th style="width: 100px;text-align:center"><b>Gastos</b></th>

        </tr>
    </thead>
    <tbody>
        @foreach ($machinesMON as $machine)
            <tr>
                <td @if($machine->mqmv_estado== 'I') style='background-color:#e1a900;color:white' @endif>{{ $machine->id ??""}}</td>
                <td @if($machine->mqmv_estado== 'I') style='background-color:#e1a900;color:white' @endif>{{ $machine->mqmv_fecha }}</td>
                <td @if($machine->mqmv_estado== 'I') style='background-color:#e1a900;color:white' @endif>{{ $machine->maqn_placa }}</td> 
                <td @if($machine->mqmv_estado== 'I') style='background-color:#e1a900;color:white' @endif>{{ $machine->pers_razonsocial }}</td> 
                <td @if($machine->mqmv_estado== 'I') style='background-color:#e1a900;color:white' @endif>{{ $machine->mqmv_hinicio }}</td>
                <td @if($machine->mqmv_estado== 'I') style='background-color:#e1a900;color:white' @endif>{{ $machine->mqmv_hfin }}</td>
                <td @if($machine->mqmv_estado== 'I') style='background-color:#e1a900;color:white' @endif>{{ $machine->horometro_hinicio}}</td>
                <td @if($machine->mqmv_estado== 'I') style='background-color:#e1a900;color:white' @endif>{{ $machine->horometro_hfinal }}</td>
                <td @if($machine->mqmv_estado== 'I') style='background-color:#e1a900;color:white' @endif>{{ $machine->diffHora == null ? $machine->diffHorometro : $machine->diffHora}}</td>
                <td @if($machine->mqmv_estado== 'I') style='background-color:#e1a900;color:white' @endif>{{ number_format($machine->mqmv_vlrhora) }}</td>
                <td @if($machine->mqmv_estado== 'I') style='background-color:#e1a900;color:white' @endif>{{ number_format(($machine->diffHora == null ? $machine->diffHorometro : $machine->diffHora) * $machine->mqmv_vlrhora) }}</td>
                <td @if($machine->mqmv_estado== 'I') style='background-color:#e1a900;color:white' @endif>{{ $machine->tanq_volumen }}</td>  <!-- relacion-->
                <td @if($machine->mqmv_estado== 'I') style='background-color:#e1a900;color:white' @endif>{{ number_format($machine->ccmb_vlrunidad) }}</td>
               <td @if($machine->mqmv_estado== 'I') style='background-color:#e1a900;color:white' @endif>{{ number_format($machine->tanq_volumen *$machine->ccmb_vlrunidad) }}</td><!-- relacion-->    
               <td @if($machine->mqmv_estado== 'I') style='background-color:#e1a900;color:white' @endif>{{ $machine->mqmv_obs }}</td>   
                <td @if($machine->mqmv_estado== 'I') style='background-color:#e1a900;color:white' @endif>{{ number_format($machine->mqpg_vlrpagado) }}</td>
                              </tr>
        @endforeach
    </tbody>
</table>
