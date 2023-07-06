<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PorcentajesExport implements  FromView
{
    protected $porcentajes;

    public function __construct($porcentajes)
    {
        $this->porcentajes = $porcentajes;

    }

    public function view(): View
    {
        return view('optionsdetails.excel.index', ['porcentajes' =>  $this->porcentajes]);
    }
}
