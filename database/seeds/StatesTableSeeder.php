<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        // DB::unprepared('alter table countries auto_increment = 1');
        try {
            DB::beginTransaction();
            DB::unprepared(file_get_contents(__DIR__.'/sql/states.sql'));
            DB::commit();
            $out->writeln('Se ejecuto, departamentos');
        } catch (Exception $e) {
            DB::rollBack();
            $out->writeln($e->getMessage());
        }
    }
}
