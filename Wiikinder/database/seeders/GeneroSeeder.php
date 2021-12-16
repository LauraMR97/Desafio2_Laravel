<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genero;
class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genero= new Genero;
        $genero->descripcion='Hombre';
        $genero->save();


        $genero= new Genero;
        $genero->descripcion='Mujer';
        $genero->save();

        $genero= new Genero;
        $genero->descripcion='Ambos';
        $genero->save();
    }
}
