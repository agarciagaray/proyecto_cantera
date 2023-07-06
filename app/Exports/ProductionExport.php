<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductionExport implements FromView
{
    protected   $productions, $date, $user;

    public function __construct($productions, $date, $user)
    {
        $this->productions =  $productions;
        $this->date = $date;
        $this->user = $user;
    }
    public function view(): View
    {
        return view('reports.excel.reportProductions', [
            'productions' => $this->productions,
            'date'=>$this->date,
            'user'=>$this->user
        ]);
    }

}

