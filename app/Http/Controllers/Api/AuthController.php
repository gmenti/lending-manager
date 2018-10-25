<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidAuthCredentialsException;
use App\Entities\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Login user.
     *
     * @param Request $request
     * @return array
     *
     * @throws InvalidAuthCredentialsException
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $data = \Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ])->validate();

        if (\Auth::attempt($data)) {
            $user = \Auth::user();
            $token = $user->createToken('app');

            return [
                'token' => $token->accessToken,
                'user' => $user
            ];
        }

        throw new InvalidAuthCredentialsException();
    }

    /**
     * Register a new user.
     *
     * @param Request $request
     * @return array
     *
     * @throws ValidationException
     */
    public function register(Request $request)
    {
        $data = \Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ])->validate();

        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => \Hash::make($data['password']),
        ]);

        $user->save();

        $token = $user->createToken('app');

        return [
            'token' => $token->accessToken,
            'user' => $user
        ];
    }

    /**
     * Get auth user.
     *
     * @param Request $request
     * @return User
     */
    public function me(Request $request)
    {
        return $request->user();
    }
}
