<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RemissionNovExportList implements FromView
{
    protected  $remissionnovs;

    public function __construct($remissionnovs)
    {

        $this->remissionnovs= $remissionnovs;
    }
    public function view(): View
    {
        return view('remissionnovelties.excel.index', [
            'remissionnovs' => $this->remissionnovs
        ]);
    }
}