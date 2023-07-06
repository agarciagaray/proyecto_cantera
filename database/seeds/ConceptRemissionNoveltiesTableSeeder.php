<?php

use App\Models\RemissionConceptNovelty;
use Illuminate\Database\Seeder;

class ConceptRemissionNoveltiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conceptRemissionNovelties = [
            [
                'id'    => 1,
                'cncn_nombre' => 'Cambio de tercero',
            ],
            [
                'id'    => 2,
                'cncn_nombre' => 'Cambio de volumén'
            ],
            [
                'id'    => 3,
                'cncn_nombre' => 'Cambio de fecha'
            ]
            
        ];

        RemissionConceptNovelty::insert($conceptRemissionNovelties);
    }
}
