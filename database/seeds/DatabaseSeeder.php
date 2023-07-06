<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // php artisan db:wipe

        $this->call(DeleteTableSeeder::class);

        $this->call(AdminTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);

        $this->call(PermissionRoleTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(ConceptRemissionNoveltiesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);

        $this->call(DataTestTableSeeder::class);
    }
}
