<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PriceListExport implements FromView
{

    protected  $priceLists;

    public function __construct($priceLists)
    {
        $this->priceLists= $priceLists;
    }

    public function view(): View
    {
        return view('priceLists.excel.index', [
            'priceLists' =>$this->priceLists
        ]);
    }
}