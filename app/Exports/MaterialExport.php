<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MaterialExport implements  FromView
{
   
    protected  $remissions,$date,$user;

    public function __construct($remissions, $date, $user)
    {

        $this->remissions= $remissions;
        $this->date = $date;
        $this->user = $user;
    }

    public function view(): View
    {
        return view('reports.excel.reportRemissionMaterials', [
            'remissions' => $this->remissions,
            'date'=>$this->date,
            'user'=>$this->user
        ]);
    }

}
