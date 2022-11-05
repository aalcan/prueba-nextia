<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Bienes;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = new User([
            'name' => "Armando Alcantara Lagunas",
            'username' => "test",
            'password' => Hash::make('ArmandoAlcantaraLagunas')
        ]);
        $user->save();
        $this->readAndSaveBienesCSV($user->id);

        /**
         * Reset the ID for autoincrement
         */
        $max_id = DB::scalar( "select max(id) from bienes");
        $new_max_id = intval($max_id ) + 1;
        $new_max_id = DB::statement("ALTER SEQUENCE  bienes_id_seq  RESTART WITH  $new_max_id");

    }

    /**
     * Undocumented function
     *
     * @param integer $user_id
     * @return void
     */
    public function readAndSaveBienesCSV(int $user_id) {
        $row = 1;
        if (($gestor = fopen("storage/app/public/bienes.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                if ($row == 1) {
                    $row++;
                    continue;
                }
                $bien = new Bienes([
                    'id'          => $datos[0],
                    'user_id'     => $user_id,
                    'articulo'    => Str::squish($datos[1]),
                    'descripcion' => Str::squish($datos[2])
                ]);
                
                $bien->save();
            }
            fclose($gestor);
        }
    }
}
