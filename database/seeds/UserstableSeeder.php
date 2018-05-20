<?php

use Illuminate\Database\Seeder;

class UserstableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'email' => 'admin@forum.local',
            'admin' => 1,
            'avatar' => asset('avatars/avatar.png')
        ]);

        App\User::create([
            'name' => 'User',
            'password' => bcrypt('user'),
            'email' => 'user@forum.local',
            'admin' => 0,
            'avatar' => asset('avatars/avatar.png')
        ]);
    }
}
