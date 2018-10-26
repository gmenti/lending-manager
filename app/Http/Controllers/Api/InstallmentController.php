<?php

namespace App\Http\Controllers\Api;

use App\Entities\Installment;
use App\Http\Controllers\RestController;
use Illuminate\Http\Request;

class InstallmentController extends RestController
{
    /** @inheritDoc */
    protected $entityClass = Installment::class;

    /**
     * @inheritDoc
     */
    protected function validated(Request $request)
    {
        // TODO: Implement validated() method.
    }
}
