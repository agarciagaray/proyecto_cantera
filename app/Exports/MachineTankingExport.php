<?php

namespace App\Exports;

use App\Models\MachineTanking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class MachineTankingExport implements FromView
{
    protected  $machineTanking;

    public function __construct($machineTanking)
    {

        $this->machineTanking= $machineTanking;

    }

    public function view(): View
    {
        return view('inventories.excel.index', [
            'inventories' => $this->machineTanking,
        ]);
    }

}
