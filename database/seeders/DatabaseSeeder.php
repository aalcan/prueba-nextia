<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
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
    }
}
