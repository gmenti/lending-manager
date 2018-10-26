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

        $lending = Lending::create([
            'installment_amount' => 10,
            'installment_price' => 33,
            'value' => 300,
            'client_id' => $client->id
        ]);

        $date = \Carbon\Carbon::now();
        for ($i = 1; $i <= $lending->installment_amount; $i++) {
            $date->addDay(1);
            if ($date->isSunday()) {
                $i--;
                continue;
            }
            $lending->installments()->create([
                'due_at' => $date,
                'value' => $lending->installment_price
            ]);
        }
    }
}
