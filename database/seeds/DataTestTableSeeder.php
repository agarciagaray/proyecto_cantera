<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataTestTableSeeder extends Seeder
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

            DB::unprepared(file_get_contents(__DIR__.'/sql/economicacts.sql'));
            DB::unprepared(file_get_contents(__DIR__.'/sql/persons.sql'));
            DB::unprepared(file_get_contents(__DIR__.'/sql/societies.sql'));
            DB::unprepared(file_get_contents(__DIR__.'/sql/clients.sql'));
            DB::unprepared(file_get_contents(__DIR__.'/sql/suppliers.sql'));
            DB::unprepared(file_get_contents(__DIR__.'/sql/machinestypes.sql'));
            DB::unprepared(file_get_contents(__DIR__.'/sql/units.sql'));
            DB::unprepared(file_get_contents(__DIR__.'/sql/machines.sql'));
            DB::unprepared(file_get_contents(__DIR__.'/sql/devices.sql'));
            DB::unprepared(file_get_contents(__DIR__.'/sql/commodities.sql'));
            DB::unprepared(file_get_contents(__DIR__.'/sql/productions.sql'));
            DB::unprepared(file_get_contents(__DIR__.'/sql/constructions.sql'));
            DB::unprepared(file_get_contents(__DIR__.'/sql/materials.sql'));
            DB::unprepared(file_get_contents(__DIR__.'/sql/remissions.sql'));
            DB::unprepared(file_get_contents(__DIR__.'/sql/remissionsnovelties.sql'));
            DB::unprepared(file_get_contents(__DIR__.'/sql/remissionsdetails.sql'));
            
            
            DB::commit();
            $out->writeln('Se ejecuto, correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            $out->writeln($e->getMessage());
        }
    }
}
