<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
     
        try {
            DB::beginTransaction();
            DB::unprepared(file_get_contents(__DIR__.'/sql/countries.sql'));
            DB::commit();
            $out->writeln('Se ejecuto, paises');
        } catch (Exception $e) {
            DB::rollBack();
            $out->writeln($e->getMessage());
        }
    }
}
