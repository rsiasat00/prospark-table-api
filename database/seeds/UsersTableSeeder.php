<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(App\User::class, 100)->create();
    }
}
