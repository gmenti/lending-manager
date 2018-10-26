<?php

use App\Entities\{ Client, Lending };
use Illuminate\Database\Seeder;

class LendingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = Client::first();

        Lending::create([
            'installment_amount' => 10,
            'installment_price' => 33,
            'value' => 300,
            'client_id' => $client->id
        ]);
    }
}
