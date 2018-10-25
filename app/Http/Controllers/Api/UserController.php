<?php

namespace App\Http\Controllers\Api;

use Auth;
use Validator;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @param int $id
     *
     * @return array
     *
     * @throws ValidationException
     */
    protected function validated(Request $request, $id = null)
    {
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

    /**
     * Display a listing of the resource.
     *
     * @return User[]
     *
     * @throws AuthorizationException
     */
    public function index()
    {
        $users = User::all();

        foreach ($users as $user) {
            $this->authorize('view', $user);
        }

        return $users;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return User
     *
     * @throws AuthorizationException
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('view', $user);

        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  Request $request
     *
     * @return User
     *
     * @throws ValidationException
     * @throws AuthorizationException
     */
    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);

        $this->authorize('view', $user);

        $data = $this->validated($request, $id);

        $user->fill($data);

        $this->authorize('update', $user);

        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return null
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('delete', $user);

        $user->delete();

        return null;
    }
}
