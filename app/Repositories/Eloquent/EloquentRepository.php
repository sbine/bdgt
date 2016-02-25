<?php

namespace Bdgt\Repositories\Eloquent;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Bdgt\Repositories\Contracts\RepositoryInterface;

abstract class EloquentRepository implements RepositoryInterface
{
    protected $model;
    protected $scopeKey;
    protected $scopeValue;

    /**
     * Construct
     *
     * @param Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function scopeBy($key, $value)
    {
        $this->scopeKey = $key;
        $this->scopeValue = $value;

        return $this;
    }

    /**
     * Retrieve all models based on criteria
     *
     * @param array $columns
     * @return Illuminate\Database\Eloquent\Collection
     */

    public function all($columns = ['*'])
    {
        return $this->model->where($this->scopeKey, '=', $this->scopeValue)
                            ->get($columns);
    }

    /**
     * Retrieve all models based on criteria, paginated
     *
     * @param array $columns
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function paginate($perPage = 10, $columns = ['*'])
    {
        return $this->model->where($this->scopeKey, '=', $this->scopeValue)
                            ->paginate($perPage, $columns);
    }

    /**
     * Create a new object from the provided data
     *
     * @param array $data
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        $data = $this->ensureScopeIntegrity($data);

        return $this->model->create($data);
    }

    public function update(array $data, $id, $attribute = 'id')
    {
        $data = $this->ensureScopeIntegrity($data);

        return $this->model->where($attribute, '=', $id)
                            ->update($data);
    }

    public function delete($id)
    {
        $object = $this->model->find($id);

        $this->ensureScopeIntegrity($object);

        return $object->delete();
    }

    public function find($id, $columns = ['*'])
    {
        $object = $this->model->find($id, $columns);

        $this->ensureScopeIntegrity($object);

        return $object;
    }

    public function findBy($field, $value, $columns = ['*'])
    {
        return $this->model->where($this->scopeKey, '=', $this->scopeValue)
                            ->where($attribute, '=', $value)
                            ->first($columns);
    }

    /**
     * Save an object if it passes scope constraint
     *
     * @param string $key
     * @param mixed $value
     * @param array $data
     * @return Illuminate\Database\Eloquent\Model
     */
    public function insertToTenant($key, $value, $data)
    {
        if ($data[$key] !== $value) {
            throw new Exception("Object fails scope constraint");
        }

        return $this->create($data);
    }

    private function ensureScopeIntegrity($data)
    {
        if (is_array($data)) {
            // Automatically set scope property if it's not present
            if (empty($data[$this->scopeKey]) || !isset($data[$this->scopeKey])) {
                $data[$this->scopeKey] = $this->scopeValue;
            }

            if ($data[$this->scopeKey] !== $this->scopeValue) {
                throw new Exception("Invalid scope");
            }
        } elseif (is_object($data)) {
            if ($data->{$this->scopeKey} !== $this->scopeValue) {
                throw new Exception("Invalid scope");
            }
        }

        return $data;
    }
}
