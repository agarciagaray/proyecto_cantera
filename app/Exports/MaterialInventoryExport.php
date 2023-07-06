<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class MaterialInventoryExport implements FromView
{
    protected  $materialInventory;

    public function __construct($materialInventory)
    {

        $this->materialInventory= $materialInventory;

    }

    public function view(): View
    {
        return view('inventories.excel.indexMaterialInventory', [
            'materialInventory' => $this->materialInventory,
        ]);
    }
}
