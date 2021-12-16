<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conjunto;

class ConjuntoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Conjunto::factory(1)->create();
    }
}
