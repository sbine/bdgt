<?php

class CategoryRepositoryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->category = $this->mock('Bdgt\Resources\Category[create,save,update,delete]');
        $this->category->user_id = 'testing';

        $this->repository = $this->app->make('Bdgt\Repositories\Contracts\CategoryRepositoryInterface', [$this->category]);
    }

    public function testCreateMethodIsCalled()
    {
        $categoryArray = [
            'label' => 'Emergency Fund'
        ];

        $this->category->shouldReceive('create')->once()->with($this->addScopeKeyToData($categoryArray));

        $this->repository->create($categoryArray);
    }

    public function testUpdateMethodIsCalled()
    {
        $categoryArray = [
            'label' => 'Emergency Fund'
        ];

        $this->category->shouldReceive('where')->once()->andReturn($this->category)->shouldReceive('update')->once()->with($this->addScopeKeyToData($categoryArray));

        $this->repository->update($categoryArray, 1);
    }

    public function testDeleteMethodIsCalled()
    {
        $id = 3;

        $this->category->shouldReceive('find')->once()->with($id)->andReturn($this->category)->shouldReceive('delete')->once();

        $this->repository->delete($id);
    }

    private function addScopeKeyToData($data)
    {
        $data['user_id'] = 'testing';

        return $data;
    }
}
