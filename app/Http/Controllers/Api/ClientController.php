<?php

namespace App\Http\Controllers\Api;

use Auth;
use Validator;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Entities\Client;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * @param Request $request
     *
     * @return array
     *
     * @throws ValidationException
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
        ];

        if (Auth::user()->is_admin) {
            $rules['user_id'] = ['int', 'exists:users,id'];
        }

        return Validator::make($request->all(), $rules)->validate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Client[]
     *
     * @throws AuthorizationException
     */
    public function index()
    {
        $user = Auth::user();
        $clients = $user->is_admin ? Client::all() : $user->clients;

        foreach ($clients as $client) {
            $this->authorize('view', $client);
        }

        return $clients;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return Client
     *
     * @throws ValidationException
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        $data = $this->validated($request);

        $client = new Client($data);
        $client->user_id = Auth::user()->id;

        $this->authorize('create', $client);

        $client->save();

        return $client;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Client
     *
     * @throws AuthorizationException
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);

        $this->authorize('view', $client);

        return $client;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     *
     * @return Client
     *
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $this->authorize('view', $client);

        $data = $this->validated($request);

        $client->fill($data);

        $this->authorize('update', $client);

        $client->save();

        return $client;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return null
     *
     * @throws AuthorizationException
     * @throws \Exception
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        $this->authorize('delete', $client);

        $client->delete();

        return null;
    }
}
