<?php

use App\Entities\Client;
use App\Entities\User;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        Client::create([
            'user_id' => $user->id,
            'name' => 'João da Vara',
            'document' => '11111111111',
            'phone_number' => '11111111111',
            'city' => 'Porto Alegre',
            'address' => 'Partenon',
            'street' => 'Osvaldo Pereira de Freitas',
            'complement' => 'APTO 512B',
            'number' => '175'
        ]);

        Client::create([
            'user_id' => $user->id,
            'name' => 'Dilma Rondel',
            'document' => '11111111111',
            'phone_number' => '11111111111',
            'city' => 'Porto Alegre',
            'address' => 'Partenon',
            'street' => 'Osvaldo Pereira de Freitas',
            'complement' => 'APTO 512B',
            'number' => '175'
        ]);
    }
}
