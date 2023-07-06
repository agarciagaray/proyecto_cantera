<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RemissionToLiquidareExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected  $remissions,$date,$user;

    public function __construct($remissions)
    {

        $this->remissions= $remissions;

    }
    public function view(): View
    {
        return view('invoices.excel.remittanceToLiquidate', [
            'remissions' => $this->remissions,
        ]);
    }
}
