<?php

class BillRepositoryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->bill = $this->mock('Bdgt\Resources\Bill[create,save,update,delete]');
        $this->bill->user_id = 'testing';

        $this->repository = $this->app->make('Bdgt\Repositories\Contracts\BillRepositoryInterface', [$this->bill]);
    }

    public function testCreateMethodIsCalled()
    {
        $billArray = [
            'label' => 'Acme'
        ];

        $this->bill->shouldReceive('create')->once()->with($this->addScopeKeyToData($billArray));

        $this->repository->create($billArray);
    }

    public function testUpdateMethodIsCalled()
    {
        $billArray = [
            'label' => 'Acme'
        ];

        $this->bill->shouldReceive('where')->once()->andReturn($this->bill)->shouldReceive('update')->once()->with($this->addScopeKeyToData($billArray));

        $this->repository->update($billArray, 1);
    }

    public function testDeleteMethodIsCalled()
    {
        $id = 3;

        $this->bill->shouldReceive('find')->once()->with($id)->andReturn($this->bill)->shouldReceive('delete')->once();

        $this->repository->delete($id);
    }

    private function addScopeKeyToData($data)
    {
        $data['user_id'] = 'testing';

        return $data;
    }
}
