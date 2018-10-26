<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\RestController;
use Validator;
use Illuminate\Http\Request;
use App\Entities\User;
use Illuminate\Validation\Rule;

class UserController extends RestController
{
    /** @inheritDoc */
    protected $entityClass = User::class;

    /**
     * @inheritDoc
     */
    protected function validated(Request $request)
    {
        $id = $request->route()->parameter('user');

        $uniqueEmailRule = Rule::unique('users');
        if (!empty($id)) {
            $uniqueEmailRule = $uniqueEmailRule->ignore($id);
        }

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', $uniqueEmailRule],
        ];

        return Validator::make($request->all(), $rules)->validate();
    }
}
