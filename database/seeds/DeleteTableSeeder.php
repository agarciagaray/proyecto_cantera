<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DeleteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::delete("delete from remissionsdetails");
        DB::statement("ALTER TABLE remissionsdetails AUTO_INCREMENT =  1");

        DB::delete("delete from remissionsnovelties");
        DB::statement("ALTER TABLE remissionsnovelties AUTO_INCREMENT =  1");

        DB::delete("delete from remissions");
        DB::statement("ALTER TABLE remissions AUTO_INCREMENT =  1");

        DB::delete("delete from productions");
        DB::statement("ALTER TABLE productions AUTO_INCREMENT =  1");

        DB::delete("delete from  constructions");
        DB::statement("ALTER TABLE constructions AUTO_INCREMENT =  1");

        
        DB::delete("delete from  commodities");
        DB::statement("ALTER TABLE commodities AUTO_INCREMENT =  1");

        
        DB::delete("delete from devices");
        DB::statement("ALTER TABLE devices AUTO_INCREMENT =  1");

        DB::delete("delete from materials");
        DB::statement("ALTER TABLE materials AUTO_INCREMENT =  1");

        DB::delete("delete from Roles");
        DB::statement("ALTER TABLE Roles AUTO_INCREMENT =  1");

        DB::delete("delete from suppliers");
        DB::statement("ALTER TABLE suppliers AUTO_INCREMENT =  1");

        DB::delete("delete from societies");
        DB::statement("ALTER TABLE societies AUTO_INCREMENT =  1");

        DB::delete("delete from clients");
        DB::statement("ALTER TABLE clients AUTO_INCREMENT =  1");

        DB::delete("delete from persons");
        DB::statement("ALTER TABLE persons AUTO_INCREMENT =  1");

        
        DB::delete("delete from machines");
        DB::statement("ALTER TABLE machines AUTO_INCREMENT =  1");
        
        DB::delete("delete from machinestypes");
        DB::statement("ALTER TABLE machinestypes AUTO_INCREMENT =  1");

        DB::delete("delete from units");
        DB::statement("ALTER TABLE units AUTO_INCREMENT =  1");
        
        DB::delete("delete from Users");
        DB::statement("ALTER TABLE Users AUTO_INCREMENT =  1");
        DB::delete("delete from Permissions");
        DB::statement("ALTER TABLE Permissions AUTO_INCREMENT =  1");
        DB::delete("delete from model_has_roles");
        DB::statement("ALTER TABLE model_has_roles AUTO_INCREMENT =  1");
        DB::delete("delete from role_has_permissions");
        DB::statement("ALTER TABLE role_has_permissions AUTO_INCREMENT =  1");
        DB::delete("delete from remissionconcnovelties");
        DB::statement("ALTER TABLE remissionconcnovelties AUTO_INCREMENT =  1");
        DB::delete("delete from cities");
        DB::statement("ALTER TABLE cities AUTO_INCREMENT =  1");
        DB::delete("delete from states");
        DB::statement("ALTER TABLE states AUTO_INCREMENT =  1");
        DB::delete("delete from countries");
        DB::statement("ALTER TABLE countries AUTO_INCREMENT =  1");

        DB::delete("delete from economicacts");
        DB::statement("ALTER TABLE economicacts AUTO_INCREMENT =  1");

          

    }
}
