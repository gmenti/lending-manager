<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\RestController;
use Validator;
use App\Entities\Lending;
use Illuminate\Http\Request;

class LendingController extends RestController
{
    /** @inheritdoc */
    protected $entityClass = Lending::class;

    /**
     * @inheritdoc
     */
    protected function validated(Request $request)
    {
        $rules = [
            'client_id' => ['required', 'int', 'exists:clients,id'],
            'installment_amount' => ['required', 'numeric'],
            'installment_price' => ['required', 'numeric'],
            'value' => ['required', 'numeric'],
        ];

        return Validator::make($request->all(), $rules)->validate();
    }
}
