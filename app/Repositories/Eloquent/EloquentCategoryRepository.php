<?php namespace Bdgt\Repositories\Eloquent;

use Bdgt\Repositories\Contracts\CategoryRepositoryInterface;
use Bdgt\Resources\Category;

class EloquentCategoryRepository extends EloquentRepository implements CategoryRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new Category);
    }
}
