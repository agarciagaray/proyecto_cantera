<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CommodiesProductionExport implements FromView
{
    protected  $commodiesProduction;

    public function __construct($commodiesProduction)
    {
        $this->commodiesProduction= $commodiesProduction;
    }

    public function view(): View
    {
        return view('reports.excel.commoditiesProduction', [
            'commodiesProduction' =>$this->commodiesProduction
        ]);
    }

}
