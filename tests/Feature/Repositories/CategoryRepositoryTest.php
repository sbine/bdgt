<?php

namespace Tests\Feature\Repositories;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Resources\Category;
use App\Resources\User;
use Tests\TestCase;

class CategoryRepositoryTest extends TestCase
{
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = app()->make(CategoryRepositoryInterface::class);

        $this->be(factory(User::class)->create());
    }

    /**
     * Test that the repository 'create' method stores its input in the database
     */
    public function testCreateStoresInputToDatabase()
    {
        $category = factory(Category::class)->make();

        $createdCategory = $this->repository->create($category->toArray());

        $this->assertEquals($category->label, $createdCategory->label);
        $this->assertDatabaseHas('categories', array_add($category->toArray(), 'id', $createdCategory->id));
    }

    /**
     * Test that the repository 'update' method updates the database with its input
     */
    public function testUpdateChangesInputInDatabase()
    {
        $category = factory(Category::class)->create();
        $categoryArray = $category->toArray();
        $categoryArray['label'] = 'Acme';

        $updatedCategory = $this->repository->update($categoryArray, $category->id);

        $this->assertEquals($category->id, $updatedCategory->id);
        $this->assertDatabaseHas('categories', array_add($categoryArray, 'id', $updatedCategory->id));
    }

    /**
     * Test that the repository 'delete' method deletes the applicable row from the database
     */
    public function testDeleteMethodRemovesRowFromDatabase()
    {
        $category = factory(Category::class)->create();

        $this->repository->delete($category->id);

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id
        ]);
    }
}
