<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MaterialOverviewExport implements FromView
{
    protected  $materialsOverview;
   // protected  $materialsOverview;

    public function __construct($materialsOverview)
    {
        $this->materialsOverview= $materialsOverview;
    }

    public function view(): View
    {
        return view('reports.excel.materialOverview', [
            'materialsOverview' =>$this->materialsOverview
        ]);
    }
}
