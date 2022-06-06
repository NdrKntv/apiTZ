<?php

namespace Database\Seeders;

use App\Models\Positions;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Positions::factory(4)->create();
        User::factory(45)->create();
    }
}
