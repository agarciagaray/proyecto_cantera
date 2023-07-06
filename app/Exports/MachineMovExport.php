<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class MachineMovExport implements FromView
{
    // use Exportable;
    protected $id_conductor,$idMachine, $dateStart, $dateEnd;

    public function __construct($id_conductor,$idMachine, $dateStart , $dateEnd )
    { 
        $this->idMachine = $idMachine;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
         $this-> id_conductor=$id_conductor;
    }

    public function view(): View
    {
         $machinesMON  = DB::select("call sp_consulta_movimiento_maquina('$this->id_conductor','$this->idMachine', '$this->dateStart', '$this->dateEnd')");
       
        return view('machinesmovs.excel.index', compact('machinesMON'));
    }

    
    // public function collection()
    // {
    //     $idMachine = $this->idMachine;

    //     $machineMovs  = MachineMov::query();

    //     $machineMovs->whereDoesntHave('Machine', function ($query) use ($idMachine) {

    //         $query->whereDoesntHave('Tankmachines', function ($query1) use ($idMachine) {
    //         });
    //     });
    //     $machineMovs->where('mqmv_estado', 'A');
    //     if ($idMachine) {
    //         $machineMovs->where('mqmv_idmaquina',  $idMachine);
    //     }
    //     if ($this->dateStart && $this->dateEnd == '') {
    //         $machineMovs->where('mqmv_fecha', $this->dateStart);
    //     }
    //     if ($this->dateStart && $this->dateEnd) {
    //         $machineMovs->whereBetween('mqmv_fecha', [$this->dateStart, $this->dateEnd]);
    //     }

    //     // dd( $machineMovs->get());
    //     $collection = [];
    //     $collectionTank = [];
    //     $collectionMachinePayment = [];
    //     $collectionMachineObs = [];
    //     $volum = 0;
    //     $total_tank = 0;
    //     $valor_payment = 0;
    //     $obs = '';
    //     foreach ($machineMovs->get() as  $value) {

    //         $hour = (int) $value->mqmv_hfin - (int) $value->mqmv_hinicio;
    //         $horometro = (int) $value->horometro_hfinal - (int) $value->horometro_hinicio;

    //         $mqmv_fecha = $value->mqmv_fecha;
    //         // dump($mqmv_fecha);

    //         foreach ($value->Machine->MachinePayments as $payment) {
    //             $mqdt_fecha = $payment->mqpg_fecha;

    //             if ($mqdt_fecha  == $mqmv_fecha) {

    //                 if (isset($collectionMachinePayment[$mqmv_fecha])) {
    //                     $valor_payment  = $payment->mqpg_vlrpagado + $collectionMachinePayment[$mqmv_fecha]['mqpg_expenses'];
    //                     // dump($valor_payment);
    //                     $obs =  $payment->mqpg_obs . ', ' . $collectionMachinePayment[$mqmv_fecha]['mqpg_obs'];
    //                     $collectionMachinePayment[$mqmv_fecha]['mqpg_expenses'] = $valor_payment;
    //                 } else {
    //                     $obs = $payment->mqpg_obs;
    //                     $valor_payment = $payment->mqpg_vlrpagado;
    //                 }

    //                 $collectionMachinePayment[$mqmv_fecha]['mqpg_obs'] = $obs;
    //                 $collectionMachinePayment[$mqmv_fecha]['mqpg_concepto'] = $payment->ConceptPayment->cncp_nombre;
    //                 $collectionMachinePayment[$mqmv_fecha]['mqpg_expenses'] = $valor_payment;
    //             }
    //         }


    //         foreach ($value->Machine->Tankmachines as $tank) {

    //             $tanq_fecha = $tank->tanq_fecha;

    //             // if ($tanq_fecha  == $mqmv_fecha) {
    //             if (isset($collectionTank[$mqmv_fecha])) {
    //                 // $valor_payment  =$payment->mqpg_vlrpagado+$collectionMachinePayment[$mqmv_fecha]['mqpg_expenses'];
    //                 $volum = $tank->tanq_volumen +  $collectionTank[$mqmv_fecha]['tanq_volumen'];

    //                 $total_tank = $tank->tanq_volumen * isset($tank->Fuelsshopping) ? $tank->Fuelsshopping->ccmb_vlrunidad : 1 + $collectionTank[$mqmv_fecha]['total_del_tanqueo'];
    //             } else {
    //                 $volum = $tank->tanq_volumen;
    //                 $total_tank = $tank->tanq_volumen * isset($tank->Fuelsshopping) ? $tank->Fuelsshopping->ccmb_vlrunidad : 1;
    //             }

    //             $collectionTank[$mqmv_fecha]['id'] = $tank->id;
    //             $collectionTank[$mqmv_fecha]['tanq_fecha'] = $tank->tanq_fecha;
    //             $collectionTank[$mqmv_fecha]['tanq_volumen'] = $volum;
    //             $collectionTank[$mqmv_fecha]['valor_tanqueo'] = isset($tank->Fuelsshopping) ? $tank->Fuelsshopping->ccmb_vlrunidad : 0;
    //             $collectionTank[$mqmv_fecha]['total_del_tanqueo'] = $total_tank;
    //             // }
    //         }
    //         $Obs = "";
    //         foreach ($value->Machine->MachineObs as $machineObs) {

    //             $mqdt_fecha = $machineObs->mqdt_fecha;

    //             if ($mqdt_fecha  == $mqmv_fecha) {
    //                 $Obs = $Obs . ' ' . $machineObs->mqdt_obs . ',';
    //                 $collectionMachineObs[$mqmv_fecha]['machineObs'] = $Obs;
    //                 // $Obs = '';
    //             }
    //         }
    //         $machinePaymentObs = "";
    //         foreach ($value->Machine->MachinePayments as $machinePayment) {

    //             $mqpg_fecha = $machinePayment->mqpg_fecha;

    //             if ($mqpg_fecha  == $mqmv_fecha) {
    //                 $machinePaymentObs = $machinePaymentObs . ' ' . $machineObs->mqdt_obs . ',';
    //                 $collectionMachineObs[$mqmv_fecha]['machinePaymentObs'] = $machinePaymentObs;
    //                 // $Obs = '';
    //             }
    //         }

    //         array_push($collection, [

    //             "mqmv_fecha" => $value->mqmv_fecha,
    //             "mqmv_idmaquina" => $value->Machine->maqn_placa,
    //             "mqmv_hinicio" => $value->mqmv_hinicio,
    //             "mqmv_hfin" => $value->mqmv_hfin,
    //             "horometro_hinicio" => $value->horometro_hinicio,
    //             "horometro_hfinal" => $value->horometro_hfinal,
    //             'acpm' =>  $collectionTank[$mqmv_fecha]['tanq_volumen'] ?? 0,
    //             'valor_galon' => $collectionTank[$mqmv_fecha]['valor_tanqueo'] ?? 0,
    //             'consumo_acpm' => $collectionTank[$mqmv_fecha]['total_del_tanqueo'] ?? 0,
    //             "horas" => $hour == 0 ? $horometro : $hour,
    //             "mqmv_vlrhora" => $value->mqmv_vlrhora,
    //             "total_dia" => ($hour == 0 ? $horometro : $hour) * $value->mqmv_vlrhora,
    //             'observación' => $collectionMachineObs[$mqmv_fecha]['machineObs'] ?? '',
    //             'gastos_otros' => $collectionMachineObs[$mqmv_fecha]['machinePaymentObs'] ?? '',
    //             'gastos' =>  $collectionMachinePayment[$mqmv_fecha]['mqpg_expenses'] ?? ''

    //         ]);
    //     }
    //     // dump($collectionMachinePayment);
    //     // dd($collection);
    //     return collect([
    //         $collection
    //     ]);
    // }

    // public function headings(): array
    // {
    //     return [
    //         'Fecha',
    //         'Maquina placa',
    //         'Hora inicial',
    //         'Hora final',
    //         'Horometro inicial',
    //         'Horometro final',
    //         'ACMP',
    //         'Valor galón',
    //         'Acpm',
    //         'Horas',
    //         'Valor hora',
    //         'Total dia',
    //         'Observación',
    //         'Gastos',
    //     ];
    // }
    // public function columnWidths(): array
    // {
    //     return [
    //         'A' => 25,
    //         'B' => 25,
    //         'C' => 12,
    //         'D' => 12,
    //         'E' => 30,
    //         'F' => 30,
    //         'G' => 12,
    //         'H' => 15,
    //         'I' => 15,
    //         'J' => 15,
    //         'K' => 20,
    //         'L' => 20,
    //         'M' => 70,
    //         'N' => 70,
    //         'O' => 20,
    //     ];
    // }
    // public function styles(Worksheet $sheet)
    // {
    //     return [
    //         // Style the first row as bold text.
    //         1    => ['font' => ['bold' => true, 'text-align' => 'center']],

    //         // Styling a specific cell by coordinate.
    //         // 'B2' => ['font' => ['italic' => true]],

    //         // Styling an entire column.
    //         // 'C'  => ['font' => ['size' => 16]],
    //     ];
    // }
    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class    => function (AfterSheet $event) {

    //             $cellRange = 'A1:N1'; // All headers
    //             //    $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Calibri');

    //             $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()
    //                 ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //             //    $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);


    //         },
    //     ];
    // }
    // public function properties(): array
    // {
    //     return [
    //         'creator'        => auth()->user()->name,
    //         'lastModifiedBy' => auth()->user()->name,
    //         'title'          => 'Exportar movimientos de maquinas de' . $this->dateStart . 'a' . $this->dateEnd,
    //         'description'    => 'Movimientos de maquinas',
    //         'subject'        => 'Movimientos de maquina',
    //         'keywords'       => 'Movimientos de maquina',
    //         'category'       => 'Movimientos de maquina',
    //         'manager'        => auth()->user()->name,
    //         'company'        => 'Cantera',
    //     ];
    // }
    // public function title(): string
    // {
    //     $machine = MachineModel::getMachine($this->idMachine);
    //     if ($machine) {

    //         return $machine->MachineType->tmaq_nombre . ' ' . $machine->maqn_placa;
    //     }
    //     return 'Reporte de ' . $this->dateStart . 'a' . $this->dateEnd;
    // }
}
// <?php

// namespace App\Exports;

// use App\Models\MachineMov;
// use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromView;


// class MachineMovExport implements FromView
// {

//     // use Exportable;

//     protected $idMachine,$dateStart,$dateEnd;

//     public function __construct(int $idMachine, string $dateStart, string $dateEnd) {

//         $this->idMachine = $idMachine;
//         $this->dateStart = $dateStart;
//         $this->dateEnd = $dateEnd;

//     }
//     // /**
//     // * @return \Illuminate\Support\Collection
//     // */
//     public function view(): View {

//         $idMachine =$this->idMachine;
//         $machineMovs  = MachineMov::query();
//         $machineMovs->whereHas('Machine', function ($query) use ( $idMachine) {
//             $query->whereHas('Tankmachines', function ($query1) use ( $idMachine) {
//                 $query1->whereBetween('tanq_fecha', [$this->dateStart, $this->dateEnd]);
//              });


//          });
//          $machineMovs->where('mqmv_idmaquina',  $idMachine);
//          $machineMovs->whereBetween('created_at', [$this->dateStart, $this->dateEnd]);
//         //  $machineMovs->select('mqmv_finicio','mqmv_ffin','mqmv_vlrhora','created_at');
//         return view('reports.reportMachinesMov', [
//             'machinesMovs' =>  $machineMovs->get()
//         ]);
//     }
// }