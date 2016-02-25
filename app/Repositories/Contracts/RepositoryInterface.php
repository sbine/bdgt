<?php

namespace Bdgt\Repositories\Contracts;

interface RepositoryInterface
{
    public function all($sortBy = [], $columns = ['*']);

    public function paginate($perPage = 10, $columns = ['*']);

    public function create(array $data);

    public function update(array $data, $id, $attribute = 'id');

    public function delete($id);

    public function find($id, $columns = ['*']);

    public function findBy($field, $value, $columns = ['*']);
}
