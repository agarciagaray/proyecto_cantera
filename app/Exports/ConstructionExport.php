<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ConstructionExport implements FromView
{
    protected  $constructions;

    public function __construct($constructions)
    {
        $this->constructions= $constructions;
    }

    public function view(): View
    {
        return view('constructions.excel.index', [
            'constructions' =>$this->constructions
        ]);
    }
}
