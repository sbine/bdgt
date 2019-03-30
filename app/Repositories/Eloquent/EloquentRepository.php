<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

abstract class EloquentRepository implements RepositoryInterface
{
    protected $model;

    /**
     * Construct
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve an instance of the model
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function instance(string $attribute = 'id', $value = null)
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
     * @return \Illuminate\Database\Eloquent\Collection
     */

    public function all(array $sortBy = [], array $columns = ['*'])
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
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function paginate(int $perPage = 10, array $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * Create a new model instance from the provided data
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        if (empty($data)) {
            return null;
        }

        $instance = $this->instance();

        foreach ($data as $key => $value) {
            $instance->setAttribute($key, $value);
        }

        if ($instance->save()) {
            return $instance;
        }
        return null;
    }

    /**
     * Update the model
     *
     * @param  array  $data
     * @param  integer $id
     * @param  string $attribute
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(array $data, int $id, string $attribute = 'id')
    {
        if (empty($data)) {
            return null;
        }

        $instance = $this->instance($attribute, $id);

        foreach ($data as $key => $value) {
            $instance->setAttribute($key, $value);
        }

        if ($instance->save()) {
            return $instance;
        }
        return null;
    }

    /**
     * Delete the model
     *
     * @param  int $id
     * @return boolean
     */
    public function delete(int $id)
    {
        $instance = $this->model->find($id);

        if (!$instance) {
            return null;
        }

        return $instance->delete();
    }

    /**
     * Retrieve a model by ID
     *
     * @param  int $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find(int $id, array $columns = ['*'])
    {
        $instance = $this->model->findOrFail($id, $columns);

        return $instance;
    }

    /**
     * Find a model by attribute/value
     *
     * @param  string $attribute
     * @param  mixed $value
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findBy(string $attribute, $value, array $columns = ['*'])
    {
        return $this->model->where($attribute, '=', $value)
                            ->firstOrFail($columns);
    }

    /**
     * Retrieve the model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model()
    {
        return $this->model;
    }
}
