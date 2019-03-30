<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function all(array $sortBy = [], array $columns = ['*']);

    public function paginate(int $perPage = 10, array $columns = ['*']);

    public function create(array $data);

    public function update(array $data, int $id, string $attribute = 'id');

    public function delete(int $id);

    public function find(int $id, array $columns = ['*']);

    public function findBy(string $field, $value, array $columns = ['*']);
}
