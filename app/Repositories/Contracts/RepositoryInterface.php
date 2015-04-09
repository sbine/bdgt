<?php namespace Bdgt\Repositories\Contracts;

interface RepositoryInterface
{
	public function all($columns = array('*'));

    public function paginate($perPage = 10, $columns = array('*'));

    public function create(array $data);

    public function update(array $data, $id, $attribute = 'id');

    public function delete($id);

    public function find($id, $columns = array('*'));

    public function findBy($field, $value, $columns = array('*'));
}