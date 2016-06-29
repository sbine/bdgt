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
        $this->scopeKey   = $key;
        $this->scopeValue = $value;

        return $this;
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
        $all = $this->model->where($this->scopeKey, '=', $this->scopeValue);

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
        $data = $this->ensureScopeIntegrity($data);

        $instance = $this->instance($attribute, $id);

        foreach ($data as $key => $value) {
            $instance->setAttribute($key, $value);
        }

        return $instance->save();
    }

    public function delete($id)
    {
        $instance = $this->instance('id', $id);

        $this->ensureScopeIntegrity($instance);

        return $instance->delete();
    }

    public function find($id, $columns = ['*'])
    {
        $instance = $this->model->find($id, $columns);

        $this->ensureScopeIntegrity($instance);

        return $instance;
    }

    public function findBy($attribute, $value, $columns = ['*'])
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
            throw new Exception('Object fails scope constraint');
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

            if ($data[$this->scopeKey] !== $this->scopeValue
                && intval($data[$this->scopeKey]) !== intval($this->scopeValue)) {
                Log::warning('Invalid scope: ' . $this->scopeKey . ' / ' . $this->scopeValue, $data[$this->scopeKey]);
                throw new Exception('Invalid scope');
            }
        } elseif (is_object($data)) {
            if ($data->{$this->scopeKey} !== $this->scopeValue
                && intval($data[$this->scopeKey]) !== intval($this->scopeValue)) {
                Log::warning('Invalid scope: ' . $this->scopeKey . ' / ' . $this->scopeValue, [$data->{$this->scopeKey}]);
                throw new Exception('Invalid scope');
            }
        }

        return $data;
    }
}
