<?php

namespace App\Http\Controllers;

use App\Entities\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

abstract class RestController extends Controller
{
    /** @var string */
    protected $entityClass;

    /**
     * @param Request $request
     *
     * @return array
     *
     * @throws ValidationException
     */
    abstract protected function validated(Request $request);

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Model[]
     *
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function index(Request $request)
    {
        $data = \Validator::make($request->all(), [
            'filter' => 'string|json',
            'sort' => 'string|json',
            'range' => 'string|json'
        ])->validate();

        if (!empty($data['filter'])) {
            $data['filter'] = json_decode($data['filter'], true);
        } else {
            $data['filter'] = [];
        }

        if (!empty($data['sort'])) {
            $data['sort'] = json_decode($data['sort'], true);
        } else {
            $data['sort'] = ['id', 'ASC'];
        }

        if (!empty($data['range'])) {
            $data['range'] = json_decode($data['range'], true);
        } else {
            $data['range'] = [0, 0];
        }

        $data = \Validator::make($data, [
            'filter' => 'array',
            'filter.ids' => 'array|min:1',
            'filter.ids.*' => 'int',
            'sort' => 'required|array',
            'sort.0' => 'required|string',
            'sort.1' => 'required|in:ASC,DESC',
            'range' => 'required|array',
            'range.0' => 'required|int|min:0|max:' . $data['range'][1],
            'range.1' => 'required|int|min:' . $data['range'][0]
        ])->validate();

        $query = $this->entityClass::orderBy($data['sort'][0], $data['sort'][1]);

        $filter = $data['filter'];
        if (isset($filter['ids'])) {
            $query = $query->whereIn('id', $filter['ids']);
            unset($filter['ids']);
        }

        foreach ($filter as $key => $value) {
            if (is_string($value)) {
                $query = $query->where($key, 'like', "%$value%");
            } else {
                $query = $query->where($key, $value);
            }
        }

        if (!empty(array_filter($data['range']))) {
            $total = $query->count();

            $start = $data['range'][0];
            $limit = $data['range'][1];
            $amount = $limit - $start;

            $query = $query->skip($start)->take($amount);
            $resource = \Route::current()->uri;

            header("Content-Range: $resource $start-$limit/$total");
        }

        $results = $query->get();

        foreach ($results as $result) {
            $this->authorize('view', $result);
        }


        return $results;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Model
     *
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validated($request);

        /** @var Model $entity */
        $entity = new $this->entityClass($data);

        $this->authorize('create', $entity);

        $entity->save();

        return $entity;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     *
     * @return Model
     *
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        /** @var Model $model */
        $model = $this->entityClass::findOrFail($id);

        $this->authorize('view', $model);

        $data = $this->validated($request);

        $model->fill($data);

        $this->authorize('update', $model);

        $model->save();

        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Model
     *
     * @throws AuthorizationException
     */
    public function show($id)
    {
        /** @var Model $model */
        $model = $this->entityClass::findOrFail($id);

        $this->authorize('view', $model);

        return $model;
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
        /** @var Model $model */
        $model = $this->entityClass::findOrFail($id);

        $this->authorize('delete', $model);

        $model->delete();

        return null;
    }
}
