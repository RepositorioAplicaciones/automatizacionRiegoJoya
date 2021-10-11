<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

//importar modelos necesarios
use \App\Models\Area;
use \App\Models\Roster;
use \App\Models\Worker;
use \App\Models\Result;
use \App\Models\Role;
use \App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //POBLAR LA BASE DE DATOS

        //Crear areas de trabajo                
        Area::create(['name' => "Supervisor de Operaciones"]);
        Area::create(['name' => "Mantenimiento Mecánico"]);
        Area::create(['name' => "Recursos Humanos"]);
        Area::create(['name' => "Contabilidad"]);
        Area::create(['name' => "Administración"]);
        Area::create(['name' => "Producción"]);

        //Crear rosters
        Roster::create(['name' => "24/7"]);
        Roster::create(['name' => "7/7"]);
        Roster::create(['name' => "14/7"]);
        Roster::create(['name' => "30/14"]);        

        // Crear trabajadores y asignarles un random de resultados
        $num_workers = 6;
        $mul_results = 6;
        
        for ($i=0; $i < $num_workers; $i++) {
            Worker::create([
                    'name' => "Persona" . $i,
                    'age' => $i + 31,
                    'sex' => "hombre/mujer",
                    'DNI' => 34872170 + (10000000 * $i),
                    'area_id' => mt_rand(1, 6),
                    'roster_id' => mt_rand(1, 4),
                    'fecha_subida' =>  now(),
                    'fecha_bajada' =>  now()
                ]);
        }
        
        
        for ($i=0; $i < $num_workers * ($mul_results*3); $i++) {
            Result::create([
                    'worker_id' => mt_rand(1,$num_workers),
                    'temperature' => 36.5 + mt_rand(1,$num_workers),
                    'oxygen_saturation' => 89.5 +mt_rand(1,$num_workers),
                    'date' => now()
                ]);
        }

        //crear roles                
        Role::create(['name' => "administrador"]);
        Role::create(['name' => "operador"]);
        Role::create(['name' => "supervisor"]);
        Role::create(['name' => "otro"]);
        
        //crear usuarios
        User::create(['role_id' => 1, 'name' => "Nombre Administrador",  'email' => "administrador@g4s.com.pe", 'password' => Hash::make("Administrador1*")]);
        User::create(['role_id' => 2, 'name' => "Nombre Operador",  'email' => "operador@g4s.com.pe", 'password' => Hash::make("Operador1*")]);
        User::create(['role_id' => 3, 'name' => "Nombre Supervisor",  'email' => "supervisor@g4s.com.pe", 'password' => Hash::make("Supervisor1*")]);

    }
}
