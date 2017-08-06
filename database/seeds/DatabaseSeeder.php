<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\User::class, 100 )->create();
        // $this->call(UsersTableSeeder::class);
        factory(App\CashRoutesModel::class, 10000)->create();
    }
}
