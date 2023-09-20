<?php

namespace Database\Seeders;

use App\Models\User\User;
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
            'role' => 'admin'
        ];
        User::insert($record);
    }
}
