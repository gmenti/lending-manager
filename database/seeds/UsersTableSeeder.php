<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Giuseppe Menti',
            'email' => 'mentifg@gmail.com',
            'password' => \Hash::make('menti1921')
        ]);
    }
}
