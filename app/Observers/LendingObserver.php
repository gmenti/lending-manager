<?php

namespace App\Observers;

use App\Entities\Lending;

class LendingObserver
{
    /**
     * Handle the lending "created" event.
     *
     * @param  \App\Entities\Lending  $lending
     * @return void
     */
    public function created(Lending $lending)
    {
        $date = \Carbon\Carbon::now();
        $installments = [];

        for ($i = 1; $i <= $lending->installment_amount; $i++) {
            $date->addDay(1);
            if ($date->isSunday()) {
                $i--;
                continue;
            }
            $installments[] = [
                'due_at' => $date->copy(),
                'value' => $lending->installment_price
            ];
        }

        $lending->installments()->createMany($installments);
    }

    /**
     * Handle the lending "updated" event.
     *
     * @param  \App\Entities\Lending  $lending
     * @return void
     */
    public function updated(Lending $lending)
    {
        //
    }

    /**
     * Handle the lending "deleted" event.
     *
     * @param  \App\Entities\Lending  $lending
     * @return void
     */
    public function deleted(Lending $lending)
    {
        //
    }

    /**
     * Handle the lending "restored" event.
     *
     * @param  \App\Entities\Lending  $lending
     * @return void
     */
    public function restored(Lending $lending)
    {
        //
    }

    /**
     * Handle the lending "force deleted" event.
     *
     * @param  \App\Entities\Lending  $lending
     * @return void
     */
    public function forceDeleted(Lending $lending)
    {
        //
    }
}
