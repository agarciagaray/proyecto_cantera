<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RemissionLiquidatedExport implements  FromView
{
    protected $remissions;

    public function __construct($remissions)
    {
        $this->remissions = $remissions;

    }

    public function view(): View
    {
        return view('invoices.excel.index', ['remissions' =>  $this->remissions]);
    }
}
