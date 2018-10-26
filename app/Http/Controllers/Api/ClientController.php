<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\RestController;
use Validator;
use Illuminate\Http\Request;
use App\Entities\Client;

class ClientController extends RestController
{
    /** @inheritdoc */
    protected $entityClass = Client::class;

    /**
     * @inheritdoc
     */
    protected function validated(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'document' => ['required', 'string', 'min:11', 'max:11'],
            'phone_number' => ['required', 'string', 'min:11', 'max:11'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'complement' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'int', 'exists:users,id']
        ];

        return Validator::make($request->all(), $rules)->validate();
    }
}
