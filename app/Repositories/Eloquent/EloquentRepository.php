<?php

namespace Bdgt\Repositories\Eloquent;

use Bdgt\Repositories\Contracts\RepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Log;

abstract class EloquentRepository implements RepositoryInterface
{
    protected $model;

    /**
     * Construct
     *
     * @param Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function instance($attribute = 'id', $value = null)
    {
        if ($value) {
            return $this->findBy($attribute, $value);
        }

        return new $this->model;
    }

    /**
     * Retrieve all models based on criteria
     *
     * @param array $sortBy
     * @param array $columns
     * @return Illuminate\Database\Eloquent\Collection
     */

    public function all($sortBy = [], $columns = ['*'])
    {
        $all = $this->model;

        if ($sortBy) {
            $all->orderBy(key($sortBy), $sortBy[key($sortBy)]);
        }

        return $all->get($columns);
    }

    /**
     * Retrieve all models based on criteria, paginated
     *
     * @param array $columns
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function paginate($perPage = 10, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * Create a new object from the provided data
     *
     * @param array $data
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        $instance = $this->instance();

        foreach ($data as $key => $value) {
            $instance->setAttribute($key, $value);
        }

        if ($instance->save()) {
            return $instance;
        }
        return null;
    }

    public function update(array $data, $id, $attribute = 'id')
    {
        $instance = $this->instance($attribute, $id);

        foreach ($data as $key => $value) {
            $instance->setAttribute($key, $value);
        }

        $instance->save();

        return true;
    }

    public function delete($id)
    {
        $instance = $this->instance('id', $id);

        return $instance->delete();
    }

    public function find($id, $columns = ['*'])
    {
        $instance = $this->model->find($id, $columns);

        return $instance;
    }

    public function findBy($attribute, $value, $columns = ['*'])
    {
        return $this->model->where($attribute, '=', $value)
                            ->first($columns);
    }

    public function query()
    {
        return $this->model;
    }

    /**
     * Save an object
     *
     * @param string $key
     * @param mixed $value
     * @param array $data
     * @return Illuminate\Database\Eloquent\Model
     */
    public function insertToTenant($key, $value, $data)
    {
        return $this->create($data);
    }
}
