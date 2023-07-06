<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MaterialOverviewSocietyExport implements FromView
{
    protected  $materialsOverviewSocieties;

    public function __construct($materialsOverviewSocieties)
    {
        $this->materialsOverviewSocieties= $materialsOverviewSocieties;
    }

    public function view(): View
    {
        return view('reports.excel.materialOverviewSociety', [
            'materialsOverviewSocieties' =>$this->materialsOverviewSocieties
        ]);
    }
}
