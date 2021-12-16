<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persona;
use App\Models\Conjunto;
use App\Models\GustoGenero;
use App\Models\PersonaPreferencia;
use Database\Factories\PersonaFactory;
use App\Http\Controllers\miControlador;


class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $interesGenero=rand(1,3);
        $Deportivos=rand(0,100);
        $Artisticos=rand(0,100);
        $Politicos=rand(0,100);

        for($i=0;$i<2;$i++){
        Persona::factory(1)->create();
        Conjunto::create(['correo'=>PersonaFactory::$correo,'id_rol'=>2]);
        GustoGenero::create(['id'=>$interesGenero,'correo'=>PersonaFactory::$correo]);
        PersonaPreferencia::create(['correo'=>PersonaFactory::$correo,'id_preferencia'=>1,'intensidad'=>$Deportivos]);
        PersonaPreferencia::create(['correo'=>PersonaFactory::$correo,'id_preferencia'=>2,'intensidad'=>$Artisticos]);
        PersonaPreferencia::create(['correo'=>PersonaFactory::$correo,'id_preferencia'=>3,'intensidad'=>$Politicos]);
        miControlador::calcularPreferencias($interesGenero,PersonaFactory::$correo,$Deportivos,$Artisticos,$Politicos,PersonaFactory::$tipoRelaccion,PersonaFactory::$quiereHijos,PersonaFactory::$tieneHijos);
    }
    }
}
