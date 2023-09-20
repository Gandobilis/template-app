<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $record = [
            'name' => 'Lasha Gagnidze',
            'email' => 'lashadeveloper@gmail.com',
            'password' => bcrypt('password'),
        ];
        User::insert($record);
    }
}
