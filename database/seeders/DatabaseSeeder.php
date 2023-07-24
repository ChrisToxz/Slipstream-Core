<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

//        Video::factory(20)->for(Slip::factory(), 'slip')->create();
//        Slip::factory(20)->for(
//            Video::factory(), 'mediable'
//        )->create();

        User::factory()->create([
            'username' => 'chris',
        ]);

        
    }
}
